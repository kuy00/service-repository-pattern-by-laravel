<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Resources\ProductResource;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 20);
        $relations = ['variants'];
        $products = $this->productService->getPaginate($perPage, $relations);

        return ProductResource::collection($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $response = [
            'result' => true,
            'message' => '상품 등록 성공',
            'data' => [],
        ];

        try {
            $validated = $request->validated();
            $response['data'] = $this->productService->create($validated);
        } catch (\Throwable $th) {
            $response['result'] = false;
            $response['message'] = $th->getMessage();
        }

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $relations = ['variants'];
        $product = $this->productService->getById($id, $relations);

        if ($product) {
            return ProductResource::make($product);
        } else {
            return new \stdClass();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $validated = $request->validated();
        return $this->productService->update($id, $validated);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = [
            'result' => true,
            'message' => '상품 삭제 성공',
            'data' => [],
        ];

        try {
            $response['data'] = $this->productService->delete($id);
        } catch (\Throwable $th) {
            $response['result'] = false;
            $response['message'] = $th->getMessage();
        }

        return $response;
    }
}
