<?php

namespace Tests\Unit\Http\Controllers\Auth;

use App\Models\User;
use Tests\AbstractTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginControllerTest extends AbstractTestCase
{
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
