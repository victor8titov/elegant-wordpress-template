


/* 
*       *******************************
*           section maps 
*       
*           Настройки и инициализация 
*           карты на главной странице
*       *******************************
 */
var map;
var geocoder;


function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: -34.397, lng: 150.644},
    zoom: 15,
    zoomControl: false,
    mapTypeControl: false,
    //scaleControl: false,
    streetViewControl: false,
    //rotateControl: boolean,
    fullscreenControl: false
  
    });    

    var styledMapType = new google.maps.StyledMapType(
        [
            {
            "elementType": "geometry",
            "stylers": [
                {
                "color": "#f5f5f5"
                }
            ]
            },
            {
            "elementType": "labels.icon",
            "stylers": [
                {
                "visibility": "off"
                }
            ]
            },
            {
            "elementType": "labels.text.fill",
            "stylers": [
                {
                "color": "#616161"
                }
            ]
            },
            {
            "elementType": "labels.text.stroke",
            "stylers": [
                {
                "color": "#f5f5f5"
                }
            ]
            },
            {
            "featureType": "administrative.land_parcel",
            "stylers": [
                {
                "visibility": "on"
                }
            ]
            },
            {
            "featureType": "administrative.land_parcel",
            "elementType": "labels.text.fill",
            "stylers": [
                {
                "color": "#bdbdbd"
                }
            ]
            },
            {
            "featureType": "landscape.natural.landcover",
            "stylers": [
                {
                "visibility": "on"
                }
            ]
            },
            {
            "featureType": "poi",
            "elementType": "geometry",
            "stylers": [
                {
                "color": "#eeeeee"
                }
            ]
            },
            {
            "featureType": "poi",
            "elementType": "labels.text.fill",
            "stylers": [
                {
                "color": "#757575"
                }
            ]
            },
            {
            "featureType": "road",
            "elementType": "geometry",
            "stylers": [
                {
                "color": "#ffffff"
                }
            ]
            },
            {
            "featureType": "road.arterial",
            "elementType": "labels.text.fill",
            "stylers": [
                {
                "color": "#757575"
                }
            ]
            },
            {
            "featureType": "road.highway",
            "elementType": "geometry",
            "stylers": [
                {
                "color": "#bdc5e8"
                }
            ]
            },
            {
            "featureType": "road.highway",
            "elementType": "labels.text.fill",
            "stylers": [
                {
                "color": "#616161"
                }
            ]
            },
            {
            "featureType": "road.local",
            "elementType": "geometry.fill",
            "stylers": [
                {
                "color": "#dadde5"
                }
            ]
            },
            {
            "featureType": "road.local",
            "elementType": "labels.text.fill",
            "stylers": [
                {
                "color": "#9e9e9e"
                }
            ]
            },
            {
            "featureType": "transit.line",
            "elementType": "geometry",
            "stylers": [
                {
                "color": "#eeeeee"
                }
            ]
            },
            {
            "featureType": "transit.station",
            "elementType": "geometry",
            "stylers": [
                {
                "color": "#eeeeee"
                }
            ]
            },
            {
            "featureType": "transit.station.rail",
            "elementType": "labels.icon",
            "stylers": [
                {
                "visibility": "on"
                }
            ]
            },
            {
            "featureType": "transit.station.rail",
            "elementType": "labels.text",
            "stylers": [
                {
                "visibility": "off"
                }
            ]
            },
            {
            "featureType": "water",
            "elementType": "geometry",
            "stylers": [
                {
                "color": "#c9c9c9"
                }
            ]
            },
            {
            "featureType": "water",
            "elementType": "labels.text.fill",
            "stylers": [
                {
                "color": "#9e9e9e"
                }
            ]
            }
        ]
    );
    //Associate the styled map with the MapTypeId and set it to display.
    map.mapTypes.set('styled_map', styledMapType);
    map.setMapTypeId('styled_map');

    geocoder = new google.maps.Geocoder();

    if ( stack_adress.length ) {
        for(var i=0; i < stack_adress.length; i++) {
            codeAddress( stack_adress[i] );

        }
    }
    

}

function codeAddress(address) {
    geocoder.geocode( { 'address': address}, function(results, status) {
    if (status == 'OK') {
        map.setCenter(results[0].geometry.location);
        var marker = new google.maps.Marker({
            map: map,
            position: results[0].geometry.location
        });
        
    } else {
        alert('Geocode was not successful for the following reason: ' + status);
    }
    });
}

/*  end section map */
  

/* 
*       ********************************************************
*
*       Run after loads.
*               
*       Запуск кода после загрузки всех компонетвов страницы        
*
*       ********************************************************
*/

$(function() {
    
   /*
   *        ****************************************
   *
   *            работа с меню в  мобильной верисии
   * 
   *        ****************************************
   */
   var win_width = $(window).width();
   var firstClick = true;
   //   ход анимации в прямом и обрабтом направвлении
   //   здесь основная анимация пунктов меню
   var menuStatus = true;
   // 0 = hidden;
   // 1 = show;

   if (win_width < 769 ) {        
        $(document.body).on('click.menuToggle', function() {
                menuCustomAnimateMobile();
            });

        $('#site-navigation').on('click', function(event) {
                menuCustomAnimateMobile(); 
                event.stopPropagation();
            });
        $('#header-menu li a').on('click', function(event) {
            //console.log(event.target);
            $(event.target).css('background','rgba(36,47,53, 0.9)').addClass('flipInX');
            event.stopPropagation();
            //return false;
        })    
    }

    // переключает классы для показа или скрытия меню
   function menuTogglemobile(comand) {
        var menu = $('#header-menu');

        if (firstClick) {
            menu.css({
                'transition': 'inherit',
                'opacity': 1.0,
            });
            firstClick = !firstClick;
            menuTogglemobile('hidden');
        }

        menu.toggleClass('visible-menu');
        menu.toggleClass('hidden-menu');
        
        if (comand === 'visible' ) {
            menu.addClass('visible-menu');
            menu.removeClass('hidden-menu');
            return;
        } 
        if ( comand === 'hidden' ) {
            menu.removeClass('visible-menu');
            menu.addClass('hidden-menu');           
            return; 
        }
   }

   
    function menuCustomAnimateMobile() {
        menuStatus = !menuStatus; 
        console.log('menuStatus: '+ menuStatus);
        
        var stack_a = $('#header-menu li a');
        var delay = -200;
        
        if ( !menuStatus ) {
            menuTogglemobile();
        }

        $('#header-menu').removeClass('gradient-menu');
               
        stack_a.each(function() {
            $(this).css({
                'background': 'rgba(36,47,53, 0.9)',  
                'top': 0,                  
            })
            
            var position = $(this).position();
            var top = position.top;
            //console.log('top: ' + top);

            if ( !menuStatus ) {
                $(this).css({
                    'top': - (top + 200),
                })
            }
        });
        
        stack_a.each(function() {
            var element = this;
            var top = parseInt( $(this).css('top') );
            var position = $(this).position();
                       
            delay+=200;
            element.ti_animate({
                draw: move,
                duration: 500,
                timingFunction: 'back',
                ease: 'easeInOut',
                delay: delay,
            });

            function move(progress) {
                if ( !menuStatus ) {
                    element.style.top = top - top*progress + 'px';
                    
                    return;
                }
                
                if ( menuStatus ) {
                    element.style.top =-(position.top+200)*progress + 'px';
                    return;
                }
            }
        });

        setTimeout(finish, 1500);
        function finish() {
            
            if ( !menuStatus ) {
                $('#header-menu').addClass('gradient-menu');
            }

            stack_a.each(function() {
                    var position = $(this).position();
                    var top = position.top;
                    //console.log('top: ' + top);
                    $(this).css({
                        'background': 'transparent',
                    })
                });

            if ( menuStatus ) {
                menuTogglemobile();
            }
        
        }
    }// end menuCustomAnimateMobile



     /*
     *      *********************************************
     *         Анимация меню в Desktop режиме
     *      ******************************************
     */
    var el = {
        menu : $('.header-menu'),
        ul   : $('#header-menu'),
        li   : $('#header-menu li'),
        a    : $('#header-menu li a'),
    }
    var StackElm = [];

    if (win_width >= 769 ) {
        if (firstClick) {
            $('.header-menu').addClass('resetS');
        }
        $(document.body).on('click', function() {
            menuCustomAnimateDesktop();
            });

        $('#site-navigation').on('click', function(event) {
               menuCustomAnimateDesktop();
                event.stopPropagation();
            });
        $('#header-menu li a').on('click', function(event) {
            $(event.target).addClass('animated flip'); //tada swing pulse flip
            event.stopPropagation();
            //return false;
        })    
    }

       function menuCustomAnimateDesktop() {         
        if ( firstClick ) {
            calculPosition();
           
            el.a.each(function() {
                StackElm.push([
                    this,
                    parseInt( this.style.right ),
                    parseInt( this.style.top ),
                    ]);
            });
            firstClick = !firstClick;
        }
        menuStatus = !menuStatus; 
               
        if ( !menuStatus ) menuToggleDesktop();
        
        var delay = -100;
        StackElm.forEach(function(elm) {
            if ( !menuStatus ) {
                elm[0].style.top = 0;
                elm[0].style.right = 0;
            }
            delay += 100;
            elm[0].ti_animate({
                draw: move,
                duration: 300,
                timingFunction: 'sinusoidal',
                //ease: 'easeIn',
                delay: delay,
            });

            function move(progress) {
                if ( !menuStatus ) {
                    elm[0].style.top = elm[2]*progress + 'px';
                    elm[0].style.right = elm[1]*progress + 'px';
                    elm[0].style.opacity = progress;
                    return;
                }
                
                if ( menuStatus ) {
                    elm[0].style.top =elm[2] - elm[2]*progress + 'px';
                    elm[0].style.right =elm[1] - elm[1]*progress + 'px';
                    elm[0].style.opacity = 1-progress;

                    return;
                }
            }
        });

        if ( menuStatus ) {
            setTimeout(finish, 900);
            function finish() {
                menuToggleDesktop();
            }
        }
    }

    function menuToggleDesktop(comand) {
        el.menu.toggleClass('active');
    }
    
    function calculPosition() {
        // Setting 
        var s = {
            r: 50,
            angleAxis: 55,
            margin: 15,            
        }
        s.count = el.a.length;
        s.height = el.a.outerHeight();

        var stackObj = [];
        var currentMaxWidth = 0;

        el.a.each(function() {
            var width = $(this).outerWidth();
            stackObj.push([this, width]);
            stackObj.sort(function(a,b) {
                return a[1] - b[1];
            })
            
        });

        setCoords(s.r);
        function setCoords(radius) {
            //debugger;
            var count = Math.floor( radius / (s.height + s.margin*2) );
            
            var angle0 =  Math.round( ( Math.asin( (s.height+s.margin*2) / radius ) * 180 ) / Math.PI );
            var angleStart = s.angleAxis - Math.floor( count / 2 ) * angle0;
            
            if (count === 1 ) angleStart = s.angleAxis;

            for (var i=0; i < count; i++) {
                if ( !stackObj.length ) return;
                var coord;
                var obj = stackObj.shift();
                
                currentMaxWidth = obj[1] >= currentMaxWidth ? obj[1] : currentMaxWidth;

                coord = coord0( 360 - (90 + angleStart), radius );

                $( obj[0] ).css({
                    'right': coord[0],
                    'top': coord[1],
                }) 
                angleStart += angle0;
            }

            if ( stackObj.length ) {
                setCoords( radius + currentMaxWidth + 20);
            }
        };

        function coord0(angle, radius) {
            angle = (angle * Math.PI) / 180;
            var x ,y;
            x = Math.abs( Math.round( radius * Math.cos(angle) ) );
            y = Math.abs( Math.round( radius * Math.sin(angle) ) );
            //console.log('x: '+ x + '\n'+'y: '+y);
            return [x,y];
        }
        
    }   



    

});// end $(function)


/* 
 *      *****************************************************
 *          
 *          Код для работы с анимацией
 *  
 *          на выходе получим дополнительное свойство у object Element 
 *          ti_animate
 * 
 *      *******************************************************************
 */
//		--- Фреймворк анимации объектов ---
/*	Описание:
			Данная библиотека вводит новый метод для упрашенного управления анимацие объектов
			страницы. 
	
	Синтаксис:
			[object Element].ti_animate(func[,duration ,timing function, ease*, time delay]);
			
			или в виде объекта:
			
			[object Element].ti_animate({draw: func [, duration: 'duration', timingFunction: 'timing function', ease: 'ease*', delay: 'time  delay']});
	Аргументы:
			-- func: 
				[function] [required]
				Функция которая будет вызываться каждые ~20мс т.е в данной функции описываются изменения на странице
			
			-- duration: 
				[number] [optional] default: 500ms
				Время анимации. т.е за какое время должна пройти анимация
				
			-- timing function: 
				[string] [optional] default: sinusoidal (linear,quad,circ,back,bounce,elastic,sinusoidal)
				Функция времени определяет временная функция, которая, по аналогии с CSS-свойством transition-timing-function, будет по текущему времени вычислять состояние анимации.
				Она получает на вход непрерывно возрастающее число timeFraction – от 0 до 1, где 0 означает самое начало анимации, а 1 – её конец.
				Её результатом должно быть значение завершённости анимации, которому в CSS transitions на кривых Безье соответствует координата y.
				
				Перечень функций:
				linear: функция-прямая означает равномерное развитие процесса:
				quad:  квадратичная функция
				circ: дуга
				back: эффэкт тетевы. Эта функция работает по принципу лука: сначала мы «натягиваем тетиву», а затем «стреляем».
				bounce: Представьте, что мы отпускаем мяч, он падает на пол, несколько раз отскакивает и останавливается. 
						Функция bounce делает то же самое, только наоборот: «подпрыгивание» начинается сразу.
				elastic: разрастующиеся колебания
				sinusoidal: функция синуса
				
			-- ease*: 
				[string] [optional] default: easeIn (easeIn, easeOut, easeInOut)
				Направления движеня анимации. т.е ход движения временной функции
				easeIn - В прямом направлении
				easeOut - В обратном
				easeInOut - Пол анимации в прямом направлении вторая половина зеркально
				
			-- time delay: 
				[number] [optional]
				Задерка перед анимацией

	Ссылки:
		поможет разобраться с функциями времени и ease*
		https://learn.javascript.ru/js-animation#%D1%80%D0%B5%D0%B2%D0%B5%D1%80%D1%81%D0%B8%D0%B2%D0%BD%D1%8B%D0%B5-%D1%84%D1%83%D0%BD%D0%BA%D1%86%D0%B8%D0%B8-ease
*/
//		---		Пример		---
/*
var div = document.getElementById('div');
var start_left = parseInt(window.getComputedStyle(div).left);
var start_width = parseInt(window.getComputedStyle(div).width);
var start_height = parseInt(window.getComputedStyle(div).height);

function move(progress) {
	div.style.left = start_left + 500*progress + 'px';
	
};

function move2(progress) {
	div.style.width = 100*progress+'px';
	div.style.height = 100*progress+'px';
	
};

div.ti_animate(move,5000,'sinusoidal','easeIn');

div.ti_animate({draw: move2,
			 	duration: 500,
				timingFunction: 'sinusoidal',
				ease: 'easeInOut',
				
				});

*/

//	Добовляем новый метод в Класс Element
if (!Element.prototype.ti_animate) 
	Element.prototype.ti_animate = function(options) {
		//Парсим запрос
		if (typeof options === 'object') {
			options.duration = options.duration || 500;
			options.timingFunction = options.timingFunction || 'sinusoidal';
			options.ease = options.ease || 'easeIn';
			if (!options.draw) { console.log(new Error('Нет исполняющей функции / No executing function')); return}
		}
		else { 
			options = {
				draw: arguments[0] || function () {console.log(new Error('Нет исполняющей функции / No executing function')); this.return} ,
			 	duration: arguments[1] || 500,
				timingFunction: arguments[2] || 'sinusoidal',
				ease: arguments[3] || 'easeIn',
				}
			if (arguments[4]) options.delay = arguments[4]; 
		}
		
		 
		
		
		//	Стек обробатывающих функции
		//	Задают тип движения
		//	Группа ease* задает направления анимации 
		var steckFunc = {
			linear: function(timeFraction) {return timeFraction},
			
			quad:   function (timeFraction) {return Math.pow(timeFraction, 2);}, 
			
			sinusoidal: function(timeFraction) {return 1 - Math.sin((1 - timeFraction) * Math.PI/2)},
			
			circ:   function(timeFraction) {return 1 - Math.sin(Math.acos(timeFraction));},
			
			back:   function(timeFraction) {//Эта функция работает по принципу лука: сначала мы «натягиваем тетиву», а затем «стреляем».
											//функциязависит от дополнительного параметра x, который является «коэффициентом упругости». Он определяет расстояние, на которое «оттягивается тетива».
											var x = 1.5; return Math.pow(timeFraction, 2) * ((x + 1) * timeFraction - x);},
			
			bounce: function(timeFraction) {for (var a = 0, b = 1, result; 1; a += b, b /= 2) {
												 if (timeFraction >= (7 - 4 * a) / 11) {
      											 return -Math.pow((11 - 6 * a - 11 * timeFraction) / 4, 2) + Math.pow(b, 2)
												 }};},
			elastic:function(timeFraction) {//Эта функция зависит от дополнительного параметра x, который определяет начальный диапазон.
											var x = 1.5; return Math.pow(2, 10 * (timeFraction - 1)) * Math.cos(20 * Math.PI * x / 3 * timeFraction)},
			//		--- Реверсивные функции ease* ---
			//	преобразователь в easeIn 
			//	чтобы показать анимацию в прямом (обычном) режиме. по умолчанию
			easeIn: function (timing,timeFraction) {return timing(timeFraction);},
		
			//	преобразователь в easeOut
			//	чтобы показать анимацию в обратном режиме. 
			easeOut: function (timing,timeFraction) {return 1 - timing(1 - timeFraction);},
		
			//	преобразователь в easeInOut
			//	чтобы показать эффект и в начале и в конце анимации
			easeInOut: function (timing,timeFraction) {if (timeFraction < .5)
														return timing(2 * timeFraction) / 2;
														else
														return (2 - timing(2 * (1 - timeFraction))) / 2;
  														}};
		
		
		
		var start = 0;
		//	Передача управления движку браузера для выполнения функции animate
		//	организация функции задерки анимации
		if (options.delay) setTimeout(function() {start = performance.now(); return requestAnimationFrame(animate)},options.delay);
			else {start = performance.now(); requestAnimationFrame(animate);}
		
		
		
		
		function animate(time) {
			// timeFraction от 0 до 1
			// time берется из свойств объекта requestAnimationFrame
			var timeFraction = (time - start) / options.duration;
			
			//	возможно небольшое превышение времени, в этом случае зафиксировать конец
			if (timeFraction > 1) timeFraction = 1;
	 	
			// текущее состояние анимации
			// progress от 0 до 1 позволяет изменять нужный параметр в объекту анимации до нцжного значения
			//steckFunc[options.ease]() это подстановка из стека одноименной функции реверсинвости easeIn / easeOut / easeInOut
			// т.е easeIn() || easeOut() || easeInOut()
			//steckFunc[options.timingFunction это подстановка из стека функции одноименной функции времени  linear,quad,circ,back,bounce,elastic
			// т.е linear() ,quad(), circ(), back(), bounce(), elastic()
			//итого запрос выглядит Например так progress = easeInOut(linear,timeFraction);
			var progress = steckFunc[options.ease](steckFunc[options.timingFunction],timeFraction);
			
			//	Вызов функции которая создает кастомные изменения объектов страницы
			options.draw(progress);
			
			 // если время анимации не закончилось - запланировать ещё кадр
			if (timeFraction < 1) {
		  	requestAnimationFrame(animate);
			}
		};
			
	//end ti_animate
	};

