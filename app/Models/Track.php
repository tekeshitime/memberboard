<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    protected $fillable = [
        'trackTitle',
        'pathArtwork',
        'bpm',
        'key',
        'pathSampleFile',
        'pathDownloadFile',
        'price',
        'additionalInfo',
    ];
}
