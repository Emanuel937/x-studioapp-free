<?php


$settings = $this->get_settings_for_display();


// URL image (sécurisé)
$image_url = esc_url($settings['xstudioapp_image_fill']['url']);
$background_position = esc_attr($settings['xstudioapp_background_position']);
$text = esc_html($settings['xstudioapp_text']);
?>
<div class="image-text-fill"
        style="
        background-image: url('<?php echo $image_url; ?>');
        background-repeat: no-repeat;
        background-position: <?php echo $background_position; ?>;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        color: transparent;
        font-weight: 700;
        ">
    <?= $text?>
</div>