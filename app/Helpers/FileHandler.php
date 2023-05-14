<?php

namespace App\Helpers;

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

        if ($fileSize > $maxSize * 1024) {
            throw new Exception("File size exceeds the limit");
        }

        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (!empty($allowedExtensions) && !in_array($fileExt, $allowedExtensions)) {
            throw new Exception("File extension not allowed");
        }

        $targetPath = rtrim($destination, '/') . '/' . uniqid() . '.' . $fileExt;
        if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
            throw new Exception("File upload failed");
        }

        return $targetPath;
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
