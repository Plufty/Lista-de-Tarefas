<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Estágio</title>
        <link rel="stylesheet" href="./CSS/style.css">
        <script type="text/javascript" src="./JavaScript/script.js"></script>
    </head>
    <body>

        <div class="um">
            <form class = "formulário um" id="form1" method="POST" action="insere_dados.php">            
            <h2>Cadastro de Tarefa:</h2>                                                
            <input type='hidden' name='action' value='insert'>
            <p><b>Nome da Tarefa</b> 
                    <input type="text" name="nome" id = "nome">
                </p>
                
                <p><b>Custo(R$)</b> 
                    <input type="text" name="custo" id = "custo">
                </p>        

                <p><b>Data Limite</b> 
                    <input type="date" name="data_limite" id = "data_limite">
                </p>
                
                <div>
                    <b>&nbsp;</b><br>
                    <input type="button" class="botões" value="Enviar" onclick="verifica_campos()">
                    <button class='botões'><a style = 'text-decoration:none; color:white' href='index.php'>Voltar</a></button>
                </div>
                
            </form>
        </div>
    </body>
    
</html>