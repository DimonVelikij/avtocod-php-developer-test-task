<?php

namespace Tests\Unit\Http\Controllers\Messenger;

use App\Models\Message;
use App\Models\User;
use Tests\AbstractTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MessageControllerTest extends AbstractTestCase
{
    /**
     * Вывод списка сообщений пользователей
     */
    public function testListMessages()
    {
        $response = $this->get(route('home'));

        $response->assertSuccessful();
        $response->assertViewIs('messenger.messages');
        $messages = Message::all();

        foreach ($messages as $message) {
            $this->assertContains($message->text, $response->getContent());
        }
    }

    /**
     * Неавторизованный пользователь не видит форму отправки сообщения
     */
    public function testNotShowMessageForm()
    {
        $response = $this->get(route('home'));

        $this->assertNotContains('<form action="' . route('add-message') . '" method="POST" class="form-horizontal" novalidate>', $response->getContent());
    }

    /**
     * Авторизованный пользователь видит форму отправки сообщения
     */
    public function testShowMessageForm()
    {
        $user = factory(User::class)->make();

        $response = $this->actingAs($user)->get(route('home'));

        $this->assertContains('<form action="' . route('add-message') . '" method="POST" class="form-horizontal" novalidate>', $response->getContent());
    }

    /**
     * Пользователь отправляет невадиное сообщение
     */
    public function testAddIncorrectMessage()
    {
        $user = factory(User::class)->make();

        $response = $this->actingAs($user)->post(route('add-message'), [
            'text'  =>  ''
        ]);

        $response->assertRedirect();
        $response->assertSessionHasErrors('text');
    }

    /**
     * Пользователь отправил валидное сообщение
     */
    public function testAddCorrectMessage()
    {
        $initialCount = Message::query()->count();

        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post(route('add-message'), [
            'text'  =>  'Hello!'
        ]);

        $response->assertRedirect();
        $response->assertSessionMissing('errors');
        $finalCount = Message::query()->count();
        $this->assertEquals($initialCount + 1, $finalCount);
    }

    /**
     * Пользователь удаляет сообщение
     */
    public function testDeleteMessage()
    {
        $user = factory(User::class)->create();
        $message = factory(Message::class)->create(['user_id' => $user->id]);

        $initialCount = Message::query()->count();

        $response = $this->actingAs($user)->post(route('delete-message', ['id' => $message->id]));

        $response->assertRedirect();
        $finalCount = Message::query()->count();
        $this->assertEquals($initialCount - 1, $finalCount);
    }
}
