<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cis_controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('cis/cis_model','cis');
        $this->load->model('barangays/barangays_model','barangays');

        $this->load->model('monthly/monthly_model','monthly');
        $this->load->model('hvi/hvi_model','hvi');
        $this->load->model('deworming/deworming_model','deworming');
        $this->load->model('Hw_status/Hw_status_boys_model','boys');
        $this->load->model('Hw_status/Hw_status_girls_model','girls');
    }

   public function index()						/** Note: ayaw ilisi ang sequence sa page load sa page **/
   {
        if($this->session->userdata('user_id') == '')
        {
          redirect('error500');
        }
        
        // get barangays list for dropdown
        $data['barangays'] = $this->barangays->get_barangays();

        $this->load->helper('url');							
        											
        $data['title'] = 'Child Information Sheet (CIS) Records';					
        $this->load->view('template/dashboard_header',$data);
        $this->load->view('cis/cis_view',$data);   //Kani lang ang ilisi kung mag dungag mo ug Page
        $this->load->view('template/dashboard_navigation');
        $this->load->view('template/dashboard_footer');

   }
   
    public function ajax_list()
    {
        $list = $this->cis->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $cis) {
            $no++;
            $row = array();
            $row[] = 'C' . $cis->child_id;
            $row[] = $cis->lastname;
            $row[] = $cis->firstname;
            $row[] = $cis->middlename;
            $row[] = $cis->dob;

            // age in mos
            $birthday = new DateTime($cis->dob);

            $diff = $birthday->diff(new DateTime());
            $months = $diff->format('%m') + 12 * $diff->format('%y');

            $row[] = $months;          

            // $row[] = $cis->pob;
            $row[] = $cis->sex;
            // $row[] = $cis->religion;
            $row[] = $cis->weight;
            $row[] = $cis->height;
            // $row[] = $cis->disability;
            // $row[] = $cis->contact;
            // $row[] = $cis->school;
            // $row[] = $cis->grade_level;
            // $row[] = $cis->address;
            $row[] = $this->barangays->get_barangay_name($cis->barangay_id);

            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view_profile('."'".$cis->child_id."'".')"><i class="fa fa-eye"></i> </a>
                      
                      <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_cis('."'".$cis->child_id."'".')"><i class="fa fa-trash"></i></a>';

            $row[] = $cis->date_registered;
            $row[] = $cis->encoded;
            // $row[] = $cis->graduated;
            // $row[] = $cis->date_graduated;
            //add html for action
            
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->cis->count_all(),
                        "recordsFiltered" => $this->cis->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }


    //========================================= NOTIFICATIONS TABLE =====================================================

    public function ajax_list_monthly()
    {
        // get last month
        $current_month = date('m');
        $year = date('Y'); // current year but can be changed to last year if current month is Jan

        if ($current_month == 1) // if current month is Jan, prev should be dec of prev year
        {
            $previous_month = 12;
            $year = $year - 1;
        }
        else
        {
            $previous_month = $current_month - 1;
        }

        // get child_id array for monthly checkups done the previous month
        $child_id_result = $this->monthly->get_child_monthly($previous_month, $year);

        // convert child id result to array
        $child_id_array = array();

        foreach ($child_id_result as $ch) 
        {
            $child_id_array[] = $ch->child_id;
        }

        // get table result where child_id_array is not in (also check if registered atleast last month)
        $list = $this->cis->get_datatables_monthly($child_id_array, $previous_month, $year);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $cis) {
            $no++;
            $row = array();
            $row[] = 'C' . $cis->child_id;
            $row[] = $cis->lastname;
            $row[] = $cis->firstname;
            $row[] = $cis->middlename;
            $row[] = $cis->dob;

            // age in mos
            $birthday = new DateTime($cis->dob);

            $diff = $birthday->diff(new DateTime());
            $months = $diff->format('%m') + 12 * $diff->format('%y');

            $row[] = $months;          

            // $row[] = $cis->pob;
            $row[] = $cis->sex;
            // $row[] = $cis->religion;
            $row[] = $cis->weight;
            $row[] = $cis->height;
            // $row[] = $cis->disability;
            // $row[] = $cis->contact;
            // $row[] = $cis->school;
            // $row[] = $cis->grade_level;
            // $row[] = $cis->address;
            $row[] = $this->barangays->get_barangay_name($cis->barangay_id);

            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view_profile_notification('."'".$cis->child_id."'".')"><i class="fa fa-eye"></i> </a>';

            $row[] = $cis->date_registered;
            $row[] = $cis->encoded;
            // $row[] = $cis->graduated;
            // $row[] = $cis->date_graduated;
            //add html for action
            
    
            $data[] = $row;
        }
    
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->cis->count_all_monthly($child_id_array, $previous_month, $year),
                        "recordsFiltered" => $this->cis->count_filtered_monthly($child_id_array, $previous_month, $year),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_list_quarterly()
    {
        // get last month
        $current_month = date('m');
        $year = date('Y'); // current year but can be changed to last year if current month is Jan

        if ($current_month < 4) // if current month is Jan-Mar which is 1st quarter, prev quarter should be 4th
        {
            $reg_month = 12;
            $previous_quarter = 4;
            $year = $year - 1;
        }
        else if ($current_month < 7) // if current month is Apr-Jun which is 2nd quarter, prev quarter should be 1st
        {
            $reg_month = 3;
            $previous_quarter = 1;
        }
        else if ($current_month < 10) // if current month is Jul-Sep which is 3rd quarter, prev quarter should be 2nd
        {
            $reg_month = 6;
            $previous_quarter = 2;
        }
        else // if current month is Oct-Dec which is 4th quarter, prev quarter should be 3rd
        {
            $reg_month = 9;
            $previous_quarter = 3;
        }

        // get child_id array for hvi quarterly done the previous quarter
        $child_id_result = $this->hvi->get_child_quarterly($previous_quarter, $year);

        // convert child id result to array
        $child_id_array = array();

        foreach ($child_id_result as $ch) 
        {
            $child_id_array[] = $ch->child_id;
        }
        
        // get table result where child_id_array is not in (also check if registered since last quarter)
        $list = $this->cis->get_datatables_quarterly($child_id_array, $reg_month, $year);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $cis) {
            $no++;
            $row = array();
            $row[] = 'C' . $cis->child_id;
            $row[] = $cis->lastname;
            $row[] = $cis->firstname;
            $row[] = $cis->middlename;
            $row[] = $cis->dob;

            // age in mos
            $birthday = new DateTime($cis->dob);

            $diff = $birthday->diff(new DateTime());
            $months = $diff->format('%m') + 12 * $diff->format('%y');

            $row[] = $months;          

            // $row[] = $cis->pob;
            $row[] = $cis->sex;
            // $row[] = $cis->religion;
            $row[] = $cis->weight;
            $row[] = $cis->height;
            // $row[] = $cis->disability;
            // $row[] = $cis->contact;
            // $row[] = $cis->school;
            // $row[] = $cis->grade_level;
            // $row[] = $cis->address;
            $row[] = $this->barangays->get_barangay_name($cis->barangay_id);

            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view_profile_notification('."'".$cis->child_id."'".')"><i class="fa fa-eye"></i> </a>';

            $row[] = $cis->date_registered;
            $row[] = $cis->encoded;
            // $row[] = $cis->graduated;
            // $row[] = $cis->date_graduated;
            //add html for action
            
    
            $data[] = $row;
        }
    
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->cis->count_all_quarterly($child_id_array, $reg_month, $year),
                        "recordsFiltered" => $this->cis->count_filtered_quarterly($child_id_array, $reg_month, $year),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_list_deworming()
    {
        // get last month
        $current_month = date('m');
        $year = date('Y'); // current year but can be changed to last year if current month is Jan

        if ($current_month < 7) // if current month is Jan-Jun which is 1st sem, prev sem should be 2nd
        {
            $reg_month = 12;
            $previous_sem = 2;
            $year = $year - 1;
        }
        else // if current month is Jul-Dec which is 2nd sem, prev sem should be 1st
        {
            $reg_month = 6;
            $previous_sem = 1;
        }

        // get child_id array for deworming semi-annually done the previous sem
        $child_id_result = $this->deworming->get_child_deworming($previous_sem, $year);

        // convert child id result to array
        $child_id_array = array();

        foreach ($child_id_result as $ch) 
        {
            $child_id_array[] = $ch->child_id;
        }
        
        // get table result where child_id_array is not in (also check if registered since last quarter)
        $list = $this->cis->get_datatables_deworming($child_id_array, $reg_month, $year);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $cis) {
            $no++;
            $row = array();
            $row[] = 'C' . $cis->child_id;
            $row[] = $cis->lastname;
            $row[] = $cis->firstname;
            $row[] = $cis->middlename;
            $row[] = $cis->dob;

            // age in mos
            $birthday = new DateTime($cis->dob);

            $diff = $birthday->diff(new DateTime());
            $months = $diff->format('%m') + 12 * $diff->format('%y');

            $row[] = $months;          

            // $row[] = $cis->pob;
            $row[] = $cis->sex;
            // $row[] = $cis->religion;
            $row[] = $cis->weight;
            $row[] = $cis->height;
            // $row[] = $cis->disability;
            // $row[] = $cis->contact;
            // $row[] = $cis->school;
            // $row[] = $cis->grade_level;
            // $row[] = $cis->address;
            $row[] = $this->barangays->get_barangay_name($cis->barangay_id);

            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view_profile_notification('."'".$cis->child_id."'".')"><i class="fa fa-eye"></i> </a>';

            $row[] = $cis->date_registered;
            $row[] = $cis->encoded;
            // $row[] = $cis->graduated;
            // $row[] = $cis->date_graduated;
            //add html for action
            
    
            $data[] = $row;
        }
    
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->cis->count_all_deworming($child_id_array, $reg_month, $year),
                        "recordsFiltered" => $this->cis->count_filtered_deworming($child_id_array, $reg_month, $year),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }


    public function ajax_list_severe()
    {
        // for severe status notification ----------------------------------------------------------------------------
        
        // get table result where child_id_array is not in (also check if registered since last quarter)
        $list = $this->cis->get_children_list();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $cis) 
        {
            $no++;
            $row = array();


            $child_id = $cis->child_id;

            // for latest monthly checkup data values
            $latest_monthly = $this->monthly->get_by_child_id($child_id);


            // age in mos
            $birthday = new DateTime($cis->dob);
            $date_registered = $cis->date_registered;

            if ($latest_monthly == null) // if no latest monthly use initial heigh & weight values and initial age mos.
            {
                $diff = $birthday->diff(new DateTime($date_registered));
            } 
            else
            {
                $diff = $birthday->diff(new DateTime());
            }

            $months = $diff->format('%m') + 12 * $diff->format('%y');

            $sex = $cis->sex;

            // ========================= FOR HEIGHT STATUS CATEGORY CHART ==================================================

            // height weight status category conditions

            // for age in mos. ------------------------------------------------------------------
            $age_in_mos = $months;

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

            $initial_weight = $cis->weight;


            // first check if male or female
            if ($sex == 'Male') // Male ---------------------------------------------------------
            {
                // get boys status data if male
                $boys_data = $this->boys->get_by_age_months($age_in_mos);

                if ($latest_monthly == null) // if no latest monthly use initial heigh & weight values
                {
                    // for Weight status
                    if ($initial_weight <= $boys_data->su)
                    {
                        $row[] = 'C' . $cis->child_id;
                        $row[] = $cis->lastname;
                        $row[] = $cis->firstname;
                        $row[] = $cis->middlename;
                        $row[] = $cis->dob;

                        // age in mos
                        $n_birthday = new DateTime($cis->dob);

                        $n_diff = $birthday->diff(new DateTime());
                        $n_months = $diff->format('%m') + 12 * $diff->format('%y');

                        $row[] = $n_months;          

                        // $row[] = $cis->pob;
                        $row[] = $cis->sex;
                        // $row[] = $cis->religion;
                        $row[] = $cis->weight;
                        $row[] = $cis->height;
                        // $row[] = $cis->disability;
                        // $row[] = $cis->contact;
                        // $row[] = $cis->school;
                        // $row[] = $cis->grade_level;
                        // $row[] = $cis->address;
                        $row[] = $this->barangays->get_barangay_name($cis->barangay_id);

                        $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view_profile_notification('."'".$cis->child_id."'".')"><i class="fa fa-eye"></i> </a>';

                        $row[] = $cis->date_registered;
                        $row[] = $cis->encoded;
                        // $row[] = $cis->graduated;
                        // $row[] = $cis->date_graduated;
                        //add html for action
                        
                        
                        $data[] = $row;
                    }

                }
                else // if it has latest monthly checkup values (the latest_monthly array has values)
                {
                    
                    $latest_weight = $latest_monthly['weight'];

                    // $latest_bmi = ($latest_weight / ($latest_height / 100)) / ($latest_height / 100);

                    // for Weight status
                    if ($latest_weight <= $boys_data->su)
                    {
                        $row[] = 'C' . $cis->child_id;
                        $row[] = $cis->lastname;
                        $row[] = $cis->firstname;
                        $row[] = $cis->middlename;
                        $row[] = $cis->dob;

                        // age in mos
                        $n_birthday = new DateTime($cis->dob);

                        $n_diff = $birthday->diff(new DateTime());
                        $n_months = $diff->format('%m') + 12 * $diff->format('%y');

                        $row[] = $n_months;          

                        // $row[] = $cis->pob;
                        $row[] = $cis->sex;
                        // $row[] = $cis->religion;
                        $row[] = $cis->weight;
                        $row[] = $cis->height;
                        // $row[] = $cis->disability;
                        // $row[] = $cis->contact;
                        // $row[] = $cis->school;
                        // $row[] = $cis->grade_level;
                        // $row[] = $cis->address;
                        $row[] = $this->barangays->get_barangay_name($cis->barangay_id);

                        $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view_profile_notification('."'".$cis->child_id."'".')"><i class="fa fa-eye"></i> </a>';

                        $row[] = $cis->date_registered;
                        $row[] = $cis->encoded;
                        // $row[] = $cis->graduated;
                        // $row[] = $cis->date_graduated;
                        //add html for action
                        
                        
                        $data[] = $row;
                    }
                }
                 
            }
            else // Female --------------------------------------------------------------------
            {
                // get girls status data if female
                $girls_data = $this->girls->get_by_age_months($age_in_mos);

                if ($latest_monthly == null) // if no latest monthly (apply 'n/a to all values in latest')
                {
                    // for Weight status
                    if ($initial_weight <= $girls_data->su)
                    {
                        $row[] = 'C' . $cis->child_id;
                        $row[] = $cis->lastname;
                        $row[] = $cis->firstname;
                        $row[] = $cis->middlename;
                        $row[] = $cis->dob;

                        // age in mos
                        $n_birthday = new DateTime($cis->dob);

                        $n_diff = $birthday->diff(new DateTime());
                        $n_months = $diff->format('%m') + 12 * $diff->format('%y');

                        $row[] = $n_months;          

                        // $row[] = $cis->pob;
                        $row[] = $cis->sex;
                        // $row[] = $cis->religion;
                        $row[] = $cis->weight;
                        $row[] = $cis->height;
                        // $row[] = $cis->disability;
                        // $row[] = $cis->contact;
                        // $row[] = $cis->school;
                        // $row[] = $cis->grade_level;
                        // $row[] = $cis->address;
                        $row[] = $this->barangays->get_barangay_name($cis->barangay_id);

                        $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view_profile_notification('."'".$cis->child_id."'".')"><i class="fa fa-eye"></i> </a>';

                        $row[] = $cis->date_registered;
                        $row[] = $cis->encoded;
                        // $row[] = $cis->graduated;
                        // $row[] = $cis->date_graduated;
                        //add html for action
                        
                        
                        $data[] = $row;
                    }

                }
                else // if it has latest monthly checkup values (the latest_monthly array has values)
                {
                    
                    $latest_weight = $latest_monthly['weight'];

                    // for Weight status
                    if ($latest_weight <= $girls_data->su)
                    {
                        $row[] = 'C' . $cis->child_id;
                        $row[] = $cis->lastname;
                        $row[] = $cis->firstname;
                        $row[] = $cis->middlename;
                        $row[] = $cis->dob;

                        // age in mos
                        $n_birthday = new DateTime($cis->dob);

                        $n_diff = $birthday->diff(new DateTime());
                        $n_months = $diff->format('%m') + 12 * $diff->format('%y');

                        $row[] = $n_months;          

                        // $row[] = $cis->pob;
                        $row[] = $cis->sex;
                        // $row[] = $cis->religion;
                        $row[] = $cis->weight;
                        $row[] = $cis->height;
                        // $row[] = $cis->disability;
                        // $row[] = $cis->contact;
                        // $row[] = $cis->school;
                        // $row[] = $cis->grade_level;
                        // $row[] = $cis->address;
                        $row[] = $this->barangays->get_barangay_name($cis->barangay_id);

                        $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view_profile_notification('."'".$cis->child_id."'".')"><i class="fa fa-eye"></i> </a>';

                        $row[] = $cis->date_registered;
                        $row[] = $cis->encoded;
                        // $row[] = $cis->graduated;
                        // $row[] = $cis->date_graduated;
                        //add html for action
                        
                        
                        $data[] = $row;
                    }
                }
            }
        }
    
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => count($data),
                        "recordsFiltered" => count($data),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    //========================================= NOTIFICATIONS TABLE =====================================================
 
    public function ajax_edit($child_id)
    {
        $data = $this->cis->get_by_id($child_id);
        echo json_encode($data);
    }
 
    public function ajax_add()
    {
        $this->_validate();
        $data = array(
                'lastname' => $this->input->post('lastname'),
                'firstname' => $this->input->post('firstname'),
                'middlename' => $this->input->post('middlename'),
                'pob' => $this->input->post('pob'),
                'dob' => $this->input->post('dob'),
                'sex' => $this->input->post('sex'),
                'religion' => $this->input->post('religion'),
                'weight' => $this->input->post('weight'),
                'height' => $this->input->post('height'),
                'disability' => $this->input->post('disability'),
                'contact' => $this->input->post('contact'),
                'school' => $this->input->post('school'),
                'grade_level' => $this->input->post('grade_level'),
                'address' => $this->input->post('address'),
                'barangay_id' => $this->input->post('barangay_id'),
                'date_registered' => $this->input->post('date_registered'),
                // 'encoded' => $this->input->post('encoded'),
                'graduated' => 0,
                'removed' => 0,
                // 'date_graduated' => $this->input->post('date_graduated'),
            );
        $insert = $this->cis->save($data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_update()
    {
        $this->_validate();
        $data = array(
                'lastname' => $this->input->post('lastname'),
                'firstname' => $this->input->post('firstname'),
                'middlename' => $this->input->post('middlename'),
                'pob' => $this->input->post('pob'),
                'dob' => $this->input->post('dob'),
                'sex' => $this->input->post('sex'),
                'religion' => $this->input->post('religion'),
                'weight' => $this->input->post('weight'),
                'height' => $this->input->post('height'),
                'disability' => $this->input->post('disability'),
                'contact' => $this->input->post('contact'),
                'school' => $this->input->post('school'),
                'grade_level' => $this->input->post('grade_level'),
                'address' => $this->input->post('address'),
                'barangay_id' => $this->input->post('barangay_id'),
                'date_registered' => $this->input->post('date_registered'),
                // 'encoded' => $this->input->post('encoded'),
                // 'graduated' => $this->input->post('graduated'),
            );
        $this->cis->update(array('child_id' => $this->input->post('child_id')), $data);
        echo json_encode(array("status" => TRUE));
    }
 
    // graduate a child
    public function ajax_graduate($child_id)
    {
        $data = array(
                'graduated' => '1',
                'date_graduated' => date("Y-m-d")
            );
        $this->cis->update(array('child_id' => $child_id), $data);
        echo json_encode(array("status" => TRUE));
    }

    // delete a child
    public function ajax_delete($child_id)
    {
        $data = array(
                'removed' => '1'
            );
        $this->cis->update(array('child_id' => $child_id), $data);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('lastname') == '')
        {
            $data['inputerror'][] = 'lastname';
            $data['error_string'][] = 'Last name is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('firstname') == '')
        {
            $data['inputerror'][] = 'firstname';
            $data['error_string'][] = 'First name is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('middlename') == '')
        {
            $data['inputerror'][] = 'middlename';
            $data['error_string'][] = 'Middle name is required';
            $data['status'] = FALSE;
        }
        // validation for duplicates
        else
        {
            $new_name = $this->input->post('lastname') . $this->input->post('firstname') . $this->input->post('middlename');
            // check if name has a new value or not
            if ($this->input->post('current_name') != $new_name)
            {
                // validate if name already exist in the databaase table
                $duplicates = $this->cis->get_duplicates($this->input->post('lastname'), $this->input->post('firstname'), $this->input->post('middlename'));

                if ($duplicates->num_rows() != 0)
                {
                    $data['inputerror'][] = 'lastname';
                    $data['error_string'][] = 'Child name (full name) is already registered';
                    $data['status'] = FALSE;
                }
            }
        }

        if($this->input->post('dob') == '')
        {
            $data['inputerror'][] = 'dob';
            $data['error_string'][] = 'Date of Birth is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('pob') == '')
        {
            $data['inputerror'][] = 'pob';
            $data['error_string'][] = 'Place of Birth is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('sex') == '')
        {
            $data['inputerror'][] = 'sex';
            $data['error_string'][] = 'Gender is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('religion') == '')
        {
            $data['inputerror'][] = 'religion';
            $data['error_string'][] = 'Religion is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('height') == '')
        {
            $data['inputerror'][] = 'height';
            $data['error_string'][] = 'Initial Height is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('weight') == '')
        {
            $data['inputerror'][] = 'weight';
            $data['error_string'][] = 'Initial Weight is required';
            $data['status'] = FALSE;
        }

        // if($this->input->post('disability') == '')
        // {
        //     $data['inputerror'][] = 'disability';
        //     $data['error_string'][] = 'Disability is required';
        //     $data['status'] = FALSE;
        // }

        // if($this->input->post('contact') == '')
        // {
        //     $data['inputerror'][] = 'contact';
        //     $data['error_string'][] = 'Contact is required';
        //     $data['status'] = FALSE;
        // }

        // if($this->input->post('school') == '')
        // {
        //     $data['inputerror'][] = 'school';
        //     $data['error_string'][] = 'Address is required';
        //     $data['status'] = FALSE;
        // }

        // if($this->input->post('grade_level') == '')
        // {
        //     $data['inputerror'][] = 'grade_level';
        //     $data['error_string'][] = 'Address is required';
        //     $data['status'] = FALSE;
        // }

        if($this->input->post('address') == '')
        {
            $data['inputerror'][] = 'address';
            $data['error_string'][] = 'Address is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('barangay_id') == '')
        {
            $data['inputerror'][] = 'barangay_id';
            $data['error_string'][] = 'Barangay is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('date_registered') == '')
        {
            $data['inputerror'][] = 'date_registered';
            $data['error_string'][] = 'Date registered is required';
            $data['status'] = FALSE;
        }     

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
 }