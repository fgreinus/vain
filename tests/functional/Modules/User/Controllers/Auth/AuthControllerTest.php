<?php namespace Tests\Functional\Modules\User\Controllers\Auth;

use Auth;
use Tests\Traits\AuthTrait;
use Tests\TestCase;
use Tests\Traits\UserTrait;
use URL;

class AuthControllerTest extends TestCase
{

    use AuthTrait, UserTrait;

    /**
     * @test
     * @covers Modules\User\Http\Controllers\Auth\AuthController::postLogin
     */
    public function it_logs_a_user_in()
    {
        $this->createUser(['email' => 'foo@vain.app', 'password' => bcrypt('123456')]);

        $this->login(['email' => 'foo@vain.app', 'password' => '123456'])
            ->onPage(URL::route('index.home'));
    }

    /**
     * @test
     * @covers Modules\User\Http\Controllers\Auth\AuthController::postLogin
     */
    public function it_notifies_a_user_of_login_errors()
    {
        $this->login(['email' => 'foo@vain.app', 'password' => '123456'])
            ->assertSessionHasErrors('email');
    }

    /**
     * @test
     * @covers Modules\User\Http\Controllers\Auth\AuthController::getLogout
     */
    public function it_logs_a_user_out()
    {
        $this->be($this->createUser());

        $this->logout()
            ->onPage(URL::route('index'));

        $this->assertTrue(Auth::guest());
    }

    /**
     * @test
     * @covers Modules\User\Http\Controllers\Auth\AuthController::postRegister
     */
    public function it_registers_a_user()
    {
        $credentials = ['email' => 'foo@vain.app'];

        $this->register($credentials)
            ->verifyInDatabase('users', $credentials)
            ->seePageIs('/home');
    }

    /**
     * @test
     * @covers Modules\User\Http\Controllers\Auth\AuthController::postRegister
     */
    public function it_notifies_a_user_of_registration_errors()
    {
        $this->createUser($overrides = ['email' => 'foo@vain.app']);

        $this->register($overrides)
            ->onPage('auth/register')
            ->assertSessionHasErrors('email');
    }

    /**
     * @test
     */
    public function it_prevents_a_user_from_accessing_protected_routes()
    {
        // user profile as example for auth middleware
        $this->visit(URL::route('user.profile', ['id' => 1]))
            ->onPage('auth/login');
    }

    // ToDo: admin middleware NYI
//    /**
//     * @test
//     */
//    public function it_prevents_a_user_from_accessing_the_backend()
//    {
//        $this->be($this->createUser());
//
//        $this->visit(URL::route('user.admin.users.index'));
//    }

}
