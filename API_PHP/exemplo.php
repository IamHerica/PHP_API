<?php
 define('HOST', 'localhost');
 define('USER', 'root');
 define('PASSWORD', '');
 define('DB_NAME', 'aula7');

 $banco = new PDO('mysql:host='.HOST.';dbname='.DB_NAME, USER, PASSWORD);

 if($banco){
     echo("<br> Conexão ok!");
 }

 //Inserir funcionario
$nome = 'Felipe';
$departamento = 'TI';
$unidade = 'SP';

$novo_funcionario = array($nome, $departamento, $unidade);
$gravar = $banco->prepare("INSERT INTO FUNCIONARIOS(nome, departamento, unidade) VALUES(?,?,?)");

if($gravar->execute($novo_funcionario)){
    echo("<br> Cadastro realizado!");
} else{
    echo("<br>Erro ao cadastrar usuário.");
}
 
//Consultar 
$consulta = $banco->prepare("SELECT * FROM FUNCIONARIOS");
$consulta->execute();
$linha = $consulta->fetchAll(PDO::FETCH_OBJ);

foreach($linha as $func){
    echo("<br> Nome = ".$func->nome.
    "<br> Departamento = ".$func->departamento.
    "<br> Unidade = ".$func->unidade);
}


//Update
$editar = $banco->prepare("UPDATE FUNCIONARIOS SET UNIDADE =? WHERE NOME=?");
$nome = "Herica";
$unidade = "Canada";
//$func = array($nome, $unidade);

$editar->execute(array($unidade, $nome));

if($editar){
    echo("<br> Atualizacão concluída");
} else {
    echo("Erro ao atualizar funcionário");
}



//DELETE

$nome = "Felipe";
$deletar = $banco->prepare("DELETE FROM FUNCIONARIOS WHERE NOME=?");
$deletar->execute(array($nome));

if($deletar){
    echo("<br> Funcionario excluido.");
} else {
    echo("<br> Erro ao excluir funcionario");
}
?>