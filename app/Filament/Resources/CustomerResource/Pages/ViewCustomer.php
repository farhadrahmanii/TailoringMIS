<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use App\Filament\Resources\CustomerResource;
use App\Models\Customer;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use AymanAlhattami\FilamentContextMenu\Traits\PageHasContextMenu;
class ViewCustomer extends ViewRecord
{
    use PageHasContextMenu;
    protected static string $resource = CustomerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

}
