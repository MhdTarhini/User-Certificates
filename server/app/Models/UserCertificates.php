<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserCertificates extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'certificate_id',
    ];

    protected $appends = ['certificate_name','user_Certificate_Details'];
    public function user()
    {
        return $this->hasMany(User::class,"id");
    }
    public function certificate()
    {
        return $this->hasMany(Certificates::class,"id");
    }
    public function userCertificateDetails()
    {
        return $this->belongsTo(UserCertificateDetails::class,"id","user_certificate_id");
    }

    public function getCertificateNameAttribute(){
        $certificate = $this->certificate()->select('name')->first(); 
        return $certificate->name;
    }
    public function getUserCertificateDetailsAttribute(){
        $certificate = $this->userCertificateDetails()->select('name','university','date_achieved')->first(); 
        return $certificate;
    }

    public function scopeUserCertificates($query){
        $user = Auth::user();

        return $query->where("user_id", $user->id);
    }

    

}
