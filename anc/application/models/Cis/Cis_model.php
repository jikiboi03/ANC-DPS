<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Cis_model extends CI_Model {
 
    var $table = 'cis';
    // var $column_order = array('child_id','lastname','firstname','middlename','dob','pob','sex','religion','weight','height','disability','contact','school','grade_level','address','barangay_id','date_registered','encoded',null);
    var $column_order = array('child_id','lastname','firstname','middlename','dob',null,'sex','weight','height','barangay_id',null,'date_registered','encoded'); //set column field database for datatable orderable
    var $column_search = array('child_id','lastname','firstname','middlename','dob','sex','weight','height','barangay_id','date_registered'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('lastname' => 'asc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    private function _get_datatables_query()
    {
         
        $this->db->from($this->table);
 
        $i = 0;
     
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables()
    {        
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);

        // get only records that are not currently removed and graduated
        $this->db->where('graduated', '0');
        $this->db->where('removed', '0');
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();

        // get only records that are not currently removed
        $this->db->where('graduated', '0');
        $this->db->where('removed', '0');
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function count_all()
    {
        $this->db->from($this->table);

        // get only records that are not currently removed
        $this->db->where('graduated', '0');
        $this->db->where('removed', '0');
        return $this->db->count_all_results();
    }

   //========================================= NOTIFICATIONS TABLE =====================================================

    // MONTHLY CHECKUP -------------------------------------------------------------------------------------------------

    // rule on date_registered: 16th day of the previous month (ex. now is Jan 2018 then Dec 2017 is the previous month to be checked, the date_registered should be atleast since Dec 16, 2017)
    function get_datatables_monthly($child_id_array, $previous_month, $year)
    {        
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);

        // get only records that are not currently removed and graduated
        $this->db->where('graduated', '0');
        $this->db->where('removed', '0');

        $date_to = $year . '-' . sprintf("%02d", $previous_month) . '-16';

        $this->db->where('date_registered <=', $date_to);

        if (count($child_id_array) != 0)
        {
            $this->db->where_not_in('child_id', $child_id_array);
        }

        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_monthly($child_id_array, $previous_month, $year)
    {
        $this->_get_datatables_query();

        // get only records that are not currently removed
        $this->db->where('graduated', '0');
        $this->db->where('removed', '0');

        $date_to = $year . '-' . sprintf("%02d", $previous_month) . '-16';

        $this->db->where('date_registered <=', $date_to);

        if (count($child_id_array) != 0)
        {
            $this->db->where_not_in('child_id', $child_id_array);
        }

        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function count_all_monthly($child_id_array, $previous_month, $year)
    {
        $this->db->from($this->table);

        // get only records that are not currently removed
        $this->db->where('graduated', '0');
        $this->db->where('removed', '0');

        $date_to = $year . '-' . sprintf("%02d", $previous_month) . '-16';

        $this->db->where('date_registered <=', $date_to);

        if (count($child_id_array) != 0)
        {
            $this->db->where_not_in('child_id', $child_id_array);
        }

        return $this->db->count_all_results();
    }

    // HVI QUARTERLY ---------------------------------------------------------------------------------------------------

    // rule on date_registered: 1st day of the ending month of the quarter (ex. now is Jan 2018 then 4th is the last quarter to be checked, the date_registered should be atleast since Dec 1, 2017)
    function get_datatables_quarterly($child_id_array, $reg_month, $year)
    {        
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);

        // get only records that are not currently removed and graduated
        $this->db->where('graduated', '0');
        $this->db->where('removed', '0');

        $date_to = $year . '-' . sprintf("%02d", $reg_month) . '-01';

        $this->db->where('date_registered <=', $date_to);

        if (count($child_id_array) != 0)
        {
            $this->db->where_not_in('child_id', $child_id_array);
        }

        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_quarterly($child_id_array, $reg_month, $year)
    {
        $this->_get_datatables_query();

        // get only records that are not currently removed
        $this->db->where('graduated', '0');
        $this->db->where('removed', '0');

        $date_to = $year . '-' . sprintf("%02d", $reg_month) . '-01';

        $this->db->where('date_registered <=', $date_to);

        if (count($child_id_array) != 0)
        {
            $this->db->where_not_in('child_id', $child_id_array);
        }

        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function count_all_quarterly($child_id_array, $reg_month, $year)
    {
        $this->db->from($this->table);

        // get only records that are not currently removed
        $this->db->where('graduated', '0');
        $this->db->where('removed', '0');

        $date_to = $year . '-' . sprintf("%02d", $reg_month) . '-01';

        $this->db->where('date_registered <=', $date_to);

        if (count($child_id_array) != 0)
        {
            $this->db->where_not_in('child_id', $child_id_array);
        }

        return $this->db->count_all_results();
    }

    // DEWORMING SEMI-ANNUALLY -----------------------------------------------------------------------------------------

    // rule on date_registered: 1st day of the ending month of the sem (ex. now is Jan 2018 then 2nd is the last sem to be checked, the date_registered should be atleast since Dec 1, 2017)
    function get_datatables_deworming($child_id_array, $reg_month, $year)
    {        
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);

        // get only records that are not currently removed and graduated
        $this->db->where('graduated', '0');
        $this->db->where('removed', '0');

        $date_to = $year . '-' . sprintf("%02d", $reg_month) . '-01';

        $this->db->where('date_registered <=', $date_to);

        if (count($child_id_array) != 0)
        {
            $this->db->where_not_in('child_id', $child_id_array);
        }

        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered_deworming($child_id_array, $reg_month, $year)
    {
        $this->_get_datatables_query();

        // get only records that are not currently removed
        $this->db->where('graduated', '0');
        $this->db->where('removed', '0');

        $date_to = $year . '-' . sprintf("%02d", $reg_month) . '-01';

        $this->db->where('date_registered <=', $date_to);

        if (count($child_id_array) != 0)
        {
            $this->db->where_not_in('child_id', $child_id_array);
        }

        $query = $this->db->get();
        return $query->num_rows();
    }
    
    public function count_all_deworming($child_id_array, $reg_month, $year)
    {
        $this->db->from($this->table);

        // get only records that are not currently removed
        $this->db->where('graduated', '0');
        $this->db->where('removed', '0');

        $date_to = $year . '-' . sprintf("%02d", $reg_month) . '-01';

        $this->db->where('date_registered <=', $date_to);

        if (count($child_id_array) != 0)
        {
            $this->db->where_not_in('child_id', $child_id_array);
        }

        return $this->db->count_all_results();
    }




    //========================================= NOTIFICATIONS TABLE ====================================================

    // check for duplicates in the database table for validation
    function get_duplicates($lastname, $firstname, $middlename)
    {
        
        $this->db->from($this->table);
        $this->db->where('lastname',$lastname);
        $this->db->where('firstname',$firstname);
        $this->db->where('middlename',$middlename);

        $query = $this->db->get();

        return $query;
    }

    // // get both id and names - Severe weight status
    // function get_severe_children_list_male()
    // {
    //     $this->db->from($this->table);
    //     $this->db->join('comments', 'comments.id = blogs.id');
    //     $this->db->where('sex','Male');
    //     $this->db->where('graduated','0');
    //     $this->db->where('removed', '0');
    //     $this->db->order_by("lastname", "asc");
    //     $query = $this->db->get();

    //     return $query->result();
    // }

    // // get both id and names - Severe weight status
    // function get_severe_children_list_female()
    // {
    //     $this->db->from($this->table);
    //     $this->db->where('graduated','0');
    //     $this->db->where('removed', '0');
    //     $this->db->order_by("lastname", "asc");
    //     $query = $this->db->get();

    //     return $query->result();
    // }

    // get both id and names - Active
    function get_children_list()
    {
        $this->db->from($this->table);
        $this->db->where('graduated','0');
        $this->db->where('removed', '0');
        $this->db->order_by("lastname", "asc");
        $query = $this->db->get();

        return $query->result();
    }

    // get both id and names - Graduated
    function get_children_graduated_list()
    {
        $this->db->from($this->table);
        $this->db->where('graduated','1');
        $this->db->where('removed', '0');
        $this->db->order_by("lastname", "asc");
        $query = $this->db->get();

        return $query->result();
    }

    // get both id and names
    function get_monthly_birthdays($month)
    {
        $this->db->from($this->table);
        $this->db->where('graduated','0');
        $this->db->where('removed', '0');

        $this->db->like('dob', '-' . $month . '-', 'both');

        $this->db->order_by("lastname", "asc");
        $query = $this->db->get();

        return $query->result();
    }

    // get both id and names (active or graduated)
    function get_all_children_list()
    {
        $this->db->from($this->table);
        $this->db->where('removed', '0');
        $this->db->order_by("lastname", "asc");
        $query = $this->db->get();

        return $query->result();
    }

    function get_child_id($lastname, $firstname, $middlename)
    {
        $this->db->select('child_id');
        $this->db->from($this->table);
        $this->db->where('lastname',$lastname);
        $this->db->where('firstname',$firstname);
        $this->db->where('middlename',$middlename);
        $query = $this->db->get();

        $row = $query->row();

        return $row->child_id;
    }

    function get_child_fullname($child_id)
    {
        $this->db->select('lastname, firstname, middlename');
        $this->db->from($this->table);
        $this->db->where('child_id',$child_id);
        
        $query = $this->db->get();

        $row = $query->row();

        return $row->lastname . ', ' . $row->firstname . ' ' . $row->middlename;
    }

    public function count_gender_active($gender)
    {
        $this->db->from($this->table);

        // get only records that are not currently removed
        $this->db->where('graduated', '0');
        $this->db->where('removed', '0');
        $this->db->where('sex', $gender);
        return $this->db->count_all_results();
    }

    public function count_gender_graduated($gender)
    {
        $this->db->from($this->table);

        // get only records that are not currently removed and already graduated
        $this->db->where('graduated', '1');
        $this->db->where('removed', '0');
        $this->db->where('sex', $gender);
        return $this->db->count_all_results();
    }

    public function get_registered_today($date)
    {
        $this->db->select('COUNT(child_id) AS child_id');

        $this->db->from($this->table);
        $this->db->where('date_registered', $date);
        $this->db->where('removed', '0');

        $query = $this->db->get();

        $data['registered_count'] = $query->row()->child_id;

        return $data;
    }    

    // get barangay with most number of registered child
    public function get_top_barangay()
    {
        $this->db->select('COUNT(barangay_id) AS barangay_count, barangay_id');

        $this->db->from($this->table);
        $this->db->where('removed', '0');

        $this->db->group_by("barangay_id");
        $this->db->order_by("barangay_count", "desc");
        $this->db->limit(1);

        $query = $this->db->get();

        $data['top_barangay'] = $query->row()->barangay_id;
        $data['barangay_count'] = $query->row()->barangay_count;

        return $data;
    }

    // get number of children registered by month
    public function get_monthly_registrations($month, $year)
    {
        $this->db->select('COUNT(child_id) AS child_count');    
        
        $this->db->from($this->table);

        $date_from = $year . '-' . $month . '-01';
        $date_to = $year . '-' . $month . '-31';

        $this->db->where('date_registered >=', $date_from);
        $this->db->where('date_registered <=', $date_to);
        $this->db->where('removed', '0');
        
        $query = $this->db->get();

        $data['child_count'] = $query->row()->child_count;

        return $data;
    }
 
    public function get_by_id($child_id)
    {
        $this->db->from($this->table);
        $this->db->where('child_id',$child_id);
        $query = $this->db->get();
 
        return $query->row();
    }
 
    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
 
    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    // public function graduate_child($where, $data)
    // {
    //     $this->db->update($this->table, $data, $where);
    //     return $this->db->affected_rows();
    // }

}