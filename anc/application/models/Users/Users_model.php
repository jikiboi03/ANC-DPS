<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {

	var $table = 'users';
	var $column_order = array('user_id','user_type','username','lastname','firstname','middlename','date_registered', null); //set column field database for datatable orderable
	var $column_search = array('user_id','username','lastname','firstname','middlename'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('user_id' => 'desc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		
		$this->db->from($this->table);
		//$this->db->where('removed', 0);

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

		// get only records that are not currently removed
        $this->db->where('removed', '0');
		$query = $this->db->get();
		return $query->result();
	}

	// check for duplicates in the database table for validation - fullname
    function get_duplicates($lastname, $firstname, $middlename)
    {
        $this->db->from($this->table);
        $this->db->where('lastname',$lastname);
        $this->db->where('firstname',$firstname);
        $this->db->where('middlename',$middlename);

        $query = $this->db->get();

        return $query;
    }

    // check for duplicates in the database table for validation - username
    function get_username_duplicates($username)
    {
        $this->db->from($this->table);
        $this->db->where('username',$username);

        $query = $this->db->get();

        return $query;
    }

    // check for admin count (administrator is '1')
    function get_admin_count()
    {
        $this->db->from($this->table);
        $this->db->where('administrator','1');

        $query = $this->db->get();

        return $query;
    }

	function count_filtered()
	{
		$this->_get_datatables_query();

		// get only records that are not currently removed
        $this->db->where('removed', '0');
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);

		// get only records that are not currently removed
        $this->db->where('removed', '0');
		return $this->db->count_all_results();
	}

	public function get_by_id($user_id)
	{
		$this->db->from($this->table);
		$this->db->where('user_id',$user_id);
		$query = $this->db->get();

		return $query->row();
	}

	// check if the user is administrator ('1')
	public function get_user_admin($user_id)
	{
		$this->db->select('administrator');
		$this->db->from($this->table);
		$this->db->where('user_id',$user_id);
		$query = $this->db->get();

		$row = $query->row();

		return $row->administrator;
	}

	// get username
	public function get_username($user_id)
	{
		$this->db->select('username');
		$this->db->from($this->table);
		$this->db->where('user_id',$user_id);
		$query = $this->db->get();

		$row = $query->row();

		return $row->username;
	}

    // check if the user is administrator ('1')
	public function get_user_lastname($user_id)
	{
		$this->db->select('lastname');
		$this->db->from($this->table);
		$this->db->where('user_id',$user_id);
		$query = $this->db->get();

		$row = $query->row();

		return $row->lastname;
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
