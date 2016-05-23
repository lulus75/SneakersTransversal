$(function () {

    var Brand = '.searchFilterBrand';
    var Condition = '.searchFilterCondition';
    var Color = '.searchFilterColor';
    var Price = '.searchFilterPrice';
    var Size = '.searchFilterSize';

    $('.nav-icon1,#nav-icon2,.nav-icon3,#nav-icon4').click(function () {
        $(this).toggleClass('open');
    });

    $('.choiceConn').click(function () {
        $('.choiceConn').removeClass('choiceNotCurrent').addClass('choiceCurrent');
        $('.choiceInscr').removeClass('choiceCurrent').addClass('choiceNotCurrent');
        $('.accountSignUp').css('display', 'none');
        $('.accountSignIn').css('display', 'inline-block');
    });

    $('.choiceInscr').click(function () {
        $('.choiceInscr').removeClass('choiceNotCurrent').addClass('choiceCurrent');
        $('.choiceConn').removeClass('choiceCurrent').addClass('choiceNotCurrent');
        $('.accountSignIn').css('display', 'none');
        $('.accountSignUp').css('display', 'inline-block');
    });

    $('.headerBrandName li').clone().appendTo($('.searchFilterBrandList'));

    var trueMenu = true;
    $('.onClick').click(function () {
        if (trueMenu === true) {
            $('#c-menu--slide-left').animate({width:'toggle'},350);;
            $('body').addClass('stop-scrolling');
            trueMenu = false;
        }
        else {
            $('#c-menu--slide-left').animate({width:'hide'},350);;
            $('body').removeClass('stop-scrolling');
            trueMenu = true;
        }
    });

    $('.headerSearch').click(function () {
        if (trueMenu === true) {
            $('.headerBrandName').animate({opacity: 0.0}, 0, function () {
                $(this).css("display", "none");
            });
            $('.headerSearchForm').appendTo($('.headerBrand')).css({
                display: "inline-block",
                opacity: 0.0
            }).animate({opacity: 1.0}, 400);
            trueMenu = false;
        }
        else {
            $('.headerBrandName').css({display: "inline-block", opacity: 0.0}).animate({opacity: 1.0}, 400);
            $('.headerSearchForm').css({display: "none", opacity: 0.0}).animate({opacity: 1.0}, 500);
            trueMenu = true;
        }
    });

    if (window.innerHeight > document.body.offsetHeight) {
        $('.footer').css({
            'position': 'fixed',
            'bottom': '0'
        })
    }

    if (window.innerWidth > 960) {
        $('.c-menu').css('display', 'none');
    }

    $('.searchFilterList ul').each(function(){
        $(this).append('<form name="searchForm" class="searchFilterCancelApply">' +
            '<input type="button" class="searchFilterButton searchFilterButtonCancel" value="ANNULER">' +
            '<input type="submit" class="searchFilterButton searchFilterButtonApply" value="VALIDER">' +
            '</form>')
    })

    $(Brand+'List li,'+Condition+'List li,'+Price+'List li,'+Color+'List li'+Size+'List li').on('click', function () {
        $('.searchFilterDone').append('<div class="searchFilterAdded">' + $(this).text() + '<img src="img/product/icons-09.png" class="searchFilterAddedImg"></div>');
        $('.searchFilterAddedImg').click(function () {
            $(this).parent().remove();
        })
        if(trueMenu === false){
            $('.searchFilterList ul').css({
                'display': 'none',
                'max-height': '0',
                'height':'0'
            });
            $('.searchFilterCancelApply').css({
                'display': 'none',
            });
            $('.searchFilterHover').removeClass('searchFilterHoverBorder')
            trueMenu = true;
        }
    });

    $(Brand+','+Condition+','+Price+','+Color+','+Size).click(function () {
        if (trueMenu === true) {
            $('.'+ $(this).attr('class').split(' ')[1] + 'List').css({
                'display': 'inline-block',
                'max-height': '100%',
                'height': '100%'
            });
            $('.'+ $(this).attr('class').split(' ')[1] + ' .searchFilterHover').addClass('searchFilterHoverBorder');
            $('.searchFilterCancelApply').css({
                'display': 'inline-block',
            });
            trueMenu = false;
            $('.footer').css('display','none');
        }
        else {
            $('.searchFilterList ul').css({
                'display': 'none',
                'max-height': '0',
                'height':'0'
            });
            $('.searchFilterHover').removeClass('searchFilterHoverBorder');
            $('.'+ $(this).attr('class').split(' ')[1] + ' .searchFilterHover').removeClass('searchFilterHoverBorder');
            $('.searchFilterHover').removeClass('searchFilterHoverBorder');
            $('.searchFilterCancelApply').css({
                'display': 'none',
            });
            trueMenu = true;
            $('.footer').css('display','inline-block');
        }
    })

    /*$('.searchFilterBrandList').on('click', 'li', function () {
     $('.searchFilterDone').append('<div class="searchFilterAdded">' + $(this).text() + '<img src="img/product/icons-09.png" class="searchFilterAddedImg"></div>');
     $('.searchFilterAddedImg').click(function () {
     $(this).parent().remove();
     })
     });*/

});
