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
