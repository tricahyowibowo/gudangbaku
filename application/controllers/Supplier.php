<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Supplier extends BaseController
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
        redirect('Datasupplier');
    }

    public function datasupplier(){
        $this->global['pageTitle'] = 'Data supplier';
        $data['list_data'] = $this->crud_model->tampil_data('tbl_supplier');
        $this->loadViews("supplier/data", $this->global, $data , NULL);
    }

    public function tambahdata(){
        $this->global['pageTitle'] = 'Tambah supplier';

        $this->loadViews("supplier/tambah_supplier", $this->global , NULL);
    }

    public function simpan(){
        $this->form_validation->set_rules('nama_supplier','nama supplier','required');
        $this->form_validation->set_rules('alamat_supplier','alamat supplier','required');

    
        if($this->form_validation->run() == TRUE)
        {
          $nama_supplier      = $this->input->post('nama_supplier',TRUE);
          $alamat_supplier      = $this->input->post('alamat_supplier',TRUE);

    
          $data = array(
                'nama_supplier'      => $nama_supplier,
                'alamat_supplier'      => $alamat_supplier,
          );
          $this->crud_model->input($data,'tbl_supplier');
    
          $this->session->set_flashdata('msg_berhasil','Data Barang Berhasil Ditambahkan');
          redirect('Datasupplier');
        }else {
            $this->session->set_flashdata('msg_gagal','Data Gagal Ditambahkan, periksa kembali');
            redirect(base_url('supplier/tambahdata'));
        }
	}

    public function detail($id_supplier){
        $this->global['pageTitle'] = 'Edit Data supplier';
        

        $where = array('id_supplier' => $id_supplier);

        $data['id_supplier'] = $this->uri->segment(3);

        $data['list_data'] = $this->crud_model->Getdata($where,'tbl_supplier');
        $this->loadViews("supplier/detail", $this->global, $data , NULL);        
    }

    public function update(){
        $id_supplier      = $this->uri->segment(3);
        $nama_supplier      = $this->input->post('nama_supplier',TRUE);
        $alamat_supplier      = $this->input->post('alamat_supplier',TRUE);

  
        $data = array(
              'nama_supplier'      => $nama_supplier,
              'alamat_supplier'      => $alamat_supplier,
        );

        $where = array('id_supplier' => $id_supplier);

        $this->crud_model->update($where,$data,'tbl_supplier');
  
        $this->session->set_flashdata('msg_berhasil','Data Berhasil Diubah');
        redirect('supplier/detail/' . $id_supplier);
    }

    public function delete($id_supplier){
      $where = array('id_supplier' => $id_supplier);
      $this->crud_model->delete($where , 'tbl_supplier');
      redirect(base_url('supplier'));
    }
}