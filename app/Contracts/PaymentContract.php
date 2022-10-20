<?php

namespace App\Contracts;

interface PaymentContract
{
    public function process(array $paymentParams, string $token);

    public function check(array $paymentParams, string $signature);

    public function sign(array $paymentParams);


}