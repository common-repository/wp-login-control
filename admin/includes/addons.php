<?php
/** 
* Recorre la carpeta addons, carga los plugins existentes y muestra la informacion de todos los plugins en el submenu Add-ons
* estructura add-ons
* load-addon.php  -> si no existe no esta comprado o no esta disponible
* template.php -> composicion  lista <li> con informacion plantilla
*/

// Prevent direct file access
if( ! defined( 'ABSPATH' ) ) die();

$directorio = LOIN_CTRL_PLUGIN_DIR . "addons"; //dirname(__FILE__)

$gestor_dir = opendir($directorio);
while (false !== ($nombre_fichero = readdir($gestor_dir))) {
    if ( $nombre_fichero != "." && $nombre_fichero != "..") {
        require_once(LOIN_CTRL_PLUGIN_DIR . "addons/{$nombre_fichero}/load-addon.php"); //dirname(__FILE__)
        require_once(LOIN_CTRL_PLUGIN_DIR . "addons/{$nombre_fichero}/template.php"); //dirname(__FILE__)
    }
}
?>