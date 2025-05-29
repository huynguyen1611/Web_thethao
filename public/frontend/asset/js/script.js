const sliderItem = document.querySelectorAll(".slider-item");
for (let index = 0; index < sliderItem.length; index++) {
    sliderItem[index].style.left = index * 100 + "%";
}
const sliderItems = document.querySelector(".slider-items");
const iconRight = document.querySelector(".ri-arrow-right-fill");
const iconLeft = document.querySelector(".ri-arrow-left-fill");
let i = 0;

if (iconRight != null && iconLeft != null) {
    iconRight.addEventListener("click", () => {
        if (i < sliderItem.length - 1) {
            i++;
            sliderMove(i);
        } else {
            return false;
        }
    });
    iconLeft.addEventListener("click", () => {
        if (i <= 0) {
            return false;
        }
        {
            i--;
            sliderMove(i);
        }
    });
}

// function autoSlider() {
//   if (i < sliderItem.length - 1) {
//     i++;
//     sliderMove(i);
//   } else {
//     i = 0;
//   }
// }
function sliderMove() {
    sliderItems.style.left = -i * 100 + "%";
}
// setInterval(autoSlider, 3000);
/* -----------Menu Responsite---------- */
const Menubar = document.querySelector(".header-bar-icon");
const HeaderNav = document.querySelector(".header-nav");
Menubar.addEventListener("click", () => {
    HeaderNav.classList.toggle("active");
});
/* header */
window.addEventListener("scroll", () => {
    if (scrollY > 50) {
        document.querySelector("#header").classList.add("active");
    } else {
        document.querySelector("#header").classList.remove("active");
    }
});

// click img product detail
const ImageSmall = document.querySelectorAll(".product-img-items img"); // 👈 chọn tất cả ảnh nhỏ
const ImageMain = document.querySelector(".main-img");

for (let index = 0; index < ImageSmall.length; index++) {
    ImageSmall[index].addEventListener("click", () => {
        ImageMain.src = ImageSmall[index].getAttribute("src"); // dùng getAttribute cho an toàn lấy đường dẫn ảnh
        ImageSmall.forEach((img) => img.classList.remove("active")); // Xóa active trước
        ImageSmall[index].classList.add("active");
    });
}
// product- quantity
const quanPlus = document.querySelectorAll(".ri-add-line");
const quanMinus = document.querySelectorAll(".ri-subtract-line");
const quanInput = document.querySelectorAll(".quantity-input");
// let qty = 1;
if (quanInput != null && quanPlus != null) {
    for (let index = 0; index < quanMinus.length; index++) {
        quanPlus[index].addEventListener("click", () => {
            inputValue = quanInput[index].value;
            inputValue++;
            quanInput[index].value = inputValue;
            // console.log(qty);
        });
        quanMinus[index].addEventListener("click", () => {
            inputValue = quanInput[index].value;
            if (inputValue <= 1) {
                return false;
            } else {
                inputValue--;
                quanInput[index].value = inputValue;
            }
        });
    }
}
