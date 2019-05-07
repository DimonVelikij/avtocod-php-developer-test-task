<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('home') }}">Avtocod | Стена сообщений</a>
        </div>
        <ul class="nav navbar-nav">
            <li @if(url()->current() == route('home'))class="active"@endif><a href="{{ route('home') }}">Главная</a></li>
            @if(!Auth::check())
                <li @if(url()->current() == route('auth'))class="active"@endif><a href="{{ route('auth') }}">Авторизация</a></li>
                <li @if(url()->current() == route('register'))class="active"@endif><a href="{{ route('register') }}">Регистрация</a></li>
            @endif
        </ul>
        @if(Auth::check())
            <ul class="nav navbar-nav navbar-right">
                <li class="navbar-text"><span class="glyphicon glyphicon-user"></span> {{ Auth::user()->name }}</li>
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('form-logout').submit();"><span class="glyphicon glyphicon-log-out"></span> Выход</a></li>
            </ul>
            <form id="form-logout" action="{{ route('logout') }}" method="POST" style="display: none">
                {{ csrf_field() }}
            </form>
        @endif
    </div>
</nav>