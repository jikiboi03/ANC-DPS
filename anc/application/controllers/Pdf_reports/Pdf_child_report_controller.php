<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pdf_child_report_controller extends CI_Controller {

	public function __construct()
	{
	  parent::__construct();
	  $this->load->model('cis/cis_model','cis');
	  $this->load->model('barangays/barangays_model','barangays');
      $this->load->model('family/family_model','family');
      $this->load->model('monthly/monthly_model','monthly');
	}

	public function index($child_id)
	{
		// check if logged in and admin
		if($this->session->userdata('user_id') == '' || $this->session->userdata('administrator') == "0")
		{
          redirect('error500');
        }

        $child_data = $this->cis->get_by_id($child_id);

        // for latest monthly checkup data values
        $latest_monthly = $this->monthly->get_by_child_id($child_id);

        if ($latest_monthly == null) // if no latest monthly (apply 'n/a to all values in latest')
        {
            $latest_height = $child_data->height; 
            $latest_weight = $child_data->weight;
        }
        else // if it has latest monthly checkup values (the latest_monthly array has values)
        {
            $latest_height = $latest_monthly['height']; 
            $latest_weight = $latest_monthly['weight'];
        }

        $data['latest_height'] = $latest_height;
        $data['latest_weight'] = $latest_weight;

		$data['data'] = $this->LoadData($child_id); // load and fetch data
		
		$data['title'] = 'Child Profile / CIS ( Child Information Sheet )';

		$data['current_date'] = date('l, F j, Y', strtotime(date('Y-m-d')));

		$data['user_fullname'] = $this->session->userdata('firstname') .' '. $this->session->userdata('lastname');

		// column titles
		// $data['header'] = array('ID', 'Fullname', 'Relation', 'Age', 'Gender', 'C.Status', 'Education', 'Occupation', 'Income');
		$data['header'] = array('Fullname', 'Relation', 'Age', 'Gender', 'Occupation');

		$data['child'] = $child_data;

		$this->load->library('MYPDF');
		$this->load->view('reports/makepdf_child_view', $data);
	}

	// Load table data from file
	public function LoadData($child_id) 
	{
		$list = $this->family->get_family_list($child_id);
		$data = array();
		
		foreach ($list as $family) 
		{
		    $row = array();
		    $row[] = $family->name;
		    $row[] = $family->relation;

		    $row[] = $family->age . ' y.o.';          
		    $row[] = $family->sex;
		    // $row[] = $family->status;

		    // $row[] = $family->education;
		    $row[] = $family->occupation;
		    // $row[] = 'Php ' . $family->income;
		
		    $data[] = $row;
		}

		return $data;
	}

}
