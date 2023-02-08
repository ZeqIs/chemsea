<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = ['applicant_id', 'scientist_id', 'name', 'sample_type', 'sample_name', 'sample_submission', 'appointment_date', 'tracking_num', 'status'];

    public $timestamps = False;

    public function serviceRequest()
    {
        return $this->hasMany(ServiceRequest::class, 'application_id');
    }

    public function applicant()
    {
        return $this->belongsTo(User::class, 'applicant_id');
    }

    public function scientist()
    {
        return $this->belongsTo(User::class, 'scientist_id');
    }
}
