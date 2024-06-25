<?php
include '../assets/conn/config.php';
require ('../assets/fpdf/fpdf.php');

class PDF extends FPDF
{
    // Header
    function Header()
    {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Hasil Data', 0, 1, 'C');
        $this->Ln(10);
    }

    // Footer
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }

    // Load data
    function LoadData($conn)
    {
        $data = mysqli_query($conn, "SELECT * FROM tbl_hasil a, tbl_class c WHERE a.id_class_knn=c.id_class ORDER BY id_hasil");
        $results = [];
        while ($a = mysqli_fetch_array($data)) {
            $dt = mysqli_query($conn, "SELECT * FROM tbl_dataset a, tbl_class c WHERE a.id_class=c.id_class AND a.tipe_data='$a[tipe_data]' AND ket_data='Data Uji'");
            $d = mysqli_fetch_array($dt);

            if ($d['nm_class'] == $a['nm_class']) {
                $error = 'Valid';
            } else {
                $error = 'Invalid';
            }
            $results[] = [$a['tipe_data'], $d['nm_class'], $a['nm_class'], $a['nilai_k'], $error];
        }
        return $results;
    }

    // Table
    function FancyTable($header, $data)
    {
        $this->SetFillColor(255, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B');
        // Header
        $w = [20, 40, 40, 40, 20, 30];
        for ($i = 0; $i < count($header); $i++)
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = false;
        $no = 1;
        foreach ($data as $row) {
            $this->Cell($w[0], 6, $no++, 'LR', 0, 'C', $fill);
            $this->Cell($w[1], 6, $row[0], 'LR', 0, 'C', $fill);
            $this->Cell($w[2], 6, $row[1], 'LR', 0, 'C', $fill);
            $this->Cell($w[3], 6, $row[2], 'LR', 0, 'C', $fill);
            $this->Cell($w[4], 6, $row[3], 'LR', 0, 'C', $fill);
            $this->Cell($w[5], 6, $row[4], 'LR', 0, 'C', $fill);
            $this->Ln();
            $fill = !$fill;
        }
        // Closing line
        $this->Cell(array_sum($w), 0, '', 'T');
    }
}

$pdf = new PDF();
$header = ['No', 'Data', 'Class Actual', 'Class Forecast', 'Nilai K', 'Error'];
$data = $pdf->LoadData($conn);
$pdf->SetFont('Arial', '', 14);
$pdf->AddPage();
$pdf->FancyTable($header, $data);
$pdf->Output();
exit;
?>