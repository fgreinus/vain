<?php namespace Tests\Functional\Modules\User\Controllers\Auth;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Mockery;
use Modules\User\Entities\User;
use Tests\TestCase;

/**
 * Created by PhpStorm.
 * User: Otto
 * Date: 12.04.2015
 * Time: 01:27
 */
class PasswordControllerTest extends TestCase
{

    /**
     * @test
     * @covers Modules\User\Http\Controllers\Auth\PasswordController::postEmail
     * @covers Modules\User\Http\Controllers\Auth\PasswordController::postReset
     * @group current
     */
//    public function user_can_reset_password()
//    {
//        $inputData = [
//            'email'                 => 'admin@vain.app',
//            'password'              => '123456',
//            'password_confirmation' => '123456',
//        ];
//
//        Mail::shouldReceive('send')->once();
//
//        $this->visit('password/email')
//            ->fill('admin@vain.app', 'email')
//            ->press('Absenden')
//            ->onPage('password/email')
//            ->assertSessionHas('status');
//
//        $user = User::whereEmail($inputData['email'])->first();
//
//        $this->visit('password/reset/' . $user->remember_token)
//            ->fill($inputData['email'], 'email')
//            ->fill($inputData['password'], 'password')
//            ->fill($inputData['password_confirmation'], 'password_confirmation')
//            ->press('submit_password_reset')
//            ->onPage(URL::route('index'));
//    }

    /**
     * @test
     * @covers Modules\User\Http\Controllers\Auth\PasswordController::postEmail
     */
    public function user_can_not_request_password_reset_link_if_mail_not_present()
    {
        Mail::shouldReceive('send')->never();

        $this->visit('password/email')
            ->fill('nonexisting@vain.app', 'email')
            ->press('Absenden')
            ->onPage('password/email')
            ->assertSessionHasErrors('email');
    }

    /**
     * @test
     * @covers Modules\User\Http\Controllers\Auth\PasswordController::postReset
     */
    public function user_can_not_reset_password_with_invalid_data()
    {
        $inputData = [
            'email'                 => 'nonexisting@vain.app',
            'password'              => '123456',
            'password_confirmation' => '123456',
            'token'                 => 'token321',
        ];

        $this->visit('password/reset/' . $inputData['token'])
            ->fillForm('Passwort', $inputData);
        $this->press('Passwort')
            ->onPage('password/reset/' . $inputData['token'])
            ->assertSessionHasErrors('email');
    }

}
