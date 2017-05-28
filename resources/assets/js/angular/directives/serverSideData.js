/// allows injecting data directly into the controller scope.
/// set parse-json to 'true' to get angular to parse the value as JSON.
/// note that any values set this way will not be initialised when the controller is initialised so allow for late binding
/// example:
/// <server-side-data bind-property="ctrl.property" value="server-side-value" parse-json="false"></server-side-data>
///
programPlannerModule.directive('serverSideData', [function () {

    return {
        scope: {
            bindProperty: '='
        },

        link: function (scope, element, attrs)
        {
            if (attrs.parseJson === 'true') {
                scope.bindProperty = angular.fromJson(attrs.value);
            } else {
                scope.bindProperty = attrs.value;
            }
        }
    };

}]);