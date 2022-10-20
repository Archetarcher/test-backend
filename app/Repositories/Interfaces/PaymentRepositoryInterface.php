<?php

namespace App\Repositories\Interfaces;

interface PaymentRepositoryInterface
{
    public function create(array $data);

    public function update(int $id, array $data);

    public function getByPaymentIdAndType(int $payment_id, int $payment_type);

    public function countByPaymentType(int $payment_type);


}