<?php

// Prevent direct file access
	if( ! defined( 'ABSPATH' ) ) die();

    function loin_ctrl_about_box(){

		echo '<span class="intro-text">' . esc_html__(' Congratulations! You are about to use most powerful time saver to give style your login page and build Sortcodes in WordPress - WP login control is a powerful object-oriented plugin with Frontend real time editor by Forsys Software.', LOIN_CTRL_PLUGIN_DOMAIN) . '</span>';

    }

    function loin_ctrl_help_box(){

		echo '<p>' . esc_html__('WP Login Control plugin help resources:', LOIN_CTRL_PLUGIN_DOMAIN) . '</p>';
		echo '<ul class="help">';
		echo '<li><a href="'. LOIN_CTRL_PLUGIN_URL. 'documentation/index.html" title="' . esc_html__('Open the documentation', LOIN_CTRL_PLUGIN_DOMAIN) . '" target="_blank">' . esc_html__('Documentation', LOIN_CTRL_PLUGIN_DOMAIN) . '</a></li>';
		echo '<li><a href="https://www.youtube.com/channel/UC7SNF9r_D3zD2XW3nB2sBoQ" title="' . esc_html__('Open Video Tutorials', LOIN_CTRL_PLUGIN_DOMAIN) . '" target="_blank">' . esc_html__('Video Tutorials', LOIN_CTRL_PLUGIN_DOMAIN) . '</a></li>';
		echo '<li><a href="https://wplogincontrol.com" title="' . esc_html__('Open Plugin Site', LOIN_CTRL_PLUGIN_DOMAIN) . '" target="_blank">' . esc_html__('WP Login Control Site - FORSYS SOFTWARE S.L.', LOIN_CTRL_PLUGIN_DOMAIN) . '</a></li>';
		echo '</ul>';

    }

	function loin_ctrl_updates_box(){
?>

<h3 class="fs-version"> <?php esc_html_e('Version 2.0', LOIN_CTRL_PLUGIN_DOMAIN) ?> - Early bird ( 03/01/2018 )</h3>

			<p class="fs-new"><?php esc_html_e('NEW', LOIN_CTRL_PLUGIN_DOMAIN) ?><p>
			<ul class="">
				<li>
					<?php esc_html_e('Shortcode Builder.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('800+ Google Fonts.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('Font Awesome 4.7 , 675 icons.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('Templates ( Export / Import ).', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('9 tag elements for shortcode Builder and Login Page.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
					<ul>
						</br>
						<li>DIV</li>
						<li>SPAN</li>
						<li>P</li>
						<li>LABEL</li>
						<li>HR</li>
						<li>H1 to H6</li>
						<li>A</li>
						<li>UL</li>
						<li>LI</li>
					</ul>
				</li>
				<li>
					<?php esc_html_e('Move, drag and drop.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('Variables: {content} and user defined ( of type text and attibute ) , for Shortcode Builder.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('Cron for Shortcodes.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('Flexible Box, CSS property.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('Columns, CSS property.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('Lists, CSS property.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('Box shadow, CSS property.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('Display, CSS property.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('Float, CSS property.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('Clear, CSS property.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('Vertical align, CSS property.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('Added remove property.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('Background pattern for a better experience in the opacity of the elements.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('Now you can chose position when an element is created.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('You can edit tags and write inside ( as many text nodes as you want ).', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
			</ul>

			<p class="fs-changes"><?php esc_html_e('CHANGES', LOIN_CTRL_PLUGIN_DOMAIN) ?><p>
			<ul class="">
				<li>
					<?php esc_html_e('Now you can delete items by pressing the "Delete" key.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('When we create a new form we will have to choose between Login -> Default Page and Shortcode Object -> Blank Page.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('Added a "Hex" input box for color tools.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('Minor improvements in toolboxes.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
			</ul>

			<p class="fs-bugfixes"><?php esc_html_e('BUGFIXES', LOIN_CTRL_PLUGIN_DOMAIN) ?><p>
			<ul class="">
				<li>
					<?php esc_html_e('Removed Shortcode from "Default Login", this option will be available in "Custom Login".', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('Solved some errors with the units (%, px) when moving and minor errors in Input Boxes.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('Some minor CSS errors.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
			</ul>

			
			<h3 class="fs-version"> <?php esc_html_e('Version 1.4', LOIN_CTRL_PLUGIN_DOMAIN) ?> - SunLight ( 23/05/2017 )</h3>

			<p class="fs-new"><?php esc_html_e('NEW', LOIN_CTRL_PLUGIN_DOMAIN) ?><p>
			<ul class="">
				<li>
					<?php esc_html_e('Individual images can now be inserted.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('A new toggle buttons option form has been added.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('Hide the login error message.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('Hide "Remember Me".', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('Hide log in | Lost password link.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('Hide the "Back to" link.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('Remove the login page shake.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('Set "Remember Me" to checked.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('Now, you can style the error message and message when disconnected.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('Now, you can style the "Lost your password Form".', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('Now, you can style the "Register Form".', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('Custom CSS editor for advanced users.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('Edit Logo Title and Logo Link.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('Support for "Font Awesome 4.7.0" through the css editor.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
			</ul>

			<p class="fs-bugfixes"><?php esc_html_e('BUGFIXES', LOIN_CTRL_PLUGIN_DOMAIN) ?><p>
			<ul class="">
				<li>
					<?php esc_html_e('Fixed error loading preview of new forms.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('Fixed preview when cloning.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('Fixed an error with the background color of the body, which appeared in the previous revision.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
			</ul>


			<h3 class="fs-version"> <?php esc_html_e('Version 1.3 rev.02', LOIN_CTRL_PLUGIN_DOMAIN) ?> - SunLight ( 13/04/2017 )</h3>

			<p class="fs-changes"><?php esc_html_e('CHANGES', LOIN_CTRL_PLUGIN_DOMAIN) ?><p>
			<ul class="">
				<li>
					<?php esc_html_e('Changes to include this plugin in the WordPress.org directory.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('Deleted Premium icons in free version to be compatible with GPL.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('Validations in the javascript interface, for better experience and stability.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('Names of functions, defines, classnames, hooks, nonces, etc. have been changed to coexist with other plugins.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('Improvements in the text shadows tool.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
			</ul>

			<h3 class="fs-version"> <?php esc_html_e('Version 1.3 rev.01', LOIN_CTRL_PLUGIN_DOMAIN) ?> - SunLight ( 16/03/2017 )</h3>

			<p class="fs-bugfixes"><?php esc_html_e('BUGFIXES', LOIN_CTRL_PLUGIN_DOMAIN) ?><p>
			<ul class="">
				<li>
					<?php esc_html_e('Fixed error in some files that caused that only the interface in Spanish was shown.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('Fixed minor translations in login page.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
			</ul>

			<h3 class="fs-version"> <?php esc_html_e('Version 1.3', LOIN_CTRL_PLUGIN_DOMAIN) ?> - SunLight ( 06/03/2017 )</h3>

			<p class="fs-new"><?php esc_html_e('NEW', LOIN_CTRL_PLUGIN_DOMAIN) ?><p>
			<ul class="">
				<li>
					<?php esc_html_e('First version of the VOD PLUS add-on (Premium).', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('The CSS property "Background-size" has been added.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('The CSS property "Background-origin" has been added.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('The CSS property "Background-Blend" has been added. "Edge" does not support this property.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('Added 15 new CSS Text and Font properties, some of them only in (Premium Version).', LOIN_CTRL_PLUGIN_DOMAIN) ?>
					<ul>
						</br>
						<li>text-align</li>
						<li>text-decoration</li>
						<li>text-transform</li>
						<li>text-indent</li>
						<li>letter-spacing</li>
						<li>line-height</li>
						<li>direction</li>
						<li>word-spacing</li>
						<li>text-overflow</li>
						<li>text-shadow</li>
						<li>font-family</li>
						<li>font-size</li>
						<li>font-style</li>
						<li>font-variant</li>
						<li>font-weight</li>
					</ul>
				</li>
			</ul>

			<p class="fs-changes"><?php esc_html_e('CHANGES', LOIN_CTRL_PLUGIN_DOMAIN) ?><p>
			<ul class="">
				<li>
					<?php esc_html_e('Improvements in the combo boxes, a custom one has been created.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('9 values have been added in the CSS property "Background-position".', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('4 values have been added in the CSS property "Background-repeat".', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('3 values have been added in the CSS property "Background-attachment".', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('Secondary toolboxes can now be expanded and collapsed in each section.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('Toolboxes are now automatically updated when an object is selected or when the hover button is pressed.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
			</ul>

			<p class="fs-bugfixes"><?php esc_html_e('BUGFIXES', LOIN_CTRL_PLUGIN_DOMAIN) ?><p>
			<ul class="">
				<li>
					<?php esc_html_e('When you save the changes, you no longer lose the selection of the selected items.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('Fixed some css errors in the generation of the external css file.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('Fixed errors when setting and deleting background images.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
			</ul>

			<h3 class="fs-version"> <?php esc_html_e('Version 1.0 rev.02', LOIN_CTRL_PLUGIN_DOMAIN) ?> - SunLight ( 30/01/2017 )</h3>
			<p class="fs-bugfixes"><?php esc_html_e('BUGFIXES', LOIN_CTRL_PLUGIN_DOMAIN) ?><p>
			<ul class="">
				<li>
					<?php esc_html_e('4 errors in the CSS code that affected the toolbox. With these fixes, Edge and Safari work correctly.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
				<li>
					<?php esc_html_e('Error in the flip buttons, which caused the toolboxes to also flip when applied to the Body element (DESIGNAREA).', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
			</ul>

			<h3 class="fs-version"> <?php esc_html_e('Version 1.0', LOIN_CTRL_PLUGIN_DOMAIN) ?> - SunLight ( 25/01/2017 )</h3>
			<p class="fs-new"><?php esc_html_e('NEW', LOIN_CTRL_PLUGIN_DOMAIN) ?><p>
			<ul class="">
				<li>
					<?php esc_html_e('This is first release, enjoy it.', LOIN_CTRL_PLUGIN_DOMAIN) ?>
				</li>
			</ul>
<?php  
    }


    function loin_ctrl_FormsTable() {


		do_action('loin_ctrl_enqueue_for_FormsTable');


		add_action( 'admin_footer', 'loin_ctrl_preview_box' ); // Write our JS below here

		function loin_ctrl_preview_box() { 
			
			$ajax_nonce = wp_create_nonce( 'loin_ctrl_preview_box' );
			
			$message = "";
			$message = apply_filters( 'login_message', $message ); //Notice: Undefined variable:
			//echo apply_filters( 'login_message', $message );
			global $wpdb;

			$Data_Objects = $wpdb->get_results( " SELECT Id_Form, Options, New, Custom FROM {$wpdb->prefix}fs_forms ", OBJECT_K ); //get_results

			foreach ( $Data_Objects as $key => $value ){
				if ( is_array( unserialize ( $Data_Objects[$key]->New ) ) ) // if New is empty array_filter crash
					$Data_Objects[$key]->New = array_filter( unserialize ( $Data_Objects[$key]->New ) ); //todas las entradas de array iguales a FALSE serán eliminadas
				if ( is_array( unserialize ( $Data_Objects[$key]->Options ) ) ) // if Options is empty array_filter crash
					$Data_Objects[$key]->Options = array_filter( unserialize ( $Data_Objects[$key]->Options ) ); //todas las entradas de array iguales a FALSE serán eliminadas
				if ( is_array( unserialize ( $Data_Objects[$key]->Custom ) ) ) // if Custom is empty array_filter crash
					$Data_Objects[$key]->Custom = array_filter( unserialize ( $Data_Objects[$key]->Custom ) ); //todas las entradas de array iguales a FALSE serán eliminadas
			}
			
			?>

			<script type="text/javascript" >
			
			var js_array_new;
			
			(function ($) {

			js_array_new = <?php echo  json_encode( $Data_Objects ); ?>;
			//load goggle fonts used in all forms


			String.prototype.stripSlashes = function(){	// no se carga la que tenemos en shared , revisar
				return this.replace(/\\(.)/mg, "$1");
			}

			var familiesArray = []; //'Boogaloo::latin'

			$.each( js_array_new, function(form_key, value) {

				current_array_options = js_array_new[form_key].Options; // if is empty returns string not an object
				if ( current_array_options[2] != undefined ) {

					familiesArray_temp = JSON.parse(current_array_options[2].stripSlashes());

					$.each(familiesArray_temp,function(index,value){
						if ($.inArray(value,familiesArray)==-1) familiesArray.push(value);
					});
				}

			});


			WebFontConfig = {
				//typekit: { id: 'xxxxxx' }
				google: {
					families: familiesArray//, //[ 'Roboto+Condensed', 'Source+Sans+Pro','Eater' ]
					//text: 'Lorem Ipsum'  // Failed to decode download font !!!
				}
			};

			(function(d) {
				var wf = d.createElement('script'), s = d.scripts[0];
				wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
				wf.async = true;
				if (familiesArray.length > 0) s.parentNode.insertBefore(wf, s);
			})(document);
			// end google fonts
			var tooltip_login = '\
								<div class="login login-action-login wp-core-ui  locale-es-es">\
								<div id="login">\
									<h1><a  tabindex="-1"><?php esc_html(bloginfo( 'name' )); ?></a></h1>\
									<?php echo ( !empty( $message ) ) ? $message : ""; ?>\
									<form name="loginform" id="loginform" >\
										<p>\
											<label for="user_login"><?php esc_html_e( 'Username or Email Address' ); ?><br />\
											<input type="text" name="log" id="user_login" class="input" value="" size="20" /></label>\
										</p>\
										<p>\
											<label for="user_pass"><?php esc_html_e( 'Password' ); ?><br />\
											<input type="password" name="pwd" id="user_pass" class="input" value="" size="20" /></label>\
										</p>\
										<p class="forgetmenot"><label for="rememberme"><input name="rememberme" type="checkbox" id="rememberme" value="forever"  /> <?php esc_html_e( 'Remember Me' ); ?></label></p>\
										<p class="submit">\
											<input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="<?php _e( 'Log in' ); ?>" />\
										</p>\
									</form>\
									<p id="nav">\
									<a ><?php _e( 'Log in' ); ?></a> | 	<a ><?php _e( 'Lost your password?' ); ?></a>\
									</p>\
									<p id="backtoblog"><a ><?php printf( _x( '&larr; Back to %s', 'site' ), get_bloginfo( 'title', 'display' ) )?></a></p>\
									</div>\
								<div class="clear"></div>\
								</div>';

			$(document).ready(function($) {   

				$('#wpwrap').on("change", ".cbState", function() {
						var data = {
							action: 'loin_ctrl_action_change_state',
							security: '<?php echo $ajax_nonce; ?>',
							idform: $(this).parents('tr').find('input[type="checkbox"]').val(),
							state: $(this).val()

						};

						$.post(ajaxurl, data, function(response) {

						
						});							
				});

				$('#wpwrap').on({
					
					mouseenter:  function() {


										$(this).after("<div id='preview' class='tool_tip_container' style='width: " + window.innerWidth + "px; height: " + window.innerHeight + "px; top: -" + window.innerHeight / 3.5 + "px; left: " + window.innerWidth / 3 + "px;'><div class='tooltipimage body' style='width: " + window.innerWidth + "px; height: " + window.innerHeight + "px;'>"+ ( ($(this).parents('tr').find('span.form-type').attr('data-id') == 'LoginDefault') ? tooltip_login : '' ) + "</div></div>"); //+ login_footer 
										//load css dinamically
										$('head .login_preview_style').remove();  

										$('head').append( $('<link rel="stylesheet" class="login_preview_style" type="text/css" />').attr("href",  "<?php echo LOIN_CTRL_PLUGIN_URL; ?>css/" + $(this).parents("tr").find("input[type=checkbox]").val().replace(/ /g,"_") + "_preview.css?v."+ Date.now()  ) 
										);  //  %20 replace spaces
										//end load css

										String.prototype.stripSlashes = function(){	// no se carga la que tenemos en shared , revisar
											return this.replace(/\\(.)/mg, "$1");
										}

										//login_footer = "";
										form_key = $(this).parents("tr").find("input[type=checkbox]").val();

										if ( form_key in js_array_new ) {

											current_array_new = js_array_new[form_key].New; // if is empty returns string not an object
											current_array_custom = js_array_new[form_key].Custom;

											//consultar si es objeto si no salir
											if ( typeof(current_array_new) == "object" ){
												// bucle login_footer
												$.each( current_array_new, function(index, value){
													temp_obj =  JSON.parse(value.stripSlashes());
													
													let nodes = $("#" + temp_obj.parent).contents();
            										let id_found = false;

													switch (temp_obj.type) {
														case "img":
															//login_footer += '<img id="' + temp_obj.id + '" src="' + temp_obj.src + '">';
																	if( temp_obj.parent == "designArea") {
																		$("#preview").append('<img id="' + temp_obj.id + '" object="' + temp_obj.type + '" src="' + temp_obj.src + '">');
																	}
																	else{
																		$.each(nodes, function(){ //index, value
                                    
																			if ( this.nodeType == 3){ // is text node
																					if ( this.textContent == "#" + temp_obj.id){
																						$(this).after('<img id="' + temp_obj.id + '" object="' + temp_obj.type + '" src="' + temp_obj.src + '">');
																						$(this).remove();
																						id_found = true;
																					}
																			}
																		});

																		if ( !id_found ){
																			$("#" + temp_obj.parent).append('<img id="' + temp_obj.id + '" object="' + temp_obj.type + '" src="' + temp_obj.src + '">');
																		}
																		   
																	}

																	break;

														case "i":
																	temp_custom =  JSON.parse(current_array_custom[index].stripSlashes());

																	if( temp_obj.parent == "designArea") {
																		$("#preview").append('<'+ temp_obj.type +' id="' + temp_obj.id + '" object="' + temp_obj.type + '" class="fa ' + temp_custom.font_awesome_fa_name + '" aria-hidden="true"></'+ temp_obj.type +'>');
																	}
																	else{
																		$.each(nodes, function(){ //index, value // cuidado ya utilizamos index exterior, si se necesita cambiar index por index_2 oparecido
                                    
																			if ( this.nodeType == 3){ // is text node
																					if ( this.textContent == "#" + temp_obj.id){
																						$(this).after('<'+ temp_obj.type +' id="' + temp_obj.id + '" object="' + temp_obj.type + '" class="fa ' + temp_custom.font_awesome_fa_name + '" aria-hidden="true"></'+ temp_obj.type +'>');
																						$(this).remove();
																						id_found = true;
																					}
																			}
																		});
																		if ( !id_found ){
																			$("#" + temp_obj.parent).append('<'+ temp_obj.type +' id="' + temp_obj.id + '" object="' + temp_obj.type + '" class="fa ' + temp_custom.font_awesome_fa_name + '" aria-hidden="true"></'+ temp_obj.type +'>');
																		}
																		    
																	}
														
																	break;	

														default:
															//login_footer += '<'+ temp_obj.type +' id="' + temp_obj.id + '" object="' + temp_obj.type + '"></'+ temp_obj.type +'>';
																	if( temp_obj.parent == "designArea") {
																		$("#preview").append('<'+ temp_obj.type +' id="' + temp_obj.id + '" object="' + temp_obj.type + '"></'+ temp_obj.type +'>');
																	}
																	else{
																		$.each(nodes, function(){ //index, value
                                    
																			if ( this.nodeType == 3){ // is text node
																					if ( this.textContent == "#" + temp_obj.id){
																						$(this).after('<'+ temp_obj.type +' id="' + temp_obj.id + '" object="' + temp_obj.type + '"></'+ temp_obj.type +'>');
																						$(this).remove();
																						id_found = true;
																					}
																			}
																		});
																		if ( !id_found ){
																			$("#" + temp_obj.parent).append('<'+ temp_obj.type +' id="' + temp_obj.id + '" object="' + temp_obj.type + '"></'+ temp_obj.type +'>');
																		}

																	}
																	
																	//add content

																	if (temp_obj.content != undefined ) { // solo si hay texto en el objeto y contiene el orden de sus hijos entre el texto

																		$.each(temp_obj.content, function( index, obj){
																			switch ( obj.type){
																				case "text":
																							$("#" + temp_obj.id).append(obj.content);
																							break;
																				case "br":
																							$("#" + temp_obj.id).append("<br>");
																							break;
																				case "id":
																							$("#" + temp_obj.id).append("#" + obj.content);
																							break;
																			}
																			
																		});

																	}
																	break;

													}
												});
											}
										}
										

								},

					mouseleave: function() {
										$('.tool_tip_container').remove();
								}

				},'.action-icon.login_preview');


				$('#wpwrap').on("click", ".action-icon:not('.dialog, .login_preview')", function() { //.front_end, .dialog == clone option in dialog.js

						var data = {
							action: 'loin_ctrl_del_front',
							security: '<?php echo $ajax_nonce; ?>',
							template: $(this).parents('tr').find('input[type=checkbox]').val(),
							doaction: $(this).attr('data-action'),
							type: $(this).parents('tr').find('span.form-type').attr('data-id')

						};

						// animated css icon
						if ( $(this).attr('data-action') == "front_end" )
							$("#wpwrap").prepend('<div class="ajax_box_waitting"><i class="fa fa-spinner fa-pulse fa-fw centered"></i><span class="centered">' + "Loading..." + '</span></div>');
						else if ( $(this).attr('data-action') == "delete" )
							$("table th:first").prepend('<div class="ajax_box_waitting"><i class="fa fa-spinner fa-pulse fa-fw centered"></i><span class="centered">' + "Removing..." + '</span></div>');

						
				
						$this = $(this);
						// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
						$.post(ajaxurl, data, function(response) { // if security fails response =  -1
						//	alert('Got this from the server: ' + response);

							if ( data.doaction == "front_end" ) 
								window.location = response;
							else if ( data.doaction == "delete" ) {
								list.refresh(parseInt(response));  // refresh table list AJAX
								//$(".ajax_box_waitting").remove();
							}


						});
						

						
				});       
				
			});

})(jQuery);
			</script>
			<?php

			return $message;
		}


	require_once( LOIN_CTRL_PLUGIN_DIR . 'classes/class.Forms_List_Table.php');

	$myListTable = new loin_ctrl_Forms_List_Table();

	$myListTable->prepare_items();
	//form dialog
	?>

	<div class="wrap">
	<div class="custom-icon-menu"><img style="display: none;" id="login-icon" src=<?php echo LOIN_CTRL_PLUGIN_URL . 'admin/images/w-logo-blue.png'; ?> ></div>
	<div id="icon-users" class="icon32"><br/></div>

	<h2><?php _e("Shortcodes and Login Forms",LOIN_CTRL_PLUGIN_DOMAIN) ?></h2><br/>

	<div id="create-form" class="loin-ctrl-main-button"><i class="fa fa-plus" aria-hidden="true" object="i"></i><span><?php _e("New Design",LOIN_CTRL_PLUGIN_DOMAIN) ?></span></div>
	<div id="import" class="loin-ctrl-main-button import"><i class="fa fa-download" aria-hidden="true" object="i"></i><span><?php _e("Import File",LOIN_CTRL_PLUGIN_DOMAIN) ?></span></div>
	
	<?php
	$download_nonce = wp_create_nonce( 'loin_ctrl_download_nonce' );

	do_action( 'loin_ctrl_export_button', $download_nonce);

?>

	<input style="visibility: hidden;" type="file" name="file-upload" id="file-upload" />

<?php


//require_once(ABSPATH . "wp-admin" . '/includes/image.php');
//require_once(ABSPATH . "wp-admin" . '/includes/file.php');
//require_once(ABSPATH . "wp-admin" . '/includes/media.php');

//$attachment_id = media_handle_upload('file-upload', $post->ID);
//$uploadedfile = $_FILES['file-upload'];
/////////////////////////////////////
	
?>

<div id="form-new-form" class="lightbox">
    <div id="form-content" class="form-centered">
		<div id="new-form-content" style="position: relative;">
			<i id="btn-new-form-close" style="position: absolute; right: 0;font-size: 20px; margin: 5px;" class="fa fa-times" aria-hidden="true"></i>
			<p id="formTitle"><?php _e("Create new form",LOIN_CTRL_PLUGIN_DOMAIN) ?></p>
			<p class="validateTips"><?php _e("Only form name is required.",LOIN_CTRL_PLUGIN_DOMAIN) ?></p>
			<form>
				<fieldset>
				<label for="name"><?php _e("Name",LOIN_CTRL_PLUGIN_DOMAIN) ?></label>
				<input type="text" name="name" id="name" placeholder="<?php _e("Form name",LOIN_CTRL_PLUGIN_DOMAIN) ?>" class="text ui-widget-content ui-corner-all" autofocus>
				<label ><?php _e("Type",LOIN_CTRL_PLUGIN_DOMAIN) ?></label>
				<select id="Type">
					<optgroup label="Login">
						<option value="LoginDefault" selected="selected">Default Page</option>
					<!--	<option value="CustomLogin">Custom Page</option> 
						<option value="LoginTemplates">Templates</option> -->
					</optgroup>
					<optgroup label="Shortcode Object">
						<option value="ObjectBlank">Blank Page</option>
			<!--			<optgroup label="&nbsp;&nbsp;&nbsp;&nbsp;Templates">
							<option value="Buttons">&nbsp;&nbsp;&nbsp;&nbsp;Buttons</option>
							<option value="Prices">&nbsp;&nbsp;&nbsp;&nbsp;Table Prices</option>
							<option value="Boxes">&nbsp;&nbsp;&nbsp;&nbsp;Boxes</option>
						</optgroup> -->
					</optgroup>
				</select>
				<input type="hidden" name="cloneName" id="cloneName">
				<!-- Allow form submission with keyboard without duplicating the dialog button -->
				<input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
				</fieldset>
			</form>
		</div>
		<div class="formPreview" style="background-color:lightgrey;">
			<i class="fa fa-camera"></i>
			<p><?php _e("Not avalaible",LOIN_CTRL_PLUGIN_DOMAIN) ?></p>
		</div>
		<div id="btn-new-form">
			<span class="fa-stack fa-lg">
				<i class="fa fa-circle-thin fa-stack-2x"></i>
				<i class="fa fa-check fa-stack-1x"></i>
			</span><?php _e("Create Form",LOIN_CTRL_PLUGIN_DOMAIN) ?> 
		</div>
		<div id="btn-clone-form">
			<span class="fa-stack fa-lg">
				<i class="fa fa-circle-thin fa-stack-2x"></i>
				<i class="fa fa-check fa-stack-1x"></i>
			</span><?php _e("Clone Form",LOIN_CTRL_PLUGIN_DOMAIN) ?> 
		</div>
		<div>
			<p class="infoPreview"><?php _e("Preview",LOIN_CTRL_PLUGIN_DOMAIN) ?></p>
		</div>
    </div>
</div>
	

	<!-- Forms are NOT created automatically, so you need to wrap the table in one to use features like bulk actions -->
	<form id="movies-filter" method="get">
		<!-- For plugins, we also need to ensure that the form posts back to our current page -->
		<input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
		<!-- Now we can render the completed list table -->
		<?php $myListTable->display(); ?>
	</form>

	</div>

	<?php


    } //FormsTable


?>