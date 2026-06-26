<?php

namespace App\Http\Controllers;

use App\Http\Middleware\SetLocale;
use App\Models\Car;
use App\Models\Location;
use Illuminate\Support\Facades\Response;

class SitemapController extends Controller
{
    public function index()
    {
        $locales = SetLocale::SUPPORTED;
        $urls = [];

        $staticRoutes = [
            'home', 'fleet', 'locations', 'services', 'about', 'contact', 'faq', 'privacy', 'terms',
        ];

        foreach ($locales as $locale) {
            foreach ($staticRoutes as $route) {
                $urls[] = [
                    'loc' => route($route, ['locale' => $locale]),
                    'changefreq' => 'weekly',
                    'priority' => $route === 'home' ? '1.0' : '0.7',
                    'lastmod' => now()->toAtomString(),
                ];
            }

            foreach (Car::active()->get() as $car) {
                $urls[] = [
                    'loc' => route('car.show', ['locale' => $locale, 'car' => $car->slug]),
                    'changefreq' => 'weekly',
                    'priority' => '0.8',
                    'lastmod' => $car->updated_at?->toAtomString() ?? now()->toAtomString(),
                ];
            }

            foreach (Location::active()->get() as $location) {
                $urls[] = [
                    'loc' => route('location.show', ['locale' => $locale, 'location' => $location->slug]),
                    'changefreq' => 'monthly',
                    'priority' => '0.6',
                    'lastmod' => $location->updated_at?->toAtomString() ?? now()->toAtomString(),
                ];
            }
        }

        $xml = view('sitemap', ['urls' => $urls])->render();

        return Response::make($xml, 200, ['Content-Type' => 'application/xml']);
    }

    public function robots()
    {
        $content = "User-agent: *\n";
        $content .= "Allow: /\n";
        $content .= "Disallow: /admin\n";
        $content .= "Sitemap: " . url('/sitemap.xml') . "\n";

        return Response::make($content, 200, ['Content-Type' => 'text/plain']);
    }
}
