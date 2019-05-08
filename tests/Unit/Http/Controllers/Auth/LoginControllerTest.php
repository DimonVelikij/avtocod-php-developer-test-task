<?php

namespace Tests\Unit\Http\Controllers\Auth;

use App\Models\User;
use Tests\AbstractTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginControllerTest extends AbstractTestCase
{
    /**
     * Пользователь не авторизован и может просматривать страницу с формой авторизации
     */
    public function testShowLoginForm()
    {
        $response = $this->get(route('login'));

        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }

    /**
     * Пользователь авторизован и не может просматривать страницу с формой авторизации
     */
    public function testNotShowLoginForm()
    {
        $user = factory(User::class)->make();

        $response = $this->actingAs($user)->get(route('login'));

        $response->assertRedirect();
    }

    /**
     * Отправка невалидных данных из формы авторизации
     */
    public function testLoginInCorrect()
    {
        $user = factory(User::class)->create([
            'password'  =>  bcrypt('password')
        ]);

        $response = $this->from(route('login'))->post(route('login-submit'), [
            'email'     =>  $user->email,
            'password'  =>  'invalid-password'
        ]);

        $response->assertRedirect(route('login'));
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    /**
     * Отправка валидных данных из формы авторизации
     */
    public function testLoginCorrect()
    {
        $user = factory(User::class)->create([
            'password'  =>  bcrypt($password = 'password')
        ]);

        $response = $this->post(route('login-submit'), [
            'email'     =>  $user->email,
            'password'  =>  $password,
            'remember'  =>  'on'
        ]);

        $response->assertRedirect();
        $this->assertAuthenticatedAs($user);
    }

    /**
     * Разлогинивание
     */
    public function testLogout()
    {
        $user = factory(User::class)->make();

        $response = $this->actingAs($user)->post(route('logout'));

        $response->assertRedirect();
        $this->assertGuest();
    }
}
