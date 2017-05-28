<div class="panel-body clearfix" ng-controller="adminProgramSemesterCourseController as asc" ng-cloak>
    <server-side-data bind-property="asc.initialData"
                      value="<?php echo htmlentities($model); ?>"
                      parse-json="true"></server-side-data>
    <div class="col-sm-12 form-group">
        <label class="control-label">Courses</label><br/>
        <div ng-show="asc.message != null"
             ng-class="asc.message != null ? 'alert alert-dismissible alert-' + asc.message.type : ''"
             role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-close"></i></span>
                </button>
                <% asc.message.content %>
        </div>

    </div>
    <div class="col-sm-12 form-group">
        <ui-select ng-model="asc.newCourse" theme="bootstrap" class="col-sm-10">
            <ui-select-match>
                <span ng-bind="$select.selected.name"></span>
            </ui-select-match>
            <ui-select-choices repeat="item in (asc.courses | filter: $select.search) track by item.id">
                <span ng-bind="item.course_number"></span> - <span ng-bind="item.name"></span>
            </ui-select-choices>
        </ui-select>
        <button type="button"
                class="btn btn-success col-sm-2"
                ng-click="asc.addCourseToSemester()">
            <i class="fa fa-plus"></i>&nbsp;Add Course
        </button>
    </div>
    <div class="table-responsive col-sm-12" ng-show="asc.programSemester.courses.length > 0">
        <table class="table">
            <thead>
            <tr>
                <th class="col-sm-2">Course Number</th>
                <th class="col-sm-7">Name</th>
                <th class="col-sm-3 text-right">Actions</th>
            </tr>
            </thead>
            <tbody>
                <tr ng-repeat="course in asc.programSemester.courses | orderBy: '+course_number'">
                    <td class="col-sm-2"><% course.course_number %></td>
                    <td class="col-sm-7">
                        <% course.name %>&nbsp;
                    </td>
                    <td class="col-sm-3">
                        <div class="btn-group  pull-right">
                            <button type="button"
                                    class="btn btn-default"
                                    ng-click="asc.toggleCourseCompulsory(course)"
                                    ng-disabled="course.isLoading">
                                <span ng-show="asc.compulsoryCourses.indexOf(course.id) !== -1">Mark Elective</span>
                                <span ng-show="asc.compulsoryCourses.indexOf(course.id) === -1">Mark Compulsory</span>
                            </button>
                            <button type="button"
                                    class="btn btn-danger"
                                    ng-click="asc.removeCourseFromSemester(course)">
                                <i class="fa fa-trash"></i>&nbsp;Delete
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
