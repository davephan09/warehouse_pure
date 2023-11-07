<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class NotificationType extends Enum implements LocalizedEnum
{
    const all = 1;
    const purchasing = 2;
    const order = 3;
    const other = 4;
}
