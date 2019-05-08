<?php

namespace App\Http\Controllers\Messenger;

use App\Models\Message;
use App\Http\Requests\AddMessageController as RequestAddMessageController;
use App\Http\Requests\DeleteMessageController as RequestDeleteMessageController;
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
     * @param RequestAddMessageController $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addMessage(RequestAddMessageController $request)
    {
        $this->create($request->all());

        return redirect(route('home'));
    }

    /**
     * Удаление сообщения пользователя
     *
     * @param RequestDeleteMessageController $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function deleteMessage(RequestDeleteMessageController $request)
    {
        $this->delete($request->route('id'));

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

    /**
     * Удаление сообщения
     *
     * @param int $id
     * @return mixed
     */
    protected function delete(int $id)
    {
        return Message::query()->where('id', $id)->delete();
    }
}
