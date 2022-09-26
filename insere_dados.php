<?php 
include('connect.inc.php');

$action = $_POST['action'];

if($action == 'insert')
{
    $nome = $_POST['nome'];
    $custo = $_POST['custo'];
    $data_limite = $_POST['data_limite'];
    //testar se os dados vieram preenchidos corretamente.
    if($nome == "" || $custo == "" || $data_limite == "")
    {
        echo "Dados obrigatórios em branco, nada será cadastrado";
        $conn->close();
        header("Location: index.php");    
        exit();
    }

    else
    {
        $existe_tarefa = FALSE;

        $consulta_tarefa = "SELECT Nome FROM tarefas 
        WHERE Nome LIKE '$nome'";
        $result = $conn->query($consulta_tarefa);
        while($row = $result->fetch_assoc()) 
        {
            if ($result->num_rows > 0) 
            {
                $existe_tarefa = TRUE;
                break;
            }
        }
        if(!$existe_tarefa)
        {
            $sql = "INSERT INTO tarefas (Nome, Custo, Data_Limite) 
                VALUES ('$nome', '$custo', '$data_limite')";
            
            if ($conn->query($sql) === TRUE) 
            {
                echo "Novo registro de tarefa criado com sucesso!";
            } 
            else 
            {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            $define_ordem = "SELECT ID FROM tarefas 
            WHERE Nome LIKE '$nome'";
            $result = $conn->query($define_ordem);
            while($row = $result->fetch_assoc()) 
            {
                if ($result->num_rows > 0) 
                {
                    $ordem = $row['ID'];
                    $sql_ordem = "UPDATE tarefas
                          SET Ordem_Apresentacao = $ordem
                          WHERE ID = $ordem";
                            if ($conn->query($sql_ordem) === TRUE) 
                            {
                                echo "Ordem atualizada com sucesso!";
                            } 
                            else 
                            {
                                echo "Error: " . $sql_ordem . "<br>" . $conn->error;
                            }
                    break;
                }
            }
            
        }
        else
        {
            echo "<br>Tarefa já existente.";
        }   
    } 
    $conn->close();
    header("Location:index.php");
}
else if($action == 'delete')
{
    $id = $_POST['id'];
    
    $sql = "DELETE FROM tarefas 
            WHERE ID = $id";
    if ($conn->query($sql) === TRUE) 
    {
        echo "Registro excluído com sucesso!";
    } 
    else 
    {
        echo "Error: " . $sql . "<br>" . $conn->error;
    } 
    $conn->close();
    header("Location:index.php");

} 
else if($action == 'update')
{
    $existe_tarefa = FALSE;
    
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $custo = $_POST['custo'];
    $data_limite = $_POST['data_limite'];
    //testar se os dados vieram preenchidos corretamente.
    if($nome == "" || $custo == "" || $data_limite == "")
    {
        echo "Dados obrigatórios em branco, nada será cadastrado";
        $conn->close();
        header("Location: index.php");    
        exit();
    }

    $consulta_tarefa = "SELECT Nome FROM tarefas 
    WHERE Nome LIKE '$nome' AND ID != '$id' ";
    $result = $conn->query($consulta_tarefa);
    while($row = $result->fetch_assoc()) 
    {
        if ($result->num_rows > 0) 
        {
            $existe_tarefa = TRUE;
            break;
        }
    }
    if(!$existe_tarefa)
    {

        $sql = "UPDATE tarefas 
            SET Nome = '$nome', Custo = '$custo', Data_Limite = '$data_limite'
            WHERE ID = $id";
        
        if ($conn->query($sql) === TRUE) 
        {
            echo "<script>alert('Registro atualizado com sucesso!');
            opener.location.reload();
            window.close();</script>";
        } 
        else 
        {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    else
    {
        echo "<script>alert('Nome de tarefa já existente');
                      opener.location.reload();
                      window.close();</script>";
    } 
    $conn->close();

} 

    exit();
