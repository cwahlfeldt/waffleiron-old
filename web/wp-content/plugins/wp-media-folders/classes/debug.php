<?php
/**
 * @copyright 2017 Damien Barrère
 *
 *  This program is free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program; if not, write to the Free Software
 *  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

class WP_Media_Folders_Debug {
    /**
     * If debug is enabled or not
     * @var bool
     */
    public static $debug_enabled = false;
    public static $debug_file;

    /**
     * Log into a debug file
     */
    public static function log() {
        // Do nothing if not enabled
        if(!WP_Media_Folders_Debug::$debug_enabled) {
            return;
        }

        // Retrieve arguments passed
        $args = func_get_args();

        // Check that we have at least a string to log
        if($args<2) {
            return;
        }

        $dir = dirname(WP_Media_Folders_Debug::$debug_file);
        if(!$dir) {
            mkdir($dir, 0777, true);
        }

        $arguments = array();
        for ($ij=1; $ij<count($args); $ij++) {
            $arguments[] = $args[$ij];
        }

        $fp = fopen(WP_Media_Folders_Debug::$debug_file, 'a+');
        fwrite($fp, vsprintf($args[0], $arguments).PHP_EOL);
        fclose($fp);

    }
}