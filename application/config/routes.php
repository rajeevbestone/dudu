<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in agetToSleepAdd
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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'AdminController/dashboard';
$route['dashboard'] = 'AdminController/dashboard';
$route['authenticate'] = 'AdminController/Auth';

// Home Page Starts
$route["home"] = "AdminController/homePage";
// Home Page Ends

//Masters Starts
$route['languages'] = 'AdminController/languages';
$route['durations'] = 'AdminController/durations';
$route['programs'] = 'AdminController/programs';
$route['packages'] = 'AdminController/packages';
$route['ageGroup'] = 'AdminController/ageGroup';
$route['gender'] = 'AdminController/gender';
$route['users'] = 'AdminController/users';
$route['usersFeed'] = 'AdminController/usersFeed';
$route['pages'] = 'AdminController/pages';
//Masters Ends

$route["privacypolicy"] = 'AdminController/privacyPolicyData';
$route["termsandconditions"] = 'AdminController/termsandconditionsData';

//Modules Starts
$route['getToSleep'] = 'AdminController/get_to_sleep';
$route['getToSleepAdd'] = 'AdminController/get_to_sleep_add';
$route['editGetToSleep'] = 'AdminController/editGetToSleep';
$route['sleepEnhancer'] = 'AdminController/sleep_enhancer';
$route['sleepEnhancerAdd'] = 'AdminController/sleep_enhancer_add';
$route['editSleepEnahncer'] = 'AdminController/edit_sleep_enahncer';
$route['wakeUpList'] = 'AdminController/wakeUp_list';
$route['wakeUpAdd'] = 'AdminController/wakeUp_add';
$route['editWakeUp'] = 'AdminController/editWakeUp';
$route['libraryMgmt'] = 'AdminController/libraryMgmt';
$route['addLibraryMgmtYtLink'] = 'AdminController/addLibraryMgmtYtLink';
$route['editLibraryMgmtYtLink'] = 'AdminController/editLibraryMgmtYtLink';
$route['feedBack'] = 'AdminController/feedBack';
$route['introVideosManagement'] = 'AdminController/introVideosManagement';

//new

$route['videoManagement'] = 'AdminController/videoManagement';
$route['programManagement'] = 'AdminController/programManagement';
$route['feedback'] = 'AdminController/feedback';
$route['feedbackData'] = 'AdminController/feedbackData';
$route['feedbackHistory'] = 'AdminController/feedbackHistory';
$route['feedbackSuggestion'] = 'AdminController/feedbackSuggestion';
$route['feedbackSingleData'] = 'AdminController/feedbackSingleData';

$route['dud_songs'] = 'AdminController/dud_songs';
$route['dudSongs_add'] = 'AdminController/dudSongs_add';

//feedback starts
$route['userFeedback'] = 'AdminController/userFeedback';
$route['userFeedbackHistory'] = 'AdminController/userFeedbackHistory';

$route['getUser'] = 'AdminController/UserCheck';
//feedback ends

//Modules Ends


// API Starts
$route['Api/test'] = 'web/Api/test';
$route['Api/versionCheck'] = 'web/Api/versionCheck';
$route['Api/getAllLanguages'] = 'web/Api/getAllLanguages';
$route['Api/getAllGenders'] = 'web/Api/getAllGenders';
$route['Api/getAllAgeGroups'] = 'web/Api/getAllAgeGroups';
$route['Api/getIntroVideos'] = 'web/Api/getIntroVideos';
$route['Api/signup'] = 'AdminController/register_post';
$route['Api/login'] = 'web/Api/login';
$route['Api/resetPassword'] = 'web/Api/resetPassword';
$route['Api/forgotPassword_generateOTP'] = 'web/Api/forgotPassword_generateOTP';
$route['Api/forgotPassword_savePwd'] = 'web/Api/forgotPassword_savePwd';
// API Ends

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
