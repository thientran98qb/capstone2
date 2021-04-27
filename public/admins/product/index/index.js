function actionDelete(e) {
    e.preventDefault();
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
function orderDelete(e) {
    e.preventDefault();
    const urlRequest = $(this).data("url");
    let that = $(this);
    console.log(urlRequest);
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
function changeStatus() {
    const valueChange = $(this).val();
    const id = $(this).data("id");
    const urlChange = $(this).data("url");
    $.ajax({
        type: "get",
        url: urlChange,
        data: { id: id, valueChange: valueChange },
        success: function name(data) {
            if (data.code == 200) {
                toastr.success("Your role as been updated!");
            }
        },
        error: function name(params) {},
    });
}
$(document).on("click", ".action_delete", actionDelete);
$(document).on("click", ".delete_order", orderDelete);
$(document).on("change", ".status_order", changeStatus);
