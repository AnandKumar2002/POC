<?php

namespace App\View\Components\layouts\admin;

use App\Models\SeoSetting;
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
        $segments = request()->segments();

        //  ------------------------------------------------------
        // Build URL pattern (supports: users, users/add, users/123/edit)
        // ------------------------------------------------------
        $urlPattern = implode('/', $segments);

        // Home page (no segments)
        if ($urlPattern === '') {
            $urlPattern = 'home';
        }

        // ------------------------------------------------------
        // Cache settings
        // ------------------------------------------------------
        $cacheKey  = "seo_" . md5($urlPattern); // Prevent long keys
        $cacheTime = config('seo.cache_time', 3600);

        $dbSeo = cache()->remember($cacheKey, $cacheTime, function () use ($urlPattern) {

            // Match exact URLs OR dynamic patterns like users/{id}/edit
            return SeoSetting::where('url_pattern', $urlPattern)
                ->orWhere('url_pattern', $this->convertDynamic($urlPattern))
                ->first();
        });

        $this->seo = [
            'title'       => $dbSeo->meta_title        ?? $this->title        ?? config('seo.title'),
            'description' => $dbSeo->meta_description  ?? $this->description  ?? config('seo.description'),
            'keywords'    => $dbSeo->meta_keywords     ?? $this->keywords     ?? config('seo.keywords'),
            'ogTitle'     => $dbSeo->og_title          ?? $this->title,
            'ogDescription' => $dbSeo->og_description   ?? $this->description,
            'ogImage'     => $dbSeo->og_image          ?? $this->ogImage      ?? config('seo.ogImage'),
            'canonical'   => $dbSeo->canonical_url     ?? url()->current(),
            'robots'      => $dbSeo->robots            ?? config('seo.robots'),
            'twitterHandle' => config('seo.twitterHandle'),
        ];
    }

    /**
     * Convert actual URL into a dynamic pattern
     * Example:
     *  "users/12/edit" → "users/{id}/edit"
     */
    private function convertDynamic(string $url): string
    {
        return preg_replace('/\/\d+\//', '/{id}/', $url);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layouts.admin.admin-layout');
    }
}
