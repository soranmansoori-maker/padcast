$(".select_manager").select2()
    .on("select2:open", function () {
        $('.select2-results__options').niceScroll({
            cursorcolor: "rgb(181, 195, 206)",
            cursorwidth: "8px",
            autohidemode: false,
            rtlmode: true,
            horizrailenabled: false,
        });
    });

$(".select_manager").select2({
    templateResult: formatState,
    placeholder: "جستجو یا انتخاب کاربر",
});

$(".select-members-multiple").select2({
    dir: "rtl",
    dropdownAutoWidth: true,
    dropdownParent: $('#parent'),
    templateResult: formatState2,
    placeholder: "جستجو یا انتخاب کاربر",
});


function formatState(opt) {
    if (!opt.id) {
        return opt.text.toUpperCase();
    }
    var role = $(opt.element).attr('data-role');
    if (role === '0') {
        userRole = 'کاربر';
        style = 'secondary';
    } else {
        userRole = 'مدیر';
        style = 'success';
    }
    var managerimg = $(opt.element).attr('data-img');
    if (!managerimg) {
        return opt.text.toUpperCase();
    } else {
        var $opt = $(
            '<span><img style="border: 1px solid #9f9f9f;border-radius: 5px;" src="' + managerimg + '" width="40px" /> ' + opt.text.toUpperCase() + '</span>'+
            '<span class="badge badge-' + style + '" style="float: left; color: #fff" <b>' + userRole + '</b><span>'
        );
        return $opt;
    }

}

function formatState2(opt) {
    if (!opt.id) {
        return opt.text.toUpperCase();
    }
    var role = $(opt.element).attr('data-role');
    if (role === '0') {
        userRole = 'کاربر';
        style = 'secondary';
    } else {
        userRole = 'مدیر';
        style = 'success';
    }
    var managerimg = $(opt.element).attr('data-img');
    if (!managerimg) {
        return opt.text.toUpperCase();
    } else {
        var $opt = $(
            '<span><img style="border: 1px solid #9f9f9f;border-radius: 5px;" src="' + managerimg + '" width="40px" /> ' + opt.text.toUpperCase() + '</span>'+
            '<span class="badge badge-' + style + '" style="float: left; color: #fff" <b>' + userRole + '</b><span>'
        );
        return $opt;
    }

}
