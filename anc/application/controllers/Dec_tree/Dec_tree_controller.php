<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dec_tree_controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('cis/cis_model','cis');
        $this->load->model('his/his_model','his');
        $this->load->model('hvi/hvi_model','hvi');
        
        $this->load->model('monthly/monthly_model','monthly');
        $this->load->model('deworming/deworming_model','deworming');
        $this->load->model('attendance/attendance_model','attendance');
        $this->load->model('graduated/graduated_model','graduated');

        $this->load->model('dec_tree/dec_tree_model','dec_tree');
        $this->load->model('Hw_status/Hw_status_boys_model','boys');
        $this->load->model('Hw_status/Hw_status_girls_model','girls');
    }

   public function index($child_id)						/** Note: ayaw ilisi ang sequence sa page load sa page **/
   {
        if($this->session->userdata('user_id') == '')
        {
          redirect('error500');
        }

        $child_data = $this->cis->get_by_id($child_id);

        
        $initial_height = $child_data->height;
        $initial_weight = $child_data->weight;

        // for latest monthly checkup data values
        $latest_monthly = $this->monthly->get_by_child_id($child_id);

        // get child sex and age in months
        $sex = $child_data->sex;

        // for age in mos. ------------------------------------------------------------------
        $birth_date = new DateTime($child_data->dob);

        $diff = $birth_date->diff(new DateTime());
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


        // first check if male or female
        if ($sex == 'Male') // Male ---------------------------------------------------------
        {
            // get boys status data if male
            $boys_data = $this->boys->get_by_age_months($age_in_mos);

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
            // get girls status data if female
            $girls_data = $this->girls->get_by_age_months($age_in_mos);

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
                $current_status = '<h4 style="color: green;">Child nutrional status had improved from previous record<i class="fa fa-check-circle"></i></h4>';
            }
            else // if not improved <= 0 
            {
                $current_status = '<h4 style="color: red;">Child nutrional status had not improved from previous record <i class="fa fa-times-circle"></i></h4>';
                // $current_status = 'Child nutrional status did not improve ' . count($data_all_monthly) . ' ' . $latest_weight . ' - ' . $second_last_monthly_weight . ' ' . $weight_diff;
            }
        }

        $data['current_status'] = $current_status;


        // ======================== HEIGHT / WEIGHT STATUS DATA =================================================       
        
        // latest height, weight, bmi
        $data['latest_height'] = $latest_height;
        $data['latest_weight'] = $latest_weight;
        $data['latest_bmi'] = $latest_bmi;

        $data['initial_height_status'] = $initial_height_status;
        $data['initial_weight_status'] = $initial_weight_status;
        
        $data['latest_height_status'] = $latest_height_status;
        $data['latest_weight_status'] = $latest_weight_status;

        $data['child'] = $child_data;

        $this->load->helper('url');							
        											
        $data['title'] = 'Data Analytics - Decision Support';					
        $this->load->view('template/dashboard_header',$data);
        $this->load->view('dec_tree/dec_tree_view',$data);   //Kani lang ang ilisi kung mag dungag mo ug Page
        $this->load->view('template/dashboard_navigation');
        $this->load->view('template/dashboard_footer');

   }




    // ======================== DATA ANALYTICS DECISION TREE TABLE =============================================



    // applicable only if weight status is not improving or failing (latest weight <= past weight)
    public function ajax_list($child_id)
    {
        // fetch dec_tree data values (problems and solutions)
        $dec_tree = $this->dec_tree->get_data();

        $child_data = $this->cis->get_by_id($child_id);

        $initial_weight = $child_data->weight;
        
        $data = array();

        // for latest monthly checkup data values
        $latest_monthly = $this->monthly->get_by_child_id($child_id);

        if ($latest_monthly == null) // if no latest monthly (apply 'n/a to all values in latest')
        {
            // $current_status = '<h4 style="color: brown";>Child has no monthly checkup record to analyze <i class="fa fa-exclamation-circle"></i></h4>';
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
                // $current_status = '<h4 style="color: green;">Child nutrional status had improved <i class="fa fa-check-circle"></i></h4>';
            }
            else // if not improved <= 0 
            {


                // for no deworming for the previous semi-annual --------------------------------------------------
                $current_month = date('m');
                $year = date('Y'); // current year but can be changed to last year if current month is Jan

                if ($current_month < 7) // if current month is Jan-Jun which is 1st sem, prev sem should be 2nd
                {
                    $current_sem = 1;
                    $current_year = $year;

                    $previous_sem = 2;
                    $year = $year - 1;
                }
                else // if current month is Jul-Dec which is 2nd sem, prev sem should be 1st
                {
                    $current_sem = 2;
                    $current_year = $year;

                    $previous_sem = 1;
                }

                // get all child_id array for deworming semi-annually done the previous sem
                $child_id_result_prev = $this->deworming->get_child_deworming($previous_sem, $year);

                // get all child_id array for deworming semi-annually done the previous sem
                $child_id_result_current = $this->deworming->get_child_deworming($current_sem, $current_year);

                // convert child id result to array
                $child_id_array = array();

                foreach ($child_id_result_prev as $ch) 
                {
                    $child_id_array[] = $ch->child_id;
                }

                foreach ($child_id_result_current as $ch) 
                {
                    $child_id_array[] = $ch->child_id;
                }

                if (!in_array($child_id, $child_id_array))
                {
                    $row = array();
                    $row[] = $dec_tree->deworming;
                    $row[] = $dec_tree->deworming_s;
                    
                    $data[] = $row;
                }
                
                // for no. of absences ---------------------------------------------------------------------------

                $date_graduated = $this->graduated->get_by_child_id($child_id);

                // get anc last active date (last date that has atleast 1 child present)
                $last_active_date = $this->attendance->get_last_active_date();

                // first date the child is present
                $first_date_present = $this->attendance->get_first_date_present($child_id);

                // if not a single day present
                if ($first_date_present == null)
                {
                    $days_absent = 0;           
                }
                else
                {
                     // count of days where the child should be present (use either first_date_present, date_graduated or last_active_date) 
                    $active_days_count = $this->attendance->get_active_days_count($first_date_present, $date_graduated, $last_active_date);

                    // get days present then days absent by subtracting total child active days with days present
                    $days_present = $this->attendance->get_days_present($child_id);

                    $days_absent = $active_days_count - $days_present;
                }

                if ($days_absent != 0)
                {
                    $row = array();
                    $row[] = $dec_tree->absences . '. Number of absences: ' . $days_absent;
                    $row[] = $dec_tree->absences_s;
                    
                    $data[] = $row;

                }


                // for HVI checking ------------------------------------------------------------------------------
                $latest_hvi = $this->hvi->get_latest_child_hvi($child_id);

                if ($latest_hvi == null)
                {
                    $row = array();
                    $row[] = $dec_tree->hvi;
                    $row[] = $dec_tree->hvi_s;
                    
                    $data[] = $row;
                }


                // for HIS checking ------------------------------------------------------------------------------
                $child_his = $this->his->get_child_his($child_id);

                if ($child_his == null)
                {
                    $row = array();
                    $row[] = $dec_tree->his;
                    $row[] = $dec_tree->his_s;
                    
                    $data[] = $row;
                }


                // ===================================== HVI SUBDATA CHECKING ====================================
                
                if ($latest_hvi != null)
                {
                    if ($latest_hvi->appetite > 3) // check appetite
                    {
                        $row = array();
                        $row[] = $dec_tree->appetite;
                        $row[] = $dec_tree->appetite_s;
                        
                        $data[] = $row;    
                    }

                    if ($latest_hvi->water < 5) // check water
                    {
                        $row = array();
                        $row[] = $dec_tree->water;
                        $row[] = $dec_tree->water_s;
                        
                        $data[] = $row;    
                    }

                    if ($latest_hvi->bowel > 3) // check bowel movement
                    {
                        $row = array();
                        $row[] = $dec_tree->bowel;
                        $row[] = $dec_tree->bowel_s;
                        
                        $data[] = $row;    
                    }

                    // check hygiene
                    if ($latest_hvi->hair != 4 || $latest_hvi->finger != 3 || $latest_hvi->teeth != 3 
                        || $latest_hvi->skin != 3 || $latest_hvi->eyes != 3 || $latest_hvi->nose != 3 
                        || $latest_hvi->ears != 3) // check bowel movement
                    {
                        $row = array();
                        $row[] = $dec_tree->hygiene;
                        $row[] = $dec_tree->hygiene_s;
                        
                        $data[] = $row;
                    }

                    $illness = strtolower($latest_hvi->illness);

                    // check illness
                    if ($illness != '' && $illness != 'none' && $illness != 'n/a' && $illness != 'no' 
                        && $illness != 'not' && $illness != 'wala') // check bowel movement
                    {
                        $row = array();
                        $row[] = $dec_tree->illness;
                        $row[] = $dec_tree->illness_s;
                        
                        $data[] = $row;
                    }

                    $concerns = strtolower($latest_hvi->concerns);

                    // check concerns
                    if ($concerns != '' && $concerns != 'none' && $concerns != 'n/a' && $concerns != 'no' 
                        && $concerns != 'not' && $concerns != 'wala') // check bowel movement
                    {
                        $row = array();
                        $row[] = $dec_tree->concerns;
                        $row[] = $dec_tree->concerns_s;
                        
                        $data[] = $row;
                    }

                    
                }
                
                // ===================================== HIS SUBDATA CHECKING ====================================
                
                if ($child_his != null)
                {
                    if ($child_his->garbage != 1) // check garbage
                    {
                        $row = array();
                        $row[] = $dec_tree->garbage;
                        $row[] = $dec_tree->garbage_s;
                        
                        $data[] = $row;    
                    }

                    if ($child_his->bath > 2) // check bath
                    {
                        $row = array();
                        $row[] = $dec_tree->bath;
                        $row[] = $dec_tree->bath_s;
                        
                        $data[] = $row;    
                    }

                    if ($child_his->food < 2 || $child_his->food > 4) // check food
                    {
                        $row = array();
                        $row[] = $dec_tree->food;
                        $row[] = $dec_tree->food_s;
                        
                        $data[] = $row;    
                    }

                    if ($child_his->harassment == 2) // check harassment
                    {
                        $row = array();
                        $row[] = $dec_tree->harassment;
                        $row[] = $dec_tree->harassment_s;
                        
                        $data[] = $row;    
                    }

                    if ($child_his->smoking == 1) // check smoking
                    {
                        $row = array();
                        $row[] = $dec_tree->smoking;
                        $row[] = $dec_tree->smoking_s;
                        
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
 }