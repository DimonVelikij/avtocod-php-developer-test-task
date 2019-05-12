<?php

namespace Tests\Unit\Providers;

use Tests\AbstractTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GravatarServiceProviderTest extends AbstractTestCase
{
    private $blade;

    public function setUp()
    {
        parent::setUp();

        $this->blade = resolve('blade.compiler');
    }

    /**
     * Получение тега img с gravatar
     */
    public function testGravatarImg()
    {
        $output = $this->compileDirective('@gravatar($email)', ['email' => 'user@mail.ru']);

        $this->assertEquals('<img src="https://www.gravatar.com/avatar/47902307cf8ed6cfb1ebd6bfea31dcd0?d=mp&r=g" alt="" class="img-circle user-avatar" />', $output);
    }

    /**
     * Компиляция директивы
     *
     * @param $directive
     * @param array $variables
     * @return string
     */
    private function compileDirective($directive, $variables = [])
    {
        $compiled = $this->blade->compileString($directive);

        ob_start();
        extract($variables);
        eval('?>' . $compiled . '<?php ');

        return ob_get_clean();
    }
}
