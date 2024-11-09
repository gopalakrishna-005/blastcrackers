<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;



class DashboardWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $totalEmployers = User::count();
        $totalCategory = Category::count();
        $totalProduct = Product::count();



        return [
            
            Stat::make('Total Uses', $this->formatNumber($totalEmployers)),
            Stat::make('Total Category', $this->formatNumber($totalCategory)),
            Stat::make('Total Product', $this->formatNumber($totalProduct)),


        ];
    }

    public function formatNumber($number)
    {
        if ($number >= 1000) {
            return round($number / 1000, 1) . 'k'; // Converts to 'k' format
        }
        return $number; // Returns the number as is if it's less than 1000
    }
}


