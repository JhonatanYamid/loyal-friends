<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $table = 'tbl_pet';
    protected $fillable = [
        'id',
        'category_id',
        'name',
        'photoUrls',
        'status',
        'updated_at',
        'created_at'
    ];
    public function categories()
    {
        return $this->BelongsTo('App\Category', 'category_id');
    }
    use HasFactory;
}
