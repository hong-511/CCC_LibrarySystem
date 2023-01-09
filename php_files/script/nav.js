function loadHTML() {
  fetch("/asset/nav.html")
    .then((response) => response.text())
    .then((text) => (document.getElementById("navbar").innerHTML = text));
}
loadHTML();