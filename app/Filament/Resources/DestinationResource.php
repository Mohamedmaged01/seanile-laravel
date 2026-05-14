<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DestinationResource\Pages;
use App\Models\Destination;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DestinationResource extends Resource
{
    protected static ?string $model = Destination::class;
    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';
    protected static ?string $navigationGroup = 'Content';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Tabs::make()->tabs([
                Forms\Components\Tabs\Tab::make('English')->schema([
                    Forms\Components\TextInput::make('name')->required()->maxLength(255),
                    Forms\Components\TextInput::make('tagline')->maxLength(255),
                    Forms\Components\Textarea::make('description')->rows(4),
                ]),
                Forms\Components\Tabs\Tab::make('Arabic')->schema([
                    Forms\Components\TextInput::make('name_ar')->label('Name (Arabic)')->maxLength(255),
                    Forms\Components\TextInput::make('tagline_ar')->label('Tagline (Arabic)')->maxLength(255),
                    Forms\Components\Textarea::make('description_ar')->label('Description (Arabic)')->rows(4),
                ]),
            ])->columnSpanFull(),

            Forms\Components\FileUpload::make('image')
                ->image()
                ->directory('destinations'),

            Forms\Components\TextInput::make('trips_count')
                ->label('Trips Count')
                ->numeric()
                ->default(0),

            Forms\Components\Toggle::make('is_featured')->label('Featured'),
            Forms\Components\Toggle::make('is_active')->label('Active')->default(true),

            Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')->circular(),
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('trips_count')->label('Trips')->sortable(),
                Tables\Columns\IconColumn::make('is_featured')->boolean()->label('Featured'),
                Tables\Columns\ToggleColumn::make('is_active')->label('Active'),
            ])
            ->filters([
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
            'index'  => Pages\ListDestinations::route('/'),
            'create' => Pages\CreateDestination::route('/create'),
            'edit'   => Pages\EditDestination::route('/{record}/edit'),
        ];
    }
}
