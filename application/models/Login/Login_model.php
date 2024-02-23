<?php
class Login_model extends CI_Model
{



  public function login_section($username)
  {
    $this->db->where('app_username', $username)->where('deleted', 0)->where('login_or_not',1);
    $check_login = $this->db->get('user_company_details');
    return $check_login;
  }

  public function fetch_user_personal_data($user_id)
  {
    $query = $this->db->query('SELECT upd.user_name,upd.email,upd.phone,upd.dob,ucd.user_id,ucd.app_username,ucd.prefix,ucd.created_date,a.area FROM user_company_details ucd 
    JOIN user_personal_details upd USING(user_id)
    LEFT JOIN area a USING(area_id)
    WHERE ucd.user_id= '.$user_id.'
    ');
    return $query->row();
  }


 

  // end of model

}
