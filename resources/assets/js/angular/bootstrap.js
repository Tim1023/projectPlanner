var programPlannerModule = angular.module('programPlannerApp',
		['ngFileUpload','ngSanitize', 'ui.select', 'ui.bootstrap','ui.bootstrap.showErrors'],
		function($interpolateProvider){
			$interpolateProvider.startSymbol('<%');
			$interpolateProvider.endSymbol('%>');
		}
	);
programPlannerModule.constant("DATE_FORMAT", "en-US")

//taken from http://jsfiddle.net/lancelarsen/Tx7Ty/
programPlannerModule.filter('decimal', function ($filter) {
	return function (input, places) {
		if (isNaN(input)) return input;
		// If we want 1 decimal place, we want to multi/div by 10
		// If we want 2 decimal places, we want to multi/div by 100, etc
		// So use the following to create that factor
		var factor = "1" + Array(+(places > 0 && places + 1)).join("0");
		return Math.round(input * factor) / factor;
	};
});


/**
 * AngularHelper : Contains methods that help using angular without being in the scope of an angular controller or directive
 * based on an answer from http://stackoverflow.com/questions/19845950/angularjs-how-to-dynamically-add-html-and-bind-to-controller
 */
var AngularHelper = (function ()
{
	var AngularHelper = function () { };
	/**
     * ApplicationName : Default application name for the helper
     */
	var defaultApplicationName = "programPlannerApp";

	/**
     * Compile : Compile html with the rootScope of an application
     *  and replace the content of a target element with the compiled html
     * @elementId : The ID for the container where the html will be placed
     * @htmlToCompile : The html to compile using angular
     */
	AngularHelper.Compile = function (elementId, htmlToCompile)
	{
		var $injector = angular.injector(["ng", defaultApplicationName]);
		$injector.invoke(["$compile", "$rootScope", function ($compile, $rootScope)
		{
			var element = angular.element(document.getElementById(elementId));
			//Get the scope of the target, use the rootScope if it does not exist
			var $scope = element.html(htmlToCompile).scope();
			$compile(element)($scope || $rootScope);
			$rootScope.$digest();
		}]);
	}
	return AngularHelper;
})();