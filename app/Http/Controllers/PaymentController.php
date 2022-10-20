<?php

namespace App\Http\Controllers;

use App\Factory\PaymentFactory;
use App\Http\Requests\ProcessRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PaymentController extends ApiController
{
    /**
     * @param ProcessRequest $request
     * @return JsonResponse
     */
    public function process(ProcessRequest $request): JsonResponse
    {

        try {
            $validated = $request->validated();

            $result = PaymentFactory::instance($validated)->process($validated, $request->bearerToken());
        }catch (Exception $e){
            return $this->sendError($e->getCode(), $e->getMessage(),500);
        }

        return $this->sendResponse($result);

    }
}
