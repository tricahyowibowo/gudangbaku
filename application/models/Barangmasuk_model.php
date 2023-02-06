<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Barangmasuk_model extends CI_Model
{
  public function get_data($tabel,$where)
  {
    $query = $this->db->select()
                      ->from($tabel)
                      ->where($where)
                      ->get();
    return $query->result();
  }
}