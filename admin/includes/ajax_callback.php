<?php
	
	// Prevent direct file access
	if( ! defined( 'ABSPATH' ) ) die();
	
    /**
    * Refresh List Table
    */     

	do_action('loin_ctrl_ajax_callback');

	function loin_ctrl_ajax_fetch_custom_list_table_callback() {




		require_once( LOIN_CTRL_PLUGIN_DIR . 'classes/class.Forms_List_Table.php');

		$wp_list_table = new loin_ctrl_Forms_List_Table();
		
		$wp_list_table->ajax_response();

	}
	add_action('wp_ajax_loin_ctrl_ajax_fetch_custom_list_table', 'loin_ctrl_ajax_fetch_custom_list_table_callback');


    /**
    * Redirect to Login page
    */    



		add_action( 'wp_ajax_loin_ctrl_del_front', 'loin_ctrl_del_front_callback' );

		function loin_ctrl_del_front_callback() {

            global $wpdb;

	        check_ajax_referer( 'loin_ctrl_preview_box', 'security');

  			$action_type = sanitize_text_field($_POST['doaction']);
			$id_form = sanitize_text_field($_POST['template']);
			$form_type = sanitize_text_field($_POST['type']);

			$per_page = 6;
			$last_line_page = 0;

            //check if has manager capabilities
			switch ( $action_type ) {

				case "delete":
					$wpdb->fs_forms = "{$wpdb->prefix}fs_forms";
					$wpdb->fs_cron = "{$wpdb->prefix}fs_cron";
					try{
						$position = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->fs_forms WHERE id_Form <= '". $id_form . "'" );
						$rows = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->fs_forms");
						if ($position == $rows ) $last_line_page = ( (intval($rows) - 1) % $per_page == 0  ?  1 :  0 ); // check if is last line in last page before delete.
						$page_to_go = (int)( intval($position) / $per_page ) + ( intval($position) % $per_page == 0  ?  0 :  1 ) - $last_line_page ; 
					}
					finally{
						$wpdb->delete( $wpdb->fs_forms, array( "id_Form" => "{$id_form}" ) );
						$wpdb->delete( $wpdb->fs_cron, array( "id_Form" => "{$id_form}" ) );

						//delete css and css preview
						$path = LOIN_CTRL_PLUGIN_DIR . 'css/';

						unlink($path . str_replace(" ", "_", $id_form) . '.css');
						unlink($path . str_replace(" ", "_", $id_form) . '_preview.css');
						// delete crone if exist;
						echo $page_to_go;
					}

					break;

				case "front_end":
					update_option ( 'loin_ctrl_DesignMode', array( wp_get_current_user()->user_login , true, sanitize_text_field($_POST['template']) ) );

					//if page exists delete it
					try {

						switch ( $form_type ) {

							case "LoginDefault":
													$page = get_page_by_path('loin_ctrl_login-render-fs');
													if ( $page ) wp_delete_post($page->ID, true); //$deletedpage =
													break;
							case "ObjectBlank":
													$page = get_page_by_path('loin_ctrl_Object-render-fs');
													if ( $page ) wp_delete_post($page->ID, true); //$deletedpage =
													break;
							default:
									//nothing
						}

					}
					//create page dinamically
					finally{
						global $user_ID;

						switch ( $form_type ) {

							case "LoginDefault":

													$new_post = array(
														'post_title'	=>	'loin_ctrl_Login Render FS',
														//'post_content'	=>	'',
														'post_status'	=>	'publish',
														'post_date'		=>	date('Y-m-d H:i:s'),
														'post_author'	=>	$user_ID,
														'post_type'		=>	'page',
														'post_category'	=>	array(0)
													);

													$post_id = wp_insert_post($new_post);

													if (!$post_id) {
														wp_die('Error creating page');
													}


													echo get_permalink( $post_id );
													break;

							case "ObjectBlank":
													$new_post = array(
														'post_title'	=>	'loin_ctrl_Object Render FS',
														//'post_content'	=>	'',
														'post_status'	=>	'publish',
														'post_date'		=>	date('Y-m-d H:i:s'),
														'post_author'	=>	$user_ID,
														'post_type'		=>	'page',
														'post_category'	=>	array(0)
													);

													$post_id = wp_insert_post($new_post);

													if (!$post_id) {
														wp_die('Error creating page');
													}


													echo get_permalink( $post_id );
													break;
							default:
									//nothing
						}
					}
					break;
				default:
					//nothing
					
			}
            

			wp_die(); // this is required to terminate immediately and return a proper response

            exit;

		}




    /**
    * Save new Form on dialog popup
    */    


		add_action( 'wp_ajax_loin_ctrl_action_save_new_form', 'loin_ctrl_action_callback_save_new_form' );

		function loin_ctrl_action_callback_save_new_form() {

 	        check_ajax_referer( 'loin_ctrl_ajax-custom-list-nonce-display', 'security' );

			$action_type = sanitize_text_field($_POST['action_to_do']);

			switch ($action_type) {

				case "export":
								break;
				default:
								$formname = sanitize_text_field($_POST['formname']) ; 
								$formname_clone = empty($_POST['formname_clone']) ? "" : sanitize_text_field($_POST['formname_clone']) ;
								$type = sanitize_text_field($_POST['type']);

			}
			/*
			$formname = sanitize_text_field($_POST['formname']) ; 
			$formname_clone = empty($_POST['formname_clone']) ? "" : sanitize_text_field($_POST['formname_clone']) ;
			$type = sanitize_text_field($_POST['type']);
			$action_type = sanitize_text_field($_POST['action_to_do']);
			*/

            //check if has manager capabilities



			global $wpdb;
			//$wpdb->fs_forms = "{$wpdb->prefix}fs_forms";


			$per_page = 6;
			$path = LOIN_CTRL_PLUGIN_DIR . 'css/';

			$wpdb->fs_forms = "{$wpdb->prefix}fs_forms";
			$wpdb->fs_cron = "{$wpdb->prefix}fs_cron";


			switch($action_type) {

				case "new":

						try{
								$wpdb->insert( $wpdb->fs_forms, array(  'id_Form' => $formname , 'State' => 'Disabled', 'Type' => $type , 'Options' => 'a:2:{i:0;s:27:"{\"toggle_loginForm\":true}";i:1;s:4:"\"\"";}', 'Html' => 'a:0:{}', 'New' => 'a:0:{}', 'WithoutCss' => 'a:0:{}', 'Css' => 'a:0:{}', 'CssHover' => 'a:0:{}' ) );

						}
						finally{
								$position = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->fs_forms WHERE id_Form <= '". $formname . "'" ); // $formname == form_id
								$page_to_go = (int)( intval($position) / $per_page ) + ( intval($position) % $per_page == 0  ?  0 :  1 ) ;
								touch( $path . str_replace(" ", "_", $formname) . '_preview.css'); 
								echo $page_to_go;
						}

						wp_die();

						break;

				case "clone":

						try{
							//change de Id inside

							$data_to_change = $wpdb->get_row( $wpdb->prepare("SELECT Options, Html, New FROM $wpdb->fs_forms WHERE id_Form = %s",array($formname_clone)) );
							
							foreach (array("Options","Html","New") as $column) { 
								
								$data_to_change->{$column} = serialize( str_replace( "_" . $formname_clone . "_", "_" . $formname . "_", unserialize ($data_to_change->{$column})));
		
							}

							$wpdb->query($wpdb->prepare("INSERT INTO $wpdb->fs_forms (id_Form, Type, State, Options, Custom, Html, New, WithoutCss, Css, CssHover) SELECT %s, Type, 'Disabled', %s, Custom, %s, %s, WithoutCss, Css, CssHover FROM $wpdb->fs_forms WHERE id_Form = %s",array($formname, $data_to_change->Options, $data_to_change->Html, $data_to_change->New, $formname_clone) ) );
								//copy .css file

								//copy( $path . str_replace(" ", "_", $formname_clone) . '.css', $path . str_replace(" ", "_", $formname) . '.css');
								//copy( $path . str_replace(" ", "_", $formname_clone) . '_preview.css', $path . str_replace(" ", "_", $formname) . '_preview.css');

								$allfile = str_replace( "_" . $formname_clone . "_", "_" . $formname . "_", file_get_contents($path . str_replace(" ", "_", $formname_clone) . '.css'));
								$myfile = fopen($path . str_replace(" ", "_", $formname) . '.css', "w");
								fwrite($myfile, $allfile);
								fclose($myfile);

								$allfile = str_replace( "_" . $formname_clone . "_", "_" . $formname . "_", file_get_contents($path . str_replace(" ", "_", $formname_clone) . '_preview.css'));
								$myfile = fopen($path . str_replace(" ", "_", $formname) . '_preview.css', "w");
								fwrite($myfile, $allfile);
								fclose($myfile);

						}
						finally{
								$position = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->fs_forms WHERE id_Form <= '". $formname . "'" ); // $formname == form_id
								$page_to_go = (int)( intval($position) / $per_page ) + ( intval($position) % $per_page == 0  ?  0 :  1 ) ; 
								echo $page_to_go;
						}

						wp_die();

						break;

				case "export":
			
						wp_die();
						

						break;

				case "import":

						require_once( __DIR__ . '/my_upload.php');

						wp_die();
						break;

			}

            exit;

		}



    /**
    * Call from Toolbar save button
    */   


		add_action( 'wp_ajax_loin_ctrl_save_obj_properties', 'loin_ctrl_receive_click_save' );

		function loin_ctrl_receive_click_save() {
			global $wpdb; // this is how you get access to the database


            //update_option ( 'loin_ctrl_DesignMode', array( wp_get_current_user()->user_login , true ) );


			check_ajax_referer( 'loin_ctrl_login_render_nonce', 'security'); 


			$dompath =  sanitize_text_field( serialize($_POST['dompath']) ) ;
			$new = sanitize_text_field( serialize($_POST['new']) );
			$withoutcss = sanitize_text_field( serialize($_POST['withoutcss']) );
			$css = sanitize_text_field( serialize($_POST['css']) );
			$hover = sanitize_text_field( serialize($_POST['hover']) );
			$options = sanitize_text_field( serialize($_POST['options']) );
			$custom = sanitize_text_field( serialize($_POST['custom']) );
			$action_type = sanitize_text_field($_POST['action_to_do']);

			switch($action_type) {

				case "save":

						$wpdb->fs_forms = "{$wpdb->prefix}fs_forms";

						$currentForm = get_option ( 'loin_ctrl_DesignMode' )[2];
						$wpdb->update( $wpdb->fs_forms, array( 'Html' => $dompath, 'Options' => $options, 'New' => $new, 'WithoutCss' => $withoutcss, 'Css' => $css, 'CssHover' => $hover, 'Custom' => $custom ), array('id_Form'=>$currentForm) );

			
						$Data_Objects = $wpdb->get_row( " SELECT Type, Html, Options, Css, CssHover FROM {$wpdb->prefix}fs_forms WHERE Id_Form = '" . $currentForm . "'" ); //get_results
			
						$obj_Path = unserialize($Data_Objects->Html);
						$obj_css = unserialize($Data_Objects->Css);
						$obj_hover = unserialize($Data_Objects->CssHover);
						$obj_options = unserialize($Data_Objects->Options);
						$obj_custom = unserialize($Data_Objects->Custom); // implementar recuperacion de link e insercion en etiqueta Html en el $new???

						$pos_options = json_decode(stripslashes( $obj_options[3] ));

						$is_Object_shortcode = ($Data_Objects->Type ==  "ObjectBlank" ? true : false);




						//open file css 

						$handle = fopen( LOIN_CTRL_PLUGIN_DIR . 'css/' . str_replace(" ", "_", $currentForm) . '.css', 'w');
						$handle_preview = fopen( LOIN_CTRL_PLUGIN_DIR . 'css/' . str_replace(" ", "_", $currentForm) . '_preview.css', 'w');

						// custom css
						$Options = json_decode(stripslashes( $obj_options[0] ));
						if (array_key_exists('toggle_activateCode', $Options)) {
							fwrite($handle, json_decode(stripslashes( $obj_options[1] )) . PHP_EOL);
							fwrite($handle_preview, "#preview " . str_replace("body", ".body", json_decode(stripslashes( $obj_options[1] ))) . PHP_EOL);
						}
						// end custom css

						// reset p tag for preview
						$p_tag_reset = "#preview p{" . PHP_EOL;
						$p_tag_reset .= "\t " . "margin: 0;" . PHP_EOL;
						$p_tag_reset .= "\t " . "padding: 0;" . PHP_EOL;
						$p_tag_reset .= "\t " . "border: 0;" . PHP_EOL;
						$p_tag_reset .= "\t " . "font-size: inherit;" . PHP_EOL;
						$p_tag_reset .= "\t " . "font: inherit;" . PHP_EOL;
						$p_tag_reset .= "\t " . "color : inherit;" . PHP_EOL;
						$p_tag_reset .= "\t " . "line-height : inherit;" . PHP_EOL;
						$p_tag_reset .= "\t " . "text-decoration : inherit;" . PHP_EOL;
						$p_tag_reset .= "\t " . "font-style : inherit;" . PHP_EOL;
						$p_tag_reset .= "\t " . "font-weight : inherit;" . PHP_EOL;
						$p_tag_reset .= "\t " . "font-family : inherit;" . PHP_EOL;
						$p_tag_reset .= "}". PHP_EOL;

						fwrite($handle_preview, $p_tag_reset);

	
						foreach ( $obj_Path as $index => $obj_id) { //value
							$obj_id = preg_replace('/.(\w+)_designer/', '', $obj_id);
							$css_string = str_replace("#designArea ", "", $obj_id) . "{" . PHP_EOL ;  
							$css_hover_string = str_replace("#designArea ", "", $obj_id) . ":hover {" . PHP_EOL ;
							
							$css_string_preview = $css_string;

							if ( $is_Object_shortcode ) {

								while ( $pos = strpos($css_string, "#") ) {

									$rpos = strpos($css_string, '{', $pos);
									$rpos_1 = strpos($css_string, ':', $pos);
									$rpos_2 = strpos($css_string, ' ', $pos);
									$rpos_3 = strpos($css_string, '.', $pos);
									


									if ($rpos)
										$rearpos = $rpos;

									if ($rpos_1 && $rpos_1 < $rearpos)
										$rearpos = $rpos_1;

									if ($rpos_2 && $rpos_2 < $rearpos)
										$rearpos = $rpos_2;

									if ($rpos_3 && $rpos_3 < $rearpos)
										$rearpos = $rpos_3;



									$css_string = substr($css_string, 0, $pos ) . '[id^="' . substr($css_string, $pos+1, $rearpos - $pos - 1 ) . '"]' . substr($css_string, $rearpos );

								}

								$css_string_preview = $css_string = preg_replace('/#/', '[id^="', $css_string);
	

								while ( $pos = strpos($css_hover_string, "#") ) {
							
									$rpos = strpos($css_hover_string, '{', $pos);
									$rpos_1 = strpos($css_hover_string, ':', $pos);
									$rpos_2 = strpos($css_hover_string, ' ', $pos);
									$rpos_3 = strpos($css_hover_string, '.', $pos);
									
							
							
									if ($rpos)
										$rearpos = $rpos;
							
									if ($rpos_1 && $rpos_1 < $rearpos)
										$rearpos = $rpos_1;
							
									if ($rpos_2 && $rpos_2 < $rearpos)
										$rearpos = $rpos_2;
							
									if ($rpos_3 && $rpos_3 < $rearpos)
										$rearpos = $rpos_3;
							
							
							
									$css_hover_string = substr($css_hover_string, 0, $pos ) . '[id^="' . substr($css_hover_string, $pos+1, $rearpos - $pos - 1 ) . '"]' . substr($css_hover_string, $rearpos );
							
								}

							}



							$obj = json_decode(stripslashes( $obj_css[$index] ));
							foreach ( $obj as $prop => $value) {

								$css_string_preview .= "\t " . str_replace("_", "-", $prop) . " : " . $value . ";" . PHP_EOL ;

									if ( in_array( substr($obj_id, strrpos( $obj_id, "#" ) + 1), $pos_options->parent) ) {

										
											switch ($prop) {
												case 'top':					
															preg_match("/\D+$/", $value, $units);
															if ( ! in_array( $units[0], array("auto", "initial", "inherit") ) ) {
																$value -= $pos_options->top;
																$value = $value . $units[0];
															}
															break;
												case 'left':				
															preg_match("/\D+$/", $value, $units);
															if ( ! in_array( $units[0], array("auto", "initial", "inherit") ) ) {
																$value -= $pos_options->left;
																$value = $value . $units[0];
															}
															break;
											}
										
										
									}

								$css_string .= "\t " . str_replace("_", "-", $prop) . " : " . $value . ";" . PHP_EOL ;
							}

							$obj = json_decode(stripslashes( $obj_hover[$index] ));

							foreach ( $obj as $prop => $value) {
								$css_hover_string .=  "\t " . str_replace("_", "-", $prop) . " : " . $value . ";" . PHP_EOL;
							}

							// check if css is empty
							if ( strpos( $css_string , ";") !== false ) {
								fwrite($handle, $css_string . "}" . PHP_EOL);
								$css_string_preview = ( strpos($css_string, "body") !== false ) ? "." . $css_string_preview : $css_string_preview;
								fwrite($handle_preview, "#preview " . $css_string_preview . "}" . PHP_EOL);
							}

							// check if css hover is empty
							if ( strpos( $css_hover_string , ";") !== false ) {
								fwrite($handle, $css_hover_string . "}" . PHP_EOL);
								$css_hover_string = ( strpos($css_hover_string, "body") !== false ) ? "." . $css_hover_string : $css_hover_string;
								fwrite($handle_preview, "#preview " . $css_hover_string . "}" . PHP_EOL);
							}

						}				

						fclose($handle);
						fclose($handle_preview);

						echo "saved";
						wp_die();

					break;

				case "delete_page":
						$page = get_page_by_path('loin_ctrl_login-render-fs'); // render login page
						if( !is_null($page) ) wp_delete_post($page->ID, true); // by default return an object
						$page = get_page_by_path('loin_ctrl_Object-Render-FS');// render Shortcode page
						if( !is_null($page) ) wp_delete_post($page->ID, true); // by default return an object
						echo 'deleted'; // deleted
						//echo get_option ( 'loin_ctrl_DesignMode' )[2];  // current form
					break;

			} //switch


			wp_die(); // this is required to terminate immediately and return a proper response

			exit;


			}



    /**
    * change Form state
    */   


		add_action( 'wp_ajax_loin_ctrl_action_change_state', 'loin_ctrl_change_form_state' );

		function loin_ctrl_change_form_state() {
			global $wpdb; // this is how you get access to the database

			check_ajax_referer( 'loin_ctrl_preview_box', 'security');

			$idform =  sanitize_text_field($_POST['idform']) ; 
			$state =  sanitize_text_field($_POST['state']) ;

			$wpdb->fs_forms = "{$wpdb->prefix}fs_forms";
			$wpdb->update( $wpdb->fs_forms, array( 'State' => $state ), array('id_Form' => $idform) );
			
			wp_die(); 

			exit;

		}

?>