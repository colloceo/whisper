@extends('layouts.app')

@section('content')
<div class="min-vh-100" style="background: linear-gradient(135deg, #f8fafc 0%, #f0f9ff 100%); padding-bottom: 100px;">
    <div class="container mx-auto px-3 py-4" style="max-width: 480px;">
        <!-- Header -->
        <div class="d-flex align-items-center justify-content-between mb-5">
            <a href="{{ route('home') }}" class="btn btn-light rounded-circle p-2 border-0" style="box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <div class="text-center">
                <h1 class="h5 fw-bold text-dark mb-0">Crisis Support</h1>
                <p class="small text-muted mb-0">Help is always available</p>
            </div>
            <div style="width: 42px;"></div>
        </div>

        <!-- Emergency Alert -->
        <div class="rounded-4 mb-4 p-4" style="background: rgba(254, 242, 242, 0.8); box-shadow: 0 4px 20px rgba(220, 38, 38, 0.1); border: 1px solid #fecaca;">
            <div class="d-flex align-items-start gap-3">
                <div class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0" style="width: 48px; height: 48px; background: #dc2626;">
                    <svg width="24" height="24" fill="white" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                    </svg>
                </div>
                <div>
                    <h6 class="fw-bold text-dark mb-2">If you're in immediate danger</h6>
                    <p class="text-muted mb-0" style="font-size: 14px; line-height: 1.5;">Please contact emergency services immediately. Your safety is the top priority.</p>
                </div>
            </div>
        </div>

        <!-- Crisis Hotlines -->
        <div class="rounded-4 mb-4" style="background: rgba(240, 249, 255, 0.8); box-shadow: 0 4px 20px rgba(14, 165, 233, 0.08); border: 1px solid rgba(186, 230, 253, 0.3);">
            <div class="p-4">
                <h3 class="h6 fw-bold text-dark mb-4">24/7 Crisis Hotlines - Kenya</h3>
                
                <div class="d-flex flex-column gap-3">
                    <a href="tel:999" class="btn btn-outline-danger rounded-3 p-3 d-flex align-items-center justify-content-between" style="border-width: 2px;">
                        <div class="text-start">
                            <div class="fw-semibold">Emergency Services</div>
                            <small class="text-muted">Police, Fire, Ambulance</small>
                        </div>
                        <span class="fw-bold" style="font-size: 18px;">999</span>
                    </a>
                    
                    <a href="tel:+254722178177" class="btn btn-outline-primary rounded-3 p-3 d-flex align-items-center justify-content-between" style="border-width: 2px;">
                        <div class="text-start">
                            <div class="fw-semibold">Befrienders Kenya</div>
                            <small class="text-muted">Suicide prevention hotline</small>
                        </div>
                        <span class="fw-bold">+254 722 178 177</span>
                    </a>
                    
                    <a href="tel:116" class="btn btn-outline-success rounded-3 p-3 d-flex align-items-center justify-content-between" style="border-width: 2px;">
                        <div class="text-start">
                            <div class="fw-semibold">Child Helpline Kenya</div>
                            <small class="text-muted">Support for children & teens</small>
                        </div>
                        <span class="fw-bold">116</span>
                    </a>
                    
                    <a href="tel:1195" class="btn btn-outline-info rounded-3 p-3 d-flex align-items-center justify-content-between" style="border-width: 2px;">
                        <div class="text-start">
                            <div class="fw-semibold">Gender Violence Recovery Centre</div>
                            <small class="text-muted">24/7 support for GBV survivors</small>
                        </div>
                        <span class="fw-bold">1195</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Coping Strategies -->
        <div class="rounded-4 mb-4" style="background: rgba(240, 249, 255, 0.8); box-shadow: 0 4px 20px rgba(14, 165, 233, 0.08); border: 1px solid rgba(186, 230, 253, 0.3);">
            <div class="p-4">
                <h3 class="h6 fw-bold text-dark mb-4">Immediate Coping Strategies</h3>
                
                <div class="d-flex flex-column gap-3">
                    <div class="card border-0 rounded-3 p-3" role="button" onclick="startBreathing()" style="background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%); border: 1px solid #0ea5e9;">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="fw-semibold text-dark mb-1">Guided Breathing</h6>
                                <p class="small text-muted mb-0">4-7-8 breathing technique</p>
                            </div>
                            <div class="d-flex align-items-center justify-content-center rounded-circle" style="width: 40px; height: 40px; background: #0ea5e9;">
                                <svg width="20" height="20" fill="white" viewBox="0 0 24 24">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card border-0 rounded-3 p-3" role="button" onclick="startGrounding()" style="background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); border: 1px solid #22c55e;">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="fw-semibold text-dark mb-1">5-4-3-2-1 Grounding</h6>
                                <p class="small text-muted mb-0">Connect with your senses</p>
                            </div>
                            <div class="d-flex align-items-center justify-content-center rounded-circle" style="width: 40px; height: 40px; background: #22c55e;">
                                <svg width="20" height="20" fill="white" viewBox="0 0 24 24">
                                    <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card border-0 rounded-3 p-3" style="background: linear-gradient(135deg, #fefce8 0%, #fef3c7 100%); border: 1px solid #eab308;">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h6 class="fw-semibold text-dark mb-1">Reach Out</h6>
                                <p class="small text-muted mb-0">Contact a trusted friend or family member</p>
                            </div>
                            <div class="d-flex align-items-center justify-content-center rounded-circle" style="width: 40px; height: 40px; background: #eab308;">
                                <svg width="20" height="20" fill="white" viewBox="0 0 24 24">
                                    <path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Professional Resources -->
        <div class="rounded-4" style="background: rgba(240, 249, 255, 0.8); box-shadow: 0 4px 20px rgba(14, 165, 233, 0.08); border: 1px solid rgba(186, 230, 253, 0.3);">
            <div class="p-4">
                <h3 class="h6 fw-bold text-dark mb-4">Professional Resources</h3>
                
                <div class="d-flex flex-column gap-3">
                    <a href="https://www.basicneedskenya.org" target="_blank" class="btn btn-outline-primary rounded-3 p-3 text-start">
                        <div class="fw-semibold">Basic Needs Kenya</div>
                        <small class="text-muted">Mental health support & advocacy</small>
                    </a>
                    <a href="https://mentalhealthkenya.org" target="_blank" class="btn btn-outline-success rounded-3 p-3 text-start">
                        <div class="fw-semibold">Mental Health Kenya</div>
                        <small class="text-muted">Resources & professional help</small>
                    </a>
                    <a href="https://www.who.int/health-topics/mental-health" target="_blank" class="btn btn-outline-info rounded-3 p-3 text-start">
                        <div class="fw-semibold">WHO Mental Health</div>
                        <small class="text-muted">Global mental health information</small>
                    </a>
                </div>
            </div>
        </div>
    </div>

    @include('components.bottom-nav', ['current' => 'crisis'])
</div>

<!-- Breathing Exercise Modal -->
<div class="modal fade" id="breathing-modal" tabindex="-1" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">Guided Breathing</h5>
                <button type="button" class="btn-close" onclick="closeBreathingModal()"></button>
            </div>
            <div class="modal-body text-center py-5">
                <div id="breathing-circle" class="mx-auto mb-4" style="width: 120px; height: 120px; border-radius: 50%; background: linear-gradient(135deg, #0ea5e9, #0284c7); display: flex; align-items: center; justify-content: center; transition: transform 0.3s ease;">
                    <span id="breathing-text" class="text-white fw-bold">Ready?</span>
                </div>
                <p id="breathing-instruction" class="text-muted mb-4">Click start to begin the 4-7-8 breathing exercise</p>
                <button id="breathing-btn" onclick="toggleBreathing()" class="btn rounded-pill px-4" style="background: #0ea5e9; color: white;">Start</button>
            </div>
        </div>
    </div>
</div>

<!-- Grounding Exercise Modal -->
<div class="modal fade" id="grounding-modal" tabindex="-1" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">5-4-3-2-1 Grounding</h5>
                <button type="button" class="btn-close" onclick="closeGroundingModal()"></button>
            </div>
            <div class="modal-body py-4">
                <div id="grounding-content">
                    <div class="text-center mb-4">
                        <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 64px; height: 64px; background: #22c55e;">
                            <span id="grounding-number" class="text-white fw-bold" style="font-size: 24px;">5</span>
                        </div>
                        <h6 id="grounding-title" class="fw-bold text-dark mb-2">Name 5 things you can see</h6>
                        <p id="grounding-description" class="text-muted small">Look around and identify 5 things you can see right now</p>
                    </div>
                    <div class="text-center">
                        <button id="grounding-btn" onclick="nextGroundingStep()" class="btn rounded-pill px-4" style="background: #22c55e; color: white;">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let breathingActive = false;
let breathingInterval;
let groundingStep = 0;

const groundingSteps = [
    { number: 5, title: "Name 5 things you can see", description: "Look around and identify 5 things you can see right now" },
    { number: 4, title: "Name 4 things you can touch", description: "Feel 4 different textures or objects around you" },
    { number: 3, title: "Name 3 things you can hear", description: "Listen carefully and identify 3 different sounds" },
    { number: 2, title: "Name 2 things you can smell", description: "Take a deep breath and notice 2 different scents" },
    { number: 1, title: "Name 1 thing you can taste", description: "Focus on any taste in your mouth or take a sip of water" }
];

function startBreathing() {
    const modal = document.getElementById('breathing-modal');
    modal.classList.add('show');
    modal.style.display = 'block';
    modal.removeAttribute('aria-hidden');
    document.body.classList.add('modal-open');
    
    const backdrop = document.createElement('div');
    backdrop.className = 'modal-backdrop fade show';
    backdrop.id = 'breathing-backdrop';
    document.body.appendChild(backdrop);
}

function closeBreathingModal() {
    const modal = document.getElementById('breathing-modal');
    const backdrop = document.getElementById('breathing-backdrop');
    
    modal.classList.remove('show');
    modal.style.display = 'none';
    document.body.classList.remove('modal-open');
    
    if (backdrop) backdrop.remove();
    
    if (breathingActive) toggleBreathing();
}

function startGrounding() {
    groundingStep = 0;
    updateGroundingDisplay();
    
    const modal = document.getElementById('grounding-modal');
    modal.classList.add('show');
    modal.style.display = 'block';
    modal.removeAttribute('aria-hidden');
    document.body.classList.add('modal-open');
    
    const backdrop = document.createElement('div');
    backdrop.className = 'modal-backdrop fade show';
    backdrop.id = 'grounding-backdrop';
    document.body.appendChild(backdrop);
}

function closeGroundingModal() {
    const modal = document.getElementById('grounding-modal');
    const backdrop = document.getElementById('grounding-backdrop');
    
    modal.classList.remove('show');
    modal.style.display = 'none';
    document.body.classList.remove('modal-open');
    
    if (backdrop) backdrop.remove();
}

function toggleBreathing() {
    const btn = document.getElementById('breathing-btn');
    const circle = document.getElementById('breathing-circle');
    const text = document.getElementById('breathing-text');
    const instruction = document.getElementById('breathing-instruction');
    
    if (!breathingActive) {
        breathingActive = true;
        btn.textContent = 'Stop';
        btn.style.background = '#dc2626';
        
        let phase = 0;
        let count = 0;
        
        breathingInterval = setInterval(() => {
            if (phase === 0) {
                text.textContent = `Inhale ${count + 1}`;
                instruction.textContent = "Breathe in slowly through your nose";
                circle.style.transform = 'scale(1.3)';
                count++;
                if (count >= 4) { phase = 1; count = 0; }
            } else if (phase === 1) {
                text.textContent = `Hold ${count + 1}`;
                instruction.textContent = "Hold your breath";
                circle.style.transform = 'scale(1.3)';
                count++;
                if (count >= 7) { phase = 2; count = 0; }
            } else {
                text.textContent = `Exhale ${count + 1}`;
                instruction.textContent = "Breathe out slowly through your mouth";
                circle.style.transform = 'scale(1)';
                count++;
                if (count >= 8) { phase = 0; count = 0; }
            }
        }, 1000);
    } else {
        breathingActive = false;
        clearInterval(breathingInterval);
        btn.textContent = 'Start';
        btn.style.background = '#0ea5e9';
        text.textContent = 'Ready?';
        instruction.textContent = 'Click start to begin the 4-7-8 breathing exercise';
        circle.style.transform = 'scale(1)';
    }
}

function nextGroundingStep() {
    groundingStep++;
    if (groundingStep < groundingSteps.length) {
        updateGroundingDisplay();
    } else {
        document.getElementById('grounding-content').innerHTML = `
            <div class="text-center">
                <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 64px; height: 64px; background: #22c55e;">
                    <svg width="32" height="32" fill="white" viewBox="0 0 24 24">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h6 class="fw-bold text-dark mb-2">Great job!</h6>
                <p class="text-muted small mb-4">You've completed the grounding exercise. How do you feel?</p>
                <button class="btn rounded-pill px-4" onclick="closeGroundingModal()" style="background: #22c55e; color: white;">Done</button>
            </div>
        `;
    }
}

function updateGroundingDisplay() {
    const step = groundingSteps[groundingStep];
    document.getElementById('grounding-number').textContent = step.number;
    document.getElementById('grounding-title').textContent = step.title;
    document.getElementById('grounding-description').textContent = step.description;
}
</script>
@endsection