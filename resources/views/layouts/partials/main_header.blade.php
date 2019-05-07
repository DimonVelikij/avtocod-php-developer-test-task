<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('home') }}">Avtocod | Стена сообщений</a>
        </div>
        <ul class="nav navbar-nav">
            <li @if(url()->current() == route('home'))class="active"@endif><a href="{{ route('home') }}">Главная</a></li>
            <li @if(url()->current() == route('auth'))class="active"@endif><a href="{{ route('auth') }}">Авторизация</a></li>
            <li @if(url()->current() == route('reg'))class="active"@endif><a href="{{ route('reg') }}">Регистрация</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="navbar-text"><span class="glyphicon glyphicon-user"></span> %username%</li>
            <li><a href="#"><span class="glyphicon glyphicon-log-out"></span> Выход</a></li>
        </ul>
    </div>
</nav>