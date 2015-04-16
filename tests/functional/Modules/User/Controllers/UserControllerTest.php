<?php namespace Tests\Functional\Modules\User\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Modules\User\Entities\User;
use Tests\TestCase;
use Tests\Traits\UserTrait;

/**
 * Created by PhpStorm.
 * User: Otto
 * Date: 12.04.2015
 * Time: 03:05
 */
class UserControllerTest extends TestCase
{

    use UserTrait;

    /**
     * @test
     * @covers Modules\User\Http\Controllers\UserController::show
     */
    public function it_shows_a_user()
    {
        $this->be($user = $this->createUser());

        $this->visit(URL::route('user.profile', $user->id))
            ->see($user->name);
    }

    /**
     * @test
     * @covers Modules\User\Http\Controllers\UserController::edit
     * @covers Modules\User\Http\Controllers\UserController::update
     */
    public function it_edits_a_user()
    {
        $this->be($user = $this->createUser());

        $this->visit(URL::route('user.profile.edit'))
            ->submitForm('Speichern', ['city' => 'footown'])
            ->seeInDatabase('users', ['email' => $user->email, 'city' => 'footown'])
            ->onPage(URL::route('user.profile', $user->id));
    }

    // ToDo: verify validation errors

}
