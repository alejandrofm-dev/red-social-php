<?php
class FileHelper
{
    private static $folder = "public/images/";

    public static function uploadFile($origin, $imageName, $name)
    {
        $extension = pathinfo($imageName, PATHINFO_EXTENSION);
        $newName = $name . "-" . $imageName;
        if (move_uploaded_file($origin, self::$folder . $newName))
            return $newName;

        return false;
    }

    public static function getImageUrlByName($name): string
    {
        return self::$folder . $name;
    }
}