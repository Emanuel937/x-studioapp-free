 <?php $settings = $this->get_settings_for_display();

        $title = $settings['hex_title'] ?? '';
        $link = $settings['hex_link']['url'] ?? '#';
        $image_url = $settings['hex_image']['url'] ?? '';

        $width = $settings['hex_width']['size'] ?? 170;
        $width_unit = $settings['hex_width']['unit'] ?? 'px';

        $height = $settings['hex_height']['size'] ?? 196;
        $height_unit = $settings['hex_height']['unit'] ?? 'px';

        $padding_top = $settings['hex_padding']['top'] ?? 0;
        $padding_right = $settings['hex_padding']['right'] ?? 0;
        $padding_bottom = $settings['hex_padding']['bottom'] ?? 0;
        $padding_left = $settings['hex_padding']['left'] ?? 0;
        $padding_unit = $settings['hex_padding']['unit'] ?? 'px';

        $bg_color = $settings['hex_bg_color'] ?? 'rgba(255, 255, 255, 0.08)';

        $blur_px = intval($settings['hex_overlay_blur'] ?? 6);

        // Convert opacity slider 0-100 to 0-1 float
        $opacity_pct = $settings['hex_overlay_bg_opacity']['size'] ?? 10;
        $opacity = max(0, min(1, $opacity_pct / 100));

        $overlay_bg_rgba = "rgba(255, 255, 255, $opacity)";

        $style = sprintf(
            "width: %s%s; height: %s%s; padding: %s%s %s%s %s%s %s%s; display: inline-block; position: relative; clip-path: polygon(50%% 0%%, 93%% 25%%, 93%% 75%%, 50%% 100%%, 7%% 75%%, 7%% 25%%); border-radius: 16px; border: 1px solid rgba(255,255,255,0.2); overflow: hidden; transition: transform 0.3s ease; background-color: %s; background-position: center; background-size: cover; background-repeat: no-repeat;",
            esc_attr($width), esc_attr($width_unit),
            esc_attr($height), esc_attr($height_unit),
            esc_attr($padding_top), esc_attr($padding_unit),
            esc_attr($padding_right), esc_attr($padding_unit),
            esc_attr($padding_bottom), esc_attr($padding_unit),
            esc_attr($padding_left), esc_attr($padding_unit),
            $bg_color
        );

        if ($image_url) {
            $style .= " background-image: url('" . esc_url($image_url) . "');";
        }
        ?>


        <style>
        .hex-item:hover {
            transform: scale(1.05);
        }
        .hex-overlay {
            position: absolute;
            inset: 0;
            background: <?= $overlay_bg_rgba ?>;
            backdrop-filter: blur(<?= $blur_px ?>px);
            -webkit-backdrop-filter: blur(<?= $blur_px ?>px);
            border-radius: 16px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 1.1rem;
            text-align: center;
            transition: background 0.3s ease;
            pointer-events: none;
            clip-path: polygon(50% 0%, 93% 25%, 93% 75%, 50% 100%, 7% 75%, 7% 25%);
        }
        .hex-item:hover .hex-overlay {
            background: rgba(255, 255, 255, 0.15);
        }
        </style>

        <a href="<?= esc_url($link); ?>" class="hex-item" target="_blank" rel="nofollow noopener" aria-label="<?= esc_attr($title); ?>"
           style="<?= $style ?>">
           <div class="hex-overlay"><?= esc_html($title); ?></div>
        </a>