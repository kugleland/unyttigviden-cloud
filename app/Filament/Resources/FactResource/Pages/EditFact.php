<?php

namespace App\Filament\Resources\FactResource\Pages;

use App\Filament\Resources\FactResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFact extends EditRecord
{

    protected static string $resource = FactResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getFormActions(): array
    {
        return array_merge(
            parent::getFormActions(),
            [

                Actions\Action::make('save_and_go_back')
                    ->label('Save and go to index')
                    ->color('info')
                    ->action(function () {
                        $this->save();
                        $this->redirect(route('filament.admin.resources.facts.index'));
                    })
            ],
        );
    }
}
