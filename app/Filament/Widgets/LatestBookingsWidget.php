<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestBookingsWidget extends BaseWidget
{
    protected static ?int $sort = 2;
    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(Booking::query()->latest()->limit(5))
            ->columns([
                Tables\Columns\TextColumn::make('booking_number')->label('ID'),
                Tables\Columns\TextColumn::make('full_name')->label('Customer'),
                Tables\Columns\TextColumn::make('trip.title')->label('Trip'),
                Tables\Columns\TextColumn::make('total')->money('USD'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'confirmed',
                        'primary' => 'completed',
                        'danger'  => 'cancelled',
                    ]),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->label('Date'),
            ]);
    }
}
