@section('navbar')
    {? $categoriasnav = Category::where('parent_id','=',null)->get(); ?}

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
            @if (Auth::check())
                <li>{{ HTML::link('user/profile', 'Perfil') }}</li>
                
                @if (Auth::user()->admin)
                <li>{{ HTML::link('admin', 'Administrar') }}</li>
                @endif
                
                <li>{{ HTML::link('user/logout', 'Cerrar sesión') }}</li>
            @else
                <li>{{ HTML::link('user/login', 'Entrar') }}</li>
                <li>{{ HTML::link('account/register', 'Registrar') }}</li>
            @endif
            </ul>
            <ul class="nav navbar-nav">
                <li>
                    {{ HTML::link('home', 'Home') }}
                </li>
                @foreach($categoriasnav as $categorianav)
                {? $subcategoriasnav = $categorianav->subcategories ?}
                <li class="dropdown">
                    {{ HTML::link('products/' . $categorianav->name, ucfirst($categorianav->name), [
                        'class' => 'dropdown-toggle',
                        'data-toggle' => 'dropdown',
                        'role' => "button",
                        'aria-expanded' => 'false'
                    ]) }}
                    @if(!$subcategoriasnav->isEmpty())
                    <ul class="dropdown-menu" role="menu">
                        @foreach($subcategoriasnav as $subcategorianav)
                        <li>{{ HTML::link('products/' . $categorianav->name . '/' . $subcategorianav->name, ucfirst($subcategorianav->name)) }}</li>
                        @endforeach
                    </ul>
                    @endif              
                </li>                
                @endforeach
            </ul>
        </div>
      </div>
    </nav>
@show