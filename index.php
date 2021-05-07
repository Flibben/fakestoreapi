<?php

header("Content-Type: application/json; charset=UTF-8");

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Referrer-Policy: no-referrer");

include_once 'products.php';

$dataArray = [];
$errorArray = [];

if (!isset($_GET['category'])) {
	$dataArray = $products;
} elseif (isset($_GET['category'])) {
	$category = $_GET['category'];

	switch ($category) {
		case "mens clothing":
			for ($i = 0; $i <= count($products) - 1; $i++) {
				if ($products[$i]['category'] === "mens clothing") {
					array_push($dataArray, $products[$i]);
				}
			}
			break;
		case "womens clothing":
			for ($i = 0; $i <= count($products) - 1; $i++) {
				if ($products[$i]['category'] == "womens clothing") {
					array_push($dataArray, $products[$i]);
				}
			}
			break;
		case "electronics":
			for ($i = 0; $i <= count($products) - 1; $i++) {
				if ($products[$i]['category'] == "electronics") {
					array_push($dataArray, $products[$i]);
				}
			}
			break;
		default:
			array_push($errorArray, ["Category" => $_GET['category'] . " is not a valid category"]);
	}
}

//Counts after category is chosen
$count = count($dataArray);

if (!isset($_GET['show'])) {
	//do nothing
} elseif (empty($_GET['show']) && $_GET['show'] != "0") {
	array_push($errorArray, [
		"show" => "invalid input"
	]);
} elseif (isset($_GET['show'])) {
	$show = $_GET['show'];
	shuffle($dataArray);
	$dataArray = array_slice($dataArray, 0, $show);
}

if ($_GET['show'] > 20) {
	array_push($errorArray, ["show" => "must be 20 or under"]);
}

if (count($errorArray)) {
	echo json_encode($errorArray, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
} else {
	echo json_encode($dataArray, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
}
