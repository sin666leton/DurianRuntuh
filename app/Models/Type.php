<?php

namespace App\Models;

use Database\Factories\TypeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    /** @use HasFactory<TypeFactory> */
    use HasFactory;

    protected $table = 'types';

    protected $fillable = [
        'user_id',
        'name',
        'code',
        'brand_id',
        'type_item_id'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function typeItem()
    {
        return $this->belongsTo(TypeItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function item()
    {
        return $this->hasOne(Item::class);
    }
}
