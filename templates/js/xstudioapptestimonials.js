jQuery(document).ready(function($){

   function runCode(){
    var data = document.querySelector('#xstudioapp_testemonial');
    data  = data.getAttribute('data-info');
    data = JSON.parse(data);
    const testimonials = data;
    let activeIndex = 0;
    const imageContainer = document.getElementById('image-container');
    const nameElement = document.getElementById('name');
    const designationElement = document.getElementById('designation');
    const quoteElement = document.getElementById('quote');
    const prevButton = document.getElementById('prev-button');
    const nextButton = document.getElementById('next-button');

    function updateTestimonial(direction) {
        const oldIndex = activeIndex;
        activeIndex = (activeIndex + direction + testimonials.length) % testimonials.length;

        testimonials.forEach((testimonial, index) => {
            let img = imageContainer.querySelector(`[data-index="${index}"]`);
            if (!img) {
                img = document.createElement('img');
                img.src = testimonial.src;
                img.alt = testimonial.name;
                img.classList.add('-xstudioapp-widget-testimonial-image');
                img.dataset.index = index;
                imageContainer.appendChild(img);
            }

            const offset = index - activeIndex;
            const absOffset = Math.abs(offset);
            const zIndex = testimonials.length - absOffset;
            const opacity = index === activeIndex ? 1 : 0.7;
            const scale = 1 - (absOffset * 0.15);
            const translateY = offset === -1 ? '-20%' : offset === 1 ? '20%' : '0%';
            const rotateY = offset === -1 ? '15deg' : offset === 1 ? '-15deg' : '0deg';

            img.style.zIndex = zIndex;
            img.style.opacity = opacity;
            img.style.transform = `translateY(${translateY}) scale(${scale}) rotateY(${rotateY})`;
        });

        nameElement.textContent = testimonials[activeIndex].name;
        designationElement.textContent = testimonials[activeIndex].designation;
        quoteElement.innerHTML = testimonials[activeIndex].quote.split(' ').map(word => `<span class="-xstudioapp-widget-word">${word}</span>`).join(' ');

        animateWords();
    }

    function animateWords() {
        const words = quoteElement.querySelectorAll('.-xstudioapp-widget-word');
        words.forEach((word, index) => {
            word.style.opacity = '0';
            word.style.transform = 'translateY(10px)';
            word.style.filter = 'blur(10px)';
            setTimeout(() => {
                word.style.transition = 'opacity 0.2s ease-in-out, transform 0.2s ease-in-out, filter 0.2s ease-in-out';
                word.style.opacity = '1';
                word.style.transform = 'translateY(0)';
                word.style.filter = 'blur(0)';
            }, index * 20);
        });
    }

    function handleNext() {

        updateTestimonial(1);
    }

    function handlePrev() {
        updateTestimonial(-1);
    }

    prevButton.addEventListener('click', handlePrev);
    nextButton.addEventListener('click', handleNext);

    // Initial setup
    updateTestimonial(0);

    // Autoplay functionality
    const autoplayInterval = setInterval(handleNext, 5000);

    // Stop autoplay on user interaction
    [prevButton, nextButton].forEach(button => {
        button.addEventListener('click', () => {
            clearInterval(autoplayInterval);
        });
    });

   }
                


    if (typeof elementorFrontend !== 'undefined' && elementorFrontend.hooks) {
        elementorFrontend.hooks.addAction('frontend/element_ready/xstudioapp_testimonials.default', function($scope){
           
           runCode();
        });
    }

});