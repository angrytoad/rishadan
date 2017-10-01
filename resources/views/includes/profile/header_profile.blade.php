<div id="header_profile">
    <p>Welcome, {{ Auth::user()->name }}</p>
    <p>
        <a href="{{ route('dashboard') }}">Dashboard</a> | <a href="{{ route('collection') }}">Collection</a> | <a href="{{ route('account') }}">My Account</a> | <a href="{{route('logout')}}">Logout</a>
    </p>
</div>