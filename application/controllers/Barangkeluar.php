<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
      $tgl_awal = $this->uri->segment(4); 
      $tgl_akhir = $this->uri->segment(5);
      $bagian = $this->uri->segment(6);

      $data = array(
        'list_detail_keluar'  => $this->bahanbaku_model->GetLaporanKeluarByBarang($id,$tgl_awal,$tgl_akhir,$bagian),
        'tgl_awal' => $tgl_awal,
        'tgl_akhir' => $tgl_akhir,
        'bagian' => $bagian,
      );
    
      $this->loadViews("barangkeluar/laporan_detail", $this->global, $data , NULL);
    }

    public function cetakbarangKeluar(){
      $id = $this->uri->segment(3);
      $tgl1 = $this->uri->segment(4);
      $tgl2 = $this->uri->segment(5);
      $tgl3 = $this->uri->segment(6);

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
            <td style="width:100px">: '.strftime('%d %b %Y', strtotime($d->tgl_keluar)).'</td>
            </tr>
            <tr>
            <th style="width:200px">Bagian </th>
            <td style="width:100px">: '.$d->nama_bagian.'</td>
            </tr>
            </table><br>
            ';
          }

          $html.='<br>';

          $html .='<table cellpadding="10" border="1" align="center">
            <tr>
              <th align="center" style="width:40px;">No</th>
              <th align="center">Nama Barang</th>
              <th align="center">Expired Date</th>
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

    public function cetaklaporanexcel(){
      $page = $this->uri->segment(2);
      $bagian = $this->uri->segment(3);
      $tgl_awal = $this->uri->segment(4); 
      $tgl_akhir = $this->uri->segment(5);
      $awal = strftime('%d %b %Y', strtotime($tgl_awal));
      $akhir = strftime('%d %b %Y', strtotime($tgl_akhir));

      // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
      $datakeluar = $this->bahanbaku_model->GetLaporanBarangKeluar($bagian,$tgl_awal,$tgl_akhir);

      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();
  
      $style_col = [
          'font' => ['bold' => true], // Set font nya jadi bold
          'alignment' => [
          'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
          'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
          ],
          'borders' => [
              'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
              'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
              'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
              'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
          ]
      ];
  
      $styleRight = [
          'font' => [
              'bold' => true,
          ],
          'alignment' => [
              'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
          ],
          'borders' => [
              'top' => [
                  'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
              ],
          ],
      ];
          
  
      // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
      $style_row = [
          'alignment' => [
          'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
          ],
          'borders' => [
          'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
          'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
          'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
          'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
          ]
      ];
      
  
      $sheet->setCellValue('B2', 'Laporan Data Bahan Keluar PT. MIROTA KSM'); // Set kolom A1 dengan tulisan "DATA SISWA"
      $sheet->mergeCells('B2:E2'); // Set Merge Cell pada kolom A1 sampai E1
  
      if (isset($tgl_awal) && isset($tgl_akhir)){
          $sheet->setCellValue('B3', 'Periode : '.$awal.' - '.$akhir);
      }else{
          $sheet->setCellValue('B3', 'Periode : ALL');
      }
      $sheet->mergeCells('B3:E3');
  
      $sheet->setCellValue('B5', 'No');
      $sheet->setCellValue('C5', 'Kode Barang');
      $sheet->setCellValue('D5', 'Nama Barang');
      $sheet->setCellValue('E5', 'Tanggal Keluar');
      $sheet->setCellValue('F5', 'Jumlah Keluar');

  
      $sheet->getStyle('B5')->applyFromArray($style_col);
      $sheet->getStyle('C5')->applyFromArray($style_col);
      $sheet->getStyle('D5')->applyFromArray($style_col);
      $sheet->getStyle('E5')->applyFromArray($style_col);
      $sheet->getStyle('F5')->applyFromArray($style_col);

  
      $no = 1; // Untuk penomoran tabel, di awal set dengan 1
      $numrow = 6; // Set baris pertama untuk isi tabel adalah baris ke 6
  
  
      foreach($datakeluar as $dk){ // Lakukan looping pada variabel siswa
          $sheet->setCellValue('B'.$numrow, $no);
          $sheet->setCellValue('C'.$numrow, $dk->kode_barang);
          $sheet->setCellValue('D'.$numrow, $dk->nama_bahan);
          $sheet->setCellValue('E'.$numrow, strftime('%d %b %Y', strtotime($dk->tgl_keluar)));
          $sheet->setCellValue('F'.$numrow, $dk->pengeluaran." ".$dk->satuan_kode);
          // $sheet->setCellValue('G'.$numrow, "Rp. ".number_format($dk->debet)." ,-");
          // $sheet->setCellValue('H'.$numrow, "Rp. ".number_format($dk->kredit)." ,-");
          // $sheet->setCellValue('I'.$numrow, "Rp. ".number_format($saldo)." ,-");
  
  
          $sheet->getColumnDimension('B')->setAutoSize(true);
          $sheet->getColumnDimension('C')->setAutoSize(true);
          $sheet->getColumnDimension('D')->setAutoSize(true);
          $sheet->getColumnDimension('E')->setAutoSize(true);
          $sheet->getColumnDimension('F')->setAutoSize(true);
  
          
          // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
          $sheet->getStyle('B'.$numrow)->applyFromArray($style_row);
          $sheet->getStyle('C'.$numrow)->applyFromArray($style_row);
          $sheet->getStyle('D'.$numrow)->applyFromArray($style_row);
          $sheet->getStyle('E'.$numrow)->applyFromArray($style_row);
          $sheet->getStyle('F'.$numrow)->applyFromArray($style_row);
          
          $no++; // Tambah 1 setiap kali looping
          $numrow++; // Tambah 1 setiap kali looping
      }

  
      $writer = new Xlsx($spreadsheet);
      header('Content-Type: application/vnd.ms-excel');

      if (isset($tgl_awal) && isset($tgl_akhir)){
          header('Content-Disposition: attactchment;filename=Laporan Barang '.$awal.' - '.$akhir.'.xlsx');
      }else{
          header('Content-Disposition: attactchment;filename=Laporan Barang Keluar.xlsx');
      }
  
      header('Cache-Control: max-age=0');
      $writer->save("php://output");
      exit();
    }
}