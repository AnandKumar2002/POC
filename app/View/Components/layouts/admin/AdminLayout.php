<?php

namespace App\View\Components\layouts\admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminLayout extends Component
{
    /**
     * Create a new component instance.
     */
    public array $seo;

    public function __construct(
        public ?string $title = null,
        public ?string $description = null,
        public ?string $keywords = null,
        public ?string $ogImage = null
    ) {
        $this->seo = [
            'title' => $this->title ?? config('seo.title', config('app.name')),
            'description' => $this->description ?? config('seo.description', 'Welcome to ' . config('app.name')),
            'keywords' => $this->keywords ?? config('seo.keywords', 'Laravel, Admin'),
            'ogImage' => $this->ogImage ?? config('seo.ogImage', asset('images/og-default.png')),
            'robots' => config('seo.robots', 'index, follow'),
            'twitterHandle' => config('seo.twitterHandle', '@yourhandle'),
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layouts.admin.admin-layout');
    }
}
