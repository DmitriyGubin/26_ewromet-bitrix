
/*********табы******************/
Tab_Plus_Minus('.my_orders .orders_item', '.hide_box');

function Tab_Plus_Minus(item_sel, hide_box_sel)
{
	$(item_sel).each(function(){

		var $plus = $(this).find('.plus');
		var $minus = $(this).find('.minus');
		var $hide_box = $(this).find(hide_box_sel);

		$(this).find('.plus_min_box').on('click', function(){

			$plus.toggleClass('hide');
			$minus.toggleClass('hide');
			$hide_box.slideToggle(300);

		});

	});
}

/*********табы******************/


/***********табы на разделы с заказом**************/

// Tabs_Switch($('.my_orders .tab_item'), $('.my_orders .orders_box'));

// function Tabs_Switch($sections, $hide_boxes)
// {
// 	$sections.on('click', function(){
// 		Swich($sections,$(this));
// 		Tabs($hide_boxes,$(this));
// 	});
// }

// function Tabs($hide_boxes,$this)
// {
// 	var id = $this.attr('id');
// 	$hide_boxes.addClass('hide');

// 	$hide_boxes.each(function(){

// 		if($(this).hasClass(id))
// 		{
// 			$(this).removeClass('hide');
// 		}

// 	});
// }

// function Swich($all_sects,$this)
// {
// 	$all_sects.removeClass('active');
// 	$this.addClass('active');
// }

/***********табы на разделы с заказом**************/



/*************коды*****************/

function Show_Hide_Something(hide_box_ref, button_ref)
{
	button_ref.on('click', function() {
		hide_box_ref.toggleClass('hide');
		Click_Out_Something(hide_box_ref, 'hide', 'mark_class');
	});
}

function Click_Out_Something(hide_box_ref, hide_class, mark_class)
{
	if(!hide_box_ref.hasClass(hide_class))
	{
		document.onclick = function (e) {
			let all_classes = e.target.className;
			if (all_classes.indexOf(mark_class) == -1)
			{
				hide_box_ref.addClass(hide_class);
			}
		};
	}
}

async function copyTextToClipboard(text) {
    try {
        await navigator.clipboard.writeText(text);
        //console.log('Text copied to clipboard');
    } catch (err) {
        //console.error('Error in copying text: ', err);
    }
}

$('.univ_table .table_item').each(function(){

	/**********Появление кода товара*****************/
	Show_Hide_Something($(this).find('.cod_box'), $(this).find('.cod_item'));

	/*******копирование кода***********/
	var cod = $(this).find('.prod_cod').html();

	$(this).find('.copy_icon ').on('click', function(){

		copyTextToClipboard(cod);

		//console.log(cod);

	});
});

/*************коды*****************/