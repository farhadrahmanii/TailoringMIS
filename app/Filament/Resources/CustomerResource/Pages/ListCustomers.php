<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use App\Filament\Resources\CustomerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use AymanAlhattami\FilamentContextMenu\Traits\PageHasContextMenu;
use Filament\Actions\Action;
use AymanAlhattami\FilamentContextMenu\ContextMenuDivider;
class ListCustomers extends ListRecords
{
    use PageHasContextMenu;
    protected static string $resource = CustomerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    public function getContextMenuActions(): array
    {
        return [
            Action::make(__('ایجاد مشتریان'))
                ->url(CreateCustomer::getUrl(['/create'])),
            Action::make(__('لیست'))
                ->url(ListCustomers::getUrl(['/'])),
        ];
    }
}
