<?php

use App\Enums\ActiveStatus;

return [
    ActiveStatus::class => [
        ActiveStatus::All => 'All',
        ActiveStatus::Active => 'Active',
        ActiveStatus::Inactive => 'Inactive',
    ],
];