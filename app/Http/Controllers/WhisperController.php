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
        Session::put('username', 'Whisperer');

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
        Session::put('username', 'Whisperer');

        return redirect()->route('home');
    }

    public function home()
    {
        $userEmail = Session::get('user_email');
        
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
        
        return view('home', compact('weekData', 'todayEntry', 'showDailyReminder', 'showCrisisAlert'));
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
        
        $userName = $userEmail ? 'Whisperer' : 'Anonymous User';
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
            // Add more randomization and context-aware prompts
            $promptStyles = [
                "Rewrite this as a gentle, encouraging affirmation: ",
                "Transform this feeling into words of self-compassion: ",
                "Create a supportive message for someone experiencing: ",
                "Turn this into a healing, positive affirmation: ",
                "Write an empowering response to help with: ",
                "Generate a mindful, caring message about: ",
                "Create a strength-based affirmation for: ",
                "Transform this into words of hope and resilience: "
            ];
            
            $contexts = [
                " Focus on inner strength and growth.",
                " Emphasize self-compassion and healing.",
                " Highlight resilience and hope.",
                " Focus on progress and small steps.",
                " Emphasize acceptance and understanding.",
                " Highlight personal power and choice.",
                " Focus on connection and support.",
                " Emphasize mindfulness and presence."
            ];
            
            $randomPrompt = $promptStyles[array_rand($promptStyles)] . $request->content . $contexts[array_rand($contexts)] . " Keep it under 60 words and make it deeply personal.";
            
            // Add timestamp to ensure uniqueness
            $uniquePrompt = $randomPrompt . " [" . time() . "]";
            
            $response = Http::timeout(25)
                ->withHeaders([
                    'Authorization' => 'Bearer ' . env('GROQ_API_KEY'),
                    'Content-Type' => 'application/json'
                ])
                ->post('https://api.groq.com/openai/v1/chat/completions', [
                    'model' => 'llama3-8b-8192',
                    'messages' => [
                        ['role' => 'user', 'content' => $uniquePrompt]
                    ],
                    'max_tokens' => 150,
                    'temperature' => 0.7
                ]);

            if ($response->successful()) {
                $data = $response->json();
                $affirmationText = trim($data['choices'][0]['message']['content'] ?? 'Your feelings are valid, and you have the strength to navigate through this difficult time.');
                // Clean up the response more thoroughly
                $affirmationText = preg_replace('/^["\']|["\']$/', '', $affirmationText);
                $affirmationText = preg_replace('/\[\d+\]/', '', $affirmationText); // Remove timestamp
                $affirmationText = trim($affirmationText);
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
                $affirmationText = $fallbacks[array_rand($fallbacks)];
            }
        } catch (\Exception $e) {
            $fallbacks = [
                'You are stronger than you know, and every step forward is progress worth celebrating.',
                'Your feelings matter, and you deserve compassion and understanding, especially from yourself.',
                'This challenging time is shaping you into someone even more resilient and wise.',
                'You have survived difficult moments before, and you have the strength to navigate this too.',
                'Your willingness to reflect and grow shows incredible courage and self-awareness.',
                'Trust in your ability to navigate through this with grace and strength.',
                'You are exactly where you need to be in your healing journey.',
                'Your heart knows how to heal, give it time and compassion.',
                'Every challenge you face is an opportunity for deeper self-understanding.',
                'You carry within you everything you need to overcome this moment.'
            ];
            $affirmationText = $fallbacks[array_rand($fallbacks)];
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
}