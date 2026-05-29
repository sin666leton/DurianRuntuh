<?php

namespace App\Models;

use Database\Factories\TypeItemFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeItem extends Model
{
    /** @use HasFactory<TypeItemFactory> */
    use HasFactory;

    protected $table = 'type_items';

    protected $fillable = [
        'user_id',
        'name',
        'code'
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function types()
    {
        return $this->hasMany(Type::class);
    }
}
