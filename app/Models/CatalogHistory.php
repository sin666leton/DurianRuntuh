<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatalogHistory extends Model
{
    protected $table = 'catalog_history';

    protected $fillable = [
        'user_id',
        'model_id',
        'model_type',
        'action',
        'changes'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
