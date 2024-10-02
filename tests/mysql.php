<?php
    require_once '../includes/funcoes.php';
    require_once '../core/conexao_mysql.php';
    require_once '../core/sql.php';
    require_once '../core/mysql.php';

    insert_teste ('Gabriel', 'faria.dias@ifsp.edu.br', 'daNotaPraNoisSor');
    buscar_teste();
    update_teste(18, 'Gabriel Faria', 'gabrielfariadias16@gmail.com');
    buscar_teste();

    //TESTE INSERCAO BANCO DE DADOS
    function insert_teste($nome, $email, $senha): void
    {
        $dados = ['nome' => $nome, 'email' => $email, 'senha' => $senha]; 
        insere ('usuario', $dados);
    }

    //TESTE SELECT BANCO DE DADOS
    function buscar_teste(): void
    {
        $usuarios = buscar('usuario',['id', 'nome', 'email'], [], '');
        print_r($usuarios);
    }

    //TESTE UPDATE BANCO DE DADOS

    function update_teste($id, $nome, $email): void
    {
        $dados = ['nome' => $nome, 'email' => $email];
        $criterio = [['id', '=', $id]];
        atualiza('usuario', $dados, $criterio);
    }
?>