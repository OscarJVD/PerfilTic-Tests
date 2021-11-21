<?php
// fopen("php://stdin", "r");
// while (false !== ($input = fgets(STDIN))) {
//   echo process_input($input) . "\n";
// }

$input = "Guitarra,002,300.00,9.00"; // La entrada es un string de texto separado por coma: "Producto,CódigoCategoria,Costo,Peso"

// echo process_input($input) . "\n";

// Separa lo ingresado y lo mete en la otra función
function process_input($input)
{
  // $params = split(",", $input);
  $params = explode(",", $input);
  return calculate_price($params[0], $params[1], $params[2], $params[3]);
}


/*
* Calcula el precio final del producto
* Arancel = Costo del Producto 10%
* IVA = (Costo del Producto + Costo de Envio + Arancel) 19%
* Costo total del producto puesto en Colombia =
* (Costo del Producto + Costo de Envio + Arancel + Iva)
*/
function calculate_price($product_name, $category, $cost, $weight)
{
  // Sumamos valor del peso
  $weightLength = intval($weight);

  // Costo de envío
  $shipping = 0;
  $shipping += intval((intval($weightLength / 4)) * 10); // por 4lb de peso + 10usd
  $shipping += intval((intval($weightLength % 4)) * 2); // por peso adicional + 2usd

  // Costos Arancel
  $arancel = $cost * 0.1;

  // Costo IVA
  if ($cost > 200)
    $iva = ($cost + $shipping + $arancel) * 0.19;
  else
    $iva = 0;

  $totalProductCost = ($cost + $shipping + $arancel + $iva);

  // Costo comision
  $comision = 0;

  if ($category == "001")
    $comision = $cost * 0.1;
  elseif ($category == "002")
    $comision = $cost * 0.05;
  elseif ($category == "003")
    $comision = $cost * 0.15;

  $interestDue = (($comision) / (1 - $comision));

  // $totalProductCost += $interestDue;
  // $totalProductCost += $totalProductCost * 0.1;

  // $totalProductCost += $comision;
  // $totalProductCost += $totalProductCost * 0.1;

  // $totalProductCost += $interestDue;
  // $totalProductCost += $cost * 0.1;

  // $totalProductCost += $comision;
  // $totalProductCost += $cost * 0.1;

  // $totalProductCost = $cost + ($cost + $interestDue) * 0.1;

  // $totalProductCost = $cost + ($cost + $comision) * 0.1;

  // $totalProductCost = $totalProductCost + ($cost + $interestDue) * 0.1;

  // $totalProductCost = $totalProductCost + ($cost + $comision) * 0.1;

  // $totalProductCost += $comision * 0.1;
  $totalProductCost = ($cost + $comision) * 0.1;

  $cost = number_format($totalProductCost, 2);

  return $product_name . "," . $cost;
}
