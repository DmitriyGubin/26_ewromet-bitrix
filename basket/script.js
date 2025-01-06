//console.log(777);

/*************сортировка*************/
$('.sort_box.sort').on('click', function(){

    $(this).find('.sort_icon').toggleClass('active');

});

/*************сортировка*************/

/*******копирование кода***********/
$('.univ_table .table_item').each(function(){

	
	var cod = $(this).find('.prod_cod').html();

	$(this).find('.copy_icon ').on('click', function(){

		copyTextToClipboard(cod);

	});
});

async function copyTextToClipboard(text) {
    try {
        await navigator.clipboard.writeText(text);
        //console.log('Text copied to clipboard');
    } catch (err) {
        //console.error('Error in copying text: ', err);
    }
}

/*изменение позиций в корзине*/
 
var $total_title = $('#prods_num');
var $total_box = $('#order_box_positions');

function Plus_Product()
{
	var nums = Number($total_title.html()) + 1;
	$total_title.html(nums);
	$total_box.html(nums);
}

function Minus_Product()
{
	var nums = Number($total_title.html()) - 1;
	$total_title.html(nums);
	$total_box.html(nums);
}

//
/*изменение позиций в корзине*/

// очистка корзины
Clear_Basket('.clear.col.right');



/****вес****/

Set_All_Weight();

function Set_All_Weight()
{
	var weight_kg = 0;
	$('input[data-mesure="кг"]').each(function(){

		weight_kg = weight_kg + Number($(this).val());

	});

	var weight_thing = 0;
	$('input[data-mesure="шт"]').each(function(){

		weight_thing = weight_thing + Number($(this).val())*($(this)[0].dataset.weight);

	});

	var weight = weight_kg + weight_thing;
	weight = weight.toFixed(1);

	//weight = Math.round(weight);
	//console.log(weight);
	$('#total_weight').html(weight);
}

function Set_All_Weight_After_Ajax()
{
	BX.addCustomEvent('onAjaxSuccess', function() 
	{
		Set_All_Weight();
	});
}

// function Minus_Weight(elem)
// {
// 	if(elem.dataset.mesure == 'кг')
// 	{
// 		if(elem.nextElementSibling.value > 1)
// 		{
// 			let new_weight = Number($('#total_weight').html()) - 1;
//  			$('#total_weight').html(new_weight);
// 		}
// 	}
	
// }

// function Plus_Weight(elem)
// {
// 	if(elem.dataset.mesure == 'кг')
// 	{
// 		let new_weight = Number($('#total_weight').html()) + 1;
//  		$('#total_weight').html(new_weight);
// 	}
// }

// function Change_Input(elem)
// {
// 	if(elem.dataset.mesure == 'кг')
// 	{
// 		Set_All_Weight();
// 	}
// }

/****вес****/

$('#buy_order').on('click', function(){
	$('.hide.hide_order_butt').click();
});

$('.basket .make_order_mobile').on('click', function(){
	
	$('.left_box_order #buy_order').click();

});