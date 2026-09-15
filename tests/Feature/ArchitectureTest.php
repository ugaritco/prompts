<?php

arch("Doesn't use collections")
    ->expect('Ugarit\Prompts')
    ->not->toUse(['collect']);
