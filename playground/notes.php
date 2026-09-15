<?php

use function Ugarit\Prompts\alert;
use function Ugarit\Prompts\error;
use function Ugarit\Prompts\info;
use function Ugarit\Prompts\intro;
use function Ugarit\Prompts\note;
use function Ugarit\Prompts\outro;
use function Ugarit\Prompts\warning;

require __DIR__.'/../vendor/autoload.php';

intro('Intro');
note('Note');
info('Info');
warning('Warning');
error('Error');
alert('Alert');
outro('Outro');
