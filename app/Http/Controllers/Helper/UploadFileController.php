<?php

namespace App\Http\Controllers\Helper;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class UploadFileController extends Controller
{
    public function create(string $type = "id", string $folder = "jemaah", UploadedFile $file)
    {

        if ($file) {
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = "upload/" . $folder . "/" .  $type . "/";
            $file->move(public_path($path), $fileName);
            $fileUrl = $path . $fileName;

            return $fileUrl;
        }
        return null;
    }

    public function update(string $url, UploadedFile $file)
    {
        if ($file && file_exists(public_path($url))) {
            // ambil folder dan type dari url
            $folder = explode("/", $url)[1];
            $type = explode("/", $url)[2];
            unlink(public_path($url));
            $path = $this->create($type, $folder, $file);
            return $path;
        }
        return null;
    }

    public function delete($path)
    {
        if (file_exists(public_path($path))) {
            unlink(public_path($path));
            return true;
        }
        return false;
    }
    public function get($path)
    {
        if (file_exists(public_path($path))) {
            return public_path($path);
        } else {
            return public_path('assets/img/sampel/sampel 2.png');
        }
        return null;
    }
    public function check($path)
    {
        if (strlen($path) == 0) {
            return false;
        }
        if (file_exists(public_path($path))) {
            return true;
        } else {
            return false;
        }
    }
}
