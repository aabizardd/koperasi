<?php
defined('BASEPATH') or exit('No direct script access allowed');

while (ob_get_level())
	ob_end_clean();
header("Content-Encoding: None", true);

ob_start();
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(30);
$pdf->Text(65, 20, 'Resi Peminjaman ||||||||||||||||||');
$pdf->Text(65, 27, 'KOPERASI BUNGA BIRAENG');
$pdf->SetFont('Arial', '', 9);
foreach ($pinjaman as $get) {
	$pdf->Text(30, 55, 'Kepada :' . ' ' . $get->nama);
	$pdf->Text(30, 60, 'Pada Tanggal :' . ' ' . $get->tgl_pinjaman);
	$pdf->Text(40, 64, 'Sehubungan dengan Approval peminjaman dari pihak KOPERASI BUNGA BIRAENG');
	$pdf->Text(30, 68, 'dengan jumlah pinjaman seberasar Rp' . $get->jml_pinjaman . ' ' . 'akan dibayarkan paling lambat');
	$pdf->Text(30, 72, 'tanggal' . ' ' . $get->tenor . ' ' . 'dengan bunga sebesar' . ' ' . $get->bunga . '%');

}
$pdf->Text(30, 80, 'Tolong membawa bukti ini sebagai bentuk penukaran peminjaman, terimakasih');

$pdf->Text(30, 120, 'Penanggung Jawab');


$pdf->Output('Resi Peminjaman ' . $get->nama . '.pdf', 'I');
ob_end_flush(); 
