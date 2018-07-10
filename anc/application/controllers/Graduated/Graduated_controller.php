<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Graduated_controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('cis/cis_model','cis');
        $this->load->model('graduated/graduated_model','graduated');
    }

   public function index()                      /** Note: ayaw ilisi ang sequence sa page load sa page **/
   {
        if($this->session->userdata('user_id') == '')
        {
          redirect('error500');
        }
        
        // get children list for dropdown
        $data['cis'] = $this->cis->get_children_list();

        $this->load->helper('url');                         
                                                    
        $data['title'] = 'Graduated Children Records';                   
        $this->load->view('template/dashboard_header',$data);
        $this->load->view('graduated/graduated_view',$data);   //Kani lang ang ilisi kung mag dungag mo ug Page
        $this->load->view('template/dashboard_navigation');
        $this->load->view('template/dashboard_footer');

   }
   
    public function ajax_list()
    {
        $list = $this->graduated->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $graduated) {
            $no++;
            $row = array();
            $row[] = 'G' . $graduated->graduated_id;
            $row[] = $graduated->child_id;
            $row[] = $this->cis->get_child_fullname($graduated->child_id);

            $row[] = $graduated->date;

            $row[] = $graduated->remarks;

            $row[] = $graduated->encoded;

            
            $row[] = '<a class="btn btn-sm btn-info" href="javascript:void(0)" title="View" onclick="view_profile('."'".$graduated->child_id."'".')"><i class="fa fa-eye"></i> </a>

                   <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_graduated('."'".$graduated->graduated_id."'".')"><i class="fa fa-pencil-square-o"></i> </a>
                      
                      <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Undo Graduate" onclick="delete_graduated('."'".$graduated->child_id."'".')"><i class="fa fa-trash"></i></a>';
                      // delete graduated data using child_id instead of graduated_id for anomaly in controller input child_id
            
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->graduated->count_all(),
                        "recordsFiltered" => $this->graduated->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
 
    public function ajax_edit($graduated_id)
    {
        $data = $this->graduated->get_by_id($graduated_id);
        echo json_encode($data);
    }
 
    public function ajax_add()
    {
        $this->_validate();
        $data = array(
                'child_id' => $this->input->post('child_id'),
                'date' => $this->input->post('date'),
                'remarks' => $this->input->post('remarks')
            );

        // update cis table. set graduated to 1
        $grad_data = array(
                'graduated' => 1
            );
        $this->cis->update(array('child_id' => $this->input->post('child_id')), $grad_data);

        // insert new data for graduated table after cis update
        $insert = $this->graduated->save($data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_update()
    {
        // call validate_edit instead for updates
        $this->_validate_edit();
        $data = array(
                // 'child_id' => $this->input->post('child_id'),
                'date' => $this->input->post('date'),
                'remarks' => $this->input->post('remarks')
            );
        $this->graduated->update(array('graduated_id' => $this->input->post('graduated_id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    // delete a graduated record / UNDO using child_id instead of graduated_id
    public function ajax_delete($child_id)
    {
         // update cis table. set graduated to 0
        $grad_data = array(
                'graduated' => 0
            );
        $this->cis->update(array('child_id' => $child_id), $grad_data);

        $this->graduated->delete_by_id($child_id);

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
        // validation for duplicates
        else
        {
            $new_child = $this->input->post('child_id');
            // check if period has a new value or not
            if ($this->input->post('current_child') != $new_child)
            {
                // validate if period already exist in the databaase table
                $duplicates = $this->graduated->get_duplicates($this->input->post('child_id'));

                if ($duplicates->num_rows() != 0)
                {
                    $data['inputerror'][] = 'child_id';
                    $data['error_string'][] = 'Child is already graduated';
                    $data['status'] = FALSE;
                }
            }
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

    // validation for edit graduated where child_id input can be empty
    private function _validate_edit()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

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