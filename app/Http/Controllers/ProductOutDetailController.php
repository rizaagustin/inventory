<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductOutDetail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
class ProductOutDetailController extends Controller
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
            'product_out_id' => 'required',
            'product_id' => 'required',
            'qty' => 'required',
       ]); 

       if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
       }
    
        DB::beginTransaction();   

        try {


            $product = Product::find($request->product_id);

            if($product->stock < $request->qty) {
                return response()->json([
                    'success' => false,
                    'message' => 'Stock Not Available!'
                ],500);
            }

            if ($product) {
                $product->stock -= $request->qty;
                $product->save();
            }

            if(!$product){
                return response()->json([
                    'success' => false,
                    'message' => 'Product Not Found!'
                ]);
            }

            $productoutdetail = ProductOutDetail::create([
                'product_out_id' => $request->product_out_id,
                'product_id' => $request->product_id,
                'qty' => $request->qty,
                'user_id'=> auth()->user()->id
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Product Has Been Added!',
                'data' => $productoutdetail
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Product Not Added.',
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

        try{
            //return response

            $productoutdetail = ProductOutDetail::find($id);

            if (!$productoutdetail) {
                return response()->json([
                    'success' => false,
                    'message' => 'Detail Produk tidak ditemukan.',
                ]);
            }

            $product = Product::find($productoutdetail->product_id);
            if ($product) {
                $product->stock += $productoutdetail->qty;
                $product->save();
            }
            
            // delete by ID
            ProductOutDetail::where('id', $id)->delete();

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Data Berhasil Dihapus!',
            ]); 

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus data.',
                'error' => $e->getMessage(),
            ],500);
        }
    }
}
