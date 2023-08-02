<?php

namespace App\Listeners;

use App\Events\PurchasingBillCreated;
use App\Repositories\ProductRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Throwable;

class UpdateProduct implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * The number of times the queued listener may be attempted.
     *
     * @var int
     */
    public $tries = 5;

    private $productRp;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(ProductRepository $productRp)
    {
        $this->productRp = $productRp;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\PurchasingBillCreated  $event
     * @return void
     */
    public function handle(PurchasingBillCreated $event)
    {
        $purchasing = $event->getPurchasing();
        $type = $event->getType();
        $oldPurchasing = $event->getOldPurchasing();
        switch ($type)
        {
            case 'create':
                $this->modifyQuantity($purchasing);
                break;
            case 'update':
                $this->modifyQuantity($oldPurchasing, false);
                $this->modifyQuantity($purchasing);
                break;
            case 'delete':
                $this->modifyQuantity($purchasing, false);
                break;
            default:
                break;
        }
        \Illuminate\Support\Facades\Log::info("Queue has updated products follow purchasing bill ({$type}): " . collect($oldPurchasing)->toJson());
    }

    public function failed(PurchasingBillCreated $event, Throwable $exception): void
    {
        \Illuminate\Support\Facades\Log::emergency('Listeners/UpdateProduct failed: ' . collect($event->getPurchasing())->toJson(), $exception->getTrace());
    }


    public function modifyQuantity($purchasing, $isAdd = true)
    {
        $options = collect($purchasing['details'])->keyBy('option_id');
        $optionIds = collect($purchasing['details'])->pluck('option_id')->toArray();
        $variations = $this->productRp->variationFilters([
            'ids' => $optionIds,
        ]);
        foreach ($variations as $variation) {
            if ($isAdd) {
                $variation->quantity += $options[$variation->id]['quantity'];
            } else {
                $variation->quantity -= $options[$variation->id]['quantity'];
            }
            $variation->save();
        }

        $productArr = array();
        $productGroups = collect($purchasing['details'])->groupBy('product_id');
        foreach($productGroups as $id => $group) {
            $productArr[$id] = $group->sum('quantity');
        }
        $productIds = collect($purchasing['details'])->pluck('product_id')->toArray();
        $products = $this->productRp->filters([
            'productIds' => $productIds,
        ]);
        foreach ($products as $product) {
            if ($isAdd) {
                $product->quantity += $productArr[$product->id];
            } else {
                $product->quantity -= $productArr[$product->id];
            }
            $product->save();
        }
    }
}
