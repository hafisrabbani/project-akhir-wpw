<?php

namespace App\Helpers;

use Exception;

class FileHandler
{
    public function upload($inputName, $destination, $allowedExtensions = [], $maxSize = 2048)
    {
        if (!isset($_FILES[$inputName])) {
            throw new Exception("File not found");
        }

        $file = $_FILES[$inputName];
        $fileName = $file['name'];
        $fileType = $file['type'];
        $fileSize = $file['size'];

        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (!empty($allowedExtensions) && !in_array($fileExt, $allowedExtensions)) {
            throw new Exception("File extension not allowed");
        }
        $fileName = uniqid() . '.' . $fileExt;
        $targetPath = rtrim($destination, '/') . '/' . $fileName;
        if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
            throw new Exception("File upload failed");
        }

        return [
            'path' => $targetPath,
            'file_name' => $fileName
        ];
    }

    public function download($path)
    {
        if (!file_exists($path)) {
            throw new Exception("File not found");
        }
        $fileName = public_path() . $path;
        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=$fileName");
        readfile($path);
    }

    public function validateUpload($inputName, $allowedExtensions = [], $maxSize = 2048)
    {
        if (!isset($_FILES[$inputName])) {
            return false;
        }

        $file = $_FILES[$inputName];
        $fileName = $file['name'];
        $fileSize = $file['size'];

        if ($fileSize > $maxSize * 1024) {
            return false;
        }

        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (!empty($allowedExtensions) && !in_array($fileExt, $allowedExtensions)) {
            return false;
        }

        return true;
    }
}
