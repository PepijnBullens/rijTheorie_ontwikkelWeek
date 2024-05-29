function select(element) {
  const answer_options = document.querySelectorAll(".answer_options");

  answer_options.forEach((option) => {
    if (option == element) {
      option.classList.add("selected");
    } else {
      option.classList.remove("selected");
    }
  });
}

function flip() {
  let answerTable = document.querySelector("#answerTable");
  let arrow = document.querySelector("#view_results");

  if (answerTable.style.opacity == "1") {
    answerTable.style.opacity = "0";
    arrow.style.transform = "rotate(90deg)";
    document.body.style.overflow = "hidden";
  } else {
    answerTable.style.opacity = "1";
    arrow.style.transform = "rotate(-90deg)";
    document.body.style.overflow = "visible";
  }
}

function startTimer() {
  const timer = document.querySelector("#timer_text");
  let time = 0;
  timer.textContent = time;
  setInterval(() => {
    if (time <= 0) {
      ranOutOfTime();
    } else {
      time--;
      timer.textContent = time;
    }
  }, 1000);
}

startTimer();