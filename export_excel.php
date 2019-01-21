<?php
/*
Install: composer require phpoffice/phpspreadsheet:dev-develop
Github: https://github.com/PHPOffice/PhpSpreadsheet/
Document: https://phpspreadsheet.readthedocs.io/
*/

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

include_once 'koneksi.php';

$barang = mysqli_query($conn, "SELECT tb_transaksi.invoice, nm_transaksi, Date(tnggl) as tnggl, (SELECT nama FROM tb_employee WHERE id=id_employee) AS nama_pegawai, (SELECT item FROM tb_barang WHERE id=id_item ) AS item, qty, discount, total_price, statuss FROM tb_transaksi WHERE DATE(tnggl)=CURDATE()");

// Create new Spreadsheet object
$spreadsheet = new Spreadsheet();
// Set document properties
$spreadsheet->getProperties()->setCreator('PhpOffice')
        ->setLastModifiedBy('PhpOffice')
        ->setTitle('Office 2007 XLSX Test Document')
        ->setSubject('Office 2007 XLSX Test Document')
        ->setDescription('PhpOffice')
        ->setKeywords('PhpOffice')
        ->setCategory('PhpOffice');
// Add some data
$spreadsheet->setActiveSheetIndex(0)
        ->setCellValueByColumnAndRow(1, 1, "No.");
$spreadsheet->setActiveSheetIndex(0)
        ->setCellValueByColumnAndRow(2, 1, "Invoice");
$spreadsheet->setActiveSheetIndex(0)
        ->setCellValueByColumnAndRow(3, 1, "Customer");
$spreadsheet->setActiveSheetIndex(0)
        ->setCellValueByColumnAndRow(4, 1, "Date");
$spreadsheet->setActiveSheetIndex(0)
        ->setCellValueByColumnAndRow(5, 1, "Employee");
$spreadsheet->setActiveSheetIndex(0)
        ->setCellValueByColumnAndRow(6, 1, "Item");
$spreadsheet->setActiveSheetIndex(0)
        ->setCellValueByColumnAndRow(7, 1, "Quantity");
$spreadsheet->setActiveSheetIndex(0)
        ->setCellValueByColumnAndRow(8, 1, "Discount (%)");
$spreadsheet->setActiveSheetIndex(0)
        ->setCellValueByColumnAndRow(9, 1, "Total Price");
$spreadsheet->setActiveSheetIndex(0)
        ->setCellValueByColumnAndRow(10, 1, "Status");
$i=2;
$total=0;
$no=0;
foreach ($barang as $data) {
$spreadsheet->setActiveSheetIndex(0)
        ->setCellValueByColumnAndRow(1, $i, $i-1);
$spreadsheet->setActiveSheetIndex(0)
        ->setCellValueByColumnAndRow(2, $i, $data["invoice"]);
$spreadsheet->setActiveSheetIndex(0)
        ->setCellValueByColumnAndRow(3, $i, $data["nm_transaksi"]);
$spreadsheet->setActiveSheetIndex(0)
        ->setCellValueByColumnAndRow(4, $i, $data["tnggl"]);
$spreadsheet->setActiveSheetIndex(0)
        ->setCellValueByColumnAndRow(5, $i, $data["nama_pegawai"]);
$spreadsheet->setActiveSheetIndex(0)
        ->setCellValueByColumnAndRow(6, $i, $data["item"]);
$spreadsheet->setActiveSheetIndex(0)
        ->setCellValueByColumnAndRow(7, $i, $data["qty"]);
$spreadsheet->setActiveSheetIndex(0)
        ->setCellValueByColumnAndRow(8, $i, $data["discount"]);
$spreadsheet->setActiveSheetIndex(0)
        ->setCellValueByColumnAndRow(9, $i, $data["total_price"]);
$spreadsheet->setActiveSheetIndex(0)
        ->setCellValueByColumnAndRow(10, $i, $data["statuss"]);
        $total=$total+$data["total_price"];
        $i=$i+1;
}
// Rename worksheet
$spreadsheet->getActiveSheet()->setTitle('Transaction');

$spreadsheet->createSheet();
// Add some data
$spreadsheet->setActiveSheetIndex(1)
        ->setCellValue('A1', 'world!');
// Rename worksheet
$spreadsheet->getActiveSheet()->setTitle('URL Removed');

$spreadsheet->createSheet();
// Add some data
$spreadsheet->setActiveSheetIndex(2)
        ->setCellValue('A1', 'world!');
// Rename worksheet
$spreadsheet->getActiveSheet()->setTitle('URL Removed');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$spreadsheet->setActiveSheetIndex(0);
// Redirect output to a client’s web browser (Xlsx)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="01simple.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');
// If you're serving to IE over SSL, then the following may be needed
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0
$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
exit;