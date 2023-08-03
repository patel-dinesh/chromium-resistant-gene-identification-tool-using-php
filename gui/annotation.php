<!-- Page Header Start -->
<div class="container-fluid bg-dark bg-img p-5 mb-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 text-uppercase text-white">Annotation Tool</h1>
                <a href="index.php?page=home">Home</a>
                <i class="far fa-square text-primary px-2"></i>
                <a href="">Annotation Tool</a>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


<form method="POST" action="index.php?page=tool">
<div class="container-fluid pt-6">
    <div class="container">
		
		<a href="index.php?page=home" class='btn btn-primary'><< Back</a><br /><br />
        
    <div class="form-group">
        <label for="seq">Enter Query Sequence :</label>
        <textarea class="form-control" id="seq" name="seq" rows="6"></textarea>
    </div>
    <br />

    <div class="form-group">
    <select class="form-select" aria-label="Default select example" name="type">
        <option selected>Open this select menu</option>
        <option value="blastp" name="blastp">BLAST</option>
        <option value="2" name="diamond">DIAMOND</option>
    </select>
    </div>

    <br>

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
        <option value="All">All</option>
    </select>
    </div>

    <br>
    <button class="btn btn-primary">SUBMIT</button>
    
    </div>
</div>
</form>