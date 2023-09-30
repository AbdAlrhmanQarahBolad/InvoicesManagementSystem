<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\sections;
class products extends Model
{
    use HasFactory;
    protected $guarded = [] ;  // like fillible but to all



    public function section(){
        return $this->belongsTo(sections::class);

    }




}
