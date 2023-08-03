<?php
include "../cls/dbcls.php";
include "../cfg/config.php";

$acc_id = $_POST['acc_id'];
$protein_name = $_POST['protein_name'];
$gene_name = $_POST['gene_name'];
$org = $_POST['org'];


$stmt = $db->query("INSERT INTO mstr_enzyme(acc_id, protein_name, gene_name, org) VALUES (?, ?, ?, ?)",$acc_id, $protein_name, $gene_name, $org);

header("Location: ../index.php?page=db");

?>