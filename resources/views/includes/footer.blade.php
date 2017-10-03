<div id="footer">
    <div id="footer_bg"></div>
    <div id="center_wrapper">
        <div id="left_footer">
            <ul>
                @if(Auth::check())
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('collection') }}">Collection</a></li>
                    <li><a href="{{ route('account') }}">My Account</a></li>
                @else
                    <li><a href="{{ route('register') }}">Create an Account</a></li>
                    <li><a href="{{ route('login') }}">Login</a></li>
                @endif
            </ul>
        </div>
        <div id="mid_footer">
            <ul>
                <li><a href="{{ route('privacy policy') }}">Privacy Policy</a></li>
                <li><a href="{{ route('terms conditions') }}">Terms & Conditions</a></li>
                <li><a href="{{ route('about us') }}">About Us</a></li>
            </ul>
        </div>
        <div id="copyright">
            <p>&copy; Rishadan.com {{ \Carbon\Carbon::now()->format('Y') }}</p>
        </div>
        @include('includes.branding')
    </div>
</div>