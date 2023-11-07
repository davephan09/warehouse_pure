<?php

use App\Enums\ActiveStatus;
use App\Enums\NotificationType;
use App\Enums\NumRowPage;

return [
    ActiveStatus::class => [
        ActiveStatus::All => 'All',
        ActiveStatus::Active => 'Active',
        ActiveStatus::Inactive => 'Inactive',
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
        NotificationType::all => 'All notifications',
        NotificationType::purchasing => 'Purchasing',
        NotificationType::order => 'Order',
        NotificationType::other => 'Other',
    ],
];