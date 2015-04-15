@section("header")
    <div class="header">
        <div class="container">
            <h1>{{ HTML::link('home', 'Sergio\'s Archery(Alpha)') }}</h1>
            @if (Auth::check())
                {{ Auth::user()->username }},
                {{ HTML::link('user/logout', 'Logout') }}
                    |
                {{ HTML::link('user/profile', 'Profile') }}
            @else
                {{ HTML::link('user/login', 'Login') }}
                    |
                {{ HTML::link('account/register', 'Register') }}
                    |
                {{ HTML::link('user/remind', 'Request password') }}
            @endif
        </div>
    </div>
@show