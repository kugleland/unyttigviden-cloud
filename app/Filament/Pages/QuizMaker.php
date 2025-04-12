<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class QuizMaker extends Page
{
    protected static ?string $navigationGroup = 'Generators';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.quiz-maker';
}
