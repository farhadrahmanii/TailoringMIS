<?php

namespace App\Filament\Resources\ExpensesResource\Pages;

use App\Filament\Resources\ExpensesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\Action;
use AymanAlhattami\FilamentContextMenu\Traits\PageHasContextMenu;

class EditExpenses extends EditRecord
{
    use PageHasContextMenu;

    protected static string $resource = ExpensesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
    public function getContextMenuActions(): array
    {
        return [
            Action::make(__('ایجاد مسارف'))
                ->url(CreateExpenses::getUrl(['/create'])),
            Action::make(__('لیست'))
                ->url(ListExpenses::getUrl(['/'])),
        ];
    }
}
