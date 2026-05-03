<?php

namespace App\Upload;

/**
 * Discover the absolute path on the disk where an upload should be placed,
 * based on paths relative to the project root (example: public/assets/...).
 */
final class UploadPathResolver
{
    /** Example: public/assets/img/users/12 → /.../project/public/assets/img/users/12/ */
    public static function directoryFromProjectRelative(string $relativePathUnderProject): string
    {
        $rel = trim(str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $relativePathUnderProject), DIRECTORY_SEPARATOR);

        return dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . $rel . DIRECTORY_SEPARATOR;
    }

    /** Join a base from config (with slashes) + segments (example: user id). */
    public static function directoryFromConfiguredBase(string $basePath, array $relativeSegments): string
    {
        $normalizedBase = str_replace('/', DIRECTORY_SEPARATOR, trim($basePath, '/\\'));
        $parts = [$normalizedBase];
        foreach ($relativeSegments as $segment) {
            $parts[] = (string) $segment;
        }
        $relative = implode(DIRECTORY_SEPARATOR, $parts);

        return self::directoryFromProjectRelative($relative);
    }
}
