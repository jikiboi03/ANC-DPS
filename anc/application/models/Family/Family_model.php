<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Family_model extends CI_Model {
 
    var $table = 'family';
    
    var $column_order = array('family_id','name','relation','age','sex','status','education','occupation','income'); //set column field database for datatable orderable
    var $column_search = array('family_id','name','relation','age','sex','status','education','occupation','income'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('family_id' => 'desc'); // default order 
 
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

    // get both id and names of family member by child_id
    function get_family_list($child_id)
    {
        $this->db->from($this->table);
        
        // get only records of the assigned child_id
        $this->db->where('child_id', $child_id);

        $query = $this->db->get();

        return $query->result();
    }

    // count_filtered and count_all by assigned child_id to get family members
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

    public function count_all_members()
    {
        $this->db->from($this->table);

        return $this->db->count_all_results();
    }

    // count all children that has family
    public function count_child_family()
    {
        $this->db->select('COUNT(DISTINCT child_id) AS child_id, SUM(income) AS income');

        $this->db->from($this->table);

        $query = $this->db->get();

        $data['child_id'] = $query->row()->child_id;
        $data['income'] = $query->row()->income;

        return $data;
    }    
 
    // get family member's data
    public function get_by_id($family_id)
    {
        $this->db->from($this->table);
        $this->db->where('family_id',$family_id);
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

    // delete family member's data
    public function delete_by_id($family_id)
    {
        $this->db->where('family_id', $family_id);
        $this->db->delete($this->table);
    }
}