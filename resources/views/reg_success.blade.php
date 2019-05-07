@extends('layouts.app', ['page_title' => 'Стена сообщений | Регистрация завершена'])

@section('custom_style')
    <!-- Custom style from page -->
@endsection

@section('html_header')
    <!-- Additional header tags -->
@endsection

@section('main_content')

    <div class="container">
        <h1>Ура!</h1>
        <h3>Поздравляем! Вы успешно зарегистрировались.</h3>
        <p>Воспользуйтесь <a href="#">формой авторизации</a> чтобы войти на сайт под своей учетной записью</p>
    </div>

@endsection
