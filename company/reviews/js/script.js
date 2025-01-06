var $stars = $('.form_star.var');
var $rating_inp = $('#rating_inp');
var num = 1;
$('.reviews_form .form_star').on('click', function () {
	$(this).toggleClass('active');
	$rating_inp.val(Calc_Rating());
});

function Calc_Rating()
{
	var j = 0;
	$stars.each(function(){
		if($(this).hasClass('active'))
		{
			j++;
		}
	});
	return j+1;
}

$('.write_rew').on('click', function () {
	
	$('.reviews_form').slideToggle('slow');

});


/****отправка формы****/

$('.reviews_form .order_button').on('click', () => Send_Form($('#reviews_form'), event));

/****отправка формы****/
