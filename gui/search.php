<!-- Page Header Start -->
<div class="container-fluid bg-dark bg-img p-5 mb-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 text-uppercase text-white">Search Sequence</h1>
                <a href="">Home</a>
                <i class="far fa-square text-primary px-2"></i>
                <a href="">Search Sequence</a>
            </div>
        </div>
    </div>
    <!-- Page Header End -->
	
	
	  <div class="container-fluid pt-5">
      <div class="container">
		
		<a href="index.php?page=home" class='btn btn-primary'><< Back</a><br /><br />
		
		<div class="col-md-6">
		
		<form name="frm" id="frm" action="#" method="POST" onsubmit="return funValidate();" >
  
  <div class="form-outline mb-3">
  <label class="form-label" for="txtAcc">Email:</label>
    <input type="email" id="email" name="email" class="form-control" />
    
  </div>
  
   <div class="form-outline mb-3">
  <label class="form-label" for="jobname">Job Name/Identifier:</label>
    <input type="text" id="jobname" name="jobname" class="form-control" />
    
  </div>
  
  <div class="form-group">
    <select class="form-select" aria-label="Default select example" name="dbase">
        <option selected>Select a Database</option>
        <option value="ChrA">chrA</option>
        <option value="chrB1">chrB1</option>
        <option value="chrC">chrC</option>
        <option value="chrE">chrE</option>
        <option value="chrF1">chrF1</option>
        <option value="chrI">chrI</option>
        <option value="chrR">chrR</option>
        <option value="srpC">srpC</option>
    </select>
    </div>
  

   <div class="form-outline mb-3">
  <label class="form-label" for="inpSeq">Input Sequence:</label>
    <textarea id="inpSeq" name="inpSeq" rows=10 class="form-control"></textarea>
  </div>
  
  
   <div class="form-outline mb-3">
   <input type="Submit" value="Search" class="btn btn-primary" />
   
   </div>
   
  
  </form>
		
</div>
		
		
</div>
</div>