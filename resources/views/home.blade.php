@extends('layouts.app')

@section('content')
<div class="min-vh-100" style="background: linear-gradient(135deg, #f8fafc 0%, #f0f9ff 100%); padding-bottom: 100px;">
    <div class="container-whisper mx-auto px-3 py-4" style="max-width: 500px;">
        <!-- Header with Greeting -->
        <div class="mb-4">
            <div class="text-center py-3">
                <h1 class="h2 fw-bold text-dark mb-2">Hello, {{ session('username', 'Whisperer') }} 
                    <svg width="24" height="24" fill="#f59e0b" viewBox="0 0 24 24" class="d-inline">
                        <path d="M7 24h2v-2H7v2zm4 0h2v-2h-2v2zm4 0h2v-2h-2v2zM16 .01L15.99 0H10v1.01L10.01 1v6.5L5.5 12H2v4h3.5l4.51 4.5v6.5H16V.01z"/>
                    </svg>
                </h1>
                <p class="text-muted">How are you feeling today?</p>
            </div>
        </div>

        <!-- Daily Reminder Alert -->
        @if(isset($showDailyReminder) && $showDailyReminder)
        <div class="mb-4">
            <div class="alert alert-info rounded-4 d-flex align-items-center gap-3">
                <div class="d-flex align-items-center justify-content-center rounded-circle" style="width: 40px; height: 40px; background: #0ea5e9;">
                    <svg width="20" height="20" fill="white" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                    </svg>
                </div>
                <div class="flex-grow-1">
                    <h6 class="fw-semibold mb-1">Daily Check-in Reminder</h6>
                    <p class="small mb-0">Take a moment to check in with yourself today. How are you feeling?</p>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" class="btn btn-sm btn-outline-info rounded-circle p-1">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                    </svg>
                </button>
            </div>
        </div>
        @endif

        <!-- Crisis Alert -->
        @if(isset($showCrisisAlert) && $showCrisisAlert)
        <div class="mb-4">
            <div class="alert alert-warning rounded-4 d-flex align-items-center gap-3">
                <div class="d-flex align-items-center justify-content-center rounded-circle" style="width: 40px; height: 40px; background: #f59e0b;">
                    <svg width="20" height="20" fill="white" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                    </svg>
                </div>
                <div class="flex-grow-1">
                    <h6 class="fw-semibold mb-1">We're here for you</h6>
                    <p class="small mb-2">It's been a while since your last check-in. Remember, support is always available.</p>
                    <a href="{{ route('crisis') }}" class="btn btn-sm btn-warning rounded-3">Get Support</a>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" class="btn btn-sm btn-outline-warning rounded-circle p-1">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                    </svg>
                </button>
            </div>
        </div>
        @endif

        <!-- Daily Affirmation Card -->
        <div class="mb-4">
            <div class="whisper-card p-4 text-center">
                <div class="mb-3">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-whisper-blue" style="width: 56px; height: 56px;">
                        <svg width="28" height="28" fill="white" viewBox="0 0 24 24">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                    </div>
                </div>
                <h3 class="h6 text-dark fw-semibold mb-2">Today's Affirmation</h3>
                <p class="text-muted fst-italic mb-0">
                    "{{ $dailyAffirmation }}"
                </p>
            </div>
        </div>

        <!-- Mood Check-In -->
        <div class="mb-4">
            <div class="whisper-card p-4">
                <h3 class="h6 text-dark fw-semibold mb-3 text-center">Quick Check-In</h3>
                @if($todayEntry)
                    <div class="alert alert-success rounded-4 mb-3 text-center">
                        <small class="text-success fw-medium">✓ Today's mood: {{ ucfirst($todayEntry->mood_type) }}</small>
                    </div>
                @endif
                
                <div class="row g-2 mb-4">
                    <div class="col">
                        <button class="mood-btn btn btn-light w-100 p-2 d-flex flex-column align-items-center gap-1 {{ $todayEntry && $todayEntry->mood_type === 'happy' ? 'active' : '' }}" data-mood="happy">
                            <svg width="20" height="20" fill="#10b981" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" fill="#10b981"/>
                                <circle cx="8" cy="9" r="1.5" fill="white"/>
                                <circle cx="16" cy="9" r="1.5" fill="white"/>
                                <path d="M8 15s1.5 2 4 2 4-2 4-2" stroke="white" stroke-width="1.5" fill="none" stroke-linecap="round"/>
                            </svg>
                            <span class="small fw-medium">Happy</span>
                        </button>
                    </div>
                    <div class="col">
                        <button class="mood-btn btn btn-light w-100 p-2 d-flex flex-column align-items-center gap-1 {{ $todayEntry && $todayEntry->mood_type === 'grateful' ? 'active' : '' }}" data-mood="grateful">
                            <svg width="20" height="20" fill="#ef4444" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" fill="#ef4444"/>
                                <path d="M7 9l1.5-1.5L10 9l-1.5 1.5L7 9z" fill="white"/>
                                <path d="M17 9l-1.5-1.5L14 9l1.5 1.5L17 9z" fill="white"/>
                                <path d="M8 15s1.5 2 4 2 4-2 4-2" stroke="white" stroke-width="1.5" fill="none" stroke-linecap="round"/>
                            </svg>
                            <span class="small fw-medium">Grateful</span>
                        </button>
                    </div>
                    <div class="col">
                        <button class="mood-btn btn btn-light w-100 p-2 d-flex flex-column align-items-center gap-1 {{ $todayEntry && $todayEntry->mood_type === 'neutral' ? 'active' : '' }}" data-mood="neutral">
                            <svg width="20" height="20" fill="#6b7280" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" fill="#6b7280"/>
                                <circle cx="8" cy="9" r="1.5" fill="white"/>
                                <circle cx="16" cy="9" r="1.5" fill="white"/>
                                <line x1="9" y1="15" x2="15" y2="15" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                            <span class="small fw-medium">Neutral</span>
                        </button>
                    </div>
                    <div class="col">
                        <button class="mood-btn btn btn-light w-100 p-2 d-flex flex-column align-items-center gap-1 {{ $todayEntry && $todayEntry->mood_type === 'anxious' ? 'active' : '' }}" data-mood="anxious">
                            <svg width="20" height="20" fill="#f59e0b" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" fill="#f59e0b"/>
                                <circle cx="8" cy="9" r="1.5" fill="white"/>
                                <circle cx="16" cy="9" r="1.5" fill="white"/>
                                <path d="M9 16s1-1.5 3-1.5 3 1.5 3 1.5" stroke="white" stroke-width="1.5" fill="none" stroke-linecap="round"/>
                            </svg>
                            <span class="small fw-medium">Anxious</span>
                        </button>
                    </div>
                    <div class="col">
                        <button class="mood-btn btn btn-light w-100 p-2 d-flex flex-column align-items-center gap-1 {{ $todayEntry && $todayEntry->mood_type === 'sad' ? 'active' : '' }}" data-mood="sad">
                            <svg width="20" height="20" fill="#3b82f6" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" fill="#3b82f6"/>
                                <circle cx="8" cy="9" r="1.5" fill="white"/>
                                <circle cx="16" cy="9" r="1.5" fill="white"/>
                                <path d="M16 16s-1.5-2-4-2-4 2-4 2" stroke="white" stroke-width="1.5" fill="none" stroke-linecap="round"/>
                            </svg>
                            <span class="small fw-medium">Sad</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Weekly Mood Trend -->
        <div class="mb-4">
            <div class="whisper-card p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h3 class="h6 text-dark fw-semibold mb-0">Your week at a glance</h3>
                    <svg width="16" height="16" fill="currentColor" class="text-whisper-blue" viewBox="0 0 24 24">
                        <path d="M16 6l2.29 2.29-4.88 4.88-4-4L2 16.59 3.41 18l6-6 4 4 6.3-6.29L22 12V6z"/>
                    </svg>
                </div>
                <div class="d-flex align-items-end justify-content-between gap-2" style="height: 80px;">
                    @foreach($weekData as $day => $height)
                    <div class="d-flex flex-column align-items-center gap-2 flex-grow-1">
                        <div class="w-100 bg-light rounded-pill overflow-hidden d-flex align-items-end" style="height: 60px;">
                            <div class="w-100 rounded-pill bg-whisper-blue" style="height: {{ max($height, 5) }}%;"></div>
                        </div>
                        <span class="small text-muted fw-medium">{{ $day }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Quick Actions Grid -->
        <div class="mb-4">
            <h3 class="h6 text-dark fw-semibold text-center mb-3">What would you like to do?</h3>
            
            <div class="row g-3">
                <div class="col-6">
                    <a href="{{ route('journal') }}" class="text-decoration-none">
                        <div class="whisper-card p-3 text-center h-100">
                            <div class="mb-2">
                                <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-whisper-blue" style="width: 48px; height: 48px;">
                                    <svg width="24" height="24" fill="white" viewBox="0 0 24 24">
                                        <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                                    </svg>
                                </div>
                            </div>
                            <h4 class="h6 text-dark fw-semibold mb-1">Journal</h4>
                            <p class="small text-muted mb-0">Express your thoughts</p>
                        </div>
                    </a>
                </div>
                
                <div class="col-6">
                    <a href="{{ route('chatrooms') }}" class="text-decoration-none">
                        <div class="whisper-card p-3 text-center h-100">
                            <div class="mb-2">
                                <div class="d-inline-flex align-items-center justify-content-center rounded-3 bg-whisper-warm" style="width: 48px; height: 48px;">
                                    <svg width="24" height="24" fill="white" viewBox="0 0 24 24">
                                        <path d="M12,3C6.5,3 2,6.58 2,11A7.18,7.18 0 0,0 2.64,14.25L1,22L8.75,20.36C9.81,20.75 10.87,21 12,21C17.5,21 22,17.42 22,13C22,8.58 17.5,5 12,5M12,3Z"/>
                                    </svg>
                                </div>
                            </div>
                            <h4 class="h6 text-dark fw-semibold mb-1">Chat</h4>
                            <p class="small text-muted mb-0">Connect with others</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Navigation -->
    @include('components.bottom-nav', ['current' => 'home'])
    
    <!-- Floating Crisis Button -->
    <a href="{{ route('crisis') }}" class="crisis-btn d-flex align-items-center justify-content-center">
        <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
        </svg>
    </a>
</div>

<script>
document.querySelectorAll('.mood-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.mood-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        
        const mood = this.dataset.mood;
        const moodIntensity = {
            'happy': 8,
            'grateful': 9, 
            'neutral': 5,
            'anxious': 3,
            'sad': 2
        };
        
        fetch('{{ route("api.mood.save") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ 
                mood_type: mood, 
                intensity: moodIntensity[mood],
                notes: ''
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Show success feedback and reload page to update chart
                const btn = this;
                const originalText = btn.innerHTML;
                btn.innerHTML = '<div class="small text-success">✓ Updated</div>';
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});
</script>
@endsection