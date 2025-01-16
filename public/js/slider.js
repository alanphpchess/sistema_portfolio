const thumbnails = document.getElementsByClassName("thumbnail");
const slider = document.getElementById("slider");
const nextBtn = document.getElementById("slide-right");
const prevBtn = document.getElementById("slide-left");

let scrollAmount = 0;
let scrollSpeed = 2; // Defina a velocidade desejada

nextBtn.addEventListener("click", () => {
  scrollAmount = 0;
  let slideTimer = setInterval(() => {
    slider.scrollLeft += 1; // Reduza o valor da quantidade de deslocamento
    scrollAmount += 1;
    if (scrollAmount >= 100) {
      clearInterval(slideTimer);
    }
  }, 50); // Aumente o valor do intervalo de tempo para tornar mais lento
});

prevBtn.addEventListener("click", () => {
  scrollAmount = 0;
  let slideTimer = setInterval(() => {
    slider.scrollLeft -= 1; // Reduza o valor da quantidade de deslocamento
    scrollAmount += 1;
    if (scrollAmount >= 100) {
      clearInterval(slideTimer);
    }
  }, 50); // Aumente o valor do intervalo de tempo para tornar mais lento
});

// Função de autoplay mais lenta
function autoPlay() {
  if (slider.scrollLeft >= slider.scrollWidth - slider.clientWidth - 1) {
    slider.scrollLeft = 0;
  } else {
    slider.scrollLeft += 1; // Reduza o valor da quantidade de deslocamento
  }
}

let play = setInterval(autoPlay, 1000); // Aumente o valor do intervalo de tempo para tornar mais lento

// Pausar o slide ao passar o mouse
for (let i = 0; i < thumbnails.length; i++) {
  thumbnails[i].addEventListener("mouseover", () => {
    clearInterval(play);
  });
  thumbnails[i].addEventListener("mouseout", () => {
    play = setInterval(autoPlay, 4000); // Aumente o valor do intervalo de tempo para tornar mais lento
  });
}
