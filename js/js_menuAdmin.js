// Este js lo que nos hace es que haya un menu desplegable en la parte de administrador y en la parte de usuario
function toggleMenu() {
  const menu = document.getElementById("menu");
  const title = document.getElementById("menu-title");

  if (menu.style.display === "block") {
    menu.style.display = "none";
    title.classList.remove("menu-visible");
  } else {
    menu.style.display = "block";
    title.classList.add("menu-visible");
  }
}
