<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barangays_controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('barangays/barangays_model','barangays');
    }

   public function index()						/** Note: ayaw ilisi ang sequence sa page load sa page **/
   {
      if($this->session->userdata('user_id') == '')
      {
        redirect('error500');
      }
      
   	  $this->load->helper('url');							
   													
   	  $data['title'] = 'Barangays Information List';					
      $this->load->view('template/dashboard_header',$data);
      $this->load->view('barangays/barangays_view',$data);   //Kani lang ang ilisi kung mag dungag mo ug Page
      $this->load->view('template/dashboard_navigation');
      $this->load->view('template/dashboard_footer');

   }
   
    public function ajax_list()
    {
        $list = $this->barangays->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $barangays) {
            $no++;
            $row = array();
            $row[] = 'B' . $barangays->barangay_id;
            $row[] = $barangays->name;

            $row[] = $barangays->encoded;

            //add html for action
            $row[] = '<a class="btn btn-info" href="javascript:void(0)" title="Edit" onclick="edit_barangay('."'".$barangays->barangay_id."'".')"><i class="fa fa-pencil-square-o"></i></a>
                      
                      <a class="btn btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_barangay('."'".$barangays->barangay_id."'".', '."'".$barangays->name."'".')"><i class="fa fa-trash"></i></a>';
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->barangays->count_all(),
                        "recordsFiltered" => $this->barangays->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
 
    public function ajax_edit($barangay_id)
    {
        $data = $this->barangays->get_by_id($barangay_id);
        echo json_encode($data);
    }
 
    public function ajax_add()
    {
        $this->_validate();
        $data = array(
                'name' => $this->input->post('name'),
                'removed' => 0
            );
        $insert = $this->barangays->save($data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_update()
    {
        $this->_validate();
        $data = array(
                'name' => $this->input->post('name')
            );
        $this->barangays->update(array('barangay_id' => $this->input->post('barangay_id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    // delete a barangay
    public function ajax_delete($barangay_id)
    {
        $data = array(
                'removed' => 1
            );
        $this->barangays->update(array('barangay_id' => $barangay_id), $data);
        echo json_encode(array("status" => TRUE));
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
            $data['error_string'][] = 'Barangay name is required';
            $data['status'] = FALSE;
        }
        // validation for duplicates
        else
        {
            $new_name = $this->input->post('name');
            // check if name has a new value or not
            if ($this->input->post('current_name') != $new_name)
            {
                // validate if name already exist in the databaase table
                $duplicates = $this->barangays->get_duplicates($this->input->post('name'));

                if ($duplicates->num_rows() != 0)
                {
                    $data['inputerror'][] = 'name';
                    $data['error_string'][] = 'Barangay name is already registered';
                    $data['status'] = FALSE;
                }
            }
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
 }