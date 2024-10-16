<?php
    session_start();
    require_once '../includes/valida_login.php';
    require_once '../includes/funcoes.php';
    require_once 'conexao_mysql.php';
    require_once 'sql.php';
    require_once 'mysql.php';

    foreach($_POST as $indice => $dado) 
    {
        $$indice = limparDados($dado);
    }

    foreach($_GET as $indice => $dado) 
    {
        $$indice = limparDados($dados);
    }

    $id = (int)$id;

    switch($acao)
    {
        //INSERE O POST NO BANCO
        case 'insert':
            $dados = [
                'titulo' => $titulo,
                'texto' => $texto,
                'data_postagem' => "$data_postagem $hora_postagem",
                'usuario_id' => $_SESSION['login']['usuario']['id']
            ];
            #funcao para inserir
            insere ('post', $dados);
            break;


            //ATUALIZA O POST DO BANCO
            case 'update':
                $dados = [
                    'titulo' => $titulo,
                    'texto' => $texto,
                    'data_postagem' => "$data_postagem $hora_postagem",
                    'usuario_id' => $_SESSION['login']['usuario']['id']
                ];
                $criterio = [
                    ['id', '=', $id]
                ];
                #funcao atualizar
                atualiza ('post', $dados, $criterio);
                break;


            //DELETA O POST DO BANCO
            case 'delete':
                $criterio = [
                    ['id', '=', $id]
                ];
                #funcao deleta
                deleta ('post', $criterio);
                break;
    }

    header('Location: ../index.php');
?>