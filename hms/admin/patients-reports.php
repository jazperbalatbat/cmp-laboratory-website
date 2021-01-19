<?php
session_start();
	require("include/config.php");
	require("fpdf/fpdf.php");
      
	

    $d1 = $_SESSION["d1"];
    $d2 = $_SESSION["d2"];
	$d2= date('Y-m-d H:i:s', strtotime($d2 . ' +1 day')); 


	
	class PDF extends FPDF {
		function Header() {
			// $this->Image("img/company/logotp.png", 80, 20, 50);
			$this->Ln(40);
			$this->SetFont("Arial", "", 12);
			$this->Cell(0, 5, "CMP Medical Laboratory", 0, 1, "C");
			$this->Cell(0, 5, "San Fernando, Pampanga", 0, 1, "C");
			$this->Ln(5);
		}
		
		function Footer() {
			$this->SetY(-15);
			$this->SetFont("Arial", "", 12);
			$this->Cell(0, 10, "Page " . $this->PageNo() . "/{nb}", 0, 0, "C");
		}
	}
	
	$pdf = new PDF();
	
	$pdf->AliasNbPages();
	$pdf->AddPage();
	
	$pdf->SetFont("Times", "B", 20);
	$pdf->Cell(0, 10, "List of Patients", 0, 1, "C");
	$pdf->Ln(2);
	$pdf->SetFont("Arial", "", 10);
	$pdf->Cell(162, 10, "From: ".date("d-M-Y", strtotime($d1))." "." To:"." ".date("d-M-Y", strtotime($d2)), 0, 0, "L");
	$pdf->Ln(10);
	
	$pdf->SetFont("Arial", "B", 12);
	$pdf->Cell(10, 10, "ID", 1, 0, "C");
	$pdf->Cell(40, 10, "Name", 1, 0, "C");
	$pdf->Cell(50, 10, "Email Address", 1, 0, "C");
	$pdf->Cell(25, 10, "Mobile No.", 1, 0, "C");
	$pdf->Cell(45, 10, "Date of Registration", 1, 0, "C");
	$pdf->Cell(25, 10, "Address", 1, 1, "C");
	
	
	if(isset($_POST['btn_print']))
    {   

        $sqlPatients = "SELECT * FROM users where regDate between '$d1' and '$d2' ";
    }
    else
    {
    	$sqlPatients = "SELECT * FROM users where regDate between '$d1' and '$d2' ";
        // $sqlPatients = "SELECT * FROM users";
        
    }
	$result = mysqli_query($con, $sqlPatients);	
	while($Patients = mysqli_fetch_assoc($result)){
		$pdf->SetFont("", "", "10");
		$pdf->Cell(10, 10, $Patients["id"], 1, 0, "C");
		$pdf->Cell(40, 10, $Patients["fullName"], 1, 0, "C");
		$pdf->Cell(50, 10, $Patients["email"], 1, 0, "C");
		$pdf->Cell(25, 10, $Patients["address"], 1, 0, "C");
		$pdf->Cell(45, 10, $Patients["regDate"], 1, 0, "C");
		$pdf->Cell(25, 10, $Patients["city"], 1, 1, "C");
	}
	
	$pdf->Ln(10);
	// $pdf->Cell(162, 10, "Prepared by: ".$firstname. 0, 0, "L");

	$pdf->Cell(29, 10, "Date:" . date("Y/m/d") , 0, 0, "R");

	$pdf->Output();
?>