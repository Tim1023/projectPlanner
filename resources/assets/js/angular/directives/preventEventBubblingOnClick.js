/// This ensures that any parent elements with click events (such as a table row) do not fire

programPlannerModule.directive('preventEventBubblingOnClick', [function () {

	return {
		restrict: 'A',
		link: function (scope, element, attrs)
		{
			element.bind('click', function(e)
			{
				e.stopPropagation();
			});
		}
	};

}]);