<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ProductOut extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'date',
        'customer_id',
        'user_id',
        'poductout_code'
    ];

    public function customer() {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        static::creating(function ($product) {
            $latestProduct = static::where('productout_code')->latest()->first();
            $latestProduct = static::latest()->first();
            if ($latestProduct) {
                $product->productout_code = 'TRO' . str_pad($latestProduct->id + 1, 5, '0', STR_PAD_LEFT);
            } else {
                $product->productout_code = 'TRO00001';
            }
        });
    }


}
