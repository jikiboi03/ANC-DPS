<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_controller extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('cis/cis_model','cis');
    $this->load->model('his/his_model','his');
    $this->load->model('family/family_model','family');
    $this->load->model('barangays/barangays_model','barangays');

    $this->load->model('monthly/monthly_model','monthly');
    $this->load->model('hvi/hvi_model','hvi');
    $this->load->model('deworming/deworming_model','deworming');
    $this->load->model('schedules/schedules_model','schedules');

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
    $today = date('Y-m-d');
    $yesterday = date('Y-m-d',(strtotime ( '-1 day' , strtotime ( $today) ) ));

    // get from cis model data
    $registered_today = $this->cis->get_registered_today($today)['registered_count'];
    $registered_yesterday = $this->cis->get_registered_today($yesterday)['registered_count'];

    // home visit / interviewed
    $family_visited = $this->his->count_all();

    if ($this->his->get_last_visit() != null)
    {
        $date_last_visit = $this->his->get_last_visit()->date_interviewed;
    }

    // total family members
    $family_members = $this->family->count_all_members();
    $count_child_family = $this->family->count_child_family()['child_id'];
    $income_child_family = $this->family->count_child_family()['income'];

    // total barangays registered
    $barangays_count = $this->barangays->count_all();
    $top_barangay = $this->barangays->get_barangay_name($this->cis->get_top_barangay()['top_barangay']);
    $barangay_child = $this->cis->get_top_barangay()['barangay_count'];


    // $item_count_today = $this->registeredactions->get_registeredaction_today($today)['item_count'] + 0;
    // $item_count_yesterday = $this->registeredactions->get_registeredaction_today($yesterday)['item_count'] + 0;

    // // initialize percentage
    // $str_percent = null;

    // if today is less than yesterday by quantity - calculating percentage of higher or lower
    if ($registered_today < $registered_yesterday)
    {
      $percent_registered = 100 - (($registered_today / $registered_yesterday) * 100);

      $str_percent_registered = round($percent_registered) . "% Lower than yesterday (" . $registered_yesterday . ")";
    }
    else
    {
      if ($registered_today != 0)
      {
        $percent = 100 - (($registered_yesterday / $registered_today) * 100);

        $str_percent_registered = round($percent) . "% Higher than yesterday (" . $registered_yesterday . ")";
      }
      else
      {
        $str_percent_registered = 0 . "% Higher than yesterday (" . $registered_yesterday . ")";
      }  
    }


    // ========================================== NOTIFICATIONS SECTION ================================================

    // for no monthly checkup for the previous month

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

    $child_id_array = array();

    foreach ($child_id_result as $ch) 
    {
        $child_id_array[] = $ch->child_id;
    }

    $no_monthly = $this->cis->count_all_monthly($child_id_array, $previous_month, $year);



    // for no quarterly for the previous quarter

    // get last month
    $year = date('Y'); // current year but can be changed to last year if current month is Jan

    if ($current_month < 4) // if current month is Jan-Mar which is 1st quarter, prev quarter should be 4th
    {
        $reg_month = 12; // atleast registered since 4th quarter
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

    $no_quarterly = $this->cis->count_all_quarterly($child_id_array, $reg_month, $year);
    

    // for no deworming for the previous semi-annual

    // get last month
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

    $no_deworming = $this->cis->count_all_deworming($child_id_array, $reg_month, $year);


    // for birthdays notification
    $birthday_children = $this->cis->get_monthly_birthdays($current_month);

    if ($birthday_children == null)
    {
        $birthday_str = 'None';
    }
    else
    {
        $birthday_str = ''; 

        foreach ($birthday_children as $cis) 
        {    
            $child_id = 'C' . $cis->child_id;
            $fullname = $cis->lastname . ', ' . $cis->firstname;

            // age in mos
            $birthday = date('l, F j', strtotime($cis->dob));

            $birthday_str = $birthday_str . ' | ' . $child_id . ': ' . $fullname . ' ' . $birthday;
        }
    }

    
    // for schedules today notification
    $schedules_today = $this->schedules->get_schedules_today($today);

    if ($schedules_today == null)
    {
        $schedules_today_str = 'None';
    }
    else
    {
        $schedules_today_str = ''; 

        foreach ($schedules_today as $schedules) 
        {    
            $sched_id = 'S' . $schedules->sched_id;
            $title = $schedules->title;
            $time = $schedules->time;

            $schedules_today_str = $schedules_today_str . ' | ' . $sched_id . ': ' . $title . ' @ ' . $time;
        }
    }
    


    // for severe status notification -----------------------------------------------------------------------------

    $age_list = $this->cis->get_children_list(); // only active list (no graduated)

    $su = 0;

    // for each child (note: active or graduated included)
    foreach ($age_list as $cis) 
    {
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
                    $su++;
                }

            }
            else // if it has latest monthly checkup values (the latest_monthly array has values)
            {
                
                $latest_weight = $latest_monthly['weight'];

                // $latest_bmi = ($latest_weight / ($latest_height / 100)) / ($latest_height / 100);

                // for Weight status
                if ($latest_weight <= $boys_data->su)
                {
                    $su++;
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
                    $su++;
                }

            }
            else // if it has latest monthly checkup values (the latest_monthly array has values)
            {
                
                $latest_weight = $latest_monthly['weight'];

                // for Weight status
                if ($latest_weight <= $girls_data->su)
                {
                    $su++;
                }
            }
        }
    }

    $data['severe_status'] = $su;    

    $data['no_monthly'] = $no_monthly;
    $data['no_quarterly'] = $no_quarterly;
    $data['no_deworming'] = $no_deworming;
    $data['birthdays'] = $birthday_str;
    $data['schedules_today_str'] = $schedules_today_str;


    // ========================================== NOTIFICATIONS SECTION ================================================



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

    $data['registered_today'] = $registered_today;
    $data['registered_percent_than_yesterday'] = $str_percent_registered;

    $data['family_visited'] = $family_visited;
    $data['date_last_visit'] = date('l, F j, Y', strtotime($date_last_visit));

    $data['family_members'] = $family_members;
    $data['count_child_family'] = $count_child_family;
    $data['income_child_family'] = $income_child_family;

    $data['barangays_count'] = $barangays_count;
    $data['top_barangay'] = $top_barangay;
    $data['barangay_child'] = $barangay_child;
    



    // // get inventory status - below reorder point and in-stock
    // $data['reorder'] = $this->inventory->get_reorder_status()['reorder'] + 0;
    // $data['in_stock'] = $this->inventory->get_reorder_status()['in_stock'] + 0;

  	/** Note: ayaw ilisi ang sequence sa page load sa page **/
    $data['title'] = 'Dashboard';	
    $this->load->view('template/dashboard_header',$data);
    $this->load->view('template/dashboard_body',$data);		// mao lang ni ang replaceable
    $this->load->view('template/dashboard_navigation');
    $this->load->view('template/dashboard_footer');

  }
}
