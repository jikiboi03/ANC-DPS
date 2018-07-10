<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class His_model extends CI_Model {
 
    var $table = 'his';
    
    // var $column_order = array('child_id','lastname','firstname','middlename','dob',null,'sex','weight','height','barangay_id',null,'date_registered','encoded'); //set column field database for datatable orderable
    // var $column_search = array('child_id','lastname','firstname','middlename','dob','sex','weight','height','barangay_id','date_registered'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    // var $order = array('child_id' => 'desc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function has_his($child_id)
    {
        $this->db->from($this->table);
        $this->db->where('child_id',$child_id);

        $query = $this->db->get();

        return $query;
    }

    // get latest single child hvi (quarterly) checkups
    function get_child_his($child_id)
    {        
        $this->db->from($this->table);
        $this->db->where('child_id', $child_id);

        $query = $this->db->get();
        return $query->row();
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

    //     // get only records that are not currently removed and graduated
    //     $this->db->where('graduated', '0');
    //     $this->db->where('removed', '0');
    //     $query = $this->db->get();
    //     return $query->result();
    // }

    // check for duplicates in the database table for validation
    // function get_duplicates($lastname, $firstname, $middlename)
    // {
        
    //     $this->db->from($this->table);
    //     $this->db->where('lastname',$lastname);
    //     $this->db->where('firstname',$firstname);
    //     $this->db->where('middlename',$middlename);

    //     $query = $this->db->get();

    //     return $query;
    // }

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

    //     // get only records that are not currently removed
    //     $this->db->where('graduated', '0');
    //     $this->db->where('removed', '0');
    //     $query = $this->db->get();
    //     return $query->num_rows();
    // }
 
    public function count_all()
    {
        $this->db->from($this->table);

        return $this->db->count_all_results();
    }

    // getting the last visit data
    public function get_last_visit()
    {
        $this->db->from($this->table);
        
        $this->db->limit(1);
        $this->db->order_by('his_id',"DESC");
        $query = $this->db->get();

        return $query->row();
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
}