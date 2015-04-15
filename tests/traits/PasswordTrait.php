<?php namespace Tests\Traits;

trait PasswordTrait
{

    /**
     * @return static
     */
    protected function requestResetLink($credentials)
    {
        return $this->visit('password/email')
            ->submitForm('Absenden', $credentials);
    }

    /**
     * @return static
     */
    protected function resetPassword($credentials)
    {
        $credentials['password_confirmation'] = $credentials['password'];

        return $this->visit('password/reset/' . $credentials['token'])
            ->submitForm('submit_password_reset', $credentials);
    }

}
