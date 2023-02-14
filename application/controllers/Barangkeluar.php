<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Barangkeluar extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct(){
      parent::__construct();
      $this->load->model('user_model');
      $this->load->model('crud_model');
      $this->load->model('bahanbaku_model');
      $this->load->model('M_admin');
      $this->load->library('Pdf');
      $this->isLoggedIn();   
    }

    public function index(){
        redirect('barangkeluar/tabel_barangkeluar');
    }

    public function tabel_barangkeluar(){
      $this->global['pageTitle'] = 'Data Barang Keluar';

      $data['list_data'] = $this->bahanbaku_model->GetDataGudangKeluar();

      $data['nama'] = $this->global ['name'];

      $this->loadViews("barangkeluar/data", $this->global, $data , NULL);
    }

    public function barang_keluar(){
      $this->global['pageTitle'] = 'Data Barang Keluar';

      $uri = $this->uri->segment(3);
      $where = array( 'id_transaksi' => $uri);
      $data['list_data'] = $this->crud_model->Getdata($where,'tb_barang_masuk');
      $data['list_satuan'] = $this->crud_model->tampil_data('tb_satuan');

      $data = array(
        'list_data'           => $this->crud_model->tampil_data('tb_barang_masuk'),
        'list_bahan'          => $this->bahanbaku_model->GetDataGudang(),
        'list_supplier'       => $this->crud_model->tampil_data('tbl_supplier'),
        'list_karantina'      => $this->bahanbaku_model->Getdatakarantinagudang(),
        'list_perusahaan'     => $this->crud_model->tampil_data('tbl_perusahaan'),
        'list_satuan'         => $this->crud_model->tampil_data('tb_satuan'),
        'list_bagian'           =>  $this->crud_model->tampil_data('tbl_bagian'),
      );

      $this->loadViews("barangkeluar/form_insert", $this->global, $data , NULL);

    }

    public function detail_tabel(){
      $this->global['pageTitle'] = 'Detail Barang Masuk';
      $id = $this->uri->segment(3);

      $data = array(
        'list_keluar'         => $this->bahanbaku_model->GetDataGudangKeluarById($id),
        'list_detail_keluar'  => $this->bahanbaku_model->GetDetailGudangKeluar($id),
      );
    
      $this->loadViews("barangkeluar/detail", $this->global, $data , NULL);
    }

    public function proses_data_keluar(){
        $nota_keluar        = $this->input->post('nota_keluar');
        $status_barang   = $this->input->post('status_barang');
        $tgl_keluar     = $this->input->post('tgl_keluar');
        $bagian       = $this->input->post('bagian');
        $kode_barang     = $this->input->post('kode_barang');
        $satuan_kode     = $this->input->post('satuan_kode');
        $permintaan      = $this->input->post('permintaan');
        $keluar      = $this->input->post('keluar');

        $data = array();
        $index = 0; // Set index array awal dengan 0
        foreach ($nota_keluar as $nota_keluar) { // Kita buat perulangan berdasarkan kode transaksi sampai data terakhir

          array_push($data, array(
            'nota_keluar' => $nota_keluar,
            'status_barang' => $status_barang[$index],
            'tgl_keluar' => $tgl_keluar[$index],
            'bagian' => $bagian[$index],
            'barang_id' => $kode_barang[$index],
            'satuan_kode' => $satuan_kode[$index],
            'permintaan' => $permintaan[$index],
            'pengeluaran' => $keluar[$index],
          ));  

          $id = $kode_barang[$index];
          $gudang = $this->bahanbaku_model->cekstok($id);

          foreach ($gudang as $gudang) {
            $stokawal[$index] = $gudang->jml_barang;
          }

          $where = array('id_barang_masuk' => $kode_barang[$index]);
          $data2 = array(
            'jml_barang' => $stokawal[$index] - $keluar[$index],
          ); 

          $this->crud_model->update($where,$data2,'tbl_barang_masuk');

        $index++;
        }

        $this->db->insert_batch('tbl_barang_keluar', $data);
        $this->session->set_flashdata('msg_berhasil_keluar','Data Berhasil Keluar');
        redirect('barangmasuk');
    }

    public function laporankeluar(){
      $this->global['pageTitle'] = 'Laporan Barang Keluar';

      $bagian = $this->input->post('bagian'); 
      $tgl_awal = $this->input->post('tgl_awal'); 
      $tgl_akhir = $this->input->post('tgl_akhir');

      $data = array (
        'nama' => $this->global ['name'],
        'bagian' => $bagian,
        'tgl_awal' => $tgl_awal,
        'tgl_akhir' => $tgl_akhir,
        'tanggal' => $this->bahanbaku_model->GetTanggalKeluar($bagian,$tgl_awal,$tgl_akhir),
        'list_bagian'           =>  $this->crud_model->tampil_data('tbl_bagian'),
        'list_bahan'           =>  $this->crud_model->tampil_data('tbl_bahan'),
        'list_data'           => $this->bahanbaku_model->GetLaporanGudangKeluar($bagian,$tgl_awal,$tgl_akhir)
      );

      $this->loadViews("barangkeluar/laporan", $this->global, $data , NULL);
    }

    public function detail_laporan(){
      $this->global['pageTitle'] = 'Detail Barang Masuk';
      $id = $this->uri->segment(3);

      $data = array(
        'list_detail_keluar'  => $this->bahanbaku_model->GetLaporanKeluarByBarang($id),
      );
    
      $this->loadViews("barangkeluar/laporan_detail", $this->global, $data , NULL);
    }

    public function cetakbarangKeluar(){
      $id = $this->uri->segment(3);
      $tgl1 = $this->uri->segment(4);
      $tgl2 = $this->uri->segment(5);
      $tgl3 = $this->uri->segment(6);
      $ls   = array('id_transaksi' => $id ,'tanggal_keluar' => $tgl1.'/'.$tgl2.'/'.$tgl3);
      $data = $this->M_admin->get_data('tb_barang_keluar',$ls);

      $gudang = $this->bahanbaku_model->GetDataGudangKeluarById($id);
      $detail_gudang = $this->bahanbaku_model->GetDetailGudangKeluar($id);
  
      $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
  
      // document informasi
      $pdf->SetCreator('Web Aplikasi Gudang');
      $pdf->SetTitle('Laporan Data Barang Keluar');
      $pdf->SetSubject('Barang Keluar');
  
      //header Data
      $pdf->SetHeaderData('Mirota.PNG',45,'PT Mirota KSM','JL. Raya Yogya-Solo Km. 9',array(50,54,57),array(0, 0, 0));
      $pdf->SetFooterData(array(255, 255, 255), array(255, 255, 255));
  
  
      $pdf->setHeaderFont(Array('helvetica','',18));
      $pdf->setFooterFont(Array(PDF_FONT_NAME_MAIN,'',PDF_FONT_SIZE_MAIN));
  
      $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
  
      //set margin
      $pdf->SetMargins(PDF_MARGIN_LEFT,PDF_MARGIN_TOP + 1,PDF_MARGIN_RIGHT);
      $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
      $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
  
      $pdf->SetAutoPageBreak(FALSE, PDF_MARGIN_BOTTOM - 5);
  
      //SET Scaling ImagickPixel
      $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
  
      //FONT Subsetting
      $pdf->setFontSubsetting(true);
  
      $pdf->SetFont('helvetica','',11,'',true);
      $pdf->AddPage('L','B5');
  
      $html=
        '<div> 
          <h1 align="center">Bukti Permintaan dan Pengeluaran Barang</h1><br>';
          foreach($gudang as $d){
            $html .= 
            '
            <table border="0">
            <tr style="margin:100px">
            <th style="width:200px">Nota Keluar</th>
            <td style="width:100px">: '.$d->nota_keluar.'</td>
            </tr>
            <tr>
            <th style="width:200px">Ditunjukan Untuk</th>
            <td style="width:200px">: '.$d->nama_perusahaan.'</td>
            </tr>
            <tr>
            <th style="width:200px">Tanggal Keluar </th>
            <td style="width:100px">: '.$d->tgl_keluar.'</td>
            </tr>
            <tr>
            <th style="width:200px">Bagian </th>
            <td style="width:100px">: '.$d->bagian.'</td>
            </tr>
            </table><br>
            ';
          }

          $html.='<br>';

          $html .='<table cellpadding="10" border="1" align="center">
            <tr>
              <th align="center" style="width:40px;">No</th>
              <th align="center">Nama Barang</th>
              <th align="center">ED</th>
              <th align="center">Batch</th>
              <th align="center">No. Seri</th>
              <th align="center">Permintaan</th>
              <th align="center" style="width:100px;">Pengeluaran</th>
              <th align="center" style="width:70px;">Satuan</th>
            </tr>';
  
            $no = 1;
            foreach($detail_gudang as $d){
              $html .= '<tr>';
              $html .= '<td align="center">'.$no.'</td>';
              $html .= '<td align="left">'.$d->nama_bahan.'</td>';
              $html .= '<td align="center">'.strftime('%d %b %Y', strtotime($d->expired_date)).'</td>';
              $html .= '<td align="center">'.$d->batch.'</td>';
              $html .= '<td align="center">'.$d->seri.'</td>';
              $html .= '<td align="center">'.$d->permintaan.'</td>';
              $html .= '<td align="center">'.$d->pengeluaran.'</td>';
              $html .= '<td align="center">'.$d->satuan_kode.'</td>';
              $html .= '</tr>';
              $no++;
            }
  
          $html .='
              </table><br>
              <h4>Mengetahui</h4><br><br><br>
              <h4>Admin Gudang</h4>
            </div>';
  
      $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 0, 0, true, '', true);
  
      $pdf->Output('invoice_barang_keluar.pdf','I');
  
    }
  
}