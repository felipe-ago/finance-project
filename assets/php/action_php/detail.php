<?php

session_start();
require __DIR__ . '/../includes_php/connect_db.php';
$user_id = $_SESSION['id_usuario'];

// Consultar o banco de dados para obter os meses com lançamentos

$sql = "SELECT DISTINCT DATE_FORMAT(datetime, '%m-%Y') as monthYear, datetime FROM releases WHERE user_id = ? ORDER BY datetime DESC";

$stmt = mysqli_prepare($connect, $sql);
mysqli_stmt_bind_param($stmt, 'i', $user_id);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);

// Montar um array com os meses e seus respectivos lançamentos
$months = array();

$count = 0;

while ($row = mysqli_fetch_assoc($resultado)) {
  $monthYear = explode('-', $row['monthYear']);
  $month = $monthYear[0];
  $year = $monthYear[1];

  // Consultar o banco de dados para obter as despesas
  $sql = "SELECT SUM(launch_value) AS expenses FROM releases WHERE user_id = ? AND type = 'despesa' AND MONTH(datetime) = ? AND YEAR(datetime) = ?";
  $stmt = mysqli_prepare($connect, $sql);
  mysqli_stmt_bind_param($stmt, 'iii', $user_id, $month, $year);
  mysqli_stmt_execute($stmt);
  $resultadoDespesa = mysqli_stmt_get_result($stmt);

  if (mysqli_num_rows($resultadoDespesa) > 0) {
    $rowDespesa = mysqli_fetch_assoc($resultadoDespesa);
    $expenses = $rowDespesa['expenses'];
  }

  // Consultar o banco de dados para obter as receitas
  $sql = "SELECT SUM(launch_value) AS income FROM releases WHERE user_id = ? AND type = 'renda' AND MONTH(datetime) = ? AND YEAR(datetime) = ?";
  $stmt = mysqli_prepare($connect, $sql);
  mysqli_stmt_bind_param($stmt, 'iii', $user_id, $month, $year);
  mysqli_stmt_execute($stmt);
  $resultadoReceita = mysqli_stmt_get_result($stmt);

  if (mysqli_num_rows($resultadoReceita) > 0) {
    $rowReceita = mysqli_fetch_assoc($resultadoReceita);
    $income = $rowReceita['income'];
  }

  // Calcular o lucro do mês atual
  $profit = $income - $expenses;

  $months[] = [
    'month' => $month,
    'year' => $year,
    'expenses' => !empty($expenses) ? number_format($expenses, 2, ',', '.')   : 0,
    'income'   => !empty($income)   ? number_format($income,   2, ',', '.')   : 0,
    'profit'   => !empty($profit)   ? number_format($profit,   2, ',', '.')   : 0,
  ];
} 

$a = [];

for($i = 0; $i < count($months); $i ++){
  if($i !== 0){   
    if($months[$i - 1]['month'] != $months[$i]['month']){
      // Adicionar o mês e seus lançamentos ao array de meses
     $a[] = [
        'month' => $months[$i]['month'],
        'year' => $months[$i]['year'],
        'expenses' => $months[$i]['expenses'],
        'income'   => $months[$i]['income'],
        'profit'   => $months[$i]['profit'],
      ];
    }
  } else {
    $a[] = [
      'month' => $months[$i]['month'],
        'year' => $months[$i]['year'],
        'expenses' => $months[$i]['expenses'],
        'income'   => $months[$i]['income'],
        'profit'   => $months[$i]['profit'],
    ];
  }
}

// Ordenar os meses em ordem crescente
usort($a, function($a, $b) {
  return strtotime($a['year'] . '-' . $a['month'] . '-01') - strtotime($b['year'] . '-' . $b['month'] . '-01');
});

// Retornar o array de meses em formato JSON
echo json_encode($a);

mysqli_close($connect);


?>
