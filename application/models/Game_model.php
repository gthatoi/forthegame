<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Game_Model extends MY_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    /**
     * save_performance
     * updates users game score data 
     * @param  array $post_data [
                               'user_id'=> $user_id,
                               'learning_currency' => $learning_currency,
                               'knowledge_currency' => $knowledge_currency
                            ]
     * @author Gourav Thatoi <<gourav.thatoi@gmail.com>>
     * @date 22.09.18 
     * @return boolean
     */
    public function save_performance($post_data){
        $user_tbl = TBL_USERS;

        extract($post_data);
        $where_condition = "id = '$user_id'";
        $update_data = [
            'learning_currency' => $learning_currency,
            'knowledge_currency' => $knowledge_currency
        ];

        $response = $this->db->update($user_tbl,$update_data,$where_condition);

        return $response;
    }

    /**
     * get_user_performance
     * returns users game score data 
     * @param  array $post_data ['mobile_number'=> $mobile_number]
     * @return array
     * @author Gourav Thatoi <<gourav.thatoi@gmail.com>>
     * @date 22.09.18
     */
    public function get_user_performance($post_data){
        $user_tbl = TBL_USERS;

        extract($post_data);

        $where_condition = "mobile_number = '$mobile_number'";

        $this->db->select("user_name,mobile_number,email,learning_currency,knowledge_currency,(learning_currency+knowledge_currency) as total_score");
        $this->db->from($user_tbl);
        $this->db->where($where_condition);
        $query = $this->db->get();

        return $query->result_array();
    }

    /**
     * get_leader_board
     * returns all the users game score data ranked from top to bottom  
     * ranking is done on the base of sum of learning_currency and knowledge_currency   
     * @param  none
     * @return array
     * @author Gourav Thatoi <<gourav.thatoi@gmail.com>>
     * @date 22.09.18
     */
    public function get_leader_board(){
    	$user_tbl = TBL_USERS;
        $this->db->select("user_name,mobile_number,email,learning_currency,knowledge_currency,(learning_currency + knowledge_currency) as total_score");
        $this->db->from($user_tbl);
        $this->db->order_by('total_score','DESC');
    	$query = $this->db->get();

    	return $query->result_array();
    }

}