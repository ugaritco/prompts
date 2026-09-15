<?php

use function Ugarit\Prompts\confirm;
use function Ugarit\Prompts\notify;

require __DIR__.'/../vendor/autoload.php';

notify('Basic Notification', 'Just a title and body');

confirm('Next: with a subtitle');

notify(
    title: 'With Subtitle',
    body: 'This one has a subtitle',
    subtitle: 'Extra context here',
);

confirm('Next: with a sound');

notify(
    title: 'With Sound',
    body: 'You should hear Glass',
    sound: 'Glass',
);

confirm('Next: with everything');

notify(
    title: 'Full Notification',
    body: 'All the options at once',
    subtitle: 'Ugarit Prompts',
    sound: 'Frog',
);

confirm('Next: title only');

notify('Title Only');
