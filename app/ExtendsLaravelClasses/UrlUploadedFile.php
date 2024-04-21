<?php

namespace App\ExtendsLaravelClasses;

use Exception;
use Illuminate\Http\UploadedFile;

class UrlUploadedFile extends UploadedFile
{
    /**
     * @throws Exception
     */
    public static function createFromUrl(string $url, string $originalName = '', string $mimeType = null, int $error = null, bool $test = false): self
    {
        if (!$stream = fopen($url, 'r')) {
            throw new Exception('error open stream');
        }

        $tempFile = tempnam(sys_get_temp_dir(), 'url-file-');

        file_put_contents($tempFile, $stream);

        return new static($tempFile, $originalName, $mimeType, $error, $test);
    }
}
