<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Order;
use App\Models\Product;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Pest\ArchPresets\Custom;
use Illuminate\Support\Number;
use Filament\Resources\Resource;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\ToggleButtons;
use App\Filament\Resources\OrderResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\OrderResource\RelationManagers;
use Filament\Forms\Components\Hidden;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    Section::make('Order Information')->schema([
                        Select::make('user_id')->label('Customer')->relationship('user', 'name')->searchable()->preload()->required(),

                        Select::make('payment_method')->options([
                            'strip' => 'Strip',
                            'cold' => 'Cash on Delivery',
                        ])->required(),

                        Select::make('payment_status')->options([
                            'pending' => 'pending',
                            'paid' => 'Paid',
                            'failed' => 'Failed',
                        ])->default('pending')->required(),

                        ToggleButtons::make('status')->inline()->required()->default('new')->options([
                            'new' => 'New',
                            'processing' => 'Processing',
                            'shipped' => 'Shipped',
                            'delivered' => 'Delivered',
                            'cancelled' => 'Cancelled',
                        ])->colors([
                            'new' => 'info',
                            'processing' => 'warning',
                            'shipped' => 'success',
                            'delivered' => 'success',
                            'cancelled' => 'danger',
                        ])->icons([
                            'new' => 'heroicon-m-sparkles',
                            'processing' => 'heroicon-m-arrow-path',
                            'shipped' => 'heroicon-m-truck',
                            'delivered' => 'heroicon-m-check-badge',
                            'cancelled' => 'heroicon-m-x-circle',
                        ]),

                        select::make('currency')->options([
                            'inr' => 'INR',
                            'usd' => 'USD',
                            'eur' => 'EUR',
                            'gbp' => 'GBP',
                        ])->default('inr')->required(),

                        select::make('shipping_method')->options([
                            'fedex' => 'Fedex',
                            'ups' => 'UPS',
                            'dhl' => 'DHL',
                            'usps' => 'usps'
                        ]),

                        Textarea::make('notes')->columnSpanFull()
                    ])->columns(2),

                    section::make('Order Items')->schema([
                        Repeater::make('items')->relationship()->schema([
                            select::make('product_id')->relationship('product', 'name')->searchable()->preload()->required()->distinct()->disableOptionsWhenSelectedInSiblingRepeaterItems()->columnSpan(4)->reactive()->afterStateUpdated(fn($state, Set $set) => $set('unit_amount', Product::find($state)?->price ?? 0))->afterStateUpdated(fn($state, Set $set) => $set('total_amount', Product::find($state)?->price ?? 0)),
                            TextInput::make('quantity')->numeric()->required()->default(1)->minValue(1)->columnSpan(2)->reactive()->afterStateUpdated(fn($state, Set $set, Get $get) => $set('total_amount', $state * $get('unit_amount'))),
                            TextInput::make('unit_amount')->numeric()->required()->disabled()->dehydrated()->columnSpan(3),
                            TextInput::make('total_amount')->numeric()->required()->dehydrated()->columnSpan(3),

                        ])->columns(12),

                        Placeholder::make('grand_total_placeholder')->label('Grand Total')->content(function (Get $get, Set $set) {
                            $total = 0;
                            if (!$repeaters = $get('items')) {
                                return $total;
                            }

                            foreach ($repeaters as $key => $repeater) {
                                $total += $get("items.{$key}.total_amount");
                            }
                            $set('grand_total', $total);
                            return Number::currency($total, 'INR');
                        }),
                        Hidden::make('grand_total')->default(0)
                    ])

                ])->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'view' => Pages\ViewOrder::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
