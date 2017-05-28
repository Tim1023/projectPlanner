function AdminProgramSemesterCourseController($scope, $uibModal, $timeout, programPlannerApiService) {
    var self = this;
    self.initialData = null;
    self.programSemester = [];
    self.compulsoryCourses = [];
    self.programId = 0;
    self.programSemesterId = 0;
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
                    self.programSemester = newValue;
                    self.programId =  newValue["program_id"];
                    self.programSemesterId =  newValue["id"];
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
     * gets the list of compulsory courses for this program
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
     * get the list of all courses available for this program
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

    this.toggleCourseCompulsory = function(course){
        var courseId = course.id;
        course.isLoading = true;
        if(self.compulsoryCourses.indexOf(courseId) === -1){
            this.removeCompulsoryCourse(self.programId, course);
        } else {
            this.addCompulsoryCourse(self.programId, course);
        }
    }

    /**
     * mark course as compulsory - applies program wide
     * @param programId
     * @param course
     */
    this.addCompulsoryCourse = function(programId, course){
        programPlannerApiService.addCompulsoryCourse(programId, course.id)
            .then(function (response) {
                if (!response.success) {
                    self.processResponse(response);
                    return;
                }
                // add to compulsory courses
                self.compulsoryCourses.push(course.id);
                self.processResponse(response);
            })
            .catch(function (response) {
                self.processResponse(response, "error");
            })
            .finally(function () {
                course.isLoading = false;
            });
    }

    /**
     * mark course as optional - applies program wide
     * @param programId
     * @param course
     */
    this.removeCompulsoryCourse = function(programId, course){
        programPlannerApiService.removeCompulsoryCourse(programId, course.id)
            .then(function (response) {
                if (!response.success) {
                    self.processResponse(response);
                    return;
                }
                // remove from compulsory courses
                var index = self.compulsoryCourses.indexOf(course.id);
                self.compulsoryCourses.splice(index, 1);
                self.processResponse(response);
            })
            .catch(function (response) {
                self.processResponse(response, "error");
            })
            .finally(function () {
                course.isLoading = false;
            });
    }

    /**
     * add a course to this instance of semester
     */
    this.addCourseToSemester = function () {
        if(self.newCourse !== null){
            var request = {
                program_id: self.programId,
                program_semester_id : self.programSemesterId,
                course_id : self.newCourse.id
            };
            programPlannerApiService.addProgramSemesterCourse(request)
                .then(function (response) {
                    if (!response.success) {
                        self.processResponse(response);
                        return;
                    }
                    // add course to semester
                    self.programSemester["courses"].push(self.newCourse);
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
                program_id: self.programId,
                program_semester_id : self.programSemesterId,
                course_id : course.id
            };
            programPlannerApiService.removeProgramSemesterCourse(request)
                .then(function (response) {
                    if (!response.success) {
                        self.processResponse(response);
                        return;
                    }
                    // remove course to semester
                    // remove from compulsory courses
                    var index = self.programSemester["courses"].indexOf(course);
                    self.programSemester["courses"].splice(index, 1);
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
programPlannerModule.controller("adminProgramSemesterCourseController", ["$scope", "$uibModal", "$timeout", "programPlannerApiService", AdminProgramSemesterCourseController]);
