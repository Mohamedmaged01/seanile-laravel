<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogPostResource\Pages;
use App\Models\BlogPost;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class BlogPostResource extends Resource
{
    protected static ?string $model = BlogPost::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Content';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Tabs::make()->tabs([
                Forms\Components\Tabs\Tab::make('English')->schema([
                    Forms\Components\TextInput::make('title')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (Forms\Set $set, ?string $state) => $set('slug', Str::slug($state))),

                    Forms\Components\TextInput::make('slug')
                        ->required()
                        ->maxLength(255)
                        ->unique(BlogPost::class, 'slug', ignoreRecord: true),

                    Forms\Components\Textarea::make('excerpt')->rows(3),

                    Forms\Components\RichEditor::make('content')
                        ->columnSpanFull(),
                ]),
                Forms\Components\Tabs\Tab::make('Arabic')->schema([
                    Forms\Components\TextInput::make('title_ar')->label('Title (Arabic)')->maxLength(255),
                    Forms\Components\Textarea::make('excerpt_ar')->label('Excerpt (Arabic)')->rows(3),
                    Forms\Components\RichEditor::make('content_ar')
                        ->label('Content (Arabic)')
                        ->columnSpanFull(),
                ]),
            ])->columnSpanFull(),

            Forms\Components\TextInput::make('author')->maxLength(255),
            Forms\Components\TextInput::make('category')->maxLength(255),

            Forms\Components\FileUpload::make('image')
                ->image()
                ->directory('blog'),

            Forms\Components\TextInput::make('read_time')
                ->label('Read Time (minutes)')
                ->numeric()
                ->default(5),

            Forms\Components\Toggle::make('is_published')->label('Published')->default(false),

            Forms\Components\DateTimePicker::make('published_at')->label('Published At'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')->circular(),
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('author')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('category')->sortable(),
                Tables\Columns\ToggleColumn::make('is_published')->label('Published'),
                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime()
                    ->label('Published At')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Created')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_published')->label('Published'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index'  => Pages\ListBlogPosts::route('/'),
            'create' => Pages\CreateBlogPost::route('/create'),
            'edit'   => Pages\EditBlogPost::route('/{record}/edit'),
        ];
    }
}
