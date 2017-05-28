function ProgramPlannerApiService($http, $q) {
    return {
        getCompulsoryCourse: function(programId) {
            return $http.get('/admin/programs/'+ programId +'/compulsory/index')
                .then(function(response) {
                    return response.data;
                });
        },
        addCompulsoryCourse: function(programId, courseId) {
            return $http.get('/admin/programs/'+ programId +'/compulsory/create/' + courseId)
                .then(function(response) {
                    return response.data;
                });
        },
        removeCompulsoryCourse: function(programId, courseId) {
            return $http.get('/admin/programs/'+ programId +'/compulsory/destroy/' + courseId)
                .then(function(response) {
                    return response.data;
                });
        },
        addProgramSemesterCourse: function(request) {
            return $http.post('/admin/program_semesters/'+request.program_semester_id+'/courses/create', request)
                .then(function(response) {
                    return response.data;
                });
        },
        removeProgramSemesterCourse: function(request) {
            return $http.post('/admin/program_semesters/'+request.program_semester_id+'/courses/destroy', request)
                .then(function(response) {
                    return response.data;
                });
        },
        addPathwaySemesterCourse: function(request) {
            return $http.post('/admin/pathway_semesters/'+request.pathway_semester_id+'/courses/create', request)
                .then(function(response) {
                    return response.data;
                });
        },
        removePathwaySemesterCourse: function(request) {
            return $http.post('/admin/pathway_semesters/'+request.pathway_semester_id+'/courses/destroy', request)
                .then(function(response) {
                    return response.data;
                });
        },
        getCourses: function(){
            return $http.get('/admin/api/courses')
                .then(function(response){
                    return response.data;
                });
        },
    }
}

programPlannerModule.factory("programPlannerApiService", ["$http", "$q", ProgramPlannerApiService]);