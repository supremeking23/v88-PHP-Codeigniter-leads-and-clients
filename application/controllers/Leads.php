<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leads extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

    // function __construct() {
    //     parent::__construct();

    //     $this->output->enable_profiler(TRUE);
    //     $sections = array(
    //         'config'  => TRUE,
    //         'queries' => TRUE
    //     );
    
    //     $this->output->set_profiler_sections($sections);
    // }

	public function index(){
        // $data["leads"] = $this->lead->get_all_leads();
        
        if($this->session->has_userdata("from")){
            $dates = array(
                "from" => $this->session->userdata("from"),
                "to" => $this->session->userdata("to"),
            );
            $data['leads'] = $this->lead->get_all_leads_with_date_params($dates);
        }else{
            $data['leads'] = $this->lead->get_all_leads();
        }
        // $data['leads'] = $this->lead->get_all_leads_with_date_params($dates);

        
		$this->load->view('leads/index',$data);
	}

    public function update(){
        $this->load->library("form_validation");
        $this->form_validation->set_rules('from', 'From date', 'required');
        $this->form_validation->set_rules('to', 'To date', 'required');
        if ($this->form_validation->run() == FALSE){
            $errors = validation_errors('<div class="alert alert-danger">', '</div>');
            $this->session->set_flashdata('errors', $errors);
        }else{
            $dates = array(
                "from" => $this->input->post("from"),
                "to" => $this->input->post("to"),
            );
    
            $this->session->set_userdata($dates);
        }


        redirect(base_url());
    }

}
