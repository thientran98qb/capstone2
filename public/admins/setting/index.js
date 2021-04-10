function deleteSlide(event) {
    event.preventDefault();
    const urlRequest = $(this).data("url");
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
                type: "get",
                url: urlRequest,
                success: function name(data) {
                    if (data.code == 200) {
                        that.parent().parent().remove();
                        Swal.fire(
                            "Deleted!",
                            "Your file has been deleted.",
                            "success"
                        );
                    }
                },
                error: function name(params) {},
            });
        }
    });
}
$(document).on("click", ".delete_setting", deleteSlide);
$(".delete_user").on("submit", function () {
    return confirm("Do you want to delete this item?");
});
$(document).on("click", ".checkall", function () {
    var checked = $(this).is(":checked");
    $(".table-checkall tbody tr td input:checkbox").prop("checked", checked);
});
