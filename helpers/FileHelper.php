<?php
class FileHelper
{
    private static $folder = "public/images/";

    public static function uploadFile($origin, $imageName, $name)
    {
        $filename = explode(".", $imageName);
        $extension = $filename[1];
        if (move_uploaded_file($origin, self::$folder . $name . "." . $extension))
            return $name . "." . $extension;

        return false;
    }
}