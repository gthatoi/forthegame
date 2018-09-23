<?php
use Restserver\Libraries\REST_Controller;
require APPPATH.'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Game extends REST_Controller 
{

	function __construct(){

	    //Initialization of class
	    parent::__construct();
	    $this->load->model('game_model');

	}

	/**
	 * save_user_performance
	 * this function is to save the game score of the user
	 * @param POST ['user_id','knowledge_currency','learning_currency']
	 * @author Gourav Thatoi <<gourav.thatoi@gmail.com>>
	 * @date 22.09.18
	 */
	public function save_user_performance_post()
	{

		$response = [];

		if($this->input->post()){

			$this->form_validation->set_rules('user_id','User id','required|trim|xss_clean');
			$this->form_validation->set_rules('learning_currency','Learning Currency','trim|required|xss_clean');
			$this->form_validation->set_rules('knowledge_currency','Knowledge Currency','trim|required|xss_clean');

			if( $this->form_validation->run() == TRUE ){

			    $user_id = $this->input->post('user_id');
			    $learning_currency = $this->input->post('learning_currency');
			    $knowledge_currency = $this->input->post('knowledge_currency');

			    $post_data = [
			    			   'user_id'=> $user_id,
			    			   'learning_currency' => $learning_currency,
			    			   'knowledge_currency' => $knowledge_currency
							]; 

			    $response = $this->game_model->save_performance($post_data);
			    if(!$response){
			    	$response = $this->game_model->getErrorCodeData('11');
			    }
			}else{
			    $validation_message = strip_tags(validation_errors());
			    $response = $this->game_model->getErrorCodeData('04');
			    $response['error_message'] = $validation_message;
			}

		}

		$this->response($response,200);

	}


	/**
	 * get_user_performance
	 * this function is to get the game performance of the user through phone number
	 * @param POST ['mobile_number']
	 * @author Gourav Thatoi <<gourav.thatoi@gmail.com>>
	 * @date 22.09.18
	 */
	public function get_user_performance_post()
	{

		$response = [];

		if($this->input->post()){

			$this->form_validation->set_rules('mobile_number','Mobile number','required|trim|xss_clean');

			if( $this->form_validation->run() == TRUE ){

			    $mobile_number = $this->input->post('mobile_number');

			    $post_data = [
			    			   'mobile_number'=> $mobile_number
							]; 

			    $response = $this->game_model->get_user_performance($post_data);

			}else{
			    $validation_message = strip_tags(validation_errors());
			    $response = $this->game_model->getErrorCodeData('04');
			    $response['error_message'] = $validation_message;
			}

		}else{
			$response = $this->game_model->getErrorCodeData('04');
			$response['error_message'] = 'Params missing.';
		}

		$this->response($response,200);

	}


	/**
	 * get_leader_board
	 * this function is to get the game performance of the user through phone number
	 * @param POST ['mobile_number']
	 * @author Gourav Thatoi <<gourav.thatoi@gmail.com>>
	 * @date 22.09.18
	 */
	public function leader_board_get()
	{

	    $response = $this->game_model->get_leader_board();
		$this->response($response,200);

	}

}

