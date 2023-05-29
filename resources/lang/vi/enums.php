<?php

use App\Enums\ActiveStatus;

return [
    ActiveStatus::class => [
        ActiveStatus::All => 'Tất cả',
        ActiveStatus::Active => 'Hoạt động',
        ActiveStatus::Inactive => 'Không hoạt động',
    ],
];