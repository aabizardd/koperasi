<?php defined('BASEPATH') or die('No direct script access allowed');

require('./application/third_party/phpoffice/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Export extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_pinjaman');
		$this->load->model('model_simpanan');
	}

	public function index()
	{
		$data['pengurus'] = $this->model_pinjaman->laporan_pinjaman();
		$this->load->view('laporan_pinjaman', $data);
	}

	public function export_simpanan()
	{
		$simpanan = $this->model_simpanan->laporan_simpanan2();

		$spreadsheet = new Spreadsheet;

		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'No')
			->setCellValue('B1', 'Nama')
			->setCellValue('C1', 'Total Simpan')
			->setCellValue('D1', 'Jumlah Simpanan')
			->setCellValue('E1', 'Tanggal Simpanan Terakhir');

		$kolom = 2;
		$nomor = 1;
		foreach ($simpanan as $get) {

			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A' . $kolom, $nomor)
				->setCellValue('B' . $kolom, $get->nama)
				->setCellValue('C' . $kolom, $get->totalsimpan . 'kali')
				->setCellValue('D' . $kolom, 'Rp' . $get->jml_simpanan)
				->setCellValue('E' . $kolom, $get->tanggal_simpanan);
			$kolom++;
			$nomor++;

		}

		$writer = new Xlsx($spreadsheet);

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Laporan Simpanan.Xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function export_pinjaman()
	{
		$pinjaman = $this->model_pinjaman->laporan_pinjaman();

		$spreadsheet = new Spreadsheet;

		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'No')
			->setCellValue('B1', 'Nama Lengkap')
			->setCellValue('C1', 'Total Pinjam')
			->setCellValue('D1', 'Jumlah Pinjaman')
			->setCellValue('E1', 'Sisa Setoran');

		$kolom = 2;
		$nomor = 1;
		foreach ($pinjaman as $get) {

			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A' . $kolom, $nomor)
				->setCellValue('B' . $kolom, $get->nama)
				->setCellValue('C' . $kolom, $get->totalpinjam . 'kali')
				->setCellValue('D' . $kolom, 'Rp' . $get->jml_pinjaman)
				->setCellValue('E' . $kolom, 'Rp' . $get->angsuran);
			$kolom++;
			$nomor++;

		}

		$writer = new Xlsx($spreadsheet);

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Laporan Pinjaman.Xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function export_riwayatSimpanan()
	{
		$simpanan = $this->model_simpanan->riwayat_simpanan();

		$spreadsheet = new Spreadsheet;

		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'No')
			->setCellValue('B1', 'Nama Lengkap')
			->setCellValue('C1', 'Jumlah Simpanan')
			->setCellValue('D1', 'Tanggal');
		$kolom = 2;
		$nomor = 1;
		foreach ($simpanan as $get) {

			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A' . $kolom, $nomor)
				->setCellValue('B' . $kolom, $get->nama)
				->setCellValue('C' . $kolom, 'Rp' . $get->jml_simpanan)
				->setCellValue('D' . $kolom, $get->tanggal_simpanan);
			$kolom++;
			$nomor++;

		}

		$writer = new Xlsx($spreadsheet);

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Laporan Riwayat Simpanan.Xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function export_riwayatPengambilan()
	{
		$pengambilan = $this->model_simpanan->ambil_simpananPetugas();

		$spreadsheet = new Spreadsheet;

		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'No')
			->setCellValue('B1', 'Nama Lengkap')
			->setCellValue('C1', 'Jumlah Pengambilan')
			->setCellValue('D1', 'Tanggal');
		$kolom = 2;
		$nomor = 1;
		foreach ($pengambilan as $get) {

			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A' . $kolom, $nomor)
				->setCellValue('B' . $kolom, $get->nama)
				->setCellValue('C' . $kolom, 'Rp' . $get->nominal)
				->setCellValue('D' . $kolom, $get->tanggal_ambil);
			$kolom++;
			$nomor++;

		}

		$writer = new Xlsx($spreadsheet);

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Laporan Riwayat Pengambilan.Xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}
}
