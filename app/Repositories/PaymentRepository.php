<?php

namespace App\Repositories;

use App\Models\PaymentModel;
use App\Repositories\Interfaces\PaymentRepositoryInterface;

class PaymentRepository implements PaymentRepositoryInterface
{

    public function create(array $data)
    {
        return PaymentModel::create($data)->toArray();
    }

    public function update(int $id, array $data)
    {
        PaymentModel::find($id)->update($data);
    }

    public function getByPaymentIdAndType(int $payment_id, int $payment_type)
    {
        return PaymentModel::where('payment_id',$payment_id)
            ->where('payment_type', $payment_type)
            ->first();
    }

    public function countByPaymentType(int $payment_type)
    {
        return PaymentModel::where('payment_type',$payment_type)->count();
    }
}