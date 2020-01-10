# worteks/yii2auth-oidc

This extension adds [OIDC](https://openid.net/specs/openid-connect-core-1_0.html) support for [yii2-authclient](https://github.com/yiisoft/yii2-authclient).

[![Latest Stable Version](https://poser.pugx.org/worteks/yii2auth-oidc/v/stable)](https://packagist.org/packages/worteks/yii2auth-oidc)
[![Total Downloads](https://poser.pugx.org/worteks/yii2auth-oidc/downloads)](https://packagist.org/packages/worteks/yii2auth-oidc)
[![Monthly Downloads](https://poser.pugx.org/worteks/yii2auth-oidc/d/monthly)](https://packagist.org/packages/worteks/yii2auth-oidc)
[![License](https://poser.pugx.org/worteks/yii2auth-oidc/license)](https://packagist.org/packages/worteks/yii2auth-oidc)

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require worteks/yii2auth-oidc
```

or add

```json
"worteks/yii2auth-oidc": "~0.2"
```

to the `require` section of your composer.json.

## Usage

You must read the yii2-authclient [docs](https://github.com/yiisoft/yii2/blob/master/docs/guide/security-auth-clients.md)

Set up an OpenID Provider (OP) and configure your Yii2 app as a Relying Party (RP) on your Authentication Server.

Example application configuration:

```php
'components' => [
   'authClientCollection' => [
     'clients' => [
        // ...
        'oidc' => [
          'class' => 'worteks\yii\authclient\OIDC',
          'domain' => 'https://auth.example.com',
          'clientId' => 'myClientId',
          'clientSecret' => 'myClientSecret',
        ],
     ],
    // ...
]
```

| Configuration   | Mandatory | Default to             | Description                                |
|-----------------|-----------|------------------------|--------------------------------------------|
| domain          | yes       |                        | URL of your authentication server          |
| clientId        | yes       |                        | Your client id                             |
| clientSecret    | yes       |                        | Your client secret                         |
| authUrl         | no        | '/oauth2/authorize'    | Authorization Endpoint                     |
| tokenUrl        | no        | '/oauth2/token'        | Token Endpoint                             |
| apiBaseUrl      | no        | '/oauth2'              | Base for Userinfo Endpoint                 |
| userInfoUrl     | no        | 'userinfo'             | Userinfo Endpoint                          |
| scope           | yes       | 'openid profile email' | What access privileges are being requested |
| defaultName     | no        | Yii auth client id     | Auth service name to use in DB record, CSS |
| defaultTitle    | no        | Yii auth client id     | Auth service title to display in views     |
