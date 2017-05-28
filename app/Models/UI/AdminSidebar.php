<?php
namespace ProgramPlanner\Models\UI;


use Illuminate\Support\Collection;
use ProgramPlanner\Http\Controllers\AdminController;

class AdminSidebar implements NavigationMenu
{
    /**
     * @return Collection
     */
    public static function createMenu(){
        // Admin Dashboard Home
        $adminDashboard = new NavigationMenuItem();
        $adminDashboard->title = 'Dashboard';
        $adminDashboard->active = 'AdminController';
        $adminDashboard->route = 'admin.index';

        // Admin Departments
        $adminDepartments = new NavigationMenuItem();
        $adminDepartments->title = 'Departments';
        $adminDepartments->active = 'DepartmentController';
        $adminDepartments->route = 'admin.departments.index';

        // Admin Programs
        $adminPrograms = new NavigationMenuItem();
        $adminPrograms->title = 'Programs';
        $adminPrograms->active = 'ProgramController';
        $adminPrograms->route = 'admin.programs.index';

        // Admin Pathways
        $adminPathways = new NavigationMenuItem();
        $adminPathways->title = 'Pathways';
        $adminPathways->active = 'PathwayController';
        $adminPathways->route = 'admin.pathways.index';

        // Admin Courses
        $adminCourses = new NavigationMenuItem();
        $adminCourses->title = 'Courses';
        $adminCourses->active = 'CourseController';
        $adminCourses->route = 'admin.courses.index';

        // Admin Careers
        $adminCareers = new NavigationMenuItem();
        $adminCareers->title = 'Careers';
        $adminCareers->active = 'CareerController';
        $adminCareers->route = 'admin.careers.index';

        $sidebarMenu = new Collection([
            $adminDashboard,
            $adminDepartments,
            $adminPrograms,
            $adminPathways,
            $adminCourses,
            $adminCareers
        ]);

        return $sidebarMenu;
    }
}