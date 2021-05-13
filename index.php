<?php
$tax_percent = 10;
$imported_tax_percent = 5;

$arr_product = array();
$arr_product[0] = "book";
$arr_product[1] = "music CD";
$arr_product[2] = "chocolate bar";
$arr_product[3] = "imported chocolate box";
$arr_product[4] = "imported perfume bottle";
$arr_product[5] = "perfume bootle";
$arr_product[6] = "packet of headache pills";

$product_tax_excluse = array();
$product_tax_excluse[0] = "y";
$product_tax_excluse[1] = "n";
$product_tax_excluse[2] = "y";
$product_tax_excluse[3] = "y";
$product_tax_excluse[4] = "n";
$product_tax_excluse[5] = "n";
$product_tax_excluse[6] = "y";

$product_imported = array();
$product_imported[0] = "n";
$product_imported[1] = "n";
$product_imported[2] = "n";
$product_imported[3] = "y";
$product_imported[4] = "y";
$product_imported[5] = "n";
$product_imported[6] = "n";
?>
<html>
<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
</head>
<body>
<div class="container">
<?php
class tax_calc {
   	function __construct() {
   	}

   	function calc($price, $qty, $product_tax_excluse, $tax_percent, $product_imported, $imported_tax_percent) {
    	// calcolo il totale per la quantità acquistata
    	$total_price = $price * $qty;
    	//echo "$total_price $price $qty<br>";

	    // controllo che il prodotto non sia escluso dalle tasse
	    if ($product_tax_excluse == "n") {
	    	// calcolo delle tasse
	    	$total_tax = round(($total_price * $tax_percent) / 100, 2);
    		$total_price += $total_tax;
    		//echo "$total_tax $total_price<br>";
	    }
	    
	    // controllo che il prodotto sia stato importato
	    if ($product_imported == "y") {
	    	$total_tax_imported = round((($price * $qty) * $imported_tax_percent) / 100, 2);
    		$total_price += $total_tax_imported;
    		//echo "$total_tax_imported $total_price<br>";
	    }

	    return $total_price;
   	}

   	function tax($price, $qty, $product_tax_excluse, $tax_percent, $product_imported, $imported_tax_percent) {
    	// calcolo il totale per la quantità acquistata
    	$total_price = $price * $qty;
    	$total_tax = 0;

	    // controllo che il prodotto non sia escluso dalle tasse
	    if ($product_tax_excluse == "n") {
	    	// calcolo delle tasse
	    	$total_tax += round(($total_price * $tax_percent) / 100, 2);
    		//echo "product_tax_excluse $total_tax<br>";
	    }
	    
	    // controllo che il prodotto sia stato importato
	    if ($product_imported == "y") {
	    	$total_tax += round((($price * $qty) * $imported_tax_percent) / 100, 2);
    		//echo "product_imported $total_tax<br>";
	    }

	    return $total_tax;
   	}
}

if ($_POST) {
	// data from input 1
    $qty0 = $_POST["qty0"];
    $qty1 = $_POST["qty1"];
    $qty2 = $_POST["qty2"];

    $prd0 = $_POST["prod0"];
    $prd1 = $_POST["prod1"];
    $prd2 = $_POST["prod2"];

    $price0 = $_POST["price0"];
    $price1 = $_POST["price1"];
    $price2 = $_POST["price2"];

    $final_total1 = 0;
    $final_total2 = 0;
    $final_total3 = 0;
    $total_tax = 0;

    $obj_tax = new tax_calc();

    //---------------------------------------------------------------------------------------- 1
    if ($qty0 > 0) {
		$total_price0 = $obj_tax->calc($price0, $qty0, $product_tax_excluse[$prd0], $tax_percent, $product_imported[$prd0], $imported_tax_percent);
    	$total_tax0 = $obj_tax->tax($price0, $qty0, $product_tax_excluse[$prd0], $tax_percent, $product_imported[$prd0], $imported_tax_percent);

	    $final_total1 += $total_price0;
	    echo $qty0." ".$arr_product[$prd0]." ".$total_price0."<br />";
	}

    //---------------------------------------------------------------------------------------- 2
    if ($qty1 > 0) {
		$total_price1 = $obj_tax->calc($price1, $qty1, $product_tax_excluse[$prd1], $tax_percent, $product_imported[$prd1], $imported_tax_percent);
    	$total_tax1 = $obj_tax->tax($price1, $qty1, $product_tax_excluse[$prd1], $tax_percent, $product_imported[$prd1], $imported_tax_percent);

	    $final_total1 += $total_price1;
	    echo $qty1." ".$arr_product[$prd1]." ".$total_price1."<br />";
	}

    //---------------------------------------------------------------------------------------- 3
    if ($qty2 > 0) {
		$total_price2 = $obj_tax->calc($price2, $qty2, $product_tax_excluse[$prd2], $tax_percent, $product_imported[$prd2], $imported_tax_percent);
    	$total_tax2 = $obj_tax->tax($price2, $qty2, $product_tax_excluse[$prd2], $tax_percent, $product_imported[$prd2], $imported_tax_percent);

	    $final_total1 += $total_price2;
	    echo $qty2." ".$arr_product[$prd2]." ".$total_price2."<br />";
	}

    if ($final_total1 > 0) {
    	$total_tax = $total_tax0 + $total_tax1 + $total_tax2;
	    echo 'Tax sales: '.$total_tax.'<br />';
	    echo 'Total: '.$final_total1.'<br />';
	    echo '<br />';
	}

	// data from input 2
    $qty0 = $_POST["qty3"];
    $qty1 = $_POST["qty4"];

    $prd0 = $_POST["prod3"];
    $prd1 = $_POST["prod4"];

    $price0 = $_POST["price3"];
    $price1 = $_POST["price4"];

    $final_total1 = 0;
    $final_total2 = 0;
    $final_total3 = 0;
    $total_tax = 0;

    //---------------------------------------------------------------------------------------- 1
    if ($qty0 > 0) {
		$total_price0 = $obj_tax->calc($price0, $qty0, $product_tax_excluse[$prd0], $tax_percent, $product_imported[$prd0], $imported_tax_percent);
    	$total_tax0 = $obj_tax->tax($price0, $qty0, $product_tax_excluse[$prd0], $tax_percent, $product_imported[$prd0], $imported_tax_percent);

	    $final_total1 += $total_price0;
	    echo $qty0." ".$arr_product[$prd0]." ".$total_price0."<br />";
	}

    //---------------------------------------------------------------------------------------- 2
    if ($qty1 > 0) {
		$total_price1 = $obj_tax->calc($price1, $qty1, $product_tax_excluse[$prd1], $tax_percent, $product_imported[$prd1], $imported_tax_percent);
    	$total_tax1 = $obj_tax->tax($price1, $qty1, $product_tax_excluse[$prd1], $tax_percent, $product_imported[$prd1], $imported_tax_percent);

	    $final_total1 += $total_price1;
	    echo $qty1." ".$arr_product[$prd1]." ".$total_price1."<br />";
	}

    if ($final_total1 > 0) {
    	$total_tax = $total_tax0 + $total_tax1;
	    echo 'Tax sales: '.$total_tax.'<br />';
	    echo 'Total: '.$final_total1.'<br />';
	    echo '<br />';
	}

	// data from input 3
    $qty0 = $_POST["qty5"];
    $qty1 = $_POST["qty6"];
    $qty2 = $_POST["qty7"];
    $qty3 = $_POST["qty8"];

    $prd0 = $_POST["prod5"];
    $prd1 = $_POST["prod6"];
    $prd2 = $_POST["prod7"];
    $prd3 = $_POST["prod8"];

    $price0 = $_POST["price5"];
    $price1 = $_POST["price6"];
    $price2 = $_POST["price7"];
    $price3 = $_POST["price8"];

    $final_total1 = 0;
    $final_total2 = 0;
    $final_total3 = 0;
    $total_tax = 0;

    $obj_tax = new tax_calc();

    //---------------------------------------------------------------------------------------- 1
    if ($qty0 > 0) {
		$total_price0 = $obj_tax->calc($price0, $qty0, $product_tax_excluse[$prd0], $tax_percent, $product_imported[$prd0], $imported_tax_percent);
    	$total_tax0 = $obj_tax->tax($price0, $qty0, $product_tax_excluse[$prd0], $tax_percent, $product_imported[$prd0], $imported_tax_percent);

	    $final_total1 += $total_price0;
	    echo $qty0." ".$arr_product[$prd0]." ".$total_price0."<br />";
	}

    //---------------------------------------------------------------------------------------- 2
    if ($qty1 > 0) {
		$total_price1 = $obj_tax->calc($price1, $qty1, $product_tax_excluse[$prd1], $tax_percent, $product_imported[$prd1], $imported_tax_percent);
    	$total_tax1 = $obj_tax->tax($price1, $qty1, $product_tax_excluse[$prd1], $tax_percent, $product_imported[$prd1], $imported_tax_percent);

	    $final_total1 += $total_price1;
	    echo $qty1." ".$arr_product[$prd1]." ".$total_price1."<br />";
	}

    //---------------------------------------------------------------------------------------- 3
    if ($qty2 > 0) {
		$total_price2 = $obj_tax->calc($price2, $qty2, $product_tax_excluse[$prd2], $tax_percent, $product_imported[$prd2], $imported_tax_percent);
    	$total_tax2 = $obj_tax->tax($price2, $qty2, $product_tax_excluse[$prd2], $tax_percent, $product_imported[$prd2], $imported_tax_percent);

	    $final_total1 += $total_price2;
	    echo $qty2." ".$arr_product[$prd2]." ".$total_price2."<br />";
	}

    //---------------------------------------------------------------------------------------- 4
    if ($qty3 > 0) {
		$total_price3 = $obj_tax->calc($price3, $qty3, $product_tax_excluse[$prd3], $tax_percent, $product_imported[$prd3], $imported_tax_percent);
    	$total_tax3 = $obj_tax->tax($price3, $qty3, $product_tax_excluse[$prd3], $tax_percent, $product_imported[$prd3], $imported_tax_percent);

	    $final_total1 += $total_price3;
	    echo $qty3." ".$arr_product[$prd3]." ".$total_price3."<br />";
	}

    if ($final_total1 > 0) {
    	$total_tax = $total_tax0 + $total_tax1 + $total_tax2 + $total_tax3;
	    echo 'Tax sales: '.$total_tax.'<br />';
	    echo 'Total: '.$final_total1.'<br />';
	    echo '<br />';
	}
} else {
?>
	<form id="form_data" name="form_data" method="post" action="">
		<fieldset>
			<legend><b>Input 1</b></legend>
			<br />
			<div class="row">
				<div class="col-md-4">
					<label>Quantity:</label> <input required="" class="form-control" name="qty0" type="text">
				</div>
				<div class="col-md-4">
					<label>Product:</label> 
					<select name="prod0" class="form-control" required="">
<?php
	foreach ($arr_product as $key => $value) {
		echo '<option value="'.$key.'">'.$value.'</option>';
	}
?>
					</select>
				</div>
				<div class="col-md-4">
					<label>Price:</label> <input required="" class="form-control" name="price0" type="text">
				</div>
			</div>
			<br />
			<div class="row">
				<div class="col-md-4">
					<label>Quantity:</label> <input required="" class="form-control" name="qty1" type="text">
				</div>
				<div class="col-md-4">
					<label>Product:</label> 
					<select name="prod1" class="form-control" required="">
<?php
	foreach ($arr_product as $key => $value) {
		echo '<option value="'.$key.'">'.$value.'</option>';
	}
?>
					</select>
				</div>
				<div class="col-md-4">
					<label>Price:</label> <input required="" class="form-control" name="price1" type="text">
				</div>
			</div>
			<br />
			<div class="row">
				<div class="col-md-4">
					<label>Quantity:</label> <input required="" class="form-control" name="qty2" type="text">
				</div>
				<div class="col-md-4">
					<label>Product:</label> 
					<select name="prod2" class="form-control" required="">
<?php
	foreach ($arr_product as $key => $value) {
		echo '<option value="'.$key.'">'.$value.'</option>';
	}
?>
					</select>
				</div>
				<div class="col-md-4">
					<label>Price:</label> <input required="" class="form-control" name="price2" type="text">
				</div>
			</div>
		</fieldset>
		<br />
		<fieldset>
			<legend><b>Input 2</b></legend>
			<br />
			<div class="row">
				<div class="col-md-4">
					<label>Quantity:</label> <input required="" class="form-control" name="qty3" type="text">
				</div>
				<div class="col-md-4">
					<label>Product:</label> 
					<select name="prod3" class="form-control" required="">
<?php
	foreach ($arr_product as $key => $value) {
		echo '<option value="'.$key.'">'.$value.'</option>';
	}
?>
					</select>
				</div>
				<div class="col-md-4">
					<label>Price:</label> <input required="" class="form-control" name="price3" type="text">
				</div>
			</div>
			<br />
			<div class="row">
				<div class="col-md-4">
					<label>Quantity:</label> <input required="" class="form-control" name="qty4" type="text">
				</div>
				<div class="col-md-4">
					<label>Product:</label> 
					<select name="prod4" class="form-control" required="">
<?php
	foreach ($arr_product as $key => $value) {
		echo '<option value="'.$key.'">'.$value.'</option>';
	}
?>
					</select>
				</div>
				<div class="col-md-4">
					<label>Price:</label> <input required="" class="form-control" name="price4" type="text">
				</div>
			</div>
			<br />
		</fieldset>
		<br />
		<fieldset>
			<legend><b>Input 3</b></legend>
			<div class="row">
				<div class="col-md-4">
					<label>Quantity:</label> <input required="" class="form-control" name="qty5" type="text">
				</div>
				<div class="col-md-4">
					<label>Product:</label> 
					<select name="prod5" class="form-control" required="">
<?php
	foreach ($arr_product as $key => $value) {
		echo '<option value="'.$key.'">'.$value.'</option>';
	}
?>
					</select>
				</div>
				<div class="col-md-4">
					<label>Price:</label> <input required="" class="form-control" name="price5" type="text">
				</div>
			</div>
			<br />
			<div class="row">
				<div class="col-md-4">
					<label>Quantity:</label> <input required="" class="form-control" name="qty6" type="text">
				</div>
				<div class="col-md-4">
					<label>Product:</label> 
					<select name="prod6" class="form-control" required="">
<?php
	foreach ($arr_product as $key => $value) {
		echo '<option value="'.$key.'">'.$value.'</option>';
	}
?>
					</select>
				</div>
				<div class="col-md-4">
					<label>Price:</label> <input required="" class="form-control" name="price6" type="text">
				</div>
			</div>
			<br />
			<div class="row">
				<div class="col-md-4">
					<label>Quantity:</label> <input required="" class="form-control" name="qty7" type="text">
				</div>
				<div class="col-md-4">
					<label>Product:</label> 
					<select name="prod7" class="form-control" required="">
<?php
	foreach ($arr_product as $key => $value) {
		echo '<option value="'.$key.'">'.$value.'</option>';
	}
?>
					</select>
				</div>
				<div class="col-md-4">
					<label>Price:</label> <input required="" class="form-control" name="price7" type="text">
				</div>
			</div>
			<br />
			<div class="row">
				<div class="col-md-4">
					<label>Quantity:</label> <input required="" class="form-control" name="qty8" type="text">
				</div>
				<div class="col-md-4">
					<label>Product:</label> 
					<select name="prod8" class="form-control" required="">
<?php
	foreach ($arr_product as $key => $value) {
		echo '<option value="'.$key.'">'.$value.'</option>';
	}
?>
					</select>
				</div>
				<div class="col-md-4">
					<label>Price:</label> <input required="" class="form-control" name="price8" type="text">
				</div>
			</div>
		</fieldset>
		<br />
		<div class="row">
			<div class="col-md-2">
				<button type="submit" class="btn btn-primary">Send</button>
			</div>
		</div>
	</form>
<?php
}
?>
</div>
</body>
</html>
