<?php
error_reporting(0);
require_once('tcpdf/config/lang/eng.php');
require_once('tcpdf/tcpdf.php');

class MYPDF extends TCPDF {

	//Header
	public function Header() {
		// Logo
		$image_file = 'tcpdf/lykeion.png';
		$this->Image($image_file, 135, 5, 60, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		// Title
		$this->SetFont('helvetica', '', 20, '', true);
		$this->SetY($this->GetY() + 8);
		$this->Cell(0, 0, 'Curriculum Vitae', 0, false, 'L', 0, '', 0, false, 'M', 'M');
		$this->SetLineWidth(0.4);
		$this->Line(15,27,195,27);
		$this->setTopMargin(35);
	}

	// Footer
	public function Footer() {
		$this->SetY(-15);
		$this->SetFont('helvetica', 'I', 8);
		$this->Cell(0, 10, 'Strana '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
	}
}

/* Pomocne funkcije */
function ispisiNaslov($naslov, $pdf) {
	$pdf->SetFont('helvetica', '', 12, '', true);
	$pdf->WriteHTML('<div style="background-color:#a0b5f8;color:white;">&nbsp;'.$naslov.'</div>');
	$pdf->SetFont('helvetica', '', 10, '', true);
}

function ispisiNiz($niz, $pdf) {
	$html = '<p style="line-height: 1.5em;"><table cellspacing="2" width="960">';
	foreach ($niz as $key=>$value) {
		if ($key == "" && $value == "") {
			$html .= "<tr><td></td><td></td></tr>";
		} else {
			$html .= '<tr>
						<td width="160" align="right">'.$key.':&nbsp;&nbsp;</td><td><i>'.$value.'</i></td>
					  </tr>';
		}
	}
	$html .= '</table></p>';
	$pdf->writeHTML($html);
}

function kreirajPDF($osoba) {
	$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('EESTEC JOBFAIR 2011 CV GENERATOR');
	$pdf->SetTitle('Curriculum Vitae');
	$pdf->SetSubject('Curriculum Vitae');
	$pdf->SetKeywords('CV');
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
	$pdf->setLanguageArray($l);
	$pdf->setFontSubsetting(true);
	$pdf->SetFont('helvetica', '', 10, '', true);
	$pdf->SetAutoPageBreak(true, 15);
	$pdf->AddPage();

	ispisiNaslov("Nedim", $pdf);
	$niz["ja"]="nedim";
	$niz["ti"]="ti";
	ispisiNiz($niz, $pdf);

	return $pdf->Output('JobFair2011_CV.pdf', 'FD');
}

function posaljiMail($to, $pdfData, $info) { 
  if (isset($info['subject']))
	  $subject = $info['subject'];
  else 
	  $subject = "[JobFair 2011] Vas CV je spreman!";
 
  if (isset($info['from']))
	  $from = $info['from'];
  else
	  $from = "noreply@jobfair.com";
  
  if (isset($info['message']))
	  $poruka = $info['message']."\n";
  else
	  $poruka = "Postovani,\nu prilogu se nalazi Vas CV koji ste ispunili na nasoj web stranici.";

  $random_hash = md5(date('r', time()));
  
  $headers = "From: $from\r\nReply-To: $from";
 
  $headers .= "\r\nContent-Type: multipart/mixed; boundary=\"PHP-mixed-".$random_hash."\"";
 
  $attachment = chunk_split(base64_encode($pdfData));

  $output = "
--PHP-mixed-$random_hash
Content-Type: multipart/alternative; boundary='PHP-alt-$random_hash'

".$poruka."

--PHP-mixed-$random_hash
Content-Type: application/pdf; name=JobFair2011_CV.pdf
Content-Transfer-Encoding: base64
Content-Disposition: attachment
 
$attachment
--PHP-mixed-$random_hash--";
		 
	mail($to, $subject, $output, $headers);
}

?>