document.addEventListener("DOMContentLoaded", () => {
  const answerOptions = document.querySelectorAll(".answer_options");

  answerOptions.forEach((option) => {
    option.addEventListener("click", () => {
      // Verwijder de 'selected' klasse van alle opties
      answerOptions.forEach((opt) => opt.classList.remove("selected"));

      // Voeg de 'selected' klasse toe aan de aangeklikte optie
      option.classList.add("selected");
    });
  });
});
