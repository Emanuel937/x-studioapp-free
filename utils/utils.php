<?php

namespace XstudioApp\Utils;
use Elementor\Plugin;

class Utils {

    public static function render_elementor_content( $content_id ) {
		$elementor_instance = Plugin::instance();

        if ( ( 'internal' === get_option( 'elementor_css_print_method' ) ) || \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
                    $has_css = true;
                }

		return $elementor_instance->frontend->get_builder_content_for_display( $content_id, $has_css?? null );
	}
}