<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class User extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->isLoggedIn();
        
        // Create upload directory if not exists
        $this->createUploadDirectory();
    }
    
    /**
     * Create upload directory for profile images
     */
    private function createUploadDirectory()
    {
        $path = './uploads/profile_images/';
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
    }
    
    /**
     * Handle profile image upload
     */
    private function uploadProfileImage($fileName = '')
    {
        // Load upload library
        $this->load->library('upload');
        
        // Configure upload
        $config['upload_path'] = './uploads/profile_images/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = 2048; // 2MB
        $config['max_width'] = 1024;
        $config['max_height'] = 1024;
        $config['encrypt_name'] = true; // Encrypt filename for security
        
        $this->upload->initialize($config);
        
        if (!empty($_FILES['profile_image']['name'])) {
            if ($this->upload->do_upload('profile_image')) {
                $uploadData = $this->upload->data();
                return $uploadData['file_name'];
            } else {
                // Upload failed
                $this->session->set_flashdata('error', $this->upload->display_errors());
                return false;
            }
        } elseif (!empty($fileName) && file_exists('./uploads/profile_images/' . $fileName)) {
            // Keep existing file
            return $fileName;
        }
        
        return null; // No file uploaded
    }
    
    /**
     * Delete old profile image
     */
    private function deleteProfileImage($fileName)
    {
        if (!empty($fileName) && file_exists('./uploads/profile_images/' . $fileName)) {
            unlink('./uploads/profile_images/' . $fileName);
        }
    }
    
    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        $this->global['pageTitle'] = 'CodeInsect : Dashboard';
        
        $this->loadViews("general/dashboard", $this->global, NULL , NULL);
    }
    
    /**
     * This function is used to load the user list
     */
    function userListing()
    {
        if(!$this->isAdmin())
        {
            $this->loadThis();
        }
        else
        {        
            $searchText = '';
            if(!empty($this->input->post('searchText'))) {
                $searchText = $this->security->xss_clean($this->input->post('searchText'));
            }
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->user_model->userListingCount($searchText);

            $returns = $this->paginationCompress ( "userListing/", $count, 10 );
            
            $data['userRecords'] = $this->user_model->userListing($searchText, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'CodeInsect : User Listing';
            
            $this->loadViews("users/users", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addNew()
    {
        if(!$this->isAdmin())
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('user_model');
            $data['roles'] = $this->user_model->getUserRoles();
            
            $this->global['pageTitle'] = 'CodeInsect : Add New User';

            $this->loadViews("users/addNew", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to check whether email already exist or not
     */
    function checkEmailExists()
    {
        $userId = $this->input->post("userId");
        $email = $this->input->post("email");

        if(empty($userId)){
            $result = $this->user_model->checkEmailExists($email);
        } else {
            $result = $this->user_model->checkEmailExists($email, $userId);
        }

        if(empty($result)){ echo("true"); }
        else { echo("false"); }
    }
    
    /**
     * This function is used to add new user to the system
     */
    function addNewUser()
    {
        if(!$this->isAdmin())
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|max_length[128]');
            $this->form_validation->set_rules('password','Password','required|max_length[20]');
            $this->form_validation->set_rules('cpassword','Confirm Password','trim|required|matches[password]|max_length[20]');
            $this->form_validation->set_rules('role','Role','trim|required|numeric');
            $this->form_validation->set_rules('mobile','Mobile Number','required|min_length[10]');
            
            // Journal fields validation (optional)
            $this->form_validation->set_rules('institution','Institution','trim');
            $this->form_validation->set_rules('country','Country','trim');
            $this->form_validation->set_rules('orcid_id','ORCID ID','trim');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->addNew();
            }
            else
            {
                $name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
                $email = strtolower($this->security->xss_clean($this->input->post('email')));
                $password = $this->input->post('password');
                $roleId = $this->input->post('role');
                $mobile = $this->security->xss_clean($this->input->post('mobile'));
                $isAdmin = $this->input->post('isAdmin');
                
                // Journal fields
                $institution = $this->security->xss_clean($this->input->post('institution'));
                $department = $this->security->xss_clean($this->input->post('department'));
                $country = $this->security->xss_clean($this->input->post('country'));
                $city = $this->security->xss_clean($this->input->post('city'));
                $orcid_id = $this->security->xss_clean($this->input->post('orcid_id'));
                $expertise_area = $this->security->xss_clean($this->input->post('expertise_area'));
                $bio = $this->security->xss_clean($this->input->post('bio'));
                
                // Handle profile image upload
                $profile_image = $this->uploadProfileImage();
                
                $userInfo = array(
                    'email' => $email, 
                    'password' => getHashedPassword($password), 
                    'roleId' => $roleId,
                    'name' => $name, 
                    'mobile' => $mobile, 
                    'isAdmin' => $isAdmin,
                    'institution' => $institution,
                    'department' => $department,
                    'country' => $country,
                    'city' => $city,
                    'orcid_id' => $orcid_id,
                    'expertise_area' => $expertise_area,
                    'bio' => $bio,
                    'profile_image' => $profile_image,
                    'createdBy' => $this->vendorId, 
                    'createdDtm' => date('Y-m-d H:i:s')
                );
                
                $this->load->model('user_model');
                $result = $this->user_model->addNewUser($userInfo);
                
                if($result > 0){
                    $this->session->set_flashdata('success', 'New User created successfully');
                } else {
                    $this->session->set_flashdata('error', 'User creation failed');
                }
                
                redirect('userListing');
            }
        }
    }

    
    /**
     * This function is used load user edit information
     * @param number $userId : Optional : This is user id
     */
    function editOld($userId = NULL)
    {
        if(!$this->isAdmin())
        {
            $this->loadThis();
        }
        else
        {
            if($userId == null)
            {
                redirect('userListing');
            }
            
            $data['roles'] = $this->user_model->getUserRoles();
            $data['userInfo'] = $this->user_model->getUserInfo($userId);

            $this->global['pageTitle'] = 'CodeInsect : Edit User';
            
            $this->loadViews("users/editOld", $this->global, $data, NULL);
        }
    }
    
    
    /**
     * This function is used to edit the user information
     */
    function editUser()
    {
        if(!$this->isAdmin())
        {
            $this->loadThis();
        }
        else
        {
            $this->load->library('form_validation');
            
            $userId = $this->input->post('userId');
            
            $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]');
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|max_length[128]');
            $this->form_validation->set_rules('password','Password','matches[cpassword]|max_length[20]');
            $this->form_validation->set_rules('cpassword','Confirm Password','matches[password]|max_length[20]');
            $this->form_validation->set_rules('role','Role','trim|required|numeric');
            $this->form_validation->set_rules('mobile','Mobile Number','required|min_length[10]');
            
            // Journal fields validation (optional)
            $this->form_validation->set_rules('institution','Institution','trim');
            $this->form_validation->set_rules('country','Country','trim');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->editOld($userId);
            }
            else
            {
                $name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
                $email = strtolower($this->security->xss_clean($this->input->post('email')));
                $password = $this->input->post('password');
                $roleId = $this->input->post('role');
                $mobile = $this->security->xss_clean($this->input->post('mobile'));
                $isAdmin = $this->input->post('isAdmin');
                
                // Journal fields
                $institution = $this->security->xss_clean($this->input->post('institution'));
                $department = $this->security->xss_clean($this->input->post('department'));
                $country = $this->security->xss_clean($this->input->post('country'));
                $city = $this->security->xss_clean($this->input->post('city'));
                $orcid_id = $this->security->xss_clean($this->input->post('orcid_id'));
                $expertise_area = $this->security->xss_clean($this->input->post('expertise_area'));
                $bio = $this->security->xss_clean($this->input->post('bio'));
                
                // Check if remove image is checked
                $remove_image = $this->input->post('remove_image');
                
                // Get current user info to check existing image
                $currentUser = $this->user_model->getUserInfo($userId);
                
                // Handle profile image upload
                $currentImage = !empty($currentUser) ? $currentUser->profile_image : null;
                
                // If remove image is checked, set to null
                if($remove_image == '1') {
                    $profile_image = null;
                    // Delete the old image
                    if($currentImage) {
                        $this->deleteProfileImage($currentImage);
                    }
                } else {
                    // Handle new upload
                    $profile_image = $this->uploadProfileImage($currentImage);
                    
                    // If upload failed, keep existing image
                    if ($profile_image === false) {
                        $profile_image = $currentImage;
                    }
                    
                    // If new image uploaded and old exists, delete old image
                    if ($profile_image && $profile_image != $currentImage && $currentImage) {
                        $this->deleteProfileImage($currentImage);
                    }
                }
                
                // Build user info array
                $userInfo = array(
                    'email' => $email, 
                    'roleId' => $roleId, 
                    'name' => $name, 
                    'mobile' => $mobile,
                    'isAdmin' => $isAdmin,
                    'institution' => $institution,
                    'department' => $department,
                    'country' => $country,
                    'city' => $city,
                    'orcid_id' => $orcid_id,
                    'expertise_area' => $expertise_area,
                    'bio' => $bio,
                    'profile_image' => $profile_image,
                    'updatedBy' => $this->vendorId, 
                    'updatedDtm' => date('Y-m-d H:i:s')
                );
                
                // Add password if provided
                if(!empty($password))
                {
                    $userInfo['password'] = getHashedPassword($password);
                }
                
                $result = $this->user_model->editUser($userInfo, $userId);
                
                if($result == true)
                {
                    $this->session->set_flashdata('success', 'User updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'User updation failed');
                }
                
                redirect('userListing');
            }
        }
    }


    /**
     * This function is used to delete the user using userId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteUser()
    {
        if(!$this->isAdmin())
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $userId = $this->input->post('userId');
            
            // Get user info to delete profile image
            $userInfo = $this->user_model->getUserInfo($userId);
            
            // Delete profile image if exists
            if (!empty($userInfo) && !empty($userInfo->profile_image)) {
                $this->deleteProfileImage($userInfo->profile_image);
            }
            
            $userData = array(
                'isDeleted' => 1,
                'updatedBy' => $this->vendorId, 
                'updatedDtm' => date('Y-m-d H:i:s')
            );
            
            $result = $this->user_model->deleteUser($userId, $userData);
            
            if ($result > 0) { 
                echo(json_encode(array('status'=>TRUE))); 
            } else { 
                echo(json_encode(array('status'=>FALSE))); 
            }
        }
    }
    
    /**
     * Page not found : error 404
     */
    function pageNotFound()
    {
        $this->global['pageTitle'] = 'CodeInsect : 404 - Page Not Found';
        
        $this->loadViews("general/404", $this->global, NULL, NULL);
    }

    /**
     * This function used to show login history
     * @param number $userId : This is user id
     */
    function loginHistoy($userId = NULL)
    {
        if(!$this->isAdmin())
        {
            $this->loadThis();
        }
        else
        {
            $userId = ($userId == NULL ? 0 : $userId);

            $searchText = $this->input->post('searchText');
            $fromDate = $this->input->post('fromDate');
            $toDate = $this->input->post('toDate');

            $data["userInfo"] = $this->user_model->getUserInfoById($userId);

            $data['searchText'] = $searchText;
            $data['fromDate'] = $fromDate;
            $data['toDate'] = $toDate;
            
            $this->load->library('pagination');
            
            $count = $this->user_model->loginHistoryCount($userId, $searchText, $fromDate, $toDate);

            $returns = $this->paginationCompress ( "login-history/".$userId."/", $count, 10, 3);

            $data['userRecords'] = $this->user_model->loginHistory($userId, $searchText, $fromDate, $toDate, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'CodeInsect : User Login History';
            
            $this->loadViews("users/loginHistory", $this->global, $data, NULL);
        }        
    }

    /**
     * This function is used to show users profile
     */
    function profile($active = "details")
    {
        $data["userInfo"] = $this->user_model->getUserInfoWithRole($this->vendorId);
        $data["active"] = $active;
        
        $this->global['pageTitle'] = $active == "details" ? 'CodeInsect : My Profile' : 'CodeInsect : Change Password';
        $this->loadViews("users/profile", $this->global, $data, NULL);
    }

    /**
     * This function is used to update the user details
     * @param text $active : This is flag to set the active tab
     */
    function profileUpdate($active = "details")
    {
        $this->load->library('form_validation');
            
        $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]');
        $this->form_validation->set_rules('mobile','Mobile Number','required|min_length[10]');
        $this->form_validation->set_rules('email','Email','trim|required|valid_email|max_length[128]|callback_emailExists');        
        
        // Journal fields validation
        $this->form_validation->set_rules('institution','Institution','trim');
        $this->form_validation->set_rules('country','Country','trim');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->profile($active);
        }
        else
        {
            $name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
            $mobile = $this->security->xss_clean($this->input->post('mobile'));
            $email = strtolower($this->security->xss_clean($this->input->post('email')));
            
            // Journal fields
            $institution = $this->security->xss_clean($this->input->post('institution'));
            $department = $this->security->xss_clean($this->input->post('department'));
            $country = $this->security->xss_clean($this->input->post('country'));
            $city = $this->security->xss_clean($this->input->post('city'));
            $orcid_id = $this->security->xss_clean($this->input->post('orcid_id'));
            $expertise_area = $this->security->xss_clean($this->input->post('expertise_area'));
            $bio = $this->security->xss_clean($this->input->post('bio'));
            
            // Check if remove image is checked
            $remove_image = $this->input->post('remove_image');
            
            // Get current user info to check existing image
            $currentUser = $this->user_model->getUserInfo($this->vendorId);
            
            // Handle profile image upload
            $currentImage = !empty($currentUser) ? $currentUser->profile_image : null;
            
            // If remove image is checked, set to null
            if($remove_image == '1') {
                $profile_image = null;
                // Delete the old image
                if($currentImage) {
                    $this->deleteProfileImage($currentImage);
                }
            } else {
                // Handle new upload
                $profile_image = $this->uploadProfileImage($currentImage);
                
                // If upload failed, keep existing image
                if ($profile_image === false) {
                    $profile_image = $currentImage;
                }
                
                // If new image uploaded and old exists, delete old image
                if ($profile_image && $profile_image != $currentImage && $currentImage) {
                    $this->deleteProfileImage($currentImage);
                }
            }
            
            $userInfo = array(
                'name' => $name, 
                'email' => $email, 
                'mobile' => $mobile,
                'institution' => $institution,
                'department' => $department,
                'country' => $country,
                'city' => $city,
                'orcid_id' => $orcid_id,
                'expertise_area' => $expertise_area,
                'bio' => $bio,
                'profile_image' => $profile_image,
                'updatedBy' => $this->vendorId, 
                'updatedDtm' => date('Y-m-d H:i:s')
            );
            
            $result = $this->user_model->editUser($userInfo, $this->vendorId);
            
            if($result == true)
            {
                $this->session->set_userdata('name', $name);
                $this->session->set_flashdata('success', 'Profile updated successfully');
            }
            else
            {
                $this->session->set_flashdata('error', 'Profile updation failed');
            }

            redirect('profile/'.$active);
        }
    }

    /**
     * This function is used to change the password of the user
     * @param text $active : This is flag to set the active tab
     */
    function changePassword($active = "changepass")
    {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('oldPassword','Old password','required|max_length[20]');
        $this->form_validation->set_rules('newPassword','New password','required|max_length[20]');
        $this->form_validation->set_rules('cNewPassword','Confirm new password','required|matches[newPassword]|max_length[20]');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->profile($active);
        }
        else
        {
            $oldPassword = $this->input->post('oldPassword');
            $newPassword = $this->input->post('newPassword');
            
            $resultPas = $this->user_model->matchOldPassword($this->vendorId, $oldPassword);
            
            if(empty($resultPas))
            {
                $this->session->set_flashdata('nomatch', 'Your old password is not correct');
                redirect('profile/'.$active);
            }
            else
            {
                $usersData = array(
                    'password' => getHashedPassword($newPassword), 
                    'updatedBy' => $this->vendorId,
                    'updatedDtm' => date('Y-m-d H:i:s')
                );
                
                $result = $this->user_model->changePassword($this->vendorId, $usersData);
                
                if($result > 0) { 
                    $this->session->set_flashdata('success', 'Password updation successful'); 
                } else { 
                    $this->session->set_flashdata('error', 'Password updation failed'); 
                }
                
                redirect('profile/'.$active);
            }
        }
    }

    /**
     * This function is used to check whether email already exist or not
     * @param {string} $email : This is users email
     */
    function emailExists($email)
    {
        $userId = $this->vendorId;
        $return = false;

        if(empty($userId)){
            $result = $this->user_model->checkEmailExists($email);
        } else {
            $result = $this->user_model->checkEmailExists($email, $userId);
        }

        if(empty($result)){ $return = true; }
        else {
            $this->form_validation->set_message('emailExists', 'The {field} already taken');
            $return = false;
        }

        return $return;
    }
}
?>