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
            if(!empty($item['taxes'])) {
                foreach($item['taxes'] as $tax) {
                    $taxTotal += cleanNumber($tax['amount']);
                }
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

        return $purchasing;
    }

    public function filters($filters = [])
    {
        $query = $this->model->query();
        $query = $query->with('supplier');

        if (!empty($filters['relations'])) {
            $query = $query->with($filters['relations']);
        }

        if (!empty($filters['fromdate']) && !empty($filters['todate'])) {
            $query = $query->whereBetween('date', [$filters['fromdate'], $filters['todate']]);
        }

        if (!empty($filters['keyword'])) {
            $text = $filters['keyword'];
            $query = $query->where(function($subQuery) use ($text) {
                $subQuery->whereRaw('LOWER(purchasing_name) LIKE ?', ['%' . strtolower($text) . '%'])
                    ->orWhereHas('supplier', function($relateQuery) use ($text) {
                        $relateQuery->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($text) . '%']);
                    });
            });
        }

        if (!empty($filters['id'])) {
            $data = $query->where('id', $filters['id'])->first();
        } else {
            $data = $query->orderByDesc('id')->groupBy('id')->paginate($filters['perPage']);
        }
        return $data;
    }

    public function restore($id)
    {
        $id = cleanNumber($id);
        $query = $this->model->query();
        if (is_array($id)) {
            $query = $query->whereIn('id', $id);
        } else {
            $query = $query->where('id', $id);
        }

        return $query->restore();
    }

    public function updatePurchasing($request)
    {
        $productIds = cleanNumber($request->input('productIds'));

        $billId = cleanNumber($request->input('id'));
        $purchasing = $this->filters([
            'relations' => ['details'],
            'id' => $billId,
        ]);

        $purchasing->update([
            'purchasing_name' => 'id',
            'date' => Carbon::createFromFormat('d/m/Y', cleanInput($request->input('date')))->toDateString(),
            'supplier_id' => intval(cleanInput($request->input('supplier'))),
            'cost' => cleanNumber($request->input('total')),
            'paid' => cleanNumber($request->input('paid')),
            'debt' => cleanNumber($request->input('debt')),
            'note' => cleanInput($request->input('note')),
            'user_add' => Auth::user()->id,
        ]);

        $billItems = PurchasingItem::query()->withTrashed()->where('purchasing_id', $billId)->get();
        $billItemIds = $billItems->pluck('id')->toArray();
        if (isset($billItems)) {
            $billItems->each(function($billItem) {
                $billItem->forceDelete();
            });
        }
        $taxItems = PurchasingItemTax::query()->where('item_id', $billItemIds)->delete();

        $items = $request->input('items');
        foreach($items as $item) {
            $taxTotal = 0;
            if(!empty($item['taxes'])) {
                foreach($item['taxes'] as $tax) {
                    $taxTotal += cleanNumber($tax['amount']);
                }
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
        
        if (!empty($request->input('discount_value'))) {
            PurchasingDiscount::updateOrCreate(
                ['purchasing_id' => $billId],
                [
                    'purchasing_id' => $purchasing->id,
                    'discount_unit' => cleanInput($request->input('discount_percent')) === 'true' ? 0 : 1,
                    'discount_value' => cleanInput($request->input('discount_percent')) === 'true' ? floatval($request->input('discount_value')) : cleanNumber($request->input('discount_value')),
                    'total' => cleanNumber($request->input('discount_amount')),
                ]
            );
        } else {
            $billDiscount = PurchasingDiscount::query()->where('purchasing_id', $billId)->first();
            if (isset($billDiscount)) {
                $billDiscount->delete();
            }
        }
        $newPurchasing = $this->filters([
            'relations' => ['details'],
            'id' => $billId,
        ]);

        return array($purchasing, $newPurchasing);
    }
}