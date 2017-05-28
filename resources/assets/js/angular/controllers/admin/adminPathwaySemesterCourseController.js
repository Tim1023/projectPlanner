function AdminPathwaySemesterCourseController($scope, $timeout, programPlannerApiService) {
    var self = this;
    self.initialData = null;
    self.pathwaySemester = [];
    self.programId = 0;
    self.compulsoryCourses = [];
    self.pathwayId = 0;
    self.pathwaySemesterId = 0;
    self.courses = [];
    self.newCourse = null;
    self.error = false;
    self.message = null;

    this.init = function () {
        $scope.$watch(
            function () {
                return self.initialData;
            }, function (newValue) {
                if (newValue != null) {
                    self.pathwaySemester = newValue;
                    self.pathwayId =  newValue["pathway_id"];
                    self.programId =  newValue["program_id"];
                    self.pathwaySemesterId =  newValue["id"];
                    self.updateCompulsoryCourses();
                    self.getCourses();
                }
            }
        )
    }

    /**
     * displays a message in relation to this semester
     * @param message
     * @param type
     */
    this.setMessage =   function(message, type){
        console.log(message);
        if(message && message.length > 0){
            self.message = {
                content: message,
                type: type
            };
            // null message after five seconds
            $timeout(function() {
                self.message = null;
            }, 5000);
        }
    }

    /**
     * processes the response and displays error/ success message
     * @param response
     * @param responseType
     */
    this.processResponse = function(response, responseType){
        console.log(response.message);
        if(responseType){
            console.log('error!');
            self.error = true;
            return;
        }
        if (!response.success) {
            console.log('error!');
            self.error = true;
            self.setMessage(response.message, "danger");
        } else {
            console.log('ok!');
            self.error = false;
            self.setMessage(response.message, "success");
        }
        return;
    }

    /**
     * gets the list of compulsory courses for this pathway
      */
    this.updateCompulsoryCourses = function(){
        programPlannerApiService.getCompulsoryCourse(self.programId)
            .then(function (response) {
                if (!response.success) {
                    self.processResponse(response);
                    return;
                }
                self.compulsoryCourses = response.data;
                self.processResponse(response);
            })
            .catch(function (response) {
                self.processResponse(response, "error");
            })
            .finally(function () {
            });

    }

    /**
     * get the list of all courses available for this pathway
     */
    this.getCourses = function(){
        programPlannerApiService.getCourses()
            .then(function (response) {
                if (!response.success) {
                    self.processResponse(response);
                    return;
                }
                self.courses = response.data;
                self.processResponse(response);
            })
            .catch(function (response) {
                self.processResponse(response, "error");
            })
            .finally(function () {
            });

    }

    /**
     * add a course to this instance of semester
     */
    this.addCourseToSemester = function () {
        if(self.newCourse !== null){
            var request = {
                pathway_id: self.pathwayId,
                pathway_semester_id : self.pathwaySemesterId,
                course_id : self.newCourse.id
            };
            programPlannerApiService.addPathwaySemesterCourse(request)
                .then(function (response) {
                    if (!response.success) {
                        self.processResponse(response);
                        return;
                    }
                    // add course to semester
                    self.pathwaySemester["courses"].push(self.newCourse);
                    self.newCourse = null;
                    self.processResponse(response);
                })
                .catch(function (response) {
                    self.processResponse(response, "error");
                })
                .finally(function () {
                });
        }
    }

    /**
     * remove course from this instance of semester
     * @param course
     */
    this.removeCourseFromSemester = function (course) {
        if(course !== null){
            var request = {
                pathway_id: self.pathwayId,
                pathway_semester_id : self.pathwaySemesterId,
                course_id : course.id
            };
            programPlannerApiService.removePathwaySemesterCourse(request)
                .then(function (response) {
                    if (!response.success) {
                        self.processResponse(response);
                        return;
                    }
                    // remove course to semester
                    // remove from compulsory courses
                    var index = self.pathwaySemester["courses"].indexOf(course);
                    self.pathwaySemester["courses"].splice(index, 1);
                    self.processResponse(response);
                })
                .catch(function (response) {
                    self.processResponse(response, "error");
                })
                .finally(function () {
                });
        }
    }

    this.init();
}
programPlannerModule.controller("adminPathwaySemesterCourseController", ["$scope", "$timeout", "programPlannerApiService", AdminPathwaySemesterCourseController]);
