<?php namespace Tests\Functional\Modules\User\Controllers\Auth;

use Auth;
use Illuminate\Support\Facades\Session;
use Mockery;
use Modules\User\Entities\User;
use Tests\TestCase;
use URL;

/**
 * Created by PhpStorm.
 * User: Otto
 * Date: 11.04.2015
 * Time: 15:44
 */
class AuthControllerTest extends TestCase
{

    /**
     * @test
     * @covers Modules\User\Http\Controllers\Auth\AuthController::postLogin
     */
    public function user_can_login()
    {
        // make sure account is valid
        $this->assertTrue(Auth::attempt(['email' => 'admin@vain.app', 'password' => '123456'], false, false));

        $this->visit('auth/login')
            ->see('Anmelden')
            ->fill('admin@vain.app', 'email')
            ->fill('123456', 'password')
            ->press('Anmelden')
            ->onPage('/home')
            ->see('You are logged in');

        $this->assertTrue(Auth::check());
    }

    /**
     * @test
     * @covers Modules\User\Http\Controllers\Auth\AuthController::postLogin
     */
    public function user_can_not_login_with_invalid_data()
    {
        // make sure account is valid
        $this->assertTrue(Auth::attempt(['email' => 'admin@vain.app', 'password' => '123456'], false, false));

        $this->visit('auth/login')
            ->see('Anmelden')
            ->fill('admin@vain.app', 'email')
            ->fill('654321', 'password')
            ->press('Anmelden')
            ->onPage('auth/login');

        $this->assertSessionHasErrors('email');
        $this->assertTrue(Auth::guest());
    }

    /**
     * @test
     * @covers Modules\User\Http\Controllers\Auth\AuthController::getLogout
     */
    public function user_can_logout()
    {
        $this->assertTrue(Auth::attempt(['email' => 'admin@vain.app', 'password' => '123456']));

        $this->visit('auth/logout')
            ->onPage(URL::route('index'));

        $this->assertTrue(Auth::guest());
    }

    // ToDo: add locale input to registration form
//    /**
//     * @test
//     * @covers Modules\User\Http\Controllers\Auth\AuthController::postRegister
//     * @group integrated
//     */
//    public function guest_can_register()
//    {
//        $userData = [
//            'name'                  => 'Hanspeter',
//            'email'                 => 'hanspeter@vain.app',
//            'password'              => '123456',
//            'password_confirmation' => '123456',
//            'locale'                => 'de',
//        ];
//
//        $mockedUser = Mockery::mock('User');
//        $mockedUser->shouldReceive('create')->once()->andReturn(null);
//
//        $this->visit('auth/register')
//            ->fillform('Registrieren', $userData)
//            ->press('Registrieren')
//            ->onPage('/home');
//    }

    /**
     * @test
     */
    public function guest_can_not_access_protected_routes()
    {
        // user profile as example for auth middleware
        $this->visit(URL::route('user.profile', ['id' => 1]))
            ->onPage('auth/login');
    }

}
