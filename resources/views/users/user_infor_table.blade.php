<div class="pb-5 fs-6">
    <!--begin::Details item-->
    <div class="fw-bolder mt-5">{{ __('user.account_id') }}</div>
    <div class="text-gray-600">{{ 'ID-' . $user->id }}</div>
    <!--begin::Details item-->
    <!--begin::Details item-->
    <div class="fw-bolder mt-5">{{ __('common.email') }}</div>
    <div class="text-gray-600">
        <a href="#" class="text-gray-600 text-hover-primary">{{ $user->email }}</a>
    </div>
    <!--begin::Details item-->
    <!--begin::Details item-->
    <div class="fw-bolder mt-5">{{ __('common.address') }}</div>
    <div class="text-gray-600"></div>
    <!--begin::Details item-->
    <!--begin::Details item-->
    <div class="fw-bolder mt-5">{{ __('common.phone') }}</div>
    <div class="text-gray-600">{{ $user->phone }}</div>
    <!--begin::Details item-->
    <!--begin::Details item-->
    <div class="fw-bolder mt-5">{{ __('user.last_login') }}</div>
    <div class="text-gray-600">{{ date('d M Y, g:i a', strtotime($user->last_login_at)) }}</div>
    <!--begin::Details item-->
</div>