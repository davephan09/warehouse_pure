<?php 
namespace App\Repositories;

use App\Models\Purchasing;
use App\Models\PurchasingDiscount;
use App\Models\PurchasingItem;
use App\Models\PurchasingItemTax;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PurchasingRepository extends Repository
{
    public function getModel(): string
    {
        return Purchasing::class;
    }

    public function createPurchasing($request)
    {
        $productIds = cleanNumber($request->input('productIds'));
        $purchasing = $this->model->create([
            'purchasing_name' => 'id',
            'date' => Carbon::createFromFormat('d/m/Y', cleanInput($request->input('date')))->toDateString(),
            'supplier_id' => intval(cleanInput($request->input('supplier'))),
            'cost' => cleanNumber($request->input('total')),
            'paid' => cleanNumber($request->input('paid')),
            'debt' => cleanNumber($request->input('debt')),
            'note' => cleanInput($request->input('note')),
            'user_add' => Auth::user()->id,
        ]);
        $items = $request->input('items');
        foreach($items as $item) {
            $taxTotal = 0;
            foreach($item['taxes'] as $tax) {
                $taxTotal += cleanNumber($tax['amount']);
            }
            $purchasingItem = PurchasingItem::query()->create([
                'purchasing_id' => $purchasing->id,
                'product_id' => $productIds[$item['itemId']],
                'option_id' => cleanNumber($item['itemId']),
                'quantity' => cleanNumber($item['quantity']),
                'price' => cleanNumber($item['price']),
                'total' => cleanNumber($item['total']),
                'tax' => $taxTotal,
                'discount' => empty($request->input('discount_value')) ? 0 : cleanNumber($request->input('discount_amount')),
            ]);
            if(!empty($item['taxes'])) {
                foreach($item['taxes'] as $tax) {
                    PurchasingItemTax::query()->create([
                        'item_id' => $purchasingItem->id,
                        'tax_id' => cleanNumber($tax['type']),
                        'percent' => floatval($tax['value']),
                        'value' => cleanNumber($tax['amount']),
                    ]);
                }
            }
        }
        if(!empty($request->input('discount_value'))) {
            PurchasingDiscount::query()->create([
                'purchasing_id' => $purchasing->id,
                'discount_unit' => cleanInput($request->input('discount_percent')) === 'true' ? 0 : 1,
                'discount_value' => cleanInput($request->input('discount_percent')) === 'true' ? floatval($request->input('discount_value')) : cleanNumber($request->input('discount_value')),
                'total' => cleanNumber($request->input('discount_amount')),
            ]);
        }
    }
}