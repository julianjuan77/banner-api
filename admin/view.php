<div class="wrap">
    <h1>Configuración del Banner</h1>
    <p> Las URLs y los textos alternativos se deben especificar separados por un salto de línea (presionando enter).
    </p>
    <form method="post" action="options.php">

        <?php
settings_fields('banner_api_settings_group');
do_settings_sections('banner-api-settings');
?>

        <table class="form-table">
            <!-- Banner Desktop -->
            <tr>
                <th colspan="2">
                    <h3>Desktop</h3>
                </th>
            </tr>
            <tr valign="top">
                <th scope="row">URLs</th>
                <td>
                    <textarea name="banner_image_urls" rows="5" style="width: 100%;"><?php
echo esc_textarea(implode("\n", get_option('banner_image_urls', [])));
?></textarea>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">Textos alternativos</th>
                <td>
                    <textarea name="banner_alt_texts" rows="5" style="width: 100%;"><?php
echo esc_textarea(implode("\n", get_option('banner_alt_texts', [])));
?></textarea>
                </td>
            </tr>

            <!-- Banner Mobile -->
            <tr>
                <th colspan="2">
                    <h3>Mobile</h3>
                </th>
            </tr>
            <tr valign="top">
                <th scope="row">URLs</th>
                <td>
                    <textarea name="banner_image_urls_mobile" rows="5" style="width: 100%;"><?php
echo esc_textarea(implode("\n", get_option('banner_image_urls_mobile', [])));
?></textarea>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">Textos alternativos</th>
                <td>
                    <textarea name="banner_alt_texts_mobile" rows="5" style="width: 100%;"><?php
echo esc_textarea(implode("\n", get_option('banner_alt_texts_mobile', [])));
?></textarea>
                </td>
            </tr>
        </table>

        <?php submit_button();?>

    </form>
</div>