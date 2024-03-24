<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductOut;
use App\Models\Customer;
use App\Models\Product;
use App\Models\ProductIn;
use Illuminate\Support\Facades\Validator;
use App\Models\ProductOutDetail;
use Illuminate\Support\Facades\DB;
class ProductOutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest('id')->get();
        $customers = Customer::latest('id')->get();

        $productouts = ProductOut::with(['customer','user'])
        ->whereHas('customer', function ($query) {
            $query->where('name', 'like', '%' . request()->search . '%');            
        })
        ->paginate(5);
        return view('pages.productout.index', compact('productouts', 'products', 'customers'));

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
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } 

        $productout = ProductOut::create([
            'date' => date('Y-m-d'),
            'customer_id' => $request->customer_id,
            'user_id' => auth()->user()->id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Has Been Created!',
            'data'    => $productout
        ]);
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
        $productout = ProductOut::find($id);
        $customers = Customer::latest('id')->get();
        $products = Product::latest('id')->get();
        $productoutdetails = ProductOutDetail::where('product_out_id', $id)->get();
        return view('pages.productout.edit', compact('productout','customers','products','productoutdetails'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductOut $productout)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } 

        $productout = $productout->update([
            'customer_id' => $request->customer_id
        ]);

        return response()->json([
           'success' => true,
           'message' => 'Data Has Been Updated!',
           'data'    => $productout
        ]);
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

            $productoutdetails = ProductOutDetail::where('product_out_id', $id)->get();
            foreach($productoutdetails as $detail){
                $product = Product::find($detail->product_id);
                $product->stock += $detail->qty;
                $product->save();
            }

            ProductOut::where('id', $id)->delete();
            ProductOutDetail::where('product_out_id', $id)->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data Has Been Deleted!',
            ]); 

        }catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Terjadi Has Been Not Deleted.',
            ], 500);
        }


     }
}
