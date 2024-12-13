<div class="wrap">
    <h1>Configuración del Banner</h1>
    <form method="post" action="options.php">
        <?php
settings_fields('banner_api_settings_group');
do_settings_sections('banner-api-settings');
?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">URLs de las imágenes del banner (una por línea)</th>
                <td>
                    <textarea name="banner_image_urls" rows="5" style="width: 100%;"><?php
echo esc_textarea(implode("\n", get_option('banner_image_urls', [])));
?></textarea>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">Texto alternativo de las imágenes</th>
                <td>
                    <textarea name="banner_alt_texts" rows="5" style="width: 100%;"><?php
echo esc_textarea(implode("\n", get_option('banner_alt_texts', [])));
?></textarea>
                </td>
            </tr>
        </table>
        <?php submit_button();?>
    </form>
</div>