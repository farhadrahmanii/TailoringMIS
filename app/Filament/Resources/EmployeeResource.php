<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Models\Employee;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Grid;
class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $modelLabel = 'کارمندان';
    protected static ?string $navigationLabel = 'کارمندان';




    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()->schema([
                    Grid::make(3) // Adjust the number of columns for better layout
                        ->schema([
                            TextInput::make('name')
                                ->label('نام')
                                ->prefixIcon('heroicon-o-user')
                                ->required(),

                            TextInput::make('lastName')
                                ->label('تخلص')
                                ->prefixIcon('heroicon-o-user-circle')
                                ->required(),

                            TextInput::make('FatherName')
                                ->label('نام پدر')
                                ->prefixIcon('heroicon-o-users')
                                ->required(),

                            TextInput::make('Position')
                                ->label('موقف')
                                ->prefixIcon('heroicon-o-briefcase')
                                ->required(),

                            TextInput::make('Education')
                                ->label('تحصیلات')
                                ->prefixIcon('heroicon-o-academic-cap'),

                            TextInput::make('salary')
                                ->label('معاش')
                                ->prefixIcon('heroicon-o-currency-dollar')
                                ->numeric(),

                            TextInput::make('tazkira')
                                ->label('تذکره')
                                ->prefixIcon('heroicon-o-identification'),

                            Forms\Components\DatePicker::make('date_of_contract')
                                ->label('تاریخ قرارداد')
                                ->prefixIcon('heroicon-o-calendar')
                                ->jalali()

                            ,

                            Forms\Components\DatePicker::make('end_date_of_contract')
                                ->label('تاریخ ختم قرارداد')
                                ->jalali()
                                ->prefixIcon('heroicon-o-calendar')
                            ,

                            TextInput::make('phone_number')
                                ->label('شماره تماس')
                                ->prefixIcon('heroicon-o-phone')
                                ->tel(),

                            TextInput::make('Address')
                                ->label('آدرس')
                                ->prefixIcon('heroicon-o-map'),
                        ]),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('lastName')
                    ->searchable(),
                Tables\Columns\TextColumn::make('FatherName')
                    ->searchable(),
                Tables\Columns\TextColumn::make('Position')
                    ->searchable(),
                Tables\Columns\TextColumn::make('Education')
                    ->searchable(),
                Tables\Columns\TextColumn::make('salary')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tazkira')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date_of_contract')
                    ->searchable(),
                Tables\Columns\TextColumn::make('end_date_of_contract')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('Address')
                    ->searchable(),
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
            // 'view' => Pages\ViewEmployee::route('/{record}'),
            // 'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
