function verifica_campos()
{
    if(document.getElementById("nome").value == ""
        || document.getElementById("custo").value == ""
        || document.getElementById("data_limite").value == "")
    {
        alert('Por favor, preencha todos os campos');
        return false;
    }
    else
    {
        document.getElementById('form1').submit();
    }
}

function exclui_tarefa(x)
{
    nome = document.getElementById("nome_tarefa"+x).value;
    if(confirm('Tem certeza que deseja excluir a tarefa \"'+nome+'\"?'))
    {
        document.getElementById('delete'+x).submit();
    }
    else
    {
        return false;
    }
}

function editar_tarefa(form) 
{
    window.open('', 'formpopup', 'width=600,height=400,resizeable,scrollbars');
    form.target = 'formpopup';
    window.location.reload();
}

