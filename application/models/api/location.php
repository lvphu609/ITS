<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Location extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->model(array('file_model'));
    }

    // store location account
    function storeLocation($account_id){
        try{

            $input = $this->input->post();
            $location_lat = $input['location_lat'];
            $location_lng = $input['location_lng'];
            /*$account_id = $input['account_id'];*/

            $data =array(
                'account_id' => $account_id,
                'location_lat' => $location_lat,
                'location_lng' => $location_lng
            );
            if($this->existAccountId($account_id)){
                $isUpdate = $this->db->update('locations', $data, array('account_id' => $account_id));
                if($isUpdate){
                    return true;
                }
            }else{
                $isCreate = $this->db->insert('locations', $data);
                if ($isCreate) {
                    return true;
                }
            }
            return false;

        }catch (ErrorException $e){
            return false;
        }
    }

    //get location account
    function getLocationByAccountId($account_id){
        $this->db->select('id,account_id,location_lat,location_lng');
        $this->db->where('account_id', $account_id);
        $query = $this->db->get('locations');
        return $query->result_object();
    }

    //check account_id
    function existAccountId($account_id){
        $this->db->select('*');
        $this->db->from('locations');
        $this->db->where(array(
            'account_id' => $account_id
        ));
        $query = $this->db->get();
        return $query->num_rows() === 1;
    }


}