# Tracker Quake Connection 
[![Build Status](https://travis-ci.com/thunderbug/TrackerQuakeConnection.svg?branch=master)](https://travis-ci.com/thunderbug/TrackerQuakeConnection)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/thunderbug/TrackerQuakeConnection/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/thunderbug/TrackerQuakeConnection/?branch=master)
[![Total Downloads](https://poser.pugx.org/thunderbug/tracker-quake-connection/downloads)](//packagist.org/packages/thunderbug/tracker-quake-connection)
[![Version](https://poser.pugx.org/thunderbug/tracker-quake-connection/version)](//packagist.org/packages/thunderbug/tracker-quake-connection)

A library to interact with a call of duty, wolfenstein, ... master server and the game servers. 
 
## Usage

### Master

The Master class handles the connection with the master server of a certain game. At this moment there is only 1 function within the master server function and this is retrieving a full list of gameservers currently online.

```php
$master = new \Thunderbug\QuakeConnection\Master\Master("master.game.com", 28910);
$servers = $master->getServerList();
```

The returns a array with Server objects.

### Gameserver

The gameserver class handles the connection to an individual gameserver.

## Installation

You can download the library via composer:

`composer require thunderbug/tracker-quake-connection`
