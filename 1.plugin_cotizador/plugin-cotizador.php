<?php
/**
 * Plugin Name:       Cotizador JOP Avisos
 * Plugin URI:       
 * Description:       Cotizador para mejorar la experiencia de cotizacion para la empresa JOP Avisos
 * Version:           1.0
 * Requires at least: 5.8**
 * Requires PHP:      7.4.1
 * Author:            Sergio Gamboa
 * Author URI:        https://segamboam.github.io/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       Cotizador.
*/

#shortcodes
define("JOP_PATH",plugin_dir_path(__FILE__));
require_once JOP_PATH."public/shortcode/form_cotizacion_placas.php";
require_once JOP_PATH."public/shortcode/from_datos_cliente.php";
require_once JOP_PATH."public/shortcode/form_request.php";

#API
require_once JOP_PATH."includes/API/api-cotizador.php";
require_once JOP_PATH."includes/API/api-cotizador_cliente.php";

