<?php

namespace App\Filament\Resources\ExpensesResource\Pages;

use App\Filament\Resources\ExpensesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use AymanAlhattami\FilamentContextMenu\Traits\PageHasContextMenu;
use Filament\Actions\Action;

class ListExpenses extends ListRecords
{
    use PageHasContextMenu;

    protected static string $resource = ExpensesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
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
    // =============================== End Context Menu ===========================

}
