<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductOutDetail extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'product_id',
        'product_out_id',
        'qty',
        'user_id'
    ];

    public function productout(){
        return $this->belongsTo(ProductOut::class,'product_out_id','id');
    }

    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }

}
