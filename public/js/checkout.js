//add collapse to all tags hiden and showed by select mystuff
$(".delivery_hide").addClass("hidden");

//on change hide all divs linked to select and show only linked to selected option
$("#mystuff").on("change", function () {
    var selector = ".delivery_" + $(this).val();

    //show only element connected to selected option
    $(selector).removeClass("hidden");
});
