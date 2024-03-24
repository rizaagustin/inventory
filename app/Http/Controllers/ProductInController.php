<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductIn;
use App\Models\Customer;
use App\Models\product;
use App\Models\ProductInDetail;
use App\Models\Supplier;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
class ProductInController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest('id')->get();
        $suppliers = Supplier::latest('id')->get();

        $productins = ProductIn::with(['supplier','user'])
        ->whereHas('supplier', function ($query) {
            $query->where('name', 'like', '%' . request()->search . '%');            
        })
        ->paginate(5);
        return view('pages.productin.index', compact('productins', 'products', 'suppliers'));
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
            'supplier_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } 

        $product = ProductIn::create([
            'date' => date('Y-m-d'),
            'supplier_id' => $request->supplier_id,
            'user_id' => auth()->user()->id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data Has Been Created!',
            'data'    => $product  
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
        $productin = ProductIn::find($id);
        $suppliers = Supplier::latest('id')->get();
        $products = Product::latest('id')->get();
        $productindetails = ProductInDetail::where('product_in_id', $id)->get();
        return view('pages.productin.edit', compact('productin','suppliers','products','productindetails'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductIn $productin)
    {
        $validator = Validator::make($request->all(), [
            'supplier_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } 

        $productin = $productin->update([
            'supplier_id' => $request->supplier_id
        ]);

        return response()->json([
           'success' => true,
           'message' => 'Data Has Been Updated!',
           'data'    => $productin
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
        try {
        
            // Temukan detail produk yang akan dihapus
            $productindetail = ProductInDetail::where('product_in_id', $id)->get();
            // Periksa apakah detail produk ditemukan
            foreach ($productindetail as $detail) {
                $product = Product::find($detail->product_id);
                if ($product) {
                    $product->stock -= $detail->qty;
                    $product->save();
                }
            }

            // hapus productin
            ProductIn::where('id', $id)->delete();
            // hapus productin detail
            ProductInDetail::where('product_in_id', $id)->delete();
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Data Has Been Deleted!',
            ]);

        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Data Has Not Been Deleted!',
            ],500);
        }
                
    }
}
