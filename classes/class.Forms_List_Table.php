<?php

if( !defined( 'ABSPATH') ) exit();

if( ! class_exists( 'WP_List_Table' ) ) 
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );


class loin_ctrl_Forms_List_Table extends WP_List_Table {


		/**
		 * REQUIRED. Set up a constructor that references the parent constructor. We 
		 * use the parent reference to set some default configs.
		 */

			function __construct() {

				global $status, $page;

				//Set parent defaults
				parent::__construct(
					array(
						//singular name of the listed records
						'singular'	=> 'form',
						//plural name of the listed records
						'plural'	=> 'forms',
						//does this table support ajax?
						'ajax'		=> true
					)
				);
				
				add_action('admin_footer', array(&$this, 'ajax_script'));
			}

			/**
			 * 
			 * 
			 */

			function column_default( $item, $column_name ) {
				switch( $column_name ){
					case 'id_Form':
						return $item[ $column_name ];
						break;

					case 'Type':
						$TypeArray = [
										"LoginDefault" 	=> __('Default Login',LOIN_CTRL_PLUGIN_DOMAIN),
									  	"ObjectBlank"	=> __('Shortcode',LOIN_CTRL_PLUGIN_DOMAIN) //Object
						];
						if ( array_key_exists($item[ $column_name ], $TypeArray) ) {
							return $TypeArray[$item[ $column_name ]] . '<span class="form-type" hidden data-id="' . $item[ $column_name ] . '"></span>';
						} else {
							//default for previous versions
							return $TypeArray["LoginDefault"] . '<span class="form-type" hidden data-id="' . "LoginDefault" . '"></span>';
						}
						break;
					case 'State':
						
						$html = "<select name='cbState' class='cbState'>"; 

						foreach ( array('Enabled', 'Disabled', 'Cron') as $value ) {


							$selected = ( $item[ $column_name ] == $value) ? " selected" : "";
							switch( $value ){

								case 'Enabled':
										$text = __('Active',LOIN_CTRL_PLUGIN_DOMAIN);
										break;
								case 'Disabled':
										$text = __('Inactive',LOIN_CTRL_PLUGIN_DOMAIN);
										break;
								case 'Cron':
										$text = __('Cron',LOIN_CTRL_PLUGIN_DOMAIN);
										break;
							}
							$html .= "<option value='" . $value . "'" . $selected . ">". $text . "</option>"; 

						}

						$html .= "</select>";
						return $html;
						break;					
					case 'shortcode':
						// sustituir spaces por underscore
						if ( $item['Type'] == "ObjectBlank") return "[Loin_ctrl_Forms id='" . $item[ $column_name ] . "']";
						break;
					case 'frontend':
						
						//return sprintf('<img data-action="front_end" class="action-icon front_end" src="%s" /><img data-action="delete" class="action-icon" src="%s" /><img data-action="clone" class="action-icon dialog" src="%s" /> <img data-action="preview" class="action-icon login_preview" src="%s" />', LOIN_CTRL_PLUGIN_URL . "admin/images/airbrush.png", LOIN_CTRL_PLUGIN_URL . "admin/images/trash.png", LOIN_CTRL_PLUGIN_URL . "admin/images/ewe.png", LOIN_CTRL_PLUGIN_URL . "admin/images/examine.png" );
 						return '<div data-action="front_end" class="action-icon front_end fa fa-paint-brush"></div><div data-action="delete" class="action-icon fa fa-trash"></div><div data-action="clone" class="action-icon dialog fa fa-clone"></div> <div data-action="preview" class="action-icon login_preview fa fa-eye"></div>';
						break;

					default:
						return print_r( $item, true ); // Show the whole array for troubleshooting purposes
				}
			}

			function column_cb($item){
				return sprintf(
					'<input type="checkbox" name="%1$s[]" value="%2$s" />',
					/*$1%s*/ $this->_args['singular'],  	//Let's simply repurpose the table's singular label ("movie")
					/*$2%s*/ $item['id_Form']			//The value of the checkbox should be the record's id
				);
			}

			function column_id_Form($item){
				$actions = array(
					'edit'		=> sprintf( '<a href="?page=%s&action=%s&id_Form=%s">%s</a>', $_REQUEST['page'],"edit",$item['id_Form'],__('Edit',LOIN_CTRL_PLUGIN_DOMAIN) ),
					'delete'	=> sprintf( '<a href="?page=%s&action=%s&id_Form=%s">%s</a>', $_REQUEST['page'],"delete",$item['id_Form'],__('Delete',LOIN_CTRL_PLUGIN_DOMAIN)  ),
				);				

				//Return the title contents
				return sprintf('%1$s <span style="color:silver"></span>%2$s',
					/*$1%s*/ $item['id_Form'],
					/*$3%s*/ $this->row_actions( $actions )
				);
			}

			/**
				* REQUIRED! This method dictates the table's columns and titles. This should
				* return an array where the key is the column slug (and class) and the value 
				* is the column's title text. If you need a checkbox for bulk actions, refer
				* to the $columns array below.
				*/

			function get_columns(){

				return $columns = array(
					'cb'		=>	'<input type="checkbox" />',
					'id_Form'	=>	__('Name',LOIN_CTRL_PLUGIN_DOMAIN),
					'Type'		=>	__('Type',LOIN_CTRL_PLUGIN_DOMAIN),
					'State'		=>	__('State',LOIN_CTRL_PLUGIN_DOMAIN),
					'frontend'	=>	'',
					'shortcode'	=>	'Shortcode'
					

				);

			}

			/**
				* @return array An associative array containing all the columns that should be sortable: 'slugs'=>array('data_values',bool)
				*/

			function get_sortable_columns() {

				return $sortable_columns = array(
					'Type' => array('Type',false),
					'State' => array('State',false), 
					'id_Form' => array('id_Form',false)
				);
			}			


			function get_bulk_actions() {

				return $actions = array(
					'activate'	=>	__('Activate',LOIN_CTRL_PLUGIN_DOMAIN),
					'deactivate'	=>	__('Deactivate',LOIN_CTRL_PLUGIN_DOMAIN),
					'delete'	=>	__('Delete',LOIN_CTRL_PLUGIN_DOMAIN),
					'export'	=>	__('Export',LOIN_CTRL_PLUGIN_DOMAIN)
				);
			}


			function process_bulk_action() {
				
				//Done with AJAX
				//Detect when a bulk action is being triggered...

				//if( 'delete'=== $this->current_action() ) {

				//}
				
			}

			function prepare_items(){


				global $wpdb;

				$per_page = 6;

				$wpdb->fs_forms = "{$wpdb->prefix}fs_forms";

				$data = $wpdb->get_results( "SELECT id_Form, Type, State, id_Form as shortcode, id_Form as frontend FROM $wpdb->fs_forms", ARRAY_A );

				$columns = $this->get_columns();
				$hidden = array();
				$sortable = $this->get_sortable_columns();

				$this->_column_headers = array($columns, $hidden, $sortable);

				$this->process_bulk_action();

				function usort_reorder( $a, $b ) {
					// if no sort, default to name
					$orderby = ( ! empty( $_GET['orderby']) ) ? $_GET['orderby'] : 'id_Form';
					// if no order, default to asc
					$order = ( ! empty( $_GET['order']) ) ? $_GET['order'] : 'asc';
					// Determine sort order 
					$result = strcmp( $a[$orderby], $b[$orderby] );
					// Send final sort direction to usort
					return ( $order === 'asc' ) ? $result : -$result;
				
				}

				usort( $data, 'usort_reorder' );  //$row
				
				$current_page = $this->get_pagenum();
				$total_items = count($data);
				/**
				* The WP_List_Table class does not handle pagination for us, so we need
				* to ensure that the data is trimmed to only the current page. We can use
				* array_slice() to 
				*/
				$data = array_slice($data,(($current_page-1)*$per_page),$per_page);

				$this->items = $data; 

				/**
				* REQUIRED. We also have to register our pagination options & calculations.
				*/
				$this->set_pagination_args(
					array(
				//WE have to calculate the total number of items
				'total_items'	=> $total_items,
				//WE have to determine how many items to show on a page
				'per_page'	=> $per_page,
				//WE have to calculate the total number of pages
				'total_pages'	=> ceil( $total_items / $per_page ),
				// Set ordering values if needed (useful for AJAX)
				'orderby'	=> ! empty( $_REQUEST['orderby'] ) && '' != $_REQUEST['orderby'] ? $_REQUEST['orderby'] : 'id_Form',
				'order'		=> ! empty( $_REQUEST['order'] ) && '' != $_REQUEST['order'] ? $_REQUEST['order'] : 'asc'
					)
				);

			}

			function display() {

				wp_nonce_field( 'loin_ctrl_ajax-custom-list-nonce-display', '_ajax_custom_list_nonce_2' );

				echo '<input type="hidden" id="order" name="order" value="' . $this->_pagination_args['order'] . '" />';
				echo '<input type="hidden" id="orderby" name="orderby" value="' . $this->_pagination_args['orderby'] . '" />';

				parent::display();
			}

			/**
			* Handle an incoming ajax request (called from admin-ajax.php)
			*
			* @since 3.1.0
			* @access public
			*/
			function ajax_response() {


				check_ajax_referer( 'loin_ctrl_ajax-custom-list-nonce-display', 'security' );

				if ( isset($_POST['bulk_action']) ){

					$forms_id = unserialize(sanitize_text_field(serialize(($_POST['forms_id']))));

					global $wpdb;

					$wpdb->fs_forms = "{$wpdb->prefix}fs_forms";
					$wpdb->fs_cron = "{$wpdb->prefix}fs_cron";


					switch ( sanitize_text_field($_POST['bulk_action']) ) {

						case 'delete':
								
								for( $i=0; $i < count($forms_id); $i++ ) {
									
									$per_page = 6;
									$last_line_page = 0;
									$id_form = $forms_id[$i];

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
										
									}
								}

								break;

						case 'activate':
								for( $i=0; $i < count($forms_id); $i++ ) {
									$wpdb->update( $wpdb->fs_forms, array( 'State' => 'Enabled' ), array('id_Form' => $forms_id[$i]) );
								}
								break;

						case 'deactivate':
								for( $i=0; $i < count($forms_id); $i++ ) {
									$wpdb->update( $wpdb->fs_forms, array( 'State' => 'Disabled' ), array('id_Form' => $forms_id[$i]) );
								}
								break;

						case 'export':

								break;
						case "-1":
								return; // no refresh
									//no option selected
								
					}
				
				}



				$this->prepare_items();

				extract( $this->_args );
				extract( $this->_pagination_args, EXTR_SKIP );

				ob_start();
				if ( ! empty( $_REQUEST['no_placeholder'] ) )
					$this->display_rows();
				else
					$this->display_rows_or_placeholder();
				$rows = ob_get_clean();

				ob_start();
				$this->print_column_headers();
				$headers = ob_get_clean();

				ob_start();
				$this->pagination('top');
				$pagination_top = ob_get_clean();

				ob_start();
				$this->pagination('bottom');
				$pagination_bottom = ob_get_clean();

				$response = array( 'rows' => $rows );
				$response['pagination']['top'] = $pagination_top;
				$response['pagination']['bottom'] = $pagination_bottom;
				$response['column_headers'] = $headers;

				if ( isset( $total_items ) )
					$response['total_items_i18n'] = sprintf( _n( '1 item', '%s items', $total_items ), number_format_i18n( $total_items ) );

				if ( isset( $total_pages ) ) {
					$response['total_pages'] = $total_pages;
					$response['total_pages_i18n'] = number_format_i18n( $total_pages );
				}

				die( json_encode( $response ) );
			}


			/**
			* This function adds the jQuery script to the plugin's page footer
			*/
			public function ajax_script() {

				$screen = get_current_screen();

				if ( 'toplevel_page_loin_ctrl_forms' != $screen->id )
					return false;
			?>
			<script type="text/javascript">
			
			(function($) {

			list = {

				/**
				* Register our triggers
				* 
				* We want to capture clicks on specific links, but also value change in
				* the pagination input field. The links contain all the information we
				* need concerning the wanted page number or ordering, so we'll just
				* parse the URL to extract these variables.
				* 
				* The page number input is trickier: it has no URL so we have to find a
				* way around. We'll use the hidden inputs added in TT_Example_List_Table::display()
				* to recover the ordering variables, and the default paged input added
				* automatically by WordPress.
				*/
				init: function() {

					// This will have its utility when dealing with the page number input
					var timer;
					var delay = 500;


					$('#doaction, #doaction2').on('click', function(ev){
						ev.preventDefault();

						let forms_checked = [];

						$("input:checkbox[name='form[]']:checked").each(function(){
							forms_checked.push($(this).attr("value"));
						});

						var data = {
							bulk_action: (ev.target.id == 'doaction') ? $("#bulk-action-selector-top").val() : $("#bulk-action-selector-bottom").val(),
							forms_id: forms_checked // array
						};
						switch ( data.bulk_action ){
							case 'delete':
									$("table th:first").prepend('<div class="ajax_box_waitting"><i class="fa fa-spinner fa-pulse fa-fw centered"></i><span class="centered">' + "Removing..." + '</span></div>');
									break;
							case 'export':
									$("table th:first").prepend('<div class="ajax_box_waitting"><i class="fa fa-spinner fa-pulse fa-fw centered"></i><span class="centered">' + "Exporting..." + '</span></div>');
									if($("#export").length)
									{
										window.location = $("#export").attr("data-href") + "&checked=" + forms_checked.join();
									}
									setTimeout(function() {
										$(".ajax_box_waitting").remove();
									}, 1500 );
									return;
									break;
							case 'activate':
									$("table th:first").prepend('<div class="ajax_box_waitting"><i class="fa fa-spinner fa-pulse fa-fw centered"></i><span class="centered">' + "Activating..." + '</span></div>');
									break;
							case 'deactivate':
									$("table th:first").prepend('<div class="ajax_box_waitting"><i class="fa fa-spinner fa-pulse fa-fw centered"></i><span class="centered">' + "Deactivating..." + '</span></div>');
									break;			
						}
						
						list.update( data );
					});

					// Pagination links, sortable link
					$('.tablenav-pages a, .manage-column.sortable a, .manage-column.sorted a').on('click', function(e) {
						// We don't want to actually follow these links
						e.preventDefault();
						// Simple way: use the URL to extract our needed variables
						var query = this.search.substring( 1 );

						var data = {
							paged: list.__query( query, 'paged' ) || '1',
							order: list.__query( query, 'order' ) || 'asc',
							orderby: list.__query( query, 'orderby' ) || 'id_Form'
						};
						list.update( data );
					});

					list.refresh = function(page, order, orderby) {
						// Refres table for delete and add new

						var data = {
							paged:  page || '1',
							order:  order || 'asc',
							orderby: orderby ||'id_Form'
						};
						list.update( data );
					};

					// Page number input
					$('input[name=paged]').on('keyup', function(e) {

						// If user hit enter, we don't want to submit the form
						// We don't preventDefault() for all keys because it would
						// also prevent to get the page number!
						if ( 13 == e.which )
							e.preventDefault();

						// This time we fetch the variables in inputs
						var data = {
							paged: parseInt( $('input[name=paged]').val() ) || '1',
							order: $('input[name=order]').val() || 'asc',
							orderby: $('input[name=orderby]').val() || 'id_Form'
						};

						// Now the timer comes to use: we wait half a second after
						// the user stopped typing to actually send the call. If
						// we don't, the keyup event will trigger instantly and
						// thus may cause duplicate calls before sending the intended
						// value
						window.clearTimeout( timer );
						timer = window.setTimeout(function() {
							list.update( data );
						}, delay);
					});
				},

				/** AJAX call
				* 
				* Send the call and replace table parts with updated version!
				* 
				* @param    object    data The data to pass through AJAX
				*/
				update: function( data ) {

					$.ajax({
						// /wp-admin/admin-ajax.php
						type: "POST",
						url: ajaxurl,
						// Add action and nonce to our collected data
						data: $.extend(
							{
								security: $('#_ajax_custom_list_nonce_2').val(),
								action: 'loin_ctrl_ajax_fetch_custom_list_table',
							},
							data
						),
						// Handle the successful result
						success: function( response ) {

							// WP_List_Table::ajax_response() returns json
							var response = $.parseJSON( response );

							// Add the requested rows
							if ( response.rows.length )
								$('#the-list').html( response.rows );
							// Update column headers for sorting
							if ( response.column_headers.length )
								$('thead tr, tfoot tr').html( response.column_headers );
							// Update pagination for navigation
							if ( response.pagination.bottom.length )
								$('.tablenav.top .tablenav-pages').html( $(response.pagination.top).html() );
							if ( response.pagination.top.length )
								$('.tablenav.bottom .tablenav-pages').html( $(response.pagination.bottom).html() );

							// Init back our event handlers
							list.init();

							$('table').trigger('table_updated'); // trigger for jquery snippets
						}
					});
				},

				/**
				* Filter the URL Query to extract variables
				* 
				* @see http://css-tricks.com/snippets/javascript/get-url-variables/
				* 
				* @param    string    query The URL query part containing the variables
				* @param    string    variable Name of the variable we want to get
				* 
				* @return   string|boolean The variable value if available, false else.
				*/
				__query: function( query, variable ) {

					var vars = query.split("&");
					for ( var i = 0; i <vars.length; i++ ) {
						var pair = vars[ i ].split("=");
						if ( pair[0] == variable )
							return pair[1];
					}
					return false;
				},
			}

			// Show time!
			list.init();

			})(jQuery);
			</script>
			<?php
			}

} // Class loin_ctrl_Forms_List_Table

?>