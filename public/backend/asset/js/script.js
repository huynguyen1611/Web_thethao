const menuLi = document.querySelectorAll(
  ".admin-sidebar-content > ul > li > a"
);
const submenu = document.querySelectorAll(".sub-menu");

for (let index = 0; index < menuLi.length; index++) {
  menuLi[index].addEventListener("click", (e) => {
    e.preventDefault();

    // Tìm UL con của mục đang click
    const currentSubMenu = menuLi[index].parentNode.querySelector("ul");

    // Nếu submenu đang mở (khác 0px) thì thu lại
    if (currentSubMenu.style.height && currentSubMenu.style.height !== "0px") {
      currentSubMenu.setAttribute("style", "height: 0px");
    } else {
      // Đóng tất cả submenu trước
      for (let i = 0; i < submenu.length; i++) {
        submenu[i].setAttribute("style", "height: 0px");
      }

      // Mở submenu được click
      const submenuHeight =
        currentSubMenu.querySelector(".sub-menu-items").offsetHeight;
      currentSubMenu.setAttribute("style", "height:" + submenuHeight + "px");
    }
  });
}
