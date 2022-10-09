<?php 
    require(realpath($_SERVER["DOCUMENT_ROOT"]) .'\\parcialDWSL\\models\\fpdf\\fpdf.php');

    class PDF extends FPDF{
        function Header()
        {
            $this->SetFont('times', '', 14);
            $this->MultiCell(0,10, utf8_decode("Reporte Usuarios"), 0, 'C');
        }

        function Footer()
        {
            $this->SetY(-15);
            $this->SetFont('times', '', 10);
            $this->Cell(0, 10, 'Page'.$this->PageNo() . "/{nb}" , 0, 0, 'C');
        }

        function createTable($header,$data){  
            $this->SetFont('Arial','B',12);
            foreach($header as $h){
                $this->Cell(50,7,utf8_decode($h),1);
            }
            $this->Ln();
            $this->SetFont('Arial','',12);
            foreach($data as $row){
                foreach($row as $col){
                    $this->Cell(50,7,utf8_decode($col),1);
                }
            $this->Ln();
            }
        }
    }


?>