<?php

namespace App\Listeners;

use App\Events\OrderBillCreated;
use App\Repositories\ProductRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Throwable;

class UpdateProductOrder implements ShouldQueue
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
     * @param  \App\Events\OrderBillCreated  $event
     * @return void
     */
    public function handle(OrderBillCreated $event)
    {
        $order = $event->getOrder();
        $type = $event->getType();
        $oldOrder = $event->getOldOrder();
        switch ($type)
        {
            case 'create':
                $this->modifyQuantity($order, false);
                break;
            case 'update':
                $this->modifyQuantity($oldOrder);
                $this->modifyQuantity($order, false);
                break;
            case 'delete':
                $this->modifyQuantity($order);
                break;
            default:
                break;
        }
        \Illuminate\Support\Facades\Log::info("Queue has updated products follow order bill ({$type}): " . collect($oldOrder)->toJson());
    }

    public function failed(OrderBillCreated $event, Throwable $exception): void
    {
        \Illuminate\Support\Facades\Log::emergency('Listeners/UpdateProductOrder failed: ' . collect($event->getOrder())->toJson(), $exception->getTrace());
    }


    public function modifyQuantity($order, $isAdd = true)
    {
        $options = collect($order['details'])->keyBy('option_id');
        $optionIds = collect($order['details'])->pluck('option_id')->toArray();
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
        $productGroups = collect($order['details'])->groupBy('product_id');
        foreach($productGroups as $id => $group) {
            $productArr[$id] = $group->sum('quantity');
        }
        $productIds = collect($order['details'])->pluck('product_id')->toArray();
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
