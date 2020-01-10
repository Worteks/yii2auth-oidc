<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */
namespace worteks\yii\authclient;

use yii\authclient\OAuth2;

/**
 * Allows OIDC authentication.
 *
 * Set up an OpenID Provider (OP) and configure your Yii2 app as a Relying Party (RP) on your Authentication Server.
 *
 * Example application configuration:
 *
 * ```php
 * 'components' => [
 *    'authClientCollection' => [
 *      'clients' => [
 *         // ...
 *         'oidc' => [
 *             'class' => 'worteks\yii\authclient\OIDC',
 *             'domain' => 'https://auth.example.com',
 *             'clientId' => 'myClientId',
 *             'clientSecret' => 'myClientSecret'
 *         ],
 *      ],
 *     // ...
 * ]
 * ```
 *
 * @author Soisik Froger <soisik.froger@worteks.com>
 * @since 0.1
 */

class OIDC extends OAuth2
{
    /**
     * Authentication server domain
     * @var string
     */
    public $domain;
    /**
     * {@inheritdoc}
     */
    public $authUrl = '/oauth2/authorize';
    /**
     * {@inheritdoc}
     */
    public $tokenUrl = '/oauth2/token';
    /**
     * {@inheritdoc}
     */
    public $apiBaseUrl = '/oauth2';
    /**
     * Userinfo Endpoint
     * @var string
     */
    public $userInfoUrl = 'userinfo';
    /**
     * {@inheritdoc}
     */
    public $scope = 'openid profile email';
    /**
     * {@inheritdoc}
     */
    public $defaultName;
    /**
     * {@inheritdoc}
     */
    public $defaultTitle;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        if ($this->domain == null) {
          throw new Exception('No domain provided.');
        }

        $this->authUrl    = $this->domain.$this->authUrl;
        $this->tokenUrl   = $this->domain.$this->tokenUrl;
        $this->apiBaseUrl = $this->domain.$this->apiBaseUrl;

        if ($this->defaultTitle === null) {
          $this->defaultTitle = $this->getId();
        }

        if ($this->defaultName === null) {
          $this->defaultName = $this->getId();
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function initUserAttributes()
    {
      $accessToken = $this->getAccessToken();
      if (!is_object($accessToken) || !$accessToken->getIsValid()) {
        throw new Exception('Invalid access token.');
      }
      $headers = [
        'Authorization' => 'Bearer ' . $this->getAccessToken()->getToken()
      ];
      return $this->api($this->userInfoUrl, 'GET', [], $headers);
    }

    /**
     * {@inheritdoc}
     */
    public function beforeApiRequestSend($event)
    {
    }

    /**
     * {@inheritdoc}
     */
    protected function defaultName()
    {
        return $this->defaultName;
    }

    /**
     * {@inheritdoc}
     */
    protected function defaultTitle()
    {
        return $this->defaultTitle;
    }
}
