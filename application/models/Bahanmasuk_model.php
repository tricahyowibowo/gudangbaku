<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Bahanmasuk_model extends CI_Model
{
  public function Getdatagudang(){
    $this->db->select('a.id_bahan_masuk, a.no_nota, d.nama_bahan, b.nama_perusahaan, c.nama_supplier, a.jml_bahan, a.satuan_kode, a.tgl_masuk_bahan, a.coa, a.tgl_coa, a.halal, a.tgl_halal, a.expired_date, a.batch, a.status');
    $this->db->from('tbl_bahan_masuk a');
    $this->db->join('tbl_perusahaan b','b.id_perusahaan = a.status_bahan');
    $this->db->join('tbl_supplier c','c.id_supplier=a.supplier_id');
    $this->db->join('tbl_bahan d','d.kode_bahan=a.kode_bahan');

    $query = $this->db->get();

    $result = $query->result();
    return $result;
}
}