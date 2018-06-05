<?php
include ('../data/class.balls.php');
$numberOfBalls = (int)$_GET['number'];
$solver = 0;

if ($numberOfBalls > 0 && $numberOfBalls < 11) {
    $solver = new solver($numberOfBalls);
    $generatedColors = $solver->colorDistribution;
    $proposedSolution = $solver->generateSolution();
}

ob_start();
include('../components/result.html');
$result = ob_get_contents();
ob_end_clean();
echo $result;
?>