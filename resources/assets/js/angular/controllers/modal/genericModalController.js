/**
 * Use this modal controller only if the content for the modal is to be requires calls to server
 */
function ModalController($scope, $uibModal) {
    var self = this;
    this.init = function () {    return;   }

    /**
     * @param templateUrl       the id of the angular modal container, it must be loaded in DOM
     * @param controllerName    the name of controller to manage the scope of the modal
     * @param modalSize         the size of the modal
     *  
     */
    this.open = function (templateUrl, controllerName, modalSize) {
        var modal = $uibModal.open({
            templateUrl: templateUrl,
            controller: controllerName + ' as modal',
            size: modalSize ? modalSize : 'lg',
            backdrop: 'static', // disable modal close by clicking outside modal
            keyboard: false, // disable modal close by ESC key
        });
    }

    this.init();
}


programPlannerModule.controller("modalController", ["$scope", "$uibModal", ModalController]);
