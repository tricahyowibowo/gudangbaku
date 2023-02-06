<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class bahanbaku_model extends CI_Model
{

// .DATABASE DATA MASUK
  public function GetDataGudang(){
    $this->db->select('a.id_barang_masuk, a.no_nota, a.kode_barang, d.nama_bahan, a.seri, b.nama_perusahaan, c.nama_supplier, SUM(a.jml_barang) as jml_barang, a.satuan_kode, a.tgl_masuk_barang, a.coa, a.tgl_coa, a.halal, a.tgl_halal, a.expired_date, a.batch, a.status');
    $this->db->from('tbl_barang_masuk a');
    $this->db->join('tbl_perusahaan b','b.id_perusahaan = a.status_barang');
    $this->db->join('tbl_supplier c','c.id_supplier=a.supplier_id');
    $this->db->join('tbl_bahan d','d.kode_bahan=a.kode_barang');
    $this->db->where('status','release');
    $this->db->group_by('no_nota');

    $query = $this->db->get();

    $result = $query->result();
    return $result; 
  }

  public function GetDataRelease(){
    $this->db->select('a.id_barang_masuk, a.no_nota, a.kode_barang, d.nama_bahan, b.nama_perusahaan, c.nama_supplier, SUM(a.jml_barang) as jml_barang, a.satuan_kode, a.tgl_masuk_barang, a.coa, a.tgl_coa, a.halal, a.tgl_halal, a.expired_date, a.batch, a.seri, a.status');
    $this->db->from('tbl_barang_masuk a');
    $this->db->join('tbl_perusahaan b','b.id_perusahaan = a.status_barang');
    $this->db->join('tbl_supplier c','c.id_supplier=a.supplier_id');
    $this->db->join('tbl_bahan d','d.kode_bahan=a.kode_barang');
    $this->db->where('status','release');
    $this->db->group_by('kode_barang');

    $query = $this->db->get();

    $result = $query->result();
    return $result; 
  }
  
  public function Getdatakarantinagudang(){
    $this->db->select('a.id_barang_masuk, a.no_nota, d.nama_bahan, b.nama_perusahaan, c.nama_supplier, a.jml_barang, a.satuan_kode, a.tgl_masuk_barang, a.coa, a.tgl_coa, a.halal, a.tgl_halal, a.expired_date, a.batch, a.seri, a.status');
    $this->db->from('tbl_barang_masuk a');
    $this->db->join('tbl_perusahaan b','b.id_perusahaan = a.status_barang');
    $this->db->join('tbl_supplier c','c.id_supplier=a.supplier_id');
    $this->db->join('tbl_bahan d','d.kode_bahan=a.kode_barang');
    $this->db->where('status','karantina');
    $this->db->group_by('no_nota');
    
    $query = $this->db->get();

    $result = $query->result();
    return $result; 
  }

  public function GetDataKarantinaById($id){
    $this->db->select('a.id_barang_masuk, a.no_nota, a.kode_barang, d.nama_bahan, b.nama_perusahaan, c.nama_supplier, a.jml_barang, a.satuan_kode, a.tgl_masuk_barang, a.coa, a.tgl_coa, a.halal, a.tgl_halal, a.expired_date, a.seri, a.batch, a.status');
    $this->db->from('tbl_barang_masuk a');
    $this->db->join('tbl_perusahaan b','b.id_perusahaan = a.status_barang');
    $this->db->join('tbl_supplier c','c.id_supplier=a.supplier_id');
    $this->db->join('tbl_bahan d','d.kode_bahan=a.kode_barang');
    $this->db->where('status','karantina');
    $this->db->where('no_nota',$id);
    $this->db->group_by('a.no_nota');
    
    $query = $this->db->get();

    $result = $query->result();
    return $result; 
  }

  public function GetdatagudangByNota($id){
    $this->db->select('a.id_barang_masuk, a.no_nota, a.kode_barang, d.nama_bahan, b.nama_perusahaan, c.nama_supplier, a.jml_barang as jml_barang, a.satuan_kode, a.tgl_masuk_barang, a.coa, a.tgl_coa, a.halal, a.tgl_halal, a.expired_date, a.seri, a.batch, a.status');
    $this->db->from('tbl_barang_masuk a');
    $this->db->join('tbl_perusahaan b','b.id_perusahaan = a.status_barang');
    $this->db->join('tbl_supplier c','c.id_supplier=a.supplier_id');
    $this->db->join('tbl_bahan d','d.kode_bahan=a.kode_barang');
    $this->db->where('no_nota',$id);
    $this->db->group_by('a.no_nota');

    $query = $this->db->get();
    $result = $query->result();
    return $result; 
  }

  public function GetdatagudangKodeBarang($id){
    $this->db->select('a.id_barang_masuk, a.no_nota, a.kode_barang, d.nama_bahan, b.nama_perusahaan, c.nama_supplier, a.jml_barang, a.satuan_kode, a.tgl_masuk_barang, a.coa, a.tgl_coa, a.halal, a.tgl_halal, a.expired_date, a.seri, a.batch, a.status');
    $this->db->from('tbl_barang_masuk a');
    $this->db->join('tbl_perusahaan b','b.id_perusahaan = a.status_barang');
    $this->db->join('tbl_supplier c','c.id_supplier=a.supplier_id');
    $this->db->join('tbl_bahan d','d.kode_bahan=a.kode_barang');
    $this->db->where('status','release');
    $this->db->where('kode_barang',$id);
    $query = $this->db->get();

    $result = $query->result();
    return $result; 
  }

  public function GetSumDataGudang(){
    $this->db->select('a.id_barang_masuk, a.no_nota, a.kode_barang, d.nama_bahan, b.nama_perusahaan, c.nama_supplier, SUM(a.jml_barang) as jml_barang, a.satuan_kode, a.tgl_masuk_barang, a.coa, a.tgl_coa, a.halal, a.tgl_halal, a.expired_date, a.seri, a.batch, a.status');
    $this->db->from('tbl_barang_masuk a');
    $this->db->join('tbl_perusahaan b','b.id_perusahaan = a.status_barang');
    $this->db->join('tbl_supplier c','c.id_supplier=a.supplier_id');
    $this->db->join('tbl_bahan d','d.kode_bahan=a.kode_barang');
    $this->db->where('status','release');
    
    $query = $this->db->get();

    $result = $query->result();
    return $result; 
  }
// ./DATABASE DATA MASUK

// .DATABASE DATA KELUAR

  public function cekstok($id){
    $this->db->select('a.id_barang_masuk, a.no_nota, a.kode_barang, a.seri, d.nama_bahan, b.nama_perusahaan, c.nama_supplier, SUM(a.jml_barang) as jml_barang, a.satuan_kode, a.tgl_masuk_barang, a.coa, a.tgl_coa, a.halal, a.tgl_halal, a.expired_date, a.batch, a.status');
    $this->db->from('tbl_barang_masuk a');
    $this->db->join('tbl_perusahaan b','b.id_perusahaan = a.status_barang');
    $this->db->join('tbl_supplier c','c.id_supplier=a.supplier_id');
    $this->db->join('tbl_bahan d','d.kode_bahan=a.kode_barang');
    $this->db->where('status','release');
    // $this->db->where('jml_barang != 0');
    $this->db->where('id_barang_masuk',$id);

    $query = $this->db->get();

    $result = $query->result();
    return $result; 
  }

  public function cekstokByKode($kode , $id){
    $this->db->select('a.id_barang_masuk, a.no_nota, a.kode_barang, a.seri, d.nama_bahan, b.nama_perusahaan, c.nama_supplier, a.jml_barang, a.satuan_kode, a.tgl_masuk_barang, a.coa, a.tgl_coa, a.halal, a.tgl_halal, a.expired_date, a.batch, a.status');
    $this->db->from('tbl_barang_masuk a');
    $this->db->join('tbl_perusahaan b','b.id_perusahaan = a.status_barang');
    $this->db->join('tbl_supplier c','c.id_supplier=a.supplier_id');
    $this->db->join('tbl_bahan d','d.kode_bahan=a.kode_barang');
    $this->db->where('status','release');
    $this->db->where('jml_barang != 0');
    $this->db->where('id_barang_masuk !=',$id);
    $this->db->where('kode_barang',$kode);
    $this->db->order_by('expired_date','DESC');

    $query = $this->db->get();

    $result = $query->result();
    return $result; 
  }
  
  public function GetDataGudangKeluar(){
    $this->db->select('a.id_barang_keluar, a.nota_keluar, a.status_barang, a.tgl_keluar, a.barang_id, a.bagian, e.nama_bagian, a.satuan_kode, a.permintaan, a.pengeluaran, d.nama_bahan, b.nama_perusahaan, c.id_barang_masuk');
    $this->db->from('tbl_barang_keluar a');
    $this->db->join('tbl_perusahaan b','b.id_perusahaan = a.status_barang');
    $this->db->join('tbl_barang_masuk c','c.id_barang_masuk = a.barang_id');
    $this->db->join('tbl_bahan d','d.kode_bahan=c.kode_barang');
    $this->db->join('tbl_bagian e','e.id_bagian=a.bagian');
    $this->db->group_by('nota_keluar');

    $query = $this->db->get();

    $result = $query->result();
    return $result; 
  }

  public function GetTanggalKeluar($bagian=0, $tgl_awal=0,$tgl_akhir=0){
    $this->db->select('*');
    $this->db->from('tbl_barang_keluar a');
    $this->db->group_by('tgl_keluar');
    $this->db->order_by('tgl_keluar','ASC');

    if($bagian != 0 ){
      $this->db->where('a.bagian', $bagian);
    }
  
    if($tgl_awal != 0 && $tgl_akhir != 0 ){
      $this->db->where('a.tgl_keluar >=', $tgl_awal);
      $this->db->where('a.tgl_keluar <=', $tgl_akhir);
    }else{
        $this->db->where('MONTH(a.tgl_keluar)',date('m'));
        $this->db->where('YEAR(a.tgl_keluar)',date('Y'));
    }

    $query = $this->db->get();
    $result = $query->result();
    return $result; 
  }

  public function GetLaporanGudangKeluar($bagian=0, $tgl_awal=0,$tgl_akhir=0){
  $this->db->select('a.id_barang_keluar, a.nota_keluar, a.status_barang, a.tgl_keluar, a.barang_id, a.bagian, e.nama_bagian, a.satuan_kode, a.permintaan, a.pengeluaran, d.nama_bahan, b.nama_perusahaan, c.id_barang_masuk, c.kode_barang, c.expired_date, c.seri, c.batch');
  $this->db->from('tbl_barang_keluar a');
  $this->db->join('tbl_perusahaan b','b.id_perusahaan = a.status_barang');
  $this->db->join('tbl_barang_masuk c','c.id_barang_masuk = a.barang_id');
  $this->db->join('tbl_bahan d','d.kode_bahan=c.kode_barang');
  $this->db->join('tbl_bagian e','e.id_bagian=a.bagian');
  // $this->db->group_by('tgl_keluar');
  $this->db->order_by('tgl_keluar','ASC');

  if($bagian != 0 ){
    $this->db->where('a.bagian', $bagian);
  }

  if($tgl_awal != 0 && $tgl_akhir != 0 ){
    $this->db->where('a.tgl_keluar >=', $tgl_awal);
    $this->db->where('a.tgl_keluar <=', $tgl_akhir);
  }else{
      $this->db->where('MONTH(a.tgl_keluar)',date('m'));
      $this->db->where('YEAR(a.tgl_keluar)',date('Y'));
  }
    $query = $this->db->get();
    $result = $query->result();
    return $result; 
  }
  
  public function GetDataGudangKeluarById($id){
    $this->db->select('a.id_barang_keluar, a.nota_keluar, a.status_barang, a.tgl_keluar, a.barang_id, a.bagian, e.nama_bagian, a.satuan_kode, a.permintaan, a.pengeluaran, d.nama_bahan, b.nama_perusahaan, c.id_barang_masuk, c.expired_date, c.batch, c.seri');
    $this->db->from('tbl_barang_keluar a');
    $this->db->join('tbl_perusahaan b','b.id_perusahaan = a.status_barang');
    $this->db->join('tbl_barang_masuk c','c.id_barang_masuk = a.barang_id');
    $this->db->join('tbl_bahan d','d.kode_bahan=c.kode_barang');
    $this->db->join('tbl_bagian e','e.id_bagian=a.bagian');
    $this->db->where('nota_keluar',$id);
    $this->db->group_by('nota_keluar');

    $query = $this->db->get();

    $result = $query->result();
    return $result; 
  }

  public function GetDetailGudangKeluar($id){
    $this->db->select('a.id_barang_keluar, a.nota_keluar, a.status_barang, a.tgl_keluar, a.barang_id, a.bagian, e.nama_bagian, a.satuan_kode, a.permintaan, a.pengeluaran, d.nama_bahan, b.nama_perusahaan, c.id_barang_masuk, c.expired_date, c.batch, c.seri');
    $this->db->from('tbl_barang_keluar a');
    $this->db->join('tbl_perusahaan b','b.id_perusahaan = a.status_barang');
    $this->db->join('tbl_barang_masuk c','c.id_barang_masuk = a.barang_id');
    $this->db->join('tbl_bahan d','d.kode_bahan=c.kode_barang');
    $this->db->join('tbl_bagian e','e.id_bagian=a.bagian');
    $this->db->where('nota_keluar',$id);
    

    $query = $this->db->get();

    $result = $query->result();
    return $result; 
  }
// ./DATABASE DATA KELUAR
}