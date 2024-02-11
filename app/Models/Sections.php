<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sections extends Model
{
    use HasFactory;
    protected $fillable = [
        'section_name',
        'description',
        'created_at',
        'updated_at'
    ] ;
    
    protected $table = 'sections';

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function invoice(){
        return $this->hasMany(Invoices::class);
    }
}
