function select(element) {
  const answer_options = document.querySelectorAll(".answer_options");

  if (answer_options != null) {
    answer_options.forEach((option) => {
      if (option == element) {
        option.classList.add("selected");
      } else {
        option.classList.remove("selected");
      }
    });
  }
}

function flip() {
  let answerTable = document.querySelector("#answerTable");
  let arrow = document.querySelector("#view_results");

  if (answerTable != null && arrow != null) {
    if (answerTable.style.opacity == "1") {
      answerTable.style.opacity = "0";
      arrow.style.transform = "rotate(90deg)";
    } else {
      answerTable.style.opacity = "1";
      arrow.style.transform = "rotate(-90deg)";
    }
  }
}

function startTimer() {
  const timer = document.querySelector("#timer_text");
  if (timer != null) {
    let time = 8;
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
}

startTimer();