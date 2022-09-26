<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Estágio</title>
        <link rel="stylesheet" href="./CSS/style.css">
        <script type="text/javascript" src="./JavaScript/script.js"></script>
    </head>
    <body>
        <?php
            include('connect.inc.php');    
            $id = $_POST['id'];        
            $sql = "SELECT ID, Nome, Custo, Data_Limite  
            FROM tarefas
            WHERE ID = '$id'";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()) 
            {         
                $nome = $row['Nome'];
                $id = $row['ID'];
                $custo = $row['Custo'];
                $data_limite = $row['Data_Limite'];
                $destaque_custo = 'normal';   
                echo "
                <div class='um'>
                        <form class = 'formulário_edit um' id='form1' method='POST' action='insere_dados.php'>            
                        <h2>Atualizar Tarefa:</h2>                                    
                        <input type='hidden' name='action' value='update'>                                    
                        <input type='hidden' name='id' value='$id'>
                        <p><b>Nome da Tarefa</b> 
                                <input type='text' name='nome' id = 'nome' value='$nome'>
                            </p>
                            
                            <p><b>Custo(R$)</b> 
                                <input type='text' name='custo' id = 'custo' value='$custo'>
                            </p>        

                            <p><b>Data Limite</b> 
                                <input type='date' name='data_limite' id = 'data_limite'value='$data_limite'>
                            </p>
                            
                            <div>
                                <b>&nbsp;</b><br>
                                <input type='button' class='botões' value='Enviar' onclick='verifica_campos()'>
                                <button type='button' class='botões' onclick='window.close();'>Cancelar</button>
                            </div>
                            
                        </form>
                    </div>
                </div>";
            }
        ?>
    </body>
    
</html>