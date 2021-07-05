$( document ).on('ready', function () {
    'use strict';

    function confirmation() {
        return confirm(CONFIRMATION_MSG)
    }

    $('.confirm').click(function () {
        event.preventDefault();
        if(confirmation() === true) {
            $(this).parent().submit();
        }
    });

    $('.btnDeleteAll').click(function () {
        event.preventDefault();
        if(confirmation() === true) {
            $('#deletesData').submit();
        }
    });

    $('.confirmDeleteItem').click(function () {
        const Self = $(this);
        event.preventDefault();
        if(confirmation() === true) {
            $('#delete-form').prop('action', Self.data('id')).submit();
        }
    });


    $('.confirmRestoreItem').click(function () {
        const Self = $(this);
        event.preventDefault();
        if(confirmation() === true) {
            $('#restore-form').prop('action', Self.data('id')).submit();
        }
    });

    $('.BtnStatus').click(function () {
        const Self = $(this);
        event.preventDefault();
        if(confirmation() === true) {
            $('#statusForm').prop('action', Self.data('id')).submit();
        }
    });

    $('.btn_confirm').click(function (e) {
        e.preventDefault();
        if(confirmation() === true) {
            // Here Code
            $(this).parent().submit();
        }
    });

    // Check box select in table
    $(document).on('click', '#DataSelect', function () {
        const roleCheck = $('.DataCheckBox');
        if($('#DataSelect').parents('.table').find("tbody input:not(:disabled)").length) {
            if ($('#DataSelect').prop('checked') === true) {
                roleCheck.prop('checked', true);
                $('.btnDeleteAll').css('display', 'block');
            } else {
                roleCheck.prop('checked', false);
                $('.btnDeleteAll').css('display', 'none');
            }
        } else {
            $('#DataSelect').prop('checked', false);
        }
    });

    $(document).on('click', '.DataCheckBox', function () {
        if($(this).parents('tbody').find('.DataCheckBox:checked').length > 0) {
            $('.btnDeleteAll').css('display', 'block');
        } else {
            $('.btnDeleteAll').css('display', 'none');
        }
    });

    $('.IntVal').bind('keyup change', function () {
        $(this).val(Math.abs($(this).val()));
    });
    $('.numericValue').bind('keyup change', function () {
    });

    if ($(".preview_images").length > 0) {
        $('.preview_images').magnificPopup({delegate: 'a', type: 'image', gallery: {enabled: true}});
    }

    if ($(".preview_images_pro").length > 0) {
        $('.preview_images_pro').magnificPopup({delegate: 'a', type: 'image', gallery: {enabled: true}});
    }

    if ($(".open_img").length > 0) {
        $('.open_img').magnificPopup({delegate: 'a',type: 'image'});
    }

    $('#select_permissions').click(function () {
        if($(this).prop('checked') === true) {
            $('.checked_permission').prop('checked', true);
        } else {
            $('.checked_permission').prop('checked', false);
        }
    });

    $(document).on('click', '.selectBoxPermission', function () {
        var Self = $(this);
        var Children = Self.parents('.panel-default').find('.checked_permission');
        if(Self.prop('checked') === true) {
            Children.prop('checked', true);
        } else {
            Children.prop('checked', false);
        }
    });

    $('#textName').on('change keyup keypress', function(event) {
        $('#textDisplay').empty();
        $('#textDisplay').html($(this).val());
        getSetHeight('#name_height', '#textDisplay');
        var ew = event.which;
        if(ew == 32)
            return true;
        if(48 <= ew && ew <= 57)
            return true;
        if(65 <= ew && ew <= 90)
            return true;
        if(97 <= ew && ew <= 122)
            return true;
        return false;
    });


    $('#searchForm').submit(function () {
        $(this)
            .find('input[name], select[name]')
            .filter(function () {
                return !this.value;
            })
            .prop('name', '');
    });

});

/****************************************************
 * Icons
 ***************************************************/
$('#changeIconSize').on('keyup change', function () {
    $(this).val(Math.abs($(this).val()));
    if($(this).val() > 100) {
        $(this).val(100);
    }
    if($(this).val() < 40) {
        $(this).val(40)
    }
    $('.icons_table .icon_shape i').css('font-size', $(this).val() + 'px');
});

$('.icon_box').click(function () {
    copyToClipboard($(this));
});

function copyToClipboard(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val(element.data('content')).select();
    document.execCommand("copy");
    $temp.remove();
    element.append("<span>تم النسخ بنجاح</span>");
    setTimeout(function () {
        element.find('span').remove();
    }, 1000);
}
//
//
// $(window).on('load', function () {
//
//     // $('#name_height').val($('#textDisplay').height());
// });
