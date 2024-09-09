<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Flowframe\Trend\Trend;
use App\Models\OrderDetail;
use App\Models\OrderItem;
use App\Models\Transaction;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\LineChartWidget;

class ProductSalesChart extends LineChartWidget
{
    protected static ?string $heading = 'Chart';

    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 'full';

    public ?string $filter = 'year';

    public function getHeading(): string
    {
        return 'Order Sales Report';
    }

    // public static function canView(): bool
    // {
    //     return auth()->user()->can('widget_ProductSalesChart');
    // }

    // public static function canView(): bool
    // {
    //     return auth()->user()->can('disabled');
    // }

    protected function getFilters(): ?array
    {
        return [
            'day' => 'Today',
            'week' => 'Last week',
            'month' => 'Last month',
            'year' => 'This year',
        ];
    }

    protected function getData(): array
    {
        $activeFilter = $this->filter;

        $data1 = Trend::query(
            Order::where('status', 'completed')
        )
            ->between(
                start: now()->startOf($activeFilter),
                end: now()->endOf($activeFilter),
            )
            ->perMonth()
            ->sum('total_amount');

        $data2 = Trend::query(
            Order::where('status', 'pending')
        )
            ->between(
                start: now()->startOf($activeFilter),
                end: now()->endOf($activeFilter),
            )
            ->perMonth()
            ->sum('total_amount');

        $data3 = Trend::query(
            Order::where('status', 'cancelled')
        )
            ->between(
                start: now()->startOf($activeFilter),
                end: now()->endOf($activeFilter),
            )
            ->perMonth()
            ->sum('total_amount');

        return [
            'datasets' => [
                [
                    'label' => 'Completed Orders Amount',
                    'data' => $data1->map(fn(TrendValue $value) => $value->aggregate),
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#9BD0F5',
                ],
                [
                    'label' => 'Pending Orders Amount',
                    'data' => $data2->map(fn(TrendValue $value) => $value->aggregate),
                    'backgroundColor' => '#FFCE56',
                    'borderColor' => '#FFCE56',
                ],
                [
                    'label' => 'Cancelled Orders Amount',
                    'data' => $data3->map(fn(TrendValue $value) => $value->aggregate),
                    'backgroundColor' => '#FF6384',
                    'borderColor' => '#FF6384',
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }
}
