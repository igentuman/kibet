$(document).ready(function(){
// Вкладки страница описания
if ($(".tabs-noheight").length == 1) {
$(".tabs-noheight").sliderkit({
    auto: false,
    tabs: true,
    freeheight: true,
    circular: true
});

$('.taby li').first().addClass('sliderkit-selected');
$('.taby li').click(function(){
    $(this).addClass('sliderkit-selected');
    $('.h200 .sliderkit-nav-clip, .h200 .sliderkit-nav-clip ul > li').height('200');
});
}

// Cлайдер в шапке
if ($(".slider").length == 1) {
$(".slider").sliderkit({
    auto: false,
    circular: false,
    mousewheel: false,
    shownavitems: 4,
    panelfx: "sliding",
    panelfxspeed: 500,
    panelfxeasing: "easeOutExpo" // "easeOutExpo", "easeInOutExpo", etc.
});
}

// Каталог товаров
if($('.hides').length == 0) {
var blockHeight = $('.catalog-categories').css('height');
$('.catalog-list h3, .catalog-list h4').toggle(function(){
	$(this).addClass('hides');
    $(this).next('.catalog-categories').animate({'height':'0px'}, 500, function(){
        $('.catalog-list').css({'background-position':'-250px 100%'})
        $(this).children().hide();
    });
	},function(){
	$(this).removeClass('hides');
    $('.catalog-list').css({'background-position':'0 100%'})
    $(this).next('.catalog-categories').animate({'height': blockHeight},500, function(){
        $(this).children().slideDown(300);
    })
	}
);
}
else {
    $('.catalog-categories').css({'height':'0'}).children().hide();
    $('.catalog-list').css({'background-position':'-250px 100%'})
    }
//Выпадающие списки (смена валюты и пр.)
$('.drops div').bind('click', function() {
    var current = $(this);
    current.next('.dropdown-list').show();
    $(this).parent('.drops').addClass('droped')
});

$(document).bind('click', function(e) {
if (e.target.nodeName != 'EM') {
    if ($('.dropdown-list').is(':visible')) {
        $('.drops div').next('.dropdown-list').hide();
        $('.drops').removeClass('droped');
    }
}
});

// Вид блоков товара табличный
$('#sub-content .product-box-short:odd').css({'margin-right':'0px'}).after('<div class="clear"></div>');

$('.product-box-short').each(function(){
$(this).find($('.product-img-row')).hover(function(){
    $(this).parents('.product-box-short').find($('.fade-block')).fadeIn();
},function (){
    $(this).parents('.product-box-short').find($('.fade-block')).fadeOut();
});
});

// Вкладки в шапке
$(".tabin").hide();
$(".tab-controls a:first").addClass("active").show();
$(".tabin-box div:first").show();

$(".tab-controls a").click(function() {
$(".tab-controls a").removeClass("active");
$(this).addClass("active");
$(".tabin").hide(); 
var tabActive = $(this).attr("href");
$(tabActive).fadeIn();
return false;
});

// Вкладки
$(".tab-inner").hide();
$(".socials-tabs a:first").addClass("active").show();
$(".container div:first").show();

$(".socials-tabs a").click(function() { 
$(".socials-tabs a").removeClass("active");
$(this).addClass("active");
$(".tab-inner").hide(); 
var activeTab = $(this).attr("href");
$(activeTab).fadeIn();
return false; 
});

// Карусель
$(".carousel").sliderkit({
    auto: false,
    autospeed: 4000,
    shownavitems: 4,
    circular: false,
    fastchange: false,
    scrolleasing: "easeOutExpo", //"easeOutBounce, easeOutBack"
    scrollspeed: 500
});	

// Выбор диапазона
if($("#slider").length == 1){
$("#slider").slider({
    min: 0,
    max: 13000,
    values: [3000,10000],
    range: true,
    stop: function(event, ui) {
    $("input#minCost").val($("#slider").slider("values",0));
    $("input#maxCost").val($("#slider").slider("values",1));
    },
    slide: function(event, ui){
    $("input#minCost").val($("#slider").slider("values",0));
    $("input#maxCost").val($("#slider").slider("values",1));
    }
});

$("input#minCost").change(function(){

var value1=$("input#minCost").val();
var value2=$("input#maxCost").val();

if(parseInt(value1) > parseInt(value2)){
value1 = value2;
$("input#minCost").val(value1);
}
$("#slider").slider("values",0,value1);	
});


$("input#maxCost").change(function(){

var value1=$("input#minCost").val();
var value2=$("input#maxCost").val();

if (value2 > 1000) { value2 = 1000; $("input#maxCost").val(1000)}

if(parseInt(value1) > parseInt(value2)){
value2 = value1;
$("input#maxCost").val(value2);
}
$("#slider").slider("values",1,value2);
});

// фильтрация ввода в поля
$('.costs input').keypress(function(event){
var key, keyChar;
if(!event) var event = window.event;

if (event.keyCode) key = event.keyCode;
else if(event.which) key = event.which;

if(key==null || key==0 || key==8 || key==13 || key==9 || key==46 || key==37 || key==39 ) return true;
keyChar=String.fromCharCode(key);

if(!/\d/.test(keyChar))	return false;

});
}


}); // Ready