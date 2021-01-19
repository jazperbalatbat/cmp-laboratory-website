<?php
session_start();

	require("include/config.php");
	require("fpdf/fpdf.php");
  	$appid = $_SESSION['id'];

	$ret=mysqli_query($con,"select * from appointment");
		while($row=mysqli_fetch_array($ret))
		{
			$x = htmlentities($row['id']);
		
		}

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
	 $pdf->Cell(0, 10, "Appointment Summary", 0, 1, "C");
	 $pdf->Ln(2);
	 $pdf->SetFont("Arial", "", 10);
	
	 $pdf->Ln(10);
	
	 $pdf->SetFont("Arial", "B", 12);

	
	
	
	 if(isset($_POST["show"]))
     {   

    $sqlappointment = "select * from appointment where id = $x";   
     }
     else
     {
      
       $sqlappointment = "select * from appointment where id = $x";   
     }
	 $result = mysqli_query($con, $sqlappointment);	
	 while($appointment = mysqli_fetch_assoc($result)){
	 		$pdf->SetFont("Arial", "B", "14");
		    // $pdf->Cell(20, 10, $sales["id"], 1, 0, "C");
		     $pdf->Cell(130, 10, "Medical Examination:   ". ($appointment["exam"]), 0, 1, "R");
	
		    $pdf->Cell(130, 10, "Appointment Date:    ". ($appointment["appointmentDate"]), 0, 1, "R");
		
			$pdf->Cell(42, 10, "Fee: " .($appointment["consultancyFees"]), 0, 1, "R");
		
	 	
	 }

	
	 $pdf->Ln(10);
	 // $pdf->Cell(162, 10, "Prepared by: ".$firstname. 0, 0, "L");

	 $pdf->Cell(45, 10, "Date:" . date("Y/m/d") , 0, 0, "R");

	 $pdf->Output();
?>