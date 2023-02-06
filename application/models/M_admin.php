<?php

class M_admin extends CI_Model
{

  public function insert($tabel,$data)
  {
    $this->db->insert($tabel,$data);
  }

  public function select($tabel)
  {
    $query = $this->db->get($tabel);
    return $query->result();
  }

  public function cek_jumlah($tabel,$id_transaksi)
  {
    $this->db->select('*');
    $this->db->from($tabel);
    $this->db->where('id_transaksi',$id_transaksi);
    return $this->db->get();

  }

  public function get_data_array($tabel,$id_transaksi)
  {
    $this->db->select();
    $this->db->from($tabel);
    $this->db->where($id_transaksi);

    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_data($tabel,$id_transaksi)
  {
    $this->db->select();
    $this->db->from($tabel);
    $this->db->where($id_transaksi);

    $query =  $this->db->get();
    return $query->result();
  }

  public function update($tabel,$data,$where)
  {
    $this->db->where($where);
    $this->db->update($tabel,$data);
  }

  public function delete($tabel,$where)
  {
    $this->db->where($where);
    $this->db->delete($tabel);
  }

  public function mengurangi($tabel,$id_transaksi,$jumlah)
  {
    $this->db->set("jumlah","jumlah - $jumlah");
    $this->db->where('id_transaksi',$id_transaksi);
    $this->db->update($tabel);
  }

  public function update_password($tabel,$where,$data)
  {
    $this->db->where($where);
    $this->db->update($tabel,$data);
  }

  public function get_data_gambar($tabel,$username)
  {
    $this->db->select();
    $this->db->from($tabel);
    $this->db->where('username_user',$username);
    
    $query = $this->db->get();
    return $query->result();
  }

  public function sum($tabel,$field)
  {
    $this->db->select_sum($field);
    $this->db->from($tabel);

    $query = $this->db->get();
    return $query->result();
  }

  public function numrows($tabel)
  {
    $this->db->select();
    $this->db->from($tabel);

    $query = $this->db->get();
    return $query->num_rows();
  }

  public function kecuali($tabel,$username)
  {
    $this->db->select();
    $this->db->from($tabel);
    $this->db->where_not_in('username',$username);

    $query = $this->db->get();
    return $query->result();
  }
}?>
