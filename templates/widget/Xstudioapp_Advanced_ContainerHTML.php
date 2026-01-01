<?php
$settings = $this->get_settings_for_display();
$filter = [];

if (!empty($settings['xstudioapp_filter_blur']['size'])) {
    $filter[] = 'blur(' . $settings['xstudioapp_filter_blur']['size'] . 'px)';
}
if (!empty($settings['xstudioapp_filter_brightness']['size'])) {
    $filter[] = 'brightness(' . $settings['xstudioapp_filter_brightness']['size'] . ')';
}
if (!empty($settings['xstudioapp_filter_contrast']['size'])) {
    $filter[] = 'contrast(' . $settings['xstudioapp_filter_contrast']['size'] . ')';
}

$filter_style = !empty($filter) ? 'filter: ' . implode(' ', $filter) . ';' : '';
?>

<div class="xstudioapp-container" style="<?php echo $filter_style; ?>">
    <?= $settings['xstudioapp_content'] ?? '' ?>
</div>
