// $.ajaxSetup({
//     headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     }
// });

// $(document).on('click', '.delete_category', function () {
//     var id = $(this).attr('data-id');
//     var token = $("meta[name='csrf-token']").attr("content");
//     var href = $(this).data('href');
//     $.ajax({
//         type: 'DELETE',
//         url: "category/" + id,
//         data: {
//             _token: token,
//             _method: 'DELETE',
//             id: id,
//         },
//         success: function (response) {
//             console.log("ASD");
//         }
//     });
// });
$(".delete_category").on("submit", function () {
    return confirm("Do you want to delete this item?");
});
$(".delete_menu").on("submit", function () {
    return confirm("Do you want to delete this item?");
});
