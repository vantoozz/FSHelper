<?php

class FSHelper
{

    const MAKE_FILE_ATTEMPTS = 100;

    public static function makeFilename($path, $ext)
    {
        $filename = null;
        for ($i = 0; $i < self::MAKE_FILE_ATTEMPTS; $i++) {
            if (!$filename) {
                $filename = sha1(uniqid(microtime()));
                $path1 = substr($filename, 0, 2);
                $path2 = substr($filename, 2, 2);
                $path3 = substr($filename, 4);
                $filename = $path1 . '/' . $path2 . '/' . $path3 . '.' . $ext;
                if (is_file($path . '/' . $filename)) {
                    $filename = null;
                }
            }
        }
        if ($filename) {
            if (!is_dir($path . '/' . $path1)) {
                mkdir($path . '/' . $path1);
            }
            if (!is_dir($path . '/' . $path1 . '/' . $path2)) {
                mkdir($path . '/' . $path1 . '/' . $path2);
            }
        }
        return $filename;
    }

}