<?php
error_reporting(0);
function breakString($seq)
{
    $str = "";
    $cnt = 1;
    if(strlen($seq)>=90)
    {
        for($i=0;$i<=strlen($seq)-1;$i++)
        {
            if($cnt==90)
            {
                $str.= substr($seq,$i,1)."^";
                $cnt = 1;
            }
            else
            {
                $str.= substr($seq,$i,1);
                $cnt++;
            }
        }
    }
    else
    {
        $str = $seq;
    }
    return $str;
}


$SEQ = $_POST["seq"];
$PROG = $_POST["prog"];
$DBASE = $_POST["dbase"];
$E_VAL = $_POST["evalue"];

if($SEQ == "")
{
	echo "<img src='images/back.jpg' style='float:left;cursor:pointer;margin-left:20px;' alt='' title='' onclick=\"javascript:document.getElementById('dvRes').style.display='none';document.getElementById('dvForm').style.display='block';\" />";
	echo "<br /><br />";
	echo "<label style='color:#FF0000;font-weight:bold;margin-left:20px;'>Error: Please Enter Sequence...<label>";
	return;
}

$myfile = fopen("../blast/query.fsa", "w") or die("Unable to open file!");
fwrite($myfile, $SEQ);
fclose($myfile);

if($PROG == "BlastP")
{
	$command = "\"..\blast\blastp.exe\" -query \"../blast/query.fsa\" -db \"../blast/prot_db/$DBASE\" -out \"../blast/res.xml\" -evalue $E_VAL -outfmt 5";
}
else
{
	$command = "\"..\blast\blastn.exe\" -query \"../blast/query.fsa\" -db \"../blast/nucl_db/$DBASE\" -out \"../blast/res.xml\" -evalue $E_VAL -outfmt 5";
}
passthru($command);

$sResp = "";
$sResp .= "<img src='images/back.jpg' style='float:left;cursor:pointer;margin-left:20px;' alt='' title='' onclick=\"javascript:document.getElementById('dvRes').style.display='none';document.getElementById('dvForm').style.display='block';\" />";
$sResp .= "<table cellpadding='0' cellspacing='0' class=\"tbluser\">";
$sResp .= "<tr>";
$sResp .= "<th></th>";
$sResp .= "<th>QUERY</th>";
$sResp .= "<th>IDENTITY</th>";
$sResp .= "<th>SIMILARITY</th>";
$sResp .= "<th>QUERY COVERAGE</th>";
$sResp .= "<th>BIT SCORE</th>";
$sResp .= "<th>E-VALUE</th>";
$sResp .= "</tr>";

$xml = simplexml_load_file("../blast/res.xml") or die("<img src='images/back.jpg' style='float:left;cursor:pointer;margin-left:20px;' alt='' title='' onclick=\"javascript:document.getElementById('dvRes').style.display='none';document.getElementById('dvForm').style.display='block';\" /><br /><br /><label style='color:#FF0000;font-weight:bold;margin-left:20px;'>Error: Check Parameters<label>");
$HIT_CNT = count($xml->BlastOutput_iterations[0]->Iteration[0]->Iteration_hits[0]->Hit);
for($i=0;$i<=$HIT_CNT-1;$i++)
{
	$QUERY = $xml->BlastOutput_iterations[0]->Iteration[0]->Iteration_hits[0]->Hit[$i]->{"Hit_def"};
	if(strlen($QUERY)>20)
	{
		$QUERY = substr($QUERY,0,20)."...";
	}
	$Hsp_align_len = $xml->BlastOutput_iterations[0]->Iteration[0]->Iteration_hits[0]->Hit[$i]->Hit_hsps[0]->Hsp[0]->{"Hsp_align-len"};
	$Hsp_identity = $xml->BlastOutput_iterations[0]->Iteration[0]->Iteration_hits[0]->Hit[$i]->Hit_hsps[0]->Hsp[0]->{"Hsp_identity"};
	$Hsp_positive = $xml->BlastOutput_iterations[0]->Iteration[0]->Iteration_hits[0]->Hit[$i]->Hit_hsps[0]->Hsp[0]->{"Hsp_positive"};
	$Hsp_query_to = $xml->BlastOutput_iterations[0]->Iteration[0]->Iteration_hits[0]->Hit[$i]->Hit_hsps[0]->Hsp[0]->{"Hsp_query-to"};
	$Hsp_query_from = $xml->BlastOutput_iterations[0]->Iteration[0]->Iteration_hits[0]->Hit[$i]->Hit_hsps[0]->Hsp[0]->{"Hsp_query-from"};
	
	$IDEN = round(floatval(($Hsp_identity/$Hsp_align_len)*100),1);
	$SIMI = round(floatval(($Hsp_positive/$Hsp_align_len)*100),1);
	
	$x = ($Hsp_query_to - $Hsp_query_from)+1;
	$Q_COVER = round(floatval(($x/$Hsp_align_len)*100),1);
	$BIT_SCORE = $xml->BlastOutput_iterations[0]->Iteration[0]->Iteration_hits[0]->Hit[$i]->Hit_hsps[0]->Hsp[0]->{"Hsp_bit-score"};
	$E_VAL = $xml->BlastOutput_iterations[0]->Iteration[0]->Iteration_hits[0]->Hit[$i]->Hit_hsps[0]->Hsp[0]->{"Hsp_evalue"};
	
	if($i%2==0)
		$sResp .= "<tr>";
	else
		$sResp .= "<tr class='alt'>";

	$sResp .= "<td><img src='images/more.png' style='cursor:pointer;' onClick=\"funShowAlign('$i');\" /></td>";
	$sResp .= "<td>$QUERY</td>";
	$sResp .= "<td>$IDEN %</td>";
	$sResp .= "<td>$SIMI %</td>";
	$sResp .= "<td>$Q_COVER %</td>";
	$sResp .= "<td>$BIT_SCORE</td>";
	$sResp .= "<td>$E_VAL</td>";
	$sResp .= "</tr>";
	
	$sResp .= "<tr id='tr".$i."' style='display:none;'>";
	$sResp .= "<td id='td".$i."' colspan='7' style='border:1px solid #000000;font-family:courier new;'>";
	
	$Hsp_qseq = $xml->BlastOutput_iterations[0]->Iteration[0]->Iteration_hits[0]->Hit[$i]->Hit_hsps[0]->Hsp[0]->{"Hsp_qseq"};
	$Hsp_midline = $xml->BlastOutput_iterations[0]->Iteration[0]->Iteration_hits[0]->Hit[$i]->Hit_hsps[0]->Hsp[0]->{"Hsp_qseq"};
	$Hsp_hseq = $xml->BlastOutput_iterations[0]->Iteration[0]->Iteration_hits[0]->Hit[$i]->Hit_hsps[0]->Hsp[0]->{"Hsp_hseq"};
	
	$sp_qseq = breakString($Hsp_qseq);
	$sp_midline = breakString($Hsp_midline);
	$sp_hseq = breakString($Hsp_hseq);
	
	$ar_qseq = Array();
	$ar_qseq = explode('^',$sp_qseq);
	
	$ar_midline = Array();
	$ar_midline = explode('^',$sp_midline);
	
	$ar_hseq = Array();
	$ar_hseq = explode('^',$sp_hseq);
	
	for($a=0;$a<=count($ar_qseq)-1;$a++)
	{
		$sResp .= "Query&nbsp;&nbsp;".$ar_qseq[$a]."<br />";
		$sResp .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$ar_midline[$a]."<br />";
		$sResp .= "Sbjct&nbsp;&nbsp;".$ar_hseq[$a]."<br />";
		$sResp .= "<br />";
	}
	
	
	$sResp .= "</td>";
	$sResp .= "</tr>";
	
}

echo $sResp;


?>