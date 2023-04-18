<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class DetailedPermission extends Enum implements LocalizedEnum
{
    const Read = 0;
    const Write = 1;
    const Delete = 2;
}
