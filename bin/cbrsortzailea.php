#!/usr/bin/env php
<?php

$loader = require_once __DIR__.'/../vendor/autoload.php';

use ikerib\CBRSortzailea\Console\Application;

$application = new Application();
$application->run();