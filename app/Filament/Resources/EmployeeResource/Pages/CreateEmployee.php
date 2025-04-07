<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateEmployee extends CreateRecord
{
    protected static string $resource = EmployeeResource::class;
    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Employee Created';
    }
    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->title('Employee Created')
            ->body('The employee has been created successfully.')
            ->success();
    }
    // protected function getCreatedNotification(): ?Notification
    // {
    //     return null;
    // }
}

