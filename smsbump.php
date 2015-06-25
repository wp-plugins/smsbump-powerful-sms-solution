<?php
/*
Plugin Name: SMSBump
Plugin URI: https://isenselabs.com/products/view/smsbump-for-wordpress-simple-sms-solution-for-wordpress/
Description: Simple SMS solution for WordPress.
Version: 1.0
Author: iSenseLabs
Author URI: https://isenselabs.com/
*/

defined( 'ABSPATH' ) or die( 'Plugin file cannot be accessed directly.' );

function sms_bump_admin_panel() {
    if (function_exists('add_options_page')) {
        add_menu_page(__('SMSBump', 'smsbump'), __('SMSBump', 'smsbump'), 'manage_options', __FILE__, 'smsbump_setting_page',plugins_url('/view/images/smsbump_icon.png', __FILE__));
    }

    add_action('admin_init', 'register_smsbump_settings');
    add_action('admin_init', 'register_smsbump_woo_settings');
}

function register_smsbump_settings() {
    //register our settings
    register_setting( 'smsbump_settings', 'smsbump_apikey' );
    register_setting( 'smsbump_settings', 'smsbump_enabled' );
    register_setting( 'smsbump_settings', 'smsbump_PhoneNumberPrefix' );
    register_setting( 'smsbump_settings', 'smsbump_NumberPrefix' );
    register_setting( 'smsbump_settings', 'smsbump_PhoneRemoveZeros' );
    register_setting( 'smsbump_settings', 'smsbump_StrictPrefix' );
    register_setting( 'smsbump_settings', 'smsbump_StrictNumberPrefix' );
    register_setting( 'smsbump_settings', 'smsbump_StoreOwnerPhoneNumber' );
    register_setting( 'smsbump_settings', 'smsbump_From' );
    register_setting( 'smsbump_settings', 'smsbump_published_comment' );
    register_setting( 'smsbump_settings', 'smsbump_published_comment_text' );
    register_setting( 'smsbump_settings', 'smsbump_registered_user' );
    register_setting( 'smsbump_settings', 'smsbump_registered_user_text' );
    register_setting( 'smsbump_settings', 'smsbump_success_registration_user' );
    register_setting( 'smsbump_settings', 'smsbump_success_registration_user_text' );
}

function register_smsbump_woo_settings() {
    //register our settings
    register_setting( 'smsbump_woo_settings', 'smsbump_woo_on_checkout' );
    register_setting( 'smsbump_woo_settings', 'smsbump_woo_on_checkout_text' );
    register_setting( 'smsbump_woo_settings', 'smsbump_woo_on_checkout_user' );
    register_setting( 'smsbump_woo_settings', 'smsbump_woo_on_checkout_user_text' );
    register_setting( 'smsbump_woo_settings', 'smsbump_woo_on_order_status' );
    register_setting( 'smsbump_woo_settings', 'smsbump_woo_on_order_status_text' );
}

add_action('admin_menu', 'sms_bump_admin_panel');

function smsbump_setting_page() {
    wp_enqueue_style('bootstrap_modal', plugin_dir_url(__FILE__) . 'view/stylesheet/bootstrap.min.css', false, '1.0');
    wp_enqueue_style('settings', plugin_dir_url(__FILE__) . 'view/stylesheet/settings.css', true);
    wp_enqueue_style( 'thickbox' );
    wp_enqueue_script('char_counter', plugin_dir_url(__FILE__) . 'view/javascript/charactercounter.js', false);
    wp_enqueue_script('bootstrap_modal', plugin_dir_url(__FILE__) . 'view/javascript/bootstrap.min.js', true);
    wp_enqueue_script('settings', plugin_dir_url(__FILE__) . 'view/javascript/smsbump.js', true);
    wp_enqueue_script( 'thickbox' );
    wp_enqueue_script( 'media-upload' ); 

    $smsbump_status = get_option('smsbump_apikey');
    
    if(!empty($smsbump_status)) {
        include_once dirname( __FILE__ ) . "/view/tabs.php";
        if(isset($_GET['tab'])) {
            switch($_GET['tab']) {
                case 'bulk': include_once dirname( __FILE__ ) . "/view/bulk.php"; break;
                case 'settings': include_once dirname( __FILE__ ) . "/view/settings.php"; break;
                case 'woocommerce': include_once dirname( __FILE__ ) . "/view/woocommerce.php"; break;
                case 'help': include_once dirname( __FILE__ ) . "/view/help.php"; break;
                default: include_once dirname( __FILE__ ) . "/view/bulk.php"; break;
            }
        } else {
            include_once dirname( __FILE__ ) . "/view/bulk.php";
        }
    } else {
        include_once dirname( __FILE__ ) . "/view/login.php";
    }

}


/**
 * Add additional custom field
 */

add_action ( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action ( 'edit_user_profile', 'my_show_extra_profile_fields' );

function my_show_extra_profile_fields ( $user )
{
?>
    <h3>Extra profile information</h3>
    <table class="form-table">
        <tr>
            <th><label for="phone">Phone number</label></th>
            <td>
                <input type="text" name="phone" placeholder="+1234567890" id="phone" value="<?php echo esc_attr( get_the_author_meta( 'phone', $user->ID ) ); ?>" class="regular-text" /><br />
                <span class="description">Please enter your phone number.</span>
            </td>
        </tr>
    </table>
<?php
}

add_action ( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action ( 'edit_user_profile_update', 'my_save_extra_profile_fields' );

function my_save_extra_profile_fields( $user_id )
{
    if ( !current_user_can( 'edit_user', $user_id ) )
        return false;
    /* Copy and paste this line for additional fields. Make sure to change 'phone' to the field ID. */
    update_usermeta( $user_id, 'phone', $_POST['phone'] );
}

/**
 * Add cutom field to registration form
 */

add_action('register_form','show_first_name_field');
add_action('register_post','check_fields',10,3);
add_action('user_register', 'register_extra_fields');

function show_first_name_field()
{
?>
    <p>
    <label>Phone number<br/>
    <input id="phone" type="text" placeholder="+1234567890" tabindex="30" size="25" value="<?php echo $_POST['phone']; ?>" name="phone" />
    </label>
    </p>
<?php
}

function check_fields ( $login, $email, $errors )
{
    global $phone;
    if ( $_POST['phone'] == '' )
    {
        $errors->add( 'empty_realname', "<strong>ERROR</strong>: Please Enter your phone number" );
    }
    else
    {
        $phone = $_POST['phone'];
    }
}

function register_extra_fields ( $user_id, $password = "", $meta = array() )
{
    update_user_meta( $user_id, 'phone', $_POST['phone'] );
}

require_once ("search_autocomplete.php");

function search_ac_init() {  
    wp_enqueue_script( 'search_ac', plugin_dir_url(__FILE__) . 'view/javascript/search_ac.js', array('jquery','jquery-ui-autocomplete'),null,true); 
    wp_localize_script( 'search_ac', 'MyAcSearch', array('url' => admin_url( 'admin-ajax.php' )));
} 
add_action( 'init', 'search_ac_init' );

function wp_comment_inserted($comment_id) {
    if(get_option('smsbump_enabled') == 'yes' && get_option('smsbump_published_comment') == 'yes' && !empty($comment_id)) {
        $comment = get_comment($comment_id);        
        $post_title = get_the_title($comment->comment_post_ID);
        $author = $comment->comment_author;

        $message = get_option('smsbump_published_comment_text');
        $message = str_replace('{author}', $author, $message);
        $message = str_replace('{post_title}', $post_title, $message);
        
        if (!class_exists('SmsBump'))
            include dirname( __FILE__ ) . "/vendors/SmsBump.php";

        $sendCheck = sendCheck(get_option('smsbump_StoreOwnerPhoneNumber'));
        if($sendCheck) {
            SmsBump::sendMessage(array(
                'APIKey' => get_option('smsbump_apikey'),
                'to' => array(get_option('smsbump_StoreOwnerPhoneNumber')),
                'from' => get_option('smsbump_From'),
                'message' => $message
            ));
        }
    }
}

add_action('wp_insert_comment','wp_comment_inserted');

function wp_user_registered($user_id) {
    if(get_option('smsbump_enabled') == 'yes') {
        $user = get_user_by( 'id', $user_id );
        $username = $user->user_login;
        
        $message_to_admin = get_option('smsbump_registered_user_text');
        $message_to_admin = str_replace('{user_name}', $username, $message_to_admin);
        $message_to_user = get_option('smsbump_success_registration_user_text');
        $message_to_user = str_replace('{user_name}', $username, $message_to_user);

        if (!class_exists('SmsBump'))
            include dirname( __FILE__ ) . "/vendors/SmsBump.php";
        if(get_option('smsbump_registered_user') == 'yes') {
            $sendCheck = sendCheck(get_option('smsbump_StoreOwnerPhoneNumber'));
            if ($sendCheck) {
                SmsBump::sendMessage(array(
                    'APIKey' => get_option('smsbump_apikey'),
                    'to' => array(get_option('smsbump_StoreOwnerPhoneNumber')),
                    'from' => get_option('smsbump_From'),
                    'message' => $message_to_admin
                ));
            }
        }

        if(get_option('smsbump_success_registration_user') == 'yes') {
            $phone = get_user_meta($user_id, "phone", true);
            $sendCheck = sendCheck($phone);
            if ($sendCheck) {
                SmsBump::sendMessage(array(
                    'APIKey' => get_option('smsbump_apikey'),
                    'to' => array(formatNumber($phone)),
                    'from' => get_option('smsbump_From'),
                    'message' => $message_to_user
                ));
            }
        }

    }
}

add_action('user_register','wp_user_registered');

function formatNumber($number) {
    if((get_option('smsbump_enabled') == 'yes') && get_option('smsbump_NumberPrefix') && get_option('smsbump_NumberPrefix') && get_option('smsbump_PhoneNumberPrefix') =='yes') {
        $numberCheck = ltrim($number, '+');
        $prefixCheck = ltrim(get_option('smsbump_NumberPrefix'), '+');
        $newNumber = '';
        if (get_option('smsbump_PhoneRemoveZeros')=='yes') {
            $numberCheck = ltrim($numberCheck, '0');
        }
        $newNumber = $numberCheck;
        if (strpos($numberCheck, $prefixCheck) !== 0) {
            $newNumber = get_option('smsbump_NumberPrefix').$numberCheck;
        }
        return $newNumber;  
    } else {
        return $number; 
    }
}
    
function sendCheck($phone) {    
    if(get_option('smsbump_StrictPrefix') =='yes') {
        $numberCheck = ltrim($formatNumber($phone), '+');
        $prefixCheck = ltrim(get_option('smsbump_StrictNumberPrefix'), '+');
        
        if (0 === strpos($numberCheck, $prefixCheck)) {
           return true;
        } else {
           return false;
        }
    }
    return true;
}

function wpss_admin_js() {
     $siteurl = get_option('siteurl');
     $url = $siteurl . '/wp-content/plugins/' . basename(dirname(__FILE__)) . '/view/javascript/media_uploader.js';
     echo "<script type='text/javascript' src='$url'></script>"; 
}
add_action('admin_head', 'wpss_admin_js');


/*register_activation_hook(__FILE__, 'my_plugin_activation');
function my_plugin_activation() {
  $notices= get_option('my_plugin_deferred_admin_notices', array());
  $notices[]= "<span style='font-size: 14px;'><a href='admin.php?page=smsbump/smsbump.php&tab=settings' class='button-primary' style='margin-right: 7px;'>Enter API key</a> In order to use the <strong>SMSBump</strong> extension, you have to enter your API key.</span>";
  update_option('my_plugin_deferred_admin_notices', $notices);
}*/

add_action('admin_notices', 'my_plugin_admin_notices');
function my_plugin_admin_notices() {
 
  if ($notices= get_option('my_plugin_deferred_admin_notices')) {
    foreach ($notices as $notice) {
      echo "<div class='updated'><p>$notice</p></div>";
    }
    delete_option('my_plugin_deferred_admin_notices');
  }

  /*if(!$notices && !get_option('smsbump_apikey')) {
         echo "<div class='updated'><p><span style='font-size: 14px;'><a href='admin.php?page=smsbump/smsbump.php&tab=settings' class='button-primary' style='margin-right: 7px;'>Enter API key</a> In order to use the <strong>SMSBump</strong> extension, you have to enter your API key.</span></p></div>";
    }*/
}

add_action('wp_ajax_smsbump_save_api_key', 'saveApiKey');

function saveApiKey() {
    if(!empty($_POST['data'])) {
        update_option('smsbump_apikey', $_POST['data']);
    }
}


// WooCommerce START

add_action( 'woocommerce_thankyou', 'onWooCheckout' );
function onWooCheckout( $order_id ) {
    if(get_option('smsbump_woo_on_checkout') == 'yes') {
        if (!class_exists('SmsBump'))
            include dirname( __FILE__ ) . "/vendors/SmsBump.php";

        $message = get_option('smsbump_woo_on_checkout_text');
        $message = str_replace('{OrderID}', $order_id, $message);

        $phone = get_option('smsbump_StoreOwnerPhoneNumber');
        $sendCheck = sendCheck($phone);
        
        if($sendCheck) {
            SmsBump::sendMessage(array(
                'APIKey' => get_option('smsbump_apikey'),
                'to' => array(formatNumber($phone)),
                'from' => get_option('smsbump_From'),
                'message' => $message
            ));
        }
       
    }

    if(get_option('smsbump_woo_on_checkout_user') == 'yes') {
        if (!class_exists('SmsBump'))
            include dirname( __FILE__ ) . "/vendors/SmsBump.php";
        $order = new WC_Order( $order_id );
        $phone = get_post_meta($order_id, '_billing_phone', true);
        $siteName = get_bloginfo('name');

        $message = get_option('smsbump_woo_on_checkout_user_text');
        $message = str_replace('{OrderID}', $order_id, $message);
        $message = str_replace('{SiteName}', $siteName, $message);

        $sendCheck = sendCheck($phone);
        if($sendCheck) {
            SmsBump::sendMessage(array(
                'APIKey' => get_option('smsbump_apikey'),
                'to' => array(formatNumber($phone)),
                'from' => get_option('smsbump_From'),
                'message' => $message
            ));
        }
    }
}

add_action('woocommerce_order_status_completed', 'onWooStatusChanged');

function onWooStatusChanged($order_id) {

    if(get_option('smsbump_woo_on_order_status') == 'yes') {
        if (!class_exists('SmsBump'))
            include dirname( __FILE__ ) . "/vendors/SmsBump.php";

        $order = new WC_Order( $order_id );
        $phone = get_post_meta($order_id, '_billing_phone', true);
        $siteName = get_bloginfo('name');

        $message = get_option('smsbump_woo_on_order_status_text');
        $message = str_replace('{OrderID}', $order_id, $message);
        $message = str_replace('{SiteName}', $siteName, $message);

        $sendCheck = sendCheck($phone);
        if($sendCheck) {
            SmsBump::sendMessage(array(
                'APIKey' => get_option('smsbump_apikey'),
                'to' => array(formatNumber($phone)),
                'from' => get_option('smsbump_From'),
                'message' => $message
            ));
        }
    }
}

// WooCommerce END