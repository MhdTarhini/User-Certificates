<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificates extends Model
{
    use HasFactory;
    public function userCertificates()
    {
        return $this->belongsTo(UserCertificates::class,"id","certificate_id");
    }
}
