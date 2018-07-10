<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class His_controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('cis/cis_model','cis');
        $this->load->model('his/his_model','his');
        $this->load->model('family/family_model','family');
    }

   public function index($child_id)						/** Note: ayaw ilisi ang sequence sa page load sa page **/
   {
        if($this->session->userdata('user_id') == '')
        {
          redirect('error500');
        }
        
        $data['child'] = $this->cis->get_by_id($child_id);
        $data['his'] = $this->his->get_by_id($child_id);

        $this->load->helper('url');							
        											
        $data['title'] = 'Household Information Sheet (HIS) Records';					
        $this->load->view('template/dashboard_header',$data);
        $this->load->view('his/his_view',$data);   //Kani lang ang ilisi kung mag dungag mo ug Page
        $this->load->view('template/dashboard_navigation');
        $this->load->view('template/dashboard_footer');
   }
   
   public function add_his_view($child_id)
   {
       $data['child'] = $this->cis->get_by_id($child_id);
       $data['family'] = $this->family->get_family_list($child_id);

       $this->load->helper('url');                         
                                                   
       $data['title'] = 'Add Household Information Sheet (HIS)';                   
       $this->load->view('template/dashboard_header',$data);
       $this->load->view('his/add_his_view',$data);   //Kani lang ang ilisi kung mag dungag mo ug Page
       $this->load->view('template/dashboard_navigation');
       $this->load->view('template/dashboard_footer');
   }

   public function edit_his_view($child_id)
   {
       $data['child'] = $this->cis->get_by_id($child_id);
       $data['family'] = $this->family->get_family_list($child_id);
       $data['his'] = $this->his->get_by_id($child_id);

       $this->load->helper('url');                         
                                                   
       $data['title'] = 'Edit Household Information Sheet (HIS)';                   
       $this->load->view('template/dashboard_header',$data);
       $this->load->view('his/edit_his_view',$data);   //Kani lang ang ilisi kung mag dungag mo ug Page
       $this->load->view('template/dashboard_navigation');
       $this->load->view('template/dashboard_footer');
   }   
    // public function ajax_list()
    // {
    //     $list = $this->his->get_datatables();
    //     $data = array();
    //     $no = $_POST['start'];
    //     foreach ($list as $his) {
    //         $no++;
    //         $row = array();
    //         $row[] = 'C' . $his->child_id;
    //         $row[] = $his->lastname;
    //         $row[] = $his->firstname;
    //         $row[] = $his->middlename;
    //         $row[] = $his->dob;

    //         // age in mos
    //         $birthday = new DateTime($his->dob);

    //         $diff = $birthday->diff(new DateTime());
    //         $months = $diff->format('%m') + 12 * $diff->format('%y');

    //         $row[] = $months;          

    //         // $row[] = $his->pob;
    //         $row[] = $his->sex;
    //         // $row[] = $his->religion;
    //         $row[] = $his->weight;
    //         $row[] = $his->height;
    //         // $row[] = $his->disability;
    //         // $row[] = $his->contact;
    //         // $row[] = $his->school;
    //         // $row[] = $his->grade_level;
    //         // $row[] = $his->address;
    //         $row[] = $this->barangays->get_barangay_name($his->barangay_id);

    //         $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="View" onclick="view_profile('."'".$his->child_id."'".')"><i class="fa fa-eye"></i> </a>
                      
    //                   <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_his('."'".$his->child_id."'".')"><i class="fa fa-trash"></i></a>';

    //         $row[] = $his->date_registered;
    //         $row[] = $his->encoded;
    //         // $row[] = $his->graduated;
    //         // $row[] = $his->date_graduated;
    //         //add html for action
            
 
    //         $data[] = $row;
    //     }
 
    //     $output = array(
    //                     "draw" => $_POST['draw'],
    //                     "recordsTotal" => $this->his->count_all(),
    //                     "recordsFiltered" => $this->his->count_filtered(),
    //                     "data" => $data,
    //             );
    //     //output to json format
    //     echo json_encode($output);
    // }
 
    public function ajax_edit($child_id)
    {
        $data = $this->his->get_by_id($child_id);
        echo json_encode($data);
    }
 
    public function ajax_add()
    {
        $this->_validate();
        $data = array(
                'child_id' => $this->input->post('child_id'),
                'date_interviewed' => $this->input->post('date_interviewed'),
                'head_id' => $this->input->post('head_id'),
                'dob' => $this->input->post('dob'),
                'pob' => $this->input->post('pob'),
                'religion' => $this->input->post('religion'),
                'income_source' => $this->input->post('income_source'),
                'insurance' => $this->input->post('insurance'),
                'house' => $this->input->post('house'),
                'roof' => $this->input->post('roof'),
                'wall' => $this->input->post('wall'),
                'floor' => $this->input->post('floor'),
                'room' => $this->input->post('room'),
                'disposition' => $this->input->post('disposition'),
                'garbage' => $this->input->post('garbage'),
                'water' => $this->input->post('water'),
                'light' => $this->input->post('light'),
                'bath' => $this->input->post('bath'),
                'r_bath' => $this->input->post('r_bath'),
                'food' => $this->input->post('food'),
                'cook' => $this->input->post('cook'),
                'harassment' => $this->input->post('harassment'),
                'r_harassment' => $this->input->post('r_harassment'),
                'contented' => $this->input->post('contented'),
                'r_contented' => $this->input->post('r_contented'),
                'church' => $this->input->post('church'),
                'community' => $this->input->post('community'),
                'plans' => $this->input->post('plans'),
                'illness' => $this->input->post('illness'),
                'medicine' => $this->input->post('medicine'),
                'medicine_source' => $this->input->post('medicine_source'),
                'smoking' => $this->input->post('smoking'),
                's_product' => $this->input->post('s_product'),
                's_benefit' => $this->input->post('s_benefit'),
                'liquor' => $this->input->post('liquor'),
                'l_benefit' => $this->input->post('l_benefit'),
                'beneficiary' => $this->input->post('beneficiary'),

                // 'encoded' => $this->input->post('encoded'),
            );
        $insert = $this->his->save($data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_update()
    {
        $this->_validate();
        $data = array(
                'date_interviewed' => $this->input->post('date_interviewed'),
                'head_id' => $this->input->post('head_id'),
                'dob' => $this->input->post('dob'),
                'pob' => $this->input->post('pob'),
                'religion' => $this->input->post('religion'),
                'income_source' => $this->input->post('income_source'),
                'insurance' => $this->input->post('insurance'),
                'house' => $this->input->post('house'),
                'roof' => $this->input->post('roof'),
                'wall' => $this->input->post('wall'),
                'floor' => $this->input->post('floor'),
                'room' => $this->input->post('room'),
                'disposition' => $this->input->post('disposition'),
                'garbage' => $this->input->post('garbage'),
                'water' => $this->input->post('water'),
                'light' => $this->input->post('light'),
                'bath' => $this->input->post('bath'),
                'r_bath' => $this->input->post('r_bath'),
                'food' => $this->input->post('food'),
                'cook' => $this->input->post('cook'),
                'harassment' => $this->input->post('harassment'),
                'r_harassment' => $this->input->post('r_harassment'),
                'contented' => $this->input->post('contented'),
                'r_contented' => $this->input->post('r_contented'),
                'church' => $this->input->post('church'),
                'community' => $this->input->post('community'),
                'plans' => $this->input->post('plans'),
                'illness' => $this->input->post('illness'),
                'medicine' => $this->input->post('medicine'),
                'medicine_source' => $this->input->post('medicine_source'),
                'smoking' => $this->input->post('smoking'),
                's_product' => $this->input->post('s_product'),
                's_benefit' => $this->input->post('s_benefit'),
                'liquor' => $this->input->post('liquor'),
                'l_benefit' => $this->input->post('l_benefit'),
                'beneficiary' => $this->input->post('beneficiary'),
            );
        $this->his->update(array('child_id' => $this->input->post('child_id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('date_interviewed') == '')
        {
            $data['inputerror'][] = 'date_interviewed';
            $data['error_string'][] = 'Date interviewed is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('religion') == '')
        {
            $data['inputerror'][] = 'religion';
            $data['error_string'][] = 'Religion info is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('income_source') == '')
        {
            $data['inputerror'][] = 'income_source';
            $data['error_string'][] = 'Income source info is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('house') == '')
        {
            $data['inputerror'][] = 'house';
            $data['error_string'][] = 'House inforamtion is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('disposition') == '')
        {
            $data['inputerror'][] = 'disposition';
            $data['error_string'][] = 'Waste disposal info is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('garbage') == '')
        {
            $data['inputerror'][] = 'garbage';
            $data['error_string'][] = 'Garbage disposal info is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('water') == '')
        {
            $data['inputerror'][] = 'water';
            $data['error_string'][] = 'Water source info is required';
            $data['status'] = FALSE;
        }        

        if($this->input->post('bath') == '')
        {
            $data['inputerror'][] = 'bath';
            $data['error_string'][] = 'Bath info is required';
            $data['status'] = FALSE;
        }  

        if($this->input->post('food') == '')
        {
            $data['inputerror'][] = 'food';
            $data['error_string'][] = 'Food info is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('harassment') == '')
        {
            $data['inputerror'][] = 'harassment';
            $data['error_string'][] = 'Harassment info is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('contented') == '')
        {
            $data['inputerror'][] = 'contented';
            $data['error_string'][] = 'Contentment info is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('illness') == '')
        {
            $data['inputerror'][] = 'illness';
            $data['error_string'][] = 'Illness info is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('medicine') == '')
        {
            $data['inputerror'][] = 'medicine';
            $data['error_string'][] = 'Medicine info is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('smoking') == '')
        {
            $data['inputerror'][] = 'smoking';
            $data['error_string'][] = 'Smoking info is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('liquor') == '')
        {
            $data['inputerror'][] = 'liquor';
            $data['error_string'][] = 'Liquor info is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('beneficiary') == '')
        {
            $data['inputerror'][] = 'beneficiary';
            $data['error_string'][] = 'Beneficiary info is required';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
 }