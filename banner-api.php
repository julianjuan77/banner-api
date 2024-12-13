<?php

/*
 * Plugin Name: Banner API
 * Description: Crea un endpoint que devuelve imagenes para utilizar en un banner. Las URL's de las imagenes se pueden
 * cambiar desde el menu de administración.
 * Version: 1.0.0
 * Requires at least: 5.2
 * Requires PHP: 7.2
 * Author: Julián Juan
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

if (!defined('ABSPATH')) {
    exit;
}

//Funcion auxiliar que carga la vista que permite configurar el plugin
function banner_api_settings_page()
{
    include plugin_dir_path(__FILE__) . 'admin/view.php';
}

// Añade el Menu superior "Banner API" al panel de administración
add_action('admin_menu', 'banner_api_config_page');
function banner_api_config_page()
{
    add_menu_page(
        'Configuración del banner',
        'Banner API',
        'manage_options',
        'banner-api-settings',
        'banner_api_settings_page',
        'dashicons-images-alt2',
        null
    );
}

/**
 * Registra las opciones de configuración en la base de datos
 */
add_action('admin_init', 'banner_api_register_settings');
function banner_api_register_settings()
{
    register_setting(
        'banner_api_settings_group',
        'banner_image_urls',
        array('sanitize_callback' => 'banner_api_sanitize_urls')
    );
    register_setting(
        'banner_api_settings_group',
        'banner_alt_texts',
        array('sanitize_callback' => 'banner_api_sanitize_texts')
    );
}

// Sanitiza y convierte las URL de las imagenes en un array
function banner_api_sanitize_urls($input)
{
    if (is_array($input)) {
        return array_map('esc_url_raw', $input);
    }

    return array_map('esc_url_raw', explode("\n", $input));
}

// Sanitiza los textos alternativos
function banner_api_sanitize_texts($input)
{
    if (is_array($input)) {
        return array_map('sanitize_text_field', $input);
    }

    return array_map('sanitize_text_field', explode("\n", $input));
}

//  Registra el endpoint en la API REST de wordpress
add_action('rest_api_init', 'banner_api_register_endpoints');
function banner_api_register_endpoints()
{
    register_rest_route('banner-api/v1', '/banners', array(
        'methods' => 'GET',
        'callback' => 'banner_api_get_banners',
    ));
}

// Logica para retornar las URL's
function banner_api_get_banners()
{
    $image_urls = get_option('banner_image_urls', []);
    $alt_texts = get_option('banner_alt_texts', []);

    $banners = [];
    $max = max(count($image_urls), count($alt_texts));
    for ($i = 0; $i < $max; $i++) {
        $banners[] = [
            'image_url' => isset($image_urls[$i]) ? $image_urls[$i] : '',
            'alt_text' => isset($alt_texts[$i]) ? $alt_texts[$i] : '',
        ];
    }

    return rest_ensure_response($banners);
}

//Notificacion cuando los cambios son guardados
add_action('admin_notices', 'banner_api_settings_saved_notice');
function banner_api_settings_saved_notice()
{
    if (isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true') {
        echo '<div class="notice notice-success is-dismissible">';
        echo '<p>¡Los ajustes han sido guardados correctamente!</p>';
        echo '</div>';
    }
}
