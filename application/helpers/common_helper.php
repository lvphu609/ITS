<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('getCurrentDate'))
{
	function getCurrentDate()
	{
		$currentDate = date("Y-m-d H:i:s");
    
    return $currentDate;
    
	}
}

if ( ! function_exists('getDateType'))
{
	function getDateType()
	{
		$dateType = date("A");
    
    return $dateType;
    
	}
}

if ( ! function_exists('getGenderData'))
{
	function getGenderData()
	{
		return array(
			1 => 'Nam',
			2 => 'Nu'
		);
	}
}

if ( ! function_exists('getGender'))
{
	function getGender($id)
	{
		$genderData = getGenderData();
    	return $genderData[$id];
	}
}


if ( ! function_exists('my_lang'))
{
    function my_lang($line, $args = array())
    {
        $CI =& get_instance();
        $lang = $CI->lang->line($line);
        // $lang = '%s %s were %s';// this would be the language line
        return vsprintf($lang, $args);
    }
}


/**
 * notify type
 */
if ( ! function_exists('get_notify_type'))
{
    function get_notify_type($id)
    {
        $notify_type = array(
            1 => 'posts'
        );
        return $notify_type[$id];
    }
}

/**
 * acction notify
*/
if ( ! function_exists('get_notify_action'))
{
    function get_notify_action($notify_type,$id)
    {
        //posts action---
        if ($notify_type == "posts"){
            $action_post = array(
                1 => 'request_post',
                2 => 'pick_post',
                3 => 'cancel_post',
                4 => 'complete_post'
            );
            return $action_post[$id];
        }
        return array();
    }
}


/**
 * get name blood group by id
 */

if ( ! function_exists('get_blood_group_name'))
{
    function get_blood_group_name($id)
    {
        $ci =& get_instance();
        $ci->load->database();
        $ci->db->select('name');
        $ci->db->from('blood_groups');
        $ci->db->where('id',$id);
        $query = $ci->db->get();
        $result = $query->result_array();
        return $result[0]['name'];
    }
}

/**
 * get blood group
 */

if ( ! function_exists('get_blood_group'))
{
    function get_blood_group()
    {
        $ci =& get_instance();
        $ci->load->database();
        $ci->db->select('id,name');
        $ci->db->from('blood_groups');
        $query = $ci->db->get();
        $result = $query->result_array();
        return $result;
    }
}

/**
 * get name blood group rh by id
 */

if ( ! function_exists('get_blood_group_rh_name'))
{
    function get_blood_group_rh_name($id)
    {
        $ci =& get_instance();
        $ci->load->database();
        $ci->db->select('name');
        $ci->db->from('blood_group_rh');
        $ci->db->where('id',$id);
        $query = $ci->db->get();
        $result = $query->result_array();
        return $result[0]['name'];
    }
}

/**
 * get blood group rh
 */

if ( ! function_exists('get_blood_group_rh'))
{
    function get_blood_group_rh()
    {
        $ci =& get_instance();
        $ci->load->database();
        $ci->db->select('id,name');
        $ci->db->from('blood_group_rh');
        $query = $ci->db->get();
        $result = $query->result_array();
        return $result;
    }
}


/**
 * get account type by id
 */

if ( ! function_exists('get_account_type_name'))
{
    function get_account_type_name($id)
    {
        $ci =& get_instance();
        $ci->load->database();
        $ci->db->select('name');
        $ci->db->from('account_type');
        $ci->db->where('id',$id);
        $query = $ci->db->get();
        $result = $query->result_array();
        return $result[0]['name'];
    }
}


/**
 * get account type
 */

if ( ! function_exists('get_account_type'))
{
    function get_account_type()
    {
        $ci =& get_instance();
        $ci->load->database();
        $ci->db->select('name,id');
        $ci->db->from('account_type');
        $query = $ci->db->get();
        $result = $query->result_array();
        return $result;
    }
}

/**
 * get gender name
 */

if ( ! function_exists('get_gender_name'))
{
    function get_gender_name($id)
    {
        $ci =& get_instance();
        $arr = array(
            1 => $ci->lang->line('male'),
            2 => $ci->lang->line('female')
        );
        return $arr[$id];
    }
}


/**
 * get gender array
 */

if ( ! function_exists('get_gender_arr'))
{
    function get_gender_arr()
    {
        return array(
            1 => array(
                'id' => 1,
                'name' => 'Nam'
            ),
            2 => array(
                'id' => 2,
                'name' => 'Nữ'
            )
        );
    }
}



?>
