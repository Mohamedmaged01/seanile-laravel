<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use App\Models\Trip;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Bookings', Booking::count())
                ->description('All time')
                ->color('primary')
                ->icon('heroicon-o-ticket'),

            Stat::make('Revenue', '$' . number_format(Booking::where('status', 'completed')->sum('total'), 0))
                ->description('Completed bookings')
                ->color('success')
                ->icon('heroicon-o-currency-dollar'),

            Stat::make('Active Trips', Trip::where('is_active', true)->count())
                ->color('warning')
                ->icon('heroicon-o-map'),

            Stat::make('Customers', User::where('role', 'customer')->count())
                ->color('info')
                ->icon('heroicon-o-users'),
        ];
    }
}
