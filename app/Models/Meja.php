<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    use HasFactory;

    protected $table = "tb_meja";
    protected $primaryKey = "id_meja";
    protected $keyType = "string";
    public $incrementing = false;    
    protected $guarded = ['id_meja'];    
}
