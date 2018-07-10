<?php


// $pdf = new New_pdf('P', 'mm', 'A4', true, 'UTF-8', false);
// $pdf->SetTitle('My Title');
// $pdf->SetHeaderMargin(30);
// $pdf->SetTopMargin(20);
// $pdf->setFooterMargin(20);
// $pdf->SetAutoPageBreak(true);
// $pdf->SetAuthor('Author');
// $pdf->SetDisplayMode('real', 'default');

// $pdf->AddPage();

// $pdf->Write(5, 'Some sample text');
// $pdf->Output('My-File-Name.pdf', 'I');

//============================================================+
// File name   : example_011.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 011 for TCPDF class
//               Colored Table (very simple table)
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Colored Table
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor($user_fullname);
$pdf->SetTitle($title);
$pdf->SetSubject('ANC Report');
$pdf->SetKeywords('child');

// set default header data
$pdf->SetHeaderData('anc.jpg', 45, $title, "\r\n" . 'Archdiocesan Nourishment Center - Data Profiling System' . "\r\n" . 'Prepared by: ' . $user_fullname . "\r\n" . 'Date: ' . $current_date . "\r\n" . "\r\n" . 'Child ID: C' . $child->child_id . ' | Date of Registration: ' . date("M j, Y", strtotime($child->date_registered)));



// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, 48, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(12);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(8);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 10);

// add a page
$pdf->AddPage();

// data loading
// $data = $pdf->LoadData();

// to get picture
if ($child->pic1 == '')
{
	if ($child->sex == 'Male')
	{
		$imglink = 'uploads/pic1/male.png';
	}
	else
	{
		$imglink = 'uploads/pic1/female.png';
	}
}
else
{
	$imglink = 'uploads/pic1/' . $child->pic1;
}

// to get age in mos.
$birthday = new DateTime($child->dob);

// current
$diff = $birthday->diff(new DateTime());
$months = $diff->format('%m') + 12 * $diff->format('%y') . ' mos';

// registered
$diff_reg = $birthday->diff(new DateTime($child->date_registered));
$months_reg = $diff_reg->format('%m') + 12 * $diff_reg->format('%y') . ' mos';


$text = '<p align="center">

<img id="image1" src="' . $imglink . '" style="width:1000px; max-height: 900px; margin-left:20px;">

<br />

<h1>' . $child->lastname . ', ' . $child->firstname . ' ' . $child->middlename . '</h1>
<hr />
</p>


<b>Date of Birth: ' . date("M j, Y", strtotime($child->dob)) . '</b> | <b>Place of Birth: ' . $child->pob . '</b>
<br /><br />
<b>Registered Age in Mos: ' . $months_reg . '</b> | <b>Sex: ' . $child->sex . '</b> | <b color="#006600">CURRENT Age in Mos: ' . $months . '</b>
<br /><br />
<b>INITIAL RECORD Height: ' . $child->height . ' cm | Weight: ' . $child->weight . ' kg</b> 
| 
<b color="#006600">LATEST RECORD Height: ' . $latest_height . ' cm | Weight: ' . $latest_weight . ' kg</b>
<br /><br />
<b>Religion: ' . $child->religion . '</b>
<br />
<b>Disability: ' . $child->disability . '</b>
<br />
<b>Contact: ' . $child->contact . '</b>
<br />
<b>School: ' . $child->school . '</b> | <b>Grade Level: ' . $child->grade_level . '</b>
<br />
<b>Home Address: ' . $child->address . '</b>
<br /><br />
<hr />
<p align="center"><b color="#003366">FAMILY BACKGROUND</b></p><hr />';
$pdf->writeHTML($text, true, 0, true, 0);

// print colored table
$pdf->ColoredTable_child($header, $data);




// $pdf->Cell(0, 30, '_____________________________________', 0, false, 'R', 0, '', 0, false, 'T', 'M' );
// $pdf->Cell(0, 40, 'Signature over printed name              ', 0, false, 'R', 0, '', 0, false, 'T', 'M' );


// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// *** set signature appearance ***



// // define active area for signature appearance
// $pdf->setSignatureAppearance(180, 60, 15, 15);

// // - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// // *** set an empty signature appearance ***
// $pdf->addEmptySignatureAppearance(180, 80, 15, 15);

// ---------------------------------------------------------

// ---------------------------------------------------------

// close and output PDF document
$pdf->Output('cis.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
