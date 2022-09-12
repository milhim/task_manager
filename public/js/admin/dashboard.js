jQuery(document).ready(function ($) {
    jQuery("#btn-add").click(function () {
        jQuery("#btn-save").val("add");
        jQuery("#myForm").trigger("reset");
        jQuery("#formModal").modal("show");
    });

    $("#btn-save").click(function (e) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        e.preventDefault();
        let formData = {
            name: jQuery("#name").val(),
            email: jQuery("#email").val(),
            phone: jQuery("#phone").val(),
            role_id: jQuery("#role_id").val(),
            password: jQuery("#password").val(),
            password_confirmation: jQuery("#password_confirmation").val(),
        };
        let state = jQuery("#btn-save").val();
        let type = "POST";
        let user_id = jQuery("#user_id").val();
        let ajaxurl = "register";

        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: "json",
            success: function (data) {
                let user = `
                <tr id=product${data.id}>
                    <td>${data.name}</td>
                    <td> ${data.email} </td>
                    <td>${data.phone}</td>
                    <td>${data.role_id}</td>
                </tr>`;

                if (state == "add") {
                    jQuery("#users-list").append(user);
                } else {
                    jQuery("#user" + user_id).replaceWith(user);
                }
                jQuery("#myForm").trigger("reset");
                jQuery("#formModal").modal("hide");
                console.log(state);
            },
            error: function (data) {
                console.log(data);
            },
        });
    });
});
