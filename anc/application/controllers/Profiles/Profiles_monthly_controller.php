<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profiles_monthly_controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('cis/cis_model','cis');
        $this->load->model('monthly/profiles_monthly_model','monthly');
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
        											
        $data['title'] = 'Monthly Checkup Information Records';					
        $this->load->view('template/dashboard_header',$data);
        $this->load->view('profiles/profiles_monthly_view',$data);   //Kani lang ang ilisi kung mag dungag mo ug Page
        $this->load->view('template/dashboard_navigation');
        $this->load->view('template/dashboard_footer');

   }
   
    public function ajax_list($child_id)
    {
        $list = $this->monthly->get_datatables($child_id);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $monthly) {
            $no++;
            $row = array();
            $row[] = 'M' . $monthly->monthly_id;
            
            // for showing what month
            if ($monthly->month == 1)
            {
                $row[] = 'January';
            }
            else if ($monthly->month == 2)
            {
                $row[] = 'February';
            }
            else if ($monthly->month == 3)
            {
                $row[] = 'March';
            }
            else if ($monthly->month == 4)
            {
                $row[] = 'April';
            }
            else if ($monthly->month == 5)
            {
                $row[] = 'May';
            }
            else if ($monthly->month == 6)
            {
                $row[] = 'June';
            }

            else if ($monthly->month == 7)
            {
                $row[] = 'July';
            }
            else if ($monthly->month == 8)
            {
                $row[] = 'August';
            }
            else if ($monthly->month == 9)
            {
                $row[] = 'September';
            }
            else if ($monthly->month == 10)
            {
                $row[] = 'October';
            }
            else if ($monthly->month == 11)
            {
                $row[] = 'November';
            }
            else if ($monthly->month == 12)
            {
                $row[] = 'December';
            }

            $row[] = $monthly->year;          

            $row[] = $monthly->date;

            $row[] = $monthly->height . ' cm';
            $row[] = $monthly->weight . ' kg';

            $row[] = $monthly->encoded;

            
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_profiles_monthly('."'".$monthly->monthly_id."'".')"><i class="fa fa-pencil-square-o"></i> </a>
                      
                      <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_profiles_monthly('."'".$monthly->monthly_id."'".')"><i class="fa fa-trash"></i></a>';
            
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->monthly->count_all($child_id),
                        "recordsFiltered" => $this->monthly->count_filtered($child_id),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
 
    public function ajax_edit($monthly_id)
    {
        $data = $this->monthly->get_by_id($monthly_id);
        echo json_encode($data);
    }
 
    public function ajax_add()
    {
        $this->_validate();
        $data = array(
                'child_id' => $this->input->post('child_id'),
                'month' => $this->input->post('month'),
                'year' => $this->input->post('year'),
                'date' => $this->input->post('date'),
                'height' => $this->input->post('height'),
                'weight' => $this->input->post('weight')
            );
        $insert = $this->monthly->save($data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_update()
    {
        $this->_validate();
        $data = array(
                'child_id' => $this->input->post('child_id'),
                'month' => $this->input->post('month'),
                'year' => $this->input->post('year'),
                'date' => $this->input->post('date'),
                'height' => $this->input->post('height'),
                'weight' => $this->input->post('weight')
            );
        $this->monthly->update(array('monthly_id' => $this->input->post('monthly_id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    // delete a monthly record
    public function ajax_delete($monthly_id)
    {
        $this->monthly->delete_by_id($monthly_id);
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

        if($this->input->post('month') == '')
        {
            $data['inputerror'][] = 'month';
            $data['error_string'][] = 'Month is required';
            $data['status'] = FALSE;
        }
        // validation for duplicates
        else
        {
            $new_period = $this->input->post('child_id') . $this->input->post('month') . $this->input->post('year');
            // check if period has a new value or not
            if ($this->input->post('current_period') != $new_period)
            {
                // validate if period already exist in the databaase table
                $duplicates = $this->monthly->get_duplicates($this->input->post('child_id'), $this->input->post('month'), $this->input->post('year'));

                if ($duplicates->num_rows() != 0)
                {
                    $data['inputerror'][] = 'month';
                    $data['error_string'][] = 'Same month and year is already registered';
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

        if($this->input->post('height') == '')
        {
            $data['inputerror'][] = 'height';
            $data['error_string'][] = 'Current height is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('weight') == '')
        {
            $data['inputerror'][] = 'weight';
            $data['error_string'][] = 'Current weight is required';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
 }