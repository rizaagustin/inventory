<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ProductInDetail extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'product_id',
        'product_in_id',
        'qty',
        'user_id'
    ];

    public function productin(){
        return $this->belongsTo(ProductIn::class,'product_in_id','id');
    }

    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
