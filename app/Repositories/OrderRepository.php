<?php
namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderDiscount;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class OrderRepository extends Repository
{
    public function getModel(): string
    {
        return Order::class;
    }

    public function createOrder($request)
    {
        $productIds = cleanNumber($request->input('productIds'));
        $order = $this->model->create([
            'name' => cleanInput($request->input('orderId')),
            'date' => Carbon::createFromFormat('d/m/Y', cleanInput($request->input('date')))->toDateString(),
            'customer_id' => intval(cleanInput($request->input('customer'))),
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
            $orderItem = OrderItem::query()->create([
                'order_id' => $order->id,
                'product_id' => $productIds[$item['itemId']],
                'option_id' => cleanNumber($item['itemId']),
                'quantity' => cleanNumber($item['quantity']),
                'price' => cleanNumber($item['price']),
                'total' => cleanNumber($item['total']),
                'tax' => $taxTotal,
                // 'discount' => empty($request->input('discount_value')) ? 0 : cleanNumber($request->input('discount_amount')),
            ]);
        }
        if(!empty($request->input('discount_value'))) {
            OrderDiscount::query()->create([
                'order_id' => $order->id,
                'discount_unit' => cleanInput($request->input('discount_percent')) === 'true' ? 0 : 1,
                'discount_value' => cleanInput($request->input('discount_percent')) === 'true' ? floatval($request->input('discount_value')) : cleanNumber($request->input('discount_value')),
                'total' => cleanNumber($request->input('discount_amount')),
            ]);
        }

        $bill = $this->filters([
            'id' => $order->id,
            'relations' => ['details'],
        ]);
        return $bill;
    }

    public function filters($filters = [])
    {
        $query = $this->model->query();
        $query = $query->with('customer');

        if (!empty($filters['relations'])) {
            $query = $query->with($filters['relations']);
        }

        if (!empty($filters['fromdate']) && !empty($filters['todate'])) {
            $query = $query->whereBetween('date', [$filters['fromdate'], $filters['todate']]);
        }

        if (!empty($filters['keyword'])) {
            $text = $filters['keyword'];
            $query = $query->where(function($subQuery) use ($text) {
                $subQuery->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($text) . '%'])
                    ->orWhereHas('customer', function($relateQuery) use ($text) {
                        $relateQuery->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($text) . '%']);
                    });
            });
        }

        if (!empty($filters['date'])) {
            $query->where('date', $filters['date']);
        }

        $perPage = empty($filters['perPage']) ? 10 : $filters['perPage'];

        if (!empty($filters['id'])) {
            $data = $query->where('id', $filters['id'])->first();
        } else {
            $data = $query->orderByDesc('id')->groupBy('id')->paginate($perPage);
        }
        return $data;
    }
}