<?php
    require_once '../core/sql.php';

    $id = 1;
    $nome = 'murilo';
    $email = 'murilo@gmail.com';
    $senha = '123mudar';
    $dados = ['nome' => $nome, 'email' => $email, 'senha' => $senha];

    $entidade = 'usuario';
    $criterio = [['id', '=', $id]];
    $campos = ['id', 'nome', 'email'];
    print_r($dados);
    echo '<br>';
    print_r($campos);
    echo '<br>';
    print_r($criterio);
    echo '<br>';

    //TESTE GERACAO INSERT
    $instrucao = Insert($entidade, $dados);
    echo $instrucao.'<BR>';

    //TESTE GERACAO UPDATE
    $instrucao = Update($entidade, $dados, $criterio);
    echo $instrucao.'<BR>';

    //TESTE GERACAO SELECT
    $instrucao = Select($entidade, $campos, $criterio);
    echo $instrucao.'<BR>';

    //TESTE GERACAO DELETE
    $instrucao = Delete($entidade, $criterio);
    echo $instrucao.'<BR>';
?>