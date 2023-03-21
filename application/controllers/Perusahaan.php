<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Perusahaan extends BaseController
{
    /**
     * This is default constructor of the class
     */
    
    public function __construct(){
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('crud_model');
        // $this->load->model('transaksi_model');
        $this->isLoggedIn();   
    }

    public function index(){
        redirect('Dataperusahaan');
    }

    public function dataperusahaan(){
        $this->global['pageTitle'] = 'Data perusahaan';
        $data['list_data'] = $this->crud_model->tampil_data('tbl_perusahaan');
        $this->loadViews("perusahaan/data", $this->global, $data , NULL);
    }

    public function tambahdata(){
        $this->global['pageTitle'] = 'Tambah perusahaan';

        $this->loadViews("perusahaan/tambah_perusahaan", $this->global , NULL);
    }

    public function simpan(){
        $this->form_validation->set_rules('nama_perusahaan','Nama perusahaan','required');
    
        if($this->form_validation->run() == TRUE)
        {
          $nama_perusahaan      = $this->input->post('nama_perusahaan',TRUE);
          $alamat_perusahaan      = $this->input->post('alamat_perusahaan',TRUE);

    
          $data = array(
                'nama_perusahaan'      => $nama_perusahaan,
                'alamat_perusahaan'      => $alamat_perusahaan,
          );
          $this->crud_model->input($data,'tbl_perusahaan');
    
          $this->session->set_flashdata('msg_berhasil','Data Barang Berhasil Ditambahkan');
          redirect('Dataperusahaan');
        }else {
            $this->session->set_flashdata('msg_gagal','Data Gagal Ditambahkan, periksa kembali');
            redirect(base_url('perusahaan/tambahdata'));
        }
	}

    public function detail($id_perusahaan){
        $this->global['pageTitle'] = 'Edit Data perusahaan';

        $where = array('id_perusahaan' => $id_perusahaan);

        $data['id_perusahaan'] = $this->uri->segment(3);
        $data['list_data'] = $this->crud_model->Getdata($where,'tbl_perusahaan');
        $this->loadViews("perusahaan/detail", $this->global, $data , NULL);        
    }

    public function update(){

        $id_perusahaan      = $this->uri->segment(3);
        $nama_perusahaan      = $this->input->post('nama_perusahaan',TRUE);
        $alamat_perusahaan      = $this->input->post('alamat_perusahaan',TRUE);

  
        $data = array(
              'nama_perusahaan'      => $nama_perusahaan,
              'alamat_perusahaan'      => $alamat_perusahaan,
        );

        $where = array('id_perusahaan' => $id_perusahaan);

        $this->crud_model->update($where,$data,'tbl_perusahaan');
  
        $this->session->set_flashdata('msg_berhasil','Data Berhasil Diubah');
        redirect('perusahaan/detail/' . $id_perusahaan);
    }

    public function delete($id_perusahaan){
      $where = array('id_perusahaan' => $id_perusahaan);
      $this->crud_model->delete($where , 'tbl_perusahaan');
      redirect(base_url('perusahaan'));
    }
}