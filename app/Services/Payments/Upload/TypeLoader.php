<?php

namespace App\Services\Payments\Upload;

enum TypeLoader: string
{
    case File = 'file';
    case Api = 'api';
    case User = 'user';
}
