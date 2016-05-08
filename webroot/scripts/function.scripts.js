(function($)
{
	$.fn.closeMessage = function () {
		$(this).on('click', function (event) {
			var parent = '#'+event.currentTarget.parentElement.id;

			console.log(parent, event);
			$(parent).addClass('hidden');
		});
	};
}(jQuery));
