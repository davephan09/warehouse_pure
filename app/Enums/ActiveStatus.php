<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ActiveStatus extends Enum
{
    const All =   10;
    const Active =   1;
    const Inactive = 0;
}
