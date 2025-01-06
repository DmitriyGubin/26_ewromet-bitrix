 // $(".filter_boxx .click_box").niceScroll();

$('.button_line .drop_butt').on('click', function(){
    $('.button_line #del_filter')[0].click();
});

/***********фильтр****************/

$('.filter_boxx .filt_item').each(function(){

    var $this = $(this);
    var $field_box =  $this.find('.field_box');
    var scroll_bool = $this.hasClass('scroll');
    var $click_box =  $this.find('.click_box');

    $(this).find('.prop_arrow').on('click', function(){
        $field_box.slideToggle(600);
        $this.toggleClass('active');

        if(scroll_bool && $this.hasClass('active'))
        {
            $click_box.niceScroll();
        }
    });

});

/**поиск***/
$('.filter_boxx .filt_item.search').each(function(){

    var $vars = $(this).find('.click_line');

    $(this).find('.search_inp').on('input', function(){

        let value = $(this).val();

        Find_Vars(value, $vars);
    });
});


function Find_Vars(value, $vars)
{
    $vars.removeClass('hide');
    $vars.each(function(){

        let name = $(this).find('.check_name').html();

        name = name.toLowerCase();
        value = value.toLowerCase();

        if(!name.includes(value))
        {
            $(this).addClass('hide');
        }

    });
}

/**поиск***/

/***********фильтр****************/

var $sects = $('.sub_cat_box .var_box_anoth');
var $descr = $('.filter_boxx .hide_box .descr');
var $shade = $('.cabinet_shade');
var $mod_sects_butt = $('.filter_boxx #mob_sects');
var $mod_sects_butt_title = $mod_sects_butt.find('.mob_title');
var $mod_sects_butt_icon = $mod_sects_butt.find('.mob_icon');
var $mod_filt_butt = $('#mob_filters');
var $filter_blox = $('.filter_boxx .sticky_box');

$('.filter_boxx .hide_box').on('click', function(){
    $sects.slideToggle(300);
    $descr.toggleClass('hide');
});

$mod_sects_butt.on('click', Toggle_Mobile_Sects_Shade);


if(screen.width < 1000)
{
    $shade.on('click', function(){

        if($mod_sects_butt.hasClass('active'))
        {
            Toggle_Mobile_Sects_Shade();
        }

        if($mod_filt_butt.hasClass('active'))
        {
            Toggle_Mobile_Filter_Shade();
        }

    });
}

$mod_filt_butt.on('click', Toggle_Mobile_Filter_Shade);

function Toggle_Mobile_Sects_Shade()
{
   $mod_sects_butt.toggleClass("active");
   $mod_sects_butt_title.toggleClass("hide");
   $mod_sects_butt_icon.toggleClass("hide");
   $shade.fadeToggle(300);
   $sects.slideToggle(300); 
}

function Toggle_Mobile_Filter_Shade()
{
    $mod_filt_butt.toggleClass("active");
    $filter_blox.slideToggle(300);
    $shade.fadeToggle(300);
}



















/**********Ползунок************/

 function Converter(str)
 {
    var res = str.replace(/\s/g, '');
    res = res.replace(/&nbsp;/g, '');
    res = Number(res);
    return res;
}

var min_val = Converter($('.min_max_val.left').html());
var max_val = Converter($('.min_max_val.right').html());

var min_vall = min_val;
var max_vall = max_val;

var $left_inp = $('#arrFilter_P1_MIN');
var $right_inp = $('#arrFilter_P1_MAX');

if($left_inp.val() != '')
{
    min_vall = $left_inp.val();
}

if($right_inp.val() != '')
{
    max_vall = $right_inp.val();
}

$(".polzunok-5").slider({
    min: min_val,
    max: max_val,
    values: [min_vall, max_vall],
    range: true,
    animate: "fast",
    slide : function(event, ui) {
        $(".polzunok-input-5-left").val(ui.values[ 0 ]);   
        $(".polzunok-input-5-right").val(ui.values[ 1 ]);  

        smartFilter.keyup($('.polzunok-input-5-right')[0]);
    }    
});

$(".polzunok-container-5 input").change(function() {
    var input_left = $(".polzunok-input-5-left").val().replace(/[^0-9]/g, ''),    
    opt_left = $(".polzunok-5").slider("option", "min"),
    where_right = $(".polzunok-5").slider("values", 1),
    input_right = $(".polzunok-input-5-right").val().replace(/[^0-9]/g, ''),    
    opt_right = $(".polzunok-5").slider("option", "max"),
    where_left = $(".polzunok-5").slider("values", 0); 
    if (input_left > where_right) { 
        input_left = where_right; 
    }
    if (input_left < opt_left) {
        input_left = opt_left; 
    }
    if (input_left == "") {
        input_left = 0;    
    }        
    if (input_right < where_left) { 
        input_right = where_left; 
    }
    if (input_right > opt_right) {
        input_right = opt_right; 
    }
    if (input_right == "") {
        input_right = 0;    
    }    
    $(".polzunok-input-5-left").val(input_left); 
    $(".polzunok-input-5-right").val(input_right); 
    if (input_left != where_left) {
        $(".polzunok-5").slider("values", 0, input_left);
    }
    if (input_right != where_right) {
        $(".polzunok-5").slider("values", 1, input_right);
    }
});

var rounds = document.querySelectorAll(".filter_boxx .polzunok-container-5 .ui-slider .ui-slider-handle");

for (let item of rounds)
{
    let div = document.createElement('div');
    div.classList.add('polzun_point');

    item.appendChild(div);
}

/**********Ползунок************/





