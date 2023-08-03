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
		
		<a href="index.php?page=add" class='btn btn-primary'>+ Add New</a><br /><br />
		
		<?php
		
		if(isset($_GET["id"]))
		{
			$db->query("delete from mstr_enzyme where id=?",$_GET["id"]);
		}
		
		
		$rRows = $db->query("select * from mstr_enzyme")->fetchAll();
		$rowCnt = count($rRows);
	
		if($rowCnt>0)
		{
			echo "<table class='table table-bordered'>";
			echo "<tr>";
			echo "<th>ACCESION</th>";
			echo "<th>PROTEIN NAME</th>";
			echo "<th>GENE NAME</th>";
			echo "<th>ORGANISM</th>";
			echo "<th>#</th>";
			echo "<th>#</th>";
			echo "</tr>";
			foreach($rRows as $rRow)
			{
				echo "<tr>";
				echo "<td>".$rRow["acc_id"]."</td>";
				echo "<td>".$rRow["protein_name"]."</td>";
				echo "<td>".$rRow["gene_name"]."</td>";
				echo "<td>".$rRow["org"]."</td>";
				echo "<td><a href='index.php?page=add&id=".$rRow["id"]."' class='btn btn-primary'>Edit</a></td>";
				echo "<td><a href='index.php?page=db&id=".$rRow["id"]."' class='btn btn-primary' onclick='javascript:return confirm(\"Are You Sure?\");'>Delete</a></td>";
				echo "</tr>";
			}
			echo "<table>";
		}
		
		
		?>
		
		
		
		</div>
		</div>