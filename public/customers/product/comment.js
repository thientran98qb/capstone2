$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});
function reply(id) {
    let html = `<div class="reply-box">
    <img src="https://lh3.googleusercontent.com/a-/AOh14Gin9YErbXWxwOs0FJ9CDU4MCW5rLLAUbcBmBvaO=s400" alt="" class="reply-box-avatar">
    <input class="effect-2 effect-2-sub" id="content${id}" type="text" placeholder="Placeholder Text">
    <div class="cmt__box-action cmt__box-action-sub">
        <div class="cmt__box-cancel">Hủy</div>
        <button class="cmt__box-ok" data-url=\"/customer/product/comment\" onClick=\"submit(this, ${id})\">Submit</button>
    </div>
    </div>`;
    $("#text" + id).html(html);
}

function submit(element, cmr_id = 0) {
    let url = $(element).data("url");
    let content = $("#content" + cmr_id).val();
    let product_id = parseInt($("#product_id").val());
    let _token = $("#token").val();
    cmr_id = parseInt(cmr_id);
    let values = {
        content: content,
        product_id: product_id,
        cmr_id: cmr_id,
        _token: _token,
    };
    if (!content) {
        alert("Content is not null");
    } else {
        $.ajax({
            url: url,
            type: "POST",
            data: values,
            success: function (response) {
                $("#comments").html(response);
                $("#content" + cmr_id).val("");
            },
        });
    }
}

function edit(id) {
    let comment = $("#rootComment" + id).text();
    let html = `<div class="reply-box">
    <img src="https://lh3.googleusercontent.com/a-/AOh14Gin9YErbXWxwOs0FJ9CDU4MCW5rLLAUbcBmBvaO=s400" alt="" class="reply-box-avatar">
    <input class="effect-2 effect-2-sub" id="content${id}" value=${comment} type="text" placeholder="Placeholder Text">
    <div class="cmt__box-action cmt__box-action-sub">
        <div class="cmt__box-cancel">Hủy</div>
        <button class="cmt__box-ok" data-url=\"/customer/comment/update\" onClick=\"submit(this, ${id})\">Submit</button>
    </div>
    </div>`;
    $("#rootComment" + id).html(html);
}

function destroy(cmr_id) {
    let url = "/customer/comment/destroy";
    let _token = $("#token").val();
    let product_id = parseInt($("#product_id").val());
    cmr_id = parseInt(cmr_id);
    let values = {
        cmr_id: cmr_id,
        product_id: product_id,
        _token: _token,
    };
    $.ajax({
        url: url,
        type: "DELETE",
        data: values,
        success: function (response) {
            $("#comments").html(response);
        },
    });
}
