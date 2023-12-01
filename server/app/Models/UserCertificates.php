<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCertificates extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'certificate_id',
    ];
    public function user()
    {
        return $this->hasMany(User::class,"user_id");
    }
    public function certificate()
    {
        return $this->hasMany(Certificates::class,"certificate_id");
    }
}
