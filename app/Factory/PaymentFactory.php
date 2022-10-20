<?php

namespace App\Factory;

use App\Contracts\PaymentContract;
use App\Repositories\PaymentRepository;
use App\Services\FirstPaymentService;
use App\Services\SecondPaymentService;

class PaymentFactory
{
    public static function instance($data): ?PaymentContract{
        $paymentRepository = new PaymentRepository();
        if (isset($data['merchant_id']) && $data['merchant_id'] == config('payment.first')['merchant_id']){
            return new FirstPaymentService($paymentRepository);
        } else if( isset($data['project']) && $data['project'] ==  config('payment.second')['app_id']){
            return new SecondPaymentService($paymentRepository);
        } else {
            return null;
        }
    }

}