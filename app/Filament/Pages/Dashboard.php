<?php

namespace App\Filament\Pages;


class Dashboard extends \Filament\Pages\Dashboard
{
    // protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament-panels::pages.dashboard';

    protected function getHeaderWidgets(): array
    {
        return [
            //     // StatsOverview::class,
            // Widgets\PageViewsWidget::class,
            // Widgets\VisitorsWidget::class,
            // Widgets\ActiveUsersOneDayWidget::class,
            // Widgets\ActiveUsersSevenDayWidget::class,
            // Widgets\ActiveUsersTwentyEightDayWidget::class,
            // Widgets\SessionsWidget::class,
            // Widgets\SessionsDurationWidget::class,
            // Widgets\SessionsByCountryWidget::class,
            // Widgets\SessionsByDeviceWidget::class,
            // Widgets\MostVisitedPagesWidget::class,
            // Widgets\TopReferrersListWidget::class,
        ];
    }
}