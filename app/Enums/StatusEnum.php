<?php 

namespace App\Enums;

enum StatusEnum: int
{
    case DRAFT = 1;
    case PUBLISHED = 2;
    case STARTED = 3;
    case FINISHED = 4;
    case ARCHIVED = 5;
}