<?php


namespace App\Helper;

use Illuminate\Container\Container;

class DirectoryHelper
{
    //Chandru 2022-03-22

    /**
     * Create a Directory Map
     *
     * Reads the specified directory and builds an array
     * representation of it. Sub-folders contained with the
     * directory will be mapped as well.
     *
     * @param	string	$source_dir		Path to source
     * @param	int	$directory_depth	Depth of directories to traverse
     *						(0 = fully recursive, 1 = current dir, etc)
     * @param	bool	$hidden			Whether to show hidden files
     * @return	array
     */
    function directoryMap($source_dir, $directory_depth = 0, $hidden = FALSE)
    {
        if ($fp = @opendir($source_dir)) {

            $filedata    = array();
            $new_depth    = $directory_depth - 1;
            $source_dir    = rtrim($source_dir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;

            while (FALSE !== ($file = readdir($fp))) {

                // Remove '.', '..', and hidden files [optional]
                if ($file === '.' or $file === '..' or ($hidden === FALSE && $file[0] === '.')) {
                    continue;
                }

                is_dir($source_dir . $file) && $file .= DIRECTORY_SEPARATOR;

                if (($directory_depth < 1 or $new_depth > 0) && is_dir($source_dir . $file)) {
                    $filedata[$file] = $this->directoryMap($source_dir . $file, $new_depth, $hidden);
                } else {
                    $filedata[] = $file;
                }
            }

            closedir($fp);
            return $filedata;
        }

        return FALSE;
    }
}
