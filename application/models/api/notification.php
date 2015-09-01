<?php
/**
 * Created by PhpStorm.
 * User: Phu Le
 * Date: 6/29/2015
 * Time: 10:47 AM
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notification extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->model(array('api/post','api/account','file_model'));
    }


    //get my notification
    function getMyNotifications($account_id,$page = null,$numberPerPage = null){
        //$accountInfo = $this->account->getAccountById($account_id);

        $this->db->select('
            n.id,
            n.read_at,
            n.created_at,
            n.record_id as post_id,
            n.type_of_notification,
            n.action,
            n.sender_id,
            pot.name,
            po.status as post_status
        ');
        $this->db->from('notifications as n');

        $this->db->join('posts as po', 'po.id = n.record_id');

        $this->db->join('type_posts as pot', 'pot.id = po.type_id', 'left');

        $this->db->where('n.is_delete', NULL);

        $this->db->where('n.recipient_id', $account_id);

        $this->db->order_by('created_at','DESC');

        if ($page !== null)
        {
            $begin = ($page - 1)*$numberPerPage;
            $this->db->limit($numberPerPage, $begin);
        }
        $query = $this->db->get();

        if($query->num_rows() > 0 ){
            $result = $query->result_array();
            if(count($result)>0){
                $arrTemp = array();
                foreach($result as $key => $notify){
                    $postInfo = $this->post->getPostDetailById($notify['post_id']);
                    $post_type = $postInfo->post_type;
                    $notify['avatar'] = $post_type['avatar'];
                    $notify['full_name'] = $this->account->getFullName($notify['sender_id']);
                    $notify['title'] = my_lang('notify_'.get_notify_action(get_notify_type($notify['type_of_notification']),$notify['action']),array($notify['full_name'], $post_type['name']));

                    $arrUnset = array(
                        'type_of_notification',
                        'action',
                        'full_name',
                        'name'
                    );

                    foreach($arrUnset as $value){
                        unset($notify[$value]);
                    }

                    array_push($arrTemp,$notify);
                }
                return $arrTemp;
            }
            return $result;
        }
    }


    //count all notification
    function countAllMyNotifications($account_id){
        $this->db->where('recipient_id', $account_id);
        $this->db->where('is_delete', null);
        $this->db->from('notifications');
        return $this->db->count_all_results();
    }


    function save_notification($sender_id, $recipient_id, $record_id, $type_of_notification, $action,$created_at){
        $record_notify = array(
            'sender_id' => $sender_id,
            'recipient_id' => $recipient_id,
            'record_id' => $record_id,
            'type_of_notification' => $type_of_notification,
            'action' => $action,
            'created_at' => $created_at
        );
        $isInsert = $this->db->insert('notifications',$record_notify);
        if($isInsert){
            return $this->db->insert_id();
        }
        return null;
    }

    function get_message_notification($post_id,$type,$action,$account_id = null, $pickedBy = null){
        $postInfo = $this->post->getPostDetailById($post_id);
        $post_type = $postInfo->post_type;

        $account = null;

        //create post-----------------------------get full name of creater
        if($type == 1 && $action == 1){
            $account = $this->account->getAccountInfoById($postInfo->created_by);

        }

        //pick post-----------------------------get full name of picker
        if($type == 1 && $action == 2){
            $account = $this->account->getAccountInfoById($postInfo->picked_by);

        }

        //complete post----------------------------get full name of creater
        if($type == 1 && $action == 4){
            $account = $this->account->getAccountInfoById($postInfo->created_by);
        }

        //destroy post-----------------------------
        if($type == 1 && $action == 3){

            //provider --> user
            if($pickedBy == $account_id){
                $account = $this->account->getAccountInfoById($pickedBy);
            }

            //user --> provider
            if($postInfo->created_by == $account_id){
                $account = $this->account->getAccountInfoById($postInfo->created_by);
            }
        }

        if(count($account) > 0){
            $data = new stdClass();
            $full_name = "";
            if(!empty($account)){
                $full_name = $account['full_name'];
            }
            $data->title = my_lang('notify_'.get_notify_action(get_notify_type($type),$action),array($full_name, $post_type['name']));
            $data->created_at = $postInfo->created_at;
            $data->avatar = $post_type['avatar'];
            $data->post_id = $post_id;
            return $data;
        }
        return null;
    }

    function view(){
        try {
            $input = $this->input->post();
            $isUpdate = $this->db->update('notifications',
                array('read_at' => getCurrentDate()),
                array(
                    'id' => $input['id'],
                    'recipient_id' => $input['account_id'])
            );

            if ($isUpdate) {
                return true;
            }
            return false;
        }catch (ErrorException $e){
            return false;
        }
    }

    function getNewestMyNotification(){
        $input = $this->input->post();
        $account_id = $input['account_id'];
        $date_time = $input['date_time'];
        try {
            $this->db->select('
                n.id,
                n.read_at,
                n.created_at,
                n.record_id as post_id,
                n.type_of_notification,
                n.action,
                n.sender_id,
                pot.name,
                po.status as post_status
            ');
            $this->db->from('notifications as n');

            $this->db->where("(n.created_at > '$date_time')");

            $this->db->join('posts as po', 'po.id = n.record_id');

            $this->db->join('type_posts as pot', 'pot.id = po.type_id', 'left');

            $this->db->where('n.is_delete', NULL);

            $this->db->where('n.recipient_id', $account_id);

            $this->db->order_by('n.created_at','DESC');

            $query = $this->db->get();

            if($query->num_rows() > 0 ){
                $result = $query->result_array();
                if(count($result)>0){
                    $arrTemp = array();
                    foreach($result as $key => $notify){
                        $postInfo = $this->post->getPostDetailById($notify['post_id']);
                        $post_type = $postInfo->post_type;
                        $notify['avatar'] = $post_type['avatar'];
                        $notify['full_name'] = $this->account->getFullName($notify['sender_id']);
                        $notify['title'] = my_lang('notify_'.get_notify_action(get_notify_type($notify['type_of_notification']),$notify['action']),array($notify['full_name'], $post_type['name']));

                        $arrUnset = array(
                            'type_of_notification',
                            'action',
                            'full_name',
                            'name'
                        );

                        foreach($arrUnset as $value){
                            unset($notify[$value]);
                        }

                        array_push($arrTemp,$notify);
                    }
                    return $arrTemp;
                }
                return $result;
            }
        }catch(ErrorException $e){
            return null;
        }
    }

    /*function delete($account_info){
        try {
            $input = $this->input->post();
            $isDelete = $this->db->delete('notifications',
                array(
                    'id' => $input['id'],
                    'recipient_id' => $account_info['id'])
            );

            if ($isDelete) {
                return true;
            }
            return false;
        }catch (ErrorException $e){
            return false;
        }
    }*/

    function delete($account_info){
        try {
            $input = $this->input->post();
            $isDelete = $this->db->update('notifications',
                array('is_delete' => 1),
                array(
                    'id' => $input['id'],
                    'recipient_id' => $account_info['id'])
            );

            if ($isDelete) {
                return true;
            }
            return false;
        }catch (ErrorException $e){
            return false;
        }
    }

    function getNotifyNumber($account_info){
        $this->db->select('*');

        $this->db->from('notifications as n');

        $this->db->where('n.is_delete', NULL);

        $this->db->where('n.read_at', NULL);

        $this->db->where('n.recipient_id', $account_info['id']);

        $query = $this->db->get();

        return $query->num_rows();

    }

}