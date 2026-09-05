'use strict';

function showSuccessMessage(msg) {
    swal({
        title: "انجام شد!",
        text: msg,
        type: "success",
        confirmButtonText: "بستن",
    });
}

function showErrorMessage(msg) {
    swal({
        title: "خطا!",
        text: msg,
        type: "error",
        confirmButtonText: "بستن",
    });
}


function showFiledMessage(msg) {
    swal({
        title: "خطا در حذف دسته بندی!",
        text: msg,
        type: "error",
        confirmButtonText: "بستن",
    });
}

function showConfirmUser(id, content) {
    swal({
        title: "آیا از حذف کاربر " + "(" + content + ")" + " مطمئن هستید؟",
        text: "با حذف این شخص تمامی اطلاعات وی از بانک اطلاعاتی حذف خواهد شد!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "بله، حذف شود!",
    }, function () {
        $('#delete-user-'+id).submit();
    });
}

function showConfirmItemMessage(id, content) {
    swal({
        title: "آیا از حذف آیتم  (" + content + ") مطمئن هستید؟",
        text: "این اقدام قابل برگشت نخواهد بود!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "بله، حذف شود!",
    }, function () {
        $('#delete-item-'+id).submit();
    });
}
