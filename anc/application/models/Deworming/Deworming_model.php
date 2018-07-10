<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Deworming_model extends CI_Model {
 
    var $table = 'deworming';

    // var $column_order = array('deworming_id','child_id','lastname','firstname','middlename','period','year','date','time','height','weight','appetite','water','bowel','hair','finger','teeth','skin','eyes','nose','ears','comments','illness','concerns','encoded'); //set column field database for datatable orderable
    var $column_order = array('deworming_id','child_id','child_id','period','year','date','encoded',null); //set 

    var $column_search = array('deworming_id','child_id','child_id','period','year','date','encoded'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('deworming_id' => 'desc'); // default order 
 
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

        $query = $this->db->get();
        return $query->result();
    }

    // check for duplicates in the database table for validation
    function get_duplicates($child_id, $period, $year)
    {
        
        $this->db->from($this->table);
        $this->db->where('child_id',$child_id);
        $this->db->where('period',$period);
        $this->db->where('year',$year);

        $query = $this->db->get();

        return $query;
    }

    // get child_id that were checked up for the past sem
    public function get_child_deworming($previous_sem, $year)
    {     
        $this->db->from($this->table);

        $this->db->where('period =', $previous_sem);
        $this->db->where('year =', $year);
        
        $query = $this->db->get();

        return $query->result();
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
 
    function count_filtered()
    {
        $this->_get_datatables_query();

        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);

        return $this->db->count_all_results();
    }
 
    public function get_by_id($deworming_id)
    {
        $this->db->from($this->table);
        $this->db->where('deworming_id',$deworming_id);
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

    // delete deworming data
    public function delete_by_id($deworming_id)
    {
        $this->db->where('deworming_id', $deworming_id);
        $this->db->delete($this->table);
    }
}