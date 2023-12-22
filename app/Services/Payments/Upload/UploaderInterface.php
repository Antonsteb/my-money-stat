<?php

namespace App\Services\Payments\Upload;

use App\Models\User;
use App\Services\Payments\Upload\Dto\ResulUploadDto;

interface UploaderInterface
{
    public function upload(User $user, object $params): ResulUploadDto;
}
