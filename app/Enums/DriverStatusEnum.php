<?php

namespace App\Enums;

enum DriverStatusEnum: string
{
    case ACTIVE = 'Active';
    case INACTIVE = 'Inactive';
    case ON_LEAVE = 'On Leave';
    case SUSPENDED = 'Suspended';
}
