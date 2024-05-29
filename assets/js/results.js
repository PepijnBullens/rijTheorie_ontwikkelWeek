function flip() {
  let answerTable = document.querySelector("#answerTable");
  let arrow = document.querySelector("#view_results");

  if (answerTable.style.opacity == "1") {
    answerTable.style.opacity = "0";
    arrow.style.transform = "rotate(90deg)";
  } else {
    answerTable.style.opacity = "1";
    arrow.style.transform = "rotate(-90deg)";
  }
}
