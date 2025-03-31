<?php

namespace App\Filament\Resources\DepartmentResource\Pages;

use App\Filament\Resources\DepartmentResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewDepartment extends ViewRecord
{
    protected static string $resource = DepartmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
