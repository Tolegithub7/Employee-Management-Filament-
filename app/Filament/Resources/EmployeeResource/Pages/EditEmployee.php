<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditEmployee extends EditRecord
{
    protected static string $resource = EmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
