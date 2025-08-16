<div class="topbar">
    <div class="brand">
        <span class="dot"></span>
        <span>E- Shop</span>
    </div>

    {{-- User Avatar with Dropdown --}}
    <div class="user-avatar-wrapper" onclick="toggleDropdown()">
        <div class="user-avatar" style="width:40px; height:40px; border-radius:50%; overflow:hidden;">
            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" 
                 alt="User Avatar" 
                 style="width:100%; height:100%; object-fit:cover;">
        </div>

        <div id="userDropdown" class="dropdown-menu-custom">
            <p class="username">{{ Auth::user()->name ?? 'User Name' }}</p>
            <a href="{{route('userProfile')}}">Profile</a>
            <form method="POST" action="{{route('logout')}}">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </div>
</div>