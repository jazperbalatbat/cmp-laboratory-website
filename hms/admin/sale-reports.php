<?php
session_start();
	require("include/config.php");
	require("fpdf/fpdf.php");
      
	

    $sd1 = $_SESSION["sd1"];
    $sd2 = $_SESSION["sd2"];
	$sd2= date('Y-m-d H:i:s', strtotime($sd2 . ' +1 day')); 


	
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
	$pdf->Cell(0, 10, "Sales Report", 0, 1, "C");
	$pdf->Ln(2);
	$pdf->SetFont("Arial", "", 10);
	$pdf->Cell(162, 10, "From: ".date("d-M-Y", strtotime($sd1))." "." To:"." ".date("d-M-Y", strtotime($sd2)), 0, 0, "L");
	$pdf->Ln(10);
	
	$pdf->SetFont("Arial", "B", 12);
	$pdf->Cell(20, 10, "ID", 1, 0, "C");


	$pdf->Cell(90, 10, "Appointment Date", 1, 0, "C");
	// $pdf->Cell(55, 10, "appointment Time", 1, 0, "C");
	$pdf->Cell(70, 10, "Fees", 1, 0, "C");
	
	
	$totalsales = 0;
	
	if(isset($_POST['btn_print']))
    {   
		$sql = "select * from appointment where appointmentDate between '$sd1' and 'sd2' and appointmentStatus = 1";
    	  // $sql = "select id, appointmentDate, appointmentTime, consultancyFees from appointment where appointmentDate between '$sd1' and '$sd2' and appointmentStatus = 1";
    }
    else
    {
    	  $sql = "select * from appointment where appointmentStatus = 1";
    	

        
    }
	$result = mysqli_query($con, $sql);	
	while($sales = mysqli_fetch_assoc($result)){
		$pdf->SetFont("", "", "10");
			$pdf->Ln(10);
		$pdf->Cell(20, 10, $sales["id"], 1, 0, "C");
	
		$pdf->Cell(90, 10, $sales["appointmentDate"], 1, 0, "C");
		// $pdf->Cell(55, 10, $sales["appointmentTime"], 1, 0, "C");
		$pdf->Cell(70, 10, "PHP".number_format($sales["consultancyFees"], 2), 1, 0, "C");
		$totalsales = $totalsales + $sales["consultancyFees"];
		
	}
	
	$pdf->Ln(10);
	// $pdf->Cell(162, 10, "Prepared by: ".$firstname. 0, 0, "L");
    $pdf->Cell(155, 10, "Total Sales:          PHP".number_format($totalsales, 2), 0, 0, "R"); 
	$pdf->Cell(29, 10, "Date:" . date("Y/m/d") , 0, 0, "R");

	$pdf->Output()

?>