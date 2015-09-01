<?php
/**
 * Created by PhpStorm.
 * User: Phu Le
 * Date: 6/29/2015
 * Time: 10:47 AM
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class History extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function saveHistory($data){
        $this->db->insert('history',$data);
    }

    public function countHistoryRecord($account_id,$search = NULL){
        $this->db->select('
            n.id,
            n.read_at,
            n.created_at,
            n.record_id as post_id,
            n.type_of_notification,
            n.action,
            n.sender_id,
            pot.name,
            po.status as post_status,
            n.recipient_id,
            po.created_by as post_created_by
        ');
        $this->db->from('history as n');

        $this->db->join('posts as po', 'po.id = n.record_id');

        $this->db->join('type_posts as pot', 'pot.id = po.type_id', 'left');

        $this->db->where('n.is_delete', NULL);

        $this->db->where('n.account_id', $account_id);

        /*$this->db->where('n.action <>', 1);

        $this->db->or_where('n.sender_id', $account_id);*/

        /* $this->db->group_by(array('n.created_at'));

         $this->db->order_by('created_at','DESC');*/

        if(!empty($search)){
            if($search != ""){
                $this->db->like('pot.name',$search);
            }
        }
        $total = $this->db->count_all_results();
        return $total;
    }

    public function historyList($paging_limit,$page = NULL,$search,$account_id){
        $this->db->select('
            n.id,
            n.read_at,
            n.created_at,
            n.record_id as post_id,
            n.type_of_notification,
            n.action,
            n.sender_id,
            pot.name,
            po.status as post_status,
            n.recipient_id,
            po.created_by as post_created_by
        ');
        $this->db->from('history as n');

        $this->db->join('posts as po', 'po.id = n.record_id');

        $this->db->join('type_posts as pot', 'pot.id = po.type_id', 'left');

        $this->db->where('n.is_delete', NULL);

        $this->db->where('n.account_id', $account_id);

        /*$this->db->where('n.action <>', 1);

        $this->db->or_where('n.sender_id', $account_id);

        $this->db->group_by(array('n.created_at'));*/

        $this->db->order_by('created_at','DESC');

        if ($page !== null)
        {
            $begin = ($page - 1)*$paging_limit;
            $this->db->limit($paging_limit, $begin);
        }

        if(!empty($search)){
            if($search != ""){
                $this->db->like('pot.name',$search);
                /*$this->db->or_like('n.created_at',$search);*/
                /*$this->db->or_like('identity_card_id',$search);
                $this->db->or_like('phone_number',$search);*/
            }
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
                    $notify['sender_full_name'] = $this->account->getFullName($notify['sender_id']);
                    $notify['recipient_full_name'] = $this->account->getFullName($notify['recipient_id']);

                    if(strcmp($notify['sender_id'],$account_id) == 0 &&
                        ($notify['action'] == 2 || $notify['action'] == 3 || $notify['action'] == 4)) {
                        $notify['title'] = my_lang('web_sender_notify_' . get_notify_action(get_notify_type($notify['type_of_notification']), $notify['action']), array($post_type['name'],$notify['recipient_full_name']));
                    }else if(strcmp($notify['sender_id'],$account_id) != 0 &&
                        ($notify['action'] == 2 || $notify['action'] == 3 || $notify['action'] == 4)) {
                        $notify['title'] = my_lang('web_recipient_notify_' . get_notify_action(get_notify_type($notify['type_of_notification']), $notify['action']), array($notify['sender_full_name'], $post_type['name']));

                    }else{
                        $notify['title'] = my_lang('web_notify_' . get_notify_action(get_notify_type($notify['type_of_notification']), $notify['action']), array($post_type['name']));
                    }

                    $arrUnset = array(
                        'type_of_notification',
                        'action',
                        'full_name',
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


    public function historyListAdmin($paging_limit,$page = NULL,$search,$account_id){
        $this->db->select('
            n.id,
            n.read_at,
            n.created_at,
            n.record_id as post_id,
            n.type_of_notification,
            n.action,
            n.sender_id,
            pot.name,
            po.status as post_status,
            n.recipient_id,
            po.created_by as post_created_by
        ');
        $this->db->from('history as n');

        $this->db->join('posts as po', 'po.id = n.record_id');

        $this->db->join('type_posts as pot', 'pot.id = po.type_id', 'left');

        $this->db->where('n.is_delete', NULL);

        $this->db->where('n.account_id', $account_id);

        /*$this->db->where('n.action <>', 1);

        $this->db->or_where('n.sender_id', $account_id);

        $this->db->group_by(array('n.created_at'));*/

        $this->db->order_by('created_at','DESC');

        if ($page !== null)
        {
            $begin = ($page - 1)*$paging_limit;
            $this->db->limit($paging_limit, $begin);
        }

        if(!empty($search)){
            if($search != ""){
                $this->db->like('pot.name',$search);
                /*$this->db->or_like('n.created_at',$search);*/
                /*$this->db->or_like('identity_card_id',$search);
                $this->db->or_like('phone_number',$search);*/
            }
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
                    $notify['sender_full_name'] = $this->account->getFullName($notify['sender_id']);
                    $notify['recipient_full_name'] = $this->account->getFullName($notify['recipient_id']);

                    if(strcmp($notify['sender_id'],$account_id) == 0 &&
                        ($notify['action'] == 2 || $notify['action'] == 3 || $notify['action'] == 4)) {
                        $notify['title'] = my_lang('admin_sender_notify_' . get_notify_action(get_notify_type($notify['type_of_notification']), $notify['action']), array($notify['sender_full_name'],$post_type['name'],$notify['recipient_full_name']));
                    }else if(strcmp($notify['sender_id'],$account_id) != 0 &&
                        ($notify['action'] == 2 || $notify['action'] == 3 || $notify['action'] == 4)) {
                        $notify['title'] = my_lang('admin_recipient_notify_' . get_notify_action(get_notify_type($notify['type_of_notification']), $notify['action']), array($notify['sender_full_name'], $post_type['name'],$notify['recipient_full_name']));

                    }else{
                        $notify['title'] = my_lang('admin_notify_' . get_notify_action(get_notify_type($notify['type_of_notification']), $notify['action']), array($notify['sender_full_name'],$post_type['name']));
                    }

                    $arrUnset = array(
                        'type_of_notification',
                        'action',
                        'full_name',
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


}