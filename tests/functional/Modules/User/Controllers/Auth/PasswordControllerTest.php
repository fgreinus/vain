<?php namespace Tests\Functional\Modules\User\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Mockery;
use Tests\TestCase;
use Tests\Traits\PasswordTrait;
use Tests\Traits\UserTrait;

class PasswordControllerTest extends TestCase
{

    use PasswordTrait, UserTrait;

    public function tearDown()
    {
        parent::tearDown();
        Mockery::close();
    }

    /**
     * @test
     * @covers Modules\User\Http\Controllers\Auth\PasswordController::postEmail
     * @covers Modules\User\Http\Controllers\Auth\PasswordController::postReset
     */
    public function it_resets_a_users_password()
    {
        $this->createUser($credentials = ['email' => 'foo@vain.app']);

        Mail::shouldReceive('send')->once();

        // request mail with password reset token
        $this->requestResetLink($credentials)
            ->seeInDatabase('password_resets', $credentials)
            ->assertSessionHas('status');

        // reset password with token
        $token = DB::table('password_resets')->where('email', $credentials['email'])->pluck('token');
        $this->resetPassword($credentials += ['password' => 'newpassword', 'token' => $token])
            ->onPage(URL::route('index.home'))
            ->assertTrue(Auth::check());
    }

    /**
     * @test
     * @covers Modules\User\Http\Controllers\Auth\PasswordController::postEmail
     */
    public function it_notifies_a_user_of_password_reset_errors()
    {
        $this->requestResetLink(['email' => 'nonexisting@vain.app'])
            ->onPage('password/email')
            ->assertSessionHasErrors('email');
    }

    /**
     * @test
     * @covers Modules\User\Http\Controllers\Auth\PasswordController::postReset
     */
    public function it_does_not_reset_a_password_when_given_a_wrong_token()
    {
        $this->createUser($credentials = ['email' => 'foo@vain.app']);

        Mail::shouldReceive('send')->once();

        // request mail with password reset token
        $this->requestResetLink($credentials)
            ->seeInDatabase('password_resets', $credentials)
            ->assertSessionHas('status');

        // reset password with token
        $token = 'somewrongtoken';
        $this->resetPassword($credentials + ['password' => 'newpassword', 'token' => $token])
            ->onPage('password/reset/' . $token)
            ->assertSessionHasErrors('email');
    }

}
