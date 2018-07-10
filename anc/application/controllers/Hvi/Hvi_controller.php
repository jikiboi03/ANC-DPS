<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hvi_controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('cis/cis_model','cis');
        $this->load->model('hvi/hvi_model','hvi');
        // $this->load->model('family/family_model','family');
        // $this->load->model('barangays/barangays_model','barangays');
    }

   public function index($child_id)						/** Note: ayaw ilisi ang sequence sa page load sa page **/
   {
        if($this->session->userdata('user_id') == '')
        {
          redirect('error500');
        }

        $data['child'] = $this->cis->get_by_id($child_id);

        $this->load->helper('url');							
        											
        $data['title'] = 'Home Visitation Interview (Quarterly)';					
        $this->load->view('template/dashboard_header',$data);
        $this->load->view('hvi/hvi_view',$data);   //Kani lang ang ilisi kung mag dungag mo ug Page
        $this->load->view('template/dashboard_navigation');
        $this->load->view('template/dashboard_footer');

   }
   
    public function ajax_list($child_id)
    {
        $list = $this->hvi->get_datatables($child_id);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $hvi) {
            $no++;
            $row = array();
            $row[] = 'H' . $hvi->hvi_id;
           
            // for presenting period column
            $period = '';

            if ($hvi->period == 1)
            {
                $period = '1st Quarter';
            }
            if ($hvi->period == 2)
            {
                $period = '2nd Quarter';
            }
            if ($hvi->period == 3)
            {
                $period = '3rd Quarter';
            }
            if ($hvi->period == 4)
            {
                $period = '4th Quarter';
            }

            $row[] = $period;
            $row[] = $hvi->year;
            $row[] = $hvi->date;          
            $row[] = $hvi->time;

            $row[] = $hvi->height . ' cm';
            $row[] = $hvi->weight . ' kg';

            $row[] = $hvi->encoded;


            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_hvi('."'".$hvi->hvi_id."'".')"><i class="fa fa-pencil-square-o"></i> </a>
                      
                      <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_hvi('."'".$hvi->hvi_id."'".')"><i class="fa fa-trash"></i></a>';
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->hvi->count_all($child_id),
                        "recordsFiltered" => $this->hvi->count_filtered($child_id),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
 
    // add hvi record
    public function ajax_add()
    {
        $this->_validate();
        $data = array(
                'child_id' => $this->input->post('child_id'),
                'period' => $this->input->post('period'),

                'year' => $this->input->post('year'),
                'date' => $this->input->post('date'),
                'time' => $this->input->post('time'),

                'height' => $this->input->post('height'),
                'weight' => $this->input->post('weight'),

                'appetite' => $this->input->post('appetite'),
                'water' => $this->input->post('water'),
                'bowel' => $this->input->post('bowel'),

                'hair' => $this->input->post('hair'),
                'finger' => $this->input->post('finger'),
                'teeth' => $this->input->post('teeth'),

                'skin' => $this->input->post('skin'),
                'eyes' => $this->input->post('eyes'),
                'nose' => $this->input->post('nose'),

                'ears' => $this->input->post('ears'),
                'comments' => $this->input->post('comments'),
                'illness' => $this->input->post('illness'),

                'concerns' => $this->input->post('concerns')
            );
        $insert = $this->hvi->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_edit($hvi_id)
    {
        $data = $this->hvi->get_by_id($hvi_id);
        echo json_encode($data);
    }
 
    public function ajax_update()
    {
        $this->_validate();
        $data = array(
                'period' => $this->input->post('period'),

                'year' => $this->input->post('year'),
                'date' => $this->input->post('date'),
                'time' => $this->input->post('time'),

                'height' => $this->input->post('height'),
                'weight' => $this->input->post('weight'),

                'appetite' => $this->input->post('appetite'),
                'water' => $this->input->post('water'),
                'bowel' => $this->input->post('bowel'),

                'hair' => $this->input->post('hair'),
                'finger' => $this->input->post('finger'),
                'teeth' => $this->input->post('teeth'),

                'skin' => $this->input->post('skin'),
                'eyes' => $this->input->post('eyes'),
                'nose' => $this->input->post('nose'),

                'ears' => $this->input->post('ears'),
                'comments' => $this->input->post('comments'),
                'illness' => $this->input->post('illness'),

                'concerns' => $this->input->post('concerns')
            );
        $this->hvi->update(array('hvi_id' => $this->input->post('hvi_id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    // delete a hvi
    public function ajax_delete($hvi_id)
    {
        $this->hvi->delete_by_id($hvi_id);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

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
                $duplicates = $this->hvi->get_duplicates($this->input->post('child_id'), $this->input->post('period'), $this->input->post('year'));

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

        if($this->input->post('time') == '')
        {
            $data['inputerror'][] = 'time';
            $data['error_string'][] = 'Time is required';
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

        if($this->input->post('appetite') == '')
        {
            $data['inputerror'][] = 'appetite';
            $data['error_string'][] = 'Appetite is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('water') == '')
        {
            $data['inputerror'][] = 'water';
            $data['error_string'][] = 'Water is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('bowel') == '')
        {
            $data['inputerror'][] = 'bowel';
            $data['error_string'][] = 'Bowel is required';
            $data['status'] = FALSE;
        }     

        if($this->input->post('hair') == '')
        {
            $data['inputerror'][] = 'hair';
            $data['error_string'][] = 'Hair is required';
            $data['status'] = FALSE;
        }     

        if($this->input->post('finger') == '')
        {
            $data['inputerror'][] = 'finger';
            $data['error_string'][] = 'Finger is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('teeth') == '')
        {
            $data['inputerror'][] = 'teeth';
            $data['error_string'][] = 'Teeth is required';
            $data['status'] = FALSE;
        }     

        if($this->input->post('skin') == '')
        {
            $data['inputerror'][] = 'skin';
            $data['error_string'][] = 'Skin is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('eyes') == '')
        {
            $data['inputerror'][] = 'eyes';
            $data['error_string'][] = 'Eyes is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('nose') == '')
        {
            $data['inputerror'][] = 'nose';
            $data['error_string'][] = 'Nose is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('ears') == '')
        {
            $data['inputerror'][] = 'ears';
            $data['error_string'][] = 'Ears is required';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
 }