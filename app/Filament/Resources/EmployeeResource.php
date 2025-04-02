<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Models\Employee;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Employee Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Relationships')
                    ->schema([
                        Select::make('country_id')
                            ->relationship(name: 'country', titleAttribute: 'name')
                            ->searchable()
                            ->native(true)
                            ->preload()
                            ->required(),
                        Select::make('state_id')
                            ->relationship(name: 'State', titleAttribute: 'name')
                            ->searchable()
                            ->native(true)
                            ->preload()
                            ->required(),
                        Select::make('city_id')
                            ->relationship(name: 'City', titleAttribute: 'name')
                            ->searchable()
                            ->native(true)
                            ->preload()
                            ->required(),
                        Select::make('department_id')
                            ->relationship(name: 'Department', titleAttribute: 'name')
                            ->searchable()
                            ->native(true)
                            ->preload()
                            ->required(),
                    ])->columns(2),
                Section::make('User Name')
                    ->description('Put in the username details: ')
                    ->schema([
                        TextInput::make('first_name')
                            ->required(),
                        TextInput::make('middle_name')
                            ->required(),
                        TextInput::make('last_name')
                            ->required(),
                    ])->columns(3),
                Section::make('Employee Addresses')
                    ->description('Put in the employee address details: ')
                    ->schema([
                        TextInput::make('country_id')
                            ->required()
                            ->numeric(),
                        TextInput::make('state_id')
                            ->required()
                            ->numeric(),
                        TextInput::make('city_id')
                            ->required()
                            ->numeric(),
                        TextInput::make('department_id')
                            ->required()
                            ->numeric(),
                        TextInput::make('address')
                            ->required(),
                        TextInput::make('zip_code')
                            ->required(),
                    ])->columns(2),
                Section::make('Employee Dates')
                    ->description('Put in the employee date details: ')
                    ->schema([
                        DatePicker::make('date_of_birth')
                            ->required(),
                        DatePicker::make('date_hired')
                            ->required(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('country_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('state_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('city_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('department_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('first_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('middle_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('zip_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date_of_birth')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_hired')
                    ->date()
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
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'view' => Pages\ViewEmployee::route('/{record}'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
