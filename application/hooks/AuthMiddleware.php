<?php class AuthMiddleware {
    public function check_auth() {
        $CI = &get_instance();
        
        // Check if the user is not logged in
        if (!$CI->session->userdata('user_logged_in')) {
            redirect('login'); // Redirect to the login page
        }
    }
}
?>