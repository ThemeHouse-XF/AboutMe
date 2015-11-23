/**
 * @author th
 */
/** @param {jQuery} $ jQuery Object */
!function($, window, document, _undefined)
{
	var Super = XenForo.Tabs.prototype;
	
	$.extend(XenForo.Tabs.prototype,
	{
		_superConstruct: Super.__construct,
		
		__construct: function($tabContainer)
		{
			this._superConstruct($tabContainer);
			
			$tabContainer.bind(
			{
				click: $.context(this, 'aboutClick'),
			});
		},
			
		aboutClick: function(index) {
			$('.SquareThumbs').each(function(){
				$container = $(this);
				
				var thumbHeight = $container.data('thumb-height') || 44,
				thumbSelector = $container.data('thumb-selector') || 'a.SquareThumb';

				$container.find(thumbSelector + ' img').each(function() {
					var $thumb = $(this),
					w = $thumb.width(),
					h = $thumb.height();

					if (h > w)
					{
						$thumb.css('width', thumbHeight);
						$thumb.css('top', ($thumb.height() - thumbHeight) / 2 * -1);
					}
					else
					{
						$thumb.css('height', thumbHeight);
						$thumb.css('left', ($thumb.width() - thumbHeight) / 2 * -1);
					}
				});
			});
		}
	});
}
(jQuery, this, document);