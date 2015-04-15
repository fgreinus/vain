<?php namespace Tests\Traits;

use Laracasts\TestDummy\Factory as TestDummy;

trait UserTrait
{

    /**
     * @param array $overrides
     * @return \Modules\User\Entities\User
     */
    protected function createUser(array $overrides = [])
    {
        return TestDummy::create('Modules\User\Entities\User', $overrides);
    }

}
