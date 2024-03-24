<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ProductIn extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'date',
        'supplier_id',
        'user_id',
        'poductin_code'
    ];

    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        static::creating(function ($product) {
            $latestProduct = static::where('productin_code')->latest()->first();
            $latestProduct = static::latest()->first();
            if ($latestProduct) {
                $product->productin_code = 'TRI' . str_pad($latestProduct->id + 1, 5, '0', STR_PAD_LEFT);
            } else {
                $product->productin_code = 'TRI00001';
            }
        });
    }

    // public function productindetails(){
    //     return $this->hasMany(ProductInDetail::class, 'productin_id', 'id');
    // }

}