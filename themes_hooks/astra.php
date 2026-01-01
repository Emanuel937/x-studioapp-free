<?php


namespace XstudioApp\ThemeHook;

use Elementor\Plugin;
use XstudioApp\Utils\Utils;

if (!defined('ABSPATH')) exit;

/**
 * Astra theme compatibility.
 */
class Astra {

	private $elementor;
	private $header;
	private $footer;
	private $single;
	private $archive_page;
	private $product_page;
	private $products_page;
	private $editor_mode;

	public function __construct($templates) {
		[$this->header, $this->footer, $this->single] = $templates;
		$this->editor_mode = Plugin::$instance->editor->is_edit_mode();


	

		if (defined('ELEMENTOR_VERSION') && is_callable(['Elementor\\Plugin', 'instance'])) {
			$this->elementor = Plugin::instance();
		}

		if ($this->header) {
			add_action('template_redirect', [$this, 'remove_theme_header']);
			add_action('astra_header', [$this, 'render_header']);
		}

		if ($this->footer) {
			add_action('template_redirect', [$this, 'remove_theme_footer']);
			add_action('astra_footer', [$this, 'render_footer']);
		}

		if($this->single){
			add_filter('template_include', [$this, 'remove_single']);
		}
	}
     
	// Remove Astra header
	public function remove_theme_header() {
		remove_action('astra_header', 'astra_header_markup');
	}

	// Add Elementor header
	public function render_header() {
		echo '<div class="ekit-template-content-markup ekit-template-content-header">';
		echo Utils::render_elementor_content($this->header);
		echo '</div>';
	}

	// Remove Astra footer
	public function remove_theme_footer() {
		remove_action('astra_footer', 'astra_footer_markup');
	}

	// Add Elementor footer
	public function render_footer() {
		do_action('elementskit/template/before_footer');
		echo '<div class="ekit-template-content-markup ekit-template-content-footer">';
		echo Utils::render_elementor_content($this->footer);
		echo '</div>';
		do_action('elementskit/template/after_footer');
	}

	
	public function remove_single($content) {

    if ( is_single() ) {

        wp_head();

        // === HEADER ===
        if ( ! isset($_GET['elementor-preview']) ) {
            echo '<div class="ekit-template-content ekit-header">';
            echo Utils::render_elementor_content($this->header);
            echo '</div>';
        }

        // === SINGLE CONTENT ===
        echo '<main class="ekit-template-content ekit-single">';
        echo Utils::render_elementor_content($this->single);
        echo '</main>';

        // === FOOTER ===
        if ( ! isset($_GET['elementor-preview']) ) {
            do_action('elementskit/template/before_footer');
            echo '<div class="ekit-template-content ekit-footer">';
            echo Utils::render_elementor_content($this->footer);
            echo '</div>';
        }

        wp_footer();


        return '';
    }

    return $content;
}


}
