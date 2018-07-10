<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Attendance_model extends CI_Model {
 
    var $table = 'attendance';

    //var $column_order = array('monthly_id','child_id','child_id','month','year','date','height','weight','encoded',null); //set 

    //var $column_search = array('monthly_id','child_id','child_id','month','year','date','height','weight','encoded'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    //var $order = array('monthly_id' => 'desc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    // private function _get_datatables_query()
    // {
         
    //     $this->db->from($this->table);
 
    //     $i = 0;
     
    //     foreach ($this->column_search as $item) // loop column 
    //     {
    //         if($_POST['search']['value']) // if datatable send POST for search
    //         {
                 
    //             if($i===0) // first loop
    //             {
    //                 $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
    //                 $this->db->like($item, $_POST['search']['value']);
    //             }
    //             else
    //             {
    //                 $this->db->or_like($item, $_POST['search']['value']);
    //             }
 
    //             if(count($this->column_search) - 1 == $i) //last loop
    //                 $this->db->group_end(); //close bracket
    //         }
    //         $i++;
    //     }
         
    //     if(isset($_POST['order'])) // here order processing
    //     {
    //         $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    //     } 
    //     else if(isset($this->order))
    //     {
    //         $order = $this->order;
    //         $this->db->order_by(key($order), $order[key($order)]);
    //     }
    // }
 
    // function get_datatables()
    // {        
    //     $this->_get_datatables_query();
    //     if($_POST['length'] != -1)
    //     $this->db->limit($_POST['length'], $_POST['start']);

    //     $query = $this->db->get();
    //     return $query->result();
    // }
    // get active days of the child (since the day of first present up to date_graduated or last active day)
    function get_active_days_count($first_date_present, $date_graduated, $last_active_date)
    {
        $this->db->select('COUNT(DISTINCT date) AS date');
        
        $this->db->from($this->table);

        $this->db->where('date >=', $first_date_present);

        if ($date_graduated != 'n/a')
        {
            $this->db->where('date <=', $date_graduated);    
        }
        else
        {
            $this->db->where('date <=', $last_active_date);   
        }


        $query = $this->db->get();

        $row = $query->row();

        return $row->date;
    }

    // get anc last active date (last date that has atleast 1 child present)
    function get_last_active_date()
    {
        $this->db->select_max('date');
        $this->db->from($this->table);

        $query = $this->db->get();

        $row = $query->row();

        return $row->date;
    }

    // get child first day present
    function get_first_date_present($child_id)
    {
        $this->db->select_min('date');
        $this->db->from($this->table);

        $this->db->where('child_id',$child_id);

        $query = $this->db->get();

        $row = $query->row();

        return $row->date;
    }

    // get days present by counting the number distinct dates in the attendance
    function get_days_present($child_id)
    {
        $this->db->select('COUNT(DISTINCT date) AS date');
        
        $this->db->from($this->table);

        $this->db->where('child_id',$child_id);

        $query = $this->db->get();

        $row = $query->row();

        return $row->date;
    }     

    // check child attendance in the database
    function get_attendance($child_id, $date)
    {
        
        $this->db->from($this->table);
        $this->db->where('child_id',$child_id);
        $this->db->where('date',$date);

        $query = $this->db->get();

        return $query;
    }

    // check for attendance in the database table for validation
    function get_present_count($date)
    {
        
        $this->db->from($this->table);
        $this->db->where('date',$date);

        $query = $this->db->get();

        return $query;
    }

    // get both id and names
    // function get_children_list()
    // {
    //     $this->db->from($this->table);
    //     $this->db->where('graduated','0');
    //     $this->db->where('removed', '0');
    //     $this->db->order_by("lastname", "asc");
    //     $query = $this->db->get();

    //     return $query->result();
    // }

    // function get_child_id($lastname, $firstname, $middlename)
    // {
    //     $this->db->select('child_id');
    //     $this->db->from($this->table);
    //     $this->db->where('lastname',$lastname);
    //     $this->db->where('firstname',$firstname);
    //     $this->db->where('middlename',$middlename);
    //     $query = $this->db->get();

    //     $row = $query->row();

    //     return $row->child_id;
    // }

    // function get_child_fullname($child_id)
    // {
    //     $this->db->select('lastname, firstname, middlename');
    //     $this->db->from($this->table);
    //     $this->db->where('child_id',$child_id);
        
    //     $query = $this->db->get();

    //     $row = $query->row();

    //     return $row->lastname . ', ' . $row->firstname . ' ' . $row->middlename;
    // }
 
    // function count_filtered()
    // {
    //     $this->_get_datatables_query();

    //     $query = $this->db->get();
    //     return $query->num_rows();
    // }
 
    // public function count_all()
    // {
    //     $this->db->from($this->table);

    //     return $this->db->count_all_results();
    // }
 
    // public function get_by_id($monthly_id)
    // {
    //     $this->db->from($this->table);
    //     $this->db->where('monthly_id',$monthly_id);
    //     $query = $this->db->get();
 
    //     return $query->row();
    // }
 
    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    // delete attendance data using child_id and date
    public function delete_by_id($child_id, $date)
    {
        $this->db->where('child_id', $child_id);
        $this->db->where('date', $date);
        $this->db->delete($this->table);
    }
}