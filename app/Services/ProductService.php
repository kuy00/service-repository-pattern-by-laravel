<?php

namespace App\Services;

use App\Services\CRUDBaseService;
use App\Repositories\ProductRepository;
use App\Repositories\VariantRepository;
use DB;

class ProductService extends CRUDBaseService
{
    private $variantRepository;

    public function __construct(ProductRepository $productRepository, VariantRepository $variantRepository)
    {
        $this->repository = $productRepository;
        $this->variantRepository = $variantRepository;
    }

    /**
     * Generate request data.
     *
     * @param array|null $data
     * @return Illuminate\Database\Eloquent\Model
     */
    public function create($data = null)
    {
        $product = [];

        try {
            DB::beginTransaction();

            $product = parent::create($data);
            foreach ($data['variants'] as $key => $value) {
                $value['product_id'] = $product->id;
                $variant = $this->variantRepository->create($value);

                $product['variants'][] = $variant;
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            $product = [];
        }

        return $product;
    }

    /**
     * Delete with request data.
     *
     * @param string $id
     * @return Illuminate\Database\Eloquent\Model
     */
    public function delete($id)
    {
        $product = [];

        try {
            DB::beginTransaction();

            $product = parent::delete($id);
            $this->variantRepository->deleteByProductId($id);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            $product = [];
        }

        return $product;
    }
}
