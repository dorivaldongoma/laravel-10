<?php

namespace App\Enums;

use ValueError;

enum SupportStatus: string
{
    case A = "Open";
    case C = "Closed";
    case P = "Pendent";

    public static function fromValue(string $statusValue): string
    {
        foreach (self::cases() as $status){
            if($statusValue === $status->name) {
                return $status->value;
            }
        }

        throw new ValueError("$statusValue is not a valid");
    }
}
