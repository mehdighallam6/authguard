<?php

namespace App\Enums;

enum RolesEnum: string
{
    case ADMIN = 'admin';
    case STANDARD = 'standard';

    public function label(): string
    {
        return match ($this) {
            static::ADMIN => 'Admin',
            static::STANDARD => 'Standard',
        };
    }
}
