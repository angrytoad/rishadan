<div id="header">
    <div id="header_bg"></div>
    <div id="center_wrapper">
        @include('includes.menu')
        @include('includes.branding')
        @if(Auth::check())
            @include('includes.profile.header_profile')
        @else
            @include('includes.login_form')
        @endif
    </div>
</div>
