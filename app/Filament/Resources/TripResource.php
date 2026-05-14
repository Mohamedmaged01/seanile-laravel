<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TripResource\Pages;
use App\Models\Trip;
use App\Models\Destination;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TripResource extends Resource
{
    protected static ?string $model = Trip::class;
    protected static ?string $navigationIcon = 'heroicon-o-map';
    protected static ?string $navigationGroup = 'Content';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Tabs::make()->tabs([
                Forms\Components\Tabs\Tab::make('English')->schema([
                    Forms\Components\TextInput::make('title')->required()->maxLength(255),
                    Forms\Components\Textarea::make('description')->rows(4),
                ]),
                Forms\Components\Tabs\Tab::make('Arabic')->schema([
                    Forms\Components\TextInput::make('title_ar')->label('Title (Arabic)')->maxLength(255),
                    Forms\Components\Textarea::make('description_ar')->label('Description (Arabic)')->rows(4),
                ]),
            ])->columnSpanFull(),

            Forms\Components\Select::make('destination_id')
                ->label('Destination')
                ->options(Destination::pluck('name', 'id'))
                ->searchable(),

            Forms\Components\Select::make('category')
                ->options([
                    'diving'      => 'Diving',
                    'safari'      => 'Safari',
                    'beach'       => 'Beach',
                    'cruise'      => 'Cruise',
                    'fishing'     => 'Fishing',
                    'watersports' => 'Water Sports',
                ])->required(),

            Forms\Components\TextInput::make('price')->numeric()->prefix('$')->required(),
            Forms\Components\TextInput::make('original_price')->numeric()->prefix('$'),

            Forms\Components\TextInput::make('duration')->placeholder('e.g. 8 hours'),
            Forms\Components\TextInput::make('duration_hours')->numeric()->default(4),
            Forms\Components\TextInput::make('min_people')->numeric()->default(1),
            Forms\Components\TextInput::make('max_people')->numeric()->default(12),

            Forms\Components\Select::make('badge')
                ->options([
                    'bestSeller'    => 'Best Seller',
                    'topRated'      => 'Top Rated',
                    'limitedSeats'  => 'Limited Seats',
                    'luxury'        => 'Luxury',
                ])->nullable(),

            Forms\Components\TextInput::make('rating')
                ->numeric()
                ->default(4.5)
                ->step(0.1)
                ->minValue(1)
                ->maxValue(5),

            Forms\Components\TextInput::make('reviews_count')->numeric()->default(0),

            Forms\Components\Toggle::make('includes_food')->label('Includes Food'),
            Forms\Components\Toggle::make('includes_insurance')->label('Includes Insurance'),
            Forms\Components\Toggle::make('includes_pickup')->label('Includes Pickup'),
            Forms\Components\Toggle::make('is_featured')->label('Featured'),
            Forms\Components\Toggle::make('is_active')->label('Active')->default(true),

            Forms\Components\TagsInput::make('highlights')->placeholder('Add highlight'),
            Forms\Components\FileUpload::make('image')->image()->directory('trips'),
            Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')->circular(),
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('destination.name')->label('Destination')->sortable(),
                Tables\Columns\BadgeColumn::make('category')
                    ->colors([
                        'primary' => 'diving',
                        'success' => 'safari',
                        'warning' => 'beach',
                        'danger'  => 'cruise',
                    ]),
                Tables\Columns\TextColumn::make('price')->money('USD')->sortable(),
                Tables\Columns\TextColumn::make('rating')->sortable(),
                Tables\Columns\TextColumn::make('bookings_count')
                    ->label('Bookings')
                    ->counts('bookings')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_featured')->boolean()->label('Featured'),
                Tables\Columns\ToggleColumn::make('is_active')->label('Active'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->options([
                        'diving'  => 'Diving',
                        'safari'  => 'Safari',
                        'beach'   => 'Beach',
                        'cruise'  => 'Cruise',
                    ]),
                Tables\Filters\TernaryFilter::make('is_featured')->label('Featured'),
                Tables\Filters\TernaryFilter::make('is_active')->label('Active'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListTrips::route('/'),
            'create' => Pages\CreateTrip::route('/create'),
            'edit'   => Pages\EditTrip::route('/{record}/edit'),
        ];
    }
}
