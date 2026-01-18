<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'designation_id', 'title', 'slug', 'description', 'career_history', 'education_history', 'image_path', 'facebook', 'twitter', 'instagram', 'linkedin', 'email', 'phone', 'whatsapp', 'website', 'status', 'kategori',
    ];

    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation_id');
    }
}
