<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MyModel extends CI_Model {

    var $client_service = "frontend-client";
    var $auth_key       = "simplerestapi";

    public function check_auth_client(){
        $client_service = $this->input->get_request_header('Client-Service', TRUE);
        $auth_key  = $this->input->get_request_header('Auth-Key', TRUE);
        
        if($client_service == $this->client_service && $auth_key == $this->auth_key){
            return true;
        } else {
            return json_output(401,array('status' => 401,'message' => 'Unauthorized.'));
        }
    }

    public function login($username,$password)
    {
        $q  = $this->db->select('password,id')->from('users')->where('username',$username)->get()->row();
       
        if($q == ""){
            return array('status' => 204,'message' => 'Username not found.');
        } else {
            $hashed_password = $q->password;
            $id              = $q->id;
             //echo $hashed_password ." ".$password;
        //exit;
            if (hash_equals($hashed_password, crypt($password, $hashed_password))) {
               $last_login = date('Y-m-d H:i:s');
               $randomNumber = substr( md5(rand()), 0, 7);
               $token = crypt($randomNumber,$hashed_password);
               $expired_at = date("Y-m-d H:i:s", strtotime('+12 hours'));
               $this->db->trans_start();
               $this->db->where('id',$id)->update('users',array('last_login' => $last_login));
               $this->db->insert('users_authentication',array('users_id' => $id,'token' => $token,'expired_at' => $expired_at));
               if ($this->db->trans_status() === FALSE){
                  $this->db->trans_rollback();
                  return array('status' => 500,'message' => 'Internal server error.');
               } else {
                  $this->db->trans_commit();
                  return array('status' => 200,'message' => 'Successfully login.','id' => $id, 'token' => $token);
               }
            } else {
                echo "Wrong password";
                exit();
               return array('status' => 204,'message' => 'Wrong password.');
            }
        }
    }

    public function logout()
    {
        $users_id  = $this->input->get_request_header('User-ID', TRUE);
        $token     = $this->input->get_request_header('Authorization', TRUE);
        $this->db->where('users_id',$users_id)->where('token',$token)->delete('users_authentication');
        return array('status' => 200,'message' => 'Successfully logout.');
    }

    public function auth()
    {
        $users_id  = $this->input->get_request_header('User-ID', TRUE);
        $token     = $this->input->get_request_header('Authorization', TRUE);
        $q  = $this->db->select('expired_at')->from('users_authentication')->where('users_id',$users_id)->where('token',$token)->get()->row();
        if($q == ""){
            return json_output(401,array('status' => 401,'message' => 'Unauthorized.'));
        } else {
            if($q->expired_at < date('Y-m-d H:i:s')){
                return json_output(401,array('status' => 401,'message' => 'Your session has been expired.'));
            } else {
                $updated_at = date('Y-m-d H:i:s');
                $expired_at = date("Y-m-d H:i:s", strtotime('+12 hours'));
                $this->db->where('users_id',$users_id)->where('token',$token)->update('users_authentication',array('expired_at' => $expired_at,'updated_at' => $updated_at));
                return array('status' => 200,'message' => 'Authorized.');
            }
        }
    }

    public function book_all_data()
    {
        return $this->db->select('id,title,author')->from('books')->order_by('id','desc')->get()->result();
    }

    public function book_detail_data($id)
    {
        return $this->db->select('id,title,author')->from('books')->where('id',$id)->order_by('id','desc')->get()->row();
    }

    public function book_create_data($data)
    {
        $this->db->insert('books',$data);
        return array('status' => 201,'message' => 'Data has been created.');
    }

    public function book_update_data($id,$data)
    {
        $this->db->where('id',$id)->update('books',$data);
        return array('status' => 200,'message' => 'Data has been updated.');
    }

    public function book_delete_data($id)
    {
        $this->db->where('id',$id)->delete('books');
        return array('status' => 200,'message' => 'Data has been deleted.');
    }


// Cooporate Model Query
    public function coorporate_all_data()
    {
        //Needs to change this query
        return $this->db->select('id,title,author')->from('books')->order_by('id','desc')->get()->result();
    }

    public function coorporate_detail_data($id)
    {
        //Needs to change to return the data of respective store
        return $this->db->select('id,title,author')->from('books')->where('id',$id)->order_by('id','desc')->get()->row();
    }

    public function coorporate_create_data($data)
    {
        $this->db->insert('coorporate',$data);
        return array('status' => 201,'message' => 'Data has been created.');
    }

    public function coorporate_update_data($id,$data)
    {
        $this->db->where('id',$id)->update('coorporate',$data);
        return array('status' => 200,'message' => 'Data has been updated.');
    }

    public function coorporate_delete_data($id)
    {
        $this->db->where('id',$id)->delete('coorporate');
        return array('status' => 200,'message' => 'Data has been deleted.');
    }


// Cooporate-campus Model Query
    public function campus_all_data()
    {
        //Needs to change this query
        return $this->db->select('id,title,author')->from('campus')->order_by('id','desc')->get()->result();
    }

    public function campus_detail_data($id)
    {
        //Needs to change to return the data of respective store
        return $this->db->select('id,title,author')->from('campus')->where('id',$id)->order_by('id','desc')->get()->row();
    }

    public function campus_create_data($data)
    {
        $this->db->insert('campus',$data);
        return array('status' => 201,'message' => 'Data has been created.');
    }

    public function campus_update_data($id,$data)
    {
        $this->db->where('id',$id)->update('campus',$data);
        return array('status' => 200,'message' => 'Data has been updated.');
    }

    public function campus_delete_data($id)
    {
        $this->db->where('id',$id)->delete('campus');
        return array('status' => 200,'message' => 'Data has been deleted.');
    }


// Category Model Query
    public function category_all_data()
    {
        //Needs to change this query
        return $this->db->select('id,title,author')->from('category')->order_by('id','desc')->get()->result();
    }

    public function category_detail_data($id)
    {
        //Needs to change to return the data of respective store
        return $this->db->select('id,title,author')->from('category')->where('id',$id)->order_by('id','desc')->get()->row();
    }

    public function category_create_data($data)
    {
        $this->db->insert('category',$data);
        return array('status' => 201,'message' => 'Data has been created.');
    }

    public function category_update_data($id,$data)
    {
        $this->db->where('id',$id)->update('category',$data);
        return array('status' => 200,'message' => 'Data has been updated.');
    }

    public function category_delete_data($id)
    {
        $this->db->where('id',$id)->delete('category');
        return array('status' => 200,'message' => 'Data has been deleted.');
    }


    // Discount Model Query
    public function discount_offers_all_data()
    {
        //Needs to change this query
        return $this->db->select('id,title,author')->from('discount_offers')->order_by('id','desc')->get()->result();
    }

    public function discount_offers_detail_data($id)
    {
        //Needs to change to return the data of respective store
        return $this->db->select('id,title,author')->from('discount_offers')->where('id',$id)->order_by('id','desc')->get()->row();
    }

    public function discount_offers_create_data($data)
    {
        $this->db->insert('discount_offers',$data);
        return array('status' => 201,'message' => 'Data has been created.');
    }

    public function discount_offers_update_data($id,$data)
    {
        $this->db->where('id',$id)->update('discount_offers',$data);
        return array('status' => 200,'message' => 'Data has been updated.');
    }

    public function discount_offers_delete_data($id)
    {
        $this->db->where('id',$id)->delete('discount_offers');
        return array('status' => 200,'message' => 'Data has been deleted.');
    }




    // Image Offers Model Query
    public function img_offers_all_data()
    {
        //Needs to change this query
        return $this->db->select('id,title,author')->from('img_offers')->order_by('id','desc')->get()->result();
    }

    public function img_offers_detail_data($id)
    {
        //Needs to change to return the data of respective store
        return $this->db->select('id,title,author')->from('img_offers')->where('id',$id)->order_by('id','desc')->get()->row();
    }

    public function img_offers_create_data($data)
    {
        $this->db->insert('img_offers',$data);
        return array('status' => 201,'message' => 'Data has been created.');
    }

    public function img_offers_update_data($id,$data)
    {
        $this->db->where('id',$id)->update('img_offers',$data);
        return array('status' => 200,'message' => 'Data has been updated.');
    }

    public function img_offers_delete_data($id)
    {
        $this->db->where('id',$id)->delete('img_offers');
        return array('status' => 200,'message' => 'Data has been deleted.');
    }

}
