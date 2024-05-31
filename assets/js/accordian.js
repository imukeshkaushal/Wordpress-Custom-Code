// Wait for the DOM to be fully loaded
document.addEventListener("DOMContentLoaded", function() {
  // Your existing JavaScript code here

  // Get all accordion items
  const accordionItems = document.querySelectorAll('.accordion-item');

  // Add click event listeners to accordion headers
  accordionItems.forEach(item => {
    const header = item.querySelector('.accordion-header');
    const icon = item.querySelector('.icon');
    header.addEventListener('click', () => {
      // Toggle the active class on the clicked accordion item
      item.classList.toggle('active');

      // Toggle the display of the accordion content
      const content = item.querySelector('.accordion-content');
      if (content.style.display === 'block') {
        content.style.display = 'none';
      } else {
        content.style.display = 'block';
      }

      // Toggle the plus and minus icons
      icon.classList.toggle('active');
    });
  });
	


  document.addEventListener("DOMContentLoaded", function() {
    var sliderImages = document.querySelectorAll('.lazy-load-image img');

    if ('IntersectionObserver' in window) {
      var imgObserver = new IntersectionObserver(function(entries, observer) {
        entries.forEach(function(entry) {
          if (entry.isIntersecting) {
            var img = entry.target;
            img.src = img.dataset.src;
            img.removeAttribute('data-src');
            imgObserver.unobserve(img);
          }
        });
      });

      sliderImages.forEach(function(img) {
        imgObserver.observe(img);
      });
    } else {
      // Fallback for browsers that don't support IntersectionObserver
      sliderImages.forEach(function(img) {
        img.src = img.dataset.src;
        img.removeAttribute('data-src');
      });
    }
  });



  // Swiper JS for Slide Show
  const swiper = new Swiper('.swiper', {
    // Optional parameters
    direction: 'horizontal', // Change direction to horizontal
    loop: true,

    // If we need pagination
    pagination: {
        el: '.swiper-pagination',
    },

    // Navigation arrows
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
});

  // Rest of your code, including the playVideo function and event listeners
  

});


