$(".category").on("change", function (e) {
    e.preventDefault();
    const id = $(this).val();
    const url = $(this).data("url");
    $.ajax({
        method: "GET",
        data: { id: id },
        url: url,
        success: function (val) {
            const arrFood = val.foods;
            let html = "";
            arrFood.forEach((element) => {
                html += `<option value='${element["id"]}'>${element["product_name"]}</option>`;
            });
            $(".food").html(html);
        },
        error: function (err) {
            console.log(err);
        },
    });
});
var arrMoney = [];

var arrM = [];
$(".add-control").on("click", function (e) {
    e.preventDefault();
    const quantity = $("#amount").val();
    const foodID = $(".food").val();
    const url = $(this).data("url");
    var tableId = "";
    if ($("button").hasClass("table-staff-active")) {
        tableId = $(".table-staff-active").data("id");
    }
    let i = 0;
    if (foodID > 0) {
        $.ajax({
            method: "GET",
            data: {
                quantity: quantity,
                foodID: foodID,
                tableId: tableId,
            },
            url: url,
            success: function (val) {
                let food = val.food;
                arrMoney.push(food.price * val.quantity);
                let htmlRow = "";
                htmlRow += `<tr id="food_${food.id}">
                    <td class='product-name'>${food.product_name}</td>
                    <td class="price${food.id}">$${food.price}</td>
                    <td><input type="number" class="changeAmount" data-id='${
                        food.id
                    }' min="1" style="width:50%;" value="${val.quantity}"></td>
                    <td class='moneyline money${food.id}'>$${
                    food.price * quantity
                }</td>
                    <td>
                    <button id="12" class="delete-item-food" data-id='${
                        food.id
                    }'>Delete</button>
                    </td>
                </tr>`;

                // $(htmlRow).insertAfter($("#menu-list").closest("tr"));
                $("#menu-list").append(htmlRow);
                const totalPrice = arrMoney.reduce((sum, val) => sum + val, 0);
                $(".total-cost").text(`$${totalPrice}`);
            },
            error: function (err) {
                console.log(err);
            },
        }).done(function (data) {
            $(".delete-item-food").on("click", function () {
                e.preventDefault();
                const id = $(this).data("id");
                $(`#food_${id}`).remove();
            });
            console.log(data);
            $(".changeAmount").on("change", function () {
                const id = $(this).data("id");
                const amount = $(this).val();
                const price = $(`.price${id}`).text();
                const priceNumber = Number(price.split("").splice(1).join(""));
                const money = amount * priceNumber;
                $(`.money${id}`).text(`$${money}`);
            });
            $(".total-cost");
            // newEl.appendTo($(".some-parent-class"));
        });
    } else {
        alert("Vui long chon mon an");
    }
});
$(".update-bill").on("click", function (e) {
    e.preventDefault();
    const totalCost = Array.from(
        document.querySelectorAll(".moneyline"),
        (el) => Number(el.textContent.replace("$", ""))
    ).reduce((sum, val) => sum + val, 0);

    $(".total-cost").text(`$${totalCost}`);
});
$(".table-btn").on("click", function (e) {
    e.preventDefault();
    const idTable = $(this).data("id");
    const url = $(this).data("url");
    $(this).toggleClass("table-staff-active");
    $.ajax({
        method: "GET",
        data: {
            idTable: idTable,
        },
        url: url,
        success: function (val) {
            let htmlRow = "";
            if ($("button").hasClass("table-staff-active")) {
                val.forEach(function (el) {
                    htmlRow += `<tr id="food_${el.id} food-tr">
                        <td class='product-name'>${el.product_name}</td>
                        <td class="price${el.id}">$${el.price}</td>
                        <td><input type="number" class="changeAmount" data-id='${el.id}' min="1" style="width:50%;" value="${el.amount}"></td>
                        <td class='moneyline money${el.id}'>$${el.total}</td>
                        <td>
                        <button id="12" class="delete-item-food" data-id='${el.id}'>Delete</button>
                        </td>
                    </tr>`;
                    // const totalPrice = arrMoney.reduce((sum, val) => sum + val, 0);
                    // $(".total-cost").text(`$${totalPrice}`);
                });

                $("#menu-list").append(htmlRow);
            } else {
                $("#menu-list tr").slice(-val.length).remove();
            }
        },
        error: function (err) {
            console.log(err);
        },
    }).done(function (data) {
        $(".delete-item-food").on("click", function () {
            e.preventDefault();
            const id = $(this).data("id");
            $(`#food_${id}`).remove();
        });
        console.log(data);
        $(".changeAmount").on("change", function () {
            const id = $(this).data("id");
            const amount = $(this).val();
            const price = $(`.price${id}`).text();
            const priceNumber = Number(price.split("").splice(1).join(""));
            const money = amount * priceNumber;
            $(`.money${id}`).text(`$${money}`);
        });
    });
});
