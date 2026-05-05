<?php

namespace App\Helpers;

class DeleteDirectoryAndFiles
{
    private static string $directory;

    public static function delete(string $directory): void
    {
        self::$directory = $directory;
        self::deleteFiles();
        self::deleteDirectory();
    }

    private static function deleteFiles(): void
    {
        $files = glob(self::$directory . '/*');
        if ($files === false) {
            return;
        }

        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }
    }

    private static function deleteDirectory(): void
    {
        if (is_dir(self::$directory)) {
            rmdir(self::$directory);
        }
    }
    
}