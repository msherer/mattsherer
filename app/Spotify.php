<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spotify extends Model
{
    /** @var string  */
    protected $table = 'spotify_widgets';

    /** @var array  */
    protected $fillable = ['name', 'client_id', 'client_secret_id', 'redirect_uri'];

    /** @var null  */
    protected $clientId = null;

    /** @var null  */
    protected $clientSecretId = null;

    protected $authorizationToken = null;

    protected $baseUrl = 'https://accounts.spotify.com';

    protected $redirectUri = null;

    public function __construct(array $attributes = [])
    {
        parent::__construct();

        if (isset($attributes['client_id'])) {
            $this->clientId = $attributes['client_id'];
        }

        if (isset($attributes['client_secret_id'])) {
            $this->clientSecretId = $attributes['client_secret_id'];
        }

        if (isset($attributes['redirect_uri'])) {
            $this->redirectUri = $attributes['redirect_uri'];
        }
    }

    /**
     * @param $clientId
     * @return $this
     */
    public function setClientId($clientId)
    {
        if ($this->clientId === null) {
            $this->clientId = $clientId;
        }
        return $this;
    }

    /**
     * @param $clientSecretId
     * @return $this
     */
    public function setClientSecretId($clientSecretId)
    {
        if ($this->clientSecretId === null) {
            $this->clientSecretId = $clientSecretId;
        }
        return $this;
    }


    public function requestCurrentPlayingTrack()
    {
        if ($this->authorizationToken === null) {
            $this->requestAuthorizeToken();
        }
    }

    public function requestAuthorizeToken()
    {
        $endpoint = '/authorize';
        $callback = 'http://bit.ly/2tZDXl9';
        $ch = curl_init($this->baseUrl . $endpoint .
            '?client_id=' . $this->clientId .
            '&redirect_uri=' . urlencode($callback) .
            '&response_type=code'
        );
        curl_setopt($ch, CURLOPT_POST, 0);

        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
}
