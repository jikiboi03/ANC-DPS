<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profiles_deworming_controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('cis/cis_model','cis');
        $this->load->model('deworming/profiles_deworming_model','deworming');
    }

   public function index($child_id)						/** Note: ayaw ilisi ang sequence sa page load sa page **/
   {
        if($this->session->userdata('user_id') == '')
        {
          redirect('error500');
        }
        
        $data['child'] = $this->cis->get_by_id($child_id);

        // get children list for dropdown
        $data['cis'] = $this->cis->get_children_list();

        $this->load->helper('url');							
        											
        $data['title'] = 'Deworming Information Records';					
        $this->load->view('template/dashboard_header',$data);
        $this->load->view('profiles/profiles_deworming_view',$data);   //Kani lang ang ilisi kung mag dungag mo ug Page
        $this->load->view('template/dashboard_navigation');
        $this->load->view('template/dashboard_footer');

   }
   
    public function ajax_list($child_id)
    {
        $list = $this->deworming->get_datatables($child_id);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $deworming) {
            $no++;
            $row = array();
            $row[] = 'D' . $deworming->deworming_id;
            
            // for shwoing what period (deworming is twice a year)
            if ($deworming->period == 1)
            {
                $row[] = '1st Half';
            }
            else
            {
                $row[] = '2nd Half';
            }

            $row[] = $deworming->year;          

            $row[] = $deworming->date;
            $row[] = $deworming->encoded;

            
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_profiles_deworming('."'".$deworming->deworming_id."'".')"><i class="fa fa-pencil-square-o"></i> </a>
                      
                      <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_profiles_deworming('."'".$deworming->deworming_id."'".')"><i class="fa fa-trash"></i></a>';
            
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->deworming->count_all($child_id),
                        "recordsFiltered" => $this->deworming->count_filtered($child_id),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
 
    public function ajax_edit($deworming_id)
    {
        $data = $this->deworming->get_by_id($deworming_id);
        echo json_encode($data);
    }
 
    public function ajax_add()
    {
        $this->_validate();
        $data = array(
                'child_id' => $this->input->post('child_id'),
                'period' => $this->input->post('period'),
                'year' => $this->input->post('year'),
                'date' => $this->input->post('date')
            );
        $insert = $this->deworming->save($data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_update()
    {
        $this->_validate();
        $data = array(
                'child_id' => $this->input->post('child_id'),
                'period' => $this->input->post('period'),
                'year' => $this->input->post('year'),
                'date' => $this->input->post('date')
            );
        $this->deworming->update(array('deworming_id' => $this->input->post('deworming_id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    // delete a deworming record
    public function ajax_delete($deworming_id)
    {
        $this->deworming->delete_by_id($deworming_id);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('child_id') == '')
        {
            $data['inputerror'][] = 'child_id';
            $data['error_string'][] = 'Child is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('period') == '')
        {
            $data['inputerror'][] = 'period';
            $data['error_string'][] = 'Period is required';
            $data['status'] = FALSE;
        }
        // validation for duplicates
        else
        {
            $new_period = $this->input->post('child_id') . $this->input->post('period') . $this->input->post('year');
            // check if period has a new value or not
            if ($this->input->post('current_period') != $new_period)
            {
                // validate if period already exist in the databaase table
                $duplicates = $this->deworming->get_duplicates($this->input->post('child_id'), $this->input->post('period'), $this->input->post('year'));

                if ($duplicates->num_rows() != 0)
                {
                    $data['inputerror'][] = 'period';
                    $data['error_string'][] = 'Same period is already registered';
                    $data['status'] = FALSE;
                }
            }
        }

        if($this->input->post('year') == '')
        {
            $data['inputerror'][] = 'year';
            $data['error_string'][] = 'Year is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('date') == '')
        {
            $data['inputerror'][] = 'date';
            $data['error_string'][] = 'Date is required';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
 }