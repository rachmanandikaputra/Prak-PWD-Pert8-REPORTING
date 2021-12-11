<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initialscale=1.0">
	<title>CRUD</title>
	<?php
	require "fpdf/fpdf.php";
	include "koneksi.php";
	// mengambil data mahasiswa dari database
	$data = mysqli_query($con, "SELECT * FROM mahasiswa");
	// buat fungsi cetak untuk mencetak menjadi pdf
	function cetak()
	{
	// mengaktifkan penyimpanan output pada browser terhadap halaman tertentu
		ob_start();
		include "koneksi.php";
		// instansiasi object FPDF dan mengatur orientasi kertas dan ukuran kertas
		$pdf = new FPDF('l', 'mm', 'A4');
		// membuat halaman baru
		$pdf->AddPage();
		// set start header
		// set font
		$pdf->SetFont('Arial', 'B', 16);
		// set lebar, tinggi, string, line break dan align
		$pdf->Cell(190, 7, 'PROGRAM STUDI TEKNIK INFORMATIKA', 0, 1, 'C');
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->Cell(190, 7, 'DAFTAR MAHASISWA MATKUL PEMROGRAMAN WEB DINAMIS', 0, 1, 'C');
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(20, 6, 'NIM', 1, 0);
		$pdf->Cell(50, 6, 'NAMA MAHASISWA', 1, 0);
		$pdf->Cell(25, 6, 'J KEL', 1, 0);
		$pdf->Cell(50, 6, 'ALAMAT', 1, 0);
		$pdf->Cell(30, 6, 'TANGGAL LAHIR', 1, 1);
		$pdf->SetFont('Arial', '', 10);
		// set end header
		// query data mahasiswa
		$mahasiswa = mysqli_query($con, "SELECT * FROM mahasiswa");
		// loop data
		while ($row = mysqli_fetch_array($mahasiswa)) {
			// mencetak data mahasiswa ke dalam pdf
			$pdf->Cell(20, 6, $row['nim'], 1, 0);
			$pdf->Cell(50, 6, $row['Nama'], 1, 0);
			$pdf->Cell(25, 6, $row['jkel'], 1, 0);
			$pdf->Cell(50, 6, $row['alamat'], 1, 0);
			$pdf->Cell(30, 6, $row['tgllhr'], 1, 1);
		}
		$pdf->Output();
	}
	// jika ada perintah cetak jalankan fungsi cetak
	if (isset($_POST['submit'])) {
	cetak();
	}
?>
</head>
<body>
	<table border="1">
	<tr>
	<td>NIM</td>
	<td>NAMA</td>
	<td>JENIS KELAMIN</td>
	<td>ALAMAT</td>
	<td>TANGGAL LAHIR</td>
	</tr>
	<?php
	// melakukan looping data untuk ditampilkan pada table
	while ($mahasiswa = mysqli_fetch_array($data)) {
		echo "<tr>";
		echo "<td>" . $mahasiswa['nim'] . "</td>";
		echo "<td>" . $mahasiswa['Nama'] . "</td>";
		echo "<td>" . $mahasiswa['jkel'] . "</td>";
		echo "<td>" . $mahasiswa['alamat'] . "</td>";
		echo "<td>" . $mahasiswa['tgllhr'] . "</td>";
	}
	?>
	</table>
	<br>
	<form action="#" method="POST">
	<input type="submit" value="Cetak Data Mahasiswa" name="submit">
	</form>
</body>
</html>