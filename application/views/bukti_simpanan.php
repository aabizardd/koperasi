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
$pdf->Text(65, 20, 'Bukti Simpanan ||||||||||||||||||');
$pdf->Text(65, 27, 'KOPERASI BUNGA BIRAENG');
$pdf->SetFont('Arial', '', 9);
foreach ($simpanan as $get) {
	$pdf->Text(30, 55, 'Kepada :' . ' ' . $get->nama);
	$pdf->Text(30, 60, 'Pada Tanggal :' . ' ' . $get->tanggal_simpanan);
	$pdf->Text(40, 64, 'Sehubungan dengan Simpanan anda di KOPERASI BUNGA BIRAENG');
	$pdf->Text(30, 68, 'dengan jumlah simpanan sebesar Rp' . $get->simpanan);
	$pdf->Text(30, 72, 'tanggal' . ' ' . $get->tanggal_simpanan . ' ' . 'Telah disetujui oleh pihak kami');

}
$pdf->Text(30, 80, 'Tolong menyimpan bukti ini sebagai bentuk bukti simpanan anda, terimakasih');

$pdf->Text(30, 120, 'Penanggung Jawab');


$pdf->Output('Bukti Simpanan ' . $get->nama . '.pdf', 'I');
ob_end_flush(); 
