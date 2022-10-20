<?php

namespace App\Services;

use App\Contracts\PaymentContract;
use App\Enum\PaymentTypeEnum;
use App\Enum\StatusCodeEnum;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use Exception;

class SecondPaymentService implements PaymentContract
{
    private PaymentRepositoryInterface $paymentRepository;
    private array $config;


    public function __construct(PaymentRepositoryInterface $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
        $this->config = config('payment.second');

    }

    /**
     * @param array $paymentParams
     * @param string|null $token
     * @return array
     * @throws Exception
     */
    public function process(array $paymentParams, string|null $token): array
    {
        if (!$this->check($paymentParams, $token)){
            throw new Exception(config('messages.code_description.' . StatusCodeEnum::INVALID_SIGNATURE->value), StatusCodeEnum::INVALID_SIGNATURE->value);
        }

        if ($this->paymentRepository->countByPaymentType(PaymentTypeEnum::SECOND_PAYMENT->value) >= $this->config['limit']){
            throw new Exception(config('messages.code_description.' . StatusCodeEnum::LIMIT_EXCEEDED->value), StatusCodeEnum::LIMIT_EXCEEDED->value);
        }

        $payment = $this->paymentRepository->getByPaymentIdAndType($paymentParams['invoice'], PaymentTypeEnum::SECOND_PAYMENT->value);

        $paymentData = [
            'payment_id' => $paymentParams['invoice'],
            'status' => $paymentParams['status'],
            'amount' => $paymentParams['amount'],
            'amount_paid' => $paymentParams['amount_paid'],
            'payment_type' => PaymentTypeEnum::SECOND_PAYMENT->value,
        ];

        if($payment){

            $this->paymentRepository->update($payment['id'], $paymentData);
            return array_merge($payment->toArray(), $paymentData);
        }

        return $this->paymentRepository->create($paymentData);
    }

    /**
     * @param array $paymentParams
     * @param string|null $signature
     * @return bool
     */
    public function check(array $paymentParams, string|null $signature):bool
    {
        $values = [];

        ksort($paymentParams);

        foreach ($paymentParams as $key => $value)
            $values[] = $value;

        $values[] = $this->config['app_key'];

        $hash = hash('MD5',implode('.', $values));

        if ( $hash === $signature)
            return true;

        return false;
    }

    /**
     * @param array $paymentParams
     * @return string
     */
    public function sign(array $paymentParams): string
    {
        $values = array();

        ksort($paymentParams);
        foreach ($paymentParams as $key => $value)
            $values[] = $value;

        $values[] = $this->config['app_key'];

        return hash('MD5',implode('.', $values));
    }
}