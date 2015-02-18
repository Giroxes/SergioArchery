@section("header")
    <div class="header">
        <div class="container">
            <h1>Tutorial</h1>
            @if (Auth::check())
                <a href="{{ URL::route("user/logout") }}">
                    logout
                </a>
                    |
                <a href="{{ URL::route("user/profile") }}">
                    profile
                </a>
            @else
                <a href="{{ URL::route("user/login") }}">
                login
                </a>
                    |
                <a href="{{ URL::route("user/request") }}">
                    ¿Has olvidado tu contraseña?
                </a>
            @endif
        </div>
    </div>
@show