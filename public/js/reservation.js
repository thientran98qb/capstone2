$("#selectQuantity").on("click", function () {
    let valueS = $(this).val();
    let url = $(this).data("url");
    // console.log(valueS);
    $.ajax({
        url: url,
        method: "GET",
        data: { quantity: valueS },
        success: function (success) {
            let optSelect = "<option value=''>Select Table</option>";

            success.forEach((data) => {
                let selected = data.status === 1 ? "disabled" : "";
                let mark = data.status === 1 ? "(using...)" : "";
                optSelect += `<option value="${data.id}" ${selected}>${data.name}${mark}</option>;`;
            });
            $("#opt_table").html(optSelect);
        },
        error: function (error) {},
    });
});
