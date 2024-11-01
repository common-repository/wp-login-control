<?php

// Prevent direct file access
	if( ! defined( 'ABSPATH' ) ) die();


    $shortcode_repeat = new stdClass;

    //Shortcodes en widgets de texto
    add_filter('widget_text', 'do_shortcode');

    add_action( 'wp_enqueue_scripts', 'loin_ctrl_shortcode_scripts'); //wp_enqueue_scripts

    function loin_ctrl_shortcode_scripts() {

        global $wpdb;
                
        $array_IDs = $wpdb->get_results( " SELECT Id_Form FROM {$wpdb->prefix}fs_forms WHERE Type = 'ObjectBlank' "); //get_results
    
        foreach ( $array_IDs as $key => $row){
            wp_register_style( 'loin_ctrl_' . preg_replace('/\s/','_',$row->Id_Form) .'-style', LOIN_CTRL_PLUGIN_URL . 'css/' . preg_replace('/\s/','_',$row->Id_Form) . '.css' );
            wp_register_script( 'loin_ctrl_' . $row->Id_Form .'_load_google_fonts_enqueue_shortcode', LOIN_CTRL_PLUGIN_URL . 'admin/js/load_google_fonts.js', array('jquery'));
        }

        wp_register_script( 'loin_ctrl_load_google_fonts_enqueue_shortcode_script', LOIN_CTRL_PLUGIN_URL . 'admin/js/load_google_font_script.js', array('jquery')); // , array('jquery'),'1.0.0',true
        
        wp_register_style('loin_ctrl_font-awesome',  LOIN_CTRL_PLUGIN_URL . 'admin/css/font-awesome/css/font-awesome.min.css', false, null); // local

        wp_register_style('loin_ctrl_reset',  LOIN_CTRL_PLUGIN_URL . 'public/css/reset.css', false, null);

    
    }


    function loin_ctrl_shortcode_forms( $atts, $content = null ) {

        $bd_array = array('id' => null);

        /*   $a = shortcode_atts( array(
                'id' => null//,
            
            ), $atts );
        */
        $a = shortcode_atts( $bd_array, $atts );

        global $shortcode_repeat;
        if ( $a['id'] === null ) return;
        if ( ! property_exists( $shortcode_repeat, $a['id']) )
            $shortcode_repeat->{$a['id']} = 1; // error conversion
        else
            $shortcode_repeat->{$a['id']}++;

        $obj_sufix = "";
        if ( $shortcode_repeat->{$a['id']} > 1 ) $obj_sufix = "_" . $shortcode_repeat->{$a['id']}; //error conversion

        global $post;
        $post_slug=$post->post_name;

        global $wpdb;
        
        $Data_Objects = $wpdb->get_row( " SELECT Options, New, Custom, State FROM {$wpdb->prefix}fs_forms WHERE Id_Form = '" . $a['id'] . "' AND Type = 'ObjectBlank'" ); //get_results

        if ( count($Data_Objects) == 0 || $Data_Objects->State == "Disabled" ) return;

        if ( $Data_Objects->State == "Cron" ) {

            $wpdb->fs_cron = "{$wpdb->prefix}fs_cron";

            //First select cron forms

            $Cron_Object = $wpdb->get_results( " SELECT 1 FROM $wpdb->fs_cron WHERE Id_Form = '" . $a['id'] . "' AND Enabled = 1 AND  UNIX_TIMESTAMP(STR_TO_DATE(DateTimeFrom, '%Y-%m-%d %H:%i:%s')) <= UNIX_TIMESTAMP() AND UNIX_TIMESTAMP(STR_TO_DATE(DateTimeTo, '%Y-%m-%d %H:%i:%s')) >= UNIX_TIMESTAMP() "); //, ARRAY_A

            if ( count($Cron_Object) == 0 ){
                return;
            }           
        }
        //comprobar que $Data_Objects no sea null, id erroneo  y que tengamos google fonts antes de carregar scripts de google fonts

        wp_enqueue_script( 'loin_ctrl_load_google_fonts_enqueue_shortcode_script' );
        wp_enqueue_style( 'loin_ctrl_font-awesome' );
        wp_enqueue_style( 'loin_ctrl_reset' );
        
        //wp_enqueue_style('font-awesome-2',  LOIN_CTRL_PLUGIN_URL . 'admin/css/font-awesome/css/font-awesome.min.css', array(), '4.7.0', 'all'); // local

        $json_Array = unserialize($Data_Objects->New); //
        if ( count($json_Array) == 0) return; // no elements to show exit
        $json_Array_custom = unserialize($Data_Objects->Custom);       

        $GogleFonts_Options = unserialize($Data_Objects->Options);

        $json_Font_Array = stripslashes($GogleFonts_Options[2]);
        wp_localize_script( 'loin_ctrl_' . $a['id'] .'_load_google_fonts_enqueue_shortcode', 'familiesArray', $json_Font_Array );
        wp_enqueue_script( 'loin_ctrl_' . $a['id'] .'_load_google_fonts_enqueue_shortcode');  

        wp_enqueue_style( 'loin_ctrl_' . preg_replace('/\s/','_',$a['id']) . '-style' );

        //id ya no se utilizara, lo perdemos

        $user_variables_Options = unserialize($Data_Objects->Options);

        $user_variables_Array = json_decode(stripslashes($user_variables_Options[4]));


    //montar estructura { parametre => default }
    $var_shortcode_atts = [];

    foreach ( $user_variables_Array as $obj) {
        $var_shortcode_atts[$obj->name] = $obj->default;
        }

            $a = shortcode_atts( $var_shortcode_atts, $atts );


        $Shortcode_return_string = "";

        foreach ( $json_Array as $index=>$value) {  // no es un array es un objeto !!!
            $temp_obj = json_decode(stripslashes($value));
            //$Shortcode_return_string .= $temp_obj->type;

        $temp_custom_obj = json_decode(stripslashes($json_Array_custom[$index])); // index es el objeto actual en el bucle
        $attr_string = "";
        $class_added = false;

        if( property_exists( $temp_custom_obj, 'Shortcode_variable_name') ) {
            foreach ( $temp_custom_obj->Shortcode_variable_name as $obj_name){ // only contains name
                foreach ( $user_variables_Array as $obj) {
                    if($obj->name == $obj_name->name) { // content == undefined
                        switch ($obj->attr_type) {

                            case "src": if( $temp_obj->type == "img"){
                                            $temp_obj->src = $a[$obj->name];
                                        } 
                            
                                        break;
                            case "href": 
                                        if( $temp_obj->type == "a"){
                                            $temp_custom_obj->linkpath = $a[$obj->name];
                                        } 
                                        
                                        break;
                            case "class":
                                        $class_added = true;
                                        if( $temp_obj->type == "i"){
                                            $fontAwesome_name = "";
                                            if( strpos($a[$obj->name], "fa-") === false) { 
                                                $fontAwesome_name = $temp_custom_obj->font_awesome_fa_name;
                                            }
                                            $attr_string .= $obj->attr_type . '="fa ' . $fontAwesome_name . " " . $a[$obj->name] . '" aria-hidden="true"';
                                            break;
                                        }
        
                                        //break;
                            default:
                                        //if( $temp_obj->type != "i"){ //all cases except <i>
                                            $attr_string .= $obj->attr_type . '="' . $a[$obj->name] . '" ';
                                        //}

                        }
                        
                    }    
                }
            }
        }

        switch($temp_obj->type) {

            case "img":

                if ( strpos( $Shortcode_return_string, "#" . $temp_obj->id) !== false) { //encontrado #id para substitución solo puede ser hijo
                    $Shortcode_return_string = str_replace ( '#' . $temp_obj->id, '<img id="' . $temp_obj->id . $obj_sufix . '" src="' . $temp_obj->src . '" '. $attr_string .'>' , $Shortcode_return_string);
                }
                else{

                        if( $temp_obj->parent == "designArea") {
                            if ( $class_added ){
                                $attr_string = str_replace('class="','class="loin-ctrl ',$attr_string);
                            }
                            else{
                                $attr_string .= 'class="loin-ctrl"';
                            } 

                            $Shortcode_return_string .= '<img id="' . $temp_obj->id . $obj_sufix . '" src="' . $temp_obj->src . '" '. $attr_string .'>';
                            
                         }
                        else{
                            $IdPos = strpos($Shortcode_return_string, $temp_obj->parent);

                            $count = 1;
                            $position = 0;

                            while ( $count != 0) {
                                if ( $Shortcode_return_string[$IdPos + $position] == "<" ) {     // entra en bucle infinito cuidado
                                    if( $Shortcode_return_string[$IdPos + $position + 1] == "/" ) {
                                        $count--;
                                    }
                                    else if( substr($Shortcode_return_string, $IdPos + $position + 1, 3) == "img" || substr($Shortcode_return_string, $IdPos + $position + 1, 2) == "br" ) {
                                       // nothing, next step
                                    }
                                    else{
                                        $count++;
                                    }
                                }
                                $position++;
                            }

                            $endTagPos = $IdPos + $position - 1;
                            $Shortcode_return_string = substr($Shortcode_return_string,0,$endTagPos) . '<img id="' . $temp_obj->id . $obj_sufix . '" src="' . $temp_obj->src . '" '. $attr_string .'>' . substr($Shortcode_return_string,$endTagPos);
                            
                        }
                    }

                    break;
            
            case "i":

                    if ( !$class_added ){
                        $attr_string .= 'class="loin-ctrl fa ' . $temp_custom_obj->font_awesome_fa_name . '" aria-hidden="true"';
                    } 

                    if ( strpos( $Shortcode_return_string, "#" . $temp_obj->id) !== false) { //encontrado #id para substitución solo puede ser hijo
                        $Shortcode_return_string = str_replace ( '#' . $temp_obj->id, '<' . $temp_obj->type . ' id="' . $temp_obj->id . $obj_sufix . '" object="' . $temp_obj->type . '" '. $attr_string .'></'. $temp_obj->type .'>' , $Shortcode_return_string);
                    }
                    else{
                        if( $temp_obj->parent == "designArea") {
                            if ( $class_added ){
                                $attr_string = str_replace('class="','class="loin-ctrl ',$attr_string);
                            }

                            $Shortcode_return_string .= '<' . $temp_obj->type . ' id="' . $temp_obj->id . $obj_sufix . '" object="' . $temp_obj->type . '" '. $attr_string .'></'. $temp_obj->type .'>';
                        }
                        else{
                            $IdPos = strpos($Shortcode_return_string, $temp_obj->parent);
                            $count = 1;
                            $position = 0;

                            while ( $count != 0) {
                                if ( $Shortcode_return_string[$IdPos + $position] == "<" ) {     // entra en bucle infinito cuidado
                                    if( $Shortcode_return_string[$IdPos + $position + 1] == "/" ) {
                                        $count--;
                                    }
                                    else if( substr($Shortcode_return_string, $IdPos + $position + 1, 3) == "img" || substr($Shortcode_return_string, $IdPos + $position + 1, 2) == "br" ) {
                                        // nothing, next step
                                    }
                                    else{
                                        $count++;
                                    }
                                }
                                $position++;
                            }
    
                            $endTagPos = $IdPos + $position - 1;//strpos($Shortcode_return_string, "</", $IdPos);
                            $Shortcode_return_string = substr($Shortcode_return_string,0,$endTagPos) . '<' . $temp_obj->type . ' id="' . $temp_obj->id . $obj_sufix . '" object="' . $temp_obj->type . '" '. $attr_string .'></'. $temp_obj->type .'>' . substr($Shortcode_return_string,$endTagPos);

                        }
                    }

                    break;

            case "a":

                    if ( strpos( $Shortcode_return_string, "#" . $temp_obj->id) !== false) { //encontrado #id para substitución solo puede ser hijo
                        $Shortcode_return_string = str_replace ( '#' . $temp_obj->id, '<' . $temp_obj->type . ' href="'. $temp_custom_obj->linkpath .'" ' . ' id="' . $temp_obj->id . $obj_sufix . '" '. $attr_string .'></'. $temp_obj->type .'>' , $Shortcode_return_string);
                    }
                    else{
                        if( $temp_obj->parent == "designArea") {
                            if ( $class_added ){
                                $attr_string = str_replace('class="','class="loin-ctrl ',$attr_string);
                            }
                            else{
                                $attr_string .= 'class="loin-ctrl"';
                            } 

                            $Shortcode_return_string .= '<' . $temp_obj->type . ' href="'. $temp_custom_obj->linkpath .'" ' . ' id="' . $temp_obj->id . $obj_sufix . '" '. $attr_string .'></'. $temp_obj->type .'>';

                        }
                        else{

                            $IdPos = strpos($Shortcode_return_string, $temp_obj->parent);
                            $count = 1;
                            $position = 0;

                            while ( $count != 0) {
                                if ( $Shortcode_return_string[$IdPos + $position] == "<" ) {
                                    if( $Shortcode_return_string[$IdPos + $position + 1] == "/" ) {
                                        $count--;
                                    }
                                    else if( substr($Shortcode_return_string, $IdPos + $position + 1, 3) == "img" || substr($Shortcode_return_string, $IdPos + $position + 1, 2) == "br" ) {
                                        // nothing, next step
                                    }
                                    else{
                                        $count++;
                                    }
                                }
                                $position++;
                            }

                            $endTagPos = $IdPos + $position - 1;
                            $Shortcode_return_string = substr($Shortcode_return_string,0,$endTagPos) . '<' . $temp_obj->type . ' href="'. $temp_custom_obj->linkpath .'" ' . ' id="' . $temp_obj->id . $obj_sufix . '" '. $attr_string .'></'. $temp_obj->type .'>' . substr($Shortcode_return_string,$endTagPos);

                        }
                    }
                    //add content
                    if ( isset($temp_obj->content) ) {
                        $IdPos = strpos($Shortcode_return_string, $temp_obj->id);
                        $endTagPos = strpos($Shortcode_return_string, "</", $IdPos);
                        //$content_replaced = str_replace( "{content}", $content, str_replace( "@br@", "<br>", $temp_obj->content ) );
                        $content_replaced = "";
                        foreach($temp_obj->content as $obj){
                            switch ( $obj->type){
                                case "text":
                                            $content_replaced .=  $obj->content;
                                            break;
                                case "br":
                                            $content_replaced .= "<br>";
                                            break;
                                case "id":
                                            $content_replaced .= "#" . $obj->content;
                                            break;
                            }
                            
                        }
        
        
                        $content_replaced = str_replace( "{content}", $content, $content_replaced );

                        foreach ( $user_variables_Array as $obj) {
                            if($obj->type == "text" || $obj->name == "content" ) {
                                $content_replaced = str_replace( "{". $obj->name ."}", $a[$obj->name], $content_replaced );
                            }
                        }

                        $Shortcode_return_string = substr($Shortcode_return_string,0,$endTagPos) . $content_replaced . substr($Shortcode_return_string,$endTagPos); //$temp_obj->content
                    }
                    break;
                    

            default:

                    if ( strpos( $Shortcode_return_string, "#" . $temp_obj->id) !== false) { //encontrado #id para substitución solo puede ser hijo
                        $Shortcode_return_string = str_replace ( '#' . $temp_obj->id, '<' . $temp_obj->type . ' id="' . $temp_obj->id . $obj_sufix . '" '. $attr_string .'></'. $temp_obj->type .'>' , $Shortcode_return_string);
                    }
                    else{
                        if( $temp_obj->parent == "designArea") {
                            if ( $class_added ){
                                // subtituir class=" per class="loin-ctrl <<<<<<
                                $attr_string = str_replace('class="','class="loin-ctrl ',$attr_string);
                            }
                            else{
                                $attr_string .= 'class="loin-ctrl"';
                            } 
                            
                            $Shortcode_return_string .= '<' . $temp_obj->type . ' id="' . $temp_obj->id . $obj_sufix . '" '. $attr_string .'></'. $temp_obj->type .'>';
                        }
                        else{

                            $IdPos = strpos($Shortcode_return_string, $temp_obj->parent);
                            //$endTagPos = strpos($Shortcode_return_string, "</", $IdPos);
                            $count = 1;
                            $position = 0;
    
                            while ( $count != 0) {
                                if ( $Shortcode_return_string[$IdPos + $position] == "<" ) {
                                    if( $Shortcode_return_string[$IdPos + $position + 1] == "/" ) {
                                        $count--;
                                    }
                                    else if( substr($Shortcode_return_string, $IdPos + $position + 1, 3) == "img" || substr($Shortcode_return_string, $IdPos + $position + 1, 2) == "br" ) {
                                        // nothing, next step
                                    }
                                    else{
                                        $count++;
                                    }
                                }
                                $position++;
                            }
      
                            $endTagPos = $IdPos + $position - 1;
                            $Shortcode_return_string = substr($Shortcode_return_string,0,$endTagPos) . '<' . $temp_obj->type . ' id="' . $temp_obj->id . $obj_sufix . '" '. $attr_string .'></'. $temp_obj->type .'>' . substr($Shortcode_return_string,$endTagPos);
                            
                        }
                    }
                        //add content
                        if ( isset($temp_obj->content) ) {
                            $IdPos = strpos($Shortcode_return_string, $temp_obj->id);
                            $endTagPos = strpos($Shortcode_return_string, "</", $IdPos);
                            //$content_replaced = str_replace( "{content}", $content, str_replace( "@br@", "<br>", $temp_obj->content ) );
                            //$array_objects[] = json_decode(stripslashes( $temp_obj->content ) );
                            //print_r ($temp_obj->content);
                            //echo "<br><br>";

                $content_replaced = "";
                foreach($temp_obj->content as $obj){
                    switch ( $obj->type){
                        case "text":
                                    $content_replaced .=  $obj->content;
                                    break;
                        case "br":
                                    $content_replaced .= "<br>";
                                    break;
                        case "id":
                                    $content_replaced .= "#" . $obj->content;
                                    break;
                    }
                    
                }


                            $content_replaced = str_replace( "{content}", $content, $content_replaced );

                            foreach ( $user_variables_Array as $obj) {
                                if($obj->type == "text" || $obj->name == "content") {
                                    $content_replaced = str_replace( "{". $obj->name ."}", $a[$obj->name], $content_replaced );
                                }
                            }

                            $Shortcode_return_string = substr($Shortcode_return_string,0,$endTagPos) . $content_replaced . substr($Shortcode_return_string,$endTagPos);

                        }
        }



    }
    
    
    return $Shortcode_return_string; //join("|", $json_Array);
    
    }
    
    add_shortcode('Loin_ctrl_Forms', 'loin_ctrl_shortcode_forms');


    function loin_ctrl_login_css_js (){
         

        if ( is_user_logged_in() && get_option ( 'loin_ctrl_DesignMode' )[1] && get_option ( 'loin_ctrl_DesignMode' )[0] == wp_get_current_user()->user_login ) {
            //nothing
        } else {

            global $wpdb;

            //aqui seleccionamos los forms que se muestran
            $wpdb->fs_cron = "{$wpdb->prefix}fs_cron";
            $wpdb->fs_forms = "{$wpdb->prefix}fs_forms";
            //First select cron forms

            $Data_Objects = $wpdb->get_results( " SELECT f.Id_Form FROM $wpdb->fs_forms as f, $wpdb->fs_cron as c WHERE State = 'Cron' AND type = 'LoginDefault' AND Enabled = 1 AND c.Id_Form = f.Id_Form AND  UNIX_TIMESTAMP(STR_TO_DATE(DateTimeFrom, '%Y-%m-%d %H:%i:%s')) <= UNIX_TIMESTAMP() AND UNIX_TIMESTAMP(STR_TO_DATE(DateTimeTo, '%Y-%m-%d %H:%i:%s')) >= UNIX_TIMESTAMP() ", ARRAY_A);

            if ( count($Data_Objects) == 0 )
                $Data_Objects = $wpdb->get_results( " SELECT Id_Form FROM $wpdb->fs_forms WHERE State = 'Enabled' AND type = 'LoginDefault'", ARRAY_A);


            if ( count($Data_Objects) > 0 ) {

                $FormShownID = $Data_Objects[rand(0, count($Data_Objects) -1 )]['Id_Form'];
                $FormShown = str_replace(" ", "_", $FormShownID);

		
                $Data_Options = $wpdb->get_row( " SELECT Options FROM {$wpdb->prefix}fs_forms WHERE Id_Form = '" . $FormShownID . "'" );
                $FormShown_Options = unserialize($Data_Options->Options);
                $FormShown_Options = json_decode(stripslashes($FormShown_Options[0]), true); // true = to array, if not = object 

                $GogleFonts_Options = unserialize($Data_Options->Options);
                $GogleFonts_Options = json_decode(stripslashes($GogleFonts_Options[2]), true);

                function loin_ctrl_remove_wp_shake() {
                remove_action('login_head', 'wp_shake_js', 12);
                }
                if ( array_key_exists('toggle_removeShake', $FormShown_Options) ) add_action('login_head', 'loin_ctrl_remove_wp_shake');

                function loin_ctrl_rememberme_checked() {
                echo "<script>document.getElementById('rememberme').checked = true;</script>";
                }
                if ( array_key_exists('toggle_rememberMe', $FormShown_Options) ) add_action( 'login_footer', 'loin_ctrl_rememberme_checked' );

                if ( array_key_exists('toggle_hideError', $FormShown_Options) ) add_filter('login_errors',create_function('$a', "return null;"));

                function loin_ctrl_effects() {
                    wp_enqueue_script( 'loin_ctrl_efects_enqueue', LOIN_CTRL_PLUGIN_URL . 'admin/js/effects.js', array('jquery','jquery-effects-core','jquery-ui-core'));

                }
                //add_action( 'login_footer', 'loin_ctrl_effects' );
                //**********************************************

                //test google fonts
                //function loin_ctrl_google_fonts() use ($GogleFonts_Options){

                //    wp_enqueue_style( 'loin_ctrl_google_fonts_enqueue', 'https://fonts.googleapis.com/css?family=Sofia', false);

                //}
                //add_action( 'login_footer', 'loin_ctrl_google_fonts' );



                add_action( 'login_footer', function() use ($GogleFonts_Options) { 

                        wp_enqueue_style( 'loin_ctrl_google_fonts_enqueue', 'https://fonts.googleapis.com/css?family=' . join('|', $GogleFonts_Options), false);

                });


                if ( array_key_exists('logoLink', $FormShown_Options) ) 
                    add_filter( 'login_headerurl', function() use ($FormShown_Options){
                        return $FormShown_Options["logoLink"];
                    });

                if ( array_key_exists('titleLogo', $FormShown_Options) ) 
                    add_filter( 'login_headertitle', function() use ($FormShown_Options) {
                        return $FormShown_Options["titleLogo"];
                    });
                // FontAwesome is always loaded, in the next revisions will be loaded only if necessary
                wp_enqueue_style('loin_ctrl_font-awesome',  LOIN_CTRL_PLUGIN_URL . 'admin/css/font-awesome/css/font-awesome.min.css', array(), '4.7.0', 'all');
                wp_enqueue_style('loin_ctrl_login_css',  LOIN_CTRL_PLUGIN_URL . "css/" .  $FormShown . ".css", false, null);
                
                
                //Hack to login_footer
                add_action('login_footer',function() use ($FormShownID) {

                    global $wpdb;
                            
                    $Data_Objects = $wpdb->get_row( " SELECT New, Custom FROM {$wpdb->prefix}fs_forms WHERE Id_Form = '" . $FormShownID . "'" ); //get_results
                            
                    $json_Array = unserialize($Data_Objects->New);
                    $json_Array_custom = unserialize($Data_Objects->Custom);


                wp_register_script( 'loin_ctrl_new_objects_enqueue', LOIN_CTRL_PLUGIN_URL . 'admin/js/load_new.js', array('jquery'));  /// treure ojo
                wp_localize_script( 'loin_ctrl_new_objects_enqueue', 'obj_new', $json_Array );
                wp_localize_script( 'loin_ctrl_new_objects_enqueue', 'obj_custom', $json_Array_custom );
                wp_enqueue_script( 'loin_ctrl_new_objects_enqueue' );  

                });
            }
	
        }
    }
    
    add_action("login_enqueue_scripts", "loin_ctrl_login_css_js");

?>