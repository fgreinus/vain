<?php namespace Tests\Functional\Modules\User\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Modules\User\Entities\User;
use Tests\TestCase;

/**
 * Created by PhpStorm.
 * User: Otto
 * Date: 12.04.2015
 * Time: 03:05
 */
class UserControllerTest extends TestCase
{

    public function setUp()
    {
        parent::setUp();

        $user = User::findOrFail(1);
        Auth::login($user);
    }

    /**
     * @test
     * @covers Modules\User\Http\Controllers\UserController::show
     */
    public function test_get_show()
    {
        $this->route('GET', 'user.profile', ['id' => 1]);
        $this->assertResponseOk();
    }

    /**
     * @test
     * @covers Modules\User\Http\Controllers\UserController::edit
     */
    public function test_get_edit()
    {
        $this->route('GET', 'user.profile.edit');
        $this->assertResponseOk();
    }

    /**
     * @test
     * @covers Modules\User\Http\Controllers\UserController::update
     */
    public function test_post_update()
    {
        // ToDo
        $this->assertTrue(true);
    }
}
