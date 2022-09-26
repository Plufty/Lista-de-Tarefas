<?php
include('connect.inc.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Estágio</title>
        <link rel="stylesheet" href="./CSS/style.css">
        <script type="text/javascript" src="./JavaScript/script.js"></script>
    </head>
    <body onunload="window.opener.location.reload();">
		<h1>Tarefas</h1>
		<div id="msg"></div>
		<?php
							
							echo "<div class='itens'>
							<div class='atributos'>
							ID
							</div>
							<div class='atributos'>
							Nome da Tarefa
							</div>
							<div class='atributos'>
							Custo
							</div>
							<div class='atributos'>
							Data Limite
							</div>
							<div class='atributos'>                            
								Ação
							</div>
						</div>";
		?>
		<ul id="lista">
			<?php

			$sql = "SELECT * FROM tarefas ORDER BY Ordem_Apresentacao ASC";
			$result = $conn->query($sql);
			
			$sem_resultados = TRUE;

			if ($result->num_rows > 0) 
			{                    
				$sem_resultados = FALSE;
				
				// Dados de cada registro
				while($row = $result->fetch_assoc())
				{                        
					$nome = $row['Nome'];
					$id = $row['ID'];
					$custo = number_format($row['Custo'],2,',', '.');
					$data_limite = $row['Data_Limite'];
					$destaque_custo = 'normal';
					$ordem_apresentacao = $row['Ordem_Apresentacao'];
					if($row['Custo'] >= 1000)
					{                         
						$destaque_custo = 'amarelo';
					}
					?>
					<li class = "item <?php echo $destaque_custo; ?>" id="arrayordem_<?php echo $id; ?>">
						<?php
						echo "<div class='itens'>
								<div class='atributos'>
								$id
								</div>
								<div class='atributos'>
								$nome
								</div>
								<div class='atributos'>
								$custo
								</div>
								<div class='atributos'>
								$data_limite
								</div>
								<div class='atributos'>                           
									<form id='delete$id' method='POST' action='insere_dados.php'>
										<input type='hidden' id='nome_tarefa$id' value='$nome'>                                    
										<input type='hidden' name='action' value='delete'>                                    
										<input type='hidden' name='id' value='$id'> 
										<input type='button' class='botões' value='Excluir' onclick='exclui_tarefa($id)'>                                            
									</form>                                    
									<form id='edit' method='POST' action='editar.php' onsubmit='editar_tarefa(this)'>                 
										<input type='hidden' name='action' value='update'>                                    
										<input type='hidden' name='id' value='$id'> 
										<input type='submit' class='botões' value='Atualizar'>                                            
									</form>
								</div>
							</div>";
									
						?>
					</li>
					<?php
				}                                    
                    
			}
			if($sem_resultados)
			{
				echo "Sem Resultados.";
			}
			echo "<BR><button class='botões'><a style = ' text-decoration:none; color:white' href='incluir.php'>Incluir</a></button> ";
			
			?>
		</ul>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
		<script>
			$(document).ready(function () 
			{
                $(function () 
				{
                    $("#lista").sortable({update: function () 
						{
							var ordem_atual = $(this).sortable("serialize");
							$.post("muda_ordem.php", ordem_atual, function (retorno) 
							{
								//Imprimir retorno do arquivo proc_alt_ordem.php
								$("#msg").html(retorno);
								//Apresentar a mensagem leve
								$("#msg").slideDown('slow');
								retirarMsg();
							});
						}
                    });
                });
				
				//Retirar a mensagem após 1700 milissegundos
				function retirarMsg()
				{
					setTimeout( function ()
					{
						$("#msg").slideUp('slow', function(){});
					}, 1700);
				}
            });
		</script>
    </body>
</html>
