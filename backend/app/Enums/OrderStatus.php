<?php

namespace App\Enums;

enum OrderStatus: string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case CANCELED = 'canceled';
}
