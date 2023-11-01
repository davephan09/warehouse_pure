@extends('layouts.master')

@section('breadcrumb')
{{ Breadcrumbs::render('purchasing_show', $bill) }}
@endsection

@section('content')
<div class="card">
    <!-- begin::Body-->
    <div class="card-body py-20">
        <!-- begin::Wrapper-->
        <div class="mw-lg-950px mx-auto w-100">
            <!-- begin::Header-->
            <div class="d-flex justify-content-between flex-column flex-sm-row mb-19">
                <h4 class="fw-boldest text-gray-800 fs-2qx pe-5 pb-7">{{ __('purchasing.invoice') }}</h4>
                <!--end::Logo-->
                <div class="text-sm-end">
                    <!--begin::Logo-->
                    <a href="#" class="d-block mw-150px ms-sm-auto">
                        <img alt="Logo" src="assets/media/svg/brand-logos/lloyds-of-london-logo.svg" class="w-100" />
                    </a>
                    <!--end::Logo-->
                    <!--begin::Text-->
                    <div class="text-sm-end fw-bold fs-4 text-muted mt-7">
                        @php
                            $supplier = $bill->supplier;
                            $province = $supplier->province ? $address[$supplier->province]->name : '';
                            $district = $supplier->district ? $address[$supplier->province]->districts[$supplier->district]->name : '';
                            $ward = $supplier->ward ? $address[$supplier->province]->districts[$supplier->district]->wards[$supplier->ward]->name : '';
                        @endphp
                        <div>{{ json_decode($supplier->detail_address) . ', ' . $ward . ', ' . $district . ', ' . $province }}</div>
                        <div>{{ json_decode($supplier->phone) }}</div>
                    </div>
                    <!--end::Text-->
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="pb-12">
                <!--begin::Wrapper-->
                <div class="d-flex flex-column gap-7 gap-md-10">
                    <!--begin::Message-->
                    <div class="fw-bolder fs-2">{{ json_decode($supplier->name) }}
                    {{-- <span class="fs-6">()</span>, --}}
                    <br />
                    <span class="text-muted fs-5">{{ json_decode($supplier->email) }}</span></div>
                    <!--begin::Message-->
                    <!--begin::Separator-->
                    <div class="separator"></div>
                    <!--begin::Separator-->
                    <!--begin::Order details-->
                    <div class="d-flex flex-column flex-sm-row gap-7 gap-md-10 fw-bolder">
                        <div class="flex-root d-flex flex-column">
                            <span class="text-muted">{{ __('purchasing.order_id') }}</span>
                            <span class="fs-5">{{ $bill->purchasing_name }}</span>
                        </div>
                        <div class="flex-root d-flex flex-column">
                            <span class="text-muted">{{ __('common.date') }}</span>
                            <span class="fs-5">{{ date('d/m/Y', strtotime($bill->date)) }}</span>
                        </div>
                        <div class="flex-root d-flex flex-column">
                            <span class="text-muted">{{ __('purchasing.user_add') }}</span>
                            <span class="fs-5">{{ $bill->user->first_name . ' ' . $bill->user->last_name }}</span>
                        </div>
                        <div class="flex-root d-flex flex-column">
                            <span class="text-muted">{{ __('common.create_date') }}</span>
                            <span class="fs-5">{{ date('d/m/Y', strtotime($bill->created_at)) }}</span>
                        </div>
                    </div>
                    <!--end::Order details-->
                    <!--begin::Billing & shipping-->
                    {{-- <div class="d-flex flex-column flex-sm-row gap-7 gap-md-10 fw-bolder">
                        <div class="flex-root d-flex flex-column">
                            <span class="text-muted">Billing Address</span>
                            <span class="fs-6">Unit 1/23 Hastings Road,
                            <br />Melbourne 3000,
                            <br />Victoria,
                            <br />Australia.</span>
                        </div>
                        <div class="flex-root d-flex flex-column">
                            <span class="text-muted">Shipping Address</span>
                            <span class="fs-6">Unit 1/23 Hastings Road,
                            <br />Melbourne 3000,
                            <br />Victoria,
                            <br />Australia.</span>
                        </div>
                    </div> --}}
                    <!--end::Billing & shipping-->
                    <!--begin:Order summary-->
                    <div class="d-flex justify-content-between flex-column">
                        <!--begin::Table-->
                        <div class="table-responsive border-bottom mb-9">
                            <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                <colgroup>
                                    <col class="w-40" style="width: 40%">
                                    <col class="w-10" style="width: 10%">
                                    <col class="w-10" style="width: 10%">
                                    <col class="w-20" style="width: 20%">
                                    <col class="w-20" style="width: 20%">
                                </colgroup>
                                <thead>
                                    <tr class="border-bottom fs-6 fw-bolder text-muted">
                                        <th class="min-w-175px pb-2">{{ __('purchasing.item') }}</th>
                                        <th class="min-w-70px text-end pb-2">{{ __('unit.units') }}</th>
                                        <th class="min-w-80px text-end pb-2">{{ __('product.quantity') }}</th>
                                        <th class="min-w-100px text-end pb-2">{{ __('product.price') }}</th>
                                        <th class="min-w-100px text-end pb-2">{{ __('purchasing.sum_price') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-bold text-gray-600">
                                    <!--begin::Products-->
                                    @php
                                        $total = 0;
                                    @endphp
                                    @forelse ($bill->details as $item)
                                        <tr>
                                            <td colspan="5">
                                                <table class="w-100">
                                                    <colgroup>
                                                        <col class="w-40" style="width: 40%">
                                                        <col class="w-10" style="width: 10%">
                                                        <col class="w-10" style="width: 10%">
                                                        <col class="w-20" style="width: 20%">
                                                        <col class="w-20" style="width: 20%">
                                                    </colgroup>
                                                    <tbody>
                                                        <tr class="border-0">
                                                            <!--begin::Product-->
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <!--begin::Thumbnail-->
                                                                    <a href="javascript:;" class="symbol symbol-50px">
                                                                        <span class="symbol-label" style="background-image:url({{ config('custom.get_image_api') . $item->product->thumb }});"></span>
                                                                    </a>
                                                                    <!--end::Thumbnail-->
                                                                    <!--begin::Title-->
                                                                    <div class="ms-5">
                                                                        <div class="fw-bolder">{{ $item->product->product_name . ' ('. $item->option->name .')' }}</div>
                                                                        <div class="fs-7 text-muted">{{ __('product.sku') }}: {{ $item->option->sku }}</div>
                                                                    </div>
                                                                    <!--end::Title-->
                                                                </div>
                                                            </td>
                                                            <!--end::Product-->
                                                            <!--begin::SKU-->
                                                            <td class="text-end">{{ $item->product->unit->name }}</td>
                                                            <!--end::SKU-->
                                                            <!--begin::Quantity-->
                                                            <td class="text-end">{{ number_format($item->quantity) }}</td>
                                                            <!--end::Quantity-->
                                                            <td class="text-end">{{ number_format($item->price) }}</td>
                                                            <!--begin::Total-->
                                                            <td class="text-end">{{ number_format($item->total) }}</td>
                                                            <!--end::Total-->
                                                        </tr>
                                                        @if ($item->taxes->isNotEmpty())
                                                            <tr class="">
                                                                <td colspan="2" class="text-end align-items-center p-0">
                                                                    <span>{{ __('tax.taxes') }}:</span>
                                                                </td>
                                                                <td colspan="3" class="p-0">
                                                                    @forelse ($item->taxes as $tax)
                                                                        <div class="d-flex align-items-center mb-3">
                                                                            <div class="text-end" style="width: 30%">{{ $taxes[$tax->pivot->tax_id]->name }}</div>
                                                                            <div class="text-end" style="width: 30%">{{ number_format($tax->pivot->percent) }} %</div>
                                                                            <div class="text-end" style="width: 40%">{{ number_format($tax->pivot->value) }}</div>
                                                                        </div>
                                                                    @empty
                                                                    @endforelse
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        @php
                                            $total += $item->total + $item->taxes->sum('pivot.value');
                                        @endphp
                                    @empty
                                        <tr></tr>
                                    @endforelse
                                    <!--end::Products-->
                                    <!--begin::Subtotal-->
                                    <tr>
                                        <td colspan="4" class="text-end">{{ __('purchasing.subtotal') }}</td>
                                        <td class="text-end">{{ number_format($total) }}</td>
                                    </tr>
                                    <!--end::Subtotal-->
                                    <!--begin::Discount-->
                                    @if (isset($bill->discount))
                                        <tr>
                                            <td colspan="4" class="text-end">{{ __('purchasing.discount') }}</td>
                                            <td class="text-end"> - {{ number_format($bill->discount->total) }}</td>
                                        </tr>
                                    @endif
                                    <!--end::Discount-->
                                    <!--begin::Grand total-->
                                    <tr>
                                        <td colspan="4" class="fs-3 text-dark fw-bolder text-end">{{ __('purchasing.total') }}</td>
                                        <td class="text-dark fs-3 fw-boldest text-end">{{ number_format($bill->cost) }}</td>
                                    </tr>
                                    <!--end::Grand total-->
                                </tbody>
                            </table>
                        </div>
                        <!--end::Table-->
                    </div>
                    <!--end:Order summary-->
                    <div class="d-flex flex-column">
                        <div class="text-muted fw-bold fs-4 mb-2">{{ __('common.note') }}</div>
                        <div class="fs-5">{!! $bill->note !!}</div>
                    </div>
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Body-->
            <!-- begin::Footer-->
            <div class="d-flex flex-stack flex-wrap mt-lg-20 pt-13">
                <!-- begin::Actions-->
                <div class="my-1 me-5">
                    <!-- begin::Pint-->
                    <button type="button" class="btn btn-sm btn-success my-1 me-12" onclick="window.print();">Print Invoice</button>
                    <!-- end::Pint-->
                    <!-- begin::Download-->
                    <button type="button" class="btn btn-sm btn-light-success my-1">Download</button>
                    <!-- end::Download-->
                </div>
                <!-- end::Actions-->
                <!-- begin::Action-->
                <a href="{{ route('purchasing.show', ['id' => $bill->id]) }}" class="btn btn-primary btn-sm my-1">{{ __('purchasing.update') }}</a>
                <!-- end::Action-->
            </div>
            <!-- end::Footer-->
        </div>
        <!-- end::Wrapper-->
    </div>
    <!-- end::Body-->
</div>
@endsection

@section('pageJs')
    {{-- <script src="{{ url('assets/js/pages/purchasing.show.js') }}"></script>
    <script>
        $(document).ready(function() {
            var options = {
                billId : {{ $bill->id }},
            }
            var instance = new PurchasingShowClass();
            instance.run(options);
        });
    </script> --}}
@endsection