<?php
include "cls/dbcls.php";
include "cfg/config.php";


$sPage = "";
$sContentPage = "";
if(isset($_GET["page"]))
{
	$sPage = $_GET["page"];
}
switch ($sPage)
{
	case "home":
	$sContentPage = "gui/home.php";
	break;
	
	case "about":
	$sContentPage = "gui/about.php";
	break;
	
	case "contact":
	$sContentPage = "gui/contact.php";
	break;
	
	case "db":
	$sContentPage = "gui/db.php";
	break;

	case "tool":
	$sContentPage = "gui/tool.php";
	break;

	case "search":
	$sContentPage = "gui/search.php";
	break;

	case "annotation":
	$sContentPage = "gui/annotation.php";
	break;
	
	case "add":
	$sContentPage = "gui/add.php";
	break;
	
	case "save":
 	$acc_id = $_POST["txtAcc"];
	$protein_name = $_POST["txtProName"];
	$gene_name = $_POST["txtGeneName"];
	$org = $_POST["txtOrg"];
	$seqeunce = $_POST["txtSeq"];
	
	if(isset($_POST["chk"]))
	{
		$status = "1";
	}
	else
	{
		$status = "0";
	}
	
	$id = $_POST["hdnId"]; // for update
	
	if($id == "0")
	{
		$db->query("insert into mstr_enzyme(acc_id,protein_name,gene_name,org,seqeunce,status)values(?,?,?,?,?,?)",$acc_id,$protein_name,$gene_name,$org,$seqeunce,$status);
	}
	else
	{
		$db->query("update mstr_enzyme set acc_id=?,protein_name=?,gene_name=?,org=?,seqeunce=?,status=? where id=?",$acc_id,$protein_name,$gene_name,$org,$seqeunce,$status,$id);
	}
	
	
	header("Location: index.php?page=db");
	break;
	
	
	default:
	$sContentPage = "gui/home.php";
	
}

include "inc/header.php";
include $sContentPage;
include "inc/footer.php";

?>
