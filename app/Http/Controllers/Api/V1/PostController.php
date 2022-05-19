<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return Product::all();
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = validator::make($request->all(),
            [
                "name" => "required",
                "product" => "required",
            ]
        );

        if ($validator->fails()) {

            return response()->json([
                "status" => false,
                "message" => $validator->messages()
            ], 422);
        }

        $post = Product::create([
            "author_name" => $request->name,
            "product_name" => $request->product,


        ]);

        return [
            "status" => true,
            'post' => $post,
            'message' => 'Added'
        ];

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Product::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $validator = validator::make($request->all(),
            [
                "name" => "required",
                "product" => "required",
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "message" => $validator->messages()
            ], 422);
        }

        $product->update([
            "author_name" => $request->name,
            "product_name" => $request->product,

        ]);

        return [
            "status" => true,
            'post' => $product,
            'message' => 'Updated'
        ];

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return [
            'message' => "Deleted"
        ];
    }
}
