@extends('layouts.app')

@section('content')
<div class="min-vh-100" style="padding-bottom: 100px;">
    <div class="container-whisper mx-auto px-3 py-4" style="max-width: 500px;">
        <!-- Header -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <a href="{{ route('home') }}" class="btn btn-light rounded-circle p-2">
                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <h1 class="h5 fw-semibold text-dark mb-0">Crisis Support</h1>
            <div style="width: 40px;"></div>
        </div>

        <!-- Emergency Alert -->
        <div class="alert alert-danger rounded-4 mb-4">
            <div class="d-flex align-items-start gap-3">
                <div class="d-flex align-items-center justify-content-center rounded-circle bg-danger flex-shrink-0" style="width: 48px; height: 48px;">
                    <svg width="24" height="24" fill="white" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                </div>
                <div class="flex-grow-1">
                    <h6 class="fw-semibold mb-2">If you're in immediate danger</h6>
                    <p class="small mb-3">Please contact emergency services immediately. Your safety is the top priority.</p>
                    <a href="tel:999" class="btn btn-danger whisper-btn">
                        Call 999 Now
                    </a>
                </div>
            </div>
        </div>

        <!-- Crisis Hotlines -->
        <div class="whisper-card p-4 mb-4">
            <h2 class="h6 text-dark fw-semibold mb-3">24/7 Crisis Hotlines</h2>
            <div class="d-flex flex-column gap-3">
                <!-- Kenya Hotlines -->
                <div class="alert alert-primary rounded-4 mb-0">
                    <h6 class="fw-semibold mb-2">🇰🇪 Kenya</h6>
                    <div class="d-flex flex-column gap-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="small">Emergency Services</span>
                            <a href="tel:999" class="btn btn-sm btn-primary whisper-btn">999</a>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="small">Befrienders Kenya</span>
                            <a href="tel:+254722178177" class="btn btn-sm btn-primary whisper-btn">+254 722 178 177</a>
                        </div>
                    </div>
                </div>

                <!-- International Hotlines -->
                <div class="alert alert-success rounded-4 mb-0">
                    <h6 class="fw-semibold mb-2">🌍 International</h6>
                    <div class="d-flex flex-column gap-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="small">Crisis Text Line</span>
                            <span class="badge bg-success">Text HOME to 741741</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="small">International Suicide Prevention</span>
                            <a href="https://www.iasp.info/resources/Crisis_Centres/" target="_blank" class="btn btn-sm btn-success whisper-btn">Find Local</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Immediate Coping Strategies -->
        <div class="whisper-card p-4 mb-4">
            <h2 class="h6 text-dark fw-semibold mb-3">Immediate Coping Strategies</h2>
            <div class="d-flex flex-column gap-3">
                <div class="alert alert-info rounded-4 mb-0" role="button" onclick="startBreathing()">
                    <div class="d-flex align-items-center gap-3">
                        <div class="d-flex align-items-center justify-content-center rounded-circle bg-info bg-opacity-25" style="width: 40px; height: 40px;">
                            <svg width="20" height="20" fill="currentColor" class="text-info" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h6 class="fw-semibold mb-1">Guided Breathing</h6>
                            <p class="small mb-0">4-7-8 breathing technique</p>
                        </div>
                    </div>
                </div>

                <div class="alert alert-warning rounded-4 mb-0" role="button" onclick="startGrounding()">
                    <div class="d-flex align-items-center gap-3">
                        <div class="d-flex align-items-center justify-content-center rounded-circle bg-warning bg-opacity-25" style="width: 40px; height: 40px;">
                            <svg width="20" height="20" fill="currentColor" class="text-warning" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                            </svg>
                        </div>
                        <div>
                            <h6 class="fw-semibold mb-1">5-4-3-2-1 Grounding</h6>
                            <p class="small mb-0">Connect with your senses</p>
                        </div>
                    </div>
                </div>

                <div class="alert alert-secondary rounded-4 mb-0">
                    <div class="d-flex align-items-center gap-3">
                        <div class="d-flex align-items-center justify-content-center rounded-circle bg-secondary bg-opacity-25" style="width: 40px; height: 40px;">
                            <svg width="20" height="20" fill="currentColor" class="text-secondary" viewBox="0 0 24 24">
                                <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div>
                            <h6 class="fw-semibold mb-1">Reach Out</h6>
                            <p class="small mb-0">Contact a trusted friend or family member</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Professional Resources -->
        <div class="whisper-card p-4">
            <h2 class="h6 text-dark fw-semibold mb-3">Professional Resources</h2>
            <div class="list-group list-group-flush">
                <a href="https://www.psychologytoday.com" target="_blank" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center border-0 rounded-4 mb-2">
                    <span>Find a Therapist</span>
                    <svg width="16" height="16" fill="none" stroke="currentColor" class="text-muted" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                </a>
                <a href="https://mentalhealthkenya.org" target="_blank" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center border-0 rounded-4 mb-2">
                    <span>Mental Health Kenya</span>
                    <svg width="16" height="16" fill="none" stroke="currentColor" class="text-muted" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                </a>
                <a href="https://www.who.int/health-topics/mental-health" target="_blank" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center border-0 rounded-4">
                    <span>WHO Mental Health</span>
                    <svg width="16" height="16" fill="none" stroke="currentColor" class="text-muted" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    @include('components.bottom-nav', ['current' => 'crisis'])
</div>

<!-- Breathing Exercise Modal -->
<div class="modal fade" id="breathing-modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content whisper-card border-0">
            <div class="modal-body p-4 text-center">
                <h3 class="h5 fw-semibold text-dark mb-4">4-7-8 Breathing</h3>
                <div id="breathing-circle" class="breathing-circle mx-auto mb-4 d-flex align-items-center justify-content-center">
                    <span id="breathing-text" class="text-white fw-semibold h5 mb-0">Ready?</span>
                </div>
                <div id="breathing-instruction" class="text-muted mb-4">
                    Click start when you're ready to begin
                </div>
                <div class="d-flex gap-2">
                    <button id="start-breathing" onclick="startBreathingExercise()" class="btn btn-whisper-blue whisper-btn flex-grow-1">
                        Start
                    </button>
                    <button onclick="closeBreathing()" class="btn btn-outline-secondary whisper-btn">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Grounding Exercise Modal -->
<div class="modal fade" id="grounding-modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content whisper-card border-0">
            <div class="modal-body p-4">
                <h3 class="h5 fw-semibold text-dark mb-4 text-center">5-4-3-2-1 Grounding</h3>
                <div id="grounding-content" class="text-center mb-4">
                    <div class="text-muted">
                        This technique helps you focus on the present moment using your five senses.
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <button id="start-grounding" onclick="startGroundingExercise()" class="btn btn-whisper-calm whisper-btn flex-grow-1">
                        Start
                    </button>
                    <button onclick="closeGrounding()" class="btn btn-outline-secondary whisper-btn">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let breathingInterval;
let groundingStep = 0;
let breathingModal = null;
let groundingModal = null;

function startBreathing() {
    if (!breathingModal) {
        breathingModal = new bootstrap.Modal(document.getElementById('breathing-modal'));
    }
    breathingModal.show();
}

function closeBreathing() {
    if (breathingModal) {
        breathingModal.hide();
    }
    if (breathingInterval) clearInterval(breathingInterval);
}

function startBreathingExercise() {
    const circle = document.getElementById('breathing-circle');
    const text = document.getElementById('breathing-text');
    const instruction = document.getElementById('breathing-instruction');
    const startBtn = document.getElementById('start-breathing');
    
    startBtn.style.display = 'none';
    
    let phase = 0; // 0: inhale, 1: hold, 2: exhale
    let count = 0;
    const phases = [
        { duration: 4, text: 'Inhale', instruction: 'Breathe in slowly through your nose' },
        { duration: 7, text: 'Hold', instruction: 'Hold your breath' },
        { duration: 8, text: 'Exhale', instruction: 'Breathe out slowly through your mouth' }
    ];
    
    breathingInterval = setInterval(() => {
        const currentPhase = phases[phase];
        text.textContent = count + 1;
        instruction.textContent = currentPhase.instruction;
        
        if (phase === 0) {
            circle.style.transform = `scale(${1 + count * 0.1})`;
        } else if (phase === 2) {
            circle.style.transform = `scale(${1.4 - count * 0.05})`;
        }
        
        count++;
        
        if (count >= currentPhase.duration) {
            count = 0;
            phase = (phase + 1) % 3;
            if (phase === 0) {
                circle.style.transform = 'scale(1)';
            }
        }
    }, 1000);
}

function startGrounding() {
    if (!groundingModal) {
        groundingModal = new bootstrap.Modal(document.getElementById('grounding-modal'));
    }
    groundingModal.show();
}

function closeGrounding() {
    if (groundingModal) {
        groundingModal.hide();
    }
    groundingStep = 0;
}

function startGroundingExercise() {
    const content = document.getElementById('grounding-content');
    const startBtn = document.getElementById('start-grounding');
    
    const steps = [
        { title: '5 Things You Can See', description: 'Look around and name 5 things you can see right now.' },
        { title: '4 Things You Can Touch', description: 'Notice 4 things you can feel with your hands or body.' },
        { title: '3 Things You Can Hear', description: 'Listen carefully and identify 3 sounds around you.' },
        { title: '2 Things You Can Smell', description: 'Take a deep breath and notice 2 different scents.' },
        { title: '1 Thing You Can Taste', description: 'Focus on 1 taste in your mouth right now.' },
        { title: 'Well Done!', description: 'You\'ve successfully grounded yourself in the present moment.' }
    ];
    
    if (groundingStep < steps.length) {
        const step = steps[groundingStep];
        content.innerHTML = `
            <div>
                <h4 class="h6 fw-semibold text-dark mb-3">${step.title}</h4>
                <p class="text-muted">${step.description}</p>
            </div>
        `;
        
        startBtn.textContent = groundingStep === steps.length - 1 ? 'Finish' : 'Next';
        groundingStep++;
        
        if (groundingStep > steps.length) {
            closeGrounding();
        }
    }
}
</script>
@endsection