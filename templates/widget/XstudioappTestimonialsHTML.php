<?php 
$settings        = $this->get_settings_for_display();
$testimonials    = $settings['testimonials'];
$prevButtonIcon  = $settings['prev_icon']['value'];
$nextButtonIcon  = $settings['next_icon']['value'];



$data = [];

foreach($testimonials as $testimonial){


    $data[] = [
        "name"          => $testimonial['name'],
        "quote"         => $testimonial['text'],
         "src"          => $testimonial['image']['url'],
        "designation"   => $testimonial['designation'],
        "notation"      => $testimonial['notation']['size']  
     ];
}


$testimonials = json_encode($data);






?>
<html>
<head>
<style>
    .-xstudioapp-widget-container {
        height: 100%;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
   
        font-family: sans-serif;
    }
    .-xstudioapp-widget-container .-xstudioapp-widget-testimonial-container {
        width: 100%;
        max-width: 56rem;
        padding: 2rem;
    }
    .-xstudioapp-widget-container .-xstudioapp-widget-testimonial-grid {
        display: grid;
        gap: 5rem;
    }
    .-xstudioapp-widget-container .-xstudioapp-widget-image-container {
        position: relative;
        width: 100%;
        height: 24rem;
        perspective: 1000px;
    }
     .-xstudioapp-widget-container .-xstudioapp-widget-testimonial-image {
        position: absolute;
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 1.5rem;
        transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
        box-shadow: 0 10px 30px rgba(255, 255, 255, 0.2);
    }
    .-xstudioapp-widget-testimonial-content {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .-xstudioapp-widget-name {
        font-size: 1.5rem;
        font-weight: bold;
        color: white;
        margin-bottom: 0.25rem;
    }
    .-xstudioapp-widget-designation {
        font-size: 0.875rem;
        color: white;
        margin-bottom: 2rem;
    }
    .-xstudioapp-widget-quote {
        font-size: 1.125rem;
        color: white;
        line-height: 1.75;
    }
    .-xstudioapp-widget-arrow-buttons {
        display: flex;
        gap: 1rem;
        padding-top: 3rem;
    }
    .-xstudioapp-widget-arrow-button {
        width: 1.75rem;
        height: 1.75rem;
        border-radius: 10px;
        background-color:rgb(255, 255, 255);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background-color 0.3s;
        
    }
    .-xstudioapp-widget-arrow-button:hover {
        background:linear(20deg, );
    }
    .-xstudioapp-widget-arrow-button svg {
        width: 1.25rem;
        height: 1.25rem;
        fill: #f1f1f7;
        transition: transform 0.3s;
    }
    .-xstudioapp-widget-arrow-button:hover svg {
        fill: black;
    }
    .-xstudioapp-widget-prev-button:hover svg {
        transform: rotate(-12deg);
    }
    .-xstudioapp-widget-next-button:hover svg {
        transform: rotate(12deg);
    }
    @media (min-width: 768px) {
        .-xstudioapp-widget-testimonial-grid {
            grid-template-columns: 1fr 1fr;
        }
        .-xstudioapp-widget-arrow-buttons {
            padding-top: 0;
        }
    }
</style>
</head>
<input type="hidden"  id="xstudioapp_testemonial" data-info ="<?=htmlspecialchars($testimonials)?>">
<div class="-xstudioapp-widget-container">
    <div class="-xstudioapp-widget-testimonial-container">
        <div class="-xstudioapp-widget-testimonial-grid">
            <div class="-xstudioapp-widget-image-container" id="image-container"></div>
            <div class="-xstudioapp-widget-testimonial-content">
                <div>
                    <h3 class="-xstudioapp-widget-name" id="name"></h3>
                    <p class="-xstudioapp-widget-designation" id="designation"></p>
                    <p class="-xstudioapp-widget-quote" id="quote"></p>
                </div>
                <div class="-xstudioapp-widget-arrow-buttons">
                    <button class="-xstudioapp-widget-arrow-button -xstudioapp-widget-prev-button" id="prev-button">
                        <i class="<?=$prevButtonIcon?>"></i>
                    </button>
                    <button class="-xstudioapp-widget-arrow-button -xstudioapp-widget-next-button" id="next-button">
                      <i class="<?=$nextButtonIcon?>"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
</html>