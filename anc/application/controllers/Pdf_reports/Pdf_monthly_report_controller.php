<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pdf_monthly_report_controller extends CI_Controller {

	public function __construct()
	{
	  parent::__construct();
	  $this->load->model('cis/cis_model','cis');
	  $this->load->model('barangays/barangays_model','barangays');
	  $this->load->model('Hw_status/Hw_status_boys_model','boys');
      $this->load->model('Hw_status/Hw_status_girls_model','girls');
      $this->load->model('monthly/monthly_model','monthly');
	}

	public function index($gender, $month, $year)
	{
		// check if logged in and admin
		if($this->session->userdata('user_id') == '' || $this->session->userdata('administrator') == "0")
		{
          redirect('error500');
        }

		$data['data'] = $this->LoadData($gender, $month, $year); // load and fetch data

		$dateObj   = DateTime::createFromFormat('!m', $month);
		$monthName = $dateObj->format('F');
		
		$data['title'] = 'Monthly Monitoring Records ( ' . $monthName . ' ' . $year . ' ) - ' . $gender;

		$data['current_date'] = date('l, F j, Y', strtotime(date('Y-m-d')));

		$data['user_fullname'] = $this->session->userdata('firstname') .' '. $this->session->userdata('lastname');

		// column titles
		$data['header'] = array('ID', 'Fullname', 'I.H.Stats', 'I.W.Stats', 'C.Age', 'C.Height', 'Stats', 'C.Weight', 'Stats');

		$this->load->library('MYPDF');
		$this->load->view('reports/makepdf_monthly_view', $data);
	}

	// Load table data from file
	public function LoadData($gender, $month, $year) {

		$list = $this->cis->get_children_list();
		$data = array();

		foreach ($list as $cis) 
		{   
			if ($cis->sex == $gender)
			{
				$child_id = $cis->child_id;

				$row = array();
				$row[] = 'C' . $child_id;
				$row[] = $cis->lastname . ', ' . $cis->firstname;

				// for age in mos. ------------------------------------------------------------------
				$birth_date = new DateTime($cis->dob);

				$diff = $birth_date->diff(new DateTime($cis->date_registered));
				$age_in_mos = $diff->format('%m') + 12 * $diff->format('%y');


				// if no status data for months recorded (scope of satatus data: 36-71 mos only)
				if ($age_in_mos <= 35) // 0-35 mos.
				{
				    $age_in_mos = 36; // lowest month data to use
				}
				
				if ($age_in_mos >= 109) // 109 and up
				{
				    $age_in_mos = 108; // highest month data to use
				}
				// for age in mos. ------------------------------------------------------------------

				$initial_height = (double) $cis->height;
				$initial_weight = (double) $cis->weight;

				// first check if male or female
				if ($gender == 'Male') // Male ---------------------------------------------------------
				{
				    // get boys status data if male
				    $boys_data = $this->boys->get_by_age_months($age_in_mos);

				    // for Height status
				    if ($initial_height <= $boys_data->sst)
				    {
				        $initial_height_status = 'SSt';
				    }
				    else if ($initial_height <= $boys_data->st)
				    {   
				        $initial_height_status = 'St';
				    }
				    else if ($initial_height <= $boys_data->hn)
				    {
				        $initial_height_status = 'N';
				    }
				    else
				    {
				        $initial_height_status = 'T';   
				    }

				    // for Weight status
				    if ($initial_weight <= $boys_data->su)
				    {
				        $initial_weight_status = 'SU';
				    }
				    else if ($initial_weight <= $boys_data->u)
				    {   
				        $initial_weight_status = 'U';
				    }
				    else if ($initial_weight <= $boys_data->wn)
				    {
				        $initial_weight_status = 'N';
				    }
				    else
				    {
				        $initial_weight_status = 'O';   
				    } 
				}
				else // Female --------------------------------------------------------------------
				{
				    // get girls status data if female
				    $girls_data = $this->girls->get_by_age_months($age_in_mos);

				    // for Height status
				    if ($initial_height <= $girls_data->sst)
				    {
				        $initial_height_status = 'SSt';
				    }
				    else if ($initial_height <= $girls_data->st)
				    {   
				        $initial_height_status = 'St';
				    }
				    else if ($initial_height <= $girls_data->hn)
				    {
				        $initial_height_status = 'N';
				    }
				    else
				    {
				        $initial_height_status = 'T';   
				    }

				    // for Weight status
				    if ($initial_weight <= $girls_data->su)
				    {
				        $initial_weight_status = 'SU';
				    }
				    else if ($initial_weight <= $girls_data->u)
				    {   
				        $initial_weight_status = 'U';
				    }
				    else if ($initial_weight <= $girls_data->wn)
				    {
				        $initial_weight_status = 'N';
				    }
				    else
				    {
				        $initial_weight_status = 'O';   
				    }
				}

				
				$row[] = $initial_height_status;
				$row[] = $initial_weight_status;


				// for current data -------------------------------------------

				// base on current date (latest and not from date of registration)
				$diff = $birth_date->diff(new DateTime());
				$age_in_mos = $diff->format('%m') + 12 * $diff->format('%y');

				$current_age = $age_in_mos; // secure current age

				// if no status data for months recorded (scope of satatus data: 36-71 mos only)
				if ($age_in_mos <= 35) // 0-35 mos.
				{
				    $age_in_mos = 36; // lowest month data to use
				}
				
				if ($age_in_mos >= 109) // 109 and up
				{
				    $age_in_mos = 108; // highest month data to use
				}
				// for age in mos. ------------------------------------------------------------------

				$row[] = $current_age . ' mos.';


				if ($this->monthly->get_by_month_year($child_id, $month, $year) == null)
				{
					$row[] = 'n/a';
					$row[] = 'n/a';
					$row[] = 'n/a';
					$row[] = 'n/a';
				}
				else
				{
					$current_height = $this->monthly->get_by_month_year($child_id, $month, $year)['height'];
					$current_weight = $this->monthly->get_by_month_year($child_id, $month, $year)['weight'];

					// first check if male or female
					if ($gender == 'Male') // Male ---------------------------------------------------------
					{
					    // get boys status data if male
					    $boys_data = $this->boys->get_by_age_months($age_in_mos);

					    // for Height status
					    if ($current_height <= $boys_data->sst)
					    {
					        $current_height_status = 'SSt';
					    }
					    else if ($current_height <= $boys_data->st)
					    {   
					        $current_height_status = 'St';
					    }
					    else if ($current_height <= $boys_data->hn)
					    {
					        $current_height_status = 'N';
					    }
					    else
					    {
					        $current_height_status = 'T';   
					    }

					    // for Weight status
					    if ($current_weight <= $boys_data->su)
					    {
					        $current_weight_status = 'SU';
					    }
					    else if ($current_weight <= $boys_data->u)
					    {   
					        $current_weight_status = 'U';
					    }
					    else if ($current_weight <= $boys_data->wn)
					    {
					        $current_weight_status = 'N';
					    }
					    else
					    {
					        $current_weight_status = 'O';   
					    } 
					}
					else // Female --------------------------------------------------------------------
					{
					    // get girls status data if female
					    $girls_data = $this->girls->get_by_age_months($age_in_mos);

					    // for Height status
					    if ($current_height <= $girls_data->sst)
					    {
					        $current_height_status = 'SSt';
					    }
					    else if ($current_height <= $girls_data->st)
					    {   
					        $current_height_status = 'St';
					    }
					    else if ($current_height <= $girls_data->hn)
					    {
					        $current_height_status = 'N';
					    }
					    else
					    {
					        $current_height_status = 'T';   
					    }

					    // for Weight status
					    if ($current_weight <= $girls_data->su)
					    {
					        $current_weight_status = 'SU';
					    }
					    else if ($current_weight <= $girls_data->u)
					    {   
					        $current_weight_status = 'U';
					    }
					    else if ($current_weight <= $girls_data->wn)
					    {
					        $current_weight_status = 'N';
					    }
					    else
					    {
					        $current_weight_status = 'O';   
					    }
					}

					$row[] = $current_height . ' cm';
					$row[] = $current_height_status;
					$row[] = $current_weight . ' kg';
					$row[] = $current_weight_status;
				}			
				
				// $row[] = $cis->disability;
				// $row[] = $cis->contact;
				// $row[] = $cis->school;
				// $row[] = $cis->grade_level;
				// $row[] = $cis->address;

				// $row[] = $cis->date_registered;
				// $row[] = $cis->graduated;
				// $row[] = $cis->date_graduated;
				//add html for action

				$data[] = $row;
			} 
		}

		return $data;
	}

}
