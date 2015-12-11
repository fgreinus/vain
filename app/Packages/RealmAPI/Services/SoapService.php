<?php

namespace Vain\Packages\RealmAPI\Services;

use SoapClient;
use SoapFault;
use SoapParam;

class SoapService
{
    const DEFAULT_TIMEOUT = 300;

    /**
     * @var SoapClient
     */
    protected $client;

    /**
     * @var array
     */
    protected $config;

    /**
     * @var int
     */
    protected $timeout = self::DEFAULT_TIMEOUT;

    /**
     * @return int
     */
    public function getTimeout()
    {
        return $this->timeout;
    }

    /**
     * @param int $timeout
     */
    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;
    }

    /**
     * dismiss soap connection.
     */
    public function __destruct()
    {
        $this->client = null;
    }

    /**
     * @param array $config
     *
     * @return SoapService
     */
    public function configure($config)
    {
        $this->config = [
            'location'           => sprintf('http://%s:%s/', $config['host'], $config['port']),
            'uri'                => 'urn:'.$config['urn'],
            'style'              => SOAP_RPC,
            'login'              => $config['username'],
            'password'           => $config['password'],
            'connection_timeout' => $this->timeout,
        ];

        return $this;
    }

    /**
     * opens connection to soap if not allready done.
     *
     * @return SoapClient
     */
    public function client()
    {
        if ($this->config === null) {
            throw new \InvalidArgumentException('was not configured');
        }

        if ($this->client === null) {
            $this->client = new SoapClient(null, $this->config);
        }

        return $this->client;
    }

    /**
     * Will send a SOAP command to the realm. Will return false if command fails.
     *
     * @param $command
     *
     * @return string|null|bool
     */
    public function send($command)
    {
        // ToDo: logging on success and fail
        try {
            // this may return null although everything worked out fine (e.g. for send mail)
            $response = $this->client()->executeCommand(new SoapParam($command, 'command'));

            // Trinity response for missing command - same for mangos?
            if (strpos($response, 'Es gibt keinen solchen Unterbefehl.') !== false) {
                throw new \InvalidArgumentException('SOAP Befehl existiert nicht');
            }

            return $response;
        } catch (SoapFault $e) {
            // possible exceptions:
            // Could not connect to host
            // HTTP Error: 403 Forbidden
            // Spieler nicht gefunden! (Trinity)
            // ...
            if (config('app.debug')) {
                throw $e;
            }

            return false;
        }
    }
}
