<?php

declare(strict_types=1);

namespace App\Enums;

enum UserRoleEnum: string
{
    case ADMIN = 'admin';
    case MARKETER = 'marketer';
}