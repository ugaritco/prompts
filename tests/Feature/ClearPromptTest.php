<?php

use Ugarit\Prompts\Prompt;

use function Ugarit\Prompts\clear;

it('clears', function () {
    Prompt::fake();

    clear();

    Prompt::assertOutputContains("\033[H\033[J");
});
