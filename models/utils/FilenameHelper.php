<?php

namespace app\models\utils;

use DateTime;

/**
 * Contains functions to deal with filenames.
 */
final class FilenameHelper
{
    private function __construct()
    {
    }

    /**
     * Returns the file name with the current timestamp.
     * @param string $filename. The filename. Example: file.pdf
     * @return string The time. stamped filename. Example: file-20170224185750259238.pdf
     */
    public static function createTimeStampedFileName($filename)
    {
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $basename = basename($filename, '.' . $extension);
        $extension = ($extension == null ? '' : '.') . $extension;
        $now = DateTime::createFromFormat('U.u', number_format(microtime(true), 6, '.', ''));
        return $basename . '-' . $now->format('YmdHisu') . $extension;
    }

    /**
     * Returns only the file name without the extension.
     * @param string $filename. The filename. Example: file.pdf
     * @return string file name. Example file
     */
    public static function getFileNameNoExtension($filename)
    {
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $basename = basename($filename, '.' . $extension);
        return $basename;
    }
}