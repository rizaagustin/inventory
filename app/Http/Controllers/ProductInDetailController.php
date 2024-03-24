<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductInDetail;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use App\Models\ProductIn;
use Illuminate\Support\Facades\DB;

class ProductInDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
       $validator = Validator::make($request->all(),[
            'product_in_id' => 'required',
            'product_id' => 'required',
            'qty' => 'required',
       ]); 

       if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
       }

       DB::beginTransaction();

       try {

            $productindetail = ProductInDetail::create([
                'product_in_id' => $request->product_in_id,
                'product_id' => $request->product_id,
                'qty' => $request->qty,
                'user_id'=> auth()->user()->id
            ]);

            // menambahkan qty pada product
            $product = Product::find($request->product_id);
            if ($product) {
                $product->stock += $request->qty;
                $product->save();
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Product Berhasil Disimpan!',
                'data' => $productindetail
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data.',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {

            // Temukan detail produk yang akan dihapus
            $productindetail = ProductInDetail::find($id);
            
            // Periksa apakah detail produk ditemukan
            if (!$productindetail) {
                return response()->json([
                    'success' => false,
                    'message' => 'Detail Produk tidak ditemukan.',
                ],500);
            }

            $product = Product::find($productindetail->product_id);
            if ($product) {
                $product->stock -= $productindetail->qty;
                $product->save();
            }

            //delete by ID
            ProductInDetail::where('id', $id)->delete();

            DB::commit();

            // return response
            return response()->json([
                'success' => true,
                'message' => 'Data Has Been Deleted!',
            ]); 


        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Data Has Been Not Deleted.',
                'error' => $e->getMessage(),
            ],500);
        }
    }

}
