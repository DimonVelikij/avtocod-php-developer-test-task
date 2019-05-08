<?php

namespace App\Http\Controllers\Messenger;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Message Controller
    |--------------------------------------------------------------------------
    |
    | Контроллер для работы с сообщениями пользователей. Выводит список
    | сообщений от всех пользователей, а также позволяет делать отправку
    | авторизованным пользователям.
    |
    */

    /**
     * Вывод списка сообщений пользователей
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listMessages()
    {
        return view('messenger.messages', [
            'messages' => Message::query()->orderBy('id', 'desc')->get()
        ]);
    }
}
