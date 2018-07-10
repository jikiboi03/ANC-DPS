<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profiles_controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('cis/cis_model','cis');
        $this->load->model('his/his_model','his');
        $this->load->model('hvi/hvi_model','hvi');
        $this->load->model('family/family_model','family');
        $this->load->model('barangays/barangays_model','barangays');
        $this->load->model('graduated/graduated_model','graduated');
        $this->load->model('attendance/attendance_model','attendance');
        $this->load->model('monthly/monthly_model','monthly');
        $this->load->model('Hw_status/Hw_status_boys_model','boys');
        $this->load->model('Hw_status/Hw_status_girls_model','girls');

        $this->load->model('dec_tree/dec_tree_model','dec_tree');
        
    }

   public function index($child_id)						/** Note: ayaw ilisi ang sequence sa page load sa page **/
   {
        if($this->session->userdata('user_id') == '')
        {
          redirect('error500');
        }

        $child_data = $this->cis->get_by_id($child_id);

        $date_graduated = $this->graduated->get_by_child_id($child_id);
        

        // ======================== ATTENDANCE DATA ===============================================================

        // get anc last active date (last date that has atleast 1 child present)
        $last_active_date = $this->attendance->get_last_active_date();

        // first date the child is present
        $first_date_present = $this->attendance->get_first_date_present($child_id);

        // if not a single day present
        if ($first_date_present == null)
        {
            $active_days_count = 0;

            $first_date_present = 'n/a';

            $days_present = 0;
            $days_absent = 0;           
        }
        else
        {
             // count of days where the child should be present   
            $active_days_count = $this->attendance->get_active_days_count($first_date_present, $date_graduated, $last_active_date);

            // get days present then days absent by subtracting total child active days with days present
            $days_present = $this->attendance->get_days_present($child_id);

            $days_absent = $active_days_count - $days_present;
        }

        $data['last_active_date'] = $last_active_date;
        $data['first_date_present'] = $first_date_present;
        $data['active_days_count'] = $active_days_count;
        $data['days_present'] = $days_present;
        $data['days_absent'] = $days_absent;



        // ======================== HEIGHT / WEIGHT STATUS DATA =================================================       

        // height weight status category conditions

        // get child sex and age in months
        $sex = $child_data->sex;


        // for age in mos. ------------------------------------------------------------------
        $birth_date = new DateTime($child_data->dob);

        if ($child_data->graduated == '1')
        {
            $date_graduated = $this->graduated->get_by_child_id($child_id);
            $diff = $birth_date->diff(new DateTime($date_graduated));    
        }
        else
        {
            $diff = $birth_date->diff(new DateTime());
        }

        // $diff = $birth_date->diff(new DateTime());

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


        $initial_height = $child_data->height;
        $initial_weight = $child_data->weight;

        // for latest monthly checkup data values
        $latest_monthly = $this->monthly->get_by_child_id($child_id);

        // first check if male or female
        if ($sex == 'Male') // Male ---------------------------------------------------------
        {

            // for age in mos. ------------------------------------------------------------------
            $birth_date = new DateTime($child_data->dob);

            $date_registered = $child_data->date_registered;
            $diff = $birth_date->diff(new DateTime($date_registered));
            // $diff = $birth_date->diff(new DateTime());

            $age_in_mos_registered = $diff->format('%m') + 12 * $diff->format('%y');

            // if no status data for months recorded (scope of satatus data: 36-71 mos only)
            if ($age_in_mos_registered <= 35) // 0-35 mos.
            {
                $age_in_mos_registered = 36; // lowest month data to use
            }
            
            if ($age_in_mos_registered >= 109) // 109 and up
            {
                $age_in_mos_registered = 108; // highest month data to use
            }


            // get boys status data if male
            $boys_data = $this->boys->get_by_age_months($age_in_mos_registered);

            // for Height status
            if ($initial_height <= $boys_data->sst)
            {
                $initial_height_status = '<i style="color:red;"> SSt </i>';
            }
            else if ($initial_height <= $boys_data->st)
            {   
                $initial_height_status = '<i style="color:brown;"> St </i>';
            }
            else if ($initial_height <= $boys_data->hn)
            {
                $initial_height_status = '<i style="color:green;"> N </i>';
            }
            else
            {
                $initial_height_status = '<i style="color:purple;"> T </i>';   
            }

            // for Weight status
            if ($initial_weight <= $boys_data->su)
            {
                $initial_weight_status = '<i style="color:red;"> SU </i>';
            }
            else if ($initial_weight <= $boys_data->u)
            {   
                $initial_weight_status = '<i style="color:brown;"> U </i>';
            }
            else if ($initial_weight <= $boys_data->wn)
            {
                $initial_weight_status = '<i style="color:green;"> N </i>';
            }
            else
            {
                $initial_weight_status = '<i style="color:purple;"> O </i>';   
            }


            // get boys status data if male
            $boys_data = $this->boys->get_by_age_months($age_in_mos);


            if ($latest_monthly == null) // if no latest monthly (apply 'n/a to all values in latest')
            {
                $latest_height = 'n/a'; 
                $latest_weight = 'n/a';
                $latest_bmi = 'n/a';

                $latest_height_status = 'n/a';
                $latest_weight_status = 'n/a';
            }
            else // if it has latest monthly checkup values (the latest_monthly array has values)
            {
                $latest_height = $latest_monthly['height']; 
                $latest_weight = $latest_monthly['weight'];
                $latest_bmi = ($latest_weight / ($latest_height / 100)) / ($latest_height / 100);


                // for Height status
                if ($latest_height <= $boys_data->sst)
                {
                    $latest_height_status = '<i style="color:red;"> SSt </i>';
                }
                else if ($latest_height <= $boys_data->st)
                {   
                    $latest_height_status = '<i style="color:brown;"> St </i>';
                }
                else if ($latest_height <= $boys_data->hn)
                {
                    $latest_height_status = '<i style="color:green;"> N </i>';
                }
                else
                {
                    $latest_height_status = '<i style="color:purple;"> T </i>';   
                }

                // for Weight status
                if ($latest_weight <= $boys_data->su)
                {
                    $latest_weight_status = '<i style="color:red;"> SU </i>';
                }
                else if ($latest_weight <= $boys_data->u)
                {   
                    $latest_weight_status = '<i style="color:brown;"> U </i>';
                }
                else if ($latest_weight <= $boys_data->wn)
                {
                    $latest_weight_status = '<i style="color:green;"> N </i>';
                }
                else
                {
                    $latest_weight_status = '<i style="color:purple;"> O </i>';   
                }


                // update for representation
                $latest_height = $latest_height . ' Cm'; 
                $latest_weight = $latest_weight . ' Kg';
                $latest_bmi = number_format((float)$latest_bmi, 1, '.', '');
            }
             
        }
        else // Female --------------------------------------------------------------------
        {

            // for age in mos. ------------------------------------------------------------------
            $birth_date = new DateTime($child_data->dob);

            $date_registered = $child_data->date_registered;
            $diff = $birth_date->diff(new DateTime($date_registered));
            // $diff = $birth_date->diff(new DateTime());

            $age_in_mos_registered = $diff->format('%m') + 12 * $diff->format('%y');

            // if no status data for months recorded (scope of satatus data: 36-71 mos only)
            if ($age_in_mos_registered <= 35) // 0-35 mos.
            {
                $age_in_mos_registered = 36; // lowest month data to use
            }
            
            if ($age_in_mos_registered >= 109) // 109 and up
            {
                $age_in_mos_registered = 108; // highest month data to use
            }

            // get girls status data if female
            $girls_data = $this->girls->get_by_age_months($age_in_mos_registered);

            // for Height status
            if ($initial_height <= $girls_data->sst)
            {
                $initial_height_status = '<i style="color:red;"> SSt </i>';
            }
            else if ($initial_height <= $girls_data->st)
            {   
                $initial_height_status = '<i style="color:brown;"> St </i>';
            }
            else if ($initial_height <= $girls_data->hn)
            {
                $initial_height_status = '<i style="color:green;"> N </i>';
            }
            else
            {
                $initial_height_status = '<i style="color:purple;"> T </i>';   
            }

            // for Weight status
            if ($initial_weight <= $girls_data->su)
            {
                $initial_weight_status = '<i style="color:red;"> SU </i>';
            }
            else if ($initial_weight <= $girls_data->u)
            {   
                $initial_weight_status = '<i style="color:brown;"> U </i>';
            }
            else if ($initial_weight <= $girls_data->wn)
            {
                $initial_weight_status = '<i style="color:green;"> N </i>';
            }
            else
            {
                $initial_weight_status = '<i style="color:purple;"> O </i>';   
            }

            // get girls status data if female
            $girls_data = $this->girls->get_by_age_months($age_in_mos);


            if ($latest_monthly == null) // if no latest monthly (apply 'n/a to all values in latest')
            {
                $latest_height = 'n/a'; 
                $latest_weight = 'n/a';
                $latest_bmi = 'n/a';

                $latest_height_status = 'n/a';
                $latest_weight_status = 'n/a';
            }
            else // if it has latest monthly checkup values (the latest_monthly array has values)
            {
                $latest_height = $latest_monthly['height']; 
                $latest_weight = $latest_monthly['weight'];
                $latest_bmi = ($latest_weight / ($latest_height / 100)) / ($latest_height / 100);


                // for Height status
                if ($latest_height <= $girls_data->sst)
                {
                    $latest_height_status = '<i style="color:red;"> SSt </i>';
                }
                else if ($latest_height <= $girls_data->st)
                {   
                    $latest_height_status = '<i style="color:brown;"> St </i>';
                }
                else if ($latest_height <= $girls_data->hn)
                {
                    $latest_height_status = '<i style="color:green;"> N </i>';
                }
                else
                {
                    $latest_height_status = '<i style="color:purple;"> T </i>';   
                }

                // for Weight status
                if ($latest_weight <= $girls_data->su)
                {
                    $latest_weight_status = '<i style="color:red;"> SU </i>';
                }
                else if ($latest_weight <= $girls_data->u)
                {   
                    $latest_weight_status = '<i style="color:brown;"> U </i>';
                }
                else if ($latest_weight <= $girls_data->wn)
                {
                    $latest_weight_status = '<i style="color:green;"> N </i>';
                }
                else
                {
                    $latest_weight_status = '<i style="color:purple;"> O </i>';   
                }


                // update for representation
                $latest_height = $latest_height . ' Cm'; 
                $latest_weight = $latest_weight . ' Kg';
                $latest_bmi = number_format((float)$latest_bmi, 1, '.', '');
            }
        }


        // =============================== DATA ANALYTICS =======================================================

        // REGRESSION ANALYSIS  ---------------------------------------------------------------------------------

        // months old of child after 24mos.
        $peak_month = $age_in_mos_registered + 24;

        if ($peak_month <= 108)
        {
            if ($sex == 'Male') // Male ---------------------------------------------------------
            {
                // get normal weight after peak month (avegare normal weight)
                $boys_data_peak = ($this->boys->get_by_age_months($peak_month)->u + $this->boys->get_by_age_months($peak_month)->wn) / 2.5;

                // get normal which is more than underweight boundary
                $peak_weight = $boys_data_peak;        
            }
            else
            {
                // get girls status data if female
                $girls_data_peak = ($this->girls->get_by_age_months($peak_month)->u + $this->girls->get_by_age_months($peak_month)->wn) / 2.5;

                // get normal which is more than underweight boundary
                $peak_weight = $girls_data_peak;
            }

            
        }
        else // if more than 108 mos.
        {
            $mos_diff = $peak_month - 108;

            // get expected additional weight to add by multiplying it by 0.1;
            $add_weight = $mos_diff * 0.5;

            // peak weight conservative +6

            // first check if male or female
            if ($sex == 'Male') // Male ---------------------------------------------------------
            {
                // get boys status data if male (get 108mos record)
                $boys_data_peak = ($this->boys->get_by_age_months(108)->u + $this->boys->get_by_age_months(108)->wn) / 2.5;

                // get normal which is more than underweight boundary
                $peak_weight = $boys_data_peak + 6 + $add_weight;
            }
            else
            {
                // get boys status data if male (get 108mos record)
                $girls_data_peak = ($this->girls->get_by_age_months(108)->u + $this->girls->get_by_age_months(108)->wn) /2.5;

                // get normal which is more than underweight boundary
                $peak_weight = $girls_data_peak + 6 + $add_weight;
            }
        }
        
        $slope = ($peak_weight - $initial_weight) / 24;

        $data['slope'] = $slope;
        $data['peak_weight'] = $peak_weight;
        

        // ======================== HEIGHT / WEIGHT STATUS DATA =================================================       
        
        // latest height, weight, bmi
        $data['latest_height'] = $latest_height;
        $data['latest_weight'] = $latest_weight;
        $data['latest_bmi'] = $latest_bmi;

        $data['initial_height_status'] = $initial_height_status;
        $data['initial_weight_status'] = $initial_weight_status;
        
        $data['latest_height_status'] = $latest_height_status;
        $data['latest_weight_status'] = $latest_weight_status;


        // DECISION TREE ----------------------------------------------------------------------------------------

        if ($latest_monthly == null) // if no latest monthly (apply 'n/a to all values in latest')
        {
            $current_status = '<h4 style="color: brown";>Child has no monthly checkup record to analyze <i class="fa fa-exclamation-circle"></i></h4>';
        }
        else // if it has latest monthly checkup values (the latest_monthly array has values)
        {
            // get all single child monthly checkups in descending value
            $all_child_monthly = $this->monthly->get_all_child_monthly($child_id);

            $latest_weight = $latest_monthly['weight'];

            // get second last monthly check up weight ---------------------------------------
            $data_all_monthly = array();
            foreach ($all_child_monthly as $all_monthly_checkups) 
            {
                $data_all_monthly[] = $all_monthly_checkups->weight;
            }

            // if there are 2 or more monthly checkup
            if (count($data_all_monthly) >= 2)
            {
                $second_last_monthly_weight = $data_all_monthly[1];

                // difference of weight (latest month - second last month)
                $weight_diff = $latest_weight - $second_last_monthly_weight;
            }
            else // if only one monthly checkup, use initial weight
            {
                // difference of weight (latest month - initial)
                $weight_diff = $latest_weight - $initial_weight;
            }
            
            // if weight had improve from initial or last month to latest
            if ($weight_diff > 0)
            {
                $current_status = '<h4 style="color: green;">Child nutrional status had improved from previous record <i class="fa fa-check-circle"></i></h4>';
            }
            else // if not improved <= 0 
            {
                $current_status = '<h4 style="color: red;">Child nutrional status had not improved from previous record <i class="fa fa-times-circle"></i></h4>';
                // $current_status = 'Child nutrional status did not improve ' . count($data_all_monthly) . ' ' . $latest_weight . ' - ' . $second_last_monthly_weight . ' ' . $weight_diff;
            }
        }

        $data['current_status'] = $current_status;
        

        $data['date_graduated'] = $date_graduated;

        $data['child'] = $child_data;

        // get barangays list for dropdown
        $data['barangays'] = $this->barangays->get_barangays();

        $this->load->helper('url');							
        											
        $data['title'] = 'Child Profile';					
        $this->load->view('template/dashboard_header',$data);
        $this->load->view('profiles/profiles_view',$data);   //Kani lang ang ilisi kung mag dungag mo ug Page
        $this->load->view('template/dashboard_navigation');
        $this->load->view('template/dashboard_footer');

   }
   
    public function ajax_list($child_id)
    {
        $list = $this->family->get_datatables($child_id);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $family) {
            $no++;
            $row = array();
            $row[] = $family->family_id;
            $row[] = $family->name;
            $row[] = $family->relation;

            $row[] = $family->age . ' y.o.';          
            $row[] = $family->sex;
            $row[] = $family->status;

            $row[] = $family->education;
            $row[] = $family->occupation;
            $row[] = 'Php ' . $family->income;


            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_family('."'".$family->family_id."'".')"><i class="fa fa-pencil-square-o"></i> </a>
                      
                      <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_family('."'".$family->family_id."'".')"><i class="fa fa-trash"></i></a>';
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->family->count_all($child_id),
                        "recordsFiltered" => $this->family->count_filtered($child_id),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
 
    public function edit_cis_view($child_id)
    {
        $data['child'] = $this->cis->get_by_id($child_id);

        // get barangays list for dropdown
        $data['barangays'] = $this->barangays->get_barangays();

        $this->load->helper('url');                         
                                                    
        $data['title'] = 'Edit Child Information (CIS)';                   
        $this->load->view('template/dashboard_header',$data);
        $this->load->view('profiles/edit_cis_view',$data);   //Kani lang ang ilisi kung mag dungag mo ug Page
        $this->load->view('template/dashboard_navigation');
        $this->load->view('template/dashboard_footer');
    }

    //========================================= FAMILY SECTION ==========================================================
 
    // add family member
    public function ajax_add()
    {
        $this->_validate();
        $data = array(
                'child_id' => $this->input->post('child_id'),
                'name' => $this->input->post('name'),
                'relation' => $this->input->post('relation'),
                'age' => $this->input->post('age'),
                'sex' => $this->input->post('sex'),
                'status' => $this->input->post('status'),
                'education' => $this->input->post('education'),
                'occupation' => $this->input->post('occupation'),
                'income' => $this->input->post('income')
            );
        $insert = $this->family->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_edit($family_id)
    {
        $data = $this->family->get_by_id($family_id);
        echo json_encode($data);
    }
 
    public function ajax_update()
    {
        $this->_validate();
        $data = array(
                'name' => $this->input->post('name'),
                'relation' => $this->input->post('relation'),
                'age' => $this->input->post('age'),
                'sex' => $this->input->post('sex'),
                'status' => $this->input->post('status'),
                'education' => $this->input->post('education'),
                'occupation' => $this->input->post('occupation'),
                'income' => $this->input->post('income')
            );
        $this->family->update(array('family_id' => $this->input->post('family_id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    // delete a family member
    public function ajax_delete($family_id)
    {
        $this->family->delete_by_id($family_id);
        echo json_encode(array("status" => TRUE));
    }

    //========================================= FAMILY SECTION =======================================================
 

    public function do_upload() 
    {
         $config['upload_path']   = './uploads/pic1'; 
         $config['allowed_types'] = 'jpg|jpeg'; 
         $config['max_size']      = 2000; 
         $config['max_width']     = 5000; 
         $config['max_height']    = 5000;
         $new_name = $this->input->post('child_id') . '.jpg';
         $config['file_name'] = $new_name;
         $config['overwrite'] = TRUE;

         $this->load->library('upload', $config);
            
         if ( ! $this->upload->do_upload('userfile1')) // upload fail
         {
            $error = array('error' => $this->upload->display_errors()); 
            $this->load->view('upload_form', $error);
            // echo '<script type="text/javascript">alert("' . $error.toString() . '"); </script>';
         }
         else // upload success
         { 
            $data = array('upload_data' => $this->upload->data()); 
            
            $data = array(
                'pic1' => $new_name
            );
            $this->cis->update(array('child_id' => $this->input->post('child_id')), $data);
            redirect('/profiles-page/' . $this->input->post('child_id'));
         } 
    } 

    public function do_upload_2() 
    {
         $config['upload_path']   = './uploads/pic2'; 
         $config['allowed_types'] = 'jpg|jpeg'; 
         $config['max_size']      = 2000; 
         $config['max_width']     = 5000; 
         $config['max_height']    = 5000;
         $new_name = $this->input->post('child_id') . '.jpg';
         $config['file_name'] = $new_name;
         $config['overwrite'] = TRUE;

         $this->load->library('upload', $config);
            
         if ( ! $this->upload->do_upload('userfile2')) // upload fail
         {
            $error = array('error' => $this->upload->display_errors()); 
            $this->load->view('upload_form', $error);
            // echo '<script type="text/javascript">alert("' . $error.toString() . '"); </script>';
         }
         else // upload success
         { 
            $data = array('upload_data' => $this->upload->data()); 
            
            $data = array(
                'pic2' => $new_name
            );
            $this->cis->update(array('child_id' => $this->input->post('child_id')), $data);
            redirect('/profiles-page/' . $this->input->post('child_id'));
         } 
    }

    public function do_upload_3() 
    {
         $config['upload_path']   = './uploads/pic3'; 
         $config['allowed_types'] = 'jpg|jpeg'; 
         $config['max_size']      = 2000; 
         $config['max_width']     = 5000; 
         $config['max_height']    = 5000;
         $new_name = $this->input->post('child_id') . '.jpg';
         $config['file_name'] = $new_name;
         $config['overwrite'] = TRUE;

         $this->load->library('upload', $config);
            
         if ( ! $this->upload->do_upload('userfile3')) // upload fail
         {
            $error = array('error' => $this->upload->display_errors()); 
            $this->load->view('upload_form', $error);
            // echo '<script type="text/javascript">alert("' . $error.toString() . '"); </script>';
         }
         else // upload success
         { 
            $data = array('upload_data' => $this->upload->data()); 
            
            $data = array(
                'pic3' => $new_name
            );
            $this->cis->update(array('child_id' => $this->input->post('child_id')), $data);
            redirect('/profiles-page/' . $this->input->post('child_id'));
         } 
    }   
    // graduate a child
    // public function ajax_graduate($child_id)
    // {
    //     $data = array(
    //             'graduated' => '1',
    //             'date_graduated' => date("Y-m-d")
    //         );
    //     $this->cis->update(array('child_id' => $child_id), $data);
    //     echo json_encode(array("status" => TRUE));
    // }


    // monthly checkups section ====================================================================================

    public function ajax_all_child_monthly_ascending($child_id)
    {
        $data = $this->monthly->get_all_child_monthly_ascending($child_id);
        echo json_encode($data);
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('name') == '')
        {
            $data['inputerror'][] = 'name';
            $data['error_string'][] = 'Name is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('relation') == '')
        {
            $data['inputerror'][] = 'relation';
            $data['error_string'][] = 'Relation to the child is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('age') == '')
        {
            $data['inputerror'][] = 'age';
            $data['error_string'][] = 'Age is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('sex') == '')
        {
            $data['inputerror'][] = 'sex';
            $data['error_string'][] = 'Gender is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('status') == '')
        {
            $data['inputerror'][] = 'status';
            $data['error_string'][] = 'Marital status is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('education') == '')
        {
            $data['inputerror'][] = 'education';
            $data['error_string'][] = 'Educational attainment is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('occupation') == '')
        {
            $data['inputerror'][] = 'occupation';
            $data['error_string'][] = 'Current occupation is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('income') == '')
        {
            $data['inputerror'][] = 'income';
            $data['error_string'][] = 'Current income is required';
            $data['status'] = FALSE;
        }     

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
 }