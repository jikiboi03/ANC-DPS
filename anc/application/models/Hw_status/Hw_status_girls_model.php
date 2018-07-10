<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Hw_status_girls_model extends CI_Model {
 
    var $table = 'girls_status';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    
    // get status/catehory data by age in months
    public function get_by_age_months($age)
    {
        $this->db->from($this->table);
        $this->db->where('age',$age);
        $query = $this->db->get();
 
        return $query->row();
    }

 
    // get status/catehory data by age in months
    public function get_all_status_data()
    {
        $this->db->from($this->table);
        $query = $this->db->get();

        
    
        return $query->result();
    } 
}