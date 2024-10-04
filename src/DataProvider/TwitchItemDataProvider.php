<?php

namespace ProjetNormandie\TwitchBundle\DataProvider;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use TwitchApi\HelixGuzzleClient;
use TwitchApi\TwitchApi;

final class TwitchItemDataProvider
{
    private ?TwitchApi $client = null;

    private ?string $accessToken = null;

    private string $twitchScopes = '';

    public function __construct(private readonly ParameterBagInterface $params,)
    {
    }

    private function getClient(): TwitchApi
    {
        if (null === $this->client) {
            $helixGuzzleClient = new HelixGuzzleClient($this->params->get('pn.twitch.client_id'));
            $this->client = new TwitchApi(
                $helixGuzzleClient,
                $this->params->get('pn.twitch.client_id'),
                $this->params->get('pn.twitch.client_secret')
            );
        }
        return $this->client;
    }


    private function getAccessToken(): string
    {
        if (null === $this->accessToken) {
            $oauth = $this->getClient()->getOauthApi();
            try {
                $token = $oauth->getAppAccessToken($this->twitchScopes ?? '');
                $data = json_decode($token->getBody()->getContents());

                // Your bearer token
                $this->accessToken = $data->access_token ?? null;
            } catch (Exception $e) {
                //TODO: Handle Error
            } catch (GuzzleException $e) {
            }
        }

        return $this->accessToken;
    }

    public function getStream(string $username)
    {
        $response = $this->getClient()->getStreamsApi()->getStreamForUsername($this->getAccessToken(), $username);
        return json_decode($response->getBody()->getContents());
    }
}
