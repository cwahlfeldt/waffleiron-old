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

wp_enqueue_style('wp-media-folders-settings', plugins_url(null,__FILE__).'/'.'settings.css');
?>

<div class="wrap wp-media-folders-settings">
    <h1>WP Media folders settings</h1>

    <form method="post" action="options.php">
        <h2>Tables to replace content into</h2>
        <p>
            <?php _e('Select the tables which you want the images url to be replaced into', 'wp-media-folders'); ?>
        </p>
        <div class="container">
            <?php
            settings_fields( 'wp-media-folders');
            do_settings_sections('wp-media-folders');

            $last_table = '';
            foreach ($this->fields as  $field) {
                if($last_table !== $field->TABLE_NAME) {
                    if($last_table!==''){
                        echo '</div>';
                    }
                    $last_table = $field->TABLE_NAME;
                    ?><div class="database-table"><h2><?php echo htmlentities($last_table); ?></h2><?php
                }
                ?>

                <div class="database-field">
                    <span><?php echo $field->COLUMN_NAME; ?></span>
                    <span><input
                            type="checkbox"
                            name="wp-media-folders-tables[<?php echo $last_table; ?>][<?php echo $field->COLUMN_NAME; ?>]"
                            <?php echo isset($this->tables[$last_table][$field->COLUMN_NAME])?'checked':''; ?>
                    /></span>
                </div>
            <?php } ?>
            </div>
        </div>

        <h2>Debug</h2>

        <div class="container">
            <div class="database-field">
                <span>Mode dubug activated</span>
                <span><input
                        type="checkbox"
                        name="wp-media-folders-options[mode_debug]"
                    <?php echo isset($this->options['mode_debug'])?'checked':''; ?>
                /></span>
                <i>When enabled all actions made by the plugin will be store into a log file in the plugin folder</i>
            </div>
        </div>

        <?php submit_button(); ?>

    </form>
</div>
