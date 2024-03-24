<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $path = 'public/products';
    public function index()
    {
        $products = Product::when(request()->search,function($search){
            $search = $search->where('name','like','%'.request()->search.'%');
        })->paginate(5);

        return view('pages.product.index',compact('products'));        
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
        
        $image = $request->file('image');
        $image->storeAs($this->path,$image->hashName());

        $product = product::create([
            'name' => $request->name,
            'image' => $image->hashName(),
            'description' => $request->description,
            'uom' => $request->uom,
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
    public function edit(Product $product)
    {
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Product',
            'data'    => $product,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        if ($request->hasFile('image') == "") {
            $product->update([
                'name' => $request->name,
                'description' => $request->description,
                'uom' => $request->uom,
            ]);
        }else{
            //remove old image
            $image = Storage::disk('local')->delete($this->path.'/'.basename($product->image));

            //upload new image
            $image = $request->file('image');
            $image->storeAs($this->path,$image->hashName());
            $product->update([
                'name' => $request->name,
                'description' => $request->description,
                'uom' => $request->uom,
                'image' => $image->hashName()
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data Has Been Updated!',
            'data'    => $product
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
        $product = Product::findOrFail($id);
        $image = Storage::disk('local')->delete($this->path.'/'.basename($product->image));
        $product->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data Has Been Deleted!',
            'data'    => $product
        ]);
    }
}
