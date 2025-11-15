<!-- Bottom Navigation -->
<div class="fixed-bottom bottom-nav py-2">
    <div class="container-fluid">
        <div class="row text-center">
            <div class="col">
                <a href="{{ route('home') }}" class="nav-item text-decoration-none {{ $current === 'home' ? 'active' : '' }}">
                    <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                    </svg>
                    <div class="small">Home</div>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('journal') }}" class="nav-item text-decoration-none {{ $current === 'journal' ? 'active' : '' }}">
                    <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                    </svg>
                    <div class="small">Journal</div>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('chatrooms') }}" class="nav-item text-decoration-none {{ $current === 'chatrooms' ? 'active' : '' }}">
                    <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12,3C6.5,3 2,6.58 2,11A7.18,7.18 0 0,0 2.64,14.25L1,22L8.75,20.36C9.81,20.75 10.87,21 12,21C17.5,21 22,17.42 22,13C22,8.58 17.5,5 12,5M12,3Z"/>
                    </svg>
                    <div class="small">Chat</div>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('crisis') }}" class="nav-item text-decoration-none {{ $current === 'crisis' ? 'active' : '' }}">
                    <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,17A1.5,1.5 0 0,1 10.5,15.5A1.5,1.5 0 0,1 12,14A1.5,1.5 0 0,1 13.5,15.5A1.5,1.5 0 0,1 12,17M12,13A1,1 0 0,1 11,12V8A1,1 0 0,1 12,7A1,1 0 0,1 13,8V12A1,1 0 0,1 12,13Z"/>
                    </svg>
                    <div class="small">Crisis</div>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('profile') }}" class="nav-item text-decoration-none {{ $current === 'profile' ? 'active' : '' }}">
                    <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12,4A4,4 0 0,1 16,8A4,4 0 0,1 12,12A4,4 0 0,1 8,8A4,4 0 0,1 12,4M12,14C16.42,14 20,15.79 20,18V20H4V18C4,15.79 7.58,14 12,14Z"/>
                    </svg>
                    <div class="small">Profile</div>
                </a>
            </div>
        </div>
    </div>
</div>