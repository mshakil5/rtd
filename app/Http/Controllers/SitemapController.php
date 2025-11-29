<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Product;
use App\Models\CompanyDetails;

class SitemapController extends Controller
{
    public function index()
    {
        $urls = [];
        
        // Static pages
        $staticPages = [
            ['loc' => url('/'), 'lastmod' => now()->toDateString(), 'changefreq' => 'daily', 'priority' => '1.0'],
            ['loc' => url('/about-us'), 'lastmod' => now()->toDateString(), 'changefreq' => 'monthly', 'priority' => '0.8'],
            ['loc' => url('/menu'), 'lastmod' => now()->toDateString(), 'changefreq' => 'weekly', 'priority' => '0.9'],
            ['loc' => url('/gallery'), 'lastmod' => now()->toDateString(), 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['loc' => url('/services'), 'lastmod' => now()->toDateString(), 'changefreq' => 'weekly', 'priority' => '0.9'],
            ['loc' => url('/book-now'), 'lastmod' => now()->toDateString(), 'changefreq' => 'monthly', 'priority' => '0.8'],
            ['loc' => url('/contact'), 'lastmod' => now()->toDateString(), 'changefreq' => 'monthly', 'priority' => '0.7'],
        ];

        $urls = array_merge($urls, $staticPages);

        // Services (Products)
        $services = Product::where('status', 1)->get();
        foreach ($services as $service) {
            $urls[] = [
                'loc' => url('/service/' . $service->slug),
                'lastmod' => $service->updated_at->toDateString(),
                'changefreq' => 'weekly',
                'priority' => '0.9',
            ];
        }

        $content = view('sitemap', compact('urls'))->render();
        return Response::make($content, 200)->header('Content-Type', 'application/xml');
    }
}