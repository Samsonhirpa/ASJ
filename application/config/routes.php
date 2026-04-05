<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['default_controller'] = "login";
$route['404_override'] = 'error_404';
$route['translate_uri_dashes'] = FALSE;


/*********** USER DEFINED ROUTES *******************/

// Auth Routes
$route['loginMe'] = 'login/loginMe';
$route['logout'] = 'user/logout';
$route['forgotPassword'] = 'login/forgotPassword';
$route['register'] = 'login/register';
$route['registerAuthor'] = 'login/registerAuthor';
$route['resetPasswordUser'] = 'login/resetPasswordUser';
$route['resetPasswordConfirmUser'] = 'login/resetPasswordConfirmUser';
$route['resetPasswordConfirmUser/(:any)'] = 'login/resetPasswordConfirmUser/$1';
$route['resetPasswordConfirmUser/(:any)/(:any)'] = 'login/resetPasswordConfirmUser/$1/$2';
$route['createPasswordUser'] = 'login/createPasswordUser';

// Dashboard
$route['dashboard'] = 'user/index';

// User Management Routes
$route['userListing'] = 'user/userListing';
$route['userListing/(:num)'] = "user/userListing/$1";
$route['addNew'] = "user/addNew";
$route['addNewUser'] = "user/addNewUser";
$route['editOld/(:num)'] = "user/editOld/$1";
$route['editUser'] = "user/editUser";
$route['deleteUser'] = "user/deleteUser";
$route['profile'] = "user/profile";
$route['profile/(:any)'] = "user/profile/$1";
$route['profileUpdate'] = "user/profileUpdate";
$route['profileUpdate/(:any)'] = "user/profileUpdate/$1";
$route['loadChangePass'] = "user/loadChangePass";
$route['changePassword'] = "user/changePassword";
$route['changePassword/(:any)'] = "user/changePassword/$1";
$route['pageNotFound'] = "user/pageNotFound";
$route['checkEmailExists'] = "user/checkEmailExists";
$route['login-history'] = "user/loginHistoy";
$route['login-history/(:num)'] = "user/loginHistoy/$1";
$route['login-history/(:num)/(:num)'] = "user/loginHistoy/$1/$2";

// Roles Routes
$route['roleListing'] = "roles/roleListing";
$route['roleListing/(:num)'] = "roles/roleListing/$1";
$route['roleListing/(:num)/(:num)'] = "roles/roleListing/$1/$2";

// Booking Routes
$route['booking'] = "booking";
$route['booking/(:num)'] = "booking/index/$1";
$route['addNewBooking'] = "booking/addNewBooking";
$route['editBooking/(:num)'] = "booking/editBooking/$1";
$route['updateBooking'] = "booking/updateBooking";
$route['deleteBooking'] = "booking/deleteBooking";

// Task Routes
$route['task'] = "task";
$route['task/(:num)'] = "task/index/$1";
$route['addNewTask'] = "task/addNewTask";
$route['editTask/(:num)'] = "task/editTask/$1";
$route['updateTask'] = "task/updateTask";
$route['deleteTask'] = "task/deleteTask";

// ============================================
// JOURNAL ROUTES
// ============================================

// Public Journal Routes
$route['journal'] = 'journal/index';
$route['journal/about'] = 'journal/about';
$route['journal/aims-scope'] = 'journal/aims_scope';
$route['journal/editorial-board'] = 'journal/editorial_board';
$route['journal/current-issue'] = 'journal/current_issue';
$route['journal/archive'] = 'journal/archive';
$route['journal/issue/(:num)'] = 'journal/issue/$1';
$route['journal/manuscript/(:num)'] = 'journal/manuscript/$1';
$route['journal/article/(:num)'] = 'journal/article/$1';
$route['journal/article/(:any)'] = 'journal/article/$1';
$route['journal/search'] = 'journal/search';
$route['journal/author-guidelines'] = 'journal/author_guidelines';
$route['journal/reviewer-guidelines'] = 'journal/reviewer_guidelines';
$route['journal/contact'] = 'journal/contact';

// Author Module Routes
// Author Routes
$route['author/dashboard'] = 'author/dashboard/index';
$route['author/dashboard/profile'] = 'author/dashboard/profile';
$route['author/manuscript'] = 'author/manuscript/index';
$route['author/manuscript/submit'] = 'author/manuscript/submit';
$route['author/manuscript/step2'] = 'author/manuscript/step2';
$route['author/manuscript/step3'] = 'author/manuscript/step3';
$route['author/manuscript/submitStep1'] = 'author/manuscript/submitStep1';
$route['author/manuscript/submitStep2'] = 'author/manuscript/submitStep2';
$route['author/manuscript/finalSubmit'] = 'author/manuscript/finalSubmit';
$route['author/manuscript/view/(:num)'] = 'author/manuscript/view/$1';
$route['author/manuscript/payment'] = 'author/manuscript/payment';
$route['author/manuscript/payment/submit/(:num)'] = 'author/manuscript/submitPayment/$1';

// Reviewer Routes (add these later)
$route['reviewer/dashboard'] = 'reviewer/dashboard/index';
$route['reviewer/assignments'] = 'reviewer/assignment/index';

// Editor Routes (add these later)
$route['editor/dashboard'] = 'editor/dashboard/index';
$route['editor/pending'] = 'editor/manuscript/pending';

// Reviewer Module Routes (Coming Soon)
$route['reviewer/dashboard'] = 'reviewer/dashboard/index';
$route['reviewer/assignments'] = 'reviewer/assignment/index';
$route['reviewer/completed'] = 'reviewer/assignment/completed';
$route['reviewer/dashboard/reminders'] = 'reviewer/dashboard/reminders';
$route['reviewer/assignment/(:num)'] = 'reviewer/assignment/view/$1';
$route['reviewer/assignment/download/(:num)'] = 'reviewer/assignment/downloadManuscript/$1';
$route['reviewer/assignment/accept/(:num)'] = 'reviewer/assignment/accept/$1';
$route['reviewer/assignment/decline/(:num)'] = 'reviewer/assignment/decline/$1';
$route['reviewer/assignment/submit/(:num)'] = 'reviewer/assignment/submitReview/$1';

// Editor Module Routes (Coming Soon)
$route['editor/dashboard'] = 'editor/dashboard/index';
$route['editor/pending'] = 'editor/manuscript/pending';
$route['editor/manuscript/(:num)'] = 'editor/manuscript/view/$1';
$route['editor/assign-reviewers/(:num)'] = 'editor/manuscript/assignReviewers/$1';
$route['editor/decision/(:num)'] = 'editor/manuscript/makeDecision/$1';
$route['editor/all-manuscripts'] = 'editor/manuscript/index';

$route['editor/all'] = 'editor/manuscript/index';
$route['editor/assignments'] = 'editor/manuscript/reviewProgress';
$route['editor/assignments/view/(:num)'] = 'editor/manuscript/reviewProgressView/$1';
$route['editor/assignments/decision/(:num)'] = 'editor/manuscript/reviewProgressDecision/$1';
$route['editor/screening/(:num)'] = 'editor/manuscript/screening/$1';
$route['editor/plagiarism/(:num)'] = 'editor/manuscript/plagiarism/$1';
$route['editor/review-approval/(:num)/(:num)'] = 'editor/manuscript/approveReview/$1/$2';
$route['editor/payment'] = 'editor/manuscript/payment';
$route['editor/published'] = 'editor/manuscript/published';
$route['editor/payment/save/(:num)'] = 'editor/manuscript/savePayment/$1';
$route['editor/payment/publish/(:num)'] = 'editor/manuscript/publishFromPayment/$1';
$route['editor/board'] = 'editor/chief/board';
$route['editor/ethics'] = 'editor/chief/ethics';
$route['editor/policies'] = 'editor/chief/policies';
$route['editor/override-decision/(:num)'] = 'editor/chief/overrideDecision/$1';

// Issue Management Routes (Coming Soon)
$route['admin/issues'] = 'admin/issue/index';
$route['admin/issues/create'] = 'admin/issue/create';
$route['admin/issues/edit/(:num)'] = 'admin/issue/edit/$1';
$route['admin/issues/publish/(:num)'] = 'admin/issue/publish/$1';
$route['admin/issues/delete/(:num)'] = 'admin/issue/delete/$1';

/* End of file routes.php */
/* Location: ./application/config/routes.php */
