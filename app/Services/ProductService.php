<?php

namespace App\Services;

use App\Services\CRUDBaseService;
use App\Repositories\ProductRepository;
use App\Repositories\VariantRepository;
use DB;

class ProductService extends CRUDBaseService
{
    private $variantService;

    public function __construct(ProductRepository $productRepository, VariantService $variantService)
    {
        $this->repository = $productRepository;
        $this->variantService = $variantService;
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
                $variant = $this->variantService->create($value);

                if ($variant) {
                    DB::commit();
                } else {
                    DB::rollback();
                    $product = [];
                }
            }
            $product->variants;

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
            $variant = $this->variantService->deleteByProductId($id);

            if ($variant) {
                DB::commit();
            } else {
                DB::rollback();
                $product = [];
            }
        } catch (\Throwable $th) {
            DB::rollback();
            $product = [];
        }

        return $product;
    }
}
