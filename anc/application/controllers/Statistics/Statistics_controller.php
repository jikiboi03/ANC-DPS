<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Statistics_controller extends CI_Controller {
 

  public function __construct()
  {
    parent::__construct();
    $this->load->model('cis/cis_model','cis');
    $this->load->model('his/his_model','his');
    $this->load->model('family/family_model','family');
    $this->load->model('barangays/barangays_model','barangays');
    $this->load->model('monthly/monthly_model','monthly');
    $this->load->model('graduated/graduated_model','graduated');
    $this->load->model('Hw_status/Hw_status_boys_model','boys');
    $this->load->model('Hw_status/Hw_status_girls_model','girls');
  }

  public function index()
  {						
    if($this->session->userdata('user_id') == '')
    {
      redirect('error500');
    }

    // get total children registered
    $children_count = $this->cis->count_all();

    // get gender count active and graduated
    $children_active_male = $this->cis->count_gender_active('male');
    $children_active_female = $this->cis->count_gender_active('female');

    $children_graduated_male = $this->cis->count_gender_graduated('male');
    $children_graduated_female = $this->cis->count_gender_graduated('female');



    // get today's date and yesterday
    // $today = date('Y-m-d');
    // $yesterday = date('Y-m-d',(strtotime ( '-1 day' , strtotime ( $today) ) ));

    // // get from cis model data
    // $registered_today = $this->cis->get_registered_today($today)['registered_count'];
    // $registered_yesterday = $this->cis->get_registered_today($yesterday)['registered_count'];

    // home visit / interviewed
    // $family_visited = $this->his->count_all();
    // $date_last_visit = $this->his->get_last_visit()->date_interviewed;

    // total family members
    // $family_members = $this->family->count_all_members();
    // $count_child_family = $this->family->count_child_family();


    // ========================= FOR AGE GRAPH CHART =================================================================


    $age_list = $this->cis->get_all_children_list();

    // initialize variables for age
    $m3_up = 0;
    $m4_up = 0;
    $m5_up = 0;
    $m6_up = 0;
    $m7_up = 0;
    $m8_up = 0;
    $m9_up = 0;

    $f3_up = 0;
    $f4_up = 0;
    $f5_up = 0;
    $f6_up = 0;
    $f7_up = 0;
    $f8_up = 0;
    $f9_up = 0;


    // height initialized values
    $sst = 0;
    $st = 0;
    $hn = 0;
    $t = 0;

    // weight initialized values
    $su = 0;
    $u = 0;
    $wn = 0;
    $o = 0;

    // initialize latest observation height and weight
    $latest_observation = array(); 

    // for each child (note: active or graduated included)
    foreach ($age_list as $cis) 
    {
        // age in mos
        $birthday = new DateTime($cis->dob);

        if ($cis->graduated == '1')
        {
            $date_graduated = $this->graduated->get_by_child_id($cis->child_id);
            $diff = $birthday->diff(new DateTime($date_graduated));    
        }
        else
        {
            $diff = $birthday->diff(new DateTime());
        }

        $months = $diff->format('%m') + 12 * $diff->format('%y');

        $sex = $cis->sex;

        if ($sex == 'Male') // male entries $m2_up...
        {
            if ($months < 48) // less than 4 years old (36mos up 47mos)
            {
                $m3_up++;
            }
            else if ($months < 60) // less than 5 years old (48mos up 59mos)
            {
                $m4_up++;
            }
            else if ($months < 72) // less than 6 years old (60mos up 71mos)
            {
                $m5_up++;
            }
            else if ($months < 84) // less than 7 years old (72mos up 83mos)
            {
                $m6_up++;
            }
            else if ($months < 96) // less than 8 years old (84mos up 95mos)
            {
                $m7_up++;
            }
            else if ($months < 108) // less than 9 years old (96mos up 107mos)
            {
                $m8_up++;
            }
            else // more than 9 years old (108mos onwards)
            {
                $m9_up++;
            }
        }
        else // female
        {
            if ($months < 48) // less than 4 years old (36mos up 47mos)
            {
                $f3_up++;
            }
            else if ($months < 60) // less than 5 years old (48mos up 59mos)
            {
                $f4_up++;
            }
            else if ($months < 72) // less than 6 years old (60mos up 71mos)
            {
                $f5_up++;
            }
            else if ($months < 84) // less than 7 years old (72mos up 83mos)
            {
                $f6_up++;
            }
            else if ($months < 96) // less than 8 years old (84mos up 95mos)
            {
                $f7_up++;
            }
            else if ($months < 108) // less than 9 years old (96mos up 107mos)
            {
                $f8_up++;
            }
            else // more than 9 years old (108mos onwards)
            {
                $f9_up++;
            }
        }




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


        $initial_height = $cis->height;
        $initial_weight = $cis->weight;

        $child_id = $cis->child_id;

        // for latest monthly checkup data values
        $latest_monthly = $this->monthly->get_by_child_id($child_id);



        // first check if male or female
        if ($sex == 'Male') // Male ---------------------------------------------------------
        {
            if ($latest_monthly == null) // if no latest monthly use initial heigh & weight values
            {
                // for age in mos. ------------------------------------------------------------------
                $birth_date = new DateTime($cis->dob);

                $date_registered = $cis->date_registered;
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
                    $sst++;
                }
                else if ($initial_height <= $boys_data->st)
                {   
                    $st++;
                }
                else if ($initial_height <= $boys_data->hn)
                {
                    $hn++;
                }
                else
                {
                    $t++;
                }

                // for Weight status
                if ($initial_weight <= $boys_data->su)
                {
                    $su++;
                }
                else if ($initial_weight <= $boys_data->u)
                {   
                    $u++;
                }
                else if ($initial_weight <= $boys_data->wn)
                {
                    $wn++;
                }
                else
                {
                    $o++;
                }


                // target statistics data -----------------------------------------------------------

                $latest_observation_height = $initial_height;
                $latest_observation_weight = $initial_weight;

            }
            else // if it has latest monthly checkup values (the latest_monthly array has values)
            {
                $latest_height = $latest_monthly['height']; 
                $latest_weight = $latest_monthly['weight'];

                // $latest_bmi = ($latest_weight / ($latest_height / 100)) / ($latest_height / 100);

                // get boys status data if male
                $boys_data = $this->boys->get_by_age_months($age_in_mos);

                // for Height status
                if ($latest_height <= $boys_data->sst)
                {
                    $sst++;
                }
                else if ($latest_height <= $boys_data->st)
                {   
                    $st++;
                }
                else if ($latest_height <= $boys_data->hn)
                {
                    $hn++;
                }
                else
                {
                    $t++;   
                }

                // for Weight status
                if ($latest_weight <= $boys_data->su)
                {
                    $su++;
                }
                else if ($latest_weight <= $boys_data->u)
                {   
                    $u++;
                }
                else if ($latest_weight <= $boys_data->wn)
                {
                    $wn++;
                }
                else
                {
                    $o++;  
                }

                // target statistics data -----------------------------------------------------------
                
                $latest_observation_height = $latest_height;
                $latest_observation_weight = $latest_weight;
            }
             
        }
        else // Female --------------------------------------------------------------------
        {
            
            if ($latest_monthly == null) // if no latest monthly (apply 'n/a to all values in latest')
            {
                // for age in mos. ------------------------------------------------------------------
                $birth_date = new DateTime($cis->dob);

                $date_registered = $cis->date_registered;
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
                    $sst++;
                }
                else if ($initial_height <= $girls_data->st)
                {   
                    $st++;
                }
                else if ($initial_height <= $girls_data->hn)
                {
                    $hn++;
                }
                else
                {
                    $t++;   
                }

                // for Weight status
                if ($initial_weight <= $girls_data->su)
                {
                    $su++;
                }
                else if ($initial_weight <= $girls_data->u)
                {   
                    $u++;
                }
                else if ($initial_weight <= $girls_data->wn)
                {
                    $wn++;
                }
                else
                {
                    $o++;  
                }

                // target statistics data -----------------------------------------------------------

                $latest_observation_height = $initial_height;
                $latest_observation_weight = $initial_weight;

            }
            else // if it has latest monthly checkup values (the latest_monthly array has values)
            {
                $latest_height = $latest_monthly['height']; 
                $latest_weight = $latest_monthly['weight'];

                // $latest_bmi = ($latest_weight / ($latest_height / 100)) / ($latest_height / 100);

                // get girls status data if female
                $girls_data = $this->girls->get_by_age_months($age_in_mos);

                // for Height status
                if ($latest_height <= $girls_data->sst)
                {
                    $sst++;
                }
                else if ($latest_height <= $girls_data->st)
                {   
                    $st++;
                }
                else if ($latest_height <= $girls_data->hn)
                {
                    $hn++;
                }
                else
                {
                    $t++;  
                }

                // for Weight status
                if ($latest_weight <= $girls_data->su)
                {
                    $su++;
                }
                else if ($latest_weight <= $girls_data->u)
                {   
                    $u++;
                }
                else if ($latest_weight <= $girls_data->wn)
                {
                    $wn++;
                }
                else
                {
                    $o++;
                }

                // target statistics data -----------------------------------------------------------
                
                $latest_observation_height = $latest_height;
                $latest_observation_weight = $latest_weight;
            }
        }
        $row = array();

        $row[] = $latest_observation_height;
        $row[] = $latest_observation_weight;

        $latest_observation[] = $row;
    } // end for each
        // ======================== HEIGHT / WEIGHT STATUS DATA =================================================

    // $data['latest_observation'] = $latest_observation;


    // latest height, weight, bmi
    $data['sst'] = $sst;
    $data['st'] = $st;
    $data['hn'] = $hn;
    $data['t'] = $t;

    $data['su'] = $su;
    $data['u'] = $u;
    $data['wn'] = $wn;
    $data['o'] = $o;


    // ========================= FOR MONTHLY REGISTRATIONS CHART ==================================================


    $current_year = date('Y');

    $jan = $this->cis->get_monthly_registrations('01', $current_year)['child_count'];
    $feb = $this->cis->get_monthly_registrations('02', $current_year)['child_count'];
    $mar = $this->cis->get_monthly_registrations('03', $current_year)['child_count'];
    $apr = $this->cis->get_monthly_registrations('04', $current_year)['child_count'];

    $may = $this->cis->get_monthly_registrations('05', $current_year)['child_count'];
    $jun = $this->cis->get_monthly_registrations('06', $current_year)['child_count'];
    $jul = $this->cis->get_monthly_registrations('07', $current_year)['child_count'];
    $aug = $this->cis->get_monthly_registrations('08', $current_year)['child_count'];

    $sep = $this->cis->get_monthly_registrations('09', $current_year)['child_count'];
    $oct = $this->cis->get_monthly_registrations('10', $current_year)['child_count'];
    $nov = $this->cis->get_monthly_registrations('11', $current_year)['child_count'];
    $dec = $this->cis->get_monthly_registrations('12', $current_year)['child_count'];

    $prev_year = $current_year - 1;

    $prev_jan = $this->cis->get_monthly_registrations('01', $prev_year)['child_count'];
    $prev_feb = $this->cis->get_monthly_registrations('02', $prev_year)['child_count'];
    $prev_mar = $this->cis->get_monthly_registrations('03', $prev_year)['child_count'];
    $prev_apr = $this->cis->get_monthly_registrations('04', $prev_year)['child_count'];

    $prev_may = $this->cis->get_monthly_registrations('05', $prev_year)['child_count'];
    $prev_jun = $this->cis->get_monthly_registrations('06', $prev_year)['child_count'];
    $prev_jul = $this->cis->get_monthly_registrations('07', $prev_year)['child_count'];
    $prev_aug = $this->cis->get_monthly_registrations('08', $prev_year)['child_count'];

    $prev_sep = $this->cis->get_monthly_registrations('09', $prev_year)['child_count'];
    $prev_oct = $this->cis->get_monthly_registrations('10', $prev_year)['child_count'];
    $prev_nov = $this->cis->get_monthly_registrations('11', $prev_year)['child_count'];
    $prev_dec = $this->cis->get_monthly_registrations('12', $prev_year)['child_count'];


    // // get borrow logs model data for borrow status
    // $borrowed_items = $this->borrow->get_borrow_status()['borrowed'] + 0;
    // $returned_items = $this->borrow->get_borrow_status()['returned'] + 0;
    // $lost_items = $this->borrow->get_borrow_status()['lost'] + 0;

    // insert to array data to be fetched by view
    $data['children_count'] = $children_count;

    $data['children_active_male'] = $children_active_male;
    $data['children_active_female'] = $children_active_female;

    $data['children_graduated_male'] = $children_graduated_male;
    $data['children_graduated_female'] = $children_graduated_female;


    $data['m3_up'] = $m3_up;
    $data['m4_up'] = $m4_up;
    $data['m5_up'] = $m5_up;
    $data['m6_up'] = $m6_up;
    $data['m7_up'] = $m7_up;
    $data['m8_up'] = $m8_up;
    $data['m9_up'] = $m9_up;

    $data['f3_up'] = $f3_up;
    $data['f4_up'] = $f4_up;
    $data['f5_up'] = $f5_up;
    $data['f6_up'] = $f6_up;
    $data['f7_up'] = $f7_up;
    $data['f8_up'] = $f8_up;
    $data['f9_up'] = $f9_up;


    $data['current_year'] = $current_year;
    
    $data['jan'] = $jan;
    $data['feb'] = $feb;
    $data['mar'] = $mar;
    $data['apr'] = $apr;

    $data['may'] = $may;
    $data['jun'] = $jun;
    $data['jul'] = $jul;
    $data['aug'] = $aug;

    $data['sep'] = $sep;
    $data['oct'] = $oct;
    $data['nov'] = $nov;
    $data['dec'] = $dec;

    $data['prev_year'] = $prev_year;
    
    $data['prev_jan'] = $prev_jan;
    $data['prev_feb'] = $prev_feb;
    $data['prev_mar'] = $prev_mar;
    $data['prev_apr'] = $prev_apr;

    $data['prev_may'] = $prev_may;
    $data['prev_jun'] = $prev_jun;
    $data['prev_jul'] = $prev_jul;
    $data['prev_aug'] = $prev_aug;

    $data['prev_sep'] = $prev_sep;
    $data['prev_oct'] = $prev_oct;
    $data['prev_nov'] = $prev_nov;
    $data['prev_dec'] = $prev_dec;
    

    // // get inventory status - below reorder point and in-stock
    // $data['reorder'] = $this->inventory->get_reorder_status()['reorder'] + 0;
    // $data['in_stock'] = $this->inventory->get_reorder_status()['in_stock'] + 0;

  	/** Note: ayaw ilisi ang sequence sa page load sa page **/
    $data['title'] = 'Statistics / Charts';	
    $this->load->view('template/dashboard_header',$data);
    $this->load->view('statistics/statistics_view',$data);
    $this->load->view('template/dashboard_navigation');
    $this->load->view('template/dashboard_footer');

  }


  public function get_latest_observation_male_low()
  {

        $age_list = $this->cis->get_all_children_list();

        // initialize latest observation height and weight
        $latest_observation = array(); 

        // for each child (note: active or graduated included)
        foreach ($age_list as $cis) 
        {
            $sex = $cis->sex;


            // first check if male or female
            if ($sex == 'Male') // Male ---------------------------------------------------------
            {

                // ========================= FOR HEIGHT STATUS CATEGORY CHART ==================================================

                $initial_height = $cis->height;
                $initial_weight = $cis->weight;

                $child_id = $cis->child_id;

                // for latest monthly checkup data values
                $latest_monthly = $this->monthly->get_by_child_id($child_id);


                if ($latest_monthly == null) // if no latest monthly use initial heigh & weight values
                {
                    // target statistics data -----------------------------------------------------------

                    $latest_observation_height = $initial_height;
                    $latest_observation_weight = $initial_weight;

                    // to get age in mos.
                    $birthday = new DateTime($cis->dob);

                    // current
                    $diff = $birthday->diff(new DateTime($cis->date_registered));
                    $months = $diff->format('%m') + 12 * $diff->format('%y');
                }
                else // if it has latest monthly checkup values (the latest_monthly array has values)
                {
                    $latest_height = $latest_monthly['height']; 
                    $latest_weight = $latest_monthly['weight'];

                    // target statistics data -----------------------------------------------------------
                    
                    $latest_observation_height = $latest_height;
                    $latest_observation_weight = $latest_weight;

                    // to get age in mos.
                    $birthday = new DateTime($cis->dob);

                    // current
                    $diff = $birthday->diff(new DateTime());
                    $months = $diff->format('%m') + 12 * $diff->format('%y');
                }

                if ($months <= 83)
                {
                    $row = array();

                    $row[] = (float)$latest_observation_height;
                    $row[] = (float)$latest_observation_weight;
                    $row[] = $cis->lastname . ', ' . $cis->firstname;

                    $latest_observation[] = $row;
                }
                 
            }
            
            
        } // end for each

        echo json_encode($latest_observation);
    }


  public function get_latest_observation_male_high()
  {

        $age_list = $this->cis->get_all_children_list();

        // initialize latest observation height and weight
        $latest_observation = array(); 

        // for each child (note: active or graduated included)
        foreach ($age_list as $cis) 
        {
            $sex = $cis->sex;


            // first check if male or female
            if ($sex == 'Male') // Male ---------------------------------------------------------
            {

                // ========================= FOR HEIGHT STATUS CATEGORY CHART ==================================================

                $initial_height = $cis->height;
                $initial_weight = $cis->weight;

                $child_id = $cis->child_id;

                // for latest monthly checkup data values
                $latest_monthly = $this->monthly->get_by_child_id($child_id);


                if ($latest_monthly == null) // if no latest monthly use initial heigh & weight values
                {
                    // target statistics data -----------------------------------------------------------

                    $latest_observation_height = $initial_height;
                    $latest_observation_weight = $initial_weight;

                    // to get age in mos.
                    $birthday = new DateTime($cis->dob);

                    // current
                    $diff = $birthday->diff(new DateTime($cis->date_registered));
                    $months = $diff->format('%m') + 12 * $diff->format('%y');
                }
                else // if it has latest monthly checkup values (the latest_monthly array has values)
                {
                    $latest_height = $latest_monthly['height']; 
                    $latest_weight = $latest_monthly['weight'];

                    // target statistics data -----------------------------------------------------------
                    
                    $latest_observation_height = $latest_height;
                    $latest_observation_weight = $latest_weight;

                    // to get age in mos.
                    $birthday = new DateTime($cis->dob);

                    // current
                    $diff = $birthday->diff(new DateTime());
                    $months = $diff->format('%m') + 12 * $diff->format('%y');
                }

                if ($months >= 84)
                {
                    $row = array();

                    $row[] = (float)$latest_observation_height;
                    $row[] = (float)$latest_observation_weight;
                    $row[] = $cis->lastname . ', ' . $cis->firstname;

                    $latest_observation[] = $row;
                }
                 
            }
            
            
        } // end for each

        echo json_encode($latest_observation);
    }

  public function get_latest_observation_female_low()
  {

        $age_list = $this->cis->get_all_children_list();

        // initialize latest observation height and weight
        $latest_observation_female = array(); 

        // for each child (note: active or graduated included)
        foreach ($age_list as $cis) 
        {
            $sex = $cis->sex;


            // first check if male or female
            if ($sex == 'Female') // Male ---------------------------------------------------------
            {

                // ========================= FOR HEIGHT STATUS CATEGORY CHART ==================================================

                $initial_height = $cis->height;
                $initial_weight = $cis->weight;

                $child_id = $cis->child_id;

                // for latest monthly checkup data values
                $latest_monthly = $this->monthly->get_by_child_id($child_id);
                

                if ($latest_monthly == null) // if no latest monthly use initial heigh & weight values
                {
                    // target statistics data -----------------------------------------------------------

                    $latest_observation_height = $initial_height;
                    $latest_observation_weight = $initial_weight;

                    // to get age in mos.
                    $birthday = new DateTime($cis->dob);

                    // current
                    $diff = $birthday->diff(new DateTime($cis->date_registered));
                    $months = $diff->format('%m') + 12 * $diff->format('%y');

                }
                else // if it has latest monthly checkup values (the latest_monthly array has values)
                {
                    $latest_height = $latest_monthly['height']; 
                    $latest_weight = $latest_monthly['weight'];

                    // target statistics data -----------------------------------------------------------
                    
                    $latest_observation_height = $latest_height;
                    $latest_observation_weight = $latest_weight;

                    // to get age in mos.
                    $birthday = new DateTime($cis->dob);

                    // current
                    $diff = $birthday->diff(new DateTime());
                    $months = $diff->format('%m') + 12 * $diff->format('%y');
                }

                if ($months <= 83)
                {
                    $row = array();

                    $row[] = (float)$latest_observation_height;
                    $row[] = (float)$latest_observation_weight;
                    $row[] = $cis->lastname . ', ' . $cis->firstname;

                    $latest_observation_female[] = $row;
                }
                 
            }
            
            
        } // end for each

        echo json_encode($latest_observation_female);
    }

    public function get_latest_observation_female_high()
    {

          $age_list = $this->cis->get_all_children_list();

          // initialize latest observation height and weight
          $latest_observation_female = array(); 

          // for each child (note: active or graduated included)
          foreach ($age_list as $cis) 
          {
              $sex = $cis->sex;


              // first check if male or female
              if ($sex == 'Female') // Male ---------------------------------------------------------
              {

                  // ========================= FOR HEIGHT STATUS CATEGORY CHART ==================================================

                  $initial_height = $cis->height;
                  $initial_weight = $cis->weight;

                  $child_id = $cis->child_id;

                  // for latest monthly checkup data values
                  $latest_monthly = $this->monthly->get_by_child_id($child_id);
                  

                  if ($latest_monthly == null) // if no latest monthly use initial heigh & weight values
                  {
                      // target statistics data -----------------------------------------------------------

                      $latest_observation_height = $initial_height;
                      $latest_observation_weight = $initial_weight;

                      // to get age in mos.
                      $birthday = new DateTime($cis->dob);

                      // current
                      $diff = $birthday->diff(new DateTime($cis->date_registered));
                      $months = $diff->format('%m') + 12 * $diff->format('%y');

                  }
                  else // if it has latest monthly checkup values (the latest_monthly array has values)
                  {
                      $latest_height = $latest_monthly['height']; 
                      $latest_weight = $latest_monthly['weight'];

                      // target statistics data -----------------------------------------------------------
                      
                      $latest_observation_height = $latest_height;
                      $latest_observation_weight = $latest_weight;

                      // to get age in mos.
                      $birthday = new DateTime($cis->dob);

                      // current
                      $diff = $birthday->diff(new DateTime());
                      $months = $diff->format('%m') + 12 * $diff->format('%y');
                  }

                  if ($months >= 84)
                  {
                      $row = array();

                      $row[] = (float)$latest_observation_height;
                      $row[] = (float)$latest_observation_weight;
                      $row[] = $cis->lastname . ', ' . $cis->firstname;

                      $latest_observation_female[] = $row;
                  }
                   
              }
              
              
          } // end for each

          echo json_encode($latest_observation_female);
      }

    // for individual height and weight chart
    public function get_latest_observation_male_all()
    {

        $age_list = $this->cis->get_all_children_list();

        // initialize latest observation height and weight
        $latest_observation_male_all = array(); 

        // for each child (note: active or graduated included)
        foreach ($age_list as $cis) 
        {
            $sex = $cis->sex;


            // first check if male or female
            if ($sex == 'Male') // Male ---------------------------------------------------------
            {

                // ========================= FOR HEIGHT STATUS CATEGORY CHART ==================================================

                $initial_height = $cis->height;
                $initial_weight = $cis->weight;

                $child_id = $cis->child_id;

                // for latest monthly checkup data values
                $latest_monthly = $this->monthly->get_by_child_id($child_id);
                

                if ($latest_monthly == null) // if no latest monthly use initial heigh & weight values
                {
                    // target statistics data -----------------------------------------------------------

                    $latest_observation_height = $initial_height;
                    $latest_observation_weight = $initial_weight;

                    // to get age in mos.
                    $birthday = new DateTime($cis->dob);

                    // current
                    $diff = $birthday->diff(new DateTime($cis->date_registered));
                    $months = $diff->format('%m') + 12 * $diff->format('%y');

                }
                else // if it has latest monthly checkup values (the latest_monthly array has values)
                {
                    $latest_height = $latest_monthly['height']; 
                    $latest_weight = $latest_monthly['weight'];

                    // target statistics data -----------------------------------------------------------
                    
                    $latest_observation_height = $latest_height;
                    $latest_observation_weight = $latest_weight;

                    // to get age in mos.
                    $birthday = new DateTime($cis->dob);

                    // current
                    $diff = $birthday->diff(new DateTime());
                    $months = $diff->format('%m') + 12 * $diff->format('%y');
                }

                // --------------------------- regression residual value ---------------------------------

                // get average normal height and weight ((stunted or underweight + normal) / 2) - average normal status benchmark

                // get minimum mos. normal height and weight
                $normal_height_min = (($this->boys->get_by_age_months(36)->st + $this->boys->get_by_age_months(36)->hn) / 2);
                $normal_weight_min = (($this->boys->get_by_age_months(36)->u + $this->boys->get_by_age_months(36)->wn) / 2);

                // get maximum mos. normal height and weight
                $normal_height_max = (($this->boys->get_by_age_months(108)->st + $this->boys->get_by_age_months(108)->hn) / 2);
                $normal_weight_max = (($this->boys->get_by_age_months(108)->u + $this->boys->get_by_age_months(108)->wn) / 2);

                // from the formula max weight = min weight + slope (max height - min height)
                $slope = ($normal_weight_max - $normal_weight_min) / ($normal_height_max - $normal_height_min);

                // get predicted weight by current height obtained by regression analysis
                $predicted_weight = $normal_weight_min + ($slope * ($latest_observation_height - $normal_height_min));

                // get residual weight (actual weight - predicted weight)
                $residual_weight = $latest_observation_weight - $predicted_weight;

                // --------------------------- regression residual value ---------------------------------


                $row = array();

                $row[] = (float)$latest_observation_height;
                $row[] = (float)$latest_observation_weight;
                $row[] = $cis->lastname . ', ' . $cis->firstname;
                // add to array residual weight value
                $row[] = number_format($residual_weight, 1, '.', '');
                $row[] = number_format($predicted_weight, 1, '.', '');

                $latest_observation_male_all[] = $row;
            }
            
            
        } // end for each

        echo json_encode($latest_observation_male_all);
    }

    // for individual height and weight chart
    public function get_latest_observation_male_all_age()
    {

        $age_list = $this->cis->get_all_children_list();

        // initialize latest observation height and weight
        $latest_observation_male_all = array(); 

        // for each child (note: active or graduated included)
        foreach ($age_list as $cis) 
        {
            $sex = $cis->sex;


            // first check if male or female
            if ($sex == 'Male') // Male ---------------------------------------------------------
            {

                // ========================= FOR HEIGHT STATUS CATEGORY CHART ==================================================

                // $initial_height = $cis->height;
                $initial_weight = $cis->weight;

                $child_id = $cis->child_id;

                // for latest monthly checkup data values
                $latest_monthly = $this->monthly->get_by_child_id($child_id);
                

                if ($latest_monthly == null) // if no latest monthly use initial heigh & weight values
                {
                    // to get age in mos.
                    $birthday = new DateTime($cis->dob);

                    // current
                    $diff = $birthday->diff(new DateTime($cis->date_registered));
                    $months = $diff->format('%m') + 12 * $diff->format('%y');

                    $latest_observation_age = $months;
                    $latest_observation_weight = $initial_weight;

                }
                else // if it has latest monthly checkup values (the latest_monthly array has values)
                {
                    // $latest_height = $latest_monthly['height']; 
                    $latest_weight = $latest_monthly['weight'];

                    // to get age in mos.
                    $birthday = new DateTime($cis->dob);

                    // current
                    $diff = $birthday->diff(new DateTime());
                    $months = $diff->format('%m') + 12 * $diff->format('%y');

                    $latest_observation_age = $months;
                    $latest_observation_weight = $initial_weight;
                }

                // --------------------------- regression residual value ---------------------------------

                // get average normal height and weight ((stunted or underweight + normal) / 2) - average normal status benchmark

                // get minimum mos. normal height and weight
                $normal_age_min = $this->boys->get_by_age_months(36)->age;
                $normal_weight_min = (($this->boys->get_by_age_months(36)->u + $this->boys->get_by_age_months(36)->wn) / 2);

                // get maximum mos. normal height and weight
                $normal_age_max = $this->boys->get_by_age_months(108)->age;
                $normal_weight_max = (($this->boys->get_by_age_months(108)->u + $this->boys->get_by_age_months(108)->wn) / 2);

                // from the formula max weight = min weight + slope (max height - min height)
                $slope = ($normal_weight_max - $normal_weight_min) / ($normal_age_max - $normal_age_min);

                // get predicted weight by current height obtained by regression analysis
                $predicted_weight = $normal_weight_min + ($slope * ($latest_observation_age - $normal_age_min));

                // get residual weight (actual weight - predicted weight)
                $residual_weight = $latest_observation_weight - $predicted_weight;

                // --------------------------- regression residual value ---------------------------------


                $row = array();

                $row[] = (float)$latest_observation_age;
                $row[] = (float)$latest_observation_weight;
                $row[] = $cis->lastname . ', ' . $cis->firstname;
                // add to array residual weight value
                $row[] = number_format($residual_weight, 1, '.', '');
                $row[] = number_format($predicted_weight, 1, '.', '');

                $latest_observation_male_all[] = $row;
            }
            
            
        } // end for each

        echo json_encode($latest_observation_male_all);
    }

    // for individual height and weight chart
    public function get_latest_observation_female_all()
    {

        $age_list = $this->cis->get_all_children_list();

        // initialize latest observation height and weight
        $latest_observation_female_all = array(); 

        // for each child (note: active or graduated included)
        foreach ($age_list as $cis) 
        {
            $sex = $cis->sex;


            // first check if male or female
            if ($sex == 'Female') // Male ---------------------------------------------------------
            {

                // ========================= FOR HEIGHT STATUS CATEGORY CHART ==================================================

                $initial_height = $cis->height;
                $initial_weight = $cis->weight;

                $child_id = $cis->child_id;

                // for latest monthly checkup data values
                $latest_monthly = $this->monthly->get_by_child_id($child_id);
                

                if ($latest_monthly == null) // if no latest monthly use initial heigh & weight values
                {
                    // target statistics data -----------------------------------------------------------

                    $latest_observation_height = $initial_height;
                    $latest_observation_weight = $initial_weight;

                    // to get age in mos.
                    $birthday = new DateTime($cis->dob);

                    // current
                    $diff = $birthday->diff(new DateTime($cis->date_registered));
                    $months = $diff->format('%m') + 12 * $diff->format('%y');

                }
                else // if it has latest monthly checkup values (the latest_monthly array has values)
                {
                    $latest_height = $latest_monthly['height']; 
                    $latest_weight = $latest_monthly['weight'];

                    // target statistics data -----------------------------------------------------------
                    
                    $latest_observation_height = $latest_height;
                    $latest_observation_weight = $latest_weight;

                    // to get age in mos.
                    $birthday = new DateTime($cis->dob);

                    // current
                    $diff = $birthday->diff(new DateTime());
                    $months = $diff->format('%m') + 12 * $diff->format('%y');
                }

                // --------------------------- regression residual value ---------------------------------

                // get average normal height and weight ((stunted or underweight + normal) / 2) - average normal status benchmark

                // get minimum mos. normal height and weight
                $normal_height_min = (($this->girls->get_by_age_months(36)->st + $this->girls->get_by_age_months(36)->hn) / 2);
                $normal_weight_min = (($this->girls->get_by_age_months(36)->u + $this->girls->get_by_age_months(36)->wn) / 2);

                // get maximum mos. normal height and weight
                $normal_height_max = (($this->girls->get_by_age_months(108)->st + $this->girls->get_by_age_months(108)->hn) / 2);
                $normal_weight_max = (($this->girls->get_by_age_months(108)->u + $this->girls->get_by_age_months(108)->wn) / 2);

                // from the formula max weight = min weight + slope (max height - min height)
                $slope = ($normal_weight_max - $normal_weight_min) / ($normal_height_max - $normal_height_min);

                // get predicted weight by current height obtained by regression analysis
                $predicted_weight = $normal_weight_min + ($slope * ($latest_observation_height - $normal_height_min));

                // get residual weight (actual weight - predicted weight)
                $residual_weight = $latest_observation_weight - $predicted_weight;

                // --------------------------- regression residual value ---------------------------------


                $row = array();

                $row[] = (float)$latest_observation_height;
                $row[] = (float)$latest_observation_weight;
                $row[] = $cis->lastname . ', ' . $cis->firstname;
                // add to array residual weight value
                $row[] = number_format($residual_weight, 1, '.', '');
                $row[] = number_format($predicted_weight, 1, '.', '');

                $latest_observation_female_all[] = $row;
            }
            
            
        } // end for each

        echo json_encode($latest_observation_female_all);
    }

    // for individual height and weight chart
    public function get_latest_observation_female_all_age()
    {

        $age_list = $this->cis->get_all_children_list();

        // initialize latest observation height and weight
        $latest_observation_female_all = array(); 

        // for each child (note: active or graduated included)
        foreach ($age_list as $cis) 
        {
            $sex = $cis->sex;


            // first check if male or female
            if ($sex == 'Female') // Female ---------------------------------------------------------
            {

                // ========================= FOR HEIGHT STATUS CATEGORY CHART ==================================================

                // $initial_height = $cis->height;
                $initial_weight = $cis->weight;

                $child_id = $cis->child_id;

                // for latest monthly checkup data values
                $latest_monthly = $this->monthly->get_by_child_id($child_id);
                

                if ($latest_monthly == null) // if no latest monthly use initial heigh & weight values
                {
                    // to get age in mos.
                    $birthday = new DateTime($cis->dob);

                    // current
                    $diff = $birthday->diff(new DateTime($cis->date_registered));
                    $months = $diff->format('%m') + 12 * $diff->format('%y');

                    $latest_observation_age = $months;
                    $latest_observation_weight = $initial_weight;

                }
                else // if it has latest monthly checkup values (the latest_monthly array has values)
                {
                    // $latest_height = $latest_monthly['height']; 
                    $latest_weight = $latest_monthly['weight'];

                    // to get age in mos.
                    $birthday = new DateTime($cis->dob);

                    // current
                    $diff = $birthday->diff(new DateTime());
                    $months = $diff->format('%m') + 12 * $diff->format('%y');

                    $latest_observation_age = $months;
                    $latest_observation_weight = $initial_weight;
                }

                // --------------------------- regression residual value ---------------------------------

                // get average normal height and weight ((stunted or underweight + normal) / 2) - average normal status benchmark

                // get minimum mos. normal height and weight
                $normal_age_min = $this->girls->get_by_age_months(36)->age;
                $normal_weight_min = (($this->girls->get_by_age_months(36)->u + $this->girls->get_by_age_months(36)->wn) / 2);

                // get maximum mos. normal height and weight
                $normal_age_max = $this->girls->get_by_age_months(108)->age;
                $normal_weight_max = (($this->girls->get_by_age_months(108)->u + $this->girls->get_by_age_months(108)->wn) / 2);

                // from the formula max weight = min weight + slope (max height - min height)
                $slope = ($normal_weight_max - $normal_weight_min) / ($normal_age_max - $normal_age_min);

                // get predicted weight by current height obtained by regression analysis
                $predicted_weight = $normal_weight_min + ($slope * ($latest_observation_age - $normal_age_min));

                // get residual weight (actual weight - predicted weight)
                $residual_weight = $latest_observation_weight - $predicted_weight;

                // --------------------------- regression residual value ---------------------------------


                $row = array();

                $row[] = (float)$latest_observation_age;
                $row[] = (float)$latest_observation_weight;
                $row[] = $cis->lastname . ', ' . $cis->firstname;
                // add to array residual weight value
                $row[] = number_format($residual_weight, 1, '.', '');
                $row[] = number_format($predicted_weight, 1, '.', '');

                $latest_observation_female_all[] = $row;
            }
            
            
        } // end for each

        echo json_encode($latest_observation_female_all);
    }

    public function get_target_observation_low($gender)
    {
        if ($gender == 'male')
        {
            $age_list = $this->boys->get_all_status_data();  
        }
        else
        {
            $age_list = $this->girls->get_all_status_data();     
        }

          // initialize latest observation height and weight
          $target_observation = array(); 

          // for each child (note: active or graduated included)
          foreach ($age_list as $cis) 
          {
              if ($cis->age <= 83) // up to 6yrs old (last month before 7yrs old)
              {
                $target_observation_height = ($cis->st);
                $target_observation_weight = ($cis->wn);

                
                $row = array();

                $row[] = (float)$target_observation_height;
                $row[] = (float)$target_observation_weight;

                $target_observation[] = $row;

                $target_observation_height = ($cis->hn);
                $target_observation_weight = ($cis->u);

                
                $row = array();

                $row[] = (float)$target_observation_height;
                $row[] = (float)$target_observation_weight;

                $target_observation[] = $row;


                $target_observation_height = ($cis->st);
                $target_observation_weight = ($cis->u);

                
                $row = array();

                $row[] = (float)$target_observation_height;
                $row[] = (float)$target_observation_weight;

                $target_observation[] = $row;

                $target_observation_height = ($cis->hn);
                $target_observation_weight = ($cis->wn);

                
                $row = array();
              }
          } // end for each

          echo json_encode($target_observation);
      }

      public function get_target_observation_high($gender)
      {
          if ($gender == 'male')
          {
              $age_list = $this->boys->get_all_status_data();  
          }
          else
          {
              $age_list = $this->girls->get_all_status_data();     
          }

            // initialize latest observation height and weight
            $target_observation = array(); 

            // for each child (note: active or graduated included)
            foreach ($age_list as $cis) 
            {
                if ($cis->age >= 84) // equal or more than 7yrs old
                {
                  $target_observation_height = ($cis->st);
                  $target_observation_weight = ($cis->wn);

                  
                  $row = array();

                  $row[] = (float)$target_observation_height;
                  $row[] = (float)$target_observation_weight;

                  $target_observation[] = $row;

                  $target_observation_height = ($cis->hn);
                  $target_observation_weight = ($cis->u);

                  
                  $row = array();

                  $row[] = (float)$target_observation_height;
                  $row[] = (float)$target_observation_weight;

                  $target_observation[] = $row;


                  $target_observation_height = ($cis->st);
                  $target_observation_weight = ($cis->u);

                  
                  $row = array();

                  $row[] = (float)$target_observation_height;
                  $row[] = (float)$target_observation_weight;

                  $target_observation[] = $row;

                  $target_observation_height = ($cis->hn);
                  $target_observation_weight = ($cis->wn);

                  
                  $row = array();
                }
            } // end for each

            echo json_encode($target_observation);
        }

        // function to get the regression line according to gender
        public function get_reg_line($gender)
        {
            // initialize regression line height and weight
            $reg_line = array();

            if ($gender == 'male')
            {
                $age_list = $this->boys->get_all_status_data();

                $child_count = 0;
                $total_height = 0;
                $total_weight = 0;

                $start_weight = 0;

                $sum_up = 0; // summation up (numerator)
                $sum_down = 0; // summation down (denomerator)

                // for each child (note: active or graduated included)
                foreach ($age_list as $cis) 
                {
                    // get average normal height and weight value from WHO
                    $latest_observation_height = ($cis->st + $cis->hn) / 2;
                    $latest_observation_weight = ($cis->u + $cis->wn) / 2;

                    $child_count++;

                    $total_height += $latest_observation_height;
                    $total_weight += $latest_observation_weight;
                }

                $average_height = $total_height / $child_count;
                $average_weight = $total_weight / $child_count;

                // for each child (note: active or graduated included)
                foreach ($age_list as $cis) 
                {
                    // get average normal height and weight value from WHO
                    $latest_observation_height = ($cis->st + $cis->hn) / 2;
                    $latest_observation_weight = ($cis->u + $cis->wn) / 2;

                    // getting the summation up or the numerator then add to continue summation
                    $sum_up += (($latest_observation_height - $average_height) * ($latest_observation_weight - $average_weight));

                    // getting the summation up or the denomerator then add to continue summation
                    $sum_down += pow(($latest_observation_height - $average_height), 2);
                }

                // getting the slope (based on regression line formula) E(Xi - x)(Yi - y)/E(Xi - x)2 (Legend: y & x - average, Xi - xAxis, Yi - yAxis, E - summation or Sigma, 2 - square or power)
                $slope = ($sum_up / $sum_down);

                // getting the start weight (based on initial x formula) Bo = y - B1x (Legend: y & x - average, Bo - yStart or initial, B1 - slope)
                $start_weight = ($average_weight - ($slope * $average_height));
                

                // set starting pont height and end point height of the regression line (height set as 80 cm min, 150 cm max)
                $set_min_height = 80;
                $set_max_height = 150;


                // getting the predicted weight (based on the regression model formula) Yi = Bo + B1Xi (Legend: Bo - yStart or initial, B1 - slope, Xi - xAxis, Yi - yAxis)
                $set_min_weight = $start_weight + ($slope * $set_min_height);
                $set_max_weight = $start_weight + ($slope * $set_max_height);
            }
            else // if female
            {
                $age_list = $this->girls->get_all_status_data();

                $child_count = 0;
                $total_height = 0;
                $total_weight = 0;

                $start_weight = 0;

                $sum_up = 0; // summation up (numerator)
                $sum_down = 0; // summation down (denomerator)

                // for each child (note: active or graduated included)
                foreach ($age_list as $cis) 
                {
                    // get average normal height and weight value from WHO
                    $latest_observation_height = ($cis->st + $cis->hn) / 2;
                    $latest_observation_weight = ($cis->u + $cis->wn) / 2;

                    $child_count++;

                    $total_height += $latest_observation_height;
                    $total_weight += $latest_observation_weight;
                }

                $average_height = $total_height / $child_count;
                $average_weight = $total_weight / $child_count;

                // for each child (note: active or graduated included)
                foreach ($age_list as $cis) 
                {
                    // get average normal height and weight value from WHO
                    $latest_observation_height = ($cis->st + $cis->hn) / 2;
                    $latest_observation_weight = ($cis->u + $cis->wn) / 2;
                    
                    // getting the summation up or the numerator then add to continue summation
                    $sum_up += (($latest_observation_height - $average_height) * ($latest_observation_weight - $average_weight));

                    // getting the summation up or the denomerator then add to continue summation
                    $sum_down += pow(($latest_observation_height - $average_height), 2);
                }

                // getting the slope (based on regression line formula) E(Xi - x)(Yi - y)/E(Xi - x)2 (Legend: y & x - average, Xi - xAxis, Yi - yAxis, E - summation or Sigma, 2 - square or power)
                $slope = ($sum_up / $sum_down);

                // getting the start weight (based on initial x formula) Bo = y - B1x (Legend: y & x - average, Bo - yStart or initial, B1 - slope)
                $start_weight = ($average_weight - ($slope * $average_height));
                

                // set starting pont height and end point height of the regression line (height set as 80 cm min, 150 cm max)
                $set_min_height = 80;
                $set_max_height = 150;


                // getting the predicted weight (based on the regression model formula) Yi = Bo + B1Xi (Legend: Bo - yStart or initial, B1 - slope, Xi - xAxis, Yi - yAxis)
                $set_min_weight = $start_weight + ($slope * $set_min_height);
                $set_max_weight = $start_weight + ($slope * $set_max_height);
            }

            $row = array();

            $row[] = $set_min_height;
            $row[] = $set_min_weight;

            $reg_line[] = $row;

            $row = array();

            $row[] = $set_max_height;
            $row[] = $set_max_weight;

            $reg_line[] = $row;

            echo json_encode($reg_line);
        }

        // function to get the regression line according to gender
        public function get_reg_line_age($gender)
        {
            // initialize regression line height and weight
            $reg_line = array();

            if ($gender == 'male')
            {
                $age_list = $this->boys->get_all_status_data();

                $child_count = 0;

                $total_age = 0;
                $total_weight = 0;

                $start_weight = 0;

                $sum_up = 0; // summation up (numerator)
                $sum_down = 0; // summation down (denomerator)

                // for each child (note: active or graduated included)
                foreach ($age_list as $cis) 
                {
                    // get average normal height and weight value from WHO
                    $latest_observation_age = $cis->age;
                    $latest_observation_weight = ($cis->u + $cis->wn) / 2;

                    $child_count++;

                    $total_age += $latest_observation_age;
                    $total_weight += $latest_observation_weight;
                }

                $average_age = $total_age / $child_count;
                $average_weight = $total_weight / $child_count;

                // for each child (note: active or graduated included)
                foreach ($age_list as $cis) 
                {
                    // get average normal height and weight value from WHO
                    $latest_observation_age = $cis->age;
                    $latest_observation_weight = ($cis->u + $cis->wn) / 2;

                    // getting the summation up or the numerator then add to continue summation
                    $sum_up += (($latest_observation_age - $average_age) * ($latest_observation_weight - $average_weight));

                    // getting the summation up or the denomerator then add to continue summation
                    $sum_down += pow(($latest_observation_age - $average_age), 2);
                }

                // getting the slope (based on regression line formula) E(Xi - x)(Yi - y)/E(Xi - x)2 (Legend: y & x - average, Xi - xAxis, Yi - yAxis, E - summation or Sigma, 2 - square or power)
                $slope = ($sum_up / $sum_down);

                // getting the start weight (based on initial x formula) Bo = y - B1x (Legend: y & x - average, Bo - yStart or initial, B1 - slope)
                $start_weight = ($average_weight - ($slope * $average_age));
                

                // set starting pont height and end point height of the regression line (height set as 80 cm min, 150 cm max)
                $set_min_age = 30;
                $set_max_age = 160;


                // getting the predicted weight (based on the regression model formula) Yi = Bo + B1Xi (Legend: Bo - yStart or initial, B1 - slope, Xi - xAxis, Yi - yAxis)
                $set_min_weight = $start_weight + ($slope * $set_min_age);
                $set_max_weight = $start_weight + ($slope * $set_max_age);
            }
            else // if female
            {
                $age_list = $this->girls->get_all_status_data();

                $child_count = 0;

                $total_age = 0;
                $total_weight = 0;

                $start_weight = 0;

                $sum_up = 0; // summation up (numerator)
                $sum_down = 0; // summation down (denomerator)

                // for each child (note: active or graduated included)
                foreach ($age_list as $cis) 
                {
                    // get average normal height and weight value from WHO
                    $latest_observation_age = $cis->age;
                    $latest_observation_weight = ($cis->u + $cis->wn) / 2;

                    $child_count++;

                    $total_age += $latest_observation_age;
                    $total_weight += $latest_observation_weight;
                }

                $average_age = $total_age / $child_count;
                $average_weight = $total_weight / $child_count;

                // for each child (note: active or graduated included)
                foreach ($age_list as $cis) 
                {
                    // get average normal height and weight value from WHO
                    $latest_observation_age = $cis->age;
                    $latest_observation_weight = ($cis->u + $cis->wn) / 2;

                    // getting the summation up or the numerator then add to continue summation
                    $sum_up += (($latest_observation_age - $average_age) * ($latest_observation_weight - $average_weight));

                    // getting the summation up or the denomerator then add to continue summation
                    $sum_down += pow(($latest_observation_age - $average_age), 2);
                }

                // getting the slope (based on regression line formula) E(Xi - x)(Yi - y)/E(Xi - x)2 (Legend: y & x - average, Xi - xAxis, Yi - yAxis, E - summation or Sigma, 2 - square or power)
                $slope = ($sum_up / $sum_down);

                // getting the start weight (based on initial x formula) Bo = y - B1x (Legend: y & x - average, Bo - yStart or initial, B1 - slope)
                $start_weight = ($average_weight - ($slope * $average_age));
                

                // set starting pont height and end point height of the regression line (height set as 80 cm min, 150 cm max)
                $set_min_age = 30;
                $set_max_age = 160;


                // getting the predicted weight (based on the regression model formula) Yi = Bo + B1Xi (Legend: Bo - yStart or initial, B1 - slope, Xi - xAxis, Yi - yAxis)
                $set_min_weight = $start_weight + ($slope * $set_min_age);
                $set_max_weight = $start_weight + ($slope * $set_max_age);
            }

            $row = array();

            $row[] = $set_min_age;
            $row[] = $set_min_weight;

            $reg_line[] = $row;

            $row = array();

            $row[] = $set_max_age;
            $row[] = $set_max_weight;

            $reg_line[] = $row;

            echo json_encode($reg_line);
        }

        // function to get the ACTUAL regression line according to gender
        public function get_actual_reg_line_male()
        {
            // initialize regression line height and weight
            $reg_line = array();

            $age_list = $this->cis->get_all_children_list();

            $child_count = 0;
            $total_height = 0;
            $total_weight = 0;

            $start_weight = 0;

            $sum_up = 0; // summation up (numerator)
            $sum_down = 0; // summation down (denomerator)

            // for each child (note: active or graduated included)
            foreach ($age_list as $cis) 
            {
                $sex = $cis->sex;

                // first check if male or female
                if ($sex == 'Male') // Male ---------------------------------------------------------
                {
                    // ========================= FOR HEIGHT STATUS CATEGORY CHART ==================================================

                    $initial_height = $cis->height;
                    $initial_weight = $cis->weight;

                    $child_id = $cis->child_id;

                    // for latest monthly checkup data values
                    $latest_monthly = $this->monthly->get_by_child_id($child_id);
                    

                    if ($latest_monthly == null) // if no latest monthly use initial heigh & weight values
                    {
                        // target statistics data -----------------------------------------------------------

                        $latest_observation_height = $initial_height;
                        $latest_observation_weight = $initial_weight;

                        // to get age in mos.
                        $birthday = new DateTime($cis->dob);

                        // current
                        $diff = $birthday->diff(new DateTime($cis->date_registered));
                        $months = $diff->format('%m') + 12 * $diff->format('%y');

                    }
                    else // if it has latest monthly checkup values (the latest_monthly array has values)
                    {
                        $latest_height = $latest_monthly['height']; 
                        $latest_weight = $latest_monthly['weight'];

                        // target statistics data -----------------------------------------------------------
                        
                        $latest_observation_height = $latest_height;
                        $latest_observation_weight = $latest_weight;

                        // to get age in mos.
                        $birthday = new DateTime($cis->dob);

                        // current
                        $diff = $birthday->diff(new DateTime());
                        $months = $diff->format('%m') + 12 * $diff->format('%y');
                    }

                    $child_count++;

                    $total_height += $latest_observation_height;
                    $total_weight += $latest_observation_weight;
                }
            }

            $average_height = $total_height / $child_count;
            $average_weight = $total_weight / $child_count;

            // for each child (note: active or graduated included)
            foreach ($age_list as $cis) 
            {
                $sex = $cis->sex;

                // first check if male or female
                if ($sex == 'Male') // Male ---------------------------------------------------------
                {
                    // ========================= FOR HEIGHT STATUS CATEGORY CHART ==================================================

                    $initial_height = $cis->height;
                    $initial_weight = $cis->weight;

                    $child_id = $cis->child_id;

                    // for latest monthly checkup data values
                    $latest_monthly = $this->monthly->get_by_child_id($child_id);
                    

                    if ($latest_monthly == null) // if no latest monthly use initial heigh & weight values
                    {
                        // target statistics data -----------------------------------------------------------

                        $latest_observation_height = $initial_height;
                        $latest_observation_weight = $initial_weight;

                        // to get age in mos.
                        $birthday = new DateTime($cis->dob);

                        // current
                        $diff = $birthday->diff(new DateTime($cis->date_registered));
                        $months = $diff->format('%m') + 12 * $diff->format('%y');

                    }
                    else // if it has latest monthly checkup values (the latest_monthly array has values)
                    {
                        $latest_height = $latest_monthly['height']; 
                        $latest_weight = $latest_monthly['weight'];

                        // target statistics data -----------------------------------------------------------
                        
                        $latest_observation_height = $latest_height;
                        $latest_observation_weight = $latest_weight;

                        // to get age in mos.
                        $birthday = new DateTime($cis->dob);

                        // current
                        $diff = $birthday->diff(new DateTime());
                        $months = $diff->format('%m') + 12 * $diff->format('%y');
                    }

                    // getting the summation up or the numerator then add to continue summation
                    $sum_up += (($latest_observation_height - $average_height) * ($latest_observation_weight - $average_weight));

                    // getting the summation up or the denomerator then add to continue summation
                    $sum_down += pow(($latest_observation_height - $average_height), 2);
                }
            }

            // getting the slope (based on regression line formula) E(Xi - x)(Yi - y)/E(Xi - x)2 (Legend: y & x - average, Xi - xAxis, Yi - yAxis, E - summation or Sigma, 2 - square or power)
            $slope = ($sum_up / $sum_down);

            // getting the start weight (based on initial x formula) Bo = y - B1x (Legend: y & x - average, Bo - yStart or initial, B1 - slope)
            $start_weight = ($average_weight - ($slope * $average_height));
            

            // set starting pont height and end point height of the regression line (height set as 80 cm min, 150 cm max)
            $set_min_height = 80;
            $set_max_height = 150;


            // getting the predicted weight (based on the regression model formula) Yi = Bo + B1Xi (Legend: Bo - yStart or initial, B1 - slope, Xi - xAxis, Yi - yAxis)
            $set_min_weight = $start_weight + ($slope * $set_min_height);
            $set_max_weight = $start_weight + ($slope * $set_max_height);

            $row = array();

            $row[] = $set_min_height;
            $row[] = $set_min_weight;

            $reg_line[] = $row;

            $row = array();

            $row[] = $set_max_height;
            $row[] = $set_max_weight;

            $reg_line[] = $row;

            echo json_encode($reg_line);
        }

        // function to get the ACTUAL regression line according to gender
        public function get_actual_reg_line_female()
        {
            // initialize regression line height and weight
            $reg_line = array();

            $age_list = $this->cis->get_all_children_list();

            $child_count = 0;
            $total_height = 0;
            $total_weight = 0;

            $start_weight = 0;

            $sum_up = 0; // summation up (numerator)
            $sum_down = 0; // summation down (denomerator)

            // for each child (note: active or graduated included)
            foreach ($age_list as $cis) 
            {
                $sex = $cis->sex;

                // first check if male or female
                if ($sex == 'Female') // Female ---------------------------------------------------------
                {
                    // ========================= FOR HEIGHT STATUS CATEGORY CHART ==================================================

                    $initial_height = $cis->height;
                    $initial_weight = $cis->weight;

                    $child_id = $cis->child_id;

                    // for latest monthly checkup data values
                    $latest_monthly = $this->monthly->get_by_child_id($child_id);
                    

                    if ($latest_monthly == null) // if no latest monthly use initial heigh & weight values
                    {
                        // target statistics data -----------------------------------------------------------

                        $latest_observation_height = $initial_height;
                        $latest_observation_weight = $initial_weight;

                        // to get age in mos.
                        $birthday = new DateTime($cis->dob);

                        // current
                        $diff = $birthday->diff(new DateTime($cis->date_registered));
                        $months = $diff->format('%m') + 12 * $diff->format('%y');

                    }
                    else // if it has latest monthly checkup values (the latest_monthly array has values)
                    {
                        $latest_height = $latest_monthly['height']; 
                        $latest_weight = $latest_monthly['weight'];

                        // target statistics data -----------------------------------------------------------
                        
                        $latest_observation_height = $latest_height;
                        $latest_observation_weight = $latest_weight;

                        // to get age in mos.
                        $birthday = new DateTime($cis->dob);

                        // current
                        $diff = $birthday->diff(new DateTime());
                        $months = $diff->format('%m') + 12 * $diff->format('%y');
                    }

                    $child_count++;

                    $total_height += $latest_observation_height;
                    $total_weight += $latest_observation_weight;
                }
            }

            $average_height = $total_height / $child_count;
            $average_weight = $total_weight / $child_count;

            // for each child (note: active or graduated included)
            foreach ($age_list as $cis) 
            {
                $sex = $cis->sex;

                // first check if male or female
                if ($sex == 'Female') // Male ---------------------------------------------------------
                {
                    // ========================= FOR HEIGHT STATUS CATEGORY CHART ==================================================

                    $initial_height = $cis->height;
                    $initial_weight = $cis->weight;

                    $child_id = $cis->child_id;

                    // for latest monthly checkup data values
                    $latest_monthly = $this->monthly->get_by_child_id($child_id);
                    

                    if ($latest_monthly == null) // if no latest monthly use initial heigh & weight values
                    {
                        // target statistics data -----------------------------------------------------------

                        $latest_observation_height = $initial_height;
                        $latest_observation_weight = $initial_weight;

                        // to get age in mos.
                        $birthday = new DateTime($cis->dob);

                        // current
                        $diff = $birthday->diff(new DateTime($cis->date_registered));
                        $months = $diff->format('%m') + 12 * $diff->format('%y');

                    }
                    else // if it has latest monthly checkup values (the latest_monthly array has values)
                    {
                        $latest_height = $latest_monthly['height']; 
                        $latest_weight = $latest_monthly['weight'];

                        // target statistics data -----------------------------------------------------------
                        
                        $latest_observation_height = $latest_height;
                        $latest_observation_weight = $latest_weight;

                        // to get age in mos.
                        $birthday = new DateTime($cis->dob);

                        // current
                        $diff = $birthday->diff(new DateTime());
                        $months = $diff->format('%m') + 12 * $diff->format('%y');
                    }

                    // getting the summation up or the numerator then add to continue summation
                    $sum_up += (($latest_observation_height - $average_height) * ($latest_observation_weight - $average_weight));

                    // getting the summation up or the denomerator then add to continue summation
                    $sum_down += pow(($latest_observation_height - $average_height), 2);
                }
            }

            // getting the slope (based on regression line formula) E(Xi - x)(Yi - y)/E(Xi - x)2 (Legend: y & x - average, Xi - xAxis, Yi - yAxis, E - summation or Sigma, 2 - square or power)
            $slope = ($sum_up / $sum_down);

            // getting the start weight (based on initial x formula) Bo = y - B1x (Legend: y & x - average, Bo - yStart or initial, B1 - slope)
            $start_weight = ($average_weight - ($slope * $average_height));
            

            // set starting pont height and end point height of the regression line (height set as 80 cm min, 150 cm max)
            $set_min_height = 80;
            $set_max_height = 150;


            // getting the predicted weight (based on the regression model formula) Yi = Bo + B1Xi (Legend: Bo - yStart or initial, B1 - slope, Xi - xAxis, Yi - yAxis)
            $set_min_weight = $start_weight + ($slope * $set_min_height);
            $set_max_weight = $start_weight + ($slope * $set_max_height);

            $row = array();

            $row[] = $set_min_height;
            $row[] = $set_min_weight;

            $reg_line[] = $row;

            $row = array();

            $row[] = $set_max_height;
            $row[] = $set_max_weight;

            $reg_line[] = $row;

            echo json_encode($reg_line);
        }

        // function to get the ACTUAL regression line according to gender
        public function get_actual_reg_line_male_age()
        {
            // initialize regression line height and weight
            $reg_line = array();

            $age_list = $this->cis->get_all_children_list();

            $child_count = 0;
            $total_age = 0;
            $total_weight = 0;

            $start_weight = 0;

            $sum_up = 0; // summation up (numerator)
            $sum_down = 0; // summation down (denomerator)

            // for each child (note: active or graduated included)
            foreach ($age_list as $cis) 
            {
                $sex = $cis->sex;

                // first check if male or female
                if ($sex == 'Male') // Male ---------------------------------------------------------
                {
                    // ========================= FOR HEIGHT STATUS CATEGORY CHART ==================================================

                    // $initial_height = $cis->height;
                    $initial_weight = $cis->weight;

                    $child_id = $cis->child_id;

                    // for latest monthly checkup data values
                    $latest_monthly = $this->monthly->get_by_child_id($child_id);
                    

                    if ($latest_monthly == null) // if no latest monthly use initial heigh & weight values
                    {
                        // to get age in mos.
                        $birthday = new DateTime($cis->dob);

                        // current
                        $diff = $birthday->diff(new DateTime($cis->date_registered));
                        $months = $diff->format('%m') + 12 * $diff->format('%y');

                        $latest_observation_age = $months;
                        $latest_observation_weight = $initial_weight;
                    }
                    else // if it has latest monthly checkup values (the latest_monthly array has values)
                    {
                        // $latest_height = $latest_monthly['height']; 
                        $latest_weight = $latest_monthly['weight'];

                        // to get age in mos.
                        $birthday = new DateTime($cis->dob);

                        // current
                        $diff = $birthday->diff(new DateTime());
                        $months = $diff->format('%m') + 12 * $diff->format('%y');

                        $latest_observation_age = $months;
                        $latest_observation_weight = $latest_weight;
                    }

                    $child_count++;

                    $total_age += $latest_observation_age;
                    $total_weight += $latest_observation_weight;
                }
            }

            $average_age = $total_age / $child_count;
            $average_weight = $total_weight / $child_count;

            // for each child (note: active or graduated included)
            foreach ($age_list as $cis) 
            {
                $sex = $cis->sex;

                // first check if male or female
                if ($sex == 'Male') // Male ---------------------------------------------------------
                {
                    // ========================= FOR HEIGHT STATUS CATEGORY CHART ==================================================

                    // $initial_height = $cis->height;
                    $initial_weight = $cis->weight;

                    $child_id = $cis->child_id;

                    // for latest monthly checkup data values
                    $latest_monthly = $this->monthly->get_by_child_id($child_id);
                    

                    if ($latest_monthly == null) // if no latest monthly use initial heigh & weight values
                    {
                        // to get age in mos.
                        $birthday = new DateTime($cis->dob);

                        // current
                        $diff = $birthday->diff(new DateTime($cis->date_registered));
                        $months = $diff->format('%m') + 12 * $diff->format('%y');

                        $latest_observation_age = $months;
                        $latest_observation_weight = $initial_weight;
                    }
                    else // if it has latest monthly checkup values (the latest_monthly array has values)
                    {
                        // $latest_height = $latest_monthly['height']; 
                        $latest_weight = $latest_monthly['weight'];

                        // to get age in mos.
                        $birthday = new DateTime($cis->dob);

                        // current
                        $diff = $birthday->diff(new DateTime());
                        $months = $diff->format('%m') + 12 * $diff->format('%y');

                        $latest_observation_age = $months;
                        $latest_observation_weight = $latest_weight;
                    }

                    // getting the summation up or the numerator then add to continue summation
                    $sum_up += (($latest_observation_age - $average_age) * ($latest_observation_weight - $average_weight));

                    // getting the summation up or the denomerator then add to continue summation
                    $sum_down += pow(($latest_observation_age - $average_age), 2);
                }
            }

            // getting the slope (based on regression line formula) E(Xi - x)(Yi - y)/E(Xi - x)2 (Legend: y & x - average, Xi - xAxis, Yi - yAxis, E - summation or Sigma, 2 - square or power)
            $slope = ($sum_up / $sum_down);

            // getting the start weight (based on initial x formula) Bo = y - B1x (Legend: y & x - average, Bo - yStart or initial, B1 - slope)
            $start_weight = ($average_weight - ($slope * $average_age));
            

            // set starting pont height and end point height of the regression line (height set as 80 cm min, 150 cm max)
            $set_min_age = 30;
            $set_max_age = 160;


            // getting the predicted weight (based on the regression model formula) Yi = Bo + B1Xi (Legend: Bo - yStart or initial, B1 - slope, Xi - xAxis, Yi - yAxis)
            $set_min_weight = $start_weight + ($slope * $set_min_age);
            $set_max_weight = $start_weight + ($slope * $set_max_age);

            $row = array();

            $row[] = $set_min_age;
            $row[] = $set_min_weight;

            $reg_line[] = $row;

            $row = array();

            $row[] = $set_max_age;
            $row[] = $set_max_weight;

            $reg_line[] = $row;

            echo json_encode($reg_line);
        }

        // function to get the ACTUAL regression line according to gender
        public function get_actual_reg_line_female_age()
        {
            // initialize regression line height and weight
            $reg_line = array();

            $age_list = $this->cis->get_all_children_list();

            $child_count = 0;
            $total_age = 0;
            $total_weight = 0;

            $start_weight = 0;

            $sum_up = 0; // summation up (numerator)
            $sum_down = 0; // summation down (denomerator)

            // for each child (note: active or graduated included)
            foreach ($age_list as $cis) 
            {
                $sex = $cis->sex;

                // first check if male or female
                if ($sex == 'Female') // Female ---------------------------------------------------------
                {
                    // ========================= FOR HEIGHT STATUS CATEGORY CHART ==================================================

                    // $initial_height = $cis->height;
                    $initial_weight = $cis->weight;

                    $child_id = $cis->child_id;

                    // for latest monthly checkup data values
                    $latest_monthly = $this->monthly->get_by_child_id($child_id);
                    

                    if ($latest_monthly == null) // if no latest monthly use initial heigh & weight values
                    {
                        // to get age in mos.
                        $birthday = new DateTime($cis->dob);

                        // current
                        $diff = $birthday->diff(new DateTime($cis->date_registered));
                        $months = $diff->format('%m') + 12 * $diff->format('%y');

                        $latest_observation_age = $months;
                        $latest_observation_weight = $initial_weight;
                    }
                    else // if it has latest monthly checkup values (the latest_monthly array has values)
                    {
                        // $latest_height = $latest_monthly['height']; 
                        $latest_weight = $latest_monthly['weight'];

                        // to get age in mos.
                        $birthday = new DateTime($cis->dob);

                        // current
                        $diff = $birthday->diff(new DateTime());
                        $months = $diff->format('%m') + 12 * $diff->format('%y');

                        $latest_observation_age = $months;
                        $latest_observation_weight = $latest_weight;
                    }

                    $child_count++;

                    $total_age += $latest_observation_age;
                    $total_weight += $latest_observation_weight;
                }
            }

            $average_age = $total_age / $child_count;
            $average_weight = $total_weight / $child_count;

            // for each child (note: active or graduated included)
            foreach ($age_list as $cis) 
            {
                $sex = $cis->sex;

                // first check if male or female
                if ($sex == 'Female') // Female ---------------------------------------------------------
                {
                    // ========================= FOR HEIGHT STATUS CATEGORY CHART ==================================================

                    // $initial_height = $cis->height;
                    $initial_weight = $cis->weight;

                    $child_id = $cis->child_id;

                    // for latest monthly checkup data values
                    $latest_monthly = $this->monthly->get_by_child_id($child_id);
                    

                    if ($latest_monthly == null) // if no latest monthly use initial heigh & weight values
                    {
                        // to get age in mos.
                        $birthday = new DateTime($cis->dob);

                        // current
                        $diff = $birthday->diff(new DateTime($cis->date_registered));
                        $months = $diff->format('%m') + 12 * $diff->format('%y');

                        $latest_observation_age = $months;
                        $latest_observation_weight = $initial_weight;
                    }
                    else // if it has latest monthly checkup values (the latest_monthly array has values)
                    {
                        // $latest_height = $latest_monthly['height']; 
                        $latest_weight = $latest_monthly['weight'];

                        // to get age in mos.
                        $birthday = new DateTime($cis->dob);

                        // current
                        $diff = $birthday->diff(new DateTime());
                        $months = $diff->format('%m') + 12 * $diff->format('%y');

                        $latest_observation_age = $months;
                        $latest_observation_weight = $latest_weight;
                    }

                    // getting the summation up or the numerator then add to continue summation
                    $sum_up += (($latest_observation_age - $average_age) * ($latest_observation_weight - $average_weight));

                    // getting the summation up or the denomerator then add to continue summation
                    $sum_down += pow(($latest_observation_age - $average_age), 2);
                }
            }

            // getting the slope (based on regression line formula) E(Xi - x)(Yi - y)/E(Xi - x)2 (Legend: y & x - average, Xi - xAxis, Yi - yAxis, E - summation or Sigma, 2 - square or power)
            $slope = ($sum_up / $sum_down);

            // getting the start weight (based on initial x formula) Bo = y - B1x (Legend: y & x - average, Bo - yStart or initial, B1 - slope)
            $start_weight = ($average_weight - ($slope * $average_age));
            

            // set starting pont height and end point height of the regression line (height set as 80 cm min, 150 cm max)
            $set_min_age = 30;
            $set_max_age = 160;


            // getting the predicted weight (based on the regression model formula) Yi = Bo + B1Xi (Legend: Bo - yStart or initial, B1 - slope, Xi - xAxis, Yi - yAxis)
            $set_min_weight = $start_weight + ($slope * $set_min_age);
            $set_max_weight = $start_weight + ($slope * $set_max_age);

            $row = array();

            $row[] = $set_min_age;
            $row[] = $set_min_weight;

            $reg_line[] = $row;

            $row = array();

            $row[] = $set_max_age;
            $row[] = $set_max_weight;

            $reg_line[] = $row;

            echo json_encode($reg_line);
        }

        // for individual height and weight chart
        public function get_latest_observation_male_all_reg()
        {

            $age_list = $this->cis->get_all_children_list();

            // initialize latest observation height and weight
            $latest_observation_male_all = array();

            // for each child (note: active or graduated included)
            foreach ($age_list as $cis) 
            {
                $sex = $cis->sex;


                // first check if male or female
                if ($sex == 'Male') // Male ---------------------------------------------------------
                {

                    // ========================= FOR HEIGHT STATUS CATEGORY CHART ==================================================

                    $initial_height = $cis->height;
                    $initial_weight = $cis->weight;

                    $child_id = $cis->child_id;

                    // for latest monthly checkup data values
                    $latest_monthly = $this->monthly->get_by_child_id($child_id);
                    

                    if ($latest_monthly == null) // if no latest monthly use initial heigh & weight values
                    {
                        // target statistics data -----------------------------------------------------------

                        $latest_observation_height = $initial_height;
                        $latest_observation_weight = $initial_weight;

                        // to get age in mos.
                        $birthday = new DateTime($cis->dob);

                        // current
                        $diff = $birthday->diff(new DateTime($cis->date_registered));
                        $months = $diff->format('%m') + 12 * $diff->format('%y');

                    }
                    else // if it has latest monthly checkup values (the latest_monthly array has values)
                    {
                        $latest_height = $latest_monthly['height']; 
                        $latest_weight = $latest_monthly['weight'];

                        // target statistics data -----------------------------------------------------------
                        
                        $latest_observation_height = $latest_height;
                        $latest_observation_weight = $latest_weight;

                        // to get age in mos.
                        $birthday = new DateTime($cis->dob);

                        // current
                        $diff = $birthday->diff(new DateTime());
                        $months = $diff->format('%m') + 12 * $diff->format('%y');
                    }

                    // --------------------------- regression residual value ---------------------------------


                    // get predicted weight by current height obtained by regression analysis
                    $predicted_weight = $this->get_predicted_weight_male($latest_observation_height);

                    // get residual weight (actual weight - predicted weight)
                    $residual_weight = $latest_observation_weight - $predicted_weight;

                    // --------------------------- regression residual value ---------------------------------


                    $row = array();

                    $row[] = (float)$latest_observation_height;
                    $row[] = (float)$latest_observation_weight;
                    $row[] = $cis->lastname . ', ' . $cis->firstname;
                    // add to array residual weight value
                    $row[] = number_format($residual_weight, 1, '.', '');
                    $row[] = number_format($predicted_weight, 1, '.', '');

                    $latest_observation_male_all[] = $row;
                }
                
                
            } // end for each

            echo json_encode($latest_observation_male_all);
        }

        // for individual height and weight chart
        public function get_latest_observation_female_all_reg()
        {

            $age_list = $this->cis->get_all_children_list();

            // initialize latest observation height and weight
            $latest_observation_female_all = array(); 

            // for each child (note: active or graduated included)
            foreach ($age_list as $cis) 
            {
                $sex = $cis->sex;


                // first check if male or female
                if ($sex == 'Female') // Male ---------------------------------------------------------
                {

                    // ========================= FOR HEIGHT STATUS CATEGORY CHART ==================================================

                    $initial_height = $cis->height;
                    $initial_weight = $cis->weight;

                    $child_id = $cis->child_id;

                    // for latest monthly checkup data values
                    $latest_monthly = $this->monthly->get_by_child_id($child_id);
                    

                    if ($latest_monthly == null) // if no latest monthly use initial heigh & weight values
                    {
                        // target statistics data -----------------------------------------------------------

                        $latest_observation_height = $initial_height;
                        $latest_observation_weight = $initial_weight;

                        // to get age in mos.
                        $birthday = new DateTime($cis->dob);

                        // current
                        $diff = $birthday->diff(new DateTime($cis->date_registered));
                        $months = $diff->format('%m') + 12 * $diff->format('%y');

                    }
                    else // if it has latest monthly checkup values (the latest_monthly array has values)
                    {
                        $latest_height = $latest_monthly['height']; 
                        $latest_weight = $latest_monthly['weight'];

                        // target statistics data -----------------------------------------------------------
                        
                        $latest_observation_height = $latest_height;
                        $latest_observation_weight = $latest_weight;

                        // to get age in mos.
                        $birthday = new DateTime($cis->dob);

                        // current
                        $diff = $birthday->diff(new DateTime());
                        $months = $diff->format('%m') + 12 * $diff->format('%y');
                    }

                    // --------------------------- regression residual value ---------------------------------

                    // get predicted weight by current height obtained by regression analysis
                    $predicted_weight = $this->get_predicted_weight_female($latest_observation_height);

                    // get residual weight (actual weight - predicted weight)
                    $residual_weight = $latest_observation_weight - $predicted_weight;

                    // --------------------------- regression residual value ---------------------------------


                    $row = array();

                    $row[] = (float)$latest_observation_height;
                    $row[] = (float)$latest_observation_weight;
                    $row[] = $cis->lastname . ', ' . $cis->firstname;
                    // add to array residual weight value
                    $row[] = number_format($residual_weight, 1, '.', '');
                    $row[] = number_format($predicted_weight, 1, '.', '');

                    $latest_observation_female_all[] = $row;
                }
                
                
            } // end for each

            echo json_encode($latest_observation_female_all);
        }

        // for individual age and weight chart
        public function get_latest_observation_male_all_reg_age()
        {

            $age_list = $this->cis->get_all_children_list();

            // initialize latest observation height and weight
            $latest_observation_male_all = array();

            // for each child (note: active or graduated included)
            foreach ($age_list as $cis) 
            {
                $sex = $cis->sex;


                // first check if male or female
                if ($sex == 'Male') // Male ---------------------------------------------------------
                {

                    // $initial_height = $cis->height;
                    $initial_weight = $cis->weight;

                    $child_id = $cis->child_id;

                    // for latest monthly checkup data values
                    $latest_monthly = $this->monthly->get_by_child_id($child_id);
                    

                    if ($latest_monthly == null) // if no latest monthly use initial heigh & weight values
                    {
                        // to get age in mos.
                        $birthday = new DateTime($cis->dob);

                        // current
                        $diff = $birthday->diff(new DateTime($cis->date_registered));
                        $months = $diff->format('%m') + 12 * $diff->format('%y');

                        $latest_observation_age = $months;
                        $latest_observation_weight = $initial_weight;
                    }
                    else // if it has latest monthly checkup values (the latest_monthly array has values)
                    {
                        // $latest_height = $latest_monthly['height']; 
                        $latest_weight = $latest_monthly['weight'];

                        // to get age in mos.
                        $birthday = new DateTime($cis->dob);

                        // current
                        $diff = $birthday->diff(new DateTime());
                        $months = $diff->format('%m') + 12 * $diff->format('%y');

                        $latest_observation_age = $months;
                        $latest_observation_weight = $latest_weight;
                    }

                    // --------------------------- regression residual value ---------------------------------


                    // get predicted weight by current height obtained by regression analysis
                    $predicted_weight = $this->get_predicted_weight_male_age($latest_observation_age);

                    // get residual weight (actual weight - predicted weight)
                    $residual_weight = $latest_observation_weight - $predicted_weight;

                    // --------------------------- regression residual value ---------------------------------


                    $row = array();

                    $row[] = (float)$latest_observation_age;
                    $row[] = (float)$latest_observation_weight;
                    $row[] = $cis->lastname . ', ' . $cis->firstname;
                    // add to array residual weight value
                    $row[] = number_format($residual_weight, 1, '.', '');
                    $row[] = number_format($predicted_weight, 1, '.', '');

                    $latest_observation_male_all[] = $row;
                }
                
                
            } // end for each

            echo json_encode($latest_observation_male_all);
        }

        // for individual age and weight chart
        public function get_latest_observation_female_all_reg_age()
        {

            $age_list = $this->cis->get_all_children_list();

            // initialize latest observation height and weight
            $latest_observation_female_all = array();

            // for each child (note: active or graduated included)
            foreach ($age_list as $cis) 
            {
                $sex = $cis->sex;


                // first check if male or female
                if ($sex == 'Female') // Female ---------------------------------------------------------
                {

                    // $initial_height = $cis->height;
                    $initial_weight = $cis->weight;

                    $child_id = $cis->child_id;

                    // for latest monthly checkup data values
                    $latest_monthly = $this->monthly->get_by_child_id($child_id);
                    

                    if ($latest_monthly == null) // if no latest monthly use initial heigh & weight values
                    {
                        // to get age in mos.
                        $birthday = new DateTime($cis->dob);

                        // current
                        $diff = $birthday->diff(new DateTime($cis->date_registered));
                        $months = $diff->format('%m') + 12 * $diff->format('%y');

                        $latest_observation_age = $months;
                        $latest_observation_weight = $initial_weight;
                    }
                    else // if it has latest monthly checkup values (the latest_monthly array has values)
                    {
                        // $latest_height = $latest_monthly['height']; 
                        $latest_weight = $latest_monthly['weight'];

                        // to get age in mos.
                        $birthday = new DateTime($cis->dob);

                        // current
                        $diff = $birthday->diff(new DateTime());
                        $months = $diff->format('%m') + 12 * $diff->format('%y');

                        $latest_observation_age = $months;
                        $latest_observation_weight = $latest_weight;
                    }

                    // --------------------------- regression residual value ---------------------------------


                    // get predicted weight by current height obtained by regression analysis
                    $predicted_weight = $this->get_predicted_weight_female_age($latest_observation_age);

                    // get residual weight (actual weight - predicted weight)
                    $residual_weight = $latest_observation_weight - $predicted_weight;

                    // --------------------------- regression residual value ---------------------------------


                    $row = array();

                    $row[] = (float)$latest_observation_age;
                    $row[] = (float)$latest_observation_weight;
                    $row[] = $cis->lastname . ', ' . $cis->firstname;
                    // add to array residual weight value
                    $row[] = number_format($residual_weight, 1, '.', '');
                    $row[] = number_format($predicted_weight, 1, '.', '');

                    $latest_observation_female_all[] = $row;
                }
                
                
            } // end for each

            echo json_encode($latest_observation_female_all);
        }

        // function to get the ACTUAL regression line according to gender
        public function get_predicted_weight_female($height)
        {
            $age_list = $this->cis->get_all_children_list();

            $child_count = 0;
            $total_height = 0;
            $total_weight = 0;

            $start_weight = 0;

            $sum_up = 0; // summation up (numerator)
            $sum_down = 0; // summation down (denomerator)

            // for each child (note: active or graduated included)
            foreach ($age_list as $cis) 
            {
                $sex = $cis->sex;

                // first check if male or female
                if ($sex == 'Female') // Female ---------------------------------------------------------
                {
                    // ========================= FOR HEIGHT STATUS CATEGORY CHART ==================================================

                    $initial_height = $cis->height;
                    $initial_weight = $cis->weight;

                    $child_id = $cis->child_id;

                    // for latest monthly checkup data values
                    $latest_monthly = $this->monthly->get_by_child_id($child_id);
                    

                    if ($latest_monthly == null) // if no latest monthly use initial heigh & weight values
                    {
                        // target statistics data -----------------------------------------------------------

                        $latest_observation_height = $initial_height;
                        $latest_observation_weight = $initial_weight;

                        // to get age in mos.
                        $birthday = new DateTime($cis->dob);

                        // current
                        $diff = $birthday->diff(new DateTime($cis->date_registered));
                        $months = $diff->format('%m') + 12 * $diff->format('%y');

                    }
                    else // if it has latest monthly checkup values (the latest_monthly array has values)
                    {
                        $latest_height = $latest_monthly['height']; 
                        $latest_weight = $latest_monthly['weight'];

                        // target statistics data -----------------------------------------------------------
                        
                        $latest_observation_height = $latest_height;
                        $latest_observation_weight = $latest_weight;

                        // to get age in mos.
                        $birthday = new DateTime($cis->dob);

                        // current
                        $diff = $birthday->diff(new DateTime());
                        $months = $diff->format('%m') + 12 * $diff->format('%y');
                    }

                    $child_count++;

                    $total_height += $latest_observation_height;
                    $total_weight += $latest_observation_weight;
                }
            }

            $average_height = $total_height / $child_count;
            $average_weight = $total_weight / $child_count;

            // for each child (note: active or graduated included)
            foreach ($age_list as $cis) 
            {
                $sex = $cis->sex;

                // first check if male or female
                if ($sex == 'Female') // Female ---------------------------------------------------------
                {
                    // ========================= FOR HEIGHT STATUS CATEGORY CHART ==================================================

                    $initial_height = $cis->height;
                    $initial_weight = $cis->weight;

                    $child_id = $cis->child_id;

                    // for latest monthly checkup data values
                    $latest_monthly = $this->monthly->get_by_child_id($child_id);
                    

                    if ($latest_monthly == null) // if no latest monthly use initial heigh & weight values
                    {
                        // target statistics data -----------------------------------------------------------

                        $latest_observation_height = $initial_height;
                        $latest_observation_weight = $initial_weight;

                        // to get age in mos.
                        $birthday = new DateTime($cis->dob);

                        // current
                        $diff = $birthday->diff(new DateTime($cis->date_registered));
                        $months = $diff->format('%m') + 12 * $diff->format('%y');

                    }
                    else // if it has latest monthly checkup values (the latest_monthly array has values)
                    {
                        $latest_height = $latest_monthly['height']; 
                        $latest_weight = $latest_monthly['weight'];

                        // target statistics data -----------------------------------------------------------
                        
                        $latest_observation_height = $latest_height;
                        $latest_observation_weight = $latest_weight;

                        // to get age in mos.
                        $birthday = new DateTime($cis->dob);

                        // current
                        $diff = $birthday->diff(new DateTime());
                        $months = $diff->format('%m') + 12 * $diff->format('%y');
                    }

                    // getting the summation up or the numerator then add to continue summation
                    $sum_up += (($latest_observation_height - $average_height) * ($latest_observation_weight - $average_weight));

                    // getting the summation up or the denomerator then add to continue summation
                    $sum_down += pow(($latest_observation_height - $average_height), 2);
                }
            }

            // getting the slope (based on regression line formula) E(Xi - x)(Yi - y)/E(Xi - x)2 (Legend: y & x - average, Xi - xAxis, Yi - yAxis, E - summation or Sigma, 2 - square or power)
            $slope = ($sum_up / $sum_down);

            // getting the start weight (based on initial x formula) Bo = y - B1x (Legend: y & x - average, Bo - yStart or initial, B1 - slope)
            $start_weight = ($average_weight - ($slope * $average_height));

            // getting the predicted weight (based on the regression model formula) Yi = Bo + B1Xi (Legend: Bo - yStart or initial, B1 - slope, Xi - xAxis, Yi - yAxis)

            // set starting pont height and end point weight of the regression line
            $predicted_weight = $start_weight + ($slope * $height);

            return $predicted_weight;
        }

        // function to get the ACTUAL regression line according to gender
        public function get_predicted_weight_male($height)
        {
            $age_list = $this->cis->get_all_children_list();

            $child_count = 0;
            $total_height = 0;
            $total_weight = 0;

            $start_weight = 0;

            $sum_up = 0; // summation up (numerator)
            $sum_down = 0; // summation down (denomerator)

            // for each child (note: active or graduated included)
            foreach ($age_list as $cis) 
            {
                $sex = $cis->sex;

                // first check if male or female
                if ($sex == 'Male') // Male ---------------------------------------------------------
                {
                    // ========================= FOR HEIGHT STATUS CATEGORY CHART ==================================================

                    $initial_height = $cis->height;
                    $initial_weight = $cis->weight;

                    $child_id = $cis->child_id;

                    // for latest monthly checkup data values
                    $latest_monthly = $this->monthly->get_by_child_id($child_id);
                    

                    if ($latest_monthly == null) // if no latest monthly use initial heigh & weight values
                    {
                        // target statistics data -----------------------------------------------------------

                        $latest_observation_height = $initial_height;
                        $latest_observation_weight = $initial_weight;

                        // to get age in mos.
                        $birthday = new DateTime($cis->dob);

                        // current
                        $diff = $birthday->diff(new DateTime($cis->date_registered));
                        $months = $diff->format('%m') + 12 * $diff->format('%y');

                    }
                    else // if it has latest monthly checkup values (the latest_monthly array has values)
                    {
                        $latest_height = $latest_monthly['height']; 
                        $latest_weight = $latest_monthly['weight'];

                        // target statistics data -----------------------------------------------------------
                        
                        $latest_observation_height = $latest_height;
                        $latest_observation_weight = $latest_weight;

                        // to get age in mos.
                        $birthday = new DateTime($cis->dob);

                        // current
                        $diff = $birthday->diff(new DateTime());
                        $months = $diff->format('%m') + 12 * $diff->format('%y');
                    }

                    $child_count++;

                    $total_height += $latest_observation_height;
                    $total_weight += $latest_observation_weight;
                }
            }

            $average_height = $total_height / $child_count;
            $average_weight = $total_weight / $child_count;

            // for each child (note: active or graduated included)
            foreach ($age_list as $cis) 
            {
                $sex = $cis->sex;

                // first check if male or female
                if ($sex == 'Male') // Male ---------------------------------------------------------
                {
                    // ========================= FOR HEIGHT STATUS CATEGORY CHART ==================================================

                    $initial_height = $cis->height;
                    $initial_weight = $cis->weight;

                    $child_id = $cis->child_id;

                    // for latest monthly checkup data values
                    $latest_monthly = $this->monthly->get_by_child_id($child_id);
                    

                    if ($latest_monthly == null) // if no latest monthly use initial heigh & weight values
                    {
                        // target statistics data -----------------------------------------------------------

                        $latest_observation_height = $initial_height;
                        $latest_observation_weight = $initial_weight;

                        // to get age in mos.
                        $birthday = new DateTime($cis->dob);

                        // current
                        $diff = $birthday->diff(new DateTime($cis->date_registered));
                        $months = $diff->format('%m') + 12 * $diff->format('%y');

                    }
                    else // if it has latest monthly checkup values (the latest_monthly array has values)
                    {
                        $latest_height = $latest_monthly['height']; 
                        $latest_weight = $latest_monthly['weight'];

                        // target statistics data -----------------------------------------------------------
                        
                        $latest_observation_height = $latest_height;
                        $latest_observation_weight = $latest_weight;

                        // to get age in mos.
                        $birthday = new DateTime($cis->dob);

                        // current
                        $diff = $birthday->diff(new DateTime());
                        $months = $diff->format('%m') + 12 * $diff->format('%y');
                    }

                    // getting the summation up or the numerator then add to continue summation
                    $sum_up += (($latest_observation_height - $average_height) * ($latest_observation_weight - $average_weight));

                    // getting the summation up or the denomerator then add to continue summation
                    $sum_down += pow(($latest_observation_height - $average_height), 2);
                }
            }

            // getting the slope (based on regression line formula) E(Xi - x)(Yi - y)/E(Xi - x)2 (Legend: y & x - average, Xi - xAxis, Yi - yAxis, E - summation or Sigma, 2 - square or power)
            $slope = ($sum_up / $sum_down);

            // getting the start weight (based on initial x formula) Bo = y - B1x (Legend: y & x - average, Bo - yStart or initial, B1 - slope)
            $start_weight = ($average_weight - ($slope * $average_height));

            // getting the predicted weight (based on the regression model formula) Yi = Bo + B1Xi (Legend: Bo - yStart or initial, B1 - slope, Xi - xAxis, Yi - yAxis)
            $predicted_weight = $start_weight + ($slope * $height);

            return $predicted_weight;
        }

        // function to get the ACTUAL regression line according to gender
        public function get_predicted_weight_male_age($age)
        {
            $age_list = $this->cis->get_all_children_list();

            $child_count = 0;
            $total_age = 0;
            $total_weight = 0;

            $start_weight = 0;

            $sum_up = 0; // summation up (numerator)
            $sum_down = 0; // summation down (denomerator)

            // for each child (note: active or graduated included)
            foreach ($age_list as $cis) 
            {
                $sex = $cis->sex;

                // first check if male or female
                if ($sex == 'Male') // Male ---------------------------------------------------------
                {
                    // ========================= FOR HEIGHT STATUS CATEGORY CHART ==================================================

                    // $initial_height = $cis->height;
                    $initial_weight = $cis->weight;

                    $child_id = $cis->child_id;

                    // for latest monthly checkup data values
                    $latest_monthly = $this->monthly->get_by_child_id($child_id);
                    

                    if ($latest_monthly == null) // if no latest monthly use initial heigh & weight values
                    {
                        // to get age in mos.
                        $birthday = new DateTime($cis->dob);

                        // current
                        $diff = $birthday->diff(new DateTime($cis->date_registered));
                        $months = $diff->format('%m') + 12 * $diff->format('%y');

                        $latest_observation_age = $months;
                        $latest_observation_weight = $initial_weight;
                    }
                    else // if it has latest monthly checkup values (the latest_monthly array has values)
                    {
                        // $latest_height = $latest_monthly['height']; 
                        $latest_weight = $latest_monthly['weight'];

                        // to get age in mos.
                        $birthday = new DateTime($cis->dob);

                        // current
                        $diff = $birthday->diff(new DateTime());
                        $months = $diff->format('%m') + 12 * $diff->format('%y');

                        $latest_observation_age = $months;
                        $latest_observation_weight = $latest_weight;
                    }

                    $child_count++;

                    $total_age += $latest_observation_age;
                    $total_weight += $latest_observation_weight;
                }
            }

            $average_age = $total_age / $child_count;
            $average_weight = $total_weight / $child_count;

            // for each child (note: active or graduated included)
            foreach ($age_list as $cis) 
            {
                $sex = $cis->sex;

                // first check if male or female
                if ($sex == 'Male') // Male ---------------------------------------------------------
                {
                    // ========================= FOR HEIGHT STATUS CATEGORY CHART ==================================================

                    // $initial_height = $cis->height;
                    $initial_weight = $cis->weight;

                    $child_id = $cis->child_id;

                    // for latest monthly checkup data values
                    $latest_monthly = $this->monthly->get_by_child_id($child_id);
                    

                    if ($latest_monthly == null) // if no latest monthly use initial heigh & weight values
                    {
                        // to get age in mos.
                        $birthday = new DateTime($cis->dob);

                        // current
                        $diff = $birthday->diff(new DateTime($cis->date_registered));
                        $months = $diff->format('%m') + 12 * $diff->format('%y');

                        $latest_observation_age = $months;
                        $latest_observation_weight = $initial_weight;
                    }
                    else // if it has latest monthly checkup values (the latest_monthly array has values)
                    {
                        // $latest_height = $latest_monthly['height']; 
                        $latest_weight = $latest_monthly['weight'];

                        // to get age in mos.
                        $birthday = new DateTime($cis->dob);

                        // current
                        $diff = $birthday->diff(new DateTime());
                        $months = $diff->format('%m') + 12 * $diff->format('%y');

                        $latest_observation_age = $months;
                        $latest_observation_weight = $latest_weight;
                    }

                    // getting the summation up or the numerator then add to continue summation
                    $sum_up += (($latest_observation_age - $average_age) * ($latest_observation_weight - $average_weight));

                    // getting the summation up or the denomerator then add to continue summation
                    $sum_down += pow(($latest_observation_age - $average_age), 2);
                }
            }

            // getting the slope (based on regression line formula) E(Xi - x)(Yi - y)/E(Xi - x)2 (Legend: y & x - average, Xi - xAxis, Yi - yAxis, E - summation or Sigma, 2 - square or power)
            $slope = ($sum_up / $sum_down);

            // getting the start weight (based on initial x formula) Bo = y - B1x (Legend: y & x - average, Bo - yStart or initial, B1 - slope)
            $start_weight = ($average_weight - ($slope * $average_age));

            // getting the predicted weight (based on the regression model formula) Yi = Bo + B1Xi (Legend: Bo - yStart or initial, B1 - slope, Xi - xAxis, Yi - yAxis)
            $predicted_weight = $start_weight + ($slope * $age);

            return $predicted_weight;
        }

        // function to get the ACTUAL regression line according to gender
        public function get_predicted_weight_female_age($age)
        {
            $age_list = $this->cis->get_all_children_list();

            $child_count = 0;
            $total_age = 0;
            $total_weight = 0;

            $start_weight = 0;

            $sum_up = 0; // summation up (numerator)
            $sum_down = 0; // summation down (denomerator)

            // for each child (note: active or graduated included)
            foreach ($age_list as $cis) 
            {
                $sex = $cis->sex;

                // first check if male or female
                if ($sex == 'Female') // Female ---------------------------------------------------------
                {
                    // ========================= FOR HEIGHT STATUS CATEGORY CHART ==================================================

                    // $initial_height = $cis->height;
                    $initial_weight = $cis->weight;

                    $child_id = $cis->child_id;

                    // for latest monthly checkup data values
                    $latest_monthly = $this->monthly->get_by_child_id($child_id);
                    

                    if ($latest_monthly == null) // if no latest monthly use initial heigh & weight values
                    {
                        // to get age in mos.
                        $birthday = new DateTime($cis->dob);

                        // current
                        $diff = $birthday->diff(new DateTime($cis->date_registered));
                        $months = $diff->format('%m') + 12 * $diff->format('%y');

                        $latest_observation_age = $months;
                        $latest_observation_weight = $initial_weight;
                    }
                    else // if it has latest monthly checkup values (the latest_monthly array has values)
                    {
                        // $latest_height = $latest_monthly['height']; 
                        $latest_weight = $latest_monthly['weight'];

                        // to get age in mos.
                        $birthday = new DateTime($cis->dob);

                        // current
                        $diff = $birthday->diff(new DateTime());
                        $months = $diff->format('%m') + 12 * $diff->format('%y');

                        $latest_observation_age = $months;
                        $latest_observation_weight = $latest_weight;
                    }

                    $child_count++;

                    $total_age += $latest_observation_age;
                    $total_weight += $latest_observation_weight;
                }
            }

            $average_age = $total_age / $child_count;
            $average_weight = $total_weight / $child_count;

            // for each child (note: active or graduated included)
            foreach ($age_list as $cis) 
            {
                $sex = $cis->sex;

                // first check if male or female
                if ($sex == 'Female') // Female ---------------------------------------------------------
                {
                    // ========================= FOR HEIGHT STATUS CATEGORY CHART ==================================================

                    // $initial_height = $cis->height;
                    $initial_weight = $cis->weight;

                    $child_id = $cis->child_id;

                    // for latest monthly checkup data values
                    $latest_monthly = $this->monthly->get_by_child_id($child_id);
                    

                    if ($latest_monthly == null) // if no latest monthly use initial heigh & weight values
                    {
                        // to get age in mos.
                        $birthday = new DateTime($cis->dob);

                        // current
                        $diff = $birthday->diff(new DateTime($cis->date_registered));
                        $months = $diff->format('%m') + 12 * $diff->format('%y');

                        $latest_observation_age = $months;
                        $latest_observation_weight = $initial_weight;
                    }
                    else // if it has latest monthly checkup values (the latest_monthly array has values)
                    {
                        // $latest_height = $latest_monthly['height']; 
                        $latest_weight = $latest_monthly['weight'];

                        // to get age in mos.
                        $birthday = new DateTime($cis->dob);

                        // current
                        $diff = $birthday->diff(new DateTime());
                        $months = $diff->format('%m') + 12 * $diff->format('%y');

                        $latest_observation_age = $months;
                        $latest_observation_weight = $latest_weight;
                    }

                    // getting the summation up or the numerator then add to continue summation
                    $sum_up += (($latest_observation_age - $average_age) * ($latest_observation_weight - $average_weight));

                    // getting the summation up or the denomerator then add to continue summation
                    $sum_down += pow(($latest_observation_age - $average_age), 2);
                }
            }

            // getting the slope (based on regression line formula) E(Xi - x)(Yi - y)/E(Xi - x)2 (Legend: y & x - average, Xi - xAxis, Yi - yAxis, E - summation or Sigma, 2 - square or power)
            $slope = ($sum_up / $sum_down);

            // getting the start weight (based on initial x formula) Bo = y - B1x (Legend: y & x - average, Bo - yStart or initial, B1 - slope)
            $start_weight = ($average_weight - ($slope * $average_age));

            // getting the predicted weight (based on the regression model formula) Yi = Bo + B1Xi (Legend: Bo - yStart or initial, B1 - slope, Xi - xAxis, Yi - yAxis)
            $predicted_weight = $start_weight + ($slope * $age);

            return $predicted_weight;
        }
}
