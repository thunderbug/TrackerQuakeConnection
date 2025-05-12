# Tracker Quake Connection 
[![Build Status](https://scrutinizer-ci.com/g/thunderbug/Tracker-CLI/badges/build.png?b=master)](https://scrutinizer-ci.com/g/thunderbug/Tracker-CLI/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/thunderbug/TrackerQuakeConnection/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/thunderbug/TrackerQuakeConnection/?branch=master)
[![Total Downloads](https://poser.pugx.org/thunderbug/tracker-quake-connection/downloads)](//packagist.org/packages/thunderbug/tracker-quake-connection)
[![Version](https://poser.pugx.org/thunderbug/tracker-quake-connection/version)](//packagist.org/packages/thunderbug/tracker-quake-connection)

A library to interact with a call of duty, wolfenstein, ... master server and the game servers. 
 
## Usage

### Master

The Master class handles the connection with the master server of a certain game. At this moment there is only 1 function within the master server function and this is retrieving a full list of gameservers currently online.

```php
$master = new \Thunderbug\QuakeConnection\Master\Master("Master.game.com", 28910);
$servers = $master->getServerList();
```

The returns a array with Server objects.

### Gameserver

The gameserver class handles the connection to an individual gameserver.

```php
$gameserver = new \Thunderbug\QuakeConnection\Server\Gameserver("192.168.1.100", 28960);
$gameserver->getStatus($cvars, $players);
```
Also you can still retrieve the arrays after doing the getstatus command.
```php
$cvars = $gameserver->getCvars();
$players = $gameserver->getPlayers();
```

Colors are also handled by this library. 
```php
print(\Thunderbug\QuakeConnection\Server\Colors::colorize("^5Thun^6der", ColorType::DARK)); 
//Prints html <span> with color codes
//Depending on the color of the site the color type can be light or dark
print(\Thunderbug\QuakeConnection\Server\Colors::removeColors("^5Thun^6der")); 
//Removes all color codes
```

## Installation

You can download the library via composer:

```composer log
composer require thunderbug/tracker-quake-connection
```