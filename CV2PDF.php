<?php
//error_reporting(0);
require_once('scripts/tcpdf/config/lang/eng.php');
require_once('scripts/tcpdf/tcpdf.php');
require_once('cv.php');

class MYPDF extends TCPDF {

	//Header
	public function Header() {
		// Logo
		$image_file = 'lykeion.png';
		$this->Image($image_file, 135, 5, 60, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		// Title
		$this->SetFont('dejavusans', '', 20, '', true);
		$this->SetY($this->GetY() + 8);
		$this->Cell(0, 0, 'Curriculum Vitae', 0, false, 'L', 0, '', 0, false, 'M', 'M');
		$this->SetLineWidth(0.4);
		$this->Line(15,27,195,27);
		$this->setTopMargin(35);
	}

	// Footer
	public function Footer() {
		$this->SetY(-15);
		$this->SetFont('dejavusans', 'I', 8);
		$this->Cell(-10, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
	}
}

/* Pomocne funkcije */
function ispisiNaslov($naslov, $pdf) {
	$pdf->SetFont('dejavusans', '', 12, '', true);
	$pdf->WriteHTML('<div style="background-color:#a0b5f8;color:white;">&nbsp;'.$naslov.'</div>');
	$pdf->SetFont('dejavusans', '', 10, '', true);
}

function ispisiLink($naslov, $pdf) {
	$pdf->SetFont('dejavusans', '', 12, '', true);
	$pdf->WriteHTML('<center><div >&nbsp;'.$naslov.'</div></center>');
	$pdf->SetFont('dejavusans', '', 10, '', true);
}

function ispisiNiz($niz, $pdf) {
	$html = '<p style="line-height: 1.5em;"><table  width="960" border="1" cellspacing="0" cellpadding="7" BORDERCOLOR="#a0b5f8">';
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

function kreirajPDF($osoba1) {
    $osoba=new Students_cv();
    $osoba=$osoba1;
	$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('EESTEC Lykeion Generator');
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
	$pdf->SetFont('dejavusans', '', 10, '', true);
	$pdf->SetAutoPageBreak(true, 15);
	$pdf->AddPage();
mb_internal_encoding("UTF-8");
        ispisiNaslov("Personal Information", $pdf);
        $personal=array();
        $personal["Name"]=$osoba->Name;
        $personal["Surname"]=iconv("UTF-8", "UTF-8//IGNORE",$osoba->Surname);
        $personal["City"]=$osoba->City;
        $personal["Country"]=$osoba->Country;
        if($osoba->Address!="") $personal["Address"]=$osoba->Address;
        if($osoba->Phone_number!="") $personal["Phone Number"]=$osoba->Phone_number;
        $personal["Email"]=$osoba->Email;
        if($osoba->Nationality!="") $personal["Nationality"]=$osoba->Nationality;
        $personal["Date of birth"]=$osoba->Date_of_birth;
        if($osoba->Fax!="") $personal["Fax"]=$osoba->Fax;
        $personal["Gender"]=$osoba->Gender;
        if($osoba->Desired_employment!="") $personal["Desired employment"]=$osoba->Desired_employment;
         
       
        ispisiNiz($personal, $pdf);
      
        ispisiNaslov("Work experience", $pdf);
        for($i=0; $i<sizeof($osoba->work_id); $i++){
            $work["Time"]=$osoba->fday[$i].".".$osoba->fmonth[$i].".".$osoba->fyear[$i]." to ".$osoba->tday[$i].".".$osoba->tmonth[$i].".".$osoba->tyear[$i];
            $work["Position"]=$osoba->position[$i];
            $work["Main activities and responsibilities"]=nl2br($osoba->activities[$i]);
            if($osoba->work_name[$i]!="") $work["Name of employer"]=$osoba->work_name[$i];
            if($osoba->work_adress[$i]!="") $work["Address of employer"]=$osoba->work_adress[$i];
            if($osoba->work_city[$i]!="") $work["City of employer"]=$osoba->work_city[$i];
            if($osoba->work_country[$i]!="") $work["Country of employer"]=$osoba->work_country[$i];
            if($osoba->sector[$i]!="") $work["Type of business or sector"]=$osoba->sector[$i];
            ispisiNiz($work, $pdf); unset($work);
        }

        ispisiNaslov("Education and training", $pdf);
        for($i=0; $i<sizeof($osoba->education_id); $i++){
            $education["Time"]=$osoba->org_fday[$i].".".$osoba->org_fmonth[$i].".".$osoba->org_fyear[$i]." - ".$osoba->org_tday[$i].".".$osoba->org_tmonth[$i].".".$osoba->org_tyear[$i];
            $education["Title of qualification awarded"]=$osoba->title[$i];
            $education["Principal subjects/occupational skills covered"]=nl2br($osoba->subject[$i]);
            $education["Name of organisation providing education or training"]=$osoba->org_name[$i];
            if($osoba->org_type[$i]!="") $education["Type of organisation providing education or training"]=$osoba->org_type[$i];
            if($osoba->org_address[$i]!="") $education["Address of organisation"]=$osoba->org_address[$i];
            $education["City of organisation"]=$osoba->org_city[$i];
            $education["Country of organisation"]=$osoba->org_country[$i];
            if($osoba->edu_level[$i]!="") $education["Level in national or international classification"]=$osoba->edu_level[$i]; 
            if($osoba->edu_field[$i]!="") $education["Education field"]=$osoba->edu_field[$i];
            ispisiNiz($education, $pdf); unset($education);
        }
        ispisiNaslov("Language skills", $pdf);
        $lan["European language levels - Self Assessment Grid"]="<a href='http://europass.cedefop.europa.eu/LanguageSelfAssessmentGrid/en'>http://europass.cedefop.europa.eu/LanguageSelfAssessmentGrid/en
</a>";
        ispisiNiz($lan, $pdf);
        $moth['Native language']=$osoba->Mother_tongue;
        ispisiNiz($moth, $pdf);
        $personal["Native language"]=$osoba->Mother_language;
        for($i=0; $i<sizeof($osoba->language_id); $i++){
                   $language["Language"]= $osoba->olanguage[$i];
                   $language["Listening"]= $osoba->listening[$i];
                   $language["Reading"]= $osoba->reading[$i];
                   $language["Spoken interaction"]= $osoba->spoken_interaction[$i];
                   $language["Spoken production"]= $osoba->spoken_production[$i];
                   $language["Writing"]= $osoba->writing[$i];
                   ispisiNiz($language, $pdf);
        }

        ispisiNaslov("Personal skills and competences", $pdf);

        if($osoba->Social_skills!="") $skills["Social skills and competences"]=nl2br($osoba->Social_skills);
        if($osoba->Organisational_skills!="") $skills["Organisational skills and competences"]=nl2br($osoba->Organisational_skills);
        if($osoba->Technical_skills!="") $skills["Technical skills and competences"]=nl2br($osoba->Technical_skills);
        if($osoba->Computer_skills!="") $skills["Computer skills and competences"]=nl2br($osoba->Computer_skills);
        if($osoba->Artistic_skills!="") $skills["Artistic skills and competences"]=nl2br($osoba->Artistic_skills);
        if($osoba->Other_skills!="") $skills["Other skills and competences"]=nl2br($osoba->Other_skills);
        if($osoba->Driving_licence==1) $skills["Driving licence"]="Yes";
        else $skills["Driving licence"]="No";
        if($osoba->Additional_information!="") $skills["Additional information"]=nl2br($osoba->Additional_information);
        if($osoba->Annexes) $skills["Annexes"]=nl2br($osoba->Annexes);
        ispisiNiz($skills, $pdf);
        $link="<a href='http://lykeion.eestec.net/'>lykeion.eestec.net</a>";
        //ispisiLink($link, $pdf);
		ob_clean();
	return $pdf->Output('Lykeion_CV.pdf', 'D');
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