<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'login_controller/index';
$route['404_override'] = '';
$route['error500'] = 'error_controller';
$route['translate_uri_dashes'] = TRUE;


// $route['log-user'] = 'login_controller/login_validation';


$route['dashboard'] = 'dashboard_controller/index';
$route['user-logout'] = 'login_controller/logout';


//************************************** BARANGAY ROUTES
//**************************************

$route['barangays-page'] = 'barangays/barangays_controller';

$route['showlist-barangays'] = 'barangays/barangays_controller/ajax_list';

$route['edit-barangay/(:num)'] = 'barangays/barangays_controller/ajax_edit/$1';

$route['add-barangay/(:num)'] = 'barangays/barangays_controller/ajax_add/$1';

$route['update-barangay/(:num)'] = 'barangays/barangays_controller/ajax_update/$1';

$route['delete-barangay/(:num)'] = 'barangays/barangays_controller/ajax_delete/$1';


//************************************** SCHEDULE ROUTES
//**************************************

$route['schedules-page'] = 'schedules/schedules_controller';

$route['showlist-schedules'] = 'schedules/schedules_controller/ajax_list';

$route['edit-schedule/(:num)'] = 'schedules/schedules_controller/ajax_edit/$1';

$route['add-schedule/(:num)'] = 'schedules/schedules_controller/ajax_add/$1';

$route['update-schedule/(:num)'] = 'schedules/schedules_controller/ajax_update/$1';

$route['delete-schedule/(:num)'] = 'schedules/schedules_controller/ajax_delete/$1';


//************************************** CIS ROUTES
//**************************************

$route['cis-page'] = 'cis/cis_controller';

$route['showlist-cis'] = 'cis/cis_controller/ajax_list';

$route['edit-cis/(:num)'] = 'cis/cis_controller/ajax_edit/$1';

$route['add-cis/(:num)'] = 'cis/cis_controller/ajax_add/$1';

$route['update-cis/(:num)'] = 'cis/cis_controller/ajax_update/$1';

$route['delete-cis/(:num)'] = 'cis/cis_controller/ajax_delete/$1';


//************************************** PROFILES ROUTES
//**************************************

$route['profiles-page/(:num)'] = 'profiles/profiles_controller/index/$1';

$route['profiles-page/edit-cis-page/(:num)'] = 'profiles/profiles_controller/edit_cis_view/$1';

$route['profiles-page/add-his-page/(:num)'] = 'his/his_controller/add_his_view/$1';

$route['profiles-page/edit-his-page/(:num)'] = 'his/his_controller/edit_his_view/$1';

// $route['showlist-cis'] = 'cis/cis_controller/ajax_list';

// $route['edit-cis/(:num)'] = 'cis/cis_controller/ajax_edit/$1';

// $route['add-cis/(:num)'] = 'cis/cis_controller/ajax_add/$1';

// $route['update-cis/(:num)'] = 'cis/cis_controller/ajax_update/$1';

// $route['delete-cis/(:num)'] = 'cis/cis_controller/ajax_delete/$1';


//************************************** HVI ROUTES
//**************************************

$route['profiles-page/hvi-page/(:num)'] = 'hvi/hvi_controller/index/$1';

$route['profiles-page/showlist-hvi/(:num)'] = 'hvi/hvi_controller/ajax_list/$1';

$route['profiles-page/edit-hvi/(:num)'] = 'hvi/hvi_controller/ajax_edit/$1';

$route['profiles-page/add-hvi/(:num)'] = 'hvi/hvi_controller/ajax_add/$1';

$route['profiles-page/update-hvi/(:num)'] = 'hvi/hvi_controller/ajax_update/$1';

$route['profiles-page/delete-hvi/(:num)'] = 'hvi/hvi_controller/ajax_delete/$1';


//************************************** DEWORMING ROUTES
//**************************************

$route['deworming-page'] = 'deworming/deworming_controller';

$route['showlist-deworming'] = 'deworming/deworming_controller/ajax_list';

$route['edit-deworming/(:num)'] = 'deworming/deworming_controller/ajax_edit/$1';

$route['add-deworming/(:num)'] = 'deworming/deworming_controller/ajax_add/$1';

$route['update-deworming/(:num)'] = 'deworming/deworming_controller/ajax_update/$1';

$route['delete-deworming/(:num)'] = 'deworming/deworming_controller/ajax_delete/$1';


//************************************** MONTHLY CHECKUP ROUTES
//**************************************

$route['monthly-page'] = 'monthly/monthly_controller';

$route['showlist-monthly'] = 'monthly/monthly_controller/ajax_list';

$route['edit-monthly/(:num)'] = 'monthly/monthly_controller/ajax_edit/$1';

$route['add-monthly/(:num)'] = 'monthly/monthly_controller/ajax_add/$1';

$route['update-monthly/(:num)'] = 'monthly/monthly_controller/ajax_update/$1';

$route['delete-monthly/(:num)'] = 'monthly/monthly_controller/ajax_delete/$1';


//************************************** GRADUATED CHILDERN ROUTES
//**************************************

$route['graduated-page'] = 'graduated/graduated_controller';

$route['showlist-graduated'] = 'graduated/graduated_controller/ajax_list';

$route['edit-graduated/(:num)'] = 'graduated/graduated_controller/ajax_edit/$1';

$route['add-graduated/(:num)'] = 'graduated/graduated_controller/ajax_add/$1';

$route['update-graduated/(:num)'] = 'graduated/graduated_controller/ajax_update/$1';

$route['delete-graduated/(:num)'] = 'graduated/graduated_controller/ajax_delete/$1';


//************************************** ATTENDANCE ROUTES
//**************************************

// $route['current-attendance-page'] = 'attendance/attendance_controller/index/' . date('Y-m-d');

$route['attendance-page/(:any)'] = 'attendance/attendance_controller/index/$1';

$route['showlist-attendance'] = 'attendance/attendance_controller/ajax_list';

$route['add-attendance/(:num)'] = 'attendance/attendance_controller/ajax_add/$1';

$route['delete-attendance/(:num)/(:num)'] = 'attendance/attendance_controller/ajax_delete/$1/$2';


//************************************** PROFILES DEWORMING ROUTES
//**************************************

$route['profiles-deworming-page/(:num)'] = 'profiles/profiles_deworming_controller/index/$1';


//************************************** PROFILES MONTHLY ROUTES
//**************************************

$route['profiles-monthly-page/(:num)'] = 'profiles/profiles_monthly_controller/index/$1';


//************************************** NOTIFICATIONS ROUTES
//**************************************

$route['notifications-page/notifications-monthly-page'] = 'notifications/notifications_controller/index/monthly';

$route['notifications-page/notifications-quarterly-page'] = 'notifications/notifications_controller/index/quarterly';

$route['notifications-page/notifications-deworming-page'] = 'notifications/notifications_controller/index/deworming';

$route['notifications-page/notifications-severe-page'] = 'notifications/notifications_controller/index/severe';





//************************************** LOGS ROUTES
//**************************************

$route['logs-page'] = 'logs/logs_controller';

$route['showlist-cis'] = 'logs/logs_controller/ajax_list';



//************************************** STATISTICS ROUTES
//**************************************


$route['statistics-page'] = 'statistics/statistics_controller/index';



//************************************** REPORTS (TCPDF) ROUTES
//**************************************

// cis report

$route['reports-page'] = 'reports/reports_controller';

$route['cis-report-active-male'] = 'pdf_reports/pdf_cis_report_controller/index/Male';

$route['cis-report-active-female'] = 'pdf_reports/pdf_cis_report_controller/index/Female';

$route['cis-report-graduated-male'] = 'pdf_reports/pdf_grad_report_controller/index/Male';

$route['cis-report-graduated-female'] = 'pdf_reports/pdf_grad_report_controller/index/Female';

// monthly checkup report

$route['monthly-report-male/(:num)/(:num)'] = 'pdf_reports/pdf_monthly_report_controller/index/Male/$1/$2';

$route['monthly-report-female/(:num)/(:num)'] = 'pdf_reports/pdf_monthly_report_controller/index/Female/$1/$2';

// child profile report

$route['child-report/(:num)'] = 'pdf_reports/pdf_child_report_controller/index/$1';



//************************************** HVI ROUTES
//**************************************

$route['profiles-page/dec-tree-page/(:num)'] = 'dec_tree/dec_tree_controller/index/$1';



//************************************** USERS
//**************************************

$route['users-page'] = 'users/users_controller/index';

$route['showlist-users'] = 'users/users_controller/ajax_list';

$route['edit-user/(:num)'] = 'users/users_controller/ajax_edit/$1';

$route['add-user/(:num)'] = 'users/users_controller/ajax_add/$1';

$route['update-user/(:num)'] = 'users/users_controller/ajax_update/$1';

$route['edit-priveleges/(:num)'] = 'users/users_controller/ajax_edit/$1';

$route['update-priveleges/(:num)'] = 'users/users_controller/ajax_priveleges_update/$1';

$route['delete-user/(:num)'] = 'users/users_controller/ajax_delete/$1';




//************************************** REPORT
//**************************************
			//** SALES **//
// $route['report/sales-report'] = 'sales_report/sales_report_controller';

// $route['report/sales-report/print-report/(:any)/(:any)'] = 'sales_report/sales_report_controller/ajax_set_report/$1/$2';


			//** INVENTORY **//
// $route['report/inventory-report'] = 'inventory_report/inventory_report_controller';

// $route['report/inventory-report/print-report'] = 'inventory_report/inventory_report_controller/ajax_set_report';

// $route['report/inventory-report/print-report-damaged'] = 'inventory_report/inventory_report_controller/ajax_set_report_damaged';

// $route['report/inventory-report/print-report-borrow'] = 'inventory_report/inventory_report_controller/ajax_set_report_borrow';

// data = [{
//     y: percent_active,
//     color: colors[0],
//     drilldown: {
//         name: 'Active genders',
//         categories: ['Male', 'Female'],
//         data: [((children_active_male / total_children_count) * 100), ((children_active_female / total_children_count) * 100)],
//         color: colors[0]
//     }
// }, {
//     y: percent_graduated,
//     color: colors[1],
//     drilldown: {
//         name: 'Graduated genders',
//         categories: ['Male', 'Female'],
//         data: [((children_graduated_male / total_children_count) * 100), ((children_graduated_female / total_children_count) * 100)],
//         color: colors[1]
//     }
// }],