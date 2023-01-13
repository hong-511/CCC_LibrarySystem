function loadNavbar() {
  fetch("/asset/nav.html")
    .then((response) => response.text())
    .then((text) => (document.getElementById("navbar").innerHTML = text));
}
loadNavbar();