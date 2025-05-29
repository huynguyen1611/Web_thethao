document.addEventListener("DOMContentLoaded", function () {
    const host = "https://provinces.open-api.vn/api/";
    const citySelect = document.getElementById("city");
    const districtSelect = document.getElementById("district");
    const wardSelect = document.getElementById("ward");

    const customerCity = "";
    const customerDistrict = "";
    const customerWard = "";

    // Tải danh sách tỉnh
    axios.get(`${host}?depth=1`).then((response) => {
        const cities = response.data;
        citySelect.innerHTML = '<option value="">Chọn tỉnh/thành phố</option>';
        cities.forEach((city) => {
            const selected = city.name === customerCity ? "selected" : "";
            citySelect.innerHTML += `<option value="${city.name}" data-id="${city.code}" ${selected}>${city.name}</option>`;
        });

        // Nếu có dữ liệu tỉnh, tải quận/huyện tương ứng
        const selectedCity = cities.find((city) => city.name === customerCity);
        if (selectedCity) {
            axios
                .get(`${host}p/${selectedCity.code}?depth=2`)
                .then((response) => {
                    const districts = response.data.districts;
                    districtSelect.innerHTML =
                        '<option value="">Chọn quận/huyện</option>';
                    districts.forEach((district) => {
                        const selected =
                            district.name === customerDistrict
                                ? "selected"
                                : "";
                        districtSelect.innerHTML += `<option value="${district.name}" data-id="${district.code}" ${selected}>${district.name}</option>`;
                    });

                    // Nếu có dữ liệu quận/huyện, tải phường/xã tương ứng
                    const selectedDistrict = districts.find(
                        (district) => district.name === customerDistrict
                    );
                    if (selectedDistrict) {
                        axios
                            .get(`${host}d/${selectedDistrict.code}?depth=2`)
                            .then((response) => {
                                const wards = response.data.wards;
                                wardSelect.innerHTML =
                                    '<option value="">Chọn phường/xã</option>';
                                wards.forEach((ward) => {
                                    const selected =
                                        ward.name === customerWard
                                            ? "selected"
                                            : "";
                                    wardSelect.innerHTML += `<option value="${ward.name}" data-id="${ward.code}" ${selected}>${ward.name}</option>`;
                                });
                            });
                    }
                });
        }
    });

    // Sự kiện khi thay đổi tỉnh
    citySelect.addEventListener("change", function () {
        const cityId = this.options[this.selectedIndex].dataset.id;
        if (cityId) {
            axios.get(`${host}p/${cityId}?depth=2`).then((response) => {
                const districts = response.data.districts;
                districtSelect.innerHTML =
                    '<option value="">Chọn quận/huyện</option>';
                wardSelect.innerHTML =
                    '<option value="">Chọn phường/xã</option>';
                districts.forEach((district) => {
                    districtSelect.innerHTML += `<option value="${district.name}" data-id="${district.code}">${district.name}</option>`;
                });
            });
        }
    });

    // Sự kiện khi thay đổi quận/huyện
    districtSelect.addEventListener("change", function () {
        const districtId = this.options[this.selectedIndex].dataset.id;
        if (districtId) {
            axios.get(`${host}d/${districtId}?depth=2`).then((response) => {
                const wards = response.data.wards;
                wardSelect.innerHTML =
                    '<option value="">Chọn phường/xã</option>';
                wards.forEach((ward) => {
                    wardSelect.innerHTML += `<option value="${ward.name}" data-id="${ward.code}">${ward.name}</option>`;
                });
            });
        }
    });
});
