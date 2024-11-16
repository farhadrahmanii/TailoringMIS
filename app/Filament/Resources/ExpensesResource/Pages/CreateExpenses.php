<?php

namespace App\Filament\Resources\ExpensesResource\Pages;

use App\Filament\Resources\ExpensesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateExpenses extends CreateRecord
{
    protected static string $resource = ExpensesResource::class;
}
