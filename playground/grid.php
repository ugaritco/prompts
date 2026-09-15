<?php

use function Ugarit\Prompts\grid;

require __DIR__.'/../vendor/autoload.php';

grid(
    [
        'really-really-long-text',
        'small text',
        'really-really-long-text',
        'small text',
        'really-really-really-long-text',
        'text',
    ],
);
