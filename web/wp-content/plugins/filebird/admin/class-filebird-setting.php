<?php
class FileBird_Setting
{
    private $plugin_name;
    private $version;
    private $option_name;
    private $option_group;
    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
        $this->option_group = 'filebird_setting';
        $this->option_name = 'filebird_setting';
        add_action('admin_init', array($this, 'register_setting'));
    }

    public function create_admin_sub_menu()
    {
        add_submenu_page('options-general.php',
            __('FileBird Setting', NJT_FILEBIRD_TEXT_DOMAIN),
            __('FileBird', NJT_FILEBIRD_TEXT_DOMAIN),
            'manage_options',
            'filebird_form_option',
            array($this, 'form_option')
        );
    }

    public function form_option(){
        $filebird_option = get_option('filebird_setting');
        $unloadFrontend = $filebird_option ? $filebird_option['unload-frontend'] : false;
        ?>
        <h1>FileBird Setting</h1>
        <form name="post" method="post" action="options.php" id="post" autocomplete="off">
            <?php wp_nonce_field($this->option_group . '-options'); ?>
            <style>
                input[type="checkbox"] {
                    display: none;
                }
                input[type="checkbox"] + label {
                    display: inline-block;
                    width: 40px;
                    height: 20px;
                    position: relative;
                    transition: 0.3s;
                    margin: 0px 20px;
                    box-sizing: border-box;
                }
                input[type="checkbox"] + label:after, input[type="checkbox"] + label:before {
                    content: '';
                    display: block;
                    position: absolute;
                    left: 0px;
                    top: 0px;
                    width: 20px;
                    height: 20px;
                    transition: 0.3s;
                    cursor: pointer;
                }
                #inset-3:checked + label.green {
                    background: #AEDCAE;
                }
                #inset-3:checked + label.green:after {
                    background: #5CB85C;
                }
                #inset-3:checked + label:after {
                    left: calc( 100% - 18px );
                }
                #inset-3 + label {
                    background: #ddd;
                    border-radius: 20px;
                }
                #inset-3 + label:after {
                    background: #fff;
                    border-radius: 50%;
                    width: 16px;
                    height: 16px;
                    top: 2px;
                    left: 2px;
                }
            </style>
            <input type="hidden" name="option_page" value="<?php echo esc_attr($this->option_group); ?>">
            <input type="hidden" name="action" value="update">
            <table class="form-table">
                <tbody>
                    <tr>
                        <th style="width: 300px; padding: 20px 10px 10px 0" scope="row"><label for=""><?php echo __('Don\'t want FileBird loading on front end?', NJT_FILEBIRD_TEXT_DOMAIN) ?></label>
                    </th>
                        <td style="padding: 20px 10px 10px 0">
                            <div class="">
                                <input type="checkbox" id="inset-3" name="unload-frontend"
                                    <?php echo ($unloadFrontend ? 'checked' : '') ?>>
                                <label for="inset-3" class="green"></label>
                            </div>
                        </td>
                    </tr>
                </tbody>

            </table>
            <p class="description" style="margin-bottom: 40px"><?php echo __('Notice: If you turn on this option, FileBird will not function on front-end builders such as Divi, WPBakery, Beaver...', NJT_FILEBIRD_TEXT_DOMAIN) ?></p>
            <button class="button button-primary button-large" id="btnSave" type="submit"><?php echo __('Save Setting', NJT_FILEBIRD_TEXT_DOMAIN) ?></button>
        </form>
        <?php
    }

    public function register_setting(){
        register_setting($this->option_group, $this->option_name, array($this, 'save_setting'));
    }

    public function save_setting()
    {
        $new_input = [];
        if (isset($_POST['unload-frontend'])) {
            $new_input['unload-frontend'] = true;
        }else{
            $new_input['unload-frontend'] = false;
        }
        return $new_input;
    }
}
