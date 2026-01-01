<?php

if (!defined('ABSPATH')) exit;
class Templates{


    public function renderTemplate($header, $footer, $template){
       			// remove the default single 
			
			$output = " ";
            $output .= '<div class="ekit-template-content-markup">';
            $output .= Utils::render_elementor_content($this->single);
            $output .= '</div>';
           

		   echo $output;
		
    }

}