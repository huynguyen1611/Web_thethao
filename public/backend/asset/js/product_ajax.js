$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});
// Xem trước ảnh đại diện
$("#image").on("change", function () {
    $("#input-file-img").empty();
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            const img = $("<img>").attr("src", e.target.result).css({
                width: "150px",
                margin: "10px",
            });
            $("#input-file-img").append(img);
        };
        reader.readAsDataURL(file);
    }
});

// Xem trước ảnh sản phẩm
$("#images").on("change", function () {
    $("#input-file-imgs").empty();
    const files = this.files;
    for (let i = 0; i < files.length; i++) {
        const reader = new FileReader();
        reader.onload = function (e) {
            const img = $("<img>").attr("src", e.target.result).css({
                width: "150px",
                margin: "10px",
            });
            $("#input-file-imgs").append(img);
        };
        reader.readAsDataURL(files[i]);
    }
});
