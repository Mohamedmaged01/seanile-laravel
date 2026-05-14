<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Models\Booking;
use App\Models\Trip;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;
    protected static ?string $navigationIcon = 'heroicon-o-ticket';
    protected static ?string $navigationGroup = 'Operations';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Booking Info')->schema([
                Forms\Components\TextInput::make('booking_number')
                    ->label('Booking Number')
                    ->disabled(),

                Forms\Components\Select::make('trip_id')
                    ->label('Trip')
                    ->options(Trip::pluck('title', 'id'))
                    ->searchable()
                    ->required(),

                Forms\Components\Select::make('status')
                    ->options([
                        'pending'   => 'Pending',
                        'confirmed' => 'Confirmed',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ])
                    ->required(),
            ])->columns(3),

            Forms\Components\Section::make('Customer Details')->schema([
                Forms\Components\TextInput::make('full_name')->label('Full Name')->required()->maxLength(255),
                Forms\Components\TextInput::make('email')->email()->required()->maxLength(255),
                Forms\Components\TextInput::make('phone')->tel()->maxLength(50),
                Forms\Components\TextInput::make('nationality')->maxLength(100),
                Forms\Components\TextInput::make('hotel')->maxLength(255),
            ])->columns(2),

            Forms\Components\Section::make('Trip Details')->schema([
                Forms\Components\DatePicker::make('trip_date')->label('Trip Date')->required(),
                Forms\Components\TimePicker::make('preferred_time')->label('Preferred Time'),
                Forms\Components\TextInput::make('adults')->numeric()->default(1)->minValue(1),
                Forms\Components\TextInput::make('children')->numeric()->default(0)->minValue(0),
                Forms\Components\TextInput::make('infants')->numeric()->default(0)->minValue(0),
            ])->columns(3),

            Forms\Components\Section::make('Payment')->schema([
                Forms\Components\TextInput::make('payment_method')->label('Payment Method')->maxLength(100),
                Forms\Components\TextInput::make('currency')->maxLength(10)->default('USD'),
                Forms\Components\TextInput::make('subtotal')->numeric()->prefix('$'),
                Forms\Components\TextInput::make('discount')->numeric()->prefix('$')->default(0),
                Forms\Components\TextInput::make('tax')->numeric()->prefix('$')->default(0),
                Forms\Components\TextInput::make('total')->numeric()->prefix('$'),
            ])->columns(3),

            Forms\Components\Section::make('Additional Info')->schema([
                Forms\Components\Textarea::make('special_requests')
                    ->label('Special Requests')
                    ->rows(3)
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('notes')
                    ->label('Internal Notes')
                    ->rows(3)
                    ->columnSpanFull(),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('booking_number')
                    ->label('Booking #')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('full_name')
                    ->label('Customer')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('trip.title')
                    ->label('Trip')
                    ->sortable(),
                Tables\Columns\TextColumn::make('trip_date')
                    ->label('Trip Date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total')
                    ->money('USD')
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'confirmed',
                        'primary' => 'completed',
                        'danger'  => 'cancelled',
                    ]),
                Tables\Columns\TextColumn::make('payment_method')
                    ->label('Payment')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Created'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending'   => 'Pending',
                        'confirmed' => 'Confirmed',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookings::route('/'),
            'edit'  => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}
