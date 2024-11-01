<?php
/*
SQL constructor class for Wordpress ( Multisite )
Author : Francesc Fortit Exposito
Author URL: https://wplogincontrol.com
Version: 1.0
*/

if( !defined( 'ABSPATH') ) exit();

class loin_ctrl_MySql {

    private $min_version_required;
    private $sql_tables;// = array();
    
    
    public function __construct( $file_name, $tables, $minversion = '4.0.0' ) {


        $this -> sql_tables = $tables; // pointer
        $this -> min_version_required = $minversion;

        register_activation_hook( realpath(__DIR__ . '/..' . '/' . basename( $file_name )), array( &$this, 'install' ));

        add_action('admin_notices', array( &$this, 'database_admin_notice')); //network_admin_notices
        
    }    


    public function database_admin_notice(){

    //notice-success  
    //__('This Database version is iqual or higher.',LOIN_CTRL_PLUGIN_DOMAIN)
    if ( empty( get_option("loin_ctrl_error_notification") ) ) return;

    ?>    
    <div class="notice error is-dismissible"> 
    <p><?php echo get_option("loin_ctrl_error_notification") ; ?> </p>    
    </div>
        
    <?php
        update_option("loin_ctrl_error_notification","");
    }

    
    public function install( $networkwide ) {

        global $wpdb;
        global $wp_version;
        
        if( version_compare( $wp_version, $this->min_version_required, '<')) {

                update_option("loin_ctrl_error_notification","This plugin requires WordPress version {$this->min_version_required} or higher.");
                
                return;

            }

            if (function_exists( 'is_multisite' ) && is_multisite() ) {
                //check if it is network activation if so run the activation function for each id
                if( $networkwide ) {
                    $old_blog =  $wpdb->blogid;
                    //Get all blog ids
                    $blogids =  $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );

                    foreach ( $blogids as $blog_id ) {
                    switch_to_blog($blog_id);
                    //Create database table if not exists
                    
                    $this->create_tables();
                    }
                    
                    switch_to_blog( $old_blog );
                    return;
                }
            }
            //Create database table if not exists
            
            $this->create_tables();

            
            
    } // function install


    public function create_tables() {
        
        global $wpdb;

        $db_version = '0.41';

        $installed_ver = get_option( "loin_ctrl_LC_db_version" );


        if( $installed_ver < $db_version || $installed_ver == null ) { // $installed_ver < $db_version ||     //1 == 1 


            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

                foreach ( $this->sql_tables as $table ) {

                    dbDelta( "CREATE TABLE {$wpdb->prefix}" . $table );

                }

            update_option( 'loin_ctrl_LC_db_version', $db_version );

        }


    } // end function

} // Class loin_ctrl_MySql


?>