// JavaScript Document
let ajaxLoading = false;
let ajaxLoadingIssue = false;
let ajaxLoadingUsers = false;
let ajaxLoadingUsersEdit = false;
let ajaxStaffDetailsView = false;
let ajaxRegisterNewUser= false;
let ajaxEditProgramme=false;



$(document).ready(function() {

    //Create New User Pop up Window with Ajax jquery
    $(document).on('click', '.reg_user', function (e) {
        $("#loader_httpFeed").show();
        
        if (!ajaxRegisterNewUser) {

            ajaxRegisterNewUser = true;
            $.ajax({
                type: "POST",
                url: "view/users/register",
                cache: false,
                success: function (msg) {
                    $("#loader_httpFeed").hide();
                    new top.PopLayer({
                        "title": "Create New User",
                        "content": msg
                    });
                    ajaxRegisterNewUser = false;
                },
                error: function (xhr) {
                    if (xhr.status == 404) {
                        $("#loader_httpFeed").hide();
                        dalert.alert("internet connection working");
                    } else {
                        $("#loader_httpFeed").hide();
                        dalert.alert("internet is down");
                    }
                }
            });
        }
        e.preventDefault();
    })

     //Inbox Compose form Pop up Window with Ajax jquery
     $(document).on('click', '.composer_box', function (e) {
        $("#loader_httpFeed").show();
        
        if (!ajaxRegisterNewUser) {

            ajaxRegisterNewUser = true;
            $.ajax({
                type: "POST",
                url: "view/events/compose",
                cache: false,
                success: function (msg) {
                    $("#loader_httpFeed").hide();
                    new top.PopLayer({
                        "title": "Compose Message",
                        "content": msg
                    });
                    ajaxRegisterNewUser = false;
                },
                error: function (xhr) {
                    if (xhr.status == 404) {
                        $("#loader_httpFeed").hide();
                        dalert.alert("internet connection working");
                    } else {
                        $("#loader_httpFeed").hide();
                        dalert.alert("internet is down");
                    }
                }
            });
        }
        e.preventDefault();
    })


    //Create Campus Pop up Window with Ajax jquery
    $(document).on('click', '.reg_campus', function () {
        $("#loader_httpFeed").show();
        if (!ajaxLoadingUsers) {

            ajaxLoadingUsers = true;
            $.ajax({
                type: "POST",
                url: "view/departments/create",
                cache: false,
                success: function (msg) {
                    $("#loader_httpFeed").hide();
                    new top.PopLayer({
                        "title": "Create Dept",
                        "content": msg
                    });
                    ajaxLoadingUsers = false;
                }
            });
        }
    })

    //Update Campus Pop up Window with Ajax jquery
    $(document).on('click', '.edit_campus', function () {
        $("#loader_httpFeed").show();
        let name = $(this).attr("lang");
        let id = $(this).attr("id");


        if (!ajaxLoadingUsers) {
           
            ajaxLoadingUsers = true;
            $.ajax({
                type: "POST",
                url: "view/departments/update",
                data: {
                    campus_id:id
                },
                cache: false,
                success: function (msg) {
                    $("#loader_httpFeed").hide();
                    new top.PopLayer({
                        "title": `Update Dept -> ${name.toUpperCase()}`,
                        "content": msg
                    });
                    ajaxLoadingUsers = false;
                }
            });
        }
    })


    //Update User Pop up Window with Ajax jquery
    $(document).on('click', '.edit_user', function () {
        $("#loader_httpFeed").show();
        let username = $(this).attr("lang");
        let id = $(this).attr("id");


        if (!ajaxLoadingUsers) {

            ajaxLoadingUsers = true;
            $.ajax({
                type: "POST",
                url: "view/users/update_user",
                data: {
                    user_id: id
                },
                cache: false,
                success: function (msg) {
                    $("#loader_httpFeed").hide();
                    new top.PopLayer({
                        "title": `Update User -> ${username.toUpperCase()}`,
                        "content": msg
                    });
                    ajaxLoadingUsers = false;
                },
                error: function (xhr) {
                    if (xhr.status == 404) {
                        $("#loader_httpFeed").hide();
                        dalert.alert("internet connection working");
                    } else {
                        $("#loader_httpFeed").hide();
                        dalert.alert("internet is down");
                    }
                }
            });
        }
    })


    //Update Programme Pop up Window with Ajax jquery
    $(document).on('click', '.edit_crop_type', function () {
        $("#loader_httpFeed").show();
        let category = $(this).attr("lang");
        let id = $(this).attr("id");


        if (!ajaxEditProgramme) {

            ajaxEditProgramme = true;
            $.ajax({
                type: "POST",
                url: "view/crops/edit_crop",
                data: {
                    id: id
                },
                cache: false,
                success: function (msg) {
                    $("#loader_httpFeed").hide();
                    new top.PopLayer({
                        "title": `Update Programme -> ${category.toUpperCase()}`,
                        "content": msg
                    });
                    ajaxEditProgramme = false;
                },
                error: function (xhr) {
                    if (xhr.status == 404) {
                        $("#loader_httpFeed").hide();
                        dalert.alert("internet connection working");
                    } else {
                        $("#loader_httpFeed").hide();
                        dalert.alert("internet is down");
                    }
                }
            });
        }
    })

});


