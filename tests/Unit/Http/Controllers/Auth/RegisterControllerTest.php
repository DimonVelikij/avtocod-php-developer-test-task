<?php

namespace Tests\Unit\Http\Controllers\Auth;

use App\Models\User;
use Tests\AbstractTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterControllerTest extends AbstractTestCase
{
    /**
     * Пользователь не авторизован и может просматривать страницу с формой регистрации
     */
    public function testShowRegistrationForm()
    {
        $response = $this->get(route('register'));

        $response->assertSuccessful();
        $response->assertViewIs('auth.register');
    }

    /**
     * Пользователь авторизован и не может просматривать страницу с формой регистрации
     */
    public function testNotShowRegistrationForm()
    {
        $user = factory(User::class)->make();

        $response = $this->actingAs($user)->get(route('register'));

        $response->assertRedirect();
    }

    /**
     * Отправка невалидных данных из формы регистрации
     */
    public function testRegisterInCorrect()
    {
        $response = $this->from(route('register'))->post(route('register-submit'), [
            'name'                  =>  'user',
            'email'                 =>  'username@mail.ru',
            'password'              =>  '1',
            'password_confirmation' =>  '1'
        ]);

        $response->assertRedirect(route('register'));
        $this->assertDatabaseMissing('users', [
            'email' =>  'username@mail.ru'
        ]);
        $response->assertSessionHasErrors('name');
        $response->assertSessionHasErrors('password');
        $response->assertSessionHasErrors('password_confirmation');
    }

    /**
     * Отправка валидных данных из формы регистрации
     */
    public function testRegisterCorrect()
    {
        $response = $this->from(route('register'))->post(route('register-submit'), [
            'name'                  =>  'username',
            'email'                 =>  'username@mail.ru',
            'password'              =>  '123qweASD',
            'password_confirmation' =>  '123qweASD'
        ]);

        $response->assertRedirect(route('register-success'));
        $this->assertDatabaseHas('users', [
            'email' =>  'username@mail.ru'
        ]);
        $response->assertSessionMissing('errors');
    }
}
