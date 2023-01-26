<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\VariantService;
use App\Http\Resources\VariantResource;
use App\Http\Requests\VariantRequest;

class VariantController extends Controller
{
    private $variantService;

    public function __construct(VariantService $variantService)
    {
        $this->variantService = $variantService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 20);
        $relations = ['product'];
        $variants = $this->variantService->getPaginate($perPage, $relations);

        return VariantResource::collection($variants);
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
    public function store(VariantRequest $request)
    {
        $validated = $request->validated();
        return $this->variantService->create($validated);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $relations = ['product'];
        $variant = $this->variantService->getById($id, $relations);

        if ($variant) {
            return VariantResource::make($variant);
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
    public function update(VariantRequest $request, $id)
    {
        $validated = $request->validated();
        return $this->variantService->update($id, $validated);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->variantService->delete($id);
    }
}
