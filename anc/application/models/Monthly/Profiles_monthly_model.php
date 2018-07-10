<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Profiles_monthly_model extends CI_Model {
 
    var $table = 'monthly';

    // var $column_order = array('monthly_id','child_id','lastname','firstname','middlename','period','year','date','time','height','weight','appetite','water','bowel','hair','finger','teeth','skin','eyes','nose','ears','comments','illness','concerns','encoded'); //set column field database for datatable orderable
    var $column_order = array('monthly_id','period','year','date','encoded',null); //set 

    var $column_search = array('monthly_id','period','year','date','encoded'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('monthly_id' => 'desc'); // default order 
 
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
 
    function get_datatables($child_id)
    {        
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);

        // get only records of the assigned child_id
        $this->db->where('child_id', $child_id);

        $query = $this->db->get();
        return $query->result();
    }

    // check for duplicates in the database table for validation
    function get_duplicates($child_id, $month, $year)
    {
        
        $this->db->from($this->table);
        $this->db->where('child_id',$child_id);
        $this->db->where('month',$month);
        $this->db->where('year',$year);

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
 
    function count_filtered($child_id)
    {
        $this->_get_datatables_query();

        // get only records of the assigned child_id
        $this->db->where('child_id', $child_id);

        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all($child_id)
    {
        $this->db->from($this->table);

        // get only records of the assigned child_id
        $this->db->where('child_id', $child_id);

        return $this->db->count_all_results();
    }
 
    public function get_by_id($monthly_id)
    {
        $this->db->from($this->table);
        $this->db->where('monthly_id',$monthly_id);
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

    // delete monthly data
    public function delete_by_id($monthly_id)
    {
        $this->db->where('monthly_id', $monthly_id);
        $this->db->delete($this->table);
    }
}