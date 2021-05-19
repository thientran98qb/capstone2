//add collapse to all tags hiden and showed by select mystuff
$(".delivery_hide").addClass("hidden");

//on change hide all divs linked to select and show only linked to selected option
$("#mystuff").on("change", function () {
    var selector = ".delivery_" + $(this).val();
    // var selector = ".delivery_opt1";
    if (selector == ".delivery_opt2") {
        $(".delivery_opt1").addClass("hidden");
    }
    //show only element connected to selected option
    $(selector).removeClass("hidden");
});
// $(".form-voucher").on("submit", function (e) {
//     e.preventDefault();
//     const url = $(this).attr("action");
//     const code = $(".voucher").val();
//     const price = $(".total_pricee").val();
//     $.ajax({
//         url: url,
//         method: "GET",
//         data: { code: code, price: price },
//         success: function (success) {
//             console.log(success);
//         },
//         error: function (error) {},
//     });
// });
