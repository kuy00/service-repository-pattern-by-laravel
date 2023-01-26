<?php

namespace App\Services;

use App\Services\CRUDBaseService;
use App\Repositories\ProductRepository;
use App\Repositories\VariantRepository;
use DB;
use Illuminate\Support\Arr;

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
            $variants = $product->variants()->createMany($data['variants']);
            Arr::set($product, 'variants', $variants);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
        }

        return $product;
    }
}
