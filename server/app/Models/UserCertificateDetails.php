<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCertificateDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_certificate_id',
        'major',
        'university',
        'date_achieved'
    ];
    public function userCertificate()
    {
        return $this->belongsTo(UserCertificates::class,"user_certificate_id");
    }
    
}
