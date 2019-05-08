<?php

namespace App\Http\Controllers\Messenger;

use App\Models\Message;
use App\Http\Requests\MessageController as RequestMessageController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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

    /**
     * Сохранение сообщения пользователя
     *
     * @param RequestMessageController $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addMessage(RequestMessageController $request)
    {
        $this->create($request->all());

        return redirect(route('home'));
    }

    /**
     * Создание нового сообщения
     *
     * @param array $data
     * @return \App\Models\Message
     */
    protected function create(array $data)
    {
        return Message::create([
            'text'      =>  $data['text'],
            'user_id'   =>  Auth::user()->id
        ]);

    }
}
