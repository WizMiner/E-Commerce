<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use App\Models\Order;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\OrderResource;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestOrders extends BaseWidget
{
    //for full view display
    protected int | string | array $columnSpan = 'full';

    // for top of dashboard view
    protected static ?int $sort = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(OrderResource::getEloquentQuery())->defaultPaginationPageOption(5)->defaultSort('created_at'. 'desc')
            ->columns([

                TextColumn::make('id')->label('Order ID')->searchable(),
                TextColumn::make('users.name'),

                TextColumn::make('grand_total')->money('ETH'),

                TextColumn::make('status')->badge()->color(fn (string $state): string => match($state){
                    'new' => 'info',
                    'processing' => 'warning',
                    'shipped' => 'success',
                    'delivered' => 'success',
                    'cancelled' => 'danger',
                })
                ->icon(fn (string $state): string => match($state){
                    'new' => 'heroicon-m-sparkles',
                    'processing' => 'heroicon-m-arrow-path',
                    'shipped' => 'heroicon-m-truck',
                    'delivered' => 'heroicon-m-check-badge',
                    'cancelled' => 'heroicon-m-x-circle',
                })->sortable(),

                TextColumn::make('payment_method')->sortable()->searchable(),
                TextColumn::make('payment_status')->sortable()->badge()->searchable(),
                TextColumn::make('created_at')->label('Order Date')->dateTime(),

            ])
            ->actions([
                Action::make('View Order')->url(fn(Order $record): string => OrderResource::getUrl('view', ['record' => $record]))->color('info')->icon('heroicon-o-eye'),
            ]);
    }
}
