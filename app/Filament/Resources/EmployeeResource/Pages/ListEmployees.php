<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\Action;
use AymanAlhattami\FilamentContextMenu\Traits\PageHasContextMenu;
class ListEmployees extends ListRecords
{
    use PageHasContextMenu;

    protected static string $resource = EmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    public function getContextMenuActions(): array
    {
        return [
            Action::make(__('ایجاد کارمند یا خیاط'))
                ->url(CreateEmployee::getUrl(['/create'])),
            Action::make(__('لیست'))
                ->url(ListEmployees::getUrl(['/'])),
        ];
    }
}
