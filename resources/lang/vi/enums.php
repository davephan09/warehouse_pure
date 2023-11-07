<?php

use App\Enums\ActiveStatus;
use App\Enums\NotificationType;
use App\Enums\NumRowPage;

return [
    ActiveStatus::class => [
        ActiveStatus::All => 'Tất cả',
        ActiveStatus::Active => 'Hoạt động',
        ActiveStatus::Inactive => 'Không hoạt động',
    ],

    NumRowPage::class => [
        NumRowPage::Ten => 10,
        NumRowPage::Fifteen => 15,
        NumRowPage::Twelve => 20,
        NumRowPage::ThirtyFive => 35,
        NumRowPage::Fifty => 50,
        NumRowPage::Hundred => 100,
        NumRowPage::TwoHundred => 200,
    ],
    
    NotificationType::class => [
        NotificationType::all => 'Tất cả thông báo',
        NotificationType::purchasing => 'Đơn nhập hàng',
        NotificationType::order => 'Đơn xuất hàng',
        NotificationType::other => 'Khác',
    ],
];