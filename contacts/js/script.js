var lat = Number($("#lat").html());
var long = Number($("#long").html());
var address = $("#address").html();

//console.log(lat, long, address);

ymaps.ready(init);

function init () 
{
			var myMap = new ymaps.Map("y_map", {
				center: [lat,long],
				zoom: 17,
				controls: [],//без элементов управления
			}, {
				searchControlProvider: 'yandex#search'
			}),
    // Создание макета содержимого хинта.
    // Макет создается через фабрику макетов с помощью текстового шаблона.
    HintLayout = ymaps.templateLayoutFactory.createClass( "<div class='my-hint'>" +
    	"{{ properties.address }}" +
    	"</div>", {
                // Определяем метод getShape, который
                // будет возвращать размеры макета хинта.
                // Это необходимо для того, чтобы хинт автоматически
                // сдвигал позицию при выходе за пределы карты.
                getShape: function () {
                	var el = this.getElement(),
                	result = null;
                	if (el) {
                		var firstChild = el.firstChild;
                		result = new ymaps.shape.Rectangle(
                			new ymaps.geometry.pixel.Rectangle([
                				[0, 0],
                				[firstChild.offsetWidth, firstChild.offsetHeight]
                				])
                			);
                	}
                	return result;
                }
            }
            );

//https://yandex.ru/dev/maps/jsbox/2.1/icon_customImage

    function Add_point(x, y, adress)
    {
        var myPlacemark = new ymaps.Placemark([x, y], 
        { 
            iconContent: '',
            balloonContent: '<p class="ballon-title">' + adress + '</p>'
        },
        {  
            iconLayout: 'default#imageWithContent',
            iconImageHref: 'img/map-point.svg',
            iconImageSize: [88, 106],
            iconImageOffset: [-44, -53],
            iconContentOffset: [0, 0]
        });
        myMap.geoObjects.add(myPlacemark);
    }

    Add_point(lat,long,address);
    //myMap.setCenter([55.048513, 82.911446], 15);
}


/*********табы вопрос - ответ******************/

$('.employees .tab_item').each(function(){

  let butt = $(this).find('.count_butt');
  let hide_box = $(this).find('.hide_box');

  butt.on('click', function(){
    butt.toggleClass('hide');
    hide_box.slideToggle(300);
  });

});

/*********табы вопрос - ответ******************/


/************форма***************/

$(".form_field.phone").mask("+7(999) 999-9999");

$('.call_order .order_button').on('click', () => Send_Form($('#call_order_form'), event));

$('.call_order .one_more').on('click', function(){
    $('.call_order .form_box').toggleClass("hide");
    $('.call_order .success').toggleClass("hide");
});

/************форма***************/


