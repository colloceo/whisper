<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use App\Models\JournalEntry;
use App\Models\Affirmation;
use App\Models\MoodEntry;
use App\Models\SupportGroup;
use App\Models\CommunityActivity;
use App\Models\ChatMessage;
use App\Models\UserSetting;

class WhisperController extends Controller
{
    public function onboarding()
    {
        return view('onboarding');
    }

    public function signin()
    {
        return view('signin');
    }

    public function processSignin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Simple authentication simulation
        Session::put('user_email', $request->email);
        Session::put('is_anonymous', false);
        Session::put('username', $this->generateUsername());

        return redirect()->route('home');
    }

    public function signup()
    {
        return view('signup');
    }

    public function processSignup(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
            'terms' => 'required',
        ]);

        // Simple registration simulation
        Session::put('user_email', $request->email);
        Session::put('is_anonymous', false);
        Session::put('username', $this->generateUsername());

        return redirect()->route('home');
    }

    public function home()
    {
        $userEmail = Session::get('user_email');
        
        // Generate username for anonymous users if not set
        if (!$userEmail && !Session::has('username')) {
            Session::put('username', $this->generateUsername());
            Session::put('is_anonymous', true);
        }
        
        // For anonymous users, use session ID as identifier
        $userIdentifier = $userEmail ?: Session::getId();
        
        // Check if user already checked in today
        $todayEntry = MoodEntry::where(function($query) use ($userEmail, $userIdentifier) {
                if ($userEmail) {
                    $query->where('user_email', $userEmail);
                } else {
                    $query->where('user_email', $userIdentifier)->orWhereNull('user_email');
                }
            })
            ->whereDate('created_at', now()->format('Y-m-d'))
            ->first();
        
        // Get weekly mood data for chart
        $weeklyMoods = MoodEntry::where(function($query) use ($userEmail, $userIdentifier) {
                if ($userEmail) {
                    $query->where('user_email', $userEmail);
                } else {
                    $query->where('user_email', $userIdentifier)->orWhereNull('user_email');
                }
            })
            ->where('created_at', '>=', now()->subDays(6)->startOfDay())
            ->orderBy('created_at')
            ->get();
        
        // Generate data for each day of the week
        $weekData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $dayName = now()->subDays($i)->format('D');
            
            // Find mood entry for this specific date
            $dayMood = $weeklyMoods->first(function($mood) use ($date) {
                return $mood->created_at->format('Y-m-d') === $date;
            });
            
            $weekData[$dayName] = $dayMood ? $dayMood->intensity * 10 : 0;
        }
        
        // Check for daily reminders
        $showDailyReminder = Session::get('daily_reminders_enabled', true) && 
                           !$todayEntry && 
                           now()->hour >= 9 && now()->hour <= 21;
        
        // Check for crisis alerts (if user hasn't been active recently)
        $lastActivity = collect([
            JournalEntry::where(function($query) use ($userEmail, $userIdentifier) {
                if ($userEmail) {
                    $query->where('user_email', $userEmail);
                } else {
                    $query->where('user_email', $userIdentifier);
                }
            })->latest()->first(),
            MoodEntry::where(function($query) use ($userEmail, $userIdentifier) {
                if ($userEmail) {
                    $query->where('user_email', $userEmail);
                } else {
                    $query->where('user_email', $userIdentifier);
                }
            })->latest()->first()
        ])->filter()->sortByDesc('created_at')->first();
        
        $showCrisisAlert = Session::get('crisis_alerts_enabled', true) && 
                          (!$lastActivity || $lastActivity->created_at->diffInDays(now()) > 3);
        
        // Get or generate daily affirmation
        $dailyAffirmation = $this->getDailyAffirmation();
        
        return view('home', compact('weekData', 'todayEntry', 'showDailyReminder', 'showCrisisAlert', 'dailyAffirmation'));
    }

    public function journal()
    {
        $userEmail = Session::get('user_email');
        $userIdentifier = $userEmail ?: Session::getId();
        
        // Get recent saved insights (affirmations)
        $recentEntries = Affirmation::where(function($query) use ($userEmail, $userIdentifier) {
                if ($userEmail) {
                    $query->where('user_email', $userEmail);
                } else {
                    $query->where('user_email', $userIdentifier)->orWhereNull('user_email');
                }
            })
            ->where('is_saved', true)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
        
        return view('journal', compact('recentEntries'));
    }

    public function chatrooms()
    {
        $supportGroups = SupportGroup::all();
        $recentActivities = CommunityActivity::orderBy('created_at', 'desc')->limit(3)->get();
        
        return view('chatrooms', compact('supportGroups', 'recentActivities'));
    }

    public function crisis()
    {
        return view('crisis');
    }

    public function profile()
    {
        $userEmail = Session::get('user_email');
        $userIdentifier = $userEmail ?: Session::getId();
        $isAnonymous = !$userEmail;
        
        // Get user statistics
        $journalCount = JournalEntry::where(function($query) use ($userEmail, $userIdentifier) {
                if ($userEmail) {
                    $query->where('user_email', $userEmail);
                } else {
                    $query->where('user_email', $userIdentifier);
                }
            })->count();
            
        $affirmationCount = Affirmation::where(function($query) use ($userEmail, $userIdentifier) {
                if ($userEmail) {
                    $query->where('user_email', $userEmail);
                } else {
                    $query->where('user_email', $userIdentifier);
                }
            })->where('is_saved', true)->count();
            
        $moodCount = MoodEntry::where(function($query) use ($userEmail, $userIdentifier) {
                if ($userEmail) {
                    $query->where('user_email', $userEmail);
                } else {
                    $query->where('user_email', $userIdentifier);
                }
            })->count();
            
        // Calculate days active (days with any activity)
        $journalDates = JournalEntry::where(function($query) use ($userEmail, $userIdentifier) {
                if ($userEmail) {
                    $query->where('user_email', $userEmail);
                } else {
                    $query->where('user_email', $userIdentifier);
                }
            })->selectRaw('DATE(created_at) as date')->distinct()->get()->pluck('date');
            
        $moodDates = MoodEntry::where(function($query) use ($userEmail, $userIdentifier) {
                if ($userEmail) {
                    $query->where('user_email', $userEmail);
                } else {
                    $query->where('user_email', $userIdentifier);
                }
            })->selectRaw('DATE(created_at) as date')->distinct()->get()->pluck('date');
            
        $affirmationDates = Affirmation::where(function($query) use ($userEmail, $userIdentifier) {
                if ($userEmail) {
                    $query->where('user_email', $userEmail);
                } else {
                    $query->where('user_email', $userIdentifier);
                }
            })->selectRaw('DATE(created_at) as date')->distinct()->get()->pluck('date');
            
        $daysActive = collect([$journalDates, $moodDates, $affirmationDates])->flatten()->unique()->count();
        
        $userName = Session::get('username', $userEmail ? 'Whisperer' : 'Anonymous User');
        $memberSince = $isAnonymous ? 'Current Session' : 'Nov 2025';
        
        // Get chat message count for this user
        $chatCount = ChatMessage::where(function($query) use ($userEmail, $userIdentifier) {
                if ($userEmail) {
                    $query->where('user_email', $userEmail);
                } else {
                    $query->where('user_email', $userIdentifier);
                }
            })->count();
            
        // Get user settings
        $settings = UserSetting::where('user_email', $userIdentifier)->first();
        if (!$settings) {
            $settings = UserSetting::create([
                'user_email' => $userIdentifier,
                'daily_reminders' => true,
                'crisis_alerts' => true,
                'anonymous_mode' => $isAnonymous
            ]);
        }
            
        // Set session variables for settings
        Session::put('daily_reminders_enabled', $settings->daily_reminders);
        Session::put('crisis_alerts_enabled', $settings->crisis_alerts);
        Session::put('is_anonymous', $settings->anonymous_mode);
        
        return view('profile', compact('userName', 'memberSince', 'daysActive', 'journalCount', 'affirmationCount', 'moodCount', 'chatCount', 'isAnonymous', 'settings'));
    }

    public function saveJournalEntry(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:5000',
            'mood' => 'nullable|string'
        ]);

        $userEmail = Session::get('user_email');
        $userIdentifier = $userEmail ?: Session::getId();

        JournalEntry::create([
            'user_email' => $userIdentifier,
            'content' => $request->content,
            'mood' => $request->mood,
            'is_anonymous' => !$userEmail
        ]);

        return response()->json(['success' => true, 'message' => 'Entry saved successfully!']);
    }

    public function generateAffirmation(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:5000'
        ]);

        try {
            // Create more contextual and varied prompts
            $promptStyles = [
                "Based on this journal entry: '{$request->content}' - Create a gentle, encouraging affirmation that acknowledges these feelings and offers hope.",
                "Someone wrote: '{$request->content}' - Transform this into words of self-compassion and understanding.",
                "For someone experiencing: '{$request->content}' - Write a supportive, healing message that validates their experience.",
                "Turn this personal reflection: '{$request->content}' - Into an empowering affirmation about growth and resilience.",
                "Respond to this journal entry: '{$request->content}' - With a mindful, caring message that offers perspective.",
                "Based on these thoughts: '{$request->content}' - Create a strength-based affirmation that highlights inner wisdom.",
                "Transform this feeling: '{$request->content}' - Into words of hope and encouragement for the healing journey.",
                "For this personal share: '{$request->content}' - Write a compassionate response that emphasizes self-acceptance."
            ];
            
            $randomPrompt = $promptStyles[array_rand($promptStyles)] . " Keep it under 50 words, personal, and avoid generic phrases. Make it specific to their experience. Add a unique timestamp: " . microtime(true);
            
            $response = Http::timeout(25)
                ->withHeaders([
                    'Authorization' => 'Bearer ' . env('GROQ_API_KEY'),
                    'Content-Type' => 'application/json'
                ])
                ->post('https://api.groq.com/openai/v1/chat/completions', [
                    'model' => 'llama3-8b-8192',
                    'messages' => [
                        ['role' => 'user', 'content' => $randomPrompt]
                    ],
                    'max_tokens' => 120,
                    'temperature' => 0.9
                ]);

            if ($response->successful()) {
                $data = $response->json();
                $affirmationText = trim($data['choices'][0]['message']['content'] ?? '');
                // Clean up the response thoroughly
                $affirmationText = preg_replace('/^["\']|["\']$/', '', $affirmationText);
                $affirmationText = preg_replace('/\d+\.\d+/', '', $affirmationText); // Remove timestamp
                $affirmationText = preg_replace('/\[.*?\]/', '', $affirmationText); // Remove any brackets
                $affirmationText = trim($affirmationText);
                
                // Ensure we have a valid response
                if (empty($affirmationText) || strlen($affirmationText) < 10) {
                    $affirmationText = $this->getContextualFallback($request->content);
                }
            } else {
                $fallbacks = [
                    'Your resilience shines even in difficult moments, and you are capable of healing.',
                    'Every emotion you feel is valid, and you have the inner strength to work through this.',
                    'You are not alone in this feeling, and it\'s okay to take things one step at a time.',
                    'Your courage to express these thoughts shows your commitment to growth and healing.',
                    'This difficult moment is temporary, but your strength and wisdom will carry you forward.',
                    'You have the power to transform pain into wisdom and growth.',
                    'Your vulnerability is a sign of strength, not weakness.',
                    'Each breath you take is a step toward healing and peace.',
                    'You are worthy of love, compassion, and understanding.',
                    'Your journey through this challenge is making you stronger.'
                ];
                $affirmationText = $this->getContextualFallback($request->content);
            }
        } catch (\Exception $e) {
            $affirmationText = $this->getContextualFallback($request->content);
        }

        $userEmail = Session::get('user_email');
        $userIdentifier = $userEmail ?: Session::getId();
        
        $affirmation = Affirmation::create([
            'user_email' => $userIdentifier,
            'original_entry' => $request->content,
            'affirmation_text' => $affirmationText,
            'is_saved' => false
        ]);

        return response()->json([
            'success' => true,
            'affirmation' => $affirmationText,
            'id' => $affirmation->id
        ]);
    }

    public function saveAffirmation(Request $request)
    {
        $request->validate(['id' => 'required|exists:affirmations,id']);
        
        Affirmation::where('id', $request->id)->update(['is_saved' => true]);
        
        return response()->json(['success' => true, 'message' => 'Affirmation saved!']);
    }

    public function saveMoodEntry(Request $request)
    {
        $request->validate([
            'mood_type' => 'required|string',
            'intensity' => 'required|integer|min:1|max:10',
            'notes' => 'nullable|string|max:1000'
        ]);

        $userEmail = Session::get('user_email');
        $userIdentifier = $userEmail ?: Session::getId();
        $today = now()->format('Y-m-d');

        // Find existing entry for today
        $existingEntry = MoodEntry::where(function($query) use ($userEmail, $userIdentifier) {
                if ($userEmail) {
                    $query->where('user_email', $userEmail);
                } else {
                    $query->where('user_email', $userIdentifier)->orWhereNull('user_email');
                }
            })
            ->whereDate('created_at', $today)
            ->first();

        if ($existingEntry) {
            // Update existing entry
            $existingEntry->update([
                'mood_type' => $request->mood_type,
                'intensity' => $request->intensity,
                'notes' => $request->notes,
                'updated_at' => now()
            ]);
        } else {
            // Create new entry
            MoodEntry::create([
                'user_email' => $userIdentifier,
                'mood_type' => $request->mood_type,
                'intensity' => $request->intensity,
                'notes' => $request->notes
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Mood tracked successfully!']);
    }

    public function getSavedAffirmations(Request $request)
    {
        $userEmail = Session::get('user_email');
        $userIdentifier = $userEmail ?: Session::getId();
        
        $savedAffirmations = Affirmation::where(function($query) use ($userEmail, $userIdentifier) {
                if ($userEmail) {
                    $query->where('user_email', $userEmail);
                } else {
                    $query->where('user_email', $userIdentifier)->orWhereNull('user_email');
                }
            })
            ->where('is_saved', true)
            ->orderBy('created_at', 'desc')
            ->get();
        
        return response()->json([
            'success' => true,
            'affirmations' => $savedAffirmations
        ]);
    }

    public function deleteAffirmation(Request $request, $id)
    {
        $userEmail = Session::get('user_email');
        $userIdentifier = $userEmail ?: Session::getId();
        
        $affirmation = Affirmation::where('id', $id)
            ->where(function($query) use ($userEmail, $userIdentifier) {
                if ($userEmail) {
                    $query->where('user_email', $userEmail);
                } else {
                    $query->where('user_email', $userIdentifier)->orWhereNull('user_email');
                }
            })
            ->first();
        
        if (!$affirmation) {
            return response()->json(['success' => false, 'message' => 'Affirmation not found'], 404);
        }
        
        $affirmation->delete();
        
        return response()->json(['success' => true, 'message' => 'Affirmation deleted successfully']);
    }

    public function getRecentEntries(Request $request)
    {
        $userEmail = Session::get('user_email');
        $userIdentifier = $userEmail ?: Session::getId();
        
        $recentEntries = JournalEntry::where(function($query) use ($userEmail, $userIdentifier) {
                if ($userEmail) {
                    $query->where('user_email', $userEmail);
                } else {
                    $query->where('user_email', $userIdentifier)->orWhereNull('user_email');
                }
            })
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
        
        return response()->json([
            'success' => true,
            'entries' => $recentEntries
        ]);
    }

    public function deleteJournalEntry(Request $request, $id)
    {
        $userEmail = Session::get('user_email');
        $userIdentifier = $userEmail ?: Session::getId();
        
        $journalEntry = JournalEntry::where('id', $id)
            ->where(function($query) use ($userEmail, $userIdentifier) {
                if ($userEmail) {
                    $query->where('user_email', $userEmail);
                } else {
                    $query->where('user_email', $userIdentifier)->orWhereNull('user_email');
                }
            })
            ->first();
        
        if (!$journalEntry) {
            return response()->json(['success' => false, 'message' => 'Journal entry not found'], 404);
        }
        
        $journalEntry->delete();
        
        return response()->json(['success' => true, 'message' => 'Journal entry deleted successfully']);
    }

    public function getChatMessages(Request $request, $groupName)
    {
        $query = ChatMessage::where('support_group', $groupName)
            ->orderBy('created_at', 'asc');
        
        // If 'after' parameter is provided, get only newer messages
        if ($request->has('after')) {
            $query->where('id', '>', $request->after);
        } else {
            $query->limit(50);
        }
        
        $messages = $query->get();
        
        return response()->json([
            'success' => true,
            'messages' => $messages
        ]);
    }
    
    public function sendChatMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'support_group' => 'required|string'
        ]);
        
        $userEmail = Session::get('user_email');
        $userName = $userEmail ? 'Whisperer' : 'Anonymous';
        
        $chatMessage = ChatMessage::create([
            'user_name' => $userName,
            'user_email' => $userEmail,
            'message' => $request->message,
            'support_group' => $request->support_group
        ]);
        
        // Create community activity
        $supportGroup = SupportGroup::where('name', 'like', '%' . str_replace(['anxietysupport', 'depressionsupport', 'generalwellness'], ['Anxiety Support', 'Depression Support', 'General Wellness'], $request->support_group) . '%')->first();
        
        if ($supportGroup) {
            CommunityActivity::create([
                'user_name' => $userName,
                'action' => 'shared a message in',
                'group_name' => $supportGroup->name
            ]);
        }
        
        return response()->json([
            'success' => true,
            'message' => $chatMessage
        ]);
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'setting' => 'required|string|in:daily_reminders,crisis_alerts,anonymous_mode',
            'value' => 'required|boolean'
        ]);
        
        $userEmail = Session::get('user_email');
        $userIdentifier = $userEmail ?: Session::getId();
        
        $settings = UserSetting::where('user_email', $userIdentifier)->first();
        if (!$settings) {
            $settings = UserSetting::create(['user_email' => $userIdentifier]);
        }
        
        $settings->update([$request->setting => $request->value]);
        
        // Handle anonymous mode toggle
        if ($request->setting === 'anonymous_mode') {
            Session::put('is_anonymous', $request->value);
            if ($request->value) {
                Session::forget('user_email');
                Session::forget('username');
            }
        }
        
        // Handle daily reminders
        if ($request->setting === 'daily_reminders') {
            Session::put('daily_reminders_enabled', $request->value);
        }
        
        // Handle crisis alerts
        if ($request->setting === 'crisis_alerts') {
            Session::put('crisis_alerts_enabled', $request->value);
        }
        
        return response()->json(['success' => true, 'message' => 'Setting updated successfully']);
    }

    public function help()
    {
        return view('help');
    }

    public function privacy()
    {
        return view('privacy');
    }

    public function terms()
    {
        return view('terms');
    }

    public function contact()
    {
        return view('contact');
    }

    public function logout(Request $request)
    {
        Session::flush();
        return redirect()->route('onboarding');
    }

    private function getDailyAffirmation()
    {
        $today = now()->format('Y-m-d');
        $cacheKey = 'daily_affirmation_' . $today;
        
        // Check if we already have today's affirmation in session
        if (Session::has($cacheKey)) {
            return Session::get($cacheKey);
        }
        
        $affirmationPrompts = [
            "Generate a gentle, encouraging daily affirmation about self-compassion and inner strength.",
            "Create a positive affirmation about resilience and personal growth.",
            "Write an uplifting message about self-worth and acceptance.",
            "Generate an affirmation about finding peace and balance in daily life.",
            "Create a supportive message about embracing challenges with courage.",
            "Write an affirmation about the power of small steps and progress.",
            "Generate a gentle reminder about being kind to oneself.",
            "Create an affirmation about inner wisdom and trusting oneself."
        ];
        
        $randomPrompt = $affirmationPrompts[array_rand($affirmationPrompts)] . " Keep it under 50 words and make it personal and meaningful.";
        
        try {
            $response = Http::timeout(15)
                ->withHeaders([
                    'Authorization' => 'Bearer ' . env('GROQ_API_KEY'),
                    'Content-Type' => 'application/json'
                ])
                ->post('https://api.groq.com/openai/v1/chat/completions', [
                    'model' => 'llama3-8b-8192',
                    'messages' => [
                        ['role' => 'user', 'content' => $randomPrompt]
                    ],
                    'max_tokens' => 100,
                    'temperature' => 0.8
                ]);

            if ($response->successful()) {
                $data = $response->json();
                $affirmation = trim($data['choices'][0]['message']['content'] ?? '');
                $affirmation = preg_replace('/^["\']|["\']$/', '', $affirmation);
            } else {
                $affirmation = $this->getFallbackAffirmation();
            }
        } catch (\Exception $e) {
            $affirmation = $this->getFallbackAffirmation();
        }
        
        // Cache the affirmation for the day
        Session::put($cacheKey, $affirmation);
        
        return $affirmation;
    }
    
    private function getFallbackAffirmation()
    {
        $fallbacks = [
            "You are doing your best, and that's more than enough. Be gentle with yourself today.",
            "Your journey is unique and valuable. Trust in your ability to navigate whatever comes your way.",
            "Every breath you take is a step toward healing and growth. You are stronger than you know.",
            "Today is a new opportunity to show yourself the kindness you deserve.",
            "Your feelings are valid, and you have the courage to work through them with compassion.",
            "You carry within you everything you need to face today with grace and strength.",
            "Progress isn't always visible, but every small step forward matters deeply.",
            "You are worthy of love, peace, and all the good things life has to offer.",
            "Your resilience has brought you this far, and it will continue to guide you forward.",
            "Today, choose to be patient with yourself as you continue growing and healing."
        ];
        
        return $fallbacks[array_rand($fallbacks)];
    }
    
    private function generateUsername()
    {
        try {
            $response = Http::timeout(10)
                ->withHeaders([
                    'Authorization' => 'Bearer ' . env('GROQ_API_KEY'),
                    'Content-Type' => 'application/json'
                ])
                ->post('https://api.groq.com/openai/v1/chat/completions', [
                    'model' => 'llama3-8b-8192',
                    'messages' => [
                        ['role' => 'user', 'content' => 'Generate a single, unique, friendly username for a mental health app. Make it positive, calming, and appropriate. Examples: SerenitySeeker, CalmWanderer, PeacefulJourney. Return only the username, no quotes or explanation.']
                    ],
                    'max_tokens' => 20,
                    'temperature' => 0.9
                ]);

            if ($response->successful()) {
                $data = $response->json();
                $username = trim($data['choices'][0]['message']['content'] ?? '');
                $username = preg_replace('/[^a-zA-Z0-9]/', '', $username);
                if (strlen($username) > 3 && strlen($username) < 20) {
                    return $username;
                }
            }
        } catch (\Exception $e) {
            // Fall through to fallback
        }
        
        return $this->getFallbackUsername();
    }
    
    private function getFallbackUsername()
    {
        $adjectives = ['Calm', 'Peaceful', 'Gentle', 'Serene', 'Bright', 'Kind', 'Wise', 'Strong', 'Brave', 'Hopeful'];
        $nouns = ['Soul', 'Heart', 'Spirit', 'Journey', 'Path', 'Light', 'Star', 'Dream', 'Voice', 'Wings'];
        $suffixes = ['Walker', 'Seeker', 'Finder', 'Keeper', 'Wanderer', 'Traveler', 'Guardian', 'Helper', 'Friend', 'Guide'];
        
        return $adjectives[array_rand($adjectives)] . $nouns[array_rand($nouns)] . $suffixes[array_rand($suffixes)];
    }
    
    private function getContextualFallback($content)
    {
        $content = strtolower($content);
        
        // Context-aware fallbacks based on keywords
        if (strpos($content, 'appetite') !== false || strpos($content, 'eating') !== false || strpos($content, 'food') !== false) {
            $responses = [
                'Your body is communicating with you. Listen with compassion and seek the nourishment you need, both physical and emotional.',
                'Changes in appetite often reflect our inner state. Be gentle with yourself as you navigate this, and consider reaching out for support.',
                'Your relationship with food and appetite can fluctuate. Trust that this is temporary and focus on small, caring acts of self-nourishment.'
            ];
        } elseif (strpos($content, 'tired') !== false || strpos($content, 'exhausted') !== false || strpos($content, 'sleep') !== false) {
            $responses = [
                'Rest is not a luxury, it is a necessity. Your body and mind are asking for what they need to heal and restore.',
                'Feeling tired is your system asking for care. Honor this need and give yourself permission to rest without guilt.',
                'Exhaustion often carries important messages. Listen to your body and prioritize the rest that will help you recover.'
            ];
        } elseif (strpos($content, 'anxious') !== false || strpos($content, 'worry') !== false || strpos($content, 'nervous') !== false) {
            $responses = [
                'Anxiety is your mind trying to protect you. Acknowledge it with kindness and remember that you have tools to find calm.',
                'These worried thoughts are temporary visitors. You have the strength to observe them without being overwhelmed by them.',
                'Your nervous system is responding to stress. Breathe deeply and remind yourself that you are safe in this moment.'
            ];
        } elseif (strpos($content, 'sad') !== false || strpos($content, 'down') !== false || strpos($content, 'depressed') !== false) {
            $responses = [
                'Sadness is a valid emotion that deserves acknowledgment. You are not broken; you are human, processing life with courage.',
                'These heavy feelings will not last forever. You have weathered difficult emotions before and found your way through.',
                'Your sadness speaks to your capacity for deep feeling. This sensitivity, while painful now, is also a source of strength.'
            ];
        } else {
            $responses = [
                'Your willingness to reflect and share shows incredible courage. You are taking important steps in your healing journey.',
                'These thoughts and feelings are valid parts of your human experience. You deserve compassion as you work through them.',
                'By expressing these feelings, you are already beginning to transform them. Trust in your ability to navigate this process.',
                'Your inner wisdom is guiding you toward growth and healing. Be patient with yourself as you move through this experience.',
                'Every moment of self-reflection is an act of self-care. You are investing in your wellbeing with courage and intention.'
            ];
        }
        
        return $responses[array_rand($responses)];
    }
}