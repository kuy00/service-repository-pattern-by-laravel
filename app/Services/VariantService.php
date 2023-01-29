<?php

namespace App\Services;

use App\Services\CRUDBaseService;
use App\Repositories\VariantRepository;

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
            $data['code'] = $data['code'] ?? $this->createCode();
            $vairant = $this->repository->create($data);
        } catch (\Throwable $th) {
            throw new \Exception('옵션 등록 실패');
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
        $vairant = [];

        try {
            $vairant = $this->repository->deleteByProductId($productId);
        } catch (\Throwable $th) {
            throw new \Exception('옵션 삭제 실패');
        }

        return $vairant;
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
