<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require FCPATH.'vendor/autoload.php';
require APPPATH . '/libraries/BaseController.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Bahan extends BaseController
{
    /**
     * This is default constructor of the class
     */
    
    public function __construct(){
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('crud_model');
        $this->load->model('bahanbaku_model');
        // $this->load->model('transaksi_model');
        $this->isLoggedIn();   
    }

    public function index(){
        redirect('Databahan');
    }

    public function databahan(){
        $this->global['pageTitle'] = 'Data bahan';
        $data['list_data'] = $this->bahanbaku_model->GetBarang();
        $this->loadViews("bahan/data", $this->global, $data , NULL);
    }

    public function tambahdata(){
        $this->global['pageTitle'] = 'Tambah bahan';

        $data['list_supplier'] = $this->crud_model->tampil_data('tbl_supplier');

        $this->loadViews("bahan/tambah_bahan", $this->global, $data , NULL);
    }

    public function tambahdataexcel(){
        $this->global['pageTitle'] = 'Tambah bahan';

        $this->loadViews("bahan/import_excel", $this->global , NULL);
    }

    public function format_excel()
	{
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="format input bahan.xlsx"');
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'S.No');
		$sheet->setCellValue('B1', 'Kode Bahan');
		$sheet->setCellValue('C1', 'Nama Bahan');
		$sheet->setCellValue('D1', 'id Supplier');

		$writer = new Xlsx($spreadsheet);
		$writer->save("php://output");
	}

	public function spreadsheet_import()
	{
		$upload_file=$_FILES['upload_file']['name'];
		$extension=pathinfo($upload_file,PATHINFO_EXTENSION);
		if($extension=='csv')
		{
			$reader= new \PhpOffice\PhpSpreadsheet\Reader\Csv();
		} else if($extension=='xls')
		{
			$reader= new \PhpOffice\PhpSpreadsheet\Reader\Xls();
		} else
		{
			$reader= new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		}
		$spreadsheet=$reader->load($_FILES['upload_file']['tmp_name']);
		$sheetdata=$spreadsheet->getActiveSheet()->toArray();
		$sheetcount=count($sheetdata);
		if($sheetcount>1)
		{
			$data=array();
			for ($i=1; $i < $sheetcount; $i++) { 
				$product_name=$sheetdata[$i][1];
				$product_qty=$sheetdata[$i][2];
				$product_price=$sheetdata[$i][3];
				$data[]=array(
					'kode_bahan'=>$product_name,
					'nama_bahan'=>$product_qty,
					'supplier_id'=>$product_price,
				);
			}
			$inserdata=$this->crud_model->insert_batch($data,'tbl_bahan');
			if($inserdata)
			{
				$this->session->set_flashdata('msg_berhasil','Data Barang Berhasil Ditambahkan');
				redirect('bahan');
			} else {
				$this->session->set_flashdata('message','<div class="alert alert-danger">Data Not uploaded. Please Try Again.</div>');
				redirect('bahan');
			}
		}
	}

    public function simpan(){
        $this->form_validation->set_rules('kode_bahan','kode bahan','required');
        $this->form_validation->set_rules('nama_bahan','nama bahan','required');
        $this->form_validation->set_rules('supplier_id','supplier_id','required');
        $this->form_validation->set_rules('harga_bahan','Harga','required');

    
        if($this->form_validation->run() == TRUE)
        {
          $kode_bahan      = $this->input->post('kode_bahan',TRUE);
          $nama_bahan      = $this->input->post('nama_bahan',TRUE);
          $supplier_id      = $this->input->post('supplier_id',TRUE);
          $harga_bahan      = $this->input->post('harga_bahan',TRUE);


    
          $data = array(
                'kode_bahan'      => $kode_bahan,
                'nama_bahan'      => $nama_bahan,
                'supplier_id'      => $supplier_id,
                'harga'      => $harga_bahan,
          );

          $this->crud_model->input($data,'tbl_bahan');
    
          $this->session->set_flashdata('msg_berhasil','Data Barang Berhasil Ditambahkan');
          redirect('Databahan');
        }else {
            $this->session->set_flashdata('msg_gagal','Data Gagal Ditambahkan, periksa kembali');
            redirect(base_url('bahan/tambahdata'));
        }
	}

    public function detail($kode_bahan){
        $this->global['pageTitle'] = 'Edit Data bahan';
        

        $where = array('kode_bahan' => $kode_bahan);

        $data['kode_bahan'] = $this->uri->segment(3);

        $data['list_data'] = $this->crud_model->Getdata($where,'tbl_bahan');
        $data['list_supplier'] = $this->crud_model->tampil_data('tbl_supplier');

        $this->loadViews("bahan/detail", $this->global, $data , NULL);        
    }

        public function detailharga($kode_bahan){
        $this->global['pageTitle'] = 'Edit Data bahan';
        
        $data['kode_bahan'] = $this->uri->segment(3);
        

        $where = array('kode_bahan' => $kode_bahan);


        $data['list_data'] = $this->crud_model->Getdata($where,'tbl_bahan');

        $this->loadViews("bahan/detailharga", $this->global, $data , NULL);        
    }

    public function update(){
        $kode_bahan      = $this->input->post('kode_bahan',TRUE);
        $nama_bahan      = $this->input->post('nama_bahan',TRUE);
        $supplier_id      = $this->input->post('supplier_id',TRUE);
        $harga_bahan      = $this->input->post('harga_bahan',TRUE);


            $data = array(
                'kode_bahan'      => $kode_bahan,
                'nama_bahan'      => $nama_bahan,
                'supplier_id'     => $supplier_id,
                'harga'           => $harga_bahan,
                'tgl_updateharga' => date('Y-m-d'),
            );

        $where = array('kode_bahan' => $kode_bahan);

        $this->crud_model->update($where,$data,'tbl_bahan');
  
        $this->session->set_flashdata('msg_berhasil','Data Berhasil Diubah');
        redirect('bahan/detail/' . $kode_bahan);
    }

    public function updateharga(){
        $kode_bahan      = $this->uri->segment(3);
        $harga_bahan      = $this->input->post('harga_bahan',TRUE);


            $data = array(
                'kode_bahan'      => $kode_bahan,
                'harga'           => $harga_bahan,
                'tgl_updateharga' => date('Y-m-d'),
          );

        $where = array('kode_bahan' => $kode_bahan);

        $this->crud_model->update($where,$data,'tbl_bahan');
  
        $this->session->set_flashdata('msg_berhasil','Data Berhasil Diubah');
        redirect('bahan/detailharga/' . $kode_bahan);
    }

    public function delete($kode_bahan){
      $where = array('kode_bahan' => $kode_bahan);
      $this->crud_model->delete($where , 'tbl_bahan');
      redirect(base_url('bahan'));
    }
}