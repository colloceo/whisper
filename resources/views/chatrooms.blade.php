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
            <h1 class="h5 fw-semibold text-dark mb-0">Peer Support</h1>
            <div style="width: 40px;"></div>
        </div>

        <!-- Community Guidelines -->
        <div class="alert alert-success rounded-4 mb-4">
            <div class="d-flex align-items-start gap-3">
                <div class="d-flex align-items-center justify-content-center rounded-circle bg-success bg-opacity-25 flex-shrink-0" style="width: 32px; height: 32px;">
                    <svg width="16" height="16" fill="currentColor" class="text-success" viewBox="0 0 24 24">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <h6 class="fw-semibold mb-1">Safe Space Guidelines</h6>
                    <p class="small mb-0">Be kind, respectful, and supportive. No judgment, only understanding.</p>
                </div>
            </div>
        </div>

        <!-- Active Chatrooms -->
        <div class="mb-4">
            <h2 class="h6 text-dark fw-semibold mb-3">Active Support Groups</h2>
            
            <div class="d-flex flex-column gap-3">
                @foreach($supportGroups as $group)
                <div class="whisper-card p-3" role="button" onclick="joinChatroom('{{ strtolower(str_replace(' ', '', $group->name)) }}')">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-3">
                            <div class="d-flex align-items-center justify-content-center rounded-circle text-white fw-semibold" style="width: 48px; height: 48px; background: @if($group->code == 'AS') linear-gradient(135deg, #3b82f6, #1d4ed8) @elseif($group->code == 'DS') linear-gradient(135deg, #8b5cf6, #7c3aed) @else linear-gradient(135deg, #10b981, #059669) @endif;">
                                {{ $group->code }}
                            </div>
                            <div>
                                <h6 class="fw-semibold text-dark mb-1">{{ $group->name }}</h6>
                                <p class="small text-muted mb-1">{{ $group->description }}</p>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="bg-success rounded-circle" style="width: 8px; height: 8px;"></div>
                                    <span class="small text-muted">{{ $group->online_count }} online</span>
                                </div>
                            </div>
                        </div>
                        <svg width="20" height="20" fill="none" stroke="currentColor" class="text-muted" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="whisper-card p-4">
            <h3 class="h6 text-dark fw-semibold mb-3">Recent Community Activity</h3>
            <div class="d-flex flex-column gap-3">
                @foreach($recentActivities as $activity)
                <div class="d-flex align-items-start gap-3">
                    <div class="d-flex align-items-center justify-content-center rounded-circle @if($activity->user_name == 'Anonymous') bg-primary @elseif($activity->user_name == 'Whisperer') bg-success @else bg-info @endif bg-opacity-25 flex-shrink-0" style="width: 32px; height: 32px;">
                        <span class="@if($activity->user_name == 'Anonymous') text-primary @elseif($activity->user_name == 'Whisperer') text-success @else text-info @endif small fw-semibold">{{ substr($activity->user_name, 0, 1) }}</span>
                    </div>
                    <div class="flex-grow-1">
                        <p class="small text-dark mb-1">{{ $activity->user_name }} {{ $activity->action }} <span class="fw-medium">{{ $activity->group_name }}</span></p>
                        <span class="small text-muted">{{ $activity->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    @include('components.bottom-nav', ['current' => 'chatrooms'])
</div>

<!-- Chat Modal -->
<div class="modal fade" id="chat-modal" tabindex="-1">
    <div class="modal-dialog modal-fullscreen-sm-down modal-dialog-scrollable">
        <div class="modal-content">
            <!-- Chat Header -->
            <div class="modal-header border-bottom">
                <div class="d-flex align-items-center gap-3">
                    <div id="chat-avatar" class="rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;"></div>
                    <div>
                        <h6 id="chat-title" class="fw-semibold mb-0"></h6>
                        <p id="chat-members" class="small text-muted mb-0"></p>
                    </div>
                </div>
                <button type="button" class="btn-close" onclick="closeChatroom()"></button>
            </div>
            
            <!-- Chat Messages -->
            <div class="modal-body p-3" id="chat-messages" style="height: 400px; overflow-y: auto; background: #f8fafc;">
                <!-- Messages will be populated here -->
            </div>
            
            <!-- Chat Input -->
            <div class="modal-footer border-top bg-white p-3">
                <div class="d-flex align-items-center gap-2 w-100">
                    <div class="flex-grow-1">
                        <input 
                            type="text" 
                            id="message-input"
                            class="form-control border-0 rounded-pill px-3 py-2"
                            style="background: #f1f5f9; font-size: 0.9rem;"
                            placeholder="Type your message..."
                            onkeypress="handleKeyPress(event)"
                        >
                    </div>
                    <button onclick="sendMessage()" class="btn rounded-circle p-2" style="background: #0ea5e9; color: white; width: 40px; height: 40px;">
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let currentChatroom = null;
let chatModal = null;
let messagePolling = null;
let lastMessageId = 0;

const chatroomData = {
    anxietysupport: {
        title: 'Anxiety Support',
        members: '23 members online',
        avatar: 'linear-gradient(135deg, #3b82f6, #1d4ed8)',
        messages: [
            { user: 'Anonymous', message: 'Having a tough day with racing thoughts. Anyone else?', time: '2:30 PM', isOwn: false },
            { user: 'Whisperer', message: 'I understand that feeling. Deep breathing helps me sometimes.', time: '2:32 PM', isOwn: false },
            { user: 'You', message: 'Thank you for sharing. You\'re not alone in this.', time: '2:35 PM', isOwn: true }
        ]
    },
    depressionsupport: {
        title: 'Depression Support',
        members: '18 members online',
        avatar: 'linear-gradient(135deg, #8b5cf6, #7c3aed)',
        messages: [
            { user: 'SupportSeeker', message: 'Some days feel heavier than others. Today is one of those days.', time: '1:15 PM', isOwn: false },
            { user: 'CareGiver', message: 'Sending you gentle strength. Heavy days are valid too.', time: '1:18 PM', isOwn: false }
        ]
    },
    generalwellness: {
        title: 'General Wellness',
        members: '31 members online',
        avatar: 'linear-gradient(135deg, #10b981, #059669)',
        messages: [
            { user: 'MorningPerson', message: 'Good morning everyone! What\'s one thing you\'re grateful for today?', time: '9:00 AM', isOwn: false },
            { user: 'Grateful', message: 'I\'m grateful for this supportive community', time: '9:05 AM', isOwn: false },
            { user: 'Sunshine', message: 'Grateful for my morning coffee and this beautiful day!', time: '9:10 AM', isOwn: false }
        ]
    }
};

function joinChatroom(type) {
    currentChatroom = type;
    const data = chatroomData[type];
    
    if (!data) {
        console.error('Chatroom data not found for:', type);
        return;
    }
    
    document.getElementById('chat-title').textContent = data.title;
    document.getElementById('chat-members').textContent = data.members;
    document.getElementById('chat-avatar').style.background = data.avatar;
    document.getElementById('chat-avatar').innerHTML = '<span class="text-white fw-semibold small">' + data.title.split(' ').map(w => w[0]).join('') + '</span>';
    
    const messagesContainer = document.getElementById('chat-messages');
    messagesContainer.innerHTML = '<div class="text-center py-3"><div class="spinner-border" role="status"></div></div>';
    
    // Load messages from database
    fetch(`/api/chat/${type}/messages`, {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        messagesContainer.innerHTML = '';
        if (data.success && data.messages.length > 0) {
            data.messages.forEach(msg => {
                const currentUserEmail = '{{ Session::get("user_email") ?: Session::getId() }}';
                const currentUserName = '{{ Session::get("username", "Anonymous") }}';
                const isOwn = msg.user_email === currentUserEmail || msg.user_name === currentUserName;
                addMessageToChat(msg.user_name, msg.message, new Date(msg.created_at).toLocaleTimeString(), isOwn);
                lastMessageId = Math.max(lastMessageId, msg.id);
            });
        }
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
        
        // Start polling for new messages
        startMessagePolling();
    })
    .catch(error => {
        console.error('Error loading messages:', error);
        messagesContainer.innerHTML = '<div class="text-center py-3 text-muted">No messages yet</div>';
    });
    
    const modal = document.getElementById('chat-modal');
    modal.classList.add('show');
    modal.style.display = 'block';
    modal.removeAttribute('aria-hidden');
    document.body.classList.add('modal-open');
    
    // Add backdrop
    const backdrop = document.createElement('div');
    backdrop.className = 'modal-backdrop fade show';
    backdrop.id = 'chat-backdrop';
    document.body.appendChild(backdrop);
}

function closeChatroom() {
    const modal = document.getElementById('chat-modal');
    const backdrop = document.getElementById('chat-backdrop');
    
    modal.classList.remove('show');
    modal.style.display = 'none';
    modal.removeAttribute('aria-hidden');
    document.body.classList.remove('modal-open');
    
    if (backdrop) {
        backdrop.remove();
    }
    
    // Stop polling when closing chat
    if (messagePolling) {
        clearInterval(messagePolling);
        messagePolling = null;
    }
    
    currentChatroom = null;
    lastMessageId = 0;
}

function sendMessage() {
    const input = document.getElementById('message-input');
    const message = input.value.trim();
    
    if (!message || !currentChatroom) return;
    
    input.disabled = true;
    
    fetch('/api/chat/send', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            message: message,
            support_group: currentChatroom
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            addMessageToChat('You', message, 'Just now', true);
            lastMessageId = Math.max(lastMessageId, data.message.id);
            input.value = '';
        }
        input.disabled = false;
    })
    .catch(error => {
        console.error('Error sending message:', error);
        input.disabled = false;
    });
}

function addMessageToChat(user, message, time, isOwn) {
    const messagesContainer = document.getElementById('chat-messages');
    const messageDiv = document.createElement('div');
    messageDiv.className = `d-flex mb-2 ${isOwn ? 'justify-content-end' : 'justify-content-start'}`;
    
    const messageStyle = isOwn 
        ? 'background: linear-gradient(135deg, #0ea5e9, #0284c7); color: white; border-radius: 18px 18px 4px 18px;'
        : 'background: #f1f5f9; color: #1e293b; border-radius: 18px 18px 18px 4px;';
    
    messageDiv.innerHTML = `
        <div class="position-relative" style="max-width: 75%;">
            <div class="px-3 py-2 shadow-sm" style="${messageStyle}">
                ${!isOwn ? `<div class="fw-semibold mb-1" style="font-size: 0.75rem; opacity: 0.8;">${user}</div>` : ''}
                <div class="mb-1" style="font-size: 0.9rem; line-height: 1.4;">${message}</div>
                <div class="text-end" style="font-size: 0.7rem; opacity: 0.7; margin-top: 2px;">${time}</div>
            </div>
            ${isOwn ? '<div class="position-absolute" style="bottom: 2px; right: -8px; width: 0; height: 0; border-left: 8px solid #0284c7; border-top: 8px solid transparent;"></div>' : '<div class="position-absolute" style="bottom: 2px; left: -8px; width: 0; height: 0; border-right: 8px solid #f1f5f9; border-top: 8px solid transparent;"></div>'}
        </div>
    `;
    messagesContainer.appendChild(messageDiv);
    messagesContainer.scrollTop = messagesContainer.scrollHeight;
}

function startMessagePolling() {
    if (messagePolling) {
        clearInterval(messagePolling);
    }
    
    messagePolling = setInterval(() => {
        if (!currentChatroom) return;
        
        fetch(`/api/chat/${currentChatroom}/messages?after=${lastMessageId}`, {
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success && data.messages.length > 0) {
                data.messages.forEach(msg => {
                    const currentUserEmail = '{{ Session::get("user_email") ?: Session::getId() }}';
                    const currentUserName = '{{ Session::get("username", "Anonymous") }}';
                    const isOwn = msg.user_email === currentUserEmail || msg.user_name === currentUserName;
                    addMessageToChat(msg.user_name, msg.message, new Date(msg.created_at).toLocaleTimeString(), isOwn);
                    lastMessageId = Math.max(lastMessageId, msg.id);
                });
            }
        })
        .catch(error => console.error('Error polling messages:', error));
    }, 2000); // Poll every 2 seconds
}

function handleKeyPress(event) {
    if (event.key === 'Enter') {
        sendMessage();
    }
}
</script>
@endsection