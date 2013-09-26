			var headerRotatorTimeout = 8000;
			var fadeSpeed = 1000;
			var rotatorLock = false;
			var timeoutID = null;
			var headers = 3;
			var curNumber = 1;

			function getNextHeader(number)
			{
				return (number > headers) ? 1 : (number < 1 ? headers : number);
			}

			function nextHeader(number, ignore)
			{
				if(rotatorLock || (number == curNumber && ignore == undefined))
				{
					return;
				}

				setHeader(getNextHeader(number), 'background');
				rotatorLock = true;

				$("#header li.active").removeClass('active');
				$("#header li.thumbnail" + getNextHeader(number)).addClass('active');

				$("#header p").html($("p.header_text_template_" + getNextHeader(number)).html());
				$("#header_foreground").fadeOut(fadeSpeed, function() {
					setHeader(getNextHeader(number), 'foreground');
					$("#header_foreground").show();
					rotatorLock = false;
					curNumber = getNextHeader(number);
				});
				$('#header_progress').stop().animate({width: 1}, fadeSpeed, function() {
					$('#header_progress').animate({width: 1000}, headerRotatorTimeout, function() {
						nextHeader(getNextHeader(curNumber+1));
						curNumber = getNextHeader(number);
						rotatorLock = false;
					});
				});
			}

			function setHeader(headerNumber, suffix)
			{
				$("#header_" + suffix).css('background', 'url(images/slide_' + headerNumber + '.png)');
			}
			$(document).ready(function(){
				nextHeader(1, true);
			//	$('div.slideshow').cycle();
				$("#scroller").fadeIn();
				$("#scroller").simplyScroll({
					autoMode: 'loop'
				});
			});
			
