<?php namespace Tests\Traits;

use Laracasts\TestDummy\Factory as TestDummy;

trait AuthTrait
{

    /**
     * @param array $overrides
     * @return static
     */
    protected function register(array $overrides = [])
    {
        $fields = $this->getRegisterFields($overrides);

        return $this->visit('auth/register')
            ->submitForm('Registrieren', $fields);
    }

    /**
     * @param array $overrides
     * @return array
     */
    protected function getRegisterFields(array $overrides)
    {
        $user = TestDummy::attributesFor('Modules\User\Entities\User', $overrides);
        return $user + ['password_confirmation' => $user['password']];
    }

    /**
     * @param array $credentials
     * @return static
     */
    protected function login(array $credentials = [])
    {
        return $this->visit('auth/login')
            ->submitForm('Anmelden', $credentials);
    }

    /**
     * @return static
     */
    protected function logout()
    {
        return $this->visit('auth/logout');
    }

}
