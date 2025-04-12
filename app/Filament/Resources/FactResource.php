<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Fact;
use Filament\Tables;
use App\Models\Category;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use App\Http\Resources\CategoryResource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\FactResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\FactResource\RelationManagers;
use App\Http\Resources\CategoryCollection;

class FactResource extends Resource
{

    public ?string $activeLocale = null;

    protected static ?string $model = Fact::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {

        $locale = (!is_string($form->model) && $form->model->getLocale()) ? $form->model->getLocale() : 'da';
        $categoryOptions = Category::all()->mapWithKeys(function ($category) use ($locale) {
            return [
                $category->id => $category->title //$category->getTranslation('title', $locale)
            ];
        });
        $categoryOptions->all();

        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->maxLength(255),
                Forms\Components\Textarea::make('content')
                    ->columnSpanFull(),
                Select::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                        'archived' => 'Archived',
                    ])->default('draft'),
                Forms\Components\TextInput::make('source')
                    ->maxLength(255),
                Forms\Components\DateTimePicker::make('fact_checked_at'),
                Forms\Components\Select::make('category_id')
                    ->options($categoryOptions),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category.title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('source')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fact_checked_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFacts::route('/'),
            'create' => Pages\CreateFact::route('/create'),
            'edit' => Pages\EditFact::route('/{record}/edit'),
        ];
    }
}
