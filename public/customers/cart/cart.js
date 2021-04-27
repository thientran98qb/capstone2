$(document).on("click", ".addcart", function () {
    idProduct = $(this).data("id");
    urlCart = $(this).data("url");
    $.ajax({
        method: "GET",
        url: urlCart,
        data: { idProduct: idProduct },
        success: function (data) {
            var result = [];
            var endResult = [];
            let dataRes = "";
            for (var i in data) result.push(data[i]);
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "Add cart successfully",
                showConfirmButton: false,
                timer: 1500,
            });
            $(".cart-notice").html(result.length);
            result.forEach((element) => {
                dataRes += ` <li class="cart-item">
                    <img src="${element.img}" alt="" class="cart-item-img">
                    <div class="cart-info">
                        <div class="cart-info-text">
                            <h5 class="cart-info-name">${element.product_name}</h5>
                            <input type="number"class="cart-info-quantily quantity" value="${element.quantity}" data-idd="${element.id}" style="width: 50px" min="1">
                            <span class="cart-info-x">x</span>
                            <span class="cart-info-price">$${element.price}</span>
                            <span style="border-left: 1px solid black;padding:0 0 0 10px" class="cart-info-price totalPrice_${element.id}">$${element.total_price}</span>
                        </div>
                        <div class="cart-info-remove">
                            <span class="remove-item-cart" data-idremove="${element.id}"><i class="fas fa-times"></i></span>
                        </div>
                    </div>
                </li>`;
            });
            $(".cart-list-item").html(dataRes);
            $("#thu").load(window.location.href + " #thu");
        },
        error: function (data) {},
    });
});
$(document).on("change", ".quantity", function () {
    let idItem;
    num = $(this).val();
    idItem = $(this).data("idd");
    $.ajax({
        method: "GET",
        url: "/customer/changeitem/" + idItem,
        data: { idItem: idItem, num: num },
        success: function (data) {
            $(`.totalPrice_${idItem}`).html(`$${data[idItem]["total_price"]}`);
        },
        error: function (data) {},
    });
});
$(document).on("click", ".remove-item-cart", function () {
    const idRemove = $(this).data("idremove");
    let that = $(this);
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                method: "GET",
                url: "/customer/removeitem/" + idRemove,
                data: { idItem: idRemove },
                success: function (data) {
                    var count = Object.keys(data).length;
                    $(".cart-notice").html(count);
                    $(that).parent().parent().parent().remove();
                    Swal.fire(
                        "Deleted!",
                        "Your file has been deleted.",
                        "success"
                    );
                    $("#thu").load(window.location.href + " #thu");
                },
                error: function (data) {},
            });
        }
    });
});
