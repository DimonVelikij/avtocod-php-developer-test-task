<?php

namespace Tests\Unit\Http\Controllers\Messenger;

use App\Models\Message;
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
}
