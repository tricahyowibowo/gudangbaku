<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Barangmasuk extends BaseController
{
  /**
   * This is default constructor of the class
   */
  public function __construct(){
      parent::__construct();
      $this->load->model('user_model');
      $this->load->model('crud_model');
      $this->load->model('barangmasuk_model');
      $this->load->model('bahanbaku_model');
      $this->isLoggedIn();   
  }

  public function index(){
      redirect('barangmasuk/tabel_barangmasuk');
  }

  public function tabel_barangmasuk(){
    $this->global['pageTitle'] = 'Data Barang Masuk';

    $data = array(
      'list_data'       => $this->crud_model->tampil_data('tb_barang_masuk'),
      'list_bahan'     => $this->crud_model->tampil_data('tbl_bahan'),
      'list_supplier'     => $this->crud_model->tampil_data('tbl_supplier'),
      'list_karantina'     => $this->bahanbaku_model->Getdatakarantinagudang(),
      'list_gudang'     => $this->bahanbaku_model->GetSumDataGudang(),
      'list_release'        => $this->bahanbaku_model->GetDataRelease(),
      'list_perusahaan' => $this->crud_model->tampil_data('tbl_perusahaan'),
      'list_satuan'     => $this->crud_model->tampil_data('tb_satuan'),
    );
  
    $this->loadViews("barangmasuk/data", $this->global, $data , NULL);
  }


  public function detail_tabel(){
    $this->global['pageTitle'] = 'Detail Barang Masuk';
    $id = $this->uri->segment(3);
    $ceknota = COUNT($this->bahanbaku_model->GetdatagudangByNota($id));

    if ($ceknota != 0){
      $datagudang = $this->bahanbaku_model->GetdatagudangByNota($id);
      foreach ($datagudang as $cek){
        $text = "Sedang pada tahap";
        $status = $cek->status;
        $colorbox = "warning";
      }
    }else{
      $datagudang = $this->bahanbaku_model->GetdatagudangKodeBarang($id);
      foreach ($datagudang as $cek){
        $text = "";
        $status = $cek->status;
        $colorbox = "success";
      }
    }

    $data = array(
      'text'                => $text,
      'colorbox'            => $colorbox,
      'status'              => $status,
      'list_gudang'         => $datagudang,
      'list_detail_gudang'  => $this->bahanbaku_model->GetDataKarantinaById($id),
      'list_data'           => $this->crud_model->tampil_data('tb_barang_masuk'),
      'list_bahan'          => $this->crud_model->tampil_data('tbl_bahan'),
      'list_supplier'       => $this->crud_model->tampil_data('tbl_supplier'),
      'list_karantina'      => $this->bahanbaku_model->Getdatakarantinagudang(),
      'list_perusahaan'     => $this->crud_model->tampil_data('tbl_perusahaan'),
      'list_satuan'         => $this->crud_model->tampil_data('tb_satuan'),
    );
  
    $this->loadViews("barangmasuk/detail", $this->global, $data , NULL);
  }

  public function form_barangmasuk(){
    $this->global['pageTitle'] = 'Tambah Barang Masuk';

    $data['list_satuan'] = $this->crud_model->tampil_data('tb_satuan');
    $this->loadViews("barangmasuk/form_insert", $this->global, $data , NULL);
  
  }

  public function input_data(){
    $no_nota        = $this->input->post('no_nota');
    $status_barang   = $this->input->post('status_barang');
    $tgl_datang     = $this->input->post('tgl_datang');
    $supplier       = $this->input->post('supplier');
    $nama_barang     = $this->input->post('nama_barang');
    $jml_barang      = $this->input->post('jml_barang');
    $satuan_kode    = $this->input->post('satuan_kode');
    $coa            = $this->input->post('coa');
    $tgl_coa        = $this->input->post('tgl_coa');
    $halal          = $this->input->post('halal');
    $tgl_halal      = $this->input->post('tgl_halal');
    $expired_date   = $this->input->post('expired_date');
    $batch          = $this->input->post('batch');
    $seri          = $this->input->post('seri');

    $data = array();
    $index = 0; // Set index array awal dengan 0
    foreach ($no_nota as $no_nota) { // Kita buat perulangan berdasarkan kode transaksi sampai data terakhir

      array_push($data, array(
        'no_nota' => $no_nota,
        'status_barang' => $status_barang[$index],
        'tgl_masuk_barang' => $tgl_datang[$index], 
        'supplier_id' => $supplier[$index], 
        'kode_barang' => $nama_barang[$index],
        'jml_barang' => $jml_barang[$index],
        'satuan_kode' => $satuan_kode[$index],
        'coa' => $coa[$index],
        'tgl_coa' => $tgl_coa[$index],
        'halal' => $halal[$index],
        'tgl_halal' => $tgl_halal[$index],
        'expired_date' => $expired_date[$index],
        'batch' => $batch[$index],
        'seri' => $seri[$index],
      ));  

    $index++;
    }

    $this->db->insert_batch('tbl_barang_masuk', $data);
    $this->session->set_flashdata('msg_berhasil','Data Barang Berhasil Ditambahkan');
    redirect(base_url('barangmasuk'));
  }

  public function release($id){
    $id = $this->uri->segment(3);

    $where['no_nota'] = $id;

    $data['status'] = "release";
    $data['daterelease'] = date('Y-m-d H:i:s');

    $this->crud_model->update($where, $data, 'tbl_barang_masuk');
    $this->session->set_flashdata('msg_berhasil','Data Barang Berhasil Direlease');
    redirect(base_url('barangmasuk'));
  }

  public function formbatalrelease(){
    $this->global['pageTitle'] = 'Form Batal Release';
    $this->loadViews("barangmasuk/form_batal", $this->global, NULL);
  }

  public function batalrelease(){
    $keterangan = $this->input->post('keterangan');
    $id = $this->input->post('id');

    $where['no_nota'] = $id;

    $data = array(
      'status' => "kembali",
      'keterangan'      => $keterangan,
      'daterelease'      => date('Y-m-d H:i:s'),
    );

    $this->crud_model->update($where, $data, 'tbl_barang_masuk');
    $this->session->set_flashdata('msg_berhasil','Data Barang Berhasil Direlease');
    redirect(base_url('barangmasuk'));
  }
  
  public function update_data(){
    $this->form_validation->set_rules('lokasi','Lokasi','required');
    $this->form_validation->set_rules('kode_barang','Kode Barang','required');
    $this->form_validation->set_rules('nama_barang','Nama Barang','required');
    $this->form_validation->set_rules('jumlah','Jumlah','required');

    if($this->form_validation->run() == TRUE)
    {
      $id_transaksi = $this->input->post('id_transaksi',TRUE);
      $tanggal      = $this->input->post('tanggal',TRUE);
      $lokasi       = $this->input->post('lokasi',TRUE);
      $kode_barang  = $this->input->post('kode_barang',TRUE);
      $nama_barang  = $this->input->post('nama_barang',TRUE);
      $satuan       = $this->input->post('satuan',TRUE);
      $jumlah       = $this->input->post('jumlah',TRUE);

      $where = array('id_transaksi' => $id_transaksi);
      $data = array(
            'id_transaksi' => $id_transaksi,
            'tanggal'      => $tanggal,
            'lokasi'       => $lokasi,
            'kode_barang'  => $kode_barang,
            'nama_barang'  => $nama_barang,
            'satuan'       => $satuan,
            'jumlah'       => $jumlah
      );
      $this->crud_model->update($where,$data,'tb_barang_masuk');
      $this->session->set_flashdata('msg_berhasil','Data Barang Berhasil Diupdate');
      redirect('barangmasuk');
    }else{
      $this->load->view('barangmasuk/form_update');
    }
  }

  public function detail_barang($id_transaksi){
    $where = array('id_transaksi' => $id_transaksi);
    
    $data['data_barang_update'] = $this->crud_model->Getdata($where,'tb_barang_masuk');
    $data['list_satuan'] = $this->crud_model->tampil_data('tb_satuan');
    
    
    $this->loadViews("barangmasuk/form_update", $this->global, $data , NULL);
  }

  public function delete_barang($id_transaksi){
    $where = array('id_transaksi' => $id_transaksi);
    $this->crud_model->delete($where , 'tb_barang_masuk');
    redirect(base_url('barangmasuk'));
  }
}