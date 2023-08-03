   <script type="text/javascript">
   function funValidate()
   {
	   if(document.getElementById('txtAcc').value.trim() == "")
	   {
		   alert('Please Enter Accession No.!!');
		   document.getElementById('txtAcc').focus();
		   return false;
	   }
	   if(document.getElementById('txtProName').value.trim() == "")
	   {
		   alert('Please Enter Protein Name!!');
		   document.getElementById('txtProName').focus();
		   return false;
	   }
	   
	   return true;
   }
   
   </script>
   
   
   <?php
	$id=0;
	   $acc_id="";
	   $protein_name="";
	   $gene_name="";
	   $org="";
	   $seqeunce="";
	   $status="";
	   $chk = "";
   if(isset($_GET["id"]))
   {
	   $rRows = $db->query("select * from mstr_enzyme where id=?",$_GET["id"])->fetchArray();
	   
	   $id=$_GET["id"];
	   $acc_id=$rRows["acc_id"];
	   $protein_name=$rRows["protein_name"];
	   $gene_name=$rRows["gene_name"];
	   $org=$rRows["org"];
	   $seqeunce=$rRows["seqeunce"];
	   $status=$rRows["status"];
	   
	   if($status == "1")
	   {
		   $chk = "checked";
	   }
	   
   }
   
   ?>
   
   
   
   <!-- Page Header Start -->
    <div class="container-fluid bg-dark bg-img p-5 mb-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 text-uppercase text-white">Add To Database</h1>
                <a href="">Home</a>
                <i class="far fa-square text-primary px-2"></i>
                <a href="">Database</a>
            </div>
        </div>
    </div>
    <!-- Page Header End -->
	
	
	    <div class="container-fluid pt-5">
        <div class="container">
		
		<a href="index.php?page=db" class='btn btn-primary'><< Back</a><br /><br />
		
		<div class="col-md-6">
		
		<form name="frm" id="frm" action="index.php?page=save" method="POST" onsubmit="return funValidate();" >
  
  <div class="form-outline mb-3">
  <label class="form-label" for="txtAcc">Accession No.</label>
    <input type="text" id="txtAcc" name="txtAcc" class="form-control" value="<?php echo $acc_id;  ?>" />
    
  </div>
  
   <div class="form-outline mb-3">
  <label class="form-label" for="txtProName">Protein Name</label>
    <input type="text" id="txtProName" name="txtProName" class="form-control" value="<?php echo $protein_name;  ?>" />
    
  </div>
  
  <div class="form-outline mb-3">
  <label class="form-label" for="txtGeneName">Gene Name</label>
    <input type="text" id="txtGeneName" name="txtGeneName" class="form-control" value="<?php echo $gene_name;  ?>" />
  </div>
  
   <div class="form-outline mb-3">
  <label class="form-label" for="txtOrg">Organism</label>
    <input type="text" id="txtOrg" name="txtOrg" class="form-control" value="<?php echo $org;  ?>" />
  </div>
  
  
   <div class="form-outline mb-3">
  <label class="form-label" for="txtSeq">Sequence</label>
    <textarea id="txtSeq" name="txtSeq" rows=10 class="form-control"><?php echo $seqeunce;  ?></textarea>
  </div>
  
  <div class="form mb-3">
 <input type="checkbox" <?php echo $chk ?> name="chk" id="chk"  />&nbsp;&nbsp;<label for="chk">Display Status</label>
   
  </div>
  
   <div class="form-outline mb-3">
   <input type="Submit" value="Save Data" class="btn btn-primary" />
   <input type="hidden" name="hdnId" value="<?php echo $id;  ?>" /><!--for update-->
   
   </div>
   
  
  </form>
		
		</div>
		
		
		
		</div>
		</div>