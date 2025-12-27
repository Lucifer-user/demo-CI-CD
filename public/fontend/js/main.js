

// DOM Ready Function
document.addEventListener('DOMContentLoaded', function () {
  // Initialize any interactive functionality here

  // Hero Slider
  const slides = document.querySelectorAll('.hero-slide');
  if (slides.length > 0) {
    let currentSlide = 0;
    const slideInterval = setInterval(() => {
      slides[currentSlide].classList.remove('active');
      currentSlide = (currentSlide + 1) % slides.length;
      slides[currentSlide].classList.add('active');
    }, 5000); // Change slide every 5 seconds
  }

  // Example: Add click handlers for product detail buttons
  const detailButtons = document.querySelectorAll('.product-detail-button');
  detailButtons.forEach(button => {
    button.addEventListener('click', function () {
      const productName = this.closest('.product-card').querySelector('.product-name').textContent;
      alert(`Xem chi tiết sản phẩm: ${productName}`);
    });
  });

  // Example: Form submission handler
  const promoForm = document.querySelector('.promo-form');
  if (promoForm) {
    promoForm.addEventListener('submit', function (e) {
      e.preventDefault();
      const email = this.querySelector('.promo-input').value;
      if (email) {
        alert(`Cảm ơn bạn đã đăng ký với email: ${email}`);
        this.reset();
      }
    });
  }

  // Example: Toggle dark mode (if you add a toggle button)
  const toggleDarkMode = () => {
    const html = document.documentElement;
    if (html.classList.contains('dark')) {
      html.classList.remove('dark');
      html.classList.add('light');
    } else {
      html.classList.remove('light');
      html.classList.add('dark');
    }
  };

  // Uncomment the following if you want to add a dark mode toggle button
  /*
  const darkModeToggle = document.createElement('button');
  darkModeToggle.textContent = '🌙';
  darkModeToggle.className = 'icon-button';
  darkModeToggle.addEventListener('click', toggleDarkMode);
  document.querySelector('.flex.gap-2').appendChild(darkModeToggle);
  */
  /* Carousel Functionality */
  const track = document.querySelector('.carousel-track');

  if (track) {
    const prevBtn = document.querySelector('.carousel-btn.prev');
    const nextBtn = document.querySelector('.carousel-btn.next');
    const items = document.querySelectorAll('.carousel-track .product-card-new');

    // We need to know how many items are visible to calculate limits
    // Simple approach: scroll by one item width + gap

    let currentIndex = 0;

    const updateCarousel = () => {
      const itemWidth = items[0].getBoundingClientRect().width;
      const gap = 16; // Match CSS gap
      const amountToMove = (itemWidth + gap) * currentIndex;
      track.style.transform = `translateX(-${amountToMove}px)`;

      // Optional: Disable buttons at ends
      // prevBtn.disabled = currentIndex === 0;
      // nextBtn.disabled = currentIndex >= items.length - visibleItems; 
    };

    nextBtn.addEventListener('click', () => {
      const containerWidth = document.querySelector('.carousel-track-container').offsetWidth;
      const itemWidth = items[0].getBoundingClientRect().width + 16;
      const visibleItems = Math.floor(containerWidth / itemWidth);
      const maxIndex = items.length - visibleItems;

      if (currentIndex < maxIndex) {
        currentIndex++;
        updateCarousel();
      } else {
        // Optional: Loop back to start
        currentIndex = 0;
        updateCarousel();
      }
    });

    prevBtn.addEventListener('click', () => {
      if (currentIndex > 0) {
        currentIndex--;
        updateCarousel();
      }
    });

    // Initial update
    // updateCarousel();

    // Handle resize to reset or adjust?
    window.addEventListener('resize', () => {
      updateCarousel();
    });
  }
});