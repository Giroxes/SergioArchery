@section("header")
    <div class="header">
        <div class="container">
            <h1>Tutorial</h1>
            @if (Auth::check())
                {{ HTML::link('user/logout', 'Logout') }}
                    |
                {{ HTML::link('user/profile', 'Profile') }}
            @else
                {{ HTML::link('user/login', 'Login') }}
                    |
                {{ HTML::link('user/remind', 'Request password') }}
            @endif
        </div>
    </div>
@show