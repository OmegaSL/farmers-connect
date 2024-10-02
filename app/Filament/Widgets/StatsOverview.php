<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    // protected static ?string $pollingInterval = null;

    protected static ?int $sort = 2;

    // public static function canView(): bool
    // {
    //     return auth()->user()->can('widget_StatsOverview');
    // }

    protected function getCards(): array
    {
        $user = auth()->user();
        // check if logged in user is super admin
        if (auth()->user()->hasRole('super_admin')) {
            $user = null;
        }

        // cedis symbol
        $currency = '₵';

        // First card
        $total_orders = \App\Models\Order::query()
            ->when($user, function ($query) use ($user) {
                return $query->where('user_id', $user->id);
            })
            ->count();
        $total_orders = $total_orders > 1000 ? round($total_orders / 1000, 1) . 'K' : $total_orders;

        $pending_orders = \App\Models\Order::where('status', 'pending')
            ->when($user, function ($query) use ($user) {
                return $query->whereHas('order_items', function ($query) use ($user) {
                    $query->whereHas('product', function ($query) use ($user) {
                        $query->where('user_id', $user->id);
                    });
                });
            })
            ->count();
        $pending_orders = $pending_orders > 1000 ? round($pending_orders / 1000, 1) . 'K' : $pending_orders;

        $completed_orders = \App\Models\Order::where('status', 'completed')
            ->when($user, function ($query) use ($user) {
                return $query->whereHas('order_items', function ($query) use ($user) {
                    $query->whereHas('product', function ($query) use ($user) {
                        $query->where('user_id', $user->id);
                    });
                });
            })
            ->count();
        $completed_orders = $completed_orders > 1000 ? round($completed_orders / 1000, 1) . 'K' : $completed_orders;

        $cancelled_orders = \App\Models\Order::where('status', 'cancelled')
            ->when($user, function ($query) use ($user) {
                return $query->whereHas('order_items', function ($query) use ($user) {
                    $query->whereHas('product', function ($query) use ($user) {
                        $query->where('user_id', $user->id);
                    });
                });
            })
            ->count();
        $cancelled_orders = $cancelled_orders > 1000 ? round($cancelled_orders / 1000, 1) . 'K' : $cancelled_orders;

        // Second card
        $total_product_order = \App\Models\OrderItem::query()
            ->when($user, function ($query) use ($user) {
                return $query->whereHas('product', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                });
            })
            ->count();
        $total_product_order = $total_product_order > 1000 ? round($total_product_order / 1000, 1) . 'K' : $total_product_order;

        $today_product_order = \App\Models\OrderItem::query()
            ->when($user, function ($query) use ($user) {
                return $query->whereHas('product', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                });
            })
            ->whereDate('created_at', today())->count();
        $today_product_order = $today_product_order > 1000 ? round($today_product_order / 1000, 1) . 'K' : $today_product_order;

        $this_month_sale = \App\Models\OrderItem::query()
            ->when($user, function ($query) use ($user) {
                return $query->whereHas('product', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                });
            })
            ->whereMonth('created_at', date('m'))->count();
        $this_month_sale = $this_month_sale > 1000 ? round($this_month_sale / 1000, 1) . 'K' : $this_month_sale;

        $this_year_sale = \App\Models\OrderItem::query()
            ->when($user, function ($query) use ($user) {
                return $query->whereHas('product', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                });
            })
            ->whereYear('created_at', date('Y'))->count();
        $this_year_sale = $this_year_sale > 1000 ? round($this_year_sale / 1000, 1) . 'K' : $this_year_sale;

        // Third card
        $total_earning = \App\Models\OrderItem::query()
            ->when($user, function ($query) use ($user) {
                return $query->whereHas('product', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                });
            })
            ->get()->reduce(function ($carry, $item) {
                return $carry + $item->price * $item->quantity;
            });
        $total_earning = $total_earning > 1000 ? round($total_earning / 1000, 1) . 'K' : $total_earning;

        $today_pending_earning = \App\Models\OrderItem::query()
            ->when($user, function ($query) use ($user) {
                return $query->whereHas('product', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                });
            })
            ->whereHas('order', function ($query) {
                $query->where('status', 'pending');
            })->whereDate('created_at', today())
            ->get()
            ->reduce(function ($carry, $item) {
                return $carry + $item->price * $item->quantity;
            });
        $today_pending_earning = $today_pending_earning > 1000 ? round($today_pending_earning / 1000, 1) . 'K' : $today_pending_earning;

        // $this_month_earning = \App\Models\OrderItem::whereMonth('created_at', date('m'))
        //     ->whereHas('order', function ($query) {
        //         $query->where('status', 'completed');
        //     })->get()
        //     ->reduce(function ($carry, $item) {
        //         return $carry + $item->price * $item->quantity;
        //     });
        // $this_month_earning = $this_month_earning > 1000 ? round($this_month_earning / 1000, 1) . 'K' : $this_month_earning;

        // $this_year_earning = \App\Models\OrderItem::whereYear('created_at', date('Y'))
        //     ->whereHas('order', function ($query) {
        //         $query->where('status', 'completed');
        //     })->get()->reduce(function ($carry, $item) {
        //         return $carry + $item->price * $item->quantity;
        //     });
        // $this_year_earning = $this_year_earning > 1000 ? round($this_year_earning / 1000, 1) . 'K' : $this_year_earning;


        // Fourth card
        $total_product = \App\Models\Product::query()
            ->when($user, function ($query) use ($user) {
                return $query->where('user_id', $user->id);
            })
            ->count();
        $total_product = $total_product > 1000 ? round($total_product / 1000, 1) . 'K' : $total_product;

        $total_customer = \App\Models\User::whereHas('roles', function ($query) {
            $query->where('name', 'normal_user');
        })->count();
        $total_customer = $total_customer > 1000 ? round($total_customer / 1000, 1) . 'K' : $total_customer;


        return [
            Stat::make('Total Orders', $total_orders)
                ->value($total_orders)
                ->icon('heroicon-o-document-text'),
            Stat::make('Pending Orders', $pending_orders)
                ->value($pending_orders)
                ->icon('heroicon-o-document-text'),
            Stat::make('Completed Orders', $completed_orders)
                ->value($completed_orders)
                ->icon('heroicon-o-document-text'),
            Stat::make('Canceled Orders', $cancelled_orders)
                ->value($cancelled_orders)
                ->icon('heroicon-o-document-text'),

            Stat::make('Total Product Sale', $total_product_order)
                ->value($total_product_order)
                ->icon('heroicon-o-chart-bar'),
            Stat::make('Today Product Order', $today_product_order)
                ->value($today_product_order)
                ->icon('heroicon-o-chart-bar'),
            // Stat::make('This Month Sale', $this_month_sale)
            //     ->value($this_month_sale)
            //     ->icon('heroicon-o-chart-bar'),
            // Stat::make('This Year Product Sale', $this_year_sale)
            //     ->value($this_year_sale)
            //     ->icon('heroicon-o-chart-bar'),

            // Stat::make('Total Earning', $total_earning)
            //     ->value($currency->sign . $total_earning)
            //     ->icon('heroicon-o-cash'),
            // Stat::make('Today Pending Earning', $today_pending_earning)
            //     ->value($currency->sign . $today_pending_earning)
            //     ->icon('heroicon-o-cash'),
            // Stat::make('This Month Earning', $this_month_earning)
            //     ->value($currency->sign . $this_month_earning)
            //     ->icon('heroicon-o-cash'),
            // Stat::make('This Year Earning', $this_year_earning)
            //     ->value($currency->sign . $this_year_earning)
            //     ->icon('heroicon-o-cash'),

            // Stat::make('Total Products', $total_product)
            //     ->value($total_product)
            //     ->icon('heroicon-o-cash'),
            // Stat::make('Total Customers', $total_customer)
            //     ->value($total_customer)
            //     ->icon('heroicon-o-cash'),
            // Stat::make('This Month Earning', $this_month_earning)
            //     ->value($this_month_earning)
            //     ->icon('heroicon-o-cash'),
            // Stat::make('This Year Earning', $this_year_earning)
            //     ->value($this_year_earning)
            //     ->icon('heroicon-o-cash'),
        ];
    }
}
