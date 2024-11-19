<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExpensesResource\Pages;
use App\Filament\Resources\ExpensesResource\RelationManagers;
use App\Models\Expenses;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
class ExpensesResource extends Resource
{

    protected static ?string $model = Expenses::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $modelLabel = 'مسارف';

    protected static ?string $navigationLabel = 'مصارف';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()->schema([
                    Forms\Components\Select::make('user_id')
                        ->relationship('user', 'name')
                        ->default(Auth::user()->id)
                        ->label('مصول کس'),
                    Grid::make()->schema([
                        Forms\Components\TextInput::make('supplier_number')
                            ->label('فروشنده'),
                        Forms\Components\TextInput::make('date_expense')
                            ->label('مصرف تاریخ')
                        ,
                    ])->columns(2),
                    Grid::make()->schema([
                        Forms\Components\TextInput::make('item_name')
                            ->label('د جنس نوم')
                        ,
                        \LaraZeus\Quantity\Components\Quantity::make('amount')
                            ->heading('select quantity')
                            ->default(1)
                            ->maxValue(1000)
                            ->minValue(1)
                            ->stacked()

                            ->label('مقدار')
                            ->required()
                            ->helperText('between 1 and 1000')
                        ,
                        Forms\Components\TextInput::make('unit_price')
                            ->label('فی واحد قیمت')
                        ,
                    ])->columns(3),
                    Forms\Components\RichEditor::make('details')
                        ->label('توضیحات')
                    ,
                ])->columns(1)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user_id')
                    ->label('مصول کس')
                    ->sortable(),
                Tables\Columns\TextColumn::make('supplier_number')
                    ->label('فروشنده')
                    ->sortable(),
                Tables\Columns\TextColumn::make('details')
                    ->label('توضیحات')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date_expense')
                    ->label('مصرف تاریخ')
                    ->searchable(),
                Tables\Columns\TextColumn::make('item_name')
                    ->label('د جنس نوم')
                    ->searchable(),
                Tables\Columns\TextColumn::make('amount')
                    ->label('مقدار')
                    ->searchable(),
                Tables\Columns\TextColumn::make('unit_price')
                    ->label('فی واحد قیمت')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('تاریخ ثبت')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('تاریخ ویرایش')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListExpenses::route('/'),
            'create' => Pages\CreateExpenses::route('/create'),
            // 'view' => Pages\ViewExpenses::route('/{record}'),
            // 'edit' => Pages\EditExpenses::route('/{record}/edit'),
        ];
    }
}
