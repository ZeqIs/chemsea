<?php

namespace Tests\Unit;

use App\Models\Application;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Routing\Route;
use PHPUnit\Framework\TestCase;

class UserModelTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    use RefreshDatabase, WithFaker;

    public function testUserCreation()
    {
        $user = User::make([
            'title' => 'Mr.',
            'first_name' => 'Ali',
            'last_name' => 'Mydin',
            'phone_num' => '012345789',
            'email' => 'test@test.com',
            'password' => 'Password@123',
            'scientist' => '0',
            'company_id' => '1'

        ]);
        $user->assertTrue();
    }
}
