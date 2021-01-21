function deleteItem(id, site_root) {
    if (confirm('Вы действительно хотите удалить эту запись?')) {
        window.location.href = `${site_root}items/delete/${id}`;
    }
}

function deleteArticle(id, site_root) {
    if (confirm('Вы действительно хотите удалить эту статью?')) {
        window.location.href = `${site_root}club/delete/${id}`;
    }
}

function deleteAddress(id, site_root) {
    if (confirm('Вы действительно хотите удалить этот адрес?')) {
        window.location.href = `${site_root}addresses/delete/${id}`;
    }
}

function itemSearch(site_root) {
    let search_str = document.getElementById("search_panel").value;
    if (!search_str == "") {
        window.location.href = `${site_root}items/search/${search_str}`;
    } else {
        window.location.href = `${site_root}items/search`;
    }
}

function itemSearchOnPage(site_root) {
    let search_str = document.getElementById("search_panel_on_page").value;
    if (!search_str == "") {
        window.location.href = `${site_root}items/search/${search_str}`;
    } else {
        window.location.href = `${site_root}items/search`;
    }
}

function addToCart(id) {
    // cart = { "5": 2, "4": 1} // две книги с id=5, одна книга с id=4
    let cart = (getCookie('cart') === "") ? {} : JSON.parse(getCookie('cart'));
    if (cart.hasOwnProperty(id)) { // если уже есть это свойство
        cart[id]++;
    } else {
        cart[id] = 1;
    }
    //console.log(cart);
    setCookie('cart', JSON.stringify(cart), {
        'expires': 2 * 24 * 60 * 60,
        'path': '/'
    });
}

function updateOrderStatus(id, status, site_root) {
    if (status == 1) {
        if (confirm('Обновить статус заказа на "ОБРАБОТАН"?')) {
            window.location.href = `${site_root}orders/update/${id}/${status}`;
        }
    }
    if (status == 2) {
        if (confirm('Обновить статус заказа на "ВЫПОЛНЕН"?')) {
            window.location.href = `${site_root}orders/update/${id}/${status}`;
        }
    }

}

$("#user_reg").on("keyup", () => {
    //console.log(123);
    let login = $("#user_reg").val();
    if (login.length < 2) {
        document.getElementById("login_helper").innerHTML = "Логин должнен состоять хотя бы из двух знаков.";
    } else if (login.match(/[а-яА-Я]+/)) {
        document.getElementById("login_helper").innerHTML = "Логин должен состоять из латинских букв и цифр.";
    } else if (!login.match(/[a-zA-Z]+/)) {
        document.getElementById("login_helper").innerHTML = "Должна присутствовать хотя бы одна буква.";
    } else {
        $.ajax({
            url: `./ajax/check_if_login_exists?login=${login}`,
            success: function (response) {
                //console.log(response);
                if (response) {
                    $("#login_helper").html("Такой логин уже существует!");
                } else {
                    $("#login_helper").html("");
                }
            },
            error: function (error) {
                console.log(error);
            }
        });

    }
});

if (!getCookie("firstPageIsVisited")) {
    $('#myModal').modal('show');
    setCookie('firstPageIsVisited', 'yes');
}


function clearCart(site_root) {
    deleteCookie('cart', '/');
    window.location.href = `${site_root}cart`;
}
