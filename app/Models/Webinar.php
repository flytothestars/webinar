<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Orchid\Attachment\Attachable;

class Webinar extends Model
{
    use HasFactory, AsSource, Attachable;

    protected $fillable = [
        'title',
        'description',
        'video_url',
        'rtmp_url',
        'uuid',
        'date',
        'time',
        'status',
        'price',
    ];
}
