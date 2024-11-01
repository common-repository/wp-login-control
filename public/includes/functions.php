<?php

// Prevent direct file access
	if( ! defined( 'ABSPATH' ) ) die();

// public functions for admin user


	add_action( 'loin_ctrl_custom_login_form_head', 'loin_ctrl_render_designer_tools');  //login_header

	function loin_ctrl_render_designer_tools() {

		if ( is_user_logged_in() )
			if ( get_option ( 'loin_ctrl_DesignMode' )[1] && get_option ( 'loin_ctrl_DesignMode' )[0] == wp_get_current_user()->user_login ) {

				require_once dirname(__FILE__)."/vod/toolbar.php" ; 

				loin_ctrl_make_icons_menu();
				loin_ctrl_make_contextual_menu();
				loin_ctrl_make_toolbar();
				loin_ctrl_img_icons_box();
				loin_ctrl_tags_box();
				loin_ctrl_replaceCode_box();


				add_action( 'loin_ctrl_custom_login_form_footer', 'loin_ctrl_click_save'); //login_footer

			}

	}

	//	add_action( 'login_footer', 'loin_ctrl_click_save');

		function loin_ctrl_click_save() {

			$ajax_nonce = wp_create_nonce( 'loin_ctrl_login_render_nonce' );
			?>

				<script type="text/javascript" >
		
				jQuery(document).ready(function($) {
					// runs once page is loaded
					// delete page Login Render FS
					
					if ( formType == "ObjectBlank") {
						$("#img_toggle").remove();
						$("#designArea").css("background-image", "url(" + PathToAdminImages + "transparent.png)"  );
					} 
					else {
						$("#img_marker, .patternButton_part, #icons_menu_container i.fa-compress").remove();
						$("#designArea").addClass("selected");
    					$("#designArea").trigger("selected");
					}
							
					var familiesArray = [];
						$.each( lorem_ipsum.items, function(index, val){ //load google fonts asynchronously 
							familiesArray.push(val.family);
							//if (index < 300) familiesArray.push(val.family);
							if ( navigator.userAgent.indexOf('Edge') >= 0 && index > 320) return false; //familiesArray.push(val.family);
							//if (index > 300) return false;
						});
						
	/*						lorem_ipsum.items.forEach(function(val, index){
							familiesArray.push(val.family);
						});
*/
	/*					for ( var i = 0, len = lorem_ipsum.items.length; i < len; i++){
							familiesArray.push(lorem_ipsum.items[i].family);
						}
*/



					WebFontConfig = {
						//typekit: { id: 'xxxxxx' }
						google: {
							families: familiesArray//[ 'Roboto+Condensed', 'Source+Sans+Pro','Eater' ]
							//text: 'Lorem Ipsum'  // Failed to decode download font !!!
						},
						//timeout: 5000
					};


					(function(d) {
						var wf = d.createElement('script'), s = d.scripts[0];
						wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
						wf.type = 'text/javascript';
						wf.async = true;
						s.parentNode.insertBefore(wf, s);
					})(document);





					

					/*					
					if (familiesArray.length > 0) 
					var apiUrl = [];
									var url = "";

									$.each( lorem_ipsum.items, function(index, val){ //load google fonts Lorem Ipsum
										//$.each( val, function(index, val){

										apiUrl = [];
										apiUrl.push('https://fonts.googleapis.com/css?family=');
										apiUrl.push(val.family.replace(/ /g, '+'));
										apiUrl.push('&text=Lorem+Ipsum');
										url = apiUrl.join('');
										$('head').append( $('<link rel="stylesheet" class="google-fonts-design lorem-ipsum">').attr("data-font", val.family).attr("href", url));

									}); 			
					*/				
					var data = {
						action: 'loin_ctrl_save_obj_properties',
						security: '<?php echo $ajax_nonce; ?>',
						action_to_do: 'delete_page'
					};		

					var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";

					$("#icons_menu_container").after('<div class="ajax_box_waitting not_selectable"><i class="fa fa-spinner fa-pulse fa-fw lc_centered"></i><span class="lc_centered">Environment...</span></div>');
					
					$.post(ajaxurl, data, function(response) { 
						//alert('Got this from the server: ' + response);
						$(".ajax_box_waitting").remove();
					});	


					$('#img_save').click( function(){

						let allObjNew = [];
						let allObjWithoutCss = [];
						let allObjCss = [];
						let allObjHover = [];
						let allDomPath = [];
						let allOptions = []; // Now only toggle_changes [0] , custom CSS [1], google Fonts [3], later effects, redirectons, etc.
						let allCustom = []; // for other especific data

						$('.selected').data('selected','true');
						$('.selected').removeClass('selected');

						$('#designArea, #designArea *').filter(function() {
								return $(this).data('css') !== undefined || $(this).data('hover') !== undefined; 
						}).filter(function() {
								return Object.keys($(this).data('css')).length > 0 ||Object.keys($(this).data('hover')).length > 0; 
						}).not('.not_selectable').each(function(){

						let CurrentObj = this;
						let domPath = [];
						let ObjectPosition = "";

						while ( ! $(CurrentObj).hasClass('login')){

							if ($(CurrentObj).prop('id') != null  && $(CurrentObj).prop('id') != "")
								domPath.unshift( $(CurrentObj).prop('tagName') + "#" + $(CurrentObj).prop('id'));
							else {
								ObjectPosition = "";
								if ( $(CurrentObj).siblings($(CurrentObj).prop('tagName')).not(".not_selectable").length > 0 )
									ObjectPosition =  ":nth-child(" + ( Number($(CurrentObj).prevAll().not(".not_selectable").length) + Number(1) ) + ")"; //$(CurrentObj).prop('tagName')

								if ($(CurrentObj).prop('className') != null && $(CurrentObj).prop('className') != "" )
									if ( $(CurrentObj).siblings($(CurrentObj).prop('tagName')).not(".not_selectable").hasClass($(CurrentObj).prop('className')) ) 
										domPath.unshift( $(CurrentObj).prop('tagName') + "." + $(CurrentObj).prop('className').replace(/\s/g,".") + ObjectPosition); // pendiente optimizar y afinar 
									else
										domPath.unshift( $(CurrentObj).prop('tagName') + "." + $(CurrentObj).prop('className').replace(/\s/g,"."));
								else
									domPath.unshift( $(CurrentObj).prop('tagName') + ObjectPosition);    

							}

								CurrentObj = $(CurrentObj).parent();
						}


						if ( this.id == "designArea") domPath.unshift("body");

						allDomPath.push( domPath.join(" ") );

						if ( $(this).data("new") != null ) {
							allObjNew.push( JSON.stringify( $(this).data("new") ) );
						}
						else {
							allObjNew.push( "{}" );
						}

						allObjWithoutCss.push( JSON.stringify( $(this).data("withoutcss") ) );

						allObjCss.push( JSON.stringify( $(this).data("css") ) );

						allObjHover.push( JSON.stringify( $(this).data("hover") ) );

						allCustom.push( JSON.stringify( $(this).data("custom") ) );
						

						});

						// Now only push toggle_changes and custom css , later effects, redirectons, text, etc.
						allOptions.push( JSON.stringify( toggle_changes ) );// [0]
						allOptions.push( JSON.stringify( custom_css ) );// [1]
						
						google_fonts_selected = google_fonts_in_use;
						google_fonts_in_use = []; // reset

						$.each(google_fonts_selected, function(index, font){
							if ( allObjCss.join().indexOf(font.replace(/\+/g," ")) !== -1 || allObjHover.join().indexOf(font.replace(/\+/g," ")) !== -1) google_fonts_in_use.push(font);
						});

						allOptions.push( JSON.stringify( google_fonts_in_use ) );// [2]

						//guardamos id origen , nueva posicion y los hijos directos de designArena que son los que modificaremos.
						let setOrigin = {};
						let origin = $("#"+id_origin).offset();
						setOrigin.id = id_origin;
						setOrigin.top = origin.top;
						setOrigin.left = origin.left;
						setOrigin.parent = [];

						$("#designArea").children().each( function(index, value){
							if( typeof $(this).attr('object') != typeof undefined && $(this).attr('object') != false )
								setOrigin.parent.push(this.id);
						});

						allOptions.push( JSON.stringify( setOrigin ) );// [3]

						allOptions.push( JSON.stringify( user_variables ) ); // [4]

						/* recover selected objects*/
						$('#designArea, #designArea *').filter(function() {
								return $(this).data('selected') !== undefined; 
						}).each(function(){
							$(this).addClass("selected").removeData("selected");

						});


					//****** AJAX			
					
						var data = {
							action: 'loin_ctrl_save_obj_properties',
							security: '<?php echo $ajax_nonce; ?>',  // loin_ctrl_login_render_nonce
							dompath: allDomPath,
							new: allObjNew,
							withoutcss: allObjWithoutCss,
							css: allObjCss,
							hover: allObjHover,
							options: allOptions,
							custom: allCustom,
							action_to_do: 'save'
						};

				var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";


						// animated css icon
						$("#icons_menu_container").after('<div class="ajax_box_waitting not_selectable"><i class="fa fa-spinner fa-pulse fa-fw lc_centered"></i><span class="lc_centered">Saving...</span></div>');

						// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
						$.post(ajaxurl, data, function(response) { // if security fails response =  -1
							//alert('Got this from the server: ' + response);
							$(".ajax_box_waitting").remove();
						});
												
					//****** END AJAX
					});
				});
			</script>
			<?php

		}


if ( ! function_exists('loin_ctrl_load_script_style_for_custom_login') ) :

	function loin_ctrl_load_script_style_for_custom_login(){


		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-draggable', false, array('jquery'), false, false);
		wp_enqueue_media();
		wp_enqueue_script( 'jquery-ui-slider');

		wp_enqueue_style('login');
		wp_enqueue_style('loin_ctrl_font-awesome',  LOIN_CTRL_PLUGIN_URL . 'admin/css/font-awesome/css/font-awesome.min.css', array(), '4.7.0', 'all'); // local
		wp_enqueue_style('loin_ctrl_jquery-ui-style',  LOIN_CTRL_PLUGIN_URL . 'admin/css/jquery-ui-1.12.1.custom/jquery-ui.css', false, null); // local
		wp_enqueue_script( 'jquery-ui-accordion');
		wp_register_style( 'loin_ctrl_Stylesheet',  LOIN_CTRL_PLUGIN_URL . 'admin/css/stylesheet.css?v.1.1');
		wp_enqueue_style( 'loin_ctrl_Stylesheet' );
		wp_register_style( 'loin_ctrl_Reset',  LOIN_CTRL_PLUGIN_URL . 'admin/css/reset.css');
		wp_enqueue_style( 'loin_ctrl_Reset' );
		wp_register_script( 'loin_ctrl_combos', LOIN_CTRL_PLUGIN_URL . 'admin/js/combos.js');
		wp_enqueue_script('loin_ctrl_combos');

		wp_register_script( 'loin_ctrl_img_color_picker', LOIN_CTRL_PLUGIN_URL . 'admin/js/img_color_picker.js');

		require_once( LOIN_CTRL_PLUGIN_DIR . 'admin/includes/img_color_picker_constructor.php');

		wp_localize_script( 'loin_ctrl_img_color_picker', 'data_from_php_color', $color_picker_array );

		wp_enqueue_script('loin_ctrl_img_color_picker');
		wp_register_script( 'loin_ctrl_google_fonts_lorem_ipsum', LOIN_CTRL_PLUGIN_URL . 'public/GoogleFonts/json/lorem_ipsum.js');
		wp_enqueue_script('loin_ctrl_google_fonts_lorem_ipsum');

		wp_register_script( 'loin_ctrl_img_text_font', LOIN_CTRL_PLUGIN_URL . 'admin/js/img_text_font.js');
		require_once( LOIN_CTRL_PLUGIN_DIR . 'admin/includes/img_text_font_constructor.php');
		require_once( LOIN_CTRL_PLUGIN_DIR . 'admin/includes/btn_font_awesome_constructor.php'); // new

		wp_localize_script( 'loin_ctrl_img_text_font', 'data_from_php_text_font', $text_font_array );
		wp_localize_script( 'loin_ctrl_img_text_font', 'data_from_php_font_awesome', $font_awesome_array ); // new

		wp_enqueue_script('loin_ctrl_img_text_font');

		wp_register_script( 'loin_ctrl_img_toggle', LOIN_CTRL_PLUGIN_URL . 'admin/js/img_toggle.js');
		require_once( LOIN_CTRL_PLUGIN_DIR . 'admin/includes/img_toggle_constructor.php');
		

		wp_localize_script( 'loin_ctrl_img_toggle', 'data_from_php_toggle', $toggle_array );

		wp_enqueue_script('loin_ctrl_img_toggle');

		wp_register_script( 'loin_ctrl_img_code', LOIN_CTRL_PLUGIN_URL . 'admin/js/img_code.js');
		require_once( LOIN_CTRL_PLUGIN_DIR . 'admin/includes/img_code_constructor.php');

		wp_localize_script( 'loin_ctrl_img_code', 'data_from_php_code', $code_array );

		wp_enqueue_script('loin_ctrl_img_code');

		wp_register_script( 'loin_ctrl_shared', LOIN_CTRL_PLUGIN_URL . 'admin/js/shared.js');
		wp_enqueue_script( 'loin_ctrl_shared' );

		wp_register_script( 'loin_ctrl_img_flip', LOIN_CTRL_PLUGIN_URL . 'admin/js/img_flip.js');
		wp_enqueue_script( 'loin_ctrl_img_flip' );
		
		wp_register_script( 'loin_ctrl_img_marker', LOIN_CTRL_PLUGIN_URL . 'admin/js/img_marker.js');
		require_once( LOIN_CTRL_PLUGIN_DIR . 'admin/includes/img_marker_constructor.php');
		wp_localize_script( 'loin_ctrl_img_marker', 'data_from_php_marker', $marker_array );
		wp_enqueue_script( 'loin_ctrl_img_marker' );

		wp_register_script( 'loin_ctrl_img_box_model', LOIN_CTRL_PLUGIN_URL . 'admin/js/img_box_model.js');

		wp_register_script( 'loin_ctrl_img_flex_box', LOIN_CTRL_PLUGIN_URL . 'admin/js/img_flex_box.js');

		require_once( LOIN_CTRL_PLUGIN_DIR . 'admin/includes/img_flex_box_constructor.php');

		wp_localize_script( 'loin_ctrl_img_flex_box', 'data_from_php_flex_box', $box_flex_array );
		wp_enqueue_script( 'loin_ctrl_img_flex_box' );

		require_once( LOIN_CTRL_PLUGIN_DIR . 'admin/includes/img_box_model_constructor.php');

		wp_localize_script( 'loin_ctrl_img_box_model', 'data_from_php_model', $box_model_array );
		wp_enqueue_script( 'loin_ctrl_img_box_model' );

		wp_register_script( 'loin_ctrl_img_box_border', LOIN_CTRL_PLUGIN_URL . 'admin/js/img_border.js');

		require_once( LOIN_CTRL_PLUGIN_DIR . 'admin/includes/img_box_border_constructor.php');

		wp_localize_script( 'loin_ctrl_img_box_border', 'data_from_php_border', $box_border_array );
		wp_enqueue_script( 'loin_ctrl_img_box_border' );


		//register colorpicker
		wp_register_style( 'loin_ctrl_ColorpickerStylesheet',  LOIN_CTRL_PLUGIN_URL . 'admin/css/colorpicker/colorpicker.css');
		wp_enqueue_style( 'loin_ctrl_ColorpickerStylesheet');
		wp_register_script( 'loin_ctrl_ColorpickerScript',  LOIN_CTRL_PLUGIN_URL . 'admin/js/colorpicker/colorpicker.js');
		wp_enqueue_script( 'loin_ctrl_ColorpickerScript');

		require_once( LOIN_CTRL_PLUGIN_DIR . 'admin/includes/render_designer_box.php');

		wp_register_script( 'loin_ctrl_render_designer_box', LOIN_CTRL_PLUGIN_URL . 'admin/js/render_designer_box.js');

		wp_localize_script( 'loin_ctrl_render_designer_box', 'data_from_php_render_designer_box', $render_designer_box_array );
		

		wp_enqueue_script( 'loin_ctrl_render_designer_box'); //, false, false ,array('jquery'), true
		require_once( LOIN_CTRL_PLUGIN_DIR . 'admin/includes/move.php');
		wp_register_script( 'loin_ctrl_move', LOIN_CTRL_PLUGIN_URL . 'admin/js/move.js');
		wp_localize_script( 'loin_ctrl_move', 'data_from_php_move', $move_array );
		wp_enqueue_script( 'loin_ctrl_move');
		wp_register_script( 'loin_ctrl_contextual_menu', LOIN_CTRL_PLUGIN_URL . 'admin/js/contextual_menu.js');

		require_once( LOIN_CTRL_PLUGIN_DIR . 'admin/includes/contextual_translate.php');

		wp_localize_script( 'loin_ctrl_contextual_menu', 'data_from_php_contextual', $contextual_array );	
		wp_enqueue_script( 'loin_ctrl_contextual_menu');

		wp_register_script( 'loin_ctrl_render_elements_box', LOIN_CTRL_PLUGIN_URL . 'admin/js/render_elements_box.js');
		
		// Localize the script with new data
		$translation_array = array(
			'Insert_a_media_image' => __( 'Insert a media image', LOIN_CTRL_PLUGIN_DOMAIN ),
			'Insert_image' => __('Insert image',LOIN_CTRL_PLUGIN_DOMAIN),
			'Preview' => __( 'Preview', LOIN_CTRL_PLUGIN_DOMAIN ) // not used !!!

		);
		wp_localize_script( 'loin_ctrl_render_elements_box', 'obj_translation', $translation_array );

		wp_enqueue_script( 'loin_ctrl_render_elements_box'); 

		wp_register_script( 'loin_ctrl_browser_unsupported_css', LOIN_CTRL_PLUGIN_URL . 'admin/js/browser_unsupported_css.js');
		wp_enqueue_script('loin_ctrl_browser_unsupported_css');

		// Use Localize to inject data from Database to script
					
		global $wpdb;
		
		$Data_Objects = $wpdb->get_row( " SELECT Type, Html, Options, New, WithoutCss, Css, CssHover, Custom FROM {$wpdb->prefix}fs_forms WHERE Id_Form = '" . get_option ( 'loin_ctrl_DesignMode' )[2] . "'" ); //get_results
		

		if ( ! is_null($Data_Objects) ) { // esta condicion no tendria que passar nunca
			
			wp_register_script( 'loin_ctrl_load_css_form', LOIN_CTRL_PLUGIN_URL . 'admin/js/load_css_form.js');

			require_once( LOIN_CTRL_PLUGIN_DIR . 'admin/includes/load_css_form.php');
			wp_localize_script( 'loin_ctrl_load_css_form', 'data_from_php_load_css_form', $load_css_form_array );

			wp_localize_script( 'loin_ctrl_load_css_form', 'obj_Path', unserialize($Data_Objects->Html) );
			wp_localize_script( 'loin_ctrl_load_css_form', 'obj_Options', unserialize($Data_Objects->Options) );
			wp_localize_script( 'loin_ctrl_load_css_form', 'obj_new', unserialize($Data_Objects->New) );
			wp_localize_script( 'loin_ctrl_load_css_form', 'obj_withoutcss', unserialize($Data_Objects->WithoutCss) );
			wp_localize_script( 'loin_ctrl_load_css_form', 'obj_css', unserialize($Data_Objects->Css) );
			wp_localize_script( 'loin_ctrl_load_css_form', 'obj_hover', unserialize($Data_Objects->CssHover) );
			wp_localize_script( 'loin_ctrl_load_css_form', 'obj_custom', unserialize($Data_Objects->Custom) );
			wp_localize_script( 'loin_ctrl_load_css_form', 'obj_params', array( 
																			'Id_Form' => get_option ( 'loin_ctrl_DesignMode' )[2]
																		) );
			wp_localize_script( 'loin_ctrl_load_css_form', 'Id_Form', get_option ( 'loin_ctrl_DesignMode' )[2] );  // current form
			wp_localize_script( 'loin_ctrl_load_css_form', 'Form_Type', $Data_Objects->Type );  // Form Type
			wp_enqueue_script( 'loin_ctrl_load_css_form', false, false ,array('jquery'), true);      

			$GogleFonts_Options = unserialize($Data_Objects->Options);
			//$GogleFonts_Options = json_decode(stripslashes($GogleFonts_Options[2]), true);
			//wp_enqueue_style( 'loin_ctrl_google_fonts_enqueue_design', 'https://fonts.googleapis.com/css?family=' . join('|', $GogleFonts_Options), false);

			if ( array_key_exists( 2, $GogleFonts_Options ) ) {
				$GogleFonts_Options = json_decode(stripslashes($GogleFonts_Options[2]), true);
				if ( count($GogleFonts_Options) >0 )
					wp_enqueue_style( 'loin_ctrl_google_fonts_enqueue_design', 'https://fonts.googleapis.com/css?family=' . join('|', $GogleFonts_Options), false);
			}

		}

	}

	add_action( 'loin_ctrl_custom_login_form_head', 'loin_ctrl_load_script_style_for_custom_login');

endif;

function loin_ctrl_remove_footer_actions(){

	global $wp_filter;

	$keys = array();
	foreach ($wp_filter['wp_footer'] as $key=>$value) {
		foreach ( $value as $subkey=>$value ) {
			array_push( $keys,array( $key => $subkey) );
		}
	}

	foreach ( $keys as $key => $item ){
		foreach ( $item as $key => $subkey ){
			if (  ! in_array( $subkey, array('wp_print_media_templates','wp_print_footer_scripts','wp_admin_bar_render') ) ) 
			remove_action( 'wp_footer', $subkey, $key );   // $key => Priority
		}
	}

}
add_action( 'loin_ctrl_custom_login_form_head', 'loin_ctrl_remove_footer_actions',99);
 

// add template filter to loin_ctrl_login-render-fs

add_filter( 'template_include', 'loin_ctrl_load_login_template' ); //'single_template' for post , is_page_template('')

function loin_ctrl_load_login_template($template) {
     global $post;

	 if(is_single() || is_page()){

		 if ( $post->post_name == 'loin_ctrl_login-render-fs' )
			$template = LOIN_CTRL_PLUGIN_DIR . '/admin/includes/login-render-fs.php';
		 if ( $post->post_name == 'loin_ctrl_object-render-fs' )
			$template = LOIN_CTRL_PLUGIN_DIR . '/admin/includes/login-render-fs-object.php';
	}

     return $template;
     //wp_reset_postdata();
}


	add_action('template_redirect','loin_ctrl_template_redirect');

	function loin_ctrl_template_redirect() {
	  
		if ( strpos( $_SERVER['REQUEST_URI'], "downloads/loinctrl/export.zip") !== false ) {

			if( isset($_REQUEST['_wpnonce']))  {

				$nonce = $_REQUEST['_wpnonce'];
				
				if ( ! wp_verify_nonce( $nonce, 'loin_ctrl_download_nonce' ) ) {
				
					die( 'Security check' ); 
				
				} else {
				
					if ( current_user_can( 'activate_plugins' ) ) {

						global $wpdb;
						$wpdb->fs_forms = "{$wpdb->prefix}fs_forms";

						if ( isset( $_REQUEST['checked']) ) {
							$forms_id = sanitize_text_field($_REQUEST['checked']);
							$forms_id =  str_replace(",","','",$forms_id);
							$data_export = $wpdb->get_results("SELECT id_Form, Type, 'Disabled' as State, Options, Custom, Html, New, WithoutCss, Css, CssHover FROM $wpdb->fs_forms WHERE id_Form IN('$forms_id')");
						}
						else{
							$data_export = $wpdb->get_results("SELECT id_Form, Type, 'Disabled' as State, Options, Custom, Html, New, WithoutCss, Css, CssHover FROM $wpdb->fs_forms"); //, ARRAY_A
						}
						$images = [];
						foreach ($data_export as $design) {

							foreach (["Css","CssHover","WithoutCss","New","Options"] as $column) {
								$pos = strpos($design->{$column}, "uploads");
								while ( $pos !== false) {
									$img_path = str_replace(")","",substr($design->{$column}, $pos + 7,  strpos($design->{$column}, '\\',$pos) - ($pos + 7) ));
									
									if ( !in_array($img_path, $images) ){
										$images[] = $img_path;
									}

									$pos = strpos($design->{$column}, "uploads", $pos + 1);
								}
							}
				
						}
		
						$uploads = wp_upload_dir();

						if ( !function_exists( 'wp_tempnam' ) ) { 
							require_once ABSPATH . '/wp-admin/includes/file.php'; 
						} 
						// Prepare File


						$file = wp_tempnam("", LOIN_CTRL_PLUGIN_DIR_TEMP);
						$zip = new ZipArchive();
						$res = $zip->open($file, ZipArchive::OVERWRITE);

						if ($res === TRUE) { 
							$zip->addFromString('designs.json', json_encode($data_export)); //end(explode('/', $initialString)) //getcwd() //json_encode($data_export)
							$zip->addEmptyDir("images");
							$zip->addEmptyDir("css");
							$options = array('add_path' => "css/", 'remove_all_path' => TRUE); //DIRECTORY_SEPARATOR

							if ( isset( $_REQUEST['checked']) ) {
								$forms_id = explode( ",", sanitize_text_field($_REQUEST['checked']) );

								for( $i=0; $i < count($forms_id); $i++ ){
									$zip->addGlob( LOIN_CTRL_PLUGIN_DIR . "css/" . str_replace(" ","_",$forms_id[$i]) . '.{css}', GLOB_BRACE, $options);
									$zip->addGlob( LOIN_CTRL_PLUGIN_DIR . "css/" . str_replace(" ","_",$forms_id[$i]) . '_preview.{css}', GLOB_BRACE, $options);
								}
	
							}
							else{
								$zip->addGlob( LOIN_CTRL_PLUGIN_DIR . "css/" . '*.{css}', GLOB_BRACE, $options);
							}

							foreach ( $images as $image){
								$zip->addFile( $uploads['basedir'] . $image, 'images/' . basename($image));
							}
								
							// Close and send to users
							$zip->close();


							header('Content-Type: application/zip',true,200);
							//header("Content-Transfer-Encoding: Binary");
							header('Content-Length: ' . filesize($file));
							header('Content-Disposition: attachment; filename=' . 'wplogincontrol_export.zip');
							header("Pragma: no-cache");
							header("Expires: 0");
							ob_clean();
							flush();
							readfile($file);

							unlink($file);
							
						}

					}
			
				}
				exit; // exit();
			}
		}
	}

?>