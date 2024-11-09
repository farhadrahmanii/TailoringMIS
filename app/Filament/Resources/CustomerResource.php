<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\Filter;
use Carbon\Carbon;
use Filament\Tables\Actions\Action;
use Filament\Widgets\TableWidget;
class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\TextInput::make('clothNumber')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('amount')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('price')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('prepaid')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('due_price')
                    ->numeric()
                    ->required(),
                Forms\Components\DatePicker::make('delivery_date')
                    ->jalali()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('clothNumber')->searchable(),
                Tables\Columns\TextColumn::make('phone')->numeric()->sortable(),
                Tables\Columns\TextColumn::make('amount')->searchable(),
                Tables\Columns\TextColumn::make('price')->searchable(),
                Tables\Columns\TextColumn::make('prepaid')->searchable(),
                Tables\Columns\TextColumn::make('due_price')->searchable(),
                Tables\Columns\TextColumn::make('delivery_date')
                    ->dateTime()
                    ->jalaliDate() // Display in Jalali format
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->jalaliDate()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->jalaliDate()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])

            ->filters([
                Filter::make('Near Delivery')
                    // Filter records where `delivery_date` is between the start of the week and the end of tomorrow
                    ->query(function ($query) {
                        $startOfWeek = Carbon::now()->startOfWeek()->startOfDay(); // Start of the current week
                        $endOfTomorrow = Carbon::tomorrow()->endOfDay();           // End of tomorrow
                        // Filter records where `delivery_date` is between the start of the week and the end of tomorrow
                        return $query->whereBetween('delivery_date', [$startOfWeek, $endOfTomorrow]);
                    })
                    ->label('Near Delivery Date'), // Set a label for the filter button
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
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'view' => Pages\ViewCustomer::route('/{record}'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
