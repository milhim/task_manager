jQuery(document).ready(function ($) {
    //Add new User
    jQuery("#btn-add").click(function () {
        jQuery("#btn-save").val("add");
        jQuery("#myForm").trigger("reset");
        jQuery("#formModal").modal("show");
        jQuery("#btn-update").hide();
        jQuery("#btn-save").show();
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
        let ajaxurl = "create-new-user";

        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: "json",
            success: function (data) {
                let user = `
                <tr id=user${data.id}>
                    <td>${data.name}</td>
                    <td> ${data.email} </td>
                    <td>${data.phone}</td>
                    <td>${data.role_id}</td>
                    <td>
                        <button class="btn btn-warning edit" id="${data.id}">Edit</button>
                        <button class="btn btn-danger remove">Reomve</button>
                    </td>
                </tr>`;

                if (state === "add") {
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

    //Update User
    jQuery(".edit").click(function () {
        jQuery("#btn-update").val("update");
        jQuery("#btn-save").hide();
        jQuery("#btn-update").show();

        let user_id = $(this).attr("id");
        $.get(`/show-user/${user_id}`, (user) => {
            $("#user_id").val(user.id);
            $("#name").val(user.name);
            $("#email").val(user.email);
            $("#phone").val(user.phone);
            jQuery("#formModal").modal("show");
        });
    });

    $(document).on("click", "#btn-update", function (e) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        e.preventDefault();

        $.ajax({
            type: "put",
            url: `update-user`,
            data: {
                id: jQuery("#user_id").val(),
                name: jQuery("#name").val(),
                email: jQuery("#email").val(),
                phone: jQuery("#phone").val(),
                role_id: jQuery("#role_id").val(),
                password: jQuery("#password").val(),
                password_confirmation: jQuery("#password_confirmation").val(),
            },
            dataType: "json",
            success: function (data) {
                let user = `
                <tr id=user${data.id}>
                    <td>${data.name}</td>
                    <td> ${data.email} </td>
                    <td>${data.phone}</td>
                    <td>${data.role_id}</td>
                    <td>
                        <button class="btn btn-warning edit" id="${data.id}">Edit</button>
                        <button class="btn btn-danger remove">Reomve</button>
                    </td>
                </tr>`;
                jQuery("#user" + data.id).replaceWith(user);
            },
            error: function (data) {
                console.log(data);
            },
        });
    });

    //delete user
    $(document).on("click", ".remove", function (e) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        let user_id = $(this).attr("id");
        $.ajax({
            type: "delete",
            url: `delete-user/${user_id}`,
            data: {
                id: user_id,
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                if (data.message) {
                    $(`#user${data.id}`).remove();
                }
            },
            error: function (data) {
                console.log(data);
            },
        });
    });
});
