<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'tbl_category';
    protected $fillable = [
        'id',
        'name'
    ];
    public function pets()
    {
        return $this->HasMany('App\Pet');
    }
    use HasFactory;
}
