<?php
// Prevent direct file access
if( ! defined( 'ABSPATH' ) ) die();

add_filter('upload_dir', 'loin_ctrl_change_dir');

function loin_ctrl_change_dir( $param ){

    $param['path'] = LOIN_CTRL_PLUGIN_DIR_TEMP;
    $param['url'] = LOIN_CTRL_PLUGIN_URL_TEMP;

    error_log("path={$param['path']}");  
    error_log("url={$param['url']}");
    error_log("subdir={$param['subdir']}");
    error_log("basedir={$param['basedir']}");
    error_log("baseurl={$param['baseurl']}");
    error_log("error={$param['error']}"); 

    return $param;
}

function loin_ctrl_enable_extended_upload ( $mime_types =array() ) {
    
      // The MIME types listed here will be allowed in the media library.
      // You can add as many MIME types as you want.
      //$mime_types['gz']  = 'application/x-gzip';
      $mime_types['zip']  = 'application/zip';
      //$mime_types['rtf'] = 'application/rtf';
      //$mime_types['ppt'] = 'application/mspowerpoint';
      //$mime_types['ps'] = 'application/postscript';
      //$mime_types['flv'] = 'video/x-flv';
    
      // If you want to forbid specific file types which are otherwise allowed,
      // specify them here.  You can add as many as possible.
      unset( $mime_types['exe'] );
      unset( $mime_types['bin'] );
    
      return $mime_types;
   }
    
add_filter('upload_mimes', 'loin_ctrl_enable_extended_upload');



if( ! empty( $_FILES ) ) {
    foreach( $_FILES as $file ) {
      if( is_array( $file ) ) {
        $attachment_id = loin_ctrl_upload_user_file( $file );
        //echo $attachment_id ;
      }
    }
  }


remove_filter('upload_mimes', 'loin_ctrl_enable_extended_upload');


function loin_ctrl_upload_user_file( $file = array() ) {

    require_once( ABSPATH . 'wp-admin/includes/admin.php' );
    
    //sanitize_file_name()

        function loin_ctrl_my_cust_filename($dir, $name, $ext){
            return "user_file.zip";//$name.'.'.$ext;
        }
      $file_return = wp_handle_upload( $file, array('test_form' => false, 'mimes' => array('zip' => 'application/zip'), 'unique_filename_callback' => 'loin_ctrl_my_cust_filename' ) );

      remove_filter('upload_dir', 'loin_ctrl_change_dir');

      if( isset( $file_return['error'] ) || isset( $file_return['upload_error_handler'] ) ) {
          echo '{"notice":"notice-error", "message":"' . $file_return['error'] . '"}' ;
          
          return false;
      }
       else {
          //descomprimir zip e insertar en BD
          $wordpress_upload_dir = wp_upload_dir();
          $new_file_path = $wordpress_upload_dir['path'];
          //$i = 21;
          $zip = new ZipArchive;

          if ($zip->open(LOIN_CTRL_PLUGIN_DIR_TEMP . "/user_file.zip") === TRUE) { //. $file["name"]
              $zip->extractTo(LOIN_CTRL_PLUGIN_DIR_TEMP . "/");
              $zip->close();
              //wp_upload_dir();
              // aqui un bucle para mover los fixeros
              // use rename for every file
              unlink(LOIN_CTRL_PLUGIN_DIR_TEMP . "/" . "user_file.zip");

              // move css files
              $path    = LOIN_CTRL_PLUGIN_DIR_TEMP . '/css';
              $files = scandir($path);
              $files = array_diff(scandir($path), array('.', '..'));

              foreach ( $files as $filetomove){

                rename(LOIN_CTRL_PLUGIN_DIR_TEMP . "/" . "css/" . $filetomove, LOIN_CTRL_PLUGIN_DIR . "/" . "css/" . $filetomove);

                $file_url_change = file_get_contents(LOIN_CTRL_PLUGIN_DIR . "/" . "css/" . $filetomove);
                $pos = 0;
                $cont = 0;
                while ( ($pos = strpos($file_url_change, "url(", $pos)) !== false) {

                    $end_pos = strpos($file_url_change, ");", $pos);

                    $image_url = substr($file_url_change, $pos, $end_pos - $pos);
                    $image_name = substr($image_url, strrpos($image_url, "/")+1);

                    $file_url_change = substr($file_url_change, 0, $pos) . "url(" . $wordpress_upload_dir['url'] . "/" .$image_name . substr($file_url_change, $end_pos);


                    $cont += 1;
                    $pos += 1;
                }


                if( $cont > 0 ) file_put_contents(LOIN_CTRL_PLUGIN_DIR . "/" . "css/" . $filetomove, $file_url_change );



              }
              rmdir(LOIN_CTRL_PLUGIN_DIR_TEMP . "/" . "css/"); //delete css folder , empty


// replace url in .css and preview.css

//$wordpress_upload_dir['url']

              //move images
              $path    = LOIN_CTRL_PLUGIN_DIR_TEMP . '/images';
              $files = scandir($path);
              $files = array_diff(scandir($path), array('.', '..'));


              foreach ( $files as $filetomove){
                rename(LOIN_CTRL_PLUGIN_DIR_TEMP . "/" . "images/" . $filetomove, $new_file_path . "/" . $filetomove);
                $attachment = array(
                    'guid' => $wordpress_upload_dir['url'] . "/" . $filetomove, //$file_return['url']
                    'post_mime_type' => wp_check_filetype( $filetomove, null )['type'], //mime_content_type($new_file_path . "/" . $filetomove), //$file_return['type'],
                    'post_title' => preg_replace( '/\.[^.]+$/', '', $filetomove ), // basename( $filename )
                    'post_content' => '',
                    'post_status' => 'inherit'
                    
                );
      
                $attach_id = wp_insert_attachment( $attachment, $new_file_path . "/" . $filetomove ); //$file_return['url']
      
                require_once(ABSPATH . 'wp-admin/includes/image.php');
                $attach_data  = wp_generate_attachment_metadata( $attach_id, $new_file_path . "/" . $filetomove ); //$filename
                wp_update_attachment_metadata( $attach_id, $attach_data );  
            
           
            
            }
              rmdir(LOIN_CTRL_PLUGIN_DIR_TEMP . "/" . "images/"); //delete images folder , empty

              //end images

            // start recover BD and relink images

            $str = file_get_contents(LOIN_CTRL_PLUGIN_DIR_TEMP . "/" . "designs.json");

            $data_import = json_decode($str);  // object, all designs


            foreach ($data_import as &$design) {
         
                foreach (array("Css","CssHover","New","WithoutCss") as $column) {
         
                    $array_designs = unserialize ($design->{$column});

                    foreach ($array_designs as &$one_design){
    
                        $one_design_obj = json_decode(stripslashes($one_design));

                        foreach($one_design_obj as $key=>&$value){

                            if ( $key != "content") { // is a only text object, no search for this
                                if(strpos($value,"/uploads") !== false ){  

                                    $value =  ( strpos($value,'url(') !== false ? 'url(' : '' ) . $wordpress_upload_dir['url'] . substr($value, strrpos($value,"/"));

                                }
                            }
                        }

                        $one_design = addslashes(json_encode($one_design_obj, JSON_UNESCAPED_SLASHES)); // new 

  
                    }

                    $design->{$column} = serialize ($array_designs); //new

                }

                foreach (array("Options") as $column) {
                    $array_options = unserialize ($design->{$column});
                    $obj_array = json_decode(stripslashes($array_options[4]));
                    foreach ($obj_array as &$individual_obj){
                        if($individual_obj->attr_type == "src"){
                            if(strpos($individual_obj->default,"/uploads") !== false ){
                                $individual_obj->default =  ( strpos($individual_obj->default,'url(') !== false ? 'url(' : '' ) . $wordpress_upload_dir['url'] . substr($individual_obj->default, strrpos($individual_obj->default,"/"));
                            }
                        }
    
                    }
                    $array_options[4] = addslashes(json_encode($obj_array)); //new
                    $design->{$column} = serialize ($array_options); //new
                }
            }


            unlink(LOIN_CTRL_PLUGIN_DIR_TEMP . "/" . "designs.json");

            //poner el bucle update/insert para todo los diseños
            global $wpdb;
            $wpdb->fs_forms = "{$wpdb->prefix}fs_forms";
            


            foreach($data_import as $design_to_insert){
                $wpdb->replace( $wpdb->fs_forms, array( 'id_Form'=>$design_to_insert->id_Form, 'Type'=>$design_to_insert->Type ,'State'=>$design_to_insert->State, 'Options'=>$design_to_insert->Options, 'Custom'=>$design_to_insert->Custom, 'Html'=>$design_to_insert->Html, 'New'=>$design_to_insert->New, 'WithoutCss'=>$design_to_insert->WithoutCss, 'Css'=>$design_to_insert->Css, 'CssHover'=>$design_to_insert->CssHover) );
            }
            


            //end update/insert

              echo '{"notice":"notice-success", "message":"' . __("All templates loaded, wait while the list is updated.",LOIN_CTRL_PLUGIN_DOMAIN) . '"}' ; //$file["name"]
          } else {
            echo '{"notice":"notice-error", "message":"' . __("Error loading the templates.",LOIN_CTRL_PLUGIN_DOMAIN) . '"}' ;
          }
   
            //       echo '{"notice":"notice-success", "message":"' . 'Perfect' . '"}' ; //$file_return['file']
            //echo '{"notice":"notice-success", "message":"' . $file_return["type"] . '"}' ; //$file_return['file']
            return false;
       }
            /*    $attachment = array(
              'post_mime_type' => $file_return['type'],
              'post_title' => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
              'post_content' => '',
              'post_status' => 'inherit',
              'guid' => $file_return['url']
          );

          $attachment_id = wp_insert_attachment( $attachment, $file_return['url'] );

          require_once(ABSPATH . 'wp-admin/includes/image.php');
          $attachment_data = wp_generate_attachment_metadata( $attachment_id, $filename );
          wp_update_attachment_metadata( $attachment_id, $attachment_data );

          if( 0 < intval( $attachment_id ) ) {
          	return $attachment_id;
          }
      }
        */
      //return false;
}

?>