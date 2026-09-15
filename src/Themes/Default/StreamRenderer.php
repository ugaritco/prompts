<?php

namespace Ugarit\Prompts\Themes\Default;

use Ugarit\Prompts\Stream;

class StreamRenderer extends Renderer
{
    /**
     * Render the stream.
     */
    public function __invoke(Stream $stream): string
    {
        foreach ($stream->lines() as $line) {
            $this->line(" {$line}");
        }

        return $this;
    }
}
