<?php

namespace App\Providers;

use App\Events\OrderBillCreated;
use App\Events\PurchasingBillCreated;
use App\Listeners\UpdateProductOrder;
use App\Listeners\UpdateProductPurchasing;
use App\Models\Order;
use App\Observers\OrderObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        PurchasingBillCreated::class => [
            UpdateProductPurchasing::class,
        ],

        OrderBillCreated::class => [
            UpdateProductOrder::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        //
    }
}
