// Header Section
var navbar = document.getElementById("nav-bar");
var navLinks = document.querySelectorAll("a");

function openmenu(){
    navbar.style.left="0";
}

function closemenu(){
    navbar.style.left = "100%";
}

navLinks.forEach(function(link) {
    link.addEventListener("click", function() {
        closemenu();
    });
});

// Testimonial section

$('.testimonial-slider').slick({
    infinite: true,
    autoplay: true,
    autoplaySpeed: 2000,
    slidesToShow: 3,
    slidesToScroll: 1,
    dots: true,
    responsive: [
    {
        breakpoint: 1023,
        settings: {
            slidesToShow: 2,
            slidesToScroll: 1
        }
        },
        {
        breakpoint: 767,
        settings: {
            slidesToShow: 1,
            slidesToScroll: 1
        }
        }
    ]
});


  