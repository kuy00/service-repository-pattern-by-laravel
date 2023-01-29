<?php

namespace App\Services;

use App\Services\CRUDBaseService;
use App\Repositories\VariantRepository;
use DB;

class VariantService extends CRUDBaseService
{
    public function __construct(VariantRepository $variantRepository)
    {
        $this->repository = $variantRepository;
    }

    /**
     * Generate request data.
     *
     * @param array|null $data
     * @return Illuminate\Database\Eloquent\Model
     */
    public function create($data = null)
    {
        $vairant = [];

        try {
            DB::beginTransaction();

            $data['code'] = $data['code'] ?? $this->createCode();
            $vairant = $this->repository->create($data);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
        }

        return $vairant;
    }

    /**
     * Delete with request by product id.
     *
     * @param string $productId
     * @return Illuminate\Database\Eloquent\Model
     */
    public function deleteByProductId($productId)
    {
        return $this->repository->deleteByProductId($productId);
    }

    /**
     * Generate random code.
     *
     * @param array|null $data
     * @return Illuminate\Database\Eloquent\Model
     */
    public function createCode()
    {
        return rand(000000,999999);
    }
}
