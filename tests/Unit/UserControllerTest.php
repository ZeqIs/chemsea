<?php

namespace Tests\Unit;

use App\Http\Controllers\UserController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use PHPUnit\Framework\TestCase;

class UserControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_index()
    {
        $userController = new UserController();
        $response = $userController->index();
        $response->assertStatus(200);
    }
}
