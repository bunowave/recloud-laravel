<?php

namespace BunoWave\ReCloud\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Widget extends Component
{
    public string $siteKey;

    public string $scriptUrl;

    public function __construct(
        public ?string $theme = null,
        public ?string $size = null,
        public ?string $align = null,
        public ?string $accent = null,
        public ?string $language = null,
        public ?string $callback = null,
        public ?string $errorCallback = null,
        ?string $siteKey = null,
    ) {
        $this->siteKey   = $siteKey ?? (string) config('recloud.site_key');
        $this->scriptUrl = rtrim((string) config('recloud.url'), '/').'/recloud.js';
    }

    public function render(): View
    {
        return view('recloud::widget');
    }
}
