/**
 * HOMER - Responsive Admin Theme
 * version 1.9
 *
 */

$(document).ready(function () {

    // Add special class to minimalize page elements when screen is less than 768px
    setBodySmall();

    // Handle minimalize sidebar menu
    $('.hide-menu').on('click', function(event){
        event.preventDefault();
        if ($(window).width() < 769) {
            $("body").toggleClass("show-sidebar");
        } else {
            $("body").toggleClass("hide-sidebar");
        }
    });

    // Initialize metsiMenu plugin to sidebar menu
    $('#side-menu').metisMenu();

    // Initialize iCheck plugin
    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green'
    });

    // Initialize animate panel function
    $('.animate-panel').animatePanel();

    // Function for collapse hpanel
    $('.showhide').on('click', function (event) {
        event.preventDefault();
        var hpanel = $(this).closest('div.hpanel');
        var icon = $(this).find('i:first');
        var body = hpanel.find('div.panel-body');
        var footer = hpanel.find('div.panel-footer');
        body.slideToggle(300);
        footer.slideToggle(200);

        // Toggle icon from up to down
        icon.toggleClass('fa-chevron-up').toggleClass('fa-chevron-down');
        hpanel.toggleClass('').toggleClass('panel-collapse');
        setTimeout(function () {
            hpanel.resize();
            hpanel.find('[id^=map-]').resize();
        }, 50);
    });

    // Function for close hpanel
    $('.closebox').on('click', function (event) {
        event.preventDefault();
        var hpanel = $(this).closest('div.hpanel');
        hpanel.remove();
        if($('body').hasClass('fullscreen-panel-mode')) { $('body').removeClass('fullscreen-panel-mode');}
    });

    // Fullscreen for fullscreen hpanel
    $('.fullscreen').on('click', function() {
        var hpanel = $(this).closest('div.hpanel');
        var icon = $(this).find('i:first');
        $('body').toggleClass('fullscreen-panel-mode');
        icon.toggleClass('fa-expand').toggleClass('fa-compress');
        hpanel.toggleClass('fullscreen');
        setTimeout(function() {
            $(window).trigger('resize');
        }, 100);
    });

    // Open close right sidebar
    $('.right-sidebar-toggle').on('click', function () {
        $('#right-sidebar').toggleClass('sidebar-open');
    });

    // Function for small header
    $('.small-header-action').on('click', function(event){
        event.preventDefault();
        var icon = $(this).find('i:first');
        var breadcrumb  = $(this).parent().find('#hbreadcrumb');
        $(this).parent().parent().parent().toggleClass('small-header');
        breadcrumb.toggleClass('m-t-lg');
        icon.toggleClass('fa-arrow-up').toggleClass('fa-arrow-down');
    });

    // Set minimal height of #wrapper to fit the window
    setTimeout(function () {
        fixWrapperHeight();
    });

    // Initialize tooltips
    $('.tooltip-demo').tooltip({
        selector: "[data-toggle=tooltip]"
    });

    // Initialize popover
    $("[data-toggle=popover]").popover();

    // Move modal to body
    // Fix Bootstrap backdrop issu with animation.css
    $('.modal').appendTo("body");

    // DatePicker
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        todayHighlight: true
    });

    // DateTimePicker
    $('#datetimepicker').datetimepicker({
        defaultDate: moment().format("YYYY-MM-DD HH:mm"),
        format: 'YYYY-MM-DD HH:mm'
    });
    $('#datetimepicker2').datetimepicker({
        format: 'YYYY-MM-DD HH:mm'
    });

    deleteItem();

    // Toastr options
    toastr.options = {
        "debug": false,
        "newestOnTop": false,
        "positionClass": "toast-top-center",
        "closeButton": true,
        "toastClass": "animated fadeInDown",
    };

    // init CKEditor
    if($('.editor').length > 0) {
        $('.editor').each(function(index, el) {
            var editor = CKEDITOR.replace(this.id, {
                height: 250,
                allowedContent: true,
                filebrowserBrowseUrl: '/kcfinder/browse.php?opener=ckeditor&type=files',
                filebrowserImageBrowseUrl: '/kcfinder/browse.php?opener=ckeditor&type=images',
                filebrowserFlashBrowseUrl: '/kcfinder/browse.php?opener=ckeditor&type=flash',
                filebrowserUploadUrl: '/kcfinder/upload.php?opener=ckeditor&type=files',
                filebrowserImageUploadUrl: '/kcfinder/upload.php?opener=ckeditor&type=images',
                filebrowserFlashUploadUrl: '/kcfinder/upload.php?opener=ckeditor&type=flash'
            });
        });
    }

    if($('.select-icon').length > 0) {
        jQuery.ajax({
            type: "GET",
            url: config.base_url + "admin/social_icons/read_icons",
            success: function (res) {
                var icon_names = res.data.split(",");
                for (var i = icon_names.length - 1; i >= 0; i--) {
                    $('.select-icon').append('<option>' + icon_names[i] + '</option>')
                }
            },
            error: function (res) {
                alert('მოხდა შეცდომა! გთხოვთ ცადოთ ხელახლა!')
            }
        });
        function formatState(state) {
            if (!state.id) { return state.text; }
            var $state = $(
                '<span><i class="fa ' + state.element.value.toLowerCase() + '"></i> ' + state.text + '</span>'
            );
            return $state;
        };
        var $eventSelect = $('.select-icon').select2({
            placeholder: 'აირჩიეთ',
            templateResult: formatState
        });
    }

    if($('.select-cats').length > 0) {
        var $eventSelect = $('.select-cats').select2({
            placeholder: "აირჩიეთ კატეგორია",
            allowClear: true,
            ajax: {
                url: config.base_url + 'admin/news/read_cats',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        search: params.term
                    };
                },
                processResults: function(data) {
                    return {
                        results: data
                    };
                },
                cache: false
            }
        });
    }

    if($(".js-select").length > 0) {
        $(".js-select").select2();
    }

    // delete album images
    $('.item .pe').click(function(event) {
        $('#paths').val($('#paths').val().replace(',' + $(this).attr('data-path'), ''));
        $('#paths').val($('#paths').val().replace($(this).attr('data-path') + ',', ''));
        $('#paths').val($('#paths').val().replace($(this).attr('data-path'), ''));
        $(this).parents('.item').remove();
    });

    albumImagesSort();

    // menu type choosing
    $('.type-box input').click(function(event) {
        if(!$(this).hasClass('active')) {
            $('.' + $(this).attr('name')).slideToggle();
            $(this).parents('.type-box').find('input').removeClass('active');
            $(this).addClass('active');
        }
    });

    // forms validation
    $.validate({
        modules : 'html5, security',
        onModulesLoaded : function() {
            var optionalConfig = {
                fontSize: '12pt',
                padding: '4px 6px',
                bad : 'Very bad',
                weak : 'Weak',
                good : 'Good',
                strong : 'Strong'
            };
            $('input[name="newpassword"]').displayPasswordStrength(optionalConfig);
        }
    });

});

// delete function
function deleteItem() {
    $('.delete').click(function() {
        var btn = $(this);
        swal({
            title: "დარწმუნებული ხართ?",
            text: "წაშლილი ჩანაწერის აღდგენას ვეღარ შეძლებთ!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "დიახ, წაშლა!",
            cancelButtonText: "არა, გაუქმება!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function (isConfirm) {
            if (isConfirm) {
                swal("წაშლილია!", "ჩანაწერი წარმატებით წაიშალა.", "success");
                document.location.href = btn.attr('data-link');
            } else {
                swal("გაუქმებულია", "ჩანაწერის წაშლა გაუქმებულია :)", "error");
            }
        });
    });
}

// init KCFinder
function openFileManagerForFiles(id) {
    window.KCFinder = {
        callBack: function(url) {
            document.getElementById(id).value = url;
            window.KCFinder = null;
        }
    };
    window.open('/kcfinder/browse.php?type=files&dir=uploads/files', 'kcfinder_textbox',
        'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
        'resizable=1, scrollbars=0, width=800, height=600'
    );
}

function openFileManager(id) {
    window.KCFinder = {
        callBack: function(url) {
            document.getElementById(id).value = url;
            window.KCFinder = null;
        }
    };
    window.open('/kcfinder/browse.php?type=images&dir=uploads/images', 'kcfinder_textbox',
        'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
        'resizable=1, scrollbars=0, width=800, height=600'
    );
}

function openMultiple(id) {
    window.KCFinder = {
        callBackMultiple: function(files) {
            window.KCFinder = null;
            id = '#' + id;
            for (var i = 0; i < files.length; i++) {
                if($(id).val().indexOf("," + files[i] + ",") >= 0 || $(id).val().indexOf("," + files[i]) >= 0 || $(id).val().indexOf(files[i] + ",") >= 0) {
                    console.log('dublicate!');
                } else {
                    if($(id).val().length > 0) {
                        $(id).val($(id).val() + ',' + files[i]);
                    } else {
                        $(id).val(files[i]);
                    }
                    var img = '<div class="item">' +
                            '<a href="' + files[i] + '" data-gallery><img src="' + files[i] + '"></a>' +
                            '<span data-path="' + files[i] + '" class="pe pe-7s-close-circle text-danger"></span>' +
                        '</div>';
                    $('#albumImages').append(img);
                }
            }
            $('.item .pe').click(function(event) {
                $(id).val($(id).val().replace(',' + $(this).attr('data-path'), ''));
                $(id).val($(id).val().replace($(this).attr('data-path') + ',', ''));
                $(id).val($(id).val().replace($(this).attr('data-path'), ''));
                $(this).parents('.item').remove();
            });
            albumImagesSort();
        }
    };
    window.open('/kcfinder/browse.php?type=images&dir=uploads/images',
        'kcfinder_multiple', 'status=0, toolbar=0, location=0, menubar=0, ' +
        'directories=0, resizable=1, scrollbars=0, width=800, height=600'
    );
}

function albumImagesSort() {
    $('#albumImages').sortable({
        items: '.item',
        stop: function(evt, ui) {
            $('#paths').val('');
            $('.item').each(function(index, el) {
                if($('#paths').val().length > 0) {
                    $('#paths').val($('#paths').val() + ',' + $(this).find('img').attr('src'));
                } else {
                    $('#paths').val($(this).find('img').attr('src'));
                }
            });
        }
    });
}

$(window).bind("resize click", function () {

    // Add special class to minimalize page elements when screen is less than 768px
    setBodySmall();

    // Waint until metsiMenu, collapse and other effect finish and set wrapper height
    setTimeout(function () {
        fixWrapperHeight();
    }, 300);
});

function fixWrapperHeight() {

    // Get and set current height
    var headerH = 62;
    var navigationH = $("#navigation").height();
    var contentH = $(".content").height();

    // Set new height when contnet height is less then navigation
    if (contentH < navigationH) {
        $("#wrapper").css("min-height", navigationH + 'px');
    }

    // Set new height when contnet height is less then navigation and navigation is less then window
    if (contentH < navigationH && navigationH < $(window).height()) {
        $("#wrapper").css("min-height", $(window).height() - headerH  + 'px');
    }

    // Set new height when contnet is higher then navigation but less then window
    if (contentH > navigationH && contentH < $(window).height()) {
        $("#wrapper").css("min-height", $(window).height() - headerH + 'px');
    }
}


function setBodySmall() {
    if ($(this).width() < 769) {
        $('body').addClass('page-small');
    } else {
        $('body').removeClass('page-small');
        $('body').removeClass('show-sidebar');
    }
}

// Animate panel function
$.fn['animatePanel'] = function() {

    var element = $(this);
    var effect = $(this).data('effect');
    var delay = $(this).data('delay');
    var child = $(this).data('child');

    // Set default values for attrs
    if(!effect) { effect = 'zoomIn'}
    if(!delay) { delay = 0.06 } else { delay = delay / 10 }
    if(!child) { child = '.row > div'} else {child = "." + child}

    //Set defaul values for start animation and delay
    var startAnimation = 0;
    var start = Math.abs(delay) + startAnimation;

    // Get all visible element and set opacity to 0
    var panel = element.find(child);
    panel.addClass('opacity-0');

    // Get all elements and add effect class
    panel = element.find(child);
    panel.addClass('stagger').addClass('animated-panel').addClass(effect);

    var panelsCount = panel.length + 10;
    var animateTime = (panelsCount * delay * 10000) / 10;

    // Add delay for each child elements
    panel.each(function (i, elm) {
        start += delay;
        var rounded = Math.round(start * 10) / 10;
        $(elm).css('animation-delay', rounded + 's');
        // Remove opacity 0 after finish
        $(elm).removeClass('opacity-0');
    });

    // Clear animation after finish
    setTimeout(function(){
        $('.stagger').css('animation', '');
        $('.stagger').removeClass(effect).removeClass('animated-panel').removeClass('stagger');
    }, animateTime)

};