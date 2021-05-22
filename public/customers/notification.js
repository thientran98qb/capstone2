var pusher = new Pusher("ed256c40190625c83056", {
    encrypted: true,
    cluster: "ap1",
});

var channel = pusher.subscribe("Notify");
channel.bind("send-message", function (data) {
    var newNotificationHtml = "";
    if (data.type == "admin") {
        newNotificationHtml = `
        <a href="http://127.0.0.1:8000/admin/orders" class="dropdown-item">
        <!-- Message Start -->
        <div class="media">
          <div class="media-body">
            <h3 class="dropdown-item-title">
                ${data.title}
              <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
            </h3>
            <p class="text-sm">${data.content}</p>
          </div>
        </div>
        <!-- Message End -->
      </a>
      <div class="dropdown-divider"></div>
        `;
        $("#noticenumberOfUnReadNotification").removeClass("hidden");
        $("#numberOfUnReadNotification").html(data.numberOfUnReadNotification);
        $("#list_notifications").prepend(newNotificationHtml);
    }
});

function markAsRead(element) {
    let id = $(element).data("id");
    let user = $(element).data("user");
    let _token = $("#token").val();
    let numberOfUnReadNotification =
        $("#numberOfUnReadNotification").html() - 1;
    let values = {
        id: id,
        _token: _token,
    };
    $.ajax({
        url: `http://127.0.0.1:8000/notification/markAsRead/${id}/${user}`,
        type: "GET",
        data: values,
        success: function (response) {
            document.getElementById("noti" + id).innerHTML = response;
            document.getElementById("numberOfUnReadNotification").innerHTML =
                numberOfUnReadNotification;
            if (numberOfUnReadNotification == 0) {
                document
                    .getElementById("noticenumberOfUnReadNotification")
                    .classList.add("hidden");
            }
        },
    });
}

function markAllAsRead(element) {
    let user = $(element).data("user");
    let _token = $("#token").val();
    let values = {
        _token: _token,
    };
    $.ajax({
        url: "http://127.0.0.1:8000/notification/markAllAsRead/" + user,
        type: "GET",
        data: values,
        success: function (response) {
            document.getElementById("list_notifications").innerHTML = response;
            document
                .getElementById("noticenumberOfUnReadNotification")
                .classList.add("hidden");
        },
    });
}
