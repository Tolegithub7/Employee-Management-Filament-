<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Models\City;
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
use Filament\Forms\Set;
use Filament\Forms\Get;
use Illuminate\Support\Collection;
use App\Models\State;
use App\Models\Country;

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
                        // Forms\Components\Select::make('country_id')
                        //     ->relationship(name: 'country', titleAttribute: 'name')
                        //     ->searchable()
                        //     ->preload()
                        //     ->live()
                        //     ->afterStateUpdated(function (Set $set) {
                        //         $set('state_id', null);
                        //         $set('city_id', null);
                        //     })
                        //     ->required(),
                        // Forms\Components\Select::make('state_id')
                        //     ->options(fn (Get $get): Collection => State::query()
                        //         ->where('country_id', $get('country_id'))
                        //         ->pluck('name', 'id'))
                        //     ->searchable()
                        //     ->preload()
                        //     ->live()
                        //     ->afterStateUpdated(fn (Set $set) => $set('city_id', null))
                        //     ->required(),
                        // Forms\Components\Select::make('city_id')
                        //     ->options(fn (Get $get): Collection => City::query()
                        //         ->where('state_id', $get('state_id'))
                        //         ->pluck('name', 'id'))
                        //     ->searchable()
                        //     ->preload()
                        //     ->required(), //how it done
                        Select::make('country_id')
                            ->label('Country')
                            ->options(Country::pluck('name', 'id'))
                            ->live()
                            ->searchable()
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(fn ($state, callable $set) => $set('state_id', null)),
                        Select::make('state_id')
                            ->label('State')
                            ->options(fn ($get) => $get('country_id') ? State::where('country_id', $get('country_id'))->pluck('name', 'id') : [])
                            ->live()
                            ->searchable()
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(fn ($state, callable $set) => $set('city_id', null)),
                        Select::make('city_id')
                            ->label('City')
                            ->options(fn ($get) => $get('state_id') ? City::where('state_id', $get('state_id'))->pluck('name', 'id') : [])
                            ->searchable()
                            ->required(), // how it works
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
