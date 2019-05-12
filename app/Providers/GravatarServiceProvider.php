<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class GravatarServiceProvider extends ServiceProvider
{
    /*
    |--------------------------------------------------------------------------
    | Gravatar ServiceProvider
    |--------------------------------------------------------------------------
    |
    | Класс для получения аватарки через api gravatar
    |
    */

    /**
     * Создание директивы @gravatar() для blade шаблонов, которая выводит тег img с аватаркой пользователя по email
     * Пример использования:
     *  @gravatar($email)
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('gravatar', function ($email) {
            return '<?php echo "<img src=\"https://www.gravatar.com/avatar/" . md5(strtolower(trim(' . $email . '))) . "?d=mp&r=g\" alt=\"\" class=\"img-circle user-avatar\" />" ?>';
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
