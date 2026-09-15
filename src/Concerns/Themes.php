<?php

namespace Ugarit\Prompts\Concerns;

use InvalidArgumentException;
use Ugarit\Prompts\AutoCompletePrompt;
use Ugarit\Prompts\Callout;
use Ugarit\Prompts\Clear;
use Ugarit\Prompts\ConfirmPrompt;
use Ugarit\Prompts\DataTablePrompt;
use Ugarit\Prompts\Grid;
use Ugarit\Prompts\MultiSearchPrompt;
use Ugarit\Prompts\MultiSelectPrompt;
use Ugarit\Prompts\Note;
use Ugarit\Prompts\NumberPrompt;
use Ugarit\Prompts\PasswordPrompt;
use Ugarit\Prompts\PausePrompt;
use Ugarit\Prompts\Progress;
use Ugarit\Prompts\Prompt;
use Ugarit\Prompts\SearchPrompt;
use Ugarit\Prompts\SelectPrompt;
use Ugarit\Prompts\Spinner;
use Ugarit\Prompts\Stream;
use Ugarit\Prompts\SuggestPrompt;
use Ugarit\Prompts\Table;
use Ugarit\Prompts\Task;
use Ugarit\Prompts\TextareaPrompt;
use Ugarit\Prompts\TextPrompt;
use Ugarit\Prompts\Themes\Default\AutoCompletePromptRenderer;
use Ugarit\Prompts\Themes\Default\CalloutRenderer;
use Ugarit\Prompts\Themes\Default\ClearRenderer;
use Ugarit\Prompts\Themes\Default\ConfirmPromptRenderer;
use Ugarit\Prompts\Themes\Default\DataTableRenderer;
use Ugarit\Prompts\Themes\Default\GridRenderer;
use Ugarit\Prompts\Themes\Default\MultiSearchPromptRenderer;
use Ugarit\Prompts\Themes\Default\MultiSelectPromptRenderer;
use Ugarit\Prompts\Themes\Default\NoteRenderer;
use Ugarit\Prompts\Themes\Default\NumberPromptRenderer;
use Ugarit\Prompts\Themes\Default\PasswordPromptRenderer;
use Ugarit\Prompts\Themes\Default\PausePromptRenderer;
use Ugarit\Prompts\Themes\Default\ProgressRenderer;
use Ugarit\Prompts\Themes\Default\SearchPromptRenderer;
use Ugarit\Prompts\Themes\Default\SelectPromptRenderer;
use Ugarit\Prompts\Themes\Default\SpinnerRenderer;
use Ugarit\Prompts\Themes\Default\StreamRenderer;
use Ugarit\Prompts\Themes\Default\SuggestPromptRenderer;
use Ugarit\Prompts\Themes\Default\TableRenderer;
use Ugarit\Prompts\Themes\Default\TaskRenderer;
use Ugarit\Prompts\Themes\Default\TextareaPromptRenderer;
use Ugarit\Prompts\Themes\Default\TextPromptRenderer;
use Ugarit\Prompts\Themes\Default\TitleRenderer;
use Ugarit\Prompts\Title;

trait Themes
{
    /**
     * The name of the active theme.
     */
    protected static string $theme = 'default';

    /**
     * The available themes.
     *
     * @var array<string, array<class-string<Prompt>, class-string<object&callable>>>
     */
    protected static array $themes = [
        'default' => [
            TextPrompt::class => TextPromptRenderer::class,
            NumberPrompt::class => NumberPromptRenderer::class,
            TextareaPrompt::class => TextareaPromptRenderer::class,
            PasswordPrompt::class => PasswordPromptRenderer::class,
            SelectPrompt::class => SelectPromptRenderer::class,
            MultiSelectPrompt::class => MultiSelectPromptRenderer::class,
            ConfirmPrompt::class => ConfirmPromptRenderer::class,
            PausePrompt::class => PausePromptRenderer::class,
            SearchPrompt::class => SearchPromptRenderer::class,
            MultiSearchPrompt::class => MultiSearchPromptRenderer::class,
            SuggestPrompt::class => SuggestPromptRenderer::class,
            Spinner::class => SpinnerRenderer::class,
            Note::class => NoteRenderer::class,
            Table::class => TableRenderer::class,
            Progress::class => ProgressRenderer::class,
            Clear::class => ClearRenderer::class,
            Grid::class => GridRenderer::class,
            AutoCompletePrompt::class => AutoCompletePromptRenderer::class,
            Title::class => TitleRenderer::class,
            Stream::class => StreamRenderer::class,
            Task::class => TaskRenderer::class,
            DataTablePrompt::class => DataTableRenderer::class,
            Callout::class => CalloutRenderer::class,
        ],
    ];

    /**
     * Get or set the active theme.
     *
     * @throws InvalidArgumentException
     */
    public static function theme(?string $name = null): string
    {
        if ($name === null) {
            return static::$theme;
        }

        if (! isset(static::$themes[$name])) {
            throw new InvalidArgumentException("Prompt theme [{$name}] not found.");
        }

        return static::$theme = $name;
    }

    /**
     * Add a new theme.
     *
     * @param  array<class-string<Prompt>, class-string<object&callable>>  $renderers
     */
    public static function addTheme(string $name, array $renderers): void
    {
        if ($name === 'default') {
            throw new InvalidArgumentException('The default theme cannot be overridden.');
        }

        static::$themes[$name] = $renderers;
    }

    /**
     * Get the renderer for the current prompt.
     */
    protected function getRenderer(): callable
    {
        $class = get_class($this);

        return new (static::$themes[static::$theme][$class] ?? static::$themes['default'][$class])($this);
    }

    /**
     * Render the prompt using the active theme.
     */
    protected function renderTheme(): string
    {
        $renderer = $this->getRenderer();

        return $renderer($this);
    }
}
