<?php
session_start();
	require("include/config.php");
	require("fpdf/fpdf.php");



	$appd1 = $_SESSION["appd1"];
    $appd2 = $_SESSION["appd2"];
	$appd2 = date('Y-m-d H:i:s', strtotime($appd2 . ' +1 day'));
	
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
	$pdf->Cell(0, 10, "List of Appointments", 0, 1, "C");
	$pdf->Ln(2);
	$pdf->SetFont("Arial", "", 10);
	$pdf->Cell(162, 10, "From: ".date("d-M-Y", strtotime($appd1))." "." To:"." ".date("d-M-Y", strtotime($appd2)), 0, 0, "L");
	$pdf->Ln(10);
	
	$pdf->SetFont("Arial", "B", 12);
	$pdf->Cell(10, 10, "ID", 1, 0, "C");
	// $pdf->Cell(30, 10, "Doctor Name", 1, 0, "C");
	// $pdf->Cell(40, 10, "Specialization", 1, 0, "C");
	$pdf->Cell(70, 10, "Patient Name", 1, 0, "C");
	
	$pdf->Cell(60, 10, "Appointment Date", 1, 0, "C");
	$pdf->Cell(39, 10, "Appointment Time", 1, 0, "C");

	
	
	if(isset($_POST['btn_print']))
    {   
        $sqlappointment = "select users.fullName as pname, appointment.* from appointment join users on users.id=appointment.userId where appointmentDate between '$appd1' and '$appd2'";

        // "select users.fullName as pname,appointment.*  from appointment join on users.id=appointment.userId where appointment.appointmentDate between '$appd1' and '$appd2' ";
    }
    else
    {
        $sqlappointment = "Select users.fullName as pname,appointment.*  from appointment join users on users.id=appointment.userId ";
        
    }
	$result = mysqli_query($con, $sqlappointment);	
	while($appointment = mysqli_fetch_assoc($result)){
		$pdf->SetFont("", "", "10");
			$pdf->Ln(10);
		$pdf->Cell(10, 10, $appointment["id"], 1, 0, "C");
	

		$pdf->Cell(70, 10, $appointment["pname"], 1, 0, "C");
			$pdf->Cell(60, 10, $appointment["appointmentDate"], 1, 0, "C");
		$pdf->Cell(39, 10, $appointment["appointmentTime"], 1, 1, "C");
	}
	
	$pdf->Ln(10);
	// $pdf->Cell(162, 10, "Prepared by: ".$firstname. 0, 0, "L");

	$pdf->Cell(29, 10, "Date:" . date("Y/m/d") , 0, 0, "R");

	$pdf->Output();
?>