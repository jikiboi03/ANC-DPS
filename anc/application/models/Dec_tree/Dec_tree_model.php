<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Dec_tree_model extends CI_Model {
 
    var $table = 'dec_tree';

 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    
    // get decision tree data (it has single row only)
    public function get_data()
    {
        $this->db->from($this->table);
        $this->db->where('dec_tree_id','1');
        $query = $this->db->get();
 
        return $query->row();
    }
}