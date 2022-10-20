<?php

use App\Enum\StatusCodeEnum;

return [
    'code_description'=>[
        StatusCodeEnum::INVALID_SIGNATURE->value => 'Не удалось верифицировать подпись.',
        StatusCodeEnum::LIMIT_EXCEEDED->value => 'Количество запросов на день превышено.',

    ]
];