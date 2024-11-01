<?php
/*
Admin menu class for Wordpress
Author : Francesc Fortit Exposito
Author URL: https://wplogincontrol.com
Version: 1.0
*/
if( !defined( 'ABSPATH') ) exit();



class loin_ctrl_menu{

    private $hooks_topage = array();
    private $hooktopage = "";
    private $submenus = array();
    private $current_menu_slug = "";

    private $menu = array( 	'page_title'	=>	'',
                            'menu_title'	=> 	'',
                            'capability'	=> 	'manage_options',
                            'menu_slug'		=>	'',
                            'function'		=>	'',
                            'icon_url'		=>	'dashicons-admin-network',
                            'position'		=>	null
                        );
    private $submenu_template = array( 	'parent_slug'	=>	'',
                                        'page_title'	=>	'',
                                        'menu_title'	=> 	'',
                                        'capability'	=> 	'manage_options',
                                        'menu_slug'		=>	'',
                                        'function'		=>	'',
                                        'metaboxes'     =>  false
                                    );

    private $metaboxes_template = array (	'id' 			=>	'',
                                            'title'			=>	'',	
                                            'callback'		=> 	'',
                                            'screen'		=>	null,
                                            'context'		=>	'advanced',
                                            'priority'		=>	'default',
                                            'callback_args'	=>	null 
                                        );


    function add_menu(){

        add_menu_page( $this->menu['page_title'], $this->menu['menu_title'], $this->menu['capability'], $this->menu['menu_slug'], '' , $this->menu['icon_url'], $this->menu['position'] ); //$this->menu['function']
        

        foreach( $this->submenus as $submenu) {

            $this->current_menu_slug = $submenu['menu_slug'];
            $this->hooks_topage[$submenu['menu_slug']] = $this->hooktopage = add_submenu_page( $submenu['parent_slug'], $submenu['page_title'], $submenu['menu_title'], $submenu['capability'], $submenu['menu_slug'], array( clone $this, 'hook_to_page' ) );
            
            if ( $submenu['metaboxes'] ) {

                add_action('load-'. $this->hooktopage, array( clone $this, 'add_hooks_to_page'));
                add_action('add_meta_boxes_'. $this->hooktopage, array( clone $this, 'add_metaboxes'));
                add_action('admin_footer-'. $this->hooktopage, array(&$this, 'print_script_in_footer'));
                add_action( $submenu['menu_slug'], array(&$this, 'render_metaboxes'));
            }

        }
    }


public function slug_to_hook( $slug ){

$array_hooks = array();

if( is_array( $slug ) ) {
    foreach( $slug as $value)
        $array_hooks[] = $this->hooks_topage[$value];

    return $array_hooks;

} else
    return $this->hooks_topage[$slug];

}


public function render_metaboxes(){
            ?>

        

        <div class="wrap" > 
        
        <h2><?php echo get_admin_page_title(); ?></h2>



        <?php

                /* Used to save closed metaboxes and their order */
                wp_nonce_field( 'meta-box-order', 'meta-box-order-nonce', false );
                wp_nonce_field( 'closedpostboxes', 'closedpostboxesnonce', false ); ?>

        
    
            <div id="poststuff">  
            
                <div id="post-body" class="metabox-holder columns-<?php echo 1 == get_current_screen()->get_columns() ? '1' : '2'; ?>">    <!--     // create colums  -->

    <!--            <div id="post-body-content">
                        #post-body-content -->
    <!--            </div>-->
                
                
                    <div id="postbox-container-1" class="postbox-container">

                        <?php  do_meta_boxes('','side',null); ?>
                    </div><!-- #postbox-container-1 -->

                    <div id="postbox-container-2" class="postbox-container">

                        <?php do_meta_boxes('','normal',null); ?>
                        <?php do_meta_boxes('','advanced',null); ?>

                    </div><!-- #postbox-container-2 -->
<?php //do_action('loin_ctrl_Page1'); ?>	

                </div> <!-- #post-body -->

            </div> <!-- #poststuff -->



        </div><!-- #wrap -->

        <?php
}


    public function hook_to_page(){
        do_action( $this->current_menu_slug ); 
    }

    public function __construct( $menu, $submenus = "" ) {

        $this->menu = array_merge( $this->menu, $menu );
        $this->submenu_template['parent_slug'] = $this->menu['menu_slug'];

        if( !empty($submenus)) {
            foreach( $submenus as $submenu) {
                $this->submenus[] = array_merge( $this->submenu_template, $submenu );
            }
        }

        add_action('admin_menu', array(&$this, 'add_menu') ); // para pasar el nombre de clase
        add_action('network_admin_menu', array(&$this, 'add_menu') ); // add option for network


        } //__construct

    function add_metaboxes(){  

        foreach( $this->submenus as $submenu) {

            if ( $submenu['menu_slug'] == $this -> current_menu_slug )
                foreach( $submenu['metaboxes'] as $metabox ) {
                    $metabox = array_merge( $this->metaboxes_template, $metabox );
                    add_meta_box( $metabox['id'], $metabox['title'], $metabox['callback'],$metabox['screen'],$metabox['context'],$metabox['priority'],$metabox['callback_args']);
                }
        }

    }

    function add_hooks_to_page() {

        /* Trigger the add_meta_boxes hooks to allow meta boxes to be added to our page  */

        do_action('add_meta_boxes_'. $this->hooktopage, null);
        //do_action('add_meta_boxes', $hooktopage, null); // if we activate this option other meta_boxes can hook
    
        /* Enqueue WordPress' script for handling the meta boxes */
        wp_enqueue_script('postbox');
    
        /* Add screen option: user can choose between 1 or 2 columns (default 2) */
        add_screen_option('layout_columns', array('max' => 2, 'default' => 1) );
    
    
    }
    
    /* Prints script in footer. This 'initialises' the meta boxes */
    function print_script_in_footer() {
        ?>
    
        <script>
            //jQuery(document).ready(function(){ 
            // close postboxes that should be closed
            //  $('.if-js-closed').removeClass('if-js-closed').addClass('closed');
            postboxes.add_postbox_toggles(pagenow); // });
        </script>
        <?php  

    }

} // class loin_ctrl_menu

?>