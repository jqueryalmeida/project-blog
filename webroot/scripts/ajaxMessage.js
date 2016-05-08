(function()
{
	$.fn.setMessage = function(message, classToAdd, classToRem, typeFadeIn)
	{
		var toSet =  {
			text : message,
			class : classToAdd,
			fadeIn : typeFadeIn,
			removeClass : classToRem
		};

		$('#ajax-message').addClass(toSet.class);
		$('#ajax-message').removeClass(toSet.removeClass);
		$('#text-message-ajax').text(toSet.text);
		$('#ajax-message').fadeIn(toSet.fadeIn);
	};
})(jQuery);