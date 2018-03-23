// FUNQTIONS ON DOCUMENT LOAD
jQuery(document).ready(function($) {
    /* declare language */
    var language = config.language;

    var pathArray = window.location.pathname.split('/');
    var page = pathArray[1];
    var slug = decodeURIComponent(pathArray[3]);

    /* add languages to links */
    /*$('a').each(function(index, el) {
        if(!$(this).hasClass('subscribe') && !$(this).parent().hasClass('header-lang-box-dropdown') && $(this).attr('href') != 'javascript:void(0)') {
            if($(this).attr('href').indexOf('?') >= 0) {
                var link = $(this).attr('href')+"&lang="+language;
            } else {
                var link = $(this).attr('href')+"?lang="+language;
            }
            $(this).attr('href', link);
        }
    });*/

    /* moment init */
    if(language == 'ge') {
        language = 'ka';
    }
    moment.locale(language);

    // announcements - start date
    $('.announces-card-date').each(function(index, el) {
        var start_date = $(this).find('.start_date');
        var end_date = $(this).find('.end_date');
        var start_text = $(start_date).text();
        var end_text = $(end_date).text();

        $(start_date).empty();
        $(end_date).empty();
        $(start_date).append(moment(start_text).format('D MMMM') + ' - ');
        $(end_date).append(moment(end_text).format('D MMMM'));
    });

    var menuWrap = $('#menu-wrap');
    if(page == '' || page == 'home') {
        $(window).resize(function(event) {
            if($(window).width() > 767) {
                menuWrap.css('margin-bottom', '-' + menuWrap.height() + 'px');
            } else {
                menuWrap.css('margin-bottom', '0');
            }
        }).resize();
    }

    /* mobile menu */
    $('#mobile-menu-toggle').click(function(event) {
        $(this).find('i').toggle();
        menuWrap.slideToggle();
    });
    $('.menu-item-link.hassub').click(function(event) {
        event.preventDefault();
        $(this).next('.menu-sub-list').slideToggle();
    });


    /* search */
    $('#header-search-btn').click(function(event) {
        var that = this;
        if($(this).hasClass('show')) {
            $(that).find('i').toggle();
            $('#header-search-result-box, #header-search-result-box-m').hide();
            $('.header-search-box, .header-search-field-wrap, .header-search-btn').removeClass('show');
            $('#header-search-field').val('');
            $('.header-search-result-list').empty();
            $('.header-search-result-cat').hide();
        } else {
            $('#header-search-result-box, #header-search-result-box-m').show();
            $(this).find('i').toggle();
            $('.header-search-box, .header-search-field-wrap, .header-search-btn').addClass('show');
        }
    });
    $('#mobile-search-btn').click(function(event) {
        $('#header-search-result-box, #header-search-result-box-m').show();
        $('.header-search-box, .header-search-field-wrap, .header-search-btn').addClass('show');
    });
    $('#header-search-btn-close').click(function(event) {
        $('#header-search-result-box, #header-search-result-box-m').hide();
        $('.header-search-box, .header-search-field-wrap, .header-search-btn').removeClass('show');
    });
    // mobile toggle
    /*$('#mobile-search-btn, #search-close-m').click(function(event) {
        $('#header-search-m').fadeToggle();
        $('body').toggleClass('overflow-hidden');
    });*/

    // result
    $('.header-search-field').keyup(function(event) {
        $('.header-search-field').val($(this).val());
        var searchTerm = $(this).val();

        if (searchTerm.length > 2) {
            $.ajax({
                method: "POST",
                url: "/search_form/search",
                data: {
                    search: searchTerm,
                    lang: config.language
                }
            }).done(function(res) {
                if(res != 'error' && res != '') {
                    response = jQuery.parseJSON(res);

                    $('#header-search-news-results-count, #header-search-news-results-count-m').text(response.news.length);
                    $('#header-search-result-news-all, #header-search-result-news-all-m').attr('href', '/all_news?search=' + searchTerm);
                    if(response.news.length > 0) {
                        $('#header-search-news-results .header-search-result-list, #header-search-news-results-m .header-search-result-list').empty();
                        for (var i = response.news.length - 1; i >= 0; i--) {
                            searchTerm = searchTerm.replace(/(\s+)/, "(<[^>]+>)*$1(<[^>]+>)*");
                            var pattern = new RegExp("(" + searchTerm + ")", "gi");
                            var src_str = response.news[i]['title_' + config.language].replace(pattern, "<span>$1</span>");
                            src_str = src_str.replace(/(<span>[^<>]*)((<[^>]+>)+)([^<>]*<\/span>)/, "$1</span>$2<span>$4");
                            var row = "<li>" +
                                        "<i class='uk-icon-circle'></i>" +
                                        "<a href='/news/index/" + response.news[i]['slug_' + config.language] + "'>" + src_str + "</a>" +
                                      "</li>";
                            $('#header-search-news-results .header-search-result-list, #header-search-news-results-m  .header-search-result-list').append(row);
                        }
                        $('#header-search-news-results, #header-search-news-results-m').fadeIn();
                    } else {
                        $('#header-search-news-results, #header-search-news-results-m').fadeOut();
                    }

                    $('#header-search-pub-results-count, #header-search-pub-results-count-m').text(response.publications.length);
                    $('#header-search-result-pub-all, #header-search-result-pub-all-m').attr('href', '/all_news?search=' + searchTerm);
                    if(response.publications.length > 0) {
                        $('#header-search-pub-results .header-search-result-list, #header-search-pub-results-m .header-search-result-list').empty();
                        for (var i = response.publications.length - 1; i >= 0; i--) {
                            searchTerm = searchTerm.replace(/(\s+)/, "(<[^>]+>)*$1(<[^>]+>)*");
                            var pattern = new RegExp("(" + searchTerm + ")", "gi");
                            var src_str = response.publications[i]['title_' + config.language].replace(pattern, "<span>$1</span>");
                            src_str = src_str.replace(/(<span>[^<>]*)((<[^>]+>)+)([^<>]*<\/span>)/, "$1</span>$2<span>$4");
                            var row = "<li>" +
                                        "<i class='uk-icon-circle'></i>" +
                                        "<a href='/publication/" + response.publications[i]['slug_' + config.language] + "'>" + src_str + "</a>" +
                                      "</li>";
                            $('#header-search-pub-results .header-search-result-list, #header-search-pub-results-m  .header-search-result-list').append(row);
                        }
                        $('#header-search-pub-results, #header-search-pub-results-m').fadeIn();
                    } else {
                        $('#header-search-pub-results, #header-search-pub-results-m').fadeOut();
                    }
                }
            });
        }
    });

    /* color change B/W */
    $('#header-color-change').click(function(event) {
        $('*').toggleClass('makeitrain');
        if($(this).hasClass('clicked')) {
            $(this).removeClass('clicked');
            Cookies.set('makeitrain', '0');
        } else {
            $(this).addClass('clicked');
            Cookies.set('makeitrain', '1');
        }
    });

    if(Cookies.get('makeitrain') == '1') {
        $('#header-color-change').addClass('clicked');
        $('*').toggleClass('makeitrain');
    }

    /* font size change */
    $('#header-font-change').click(function(event) {
        if($(this).hasClass('clicked')) {
            $(this).removeClass('clicked');
            $('.fontchange').each(function() {
                var currentSize =  parseInt($(this).css('font-size')); 
                $(this).css('font-size', currentSize - 2);
                Cookies.set('fontchange', '0');
            });
        } else {
            $(this).addClass('clicked');
            $('.fontchange').each(function() {
                var currentSize =  parseInt($(this).css('font-size')); 
                $(this).css('font-size', currentSize + 2);
                Cookies.set('fontchange', '1');
            });
        }
    });

    if(Cookies.get('fontchange') == '1') {
        $('#header-font-change').addClass('clicked');
        $('.fontchange').each(function() {
            var currentSize =  parseInt($(this).css('font-size')); 
            $(this).css('font-size', currentSize + 2);
            Cookies.set('fontchange', '1');
        });
    }

    if($(window).width() < 768) {
        // element to detect scroll direction of
        var el = $(window),
        // initialize last scroll position
        lastY = el.scrollTop();
        el.on('scroll', function() {
            // get current scroll position
            var currY = el.scrollTop(),
            // determine current scroll direction
            y = (currY > lastY) ? 'down' : ((currY === lastY) ? 'none' : 'up');
            // do something here…
            if(y == 'down') {
                $('#mobile-widget').removeClass('show');
            } else if(y == 'up') {
                $('#mobile-widget').addClass('show');
            }
            // update last scroll position to current position
            lastY = currY;
        });
    }
    
    /* quiz */
    $('#fixed-quiz-toggler, #fixed-quiz-mobile-toggler').click(function(event) {
        $(this).find('i').toggle();
        $('#fixed-quiz-box').toggleClass('show');
        $('#fixed-quiz-question-box').toggleClass('show');
        $('#mobile-widget-dim').toggleClass('show');
        if($(window).width() < 768) {
            $('body').toggleClass('overflow-hidden');
        }
    });

    $('#mobile-widget-dim').click(function(event) {
        $('#fixed-quiz-mobile-toggler').click();
    });


    $('.fixed-quiz-answer-wrap').bind('click', function(event) {
        $('#fixed-quiz-answers').hide();
        $('#fixed-quiz-vote-counts').show();
    });

    $('input[name=poll]').click(function(e) {
        $(this).val(parseInt($(this).val())+1);
        var response_sum = parseInt($("#response_sum").val())+1;
        var selected_id = $(this).attr("data-id");
        var poll_id = $("#fixed-quiz-box").attr("data-id");
        $.ajax({
          method: "GET",
          url: "/Home/poll/" + selected_id + "/" + poll_id,
        }).done(function( msg ) {
            if(msg == 0) $(".fixed-quiz-box").remove();
            $('.fixed-quiz-vote-percent-box[data-id='+selected_id+']').addClass("chosen");
            $('input[name=poll]').each(function (e) {
                var data_id = $(this).attr("data-id");
                var prc = ($(this).val()*100/response_sum).toFixed(0);
                $('.fixed-quiz-vote-percent-box[data-id='+data_id+'] .uk-progress-bar').css("width",prc+'%');
                $('.fixed-quiz-vote-percent-box[data-id='+data_id+'] .uk-progress-bar span').html(prc+'%');
            });
        });

    });

    if($('#mini-clndr').length > 0) {
        $.ajax({
            type : 'POST',
            url : '/announcements/data',
            dataType: 'json',
            success : function(results) {
                // Go get event information and push into event array to display in calendar
                
                moment.locale(results[1]);

                var events = results[0];

                $('#mini-clndr').clndr({
                    template: $('#mini-clndr-template').html(),
                    events: events,
                    doneRendering: function (argument) {
                        $('.days-container .event span').addClass('calendar-day-row');
                    },
                    clickEvents: {
                        click: function(target) {
                            if(target.events.length) {
                                var daysContainer = $('#mini-clndr').find('.days-container');
                                daysContainer.toggleClass('show-events', true);
                                $('#mini-clndr').find('.x-button').click( function() {
                                daysContainer.toggleClass('show-events', false);
                              });
                            }
                            if(target.events.length == 0) 
                                return false;
                            var targetDate = target.events[0].date;
                            $("#mini-clndr .events .headers .event-header").html(moment(target.events[0].date).format('D MMMM'));

                            $("#mini-clndr .events-list .event").each(function() {
                                $(this).hide();
                            });
                            $("#mini-clndr .events-list ." + targetDate).each(function() {
                                $(this).show();
                            });
                        }
                    },
                    adjacentDaysChangeMonth: true,
                    forceSixRows: true
                });
            } // end success
        }); // end ajax
    }

    /* subscribe form */
    $('#subscribe-form-submit').click(function(event) {
        var email = $('#subscribe-form-email-field').val();
        var categories = [];
        $('.subscribe-form-checkbox-field').each(function(index, el) {
            if($(this).is(":checked")) {
                categories.push($(this).val());
            }
        });
        $.ajax({
            method: "POST",
            url: "/Subscribe_form/subscribe",
            data: {
                email: email,
                categories: categories
            }
        }).done(function(res) {
            if(res == 'email_false') {
                $('.subscribe-email-error').show();
                $('.subscribe-email-success, .subscribe-email-exists').hide();
            } else if(res == 'success') {
                $('.subscribe-email-exists, .subscribe-email-error').hide();
                $('.subscribe-email-success').show(function() {
                    setTimeout(function () {
                        UIkit.modal("#subscribe-form-modal").hide();
                    }, 1000);
                });
            } else if(res == 'email_exists') {
                $('.subscribe-email-exists').show();
                $('.subscribe-email-success, .subscribe-email-error').hide();
            } else {
                $('.subscribe-email-error').show();
                $('.subscribe-email-success, .subscribe-email-exists').hide();
            }
        });
    });

    /* toggle announces */
    $('#announce-changer').click(function(event) {
        $('#announces-list, .uk-icon-calendar, .uk-icon-list, #announces-calendar').toggle();
    });

    /* partners carousel */
    $('#partners-carousel').slick({
        lazyLoad: 'ondemand',
        swipe: true,
        infinite: true,
        slidesToShow: 5,
        slidesToScroll: 1,
        appendArrows: '#partners-carousel',
        prevArrow: "<div class='partners-nav left'><i class='uk-icon-chevron-left centerV'></i></div>",
        nextArrow: "<div class='partners-nav right'><i class='uk-icon-chevron-right centerV'></i></div>",
        responsive: [{
            breakpoint: 767,
            settings: {
                swipe: true,
                slidesToShow: 3,
                slidesToScroll: 1
            }
        }, {
            breakpoint: 479,
            settings: {
                swipe: true,
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }]
    });

    /* schools carousel */
    $('#schools-carousel').slick({
        lazyLoad: 'ondemand',
        swipe: true,
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        appendArrows: '#schools-carousel',
        prevArrow: "<div class='partners-nav left'><i class='uk-icon-chevron-left centerV'></i></div>",
        nextArrow: "<div class='partners-nav right'><i class='uk-icon-chevron-right centerV'></i></div>",
        responsive: [{
            breakpoint: 767,
            settings: {
                swipe: true,
                slidesToShow: 2,
                slidesToScroll: 1
            }
        }, {
            breakpoint: 479,
            settings: {
                swipe: true,
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }]
    });

    /* news cards */
    var news_card = $('.news-card');
    var news_card_hover = $('.news-card-title, .news-card-img');
    news_card_hover.hover(function() {
    	$(this).parents('.news-card').addClass('hover');
    }, function() {
    	news_card.removeClass('hover');
    });
    var news_card_title = $('.news-card-title a');
    news_card_title.trunk8({
       lines: 3
    });
    $('.news-card-date').each(function(index, el) {
        var oldDate = $(this).text();
        $(this).empty();
        $(this).append(moment(oldDate).format('D MMMM'));
    });

    /* personal cards */
    var personal_card = $('.personal-card');
    var personal_card_subtitle = $('.personal-card-subtitle span');
    var personal_card_hover = $('.personal-card-title a, .personal-card-img');
    personal_card_hover.hover(function() {
        $(this).parents('.personal-card').addClass('hover');
    }, function() {
        personal_card.removeClass('hover');
    });
    personal_card_subtitle.trunk8({
       lines: 2
    });

    /* select2 init */
    $(".select2").select2({
        minimumResultsForSearch: Infinity
    });

    /* datepicker */
    if ($('#datepicker').length > 0) {
    	var datepickerLangs;
    	if(language == 'ru') {
    		datepickerLangs = {
                months: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
                weekdays: ['ВСК', 'ПНД', 'ВТР', 'СРД', 'ЧТВ', 'ПТН', 'СБТ']
            }
    	} else if(language == 'en') {
    		datepickerLangs = {
                months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                weekdays: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
            }
    	} else if(language == 'fa') {
            datepickerLangs = {
                months: ['ژانویه','فوریه','مارس','آوریل','مه','ژوئن','ژوئیه','اوت','سپتامبر','اکتبر','نوامبر','دسامبر'],
                weekdays: ['ژانویه','فوریه','مارس','آوریل','مه','ژوئن','ژوئیه','اوت','سپتامبر','اکتبر','نوامبر','دسامبر']
            }
        } else {
    		datepickerLangs = {
                months: ['იანვარი', 'თებერვალი', 'მარტი', 'აპრილი', 'მაისი', 'ივნისი', 'ივლისი', 'აგვისტო', 'სექტემბერი', 'ოქტომბერი', 'ნოემბერი', 'დეკემბერი'],
                weekdays: ['კვ', 'ორშ', 'სამ', 'ოთხ', 'ხუთ', 'პარ', 'შაბ']
            }
    	}
    	var datepicker = UIkit.datepicker($('#datepicker'), {
            format: 'YYYY-MM-DD',
            i18n: datepickerLangs,
            minDate: '2010-01-01',
            maxDate: (new Date()).getFullYear()+'-12-31'
        });
    }

    // all news filtering
    if(page == 'all_news') {
        var newsSearchFilter = $('#news-search-filter');
        var newsFilterCat = $('#news-filter-cat');
        var newsChosenCat = $('#news-chosen-cat');
        var newsDatepicker = $('#datepicker');
        var template = $('#template').html();
        var loadNewsCards = $('#load-news-cards');
        var cardsLoader = $('#cards-loader');
        var nodata = $('#nodata');
        var newsOffset = 0;
        var disableLoadMore = false;

        var url = new URL(window.location.href);
        var newsFilterCatGet = url.searchParams.get("cat");

        newsSearchFilter.keyup(function(event) {
            if (event.keyCode == 27) {
                newsSearchFilter.val('');
            }
            newsFilter();
        });

        newsFilterCat.change(function(event) {
            if($("#news-filter-cat option:selected").val() != '') {
                newsChosenCat.text('- '+$("#news-filter-cat option:selected").text());
            } else {
                newsChosenCat.text('');
                newsFilterCatGet = '';
            }
            newsFilter();
        });

        newsDatepicker.change(function(event) {
            newsFilter();
        });

        newsDatepicker.keyup(function(event) {
            newsFilter();
        });

        if($(window).width() > 767) {
            var nearBottom = 50;
        } else {
            var nearBottom = 150;
        }

        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() > $(document).height() - nearBottom) {
                if(!disableLoadMore) {
                    newsFilter(true);
                }
            }
        });

        function newsFilter(more) {
            if(more) {
                if(!disableLoadMore) {
                    newsOffset = newsOffset + 15;
                }
            } else {
                loadNewsCards.empty();
                newsOffset = 0;
                disableLoadMore = false;
            }
            cardsLoader.show();
            $.ajax({
                url: '/all_news/filter',
                type: 'POST',
                data: {
                    lang: config.language,
                    newsOffset: newsOffset,
                    newsSearchFilter: $(newsSearchFilter).val(),
                    newsFilterCat: $(newsFilterCat).val(),
                    newsFilterCatGet: newsFilterCatGet,
                    newsDatepicker: $(newsDatepicker).val()
                },
            }).done(function(res) {
                var response = jQuery.parseJSON(res);

                response.forEach(function(element, index) {
                    if(element.category) {
                        element.category = element.category.split(',');
                    }
                    let D = '<div>' + moment(element.date).format('D') + '</div>';
                    let MMM = '<div>' + moment(element.date).format('MMM') + '</div>';
                    element.date = D + MMM;
                });

                if(!more) {
                    loadNewsCards.empty();
                    disableLoadMore = false;
                }
                
                var rendered = Mustache.to_html(template, { data: response });
                loadNewsCards.append(rendered);

                $('.news-card-title, .news-card-img').hover(function() {
                    $(this).parents('.news-card').addClass('hover');
                }, function() {
                    $('.news-card').removeClass('hover');
                });
                $('.news-card-title a').trunk8({
                   lines: 3
                });

                if(response.length == 0) {
                    disableLoadMore = true;
                    if(newsOffset == 0) {
                        loadNewsCards.empty();
                        nodata.appendTo(loadNewsCards).show();
                    }
                } else {
                    disableLoadMore = false;
                    nodata.hide();
                }
                cardsLoader.hide();
            });
        }

        newsFilter();
    }

    // personal filtering
    if(page == 'personal') {
        var personalSearchFilter = $('#personal-search-filter');
        var personalFilterRank = $('#personal-filter-rank');
        var personalFilterFaculty = $('#personal-filter-faculty');
        var personalChosenFac = $('#personal-chosen-fac');
        var template = $('#template').html();
        var loadPersonalCards = $('#load-personal-cards');
        var cardsLoader = $('#cards-loader');
        var nodata = $('#nodata');
        var personalOffset = 0;
        var disableLoadMore = false;

        personalSearchFilter.keyup(function(event) {
            if (event.keyCode == 27) {
                personalSearchFilter.val('');
            }
            personalFilter();
        });

        personalFilterRank.change(function(event) {
            if($("#personal-filter-rank option:selected").val() != '') {
                personalChosenFac.text('- '+$("#personal-filter-rank option:selected").text());
            } else {
                personalChosenFac.text('');
            }
            personalFilter();
        });

        personalFilterFaculty.change(function(event) {
            if($("#personal-filter-faculty option:selected").val() != '') {
                personalChosenFac.text('- '+$("#personal-filter-faculty option:selected").text());
            } else {
                personalChosenFac.text('');
            }
            personalFilter();
        });

        if($(window).width() > 767) {
            var nearBottom = 50;
        } else {
            var nearBottom = 150;
        }

        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() > $(document).height() - nearBottom) {
                if(!disableLoadMore) {
                    personalFilter(true);
                }
            }
        });

        function personalFilter(more) {
            if(more) {
                if(!disableLoadMore) {
                    personalOffset = personalOffset + 15;
                }
            } else {
                loadPersonalCards.empty();
                personalOffset = 0;
            }
            cardsLoader.show();
            $.ajax({
                url: '/personal/filter',
                type: 'POST',
                data: {
                    lang: config.language,
                    personalOffset: personalOffset,
                    personalSearchFilter: $(personalSearchFilter).val(),
                    personalFilterRank: $(personalFilterRank).val(),
                    personalFilterFaculty: $(personalFilterFaculty).val()
                },
            }).done(function(res) {
                var response = jQuery.parseJSON(res);

                response.forEach(function(element, index) {
                    if(element.category) {
                        element.category = element.category.split(',');
                    }
                    let D = '<div>' + moment(element.date).format('D') + '</div>';
                    let MMM = '<div>' + moment(element.date).format('MMM') + '</div>';
                    element.date = D + MMM;
                });

                if(!more) {
                    loadPersonalCards.empty();
                    disableLoadMore = false;
                }
                
                var rendered = Mustache.to_html(template, { data: response });

                loadPersonalCards.append(rendered);

                if(response.length == 0) {
                    disableLoadMore = true;
                    if(personalOffset == 0) {
                        loadPersonalCards.empty();
                        nodata.appendTo(loadPersonalCards).show();
                    }
                } else {
                    disableLoadMore = false;
                    nodata.hide();
                }
                cardsLoader.hide();
                
                $('.personal-card-title a, .personal-card-img').hover(function() {
                    $(this).parents('.personal-card').addClass('hover');
                }, function() {
                    $('.personal-card').removeClass('hover');
                });
                $('.personal-card-subtitle span').trunk8({
                   lines: 2
                });
            });
        }

        personalFilter();
    }
});

// share on facebook
function fbShare() {
    var url = window.location.href;
    FB.ui({
        method: 'share',
        href: url
    });
}

// print div
function printDiv(elem) {
    var mywindow = window.open('', 'PRINT');

    mywindow.document.write('<html><head><title>' + document.title  + '</title>');
    mywindow.document.write('</head><body >');
    mywindow.document.write('<h1>' + document.title  + '</h1>');
    mywindow.document.write(document.getElementById(elem).innerHTML);
    mywindow.document.write('</body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/

    mywindow.print();
    mywindow.close();

    return true;
}