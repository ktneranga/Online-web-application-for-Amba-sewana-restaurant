<?php 

function fetch_data()
{
	$output = '';
	$connection = mysqli_connect("localhost", "root", "", "restdb");
	$sql = "SELECT foods.id, foods.name, category.category, foods.price, foods.thumbnail, foods.description, foods.qty, foods.is_available ";
        $sql .= "FROM foods ";
        $sql .= "JOIN category ";
        $sql .= "ON foods.cat_id = category.id ";
        $sql .= "WHERE is_available = 1";

        $result = mysqli_query($connection, $sql);
        while($row = mysqli_fetch_array($result))
        {
        	$output .= '<tr>
			<td>'.$row["name"].'</td>  
			<td>'.$row["category"].'</td>  
			<td>'.$row["price"].'</td>  
			<td>'.$row["qty"].'</td>
			</tr>  
			'; 
        } 
        return $output;   
}


	if (isset($_POST['generate_pdf'])) {
		require_once('tcpdf.php');
		$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
		$obj_pdf->SetCreator(PDF_CREATOR);  
		$obj_pdf->SetTitle("The List of Unavailable Food Items");  
		$obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
		$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
		$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
		$obj_pdf->SetDefaultMonospacedFont('helvetica');  
		$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
		$obj_pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
		$obj_pdf->setPrintHeader(false);  
		$obj_pdf->setPrintFooter(false);  
		$obj_pdf->SetAutoPageBreak(TRUE, 10);  
		$obj_pdf->SetFont('helvetica', '', 11);  
		$obj_pdf->AddPage();
		$content = '';  
		$content .= ' 
		<h4 align="center">The List of Unavailable Food Items</h4><br /> 
		<table border="1" cellspacing="0" cellpadding="3">  
		<tr>  
		<th width="30%">Food Name</th>  
		<th width="30%">Category</th>  
		<th width="20%">Price</th>  
		<th width="20%">Qty</th>  
		</tr>  
		';   
		$content .= fetch_data();  
		$content .= '</table>';  
		$obj_pdf->writeHTML($content);  
		$obj_pdf->Output('file.pdf', 'I');
	}

 ?>

<!DOCTYPE html>  
<html>  
<head>  
<title>Ambasewana Restaurant</title>  
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />            
</head>  
<body> 
<br />
<div class="container">  
<h4 align="center">Unavailable Food Items</h4><br/>  
<div class="table-responsive">  
<div class="col-md-12" align="right">
<form method="post">  
<input type="submit" name="generate_pdf" class="btn btn-success" value="Generate PDF" />  
</form>
</div>
<br/>
<br/>
<table class="table table-bordered">  
<tr>  
<th width="30%">Food Name</th>  
<th width="30%">Category</th>  
<th width="20%">Price</th>  
<th width="20%">Qty</th>  
</tr>  
<?php  
echo fetch_data();  
?>  
</table>  
</div>  
</div>  
</body>  
</html>  	