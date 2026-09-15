<?php

use function Ugarit\Prompts\clear;
use function Ugarit\Prompts\note;
use function Ugarit\Prompts\pause;

require __DIR__.'/../vendor/autoload.php';

note('This will disappear.');

pause('Press [Enter] to continue.');

clear();

note('This will also disappear.');

pause('Press [Enter] to continue.');

clear();
