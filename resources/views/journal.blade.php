@extends('layouts.app')

@section('content')
<div class="min-vh-100" style="background: #fafbfc; padding-bottom: 100px;">
    <div class="container mx-auto px-3 py-4" style="max-width: 480px;">
        
        <!-- Header -->
        <div class="d-flex align-items-center justify-content-between mb-5">
            <a href="{{ route('home') }}" class="btn btn-light rounded-circle p-2 border-0" style="box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <div class="text-center">
                <h1 class="h5 fw-bold text-dark mb-0">Journal</h1>
                <p class="small text-muted mb-0">Transform thoughts into wisdom</p>
            </div>
            <div style="width: 42px;"></div>
        </div>

        <!-- Main Writing Area -->
        <div class="bg-white rounded-4 mb-4" style="box-shadow: 0 4px 20px rgba(0,0,0,0.08); border: 1px solid #e5e7eb;">
            <div class="p-4">
                <div class="text-center mb-4">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" 
                         style="width: 56px; height: 56px; background: #2563eb;">
                        <svg width="24" height="24" fill="white" viewBox="0 0 24 24">
                            <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                        </svg>
                    </div>
                    <h3 class="h6 fw-bold text-dark mb-2">What's on your mind?</h3>
                    <p class="text-muted small mb-0">Share your thoughts freely. Our AI will help transform them into positive insights.</p>
                </div>
                
                <form id="journal-form">
                    <div class="mb-3">
                        <textarea 
                            id="journal-input"
                            class="form-control border-0 rounded-3 p-3"
                            rows="5"
                            placeholder="Today I feel... I'm thinking about... What's been on my mind is..."
                            style="resize: none; font-size: 15px; line-height: 1.5; background: #f8fafc; border: 1px solid #e5e7eb !important;"
                        ></textarea>
                    </div>
                    
                    <!-- Prompt Suggestions -->
                    <div class="mb-3">
                        <p class="small text-muted mb-2 fw-medium">Quick prompts:</p>
                        <div class="d-flex flex-wrap gap-2">
                            <button type="button" onclick="usePrompt('I\'m feeling overwhelmed because...')" 
                                    class="btn btn-sm rounded-pill px-3 py-1" style="background: #f1f5f9; border: 1px solid #cbd5e1; color: #475569; font-size: 12px;">
                                I'm feeling overwhelmed...
                            </button>
                            <button type="button" onclick="usePrompt('Today I realized that...')" 
                                    class="btn btn-sm rounded-pill px-3 py-1" style="background: #f1f5f9; border: 1px solid #cbd5e1; color: #475569; font-size: 12px;">
                                Today I realized...
                            </button>
                            <button type="button" onclick="usePrompt('I\'m grateful for...')" 
                                    class="btn btn-sm rounded-pill px-3 py-1" style="background: #f1f5f9; border: 1px solid #cbd5e1; color: #475569; font-size: 12px;">
                                I'm grateful for...
                            </button>
                            <button type="button" onclick="usePrompt('What\'s been challenging me is...')" 
                                    class="btn btn-sm rounded-pill px-3 py-1" style="background: #f1f5f9; border: 1px solid #cbd5e1; color: #475569; font-size: 12px;">
                                What's challenging me...
                            </button>
                        </div>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="button" onclick="generateAffirmation()" 
                                class="btn flex-fill py-2 rounded-3 fw-medium border-0"
                                style="background: #2563eb; color: white; font-size: 14px;">
                            Get AI Insight
                        </button>
                        <button type="button" onclick="saveEntry()" 
                                class="btn flex-fill py-2 rounded-3 fw-medium"
                                style="background: #f8fafc; border: 1px solid #d1d5db; color: #374151; font-size: 14px;">
                            Save Entry
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- AI Response with Enhanced Animation -->
        <div id="ai-response" class="mb-4 d-none">
            <div class="flip-card">
                <div class="flip-card-inner" id="flip-card-inner">
                    <!-- Front Side -->
                    <div class="flip-card-front d-flex align-items-center justify-content-center p-4">
                        <div class="text-center">
                            <div class="spinner-border mb-3" style="color: #2563eb; width: 2rem; height: 2rem;" role="status"></div>
                            <h5 class="fw-bold text-dark mb-1" style="font-size: 16px;">Creating your insight...</h5>
                            <p class="text-muted mb-0 small">AI is analyzing your thoughts</p>
                        </div>
                    </div>
                    <!-- Back Side -->
                    <div class="flip-card-back p-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="d-flex align-items-center justify-content-center rounded-circle me-3" 
                                 style="width: 40px; height: 40px; background: #2563eb;">
                                <svg width="20" height="20" fill="white" viewBox="0 0 24 24">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <h4 class="h6 fw-bold text-dark mb-0">Your Personal Insight</h4>
                        </div>
                        <div id="affirmation-text" class="flex-grow-1 p-3 rounded-3 mb-3"
                             style="background: #f8fafc; border: 1px solid #e5e7eb; min-height: 80px; overflow-y: auto;">
                            <!-- AI response will appear here -->
                        </div>
                        <div class="mt-auto">
                            <button onclick="saveAffirmation()" 
                                    class="btn rounded-3 fw-medium py-2 px-4 w-100" style="background: #10b981; color: white; font-size: 14px;">
                                Save This Insight
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Entries -->
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white border-0 rounded-top-4 p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h3 class="h6 fw-bold text-dark mb-0">Recent Insights</h3>
                    <span class="badge bg-light text-dark rounded-pill px-3 py-2">{{ $recentEntries->count() }} entries</span>
                </div>
                <div class="text-center">
                    <button onclick="showReflectionsModal()" class="btn rounded-3 px-4 py-2 fw-medium" style="background: #f8fafc; border: 1px solid #d1d5db; color: #374151; font-size: 13px;">
                        View All Reflections
                    </button>
                </div>
            </div>
            <div class="card-body p-4">
                @if($recentEntries->count() > 0)
                    <div class="d-flex flex-column gap-3">
                        @foreach($recentEntries as $entry)
                        <div class="card border-0 mb-3 shadow-sm" style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);">
                            <div class="card-body p-3">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <small class="text-muted fw-medium">{{ $entry->created_at->format('M j, g:i A') }}</small>
                                    <div class="d-flex gap-2 align-items-center">
                                        <span class="badge bg-primary rounded-pill px-2 py-1 small">Insight</span>
                                        <button onclick="deleteAffirmation({{ $entry->id }}, this)" class="btn btn-sm p-1" style="color: #dc2626; background: none; border: none;" title="Delete insight">
                                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <p class="text-dark fw-medium mb-0" style="line-height: 1.5; font-size: 14px;">{{ Str::limit($entry->affirmation_text, 120) }}</p>
                            </div>
                        </div>
                        @endforeach

                    </div>
                @else
                    <div class="text-center py-5">
                        <div class="mb-3">
                            <svg width="48" height="48" fill="#cbd5e1" viewBox="0 0 24 24">
                                <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                            </svg>
                        </div>
                        <h5 class="fw-semibold text-dark mb-2">No insights yet</h5>
                        <p class="text-muted mb-0">Generate and save insights to see them here</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Reflections Modal -->
    <div class="modal fade" id="reflectionsModal" tabindex="-1" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-0 rounded-4">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">All Your Reflections</h5>
                    <button type="button" class="btn-close" onclick="closeModal()"></button>
                </div>
                <div class="modal-body pt-2">
                    <div class="mb-3 text-center">
                        <button onclick="showSavedInsights()" class="btn btn-sm rounded-pill px-3 py-1" style="background: #e0e7ff; color: #3730a3; font-size: 12px;">
                            View Saved Insights Instead
                        </button>
                    </div>
                    <div id="reflections-list">
                        <!-- Journal reflections will be loaded here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('components.bottom-nav', ['current' => 'journal'])
</div>

<style>
/* Enhanced 3D Flip Card Animation */
.flip-card {
    background-color: transparent;
    perspective: 1000px;
    width: 100%;
    height: 220px;
}

.flip-card-inner {
    position: relative;
    width: 100%;
    height: 100%;
    text-align: center;
    transition: transform 0.8s ease-in-out;
    transform-style: preserve-3d;
}

.flip-card.flipped .flip-card-inner {
    transform: rotateY(180deg);
}

.flip-card-front, .flip-card-back {
    position: absolute;
    width: 100%;
    height: 100%;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
    border-radius: 1rem;
    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    border: 1px solid #e5e7eb;
    display: flex;
    flex-direction: column;
}

.flip-card-back {
    transform: rotateY(180deg);
}

.flip-card-front {
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
}

.flip-card-back {
    background: linear-gradient(135deg, #ffffff 0%, #f0f9ff 100%);
}

/* Modern Gradient Backgrounds */
.bg-gradient-to-br {
    background: linear-gradient(135deg, #f0f9ff 0%, #e0e7ff 100%);
}

/* Enhanced Button Hover Effects */
.btn:hover {
    transform: translateY(-2px);
    transition: all 0.3s ease;
}

/* Glassmorphism Effect */
.card {
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

/* Smooth Animations */
* {
    transition: all 0.3s ease;
}

/* Custom Scrollbar */
::-webkit-scrollbar {
    width: 6px;
}

::-webkit-scrollbar-track {
    background: #f1f5f9;
}

::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 3px;
}

::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}
</style>

<script>
let currentAffirmationId = null;

function generateAffirmation() {
    const input = document.getElementById('journal-input').value;
    if (!input.trim()) {
        showNotification('Please write something first!', 'warning');
        return;
    }
    
    const responseDiv = document.getElementById('ai-response');
    const flipCard = responseDiv.querySelector('.flip-card');
    const affirmationText = document.getElementById('affirmation-text');
    
    // Reset current affirmation ID
    currentAffirmationId = null;
    
    // Show the card with entrance animation
    responseDiv.classList.remove('d-none');
    responseDiv.style.opacity = '0';
    responseDiv.style.transform = 'translateY(20px)';
    flipCard.classList.remove('flipped');
    
    // Animate entrance
    setTimeout(() => {
        responseDiv.style.opacity = '1';
        responseDiv.style.transform = 'translateY(0)';
    }, 100);
    
    fetch('/api/affirmation/generate', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ content: input })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success && data.id) {
            currentAffirmationId = data.id;
            console.log('Generated affirmation ID:', currentAffirmationId);
            affirmationText.innerHTML = `<p class="text-dark fw-semibold mb-0" style="font-size: 14px; line-height: 1.5;">"${data.affirmation}"</p>`;
            
            // Trigger flip animation with perfect timing
            setTimeout(() => {
                flipCard.classList.add('flipped');
            }, 800);
        } else {
            throw new Error('Invalid response data');
        }
    })
    .catch(error => {
        console.error('Error generating affirmation:', error);
        affirmationText.innerHTML = '<p class="text-danger fw-medium">Unable to generate insight. Please try again.</p>';
        setTimeout(() => {
            flipCard.classList.add('flipped');
        }, 800);
    });
}

function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `alert alert-${type} position-fixed top-0 start-50 translate-middle-x mt-3 shadow-lg rounded-3`;
    notification.style.zIndex = '9999';
    notification.textContent = message;
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 3000);
}

function saveEntry() {
    const input = document.getElementById('journal-input').value;
    if (!input.trim()) {
        showNotification('Please write something first!', 'warning');
        return;
    }
    
    const button = event.target;
    const originalText = button.innerHTML;
    button.innerHTML = 'Saving...';
    button.disabled = true;
    
    fetch('/api/journal/save', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ content: input })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification('Entry saved successfully!', 'success');
            document.getElementById('journal-input').value = '';
            button.innerHTML = originalText;
            button.disabled = false;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Error saving entry. Please try again.', 'danger');
        button.innerHTML = originalText;
        button.disabled = false;
    });
}

function saveAffirmation() {
    if (!currentAffirmationId) {
        showNotification('No insight to save!', 'warning');
        return;
    }
    
    const button = event.target;
    const originalText = button.innerHTML;
    button.innerHTML = 'Saving...';
    button.disabled = true;
    
    fetch('/api/affirmation/save', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ id: currentAffirmationId })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            showNotification('Insight saved to your collection!', 'success');
            button.innerHTML = 'Saved Successfully';
            button.style.background = '#059669';
            button.disabled = false;
            
            // Add to Recent Insights list immediately
            addToRecentInsights({
                id: currentAffirmationId,
                affirmation_text: document.getElementById('affirmation-text').textContent.replace(/"/g, ''),
                created_at: new Date().toISOString()
            });
        } else {
            throw new Error(data.message || 'Save failed');
        }
    })
    .catch(error => {
        console.error('Error saving affirmation:', error);
        showNotification('Error saving insight. Please try again.', 'danger');
        button.innerHTML = originalText;
        button.disabled = false;
    });
}

function usePrompt(promptText) {
    document.getElementById('journal-input').value = promptText;
    document.getElementById('journal-input').focus();
}

function showReflectionsModal() {
    const modalElement = document.getElementById('reflectionsModal');
    const listContainer = document.getElementById('reflections-list');
    
    // Show modal using data attributes
    modalElement.classList.add('show');
    modalElement.style.display = 'block';
    modalElement.removeAttribute('aria-hidden');
    document.body.classList.add('modal-open');
    
    // Add backdrop
    const backdrop = document.createElement('div');
    backdrop.className = 'modal-backdrop fade show';
    backdrop.id = 'modal-backdrop';
    document.body.appendChild(backdrop);
    
    listContainer.innerHTML = '<div class="text-center py-4"><div class="spinner-border" role="status"></div><p class="mt-2 text-muted">Loading your reflections...</p></div>';
    
    fetch('/api/journal/recent', {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success && data.entries.length > 0) {
            listContainer.innerHTML = data.entries.map(entry => `
                <div class="card border-0 mb-3 shadow-sm" style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <small class="text-muted fw-medium">${new Date(entry.created_at).toLocaleDateString('en-US', { month: 'short', day: 'numeric', hour: 'numeric', minute: '2-digit' })}</small>
                            <div class="d-flex gap-2 align-items-center">
                                <span class="badge rounded-pill px-2 py-1 small" style="background: ${entry.mood ? '#dcfce7' : '#dbeafe'}; color: ${entry.mood ? '#166534' : '#1e40af'}; font-size: 10px;">
                                    ${entry.mood ? entry.mood.charAt(0).toUpperCase() + entry.mood.slice(1) : 'Reflective'}
                                </span>
                                <button onclick="deleteJournalEntry(${entry.id}, this)" class="btn btn-sm p-1" style="color: #dc2626; background: none; border: none;" title="Delete entry">
                                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <p class="text-dark fw-medium mb-0" style="line-height: 1.5; font-size: 14px;">${entry.content}</p>
                    </div>
                </div>
            `).join('');
        } else {
            listContainer.innerHTML = `
                <div class="text-center py-4">
                    <svg width="48" height="48" fill="#cbd5e1" viewBox="0 0 24 24" class="mb-3">
                        <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                    </svg>
                    <h5 class="fw-medium text-dark mb-2">No reflections yet</h5>
                    <p class="text-muted mb-0 small">Start journaling to see your reflections here</p>
                </div>
            `;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        listContainer.innerHTML = '<div class="text-center py-4"><p class="text-danger small">Error loading reflections. Please try again.</p></div>';
    });
}

function showSavedInsights() {
    const modalElement = document.getElementById('reflectionsModal');
    const listContainer = document.getElementById('reflections-list');
    
    listContainer.innerHTML = '<div class="text-center py-4"><div class="spinner-border" role="status"></div><p class="mt-2 text-muted">Loading your insights...</p></div>';
    
    fetch('/api/affirmations/saved', {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success && data.affirmations.length > 0) {
            listContainer.innerHTML = data.affirmations.map(affirmation => `
                <div class="card border-0 mb-3 shadow-sm" style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <small class="text-muted fw-medium">${new Date(affirmation.created_at).toLocaleDateString('en-US', { month: 'short', day: 'numeric', hour: 'numeric', minute: '2-digit' })}</small>
                            <div class="d-flex gap-2 align-items-center">
                                <span class="badge bg-primary rounded-pill px-2 py-1 small">Insight</span>
                                <button onclick="deleteAffirmation(${affirmation.id}, this)" class="btn btn-sm p-1" style="color: #dc2626; background: none; border: none;" title="Delete insight">
                                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <p class="text-dark fw-medium mb-0" style="line-height: 1.5; font-size: 14px;">${affirmation.affirmation_text}</p>
                    </div>
                </div>
            `).join('');
        } else {
            listContainer.innerHTML = `
                <div class="text-center py-4">
                    <svg width="48" height="48" fill="#cbd5e1" viewBox="0 0 24 24" class="mb-3">
                        <path d="M12,2A2,2 0 0,1 14,4C14,4.74 13.6,5.39 13,5.73V7H14A7,7 0 0,1 21,14H22A1,1 0 0,1 23,15V18A1,1 0 0,1 22,19H21V20A2,2 0 0,1 19,22H5A2,2 0 0,1 3,20V19H2A1,1 0 0,1 1,18V15A1,1 0 0,1 2,14H3A7,7 0 0,1 10,7H11V5.73C10.4,5.39 10,4.74 10,4A2,2 0 0,1 12,2M7.5,13A2.5,2.5 0 0,0 5,15.5A2.5,2.5 0 0,0 7.5,18A2.5,2.5 0 0,0 10,15.5A2.5,2.5 0 0,0 7.5,13M16.5,13A2.5,2.5 0 0,0 14,15.5A2.5,2.5 0 0,0 16.5,18A2.5,2.5 0 0,0 19,15.5A2.5,2.5 0 0,0 16.5,13Z"/>
                    </svg>
                    <h5 class="fw-medium text-dark mb-2">No saved insights yet</h5>
                    <p class="text-muted mb-0 small">Generate and save insights to see them here</p>
                </div>
            `;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        listContainer.innerHTML = '<div class="text-center py-4"><p class="text-danger small">Error loading insights. Please try again.</p></div>';
    });
}

function closeModal() {
    const modalElement = document.getElementById('reflectionsModal');
    const backdrop = document.getElementById('modal-backdrop');
    
    // Remove focus from any focused elements in modal
    const focusedElement = modalElement.querySelector(':focus');
    if (focusedElement) {
        focusedElement.blur();
    }
    
    modalElement.classList.remove('show');
    modalElement.style.display = 'none';
    modalElement.removeAttribute('aria-hidden');
    document.body.classList.remove('modal-open');
    
    if (backdrop) {
        backdrop.remove();
    }
}

function deleteAffirmation(id, buttonElement) {
    if (!confirm('Are you sure you want to delete this insight? This action cannot be undone.')) {
        return;
    }
    
    fetch(`/api/affirmation/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            showNotification('Insight deleted successfully', 'success');
            // Remove the affirmation from DOM
            const affirmationElement = buttonElement.closest('.card');
            affirmationElement.style.opacity = '0';
            affirmationElement.style.transform = 'translateX(-100%)';
            setTimeout(() => {
                affirmationElement.remove();
                checkEmptyState();
            }, 300);
        } else {
            throw new Error(data.message || 'Delete failed');
        }
    })
    .catch(error => {
        console.error('Error deleting affirmation:', error);
        showNotification('Error deleting insight. Please try again.', 'danger');
    });
}

function deleteJournalEntry(id, buttonElement) {
    if (!confirm('Are you sure you want to delete this journal entry? This action cannot be undone.')) {
        return;
    }
    
    fetch(`/api/journal/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            showNotification('Journal entry deleted successfully', 'success');
            // Remove the entry from DOM
            const entryElement = buttonElement.closest('.card');
            entryElement.style.opacity = '0';
            entryElement.style.transform = 'translateX(-100%)';
            setTimeout(() => {
                entryElement.remove();
                updateEntryCount();
            }, 300);
        } else {
            throw new Error(data.message || 'Delete failed');
        }
    })
    .catch(error => {
        console.error('Error deleting journal entry:', error);
        showNotification('Error deleting entry. Please try again.', 'danger');
    });
}

function refreshRecentEntries() {
    fetch('/api/journal/recent', {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const container = document.querySelector('.card-body .d-flex.flex-column');
            if (container && data.entries.length > 0) {
                const entriesHtml = data.entries.map(entry => `
                    <div class="card border-0 mb-3 shadow-sm" style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);">
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <small class="text-muted fw-medium">${new Date(entry.created_at).toLocaleDateString('en-US', { month: 'short', day: 'numeric', hour: 'numeric', minute: '2-digit' })}</small>
                                <div class="d-flex gap-2 align-items-center">
                                    <span class="badge rounded-pill px-2 py-1 small" style="background: ${entry.mood ? '#dcfce7' : '#dbeafe'}; color: ${entry.mood ? '#166534' : '#1e40af'}; font-size: 10px;">
                                        ${entry.mood ? entry.mood.charAt(0).toUpperCase() + entry.mood.slice(1) : 'Reflective'}
                                    </span>
                                    <button onclick="deleteJournalEntry(${entry.id}, this)" class="btn btn-sm p-1" style="color: #dc2626; background: none; border: none;" title="Delete entry">
                                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <p class="text-dark fw-medium mb-0" style="line-height: 1.5; font-size: 14px;">${entry.content.length > 120 ? entry.content.substring(0, 120) + '...' : entry.content}</p>
                        </div>
                    </div>
                `).join('');
                const viewButton = container.querySelector('.text-center');
                container.innerHTML = entriesHtml + (viewButton ? viewButton.outerHTML : '');
            }
            updateEntryCount();
        }
    })
    .catch(error => console.error('Error refreshing entries:', error));
}

function updateEntryCount() {
    const entries = document.querySelectorAll('.card-body .card');
    const badge = document.querySelector('.badge.bg-light');
    if (badge) {
        badge.textContent = `${entries.length} entries`;
    }
}

function addToRecentInsights(insight) {
    const container = document.querySelector('.card-body .d-flex.flex-column');
    if (!container) return;
    
    // Remove empty state if it exists
    const emptyState = container.querySelector('.text-center.py-5');
    if (emptyState) {
        emptyState.remove();
    }
    
    // Create new insight element
    const insightHtml = `
        <div class="card border-0 mb-3 shadow-sm" style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <small class="text-muted fw-medium">${new Date(insight.created_at).toLocaleDateString('en-US', { month: 'short', day: 'numeric', hour: 'numeric', minute: '2-digit' })}</small>
                    <div class="d-flex gap-2 align-items-center">
                        <span class="badge bg-primary rounded-pill px-2 py-1 small">Insight</span>
                        <button onclick="deleteAffirmation(${insight.id}, this)" class="btn btn-sm p-1" style="color: #dc2626; background: none; border: none;" title="Delete insight">
                            <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <p class="text-dark fw-medium mb-0" style="line-height: 1.5; font-size: 14px;">${insight.affirmation_text.length > 120 ? insight.affirmation_text.substring(0, 120) + '...' : insight.affirmation_text}</p>
            </div>
        </div>
    `;
    
    // Add to the beginning of the list
    container.insertAdjacentHTML('afterbegin', insightHtml);
    
    // Keep only the 3 most recent
    const cards = container.querySelectorAll('.card');
    if (cards.length > 3) {
        cards[3].remove();
    }
    
    // Update count
    updateEntryCount();
}

function checkEmptyState() {
    const container = document.getElementById('reflections-list');
    const cards = container.querySelectorAll('.card');
    if (cards.length === 0) {
        container.innerHTML = `
            <div class="text-center py-4">
                <svg width="48" height="48" fill="#cbd5e1" viewBox="0 0 24 24" class="mb-3">
                    <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                </svg>
                <h5 class="fw-medium text-dark mb-2">No reflections yet</h5>
                <p class="text-muted mb-0 small">Start journaling to see your reflections here</p>
            </div>
        `;
    }
}
</script>
@endsection