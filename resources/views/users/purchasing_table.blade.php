<div class="">
    @forelse($purchasing as $bill)
        <!--begin::Item-->
        <div class="d-flex flex-stack align-items-center position-relative mt-6">
            <!--begin::Label-->
            <div class="position-absolute top-0 start-0 rounded h-100 bg-secondary w-4px"></div>
            <!--end::Label-->
            <!--begin::Details-->
            <div class="fw-bold ms-5">
                <!--begin::Time-->
                <div class="fs-7 mb-1">
                    <span class="fs-7 text-muted text-uppercase">{{ $bill->purchasing_name }}</span>
                </div>
                <!--end::Time-->
                <!--begin::Title-->
                <a href="{{ route('purchasing.show', ['id' => $bill->id]) }}" class="fs-5 fw-bolder text-dark text-hover-primary mb-2">{{ json_decode($bill->supplier->name) }}</a>
                <!--end::Title-->
                <!--begin::User-->
                <div class="fs-7 text-muted">{{ date('d-m-Y', strtotime($bill->date)) }}</div>
                <!--end::User-->
            </div>
            <!--end::Details-->
            <!--begin::Menu-->
            <div class="d-flex justify-content-end">
                <a class="btn btn-icon btn-active-light-primary w-30px h-30px me-3 update-btn" href="{{ route('purchasing.show', ['id' => $bill->id]) }}" title="{{__('common.update')}}">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                    <span class="svg-icon svg-icon-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <path
                                d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z"
                                fill="currentColor" />
                            <path opacity="0.3"
                                d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z"
                                fill="currentColor" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </a>
            </div>
            <!--end::Menu-->
        </div>
        <!--end::Item-->
    @empty
    @endforelse
</div>
<div class="py-4 ml-2">
    {!! $purchasing->appends(request()->all())->links('includes.paginations') !!}
</div>