<?php
include('connect.inc.php');
$tarefas = $_POST['arrayordem'];

$cont_ordem = 1;
foreach($tarefas as $id)
{
	$sql = "UPDATE tarefas SET Ordem_Apresentacao = $cont_ordem WHERE ID = $id";
	$result = $conn->query($sql);	
	$cont_ordem++;
}
echo "<span style='color: green;'>Alterado com sucesso</span>";