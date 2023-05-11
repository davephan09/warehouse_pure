<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class DetailedPermission extends Enum implements LocalizedEnum
{
    const Read = 0;
    const Create = 1;
    const Update = 2;
    const Delete = 3;
}
