<?php

namespace App\Filament\Widgets;

use App\Models\Customer;
use App\Models\Expenses;
use App\Models\Employee;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;


class StatWidget extends BaseWidget
{


    protected static ?string $pollingInterval = '15s';
    protected static bool $isLazy = true;
    protected static ?int $sort = 1;
    protected function getStats(): array
    {
        return [
            Stat::make('مشتریان', Customer::count())
                ->description('ټولټال مشتریان په سیستم کې')
                ->descriptionIcon('heroicon-o-users')
                ->chart([1, 9, 5, 4, 7, 6, 7, 3, 9, 7, 1, 0])
                ->color('success')
            ,
            Stat::make('کارمندان', Employee::count())
                ->description('کارمندان لیست ')
                ->descriptionIcon('heroicon-o-user-circle')
                ->color('danger')
                ->chart([1, 5, 1, 4, 4, 8, 2, 7, 3, 2, 5, 9])
            ,
            // Stat::make('اجناس', CustomerNumeraha::count())
            //     ->description('ټولټال اجناس ')
            //     ->descriptionIcon('heroicon-o-building-office-2')
            //     ->color('warning')
            //     ->chart([1, 2, 4, 5, 2, 8, 2, 7, 3, 2, 5, 2])
            // ,
            Stat::make('مالی برخه', Expenses::count())
                ->description('مالی برخی ټول پلورل شوی اجناس')
                ->descriptionIcon('heroicon-o-banknotes')
                ->color('info')
                ->chart([1, 4, 6, 4, 4, 2, 1, 4, 2, 2, 2, 5])
            ,
            // Stat::make('نمری (ځمکی)', CustomerNumeraha::count())
            //     ->description('ټوټال پلورل شوی نمرو (ځمکو) ')
            //     ->descriptionIcon('heroicon-m-arrow-trending-down')
            //     ->color('success')
            //     ->chart([1, 5, 1, 4, 4, 8, 2, 7, 3, 2, 5, 9])
            // ,
        ];
    }
}
