<?php
namespace App\Enum;

enum StatusCodeEnum:int {

    case INVALID_SIGNATURE = 401;
    case LIMIT_EXCEEDED = 500;
}