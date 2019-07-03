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

class WP_Media_Folders {

    protected $plugin_main_file;

    public function __construct($plugin_main_file)
    {
        $this->plugin_main_file = $plugin_main_file;

        register_activation_hook($plugin_main_file, function(){
            $options = get_option('wp-media-folders-tables');
            if(!$options) {
                add_option('wp-media-folders-tables', array(
                    'wp_posts' => array(
                        'post_content' => 1,
                        'post_excerpt' => 1
                    )
                ));
            }
        });

        // Enable logging if needed
        include_once(dirname($this->plugin_main_file) . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'debug.php');
        $options = get_option('wp-media-folders-options');
        if(isset($options['mode_debug'])) {
            WP_Media_Folders_Debug::$debug_enabled = true;
            WP_Media_Folders_Debug::$debug_file = dirname($this->plugin_main_file) . DIRECTORY_SEPARATOR . 'debug.log';
        }

        add_action('admin_init', function() {
            register_setting('wp-media-folders', 'wp-media-folders-tables');
            register_setting('wp-media-folders', 'wp-media-folders-options');
        });

        add_action('admin_menu', function(){
            add_options_page(__('WP Media Folders', 'wp-media-folders'), 'WP Media Folders', 'manage_options', 'wp-media-folders-settings', function() {
                global $wpdb;
                $this->tables = get_option('wp-media-folders-tables');
                $this->options = get_option('wp-media-folders-options');
                $this->fields = $wpdb->get_results('SELECT TABLE_NAME, COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE DATA_TYPE IN ("varchar", "text", "tinytext", "mediumtext", "longtext") AND TABLE_SCHEMA = "'.DB_NAME.'" ORDER BY TABLE_NAME', OBJECT );

                include_once(dirname($this->plugin_main_file) . DIRECTORY_SEPARATOR . 'settings_view.php');
            });
        });

        /**
         * Add an input to allow changing file path
         */
        add_filter('attachment_fields_to_edit', function ($form_fields, $post) {
            $url = wp_get_attachment_url($post->ID);

            $uploads = wp_upload_dir();

            if(strpos($url, $uploads['baseurl'])!==0) {
                $html = __('This file is not in the allowed upload folder', 'wp-media-folders');
            } else {
                $path = str_replace($uploads['baseurl'], '', $url);

                $file_extension = pathinfo($path, PATHINFO_EXTENSION);

                $path = substr($path, 0, -(strlen($file_extension)+1));

                $html = '<input name="attachments['.$post->ID.'][file_path]" id="attachments['.$post->ID.'][file_path]" value="'.htmlentities($path).'" /> . '.$file_extension;
            }

            $form_fields['file_path'] = array(
                'label' => __('File path','wp-media-folders'),
                'input' => 'html',
                'html' => $html,
                'helps' => __(sprintf('File path and name related to upload folder %s', '/' . substr($uploads['basedir'], strlen(get_home_path()))), 'wp-media-folders')
            );

            return $form_fields;
        }, 10, 2 );

        /**
         * Save modification made on media page
         */
        add_filter('attachment_fields_to_save', function ($post, $attachment) {
            if(isset($attachment['file_path'])) {

                $result = $this->moveFile($post['ID'], $attachment['file_path'], true);

                if(is_wp_error($result)) {
                    $post['errors']['file_path']['errors'][] = $result->get_error_message();
                    return $post;
                }
            }

            return $post;
        }, 10, 2);
    }

    /**
     * @param $post_id int Attachment id
     * @param $destination string destination folder to move the file to
     * @param $destination_with_filename boolean Does the destination parameter contains also the file name (without extension)
     * @return bool|WP_Error true on success or WP_ERROR
     */
    private function moveFile($post_id, $destination, $destination_with_filename = true) {
        $uploads = wp_upload_dir();

        $full_path_file = get_attached_file($post_id, 1);

        if(strpos($full_path_file, $uploads['basedir'])!==0) {
            WP_Media_Folders_Debug::log('Error : file is not int the upload folder %s', $full_path_file);
            return new WP_Error('error', __('This file is not in the allowed upload folder', 'wp-media-folders'));
        }

        // Retrieve the file name and append it to the destination
        if($destination_with_filename !== true) {
            $file_name = pathinfo($full_path_file, PATHINFO_FILENAME);
            $destination = $destination .DIRECTORY_SEPARATOR . $file_name;
        }

        // Sanitize path
        $destination = $this->sanitizePath($destination);
        if(!strlen(trim($destination, '/'))) {
            WP_Media_Folders_Debug::log('Error : destination file empty');
            return new WP_Error('error', __('The file name cannot be empty', 'wp-media-folders'));
        }

        // Retrieve file extension
        $file_extension = pathinfo($full_path_file, PATHINFO_EXTENSION);

        // Check if source file exists
        if(!file_exists($full_path_file) || !is_file($full_path_file)) {
            WP_Media_Folders_Debug::log('Error : file %s does not exist', $full_path_file);
            return new WP_Error('error', __('This file doesn\'t exist', 'wp-media-folders'));
        }

        $new_file_path = DIRECTORY_SEPARATOR . $destination . '.' . $file_extension;
        $new_file = $uploads['basedir'] . $new_file_path;

        // Check is there is already a destination file with this name
        if(file_exists($new_file)) {
            WP_Media_Folders_Debug::log('Error : file is %s already exists', $new_file);
            return new WP_Error('error', __('The destination file already exists', 'wp-media-folders'));
        }

        // Create directory
        $dir = pathinfo($new_file, PATHINFO_DIRNAME);
        if(!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }

        // Move actual file
        if(!rename($full_path_file, $new_file)) {
            WP_Media_Folders_Debug::log('Error : moving file %s to %s went wrong', $full_path_file, $new_file);
            return new WP_Error('error', __('Error while moving the file', 'wp-media-folders'));
        }
        WP_Media_Folders_Debug::log('Info : file moved from %s to %s', $full_path_file, $new_file);

        // Todo update guid via sql query ???

        // Get previous images url
        $previous_images_url = $this->getAllImagesUrl($post_id);

        // Get previous thumbnails files
        $previous_thumbnails_files = $this->getAllThumbnails($post_id);

        // Update file meta
        if(update_post_meta($post_id, '_wp_attached_file', ltrim($new_file_path, DIRECTORY_SEPARATOR))!==true) {
            WP_Media_Folders_Debug::log('Error : updating post meta failed %s %s', $post_id, ltrim($new_file_path,DIRECTORY_SEPARATOR));
            return new WP_Error('error', __('Error while updating post meta', 'wp-media-folders'));
        }

        // Remove all thumbnails files
        foreach ($previous_thumbnails_files as $thumbnails_file) {
            if(file_exists($thumbnails_file)) {
                WP_Media_Folders_Debug::log('Info : delete thumbnail %s', $thumbnails_file);
                unlink($thumbnails_file);
            }
        }

        // Regenerate thumbnails in the new folder
        $this->regenerateThumbnail($post_id);

        // Get all images of this post
        $new_images_url = $this->getAllImagesUrl($post_id);

        // Replace in database file url
        global $wpdb;
        $tables = get_option('wp-media-folders-tables');
        foreach ($previous_images_url as $size => $previous_image_url) {
            $fields = array();
            $last_table = null;
            foreach ($tables as $table => $field) {
                if($table !== $last_table) {
                    // Process last query
                    if(count($fields)) {
                        $query = 'UPDATE `'.esc_sql($last_table).'` SET ' . implode(',', $fields);
                        $nb_rows = $wpdb->query($query);
                        WP_Media_Folders_Debug::log('Query (%s row affected) : %s', $nb_rows, $query);

                        // Reset fiels for new query
                        $fields = array();
                    }

                    // Save current table
                    $last_table = $table;
                }
                $fields[] = '`'.current(array_keys($field)).'` = replace(`'.esc_sql(current(array_keys($field))).'`, "'.esc_sql($previous_image_url).'", "'.esc_sql($new_images_url[$size]).'")';
            }
            if(count($fields)) {
                $query = 'UPDATE `'.esc_sql($last_table).'` SET ' . implode(',', $fields);
                $nb_rows = $wpdb->query($query);
                WP_Media_Folders_Debug::log('Query (%s row affected) : %s', $nb_rows, $query);
            }
        }

        return true;
    }

    /**
     * @param $post_id int the ID of the post to move
     * @param $folder string the new folder to move the media to
     * @return bool
     */
    private function changeFolder($post_id, $folder) {
        return true;
    }

    private function sanitizePath($path) {
        $path = str_replace('\\', DIRECTORY_SEPARATOR, $path);

        $path = explode(DIRECTORY_SEPARATOR, $path);

        $stack = array();
        foreach ($path as $seg) {
            // Remove all dots segments
            if ($seg === '..' || $seg === '.') {
                // Ignore this segment
                continue;
            }

            // Remove all non matching caracters
            $seg = preg_replace('/[^0-9a-zA-Z_-]/', '', $seg);
            
            if(strlen($seg)) {
                $stack[] = $seg;
            }
        }

        return implode(DIRECTORY_SEPARATOR, $stack);
    }

    private function regenerateThumbnail($post_id) {
        $attachment = get_post( $post_id );

        $result = wp_generate_attachment_metadata($attachment->ID, get_attached_file($attachment->ID) );
        if (!$result || is_wp_error($result)) {
            return false;
        }

        wp_update_attachment_metadata($attachment->ID, $result);
        return true;
    }

    /**
     * Return a list the main image and all thumbnails of the attachment
     * @param $post_id int Attachment id
     * @return array
     */
    private function getAllImagesUrl($post_id) {
        $images = array();

        // Add main image
        $images['original'] = wp_get_attachment_url($post_id);

        foreach (get_intermediate_image_sizes() as $size) {
            $image = image_downsize($post_id, $size);

            if($image !== false && $image[3] === true) {
                $images[$image[1].'x'.$image[2]] = $image[0];
            }
        }
        return array_unique($images);
    }


    /**
     * Return a list all thumbnails path of the attachment
     * @param $post_id int Attachment id
     * @return array
     */
    private function getAllThumbnails($post_id) {
        // Get upload folder informations
        $uploads = wp_upload_dir();

        // Retrieve url list of all images
        $images = $this->getAllImagesUrl($post_id);

        // Remove the original image as we only want thumbnails
        unset($images['original']);

        foreach ($images as &$image) {
            // Replace base url by the base dir
            $image = str_replace($uploads['baseurl'], $uploads['basedir'], $image);

            // Replace slashes by system directory separator
            str_replace('/', DIRECTORY_SEPARATOR, $image);
        }

        return $images;
    }
}