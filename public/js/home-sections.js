document.addEventListener('DOMContentLoaded', function () {
    // News Slider Functionality
    let index = 0;
    const slides = document.getElementById('slides');
    if (slides) {
        const totalSlides = slides.children.length;
        setInterval(() => {
            index = (index + 1) % totalSlides;
            slides.style.transform = `translateX(-${index * 100}%)`;
        }, 4000);
    }

    // Authors Swiper Initialization
    const mySwiperTacgia = new Swiper(".mySwiperTacgia", {
        slidesPerView: 4,
        spaceBetween: 20,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            0: { slidesPerView: 2 },
            640: { slidesPerView: 3 },
            768: { slidesPerView: 4 },
            1024: { slidesPerView: 5 }
        }
    });

    // Add click event listeners for news items
    const newsItems = document.querySelectorAll('.news-item');
    newsItems.forEach(item => {
        item.addEventListener('click', function (e) {
            e.preventDefault();
            const href = this.getAttribute('href');
            if (href) {
                window.location.href = '/tin-nha-nam' + href;
            }
        });
    });

    // Add click event listeners for author items
    const authorItems = document.querySelectorAll('.swiper-slide');
    authorItems.forEach(item => {
        item.addEventListener('click', function () {
            const authorName = this.querySelector('.author-name').textContent;
            window.location.href = '/authors/' + encodeURIComponent(authorName);
        });
    });
}); 