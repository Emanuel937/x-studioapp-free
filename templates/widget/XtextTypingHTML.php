<?php

// Récupération des réglages

$settings         = $this->get_settings_for_display();
$text             = $settings['text_to_type'];
$tag              = $settings['html_tag'];
$isBackgroundClip = ($settings['background_clip']    == 'yes');
$isTyping         = ($settings['active_text_typing'] == 'yes');
$widgetId         = $this->get_id();
$idAttr           = "typing-{$widgetId}";

$speed           = false;
$deleteSpeed     = false;   
$delayAfter      = false;

// Préparer styles

if ($isBackgroundClip) {
    $color1         = $settings['background_clip_color_1'] ?: '#00f0ff';
    $color2         = $settings['background_clip_color_2'] ?: '#ff00c8';
    $color3         = $settings['background_clip_color_3'] ?: '#00f0ff';

    $styleColor     = "background: linear-gradient(90deg, {$color1}, {$color2}, {$color3});";
    $backgroundClip = "-webkit-background-clip: text; -webkit-text-fill-color: transparent;";

} else {
    $textColor       = $settings['text_color'] ?? "#d4ff04";
    $styleColor      = "color: {$textColor};";
    $backgroundClip  = "";
}

$styleAttr = esc_attr($styleColor . $backgroundClip) . " width: fit-content;";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel='styleSheet' href=<?=XFile::css($this);?>>
    </head>
    <body>

        <<?= esc_html($tag); ?>
            id="<?= esc_attr($idAttr); ?>"
            class="<?=$isTyping ? 'typing-container' : ''?>   typing-typo "
            style="<?= $styleAttr; ?>"
            data-text="<?= esc_attr($text); ?>"
            data-speed="<?= esc_attr($speed); ?>"
            data-delete-speed="<?= esc_attr($deleteSpeed); ?>"
            data-delay="<?= esc_attr($delayAfter); ?>"
        >
        <?php if (!$isTyping) echo esc_html($text); ?>
        </<?= esc_html($tag); ?>>
    </body>
</html>


