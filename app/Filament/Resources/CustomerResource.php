<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use AymanAlhattami\FilamentContextMenu\Traits\PageHasContextMenu;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;



use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Mpdf\Mpdf;

class CustomerResource extends Resource
{
    use PageHasContextMenu;



    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $modelLabel = 'مشتریان';

    public static function getNavigationLabel(): string
    {
        return __('مشتریان');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('نام')
                        ->helpertext('نام مشتری ')
                        ->required(),
                    Forms\Components\TextInput::make('clothNumber')
                        ->numeric()
                        ->label('د جامو نمبر')
                        ->helpertext('د جامو یا د کالیو نمبر')
                        ->required(),
                    Forms\Components\TextInput::make('phone')
                        ->tel()
                        ->helpertext('د مشتری د تلفن شمیره')
                        ->label('تلفن شماره')
                        ->required()
                        ->numeric(),
                    Forms\Components\TextInput::make('amount')
                        ->label('اندازه')
                        ->helpertext('څو جوړه کالی دی؟')
                        ->numeric()
                        ->required(),
                    Forms\Components\TextInput::make('price')
                        ->label('قیمت')
                        ->helpertext('قیمت اضافه کړی')
                        ->numeric()
                        ->required(),
                    Forms\Components\TextInput::make('prepaid')
                        ->label('پیش پرداخت')
                        ->helpertext('پیش پرداخت پیسی')
                        ->numeric()
                        ->required(),
                    Forms\Components\TextInput::make('due_price')
                        ->label('باقی پیسی')
                        ->helpertext('پاتی باقی پیسی مقدار')
                        ->numeric()
                        ->required(),
                    Forms\Components\DatePicker::make('delivery_date')
                        ->label('د تسلیمی نیټه')
                        ->jalali()
                        ->helpertext('په کومه نیټه چی یاد مشتری بیرته په خپلو جامو پسی راځی')
                        ->required(),
                ])->columns(4)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()
                    ->label('نام '),
                Tables\Columns\TextColumn::make('clothNumber')->searchable()->label('کالیو نمبر '),
                Tables\Columns\TextColumn::make('phone')->numeric()->sortable()->label('تلفن نمبر'),
                Tables\Columns\TextColumn::make('amount')->searchable()->label('اندازه '),
                Tables\Columns\TextColumn::make('price')->searchable()->label('قیمت'),
                Tables\Columns\TextColumn::make('prepaid')->searchable()->label('وصول پیسی '),
                Tables\Columns\TextColumn::make('due_price')->searchable()->label('اخری نیټه'),
                Tables\Columns\TextColumn::make('delivery_date')
                    ->dateTime()
                    ->jalaliDate() // Display in Jalali format
                    ->searchable()
                    ->label('د سپارولو نیټه'),
                Tables\Columns\TextColumn::make('created_at')
                    ->jalaliDate()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('د ثبت نیټه'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->jalaliDate()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('د معلوماتو بدلون نیټه'),
            ])

            ->filters([
                Filter::make('Near Delivery')
                    // Filter records where `delivery_date` is between the start of the week and the end of tomorrow
                    ->query(function ($query) {
                        $date = Carbon::now()->addDays(7);
                        $startOfWeek = Carbon::now()->startOfWeek()->startOfDay(); // Start of the current week
                        // End of tomorrow
                        // Filter records where `delivery_date` is between the start of the week and the end of tomorrow
                        return $query->whereBetween('delivery_date', [$startOfWeek, $date]);
                    })
                    ->label('هغه مشتریان چی نږدی ورځو کی راځی'), // Set a label for the filter button
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('printSlip')
                    ->label('سلیپ')
                    ->color('success')
                    ->icon('heroicon-o-newspaper')
                    ->openUrlInNewTab()
                    ->action(fn($record) => self::generateBillSlip($record)) // Use $this here
                ,
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);

        // Generate Slip 
    }
    public static function generateBillSlip($record)
    {
        // Fetch the required data from the record
        $data = [
            'name' => $record->name,
            'clothNumber' => $record->clothNumber,
            'phone' => $record->phone,
            'amount' => $record->amount,
            'price' => $record->price,
            'prepaid' => $record->prepaid,
            'due_price' => $record->due_price,
            'delivery_date' => Carbon::parse($record->delivery_date)->format('Y-m-d'),
            'created_at' => $record->created_at->format('Y-m-d'),
            'updated_at' => $record->updated_at->format('Y-m-d'),
        ];

        // Generate the HTML for the slip
        $html = view('pdf.slip', compact('data'))->render();

        // Configure mPDF and generate the PDF
        try {
            $mpdf = new \Mpdf\Mpdf();
            $mpdf->WriteHTML($html);  // Pass the HTML content for PDF

            // Output directly to browser for debugging
            $mpdf->Output($record->name . '.pdf', 'I'); // 'I' for inline display in browser

        } catch (\Mpdf\MpdfException $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
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
