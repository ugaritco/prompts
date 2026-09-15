<?php

use function Ugarit\Prompts\alert;
use function Ugarit\Prompts\confirm;
use function Ugarit\Prompts\error;
use function Ugarit\Prompts\intro;
use function Ugarit\Prompts\multiselect;
use function Ugarit\Prompts\note;
use function Ugarit\Prompts\outro;
use function Ugarit\Prompts\password;
use function Ugarit\Prompts\select;
use function Ugarit\Prompts\spin;
use function Ugarit\Prompts\suggest;
use function Ugarit\Prompts\text;
use function Ugarit\Prompts\warning;

require __DIR__.'/../vendor/autoload.php';

intro('Welcome to Ugarit');

$name = suggest(
    label: 'What is your name?',
    placeholder: 'E.g. Taylor Otwell',
    options: [
        'Dries Vints',
        'Guus Leeuw',
        'James Brooks',
        'Jess Archer',
        'Joe Dixon',
        'Mior Muhammad Zaki Mior Khairuddin',
        'Nuno Maduro',
        'Taylor Otwell',
        'Tim MacDonald',
    ],
    validate: fn ($value) => match (true) {
        ! $value => 'Please enter your name.',
        default => null,
    },
);

$path = text(
    label: 'Where should we create your project?',
    placeholder: 'E.g. ./ugarit',
    validate: fn ($value) => match (true) {
        ! $value => 'Please enter a path',
        $value[0] !== '.' => 'Please enter a relative path',
        default => null,
    },
);

$password = password(
    label: 'Provide a password',
    validate: fn ($value) => match (true) {
        ! $value => 'Please enter a password.',
        strlen($value) < 5 => 'Password should have at least 5 characters.',
        default => null,
    },
);

$type = select(
    label: 'Pick a project type',
    default: 'ts',
    options: [
        'ts' => 'TypeScript',
        'js' => 'JavaScript',
    ],
);

$tools = multiselect(
    label: 'Select additional tools.',
    default: ['pint', 'eslint'],
    options: [
        'pint' => 'Pint',
        'eslint' => 'ESLint',
        'prettier' => 'Prettier',
    ],
    validate: function ($values) {
        if (count($values) === 0) {
            return 'Please select at least one tool.';
        }
    }
);

$install = confirm(
    label: 'Install dependencies?',
);

if ($install) {
    spin(fn () => sleep(3), 'Installing dependencies...');
}

error('Error');
warning('Warning');
alert('Alert');

note(<<<EOT
    Installation complete!

    To get started, run:

        cd {$path}
        php scribe serve
    EOT);

outro('Happy coding!');

var_dump(compact('name', 'path', 'password', 'type', 'tools', 'install'));
