<?php

namespace Vain\Packages\RealmAPI;

/*
 * Created by PhpStorm.
 * User: Otto
 * Date: 26.01.2015
 * Time: 20:36
 */

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use Vain\Packages\RealmAPI\Models\Character;
use Vain\Packages\RealmAPI\Services\SoapService;

// TODO optimize general cache usage / less repetitive code?
abstract class AbstractEmulator
{
    use Configurator, Cacheable;

    const REALM_TRINITY = 1;

    const REALM_MANGOS = 2;

    /**
     * @var string
     */
    protected $realm;

    /**
     * @var int
     */
    protected $type;

    /**
     * @var array
     */
    protected $connections;

    /**
     * @var SoapService
     */
    protected $soap;

    /**
     * @param $realm
     * @param bool $useCache
     */
    public function __construct($realm, $useCache = true)
    {
        $this->realm = $realm;
        $this->useCache = $useCache;

        $this->type = $this->getTypeConfig($realm);
        $this->connections = $this->getDatabaseConfig($realm);

        $this->setCacheDuration(24 * 60);

        $this->soap = app('Vain\Packages\RealmAPI\Services\SoapService')
            ->configure($this->getSoapConfig($realm));
    }

    /**
     * Get information about running realm (player online, uptime, ...).
     *
     * @return array
     */
    abstract public function getServerStatus();

    // ToDo: some stuff that might be useful
    //public abstract function createAccount();
    //public abstract function banAccount();
    //public abstract function characterCustomizeLook();
    //public abstract function muteAccount();

    /**
     * Returns the realm id.
     *
     * @return int
     */
    public function getRealmType()
    {
        return $this->type;
    }

    /**
     * Get character name by GUID.
     *
     * @param int $guid
     *
     * @return string|null
     */
    public function getCharacterNameByGuid($guid)
    {
        $key = $this->cacheKey(__FUNCTION__, $guid);

        if ($this->useCache && Cache::has($key)) {
            return Cache::get($key);
        }

        $name = DB::connection($this->connections['world'])
            ->table('characters')
            ->where('guid', $guid)
            ->value('name');

        Cache::put($key, $name, $this->cacheDuration);

        return $name;
    }

    /**
     * Get GUID by character name.
     *
     * @param string $name
     *
     * @return int|null
     */
    public function getCharacterGuidByName($name)
    {
        $key = $this->cacheKey(__FUNCTION__, $name);

        if ($this->useCache && Cache::has($key)) {
            return Cache::get($key);
        }

        $guid = DB::connection($this->connections['characters'])
            ->table('characters')
            ->where('name', $name)
            ->value('guid');

        Cache::put($key, $guid, $this->cacheDuration);

        return $guid;
    }

    /**
     * Get associative array (guid => name) of all players online.
     *
     * @return array
     */
    public function getPlayersOnline()
    {
        $key = $this->cacheKey(__FUNCTION__);

        if ($this->useCache && Cache::has($key)) {
            return Cache::get($key);
        }

        $list = DB::connection($this->connections['characters'])
            ->table('characters')
            ->where('online', 1)
            ->lists('name', 'guid');

        Cache::put($key, $list, $this->cacheDuration);

        return $list;
    }

    /**
     * Get character by GUID.
     *
     * @param int $guid
     *
     * @throws InvalidArgumentException
     *
     * @return Character
     */
    public function getCharacter($guid)
    {
        $key = $this->cacheKey(__FUNCTION__, $guid);

        if ($this->useCache && Cache::has($key)) {
            return Cache::get($key);
        }

        $char = Character::on($this->connections['characters'])
            ->find($guid, ['guid', 'account', 'name', 'race', 'class', 'level', 'money']);

        Cache::put($key, $char, $this->cacheDuration);

        return $char;
    }

    /**
     * Send a mail to a player (text only).
     *
     * @param string $name
     * @param string $subject
     * @param string $message
     * @returns bool
     */
    public function sendMail($name, $subject, $message)
    {
        return $this->soap->send('send mail '.$name.' "'.$subject.'" "'.$message.'"') !== false;
    }

    /**
     * Send a global message to all players online in chat log.
     *
     * @param string $message
     * @returns bool
     */
    public function announce($message)
    {
        return $this->soap->send('announce '.$message) !== false;
    }

    /**
     * Get characters by account id.
     *
     * @param int $accountId
     * @returns \Illuminate\Database\Eloquent\Collection|null
     */
    public function getAccountCharacters($accountId)
    {
        $key = $this->cacheKey(__FUNCTION__, $accountId);

        if ($this->useCache && Cache::has($key)) {
            return Cache::get($key);
        }

        $chars = Character::on($this->connections['characters'])
            ->where('account', $accountId)
            ->get(['guid', 'account', 'name', 'race', 'class', 'level', 'money']);

        Cache::put($key, $chars, $this->cacheDuration);

        return $chars;
    }

    /**
     * Send items to a player.
     *
     * @param string    $name
     * @param array|int $items
     * @returns boolean
     */
    public function sendItems($name, $items)
    {
        if (is_array($items)) {
            $items = implode($items, ' ');
        }

        return $this->soap->send('send items '.$name.' "Premium System" "" '.$items) !== false;
    }
}
