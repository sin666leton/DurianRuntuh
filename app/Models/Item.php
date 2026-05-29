<?php

namespace App\Models;

use Database\Factories\ItemFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /** @use HasFactory<ItemFactory> */
    use HasFactory;

    protected $table = 'items';

    protected $fillable = [
        'type_id',
        'description',
        'code'
    ];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
