document.addEventListener("DOMContentLoaded", function () {
  new Swiper(".testimonials-swiper", {
    slidesPerView: 1,
    spaceBetween: 30,
    loop: true,
    autoplay: {
      delay: 5000,
      disableOnInteraction: false,
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    breakpoints: {
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      },
    },
  });
});

// Smooth Scroll for Navigation Links
document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
  anchor.addEventListener("click", function (e) {
    e.preventDefault();
    const target = document.querySelector(this.getAttribute("href"));
    if (target) {
      target.scrollIntoView({
        behavior: "smooth",
        block: "start",
      });
    }
  });
});

// Navbar Scroll Effect
window.addEventListener("scroll", function () {
  const navbar = document.querySelector(".navbar");
  if (window.scrollY > 50) {
    navbar.classList.add("shadow-sm");
  } else {
    navbar.classList.remove("shadow-sm");
  }
});

// Form Validation
document.querySelectorAll("form").forEach((form) => {
  form.addEventListener("submit", function (e) {
    e.preventDefault();

    // Basic validation
    const inputs = form.querySelectorAll("input[required], select[required]");
    let isValid = true;

    inputs.forEach((input) => {
      if (!input.value.trim()) {
        isValid = false;
        input.classList.add("is-invalid");
      } else {
        input.classList.remove("is-invalid");
      }
    });

    if (isValid) {
      // Show success message (you can customize this)
      alert("Form submitted successfully! We will contact you soon.");
      form.reset();
    }
  });
});

// Add Animation on Scroll
const observerOptions = {
  threshold: 0.1,
  rootMargin: "0px 0px -50px 0px",
};

const observer = new IntersectionObserver(function (entries) {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      entry.target.classList.add("fade-in");
      observer.unobserve(entry.target);
    }
  });
}, observerOptions);

// Observe elements
document
  .querySelectorAll(".service-card, .work-icon-wrapper, .testimonial-card")
  .forEach((el) => {
    observer.observe(el);
  });

// Show/Hide Scroll to Top Button
const scrollButton = document.querySelector(".scroll-to-top");
window.addEventListener("scroll", function () {
  if (window.scrollY > 300) {
    scrollButton.style.display = "block";
  } else {
    scrollButton.style.display = "none";
  }
});

// Import Bootstrap library
import bootstrap from "bootstrap";

// Initialize Bootstrap tooltips and popovers
const tooltipTriggerList = [].slice.call(
  document.querySelectorAll('[data-bs-toggle="tooltip"]')
);
tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl);
});
