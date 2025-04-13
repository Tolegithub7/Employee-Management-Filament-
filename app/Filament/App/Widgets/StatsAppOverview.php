<?php

namespace App\Filament\App\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\User;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Team;
use Filament\Facades\Filament;

class StatsAppOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Users', Team::find(Filament::getTenant())->first()->members->count())
                ->description('All Users from database')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
            Stat::make('Departments', Department::query()->whereBelongsTo(Filament::getTenant())->count())
                ->description('All Teams from database')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),
            Stat::make('Employees', Employee::query()->whereBelongsTo(Filament::getTenant())->count())
                ->description('All Employees from database')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
        ];
    }
}
