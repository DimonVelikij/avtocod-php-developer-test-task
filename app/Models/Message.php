<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /*
    |--------------------------------------------------------------------------
    | Message Model
    |--------------------------------------------------------------------------
    |
    | Модель для работы с сообщениями пользователей
    |
    */

    /**
     * Название таблицы
     *
     * @var string
     */
    protected $table = 'messages';

    /**
     * Первичный ключ таблицы
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Определение связи с таблицей пользователей (users)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
