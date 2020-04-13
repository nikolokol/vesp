<?php

namespace App\Controllers;

use Vesp\Models\File;

class Image extends \Vesp\Controllers\Data\Image
{

    public function get()
    {
        if (!$file = File::query()->find(1)) {
            $file = new File();
            $file->uploadFile(
                'data:image/jpeg;base64,' . base64_encode(file_get_contents('http://paisteco.cyon.link/image/2145')),
                ['name' => 'test.jpg']
            );
        }

        return parent::get();
    }
}
