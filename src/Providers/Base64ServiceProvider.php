<?php

namespace Harishpatel143\Base64Validation\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Symfony\Component\HttpFoundation\File\File;

class Base64ServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(): void
    {
//        Validator::extend(
//            'base64image',
//            'Harishpatel143\Base64Validation\Validators\Base64Validator@validateBase64Image'
//        );
        //New validation method for validate the base64 encode image.
        Validator::extend('base64image', function ($attribute, $value, $parameters, $validator) {
            return !empty($value) ? $validator->validateImage($attribute, $this->convertToFile($value)) : true;
        }, 'The avatar must be an image.');
    }


    /**
     * @param string $value
     *
     * @return File
     */
    protected function convertToFile(string $value): File
    {
        if (strpos($value, ';base64') !== false) {
            [, $value] = explode(';', $value);
            [, $value] = explode(',', $value);
        }

        $binaryData = base64_decode($value);
        $tmpFile = tempnam(sys_get_temp_dir(), 'base64validator');
        file_put_contents($tmpFile, $binaryData);

        return new File($tmpFile);
    }
}
