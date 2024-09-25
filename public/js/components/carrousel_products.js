document.querySelectorAll(".carousel-container").forEach((carousel) => {
  const track = carousel.querySelector(".carousel-track");
  const prevButton = carousel.querySelector(".carousel_control_product.prev");
  const nextButton = carousel.querySelector(".carousel_control_product.next");

  const trackWidth = track.scrollWidth;
  const visibleWidth = track.clientWidth;
  const step = visibleWidth; // The scroll amount will be the visible width

  let currentPosition = 0;

  // Function to move the carousel
  function moveCarousel(direction) {
    if (direction === "next") {
      currentPosition += step;
      if (currentPosition > trackWidth - visibleWidth) {
        currentPosition = trackWidth - visibleWidth; // Don't scroll past the content
      }
    } else if (direction === "prev") {
      currentPosition -= step;
      if (currentPosition < 0) {
        currentPosition = 0; // Don't scroll past the start
      }
    }
    track.style.transform = `translateX(-${currentPosition}px)`;
  }

  // Button events
  nextButton.addEventListener("click", () => moveCarousel("next"));
  prevButton.addEventListener("click", () => moveCarousel("prev"));
});
