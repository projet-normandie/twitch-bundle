ProjetNormandieTwitchBundle
===========================

Develop
-------

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/projet-normandie/twitch-bundle/badges/quality-score.png?b=develop)](https://scrutinizer-ci.com/g/projet-normandie/twitch-bundle/?branch=develop)
[![Build Status](https://scrutinizer-ci.com/g/projet-normandie/twitch-bundle/badges/build.png?b=develop)]()


Installation
============

Make sure Composer is installed globally, as explained in the
[installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Open a command console, enter your project directory and execute:

```console
$ composer require projet-normandie/twitch-bundle
```

Then, enable the bundle by adding it to the list of registered bundles
in the `config/bundles.php` file of your project:

```php
// config/bundles.php

return [
    // ...
    ProjetNormandie\TwitchBundle\ProjetNormandieTwitchBundle::class => ['all' => true],
];
```


Configuration
============
```yaml
# config/packages/projet_normandie_twitch.yaml

projet_normandie_twitch:
  client_id: '%env(string:PN_TWITCH_CLIENT_ID)%'
  client_secret: '%env(string:PN_TWITCH_CLIENT_SECRET)%'