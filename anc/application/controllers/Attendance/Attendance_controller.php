<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance_controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('cis/cis_model','cis');
        $this->load->model('attendance/attendance_model','attendance');
        $this->load->model('barangays/barangays_model','barangays');
    }

   public function index($date)                      /** Note: ayaw ilisi ang sequence sa page load sa page **/
   {
        if($this->session->userdata('user_id') == '')
        {
          redirect('error500');
        }
        
        // inser date
        $data['date'] = $date;

        $this->load->helper('url');                         
                                                    
        $data['title'] = 'Children Attendance Records';                   
        $this->load->view('template/dashboard_header',$data);
        $this->load->view('attendance/attendance_view',$data);   //Kani lang ang ilisi kung mag dungag mo ug Page
        $this->load->view('template/dashboard_navigation');
        $this->load->view('template/dashboard_footer');

   }
    
    // get cis data for attendance table (child records) with parameter date
    public function ajax_list($date)
    {
        $present_count = 0;
        $child_count = 0;

        $list = $this->cis->get_datatables();
        $data = array();
        $no = $_POST['start'];

        // initialize excluded children (not registered on or before the date)
        $excluded_children = 0;

        foreach ($list as $cis) {

            // if registered already on or before the specified date
            if ($cis->date_registered <= $date)
            {
                $no++;
                $row = array();
                $row[] = 'C' . $cis->child_id;
                $row[] = $cis->lastname;
                $row[] = $cis->firstname;
                $row[] = $cis->middlename;

                $row[] = $cis->sex;
                $row[] = $this->barangays->get_barangay_name($cis->barangay_id);

                // check if present or not
                $present = $this->attendance->get_attendance($cis->child_id, $date);

                if ($present->num_rows() != 0)
                {
                    // if present show absent button
                    $row[] = '<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Absent" onclick="set_absent('."'".$cis->child_id."'".')"><i class="fa fa-times"></i> </a>';
                    $row[] = 'P';

                    $present_count++;
                    $child_count++;
                }
                else
                {
                    // if not present
                    $row[] = '<a class="btn btn-sm btn-success" href="javascript:void(0)" title="Present" onclick="set_present('."'".$cis->child_id."'".')"><i class="fa fa-check"></i> </a>';
                    $row[] = 'A';

                    // $present_count--;
                    $child_count++;
                }

                $row[] = $cis->encoded;

                $row[] = $present_count;
                $row[] = $child_count;
                
                $data[] = $row;
            }
            else
            {
                $excluded_children++;
            }
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->cis->count_all() - $excluded_children,
                        "recordsFiltered" => $this->cis->count_filtered() - $excluded_children,
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
 
    // public function ajax_edit($attendance_id)
    // {
    //     $data = $this->attendance->get_by_id($attendance_id);
    //     echo json_encode($data);
    // }
 
    public function ajax_add($child_id, $date)
    {
        // $this->_validate();

        $data = array(
                'child_id' => $child_id,
                'date' => $date
            );
        $insert = $this->attendance->save($data);
        echo json_encode(array("status" => TRUE));
    }
 
    // public function ajax_update()
    // {
    //     $this->_validate();
    //     $data = array(
    //             'child_id' => $this->input->post('child_id'),
    //             'month' => $this->input->post('month'),
    //             'year' => $this->input->post('year'),
    //             'date' => $this->input->post('date'),
    //             'height' => $this->input->post('height'),
    //             'weight' => $this->input->post('weight')
    //         );
    //     $this->attendance->update(array('attendance_id' => $this->input->post('attendance_id')), $data);
    //     echo json_encode(array("status" => TRUE));
    // }

    // delete a attendance record (2 parameters to include date instead of child_id only)
    public function ajax_delete($child_id, $date)
    {
        $this->attendance->delete_by_id($child_id, $date);
        echo json_encode(array("status" => TRUE));
    }

    // private function _validate()
    // {
    //     $data = array();
    //     $data['error_string'] = array();
    //     $data['inputerror'] = array();
    //     $data['status'] = TRUE;

    //     if($this->input->post('child_id') == '')
    //     {
    //         $data['inputerror'][] = 'child_id';
    //         $data['error_string'][] = 'Child is required';
    //         $data['status'] = FALSE;
    //     }

    //     if($this->input->post('month') == '')
    //     {
    //         $data['inputerror'][] = 'month';
    //         $data['error_string'][] = 'Month is required';
    //         $data['status'] = FALSE;
    //     }
    //     // validation for duplicates
    //     else
    //     {
    //         $new_period = $this->input->post('child_id') . $this->input->post('month') . $this->input->post('year');
    //         // check if period has a new value or not
    //         if ($this->input->post('current_period') != $new_period)
    //         {
    //             // validate if period already exist in the databaase table
    //             $duplicates = $this->attendance->get_duplicates($this->input->post('child_id'), $this->input->post('month'), $this->input->post('year'));

    //             if ($duplicates->num_rows() != 0)
    //             {
    //                 $data['inputerror'][] = 'month';
    //                 $data['error_string'][] = 'Same month and year is already registered';
    //                 $data['status'] = FALSE;
    //             }
    //         }
    //     }

    //     if($this->input->post('year') == '')
    //     {
    //         $data['inputerror'][] = 'year';
    //         $data['error_string'][] = 'Year is required';
    //         $data['status'] = FALSE;
    //     }

    //     if($this->input->post('date') == '')
    //     {
    //         $data['inputerror'][] = 'date';
    //         $data['error_string'][] = 'Date is required';
    //         $data['status'] = FALSE;
    //     }

    //     if($this->input->post('height') == '')
    //     {
    //         $data['inputerror'][] = 'height';
    //         $data['error_string'][] = 'Current height is required';
    //         $data['status'] = FALSE;
    //     }

    //     if($this->input->post('weight') == '')
    //     {
    //         $data['inputerror'][] = 'weight';
    //         $data['error_string'][] = 'Current weight is required';
    //         $data['status'] = FALSE;
    //     }

    //     if($data['status'] === FALSE)
    //     {
    //         echo json_encode($data);
    //         exit();
    //     }
    // }
 }