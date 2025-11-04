<?php

namespace App\Enums;

enum EquipmentStatusEnum: string
{
    case BREAKDOWN = 'Breakdown';
    case WORKING = 'Working';
    case STAND_BY = 'Stand By';
}
