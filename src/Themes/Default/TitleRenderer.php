<?php

namespace Ugarit\Prompts\Themes\Default;

use Ugarit\Prompts\Title;

class TitleRenderer extends Renderer
{
    /**
     * Render the title.
     */
    public function __invoke(Title $title): string
    {
        return "\033]0;{$title->title}\007";
    }
}
