<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Webinar extends Model
{
    use HasFactory, AsSource;

    protected $fillable = [
        'title',
        'description',
        'video_url',
        'rtmp_url',
        'date',
        'time',
        'status',
        'price',
    ];
}
