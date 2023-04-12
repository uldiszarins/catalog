<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use App\Models\Catalog;
use Illuminate\Support\Facades\View;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $categories = Category::pluck('id', 'category_name')
            ->toArray();
        $categoriesCount = Catalog::selectRaw('category, count(*) as count')
            ->groupBy('category')
            ->pluck('count', 'category')
            ->toArray();

        View::composer('*', function ($view) use ($categories, $categoriesCount) {
            $data = [
                'categories' => $categories,
                'categoriesCount' => $categoriesCount,
            ];

            $view->with($data);
        });
    }
}
