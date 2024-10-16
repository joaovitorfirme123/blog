<?php
    session_start();
    require_once '../includes/funcoes.php';
    require_once 'conexao_mysql.php';
    require_once 'sql.php';
    require_once 'mysql.php';
    $salt = '$exemplosaltifsp';

    foreach($_POST as $indice => $dado)
    {
        $$indice = limparDados($dado);
    }

    foreach($_GET as $indice => $dado)
    {
        $$indice = limparDados($dado);
    }

    switch($acao)
    {
        //CADASTRA-INSERE O USUARIO NO BANCO
        case 'insert':
            $dados = [
                'nome' => $nome,
                'email' => $email,
                #criptografa a senha
                'senha' => crypt($senha, $salt)
                ];
                #funcao inserir
                insere ('usuario', $dados);
                break;


        //ATUALIZA O PERFIL DO BANCO
        case 'update':
            $id = (int)$id;
            $dados = [
                'nome' => $nome,
                'email' => $email
                ];
                
            $criterio = [
                ['id', '-', $id]
            ];
            #funcao atualiza
            atualiza ('usuario', $dados, $criterio);
            break;


        //LOGIN USUARIO
        case 'login':
            $criterio = [
                ['email', '=', $email],
                ['AND', 'ativo', '=', 1]
            ];

        $retorno = buscar ('usuario', ['id', 'nome', 'email', 'senha', 'adm'], $criterio);

        if(count($retorno) > 0) 
        {
            if(crypt($senha,$salt) == $retorno[0]['senha']) 
            {
                $_SESSION['login']['usuario'] = $retorno[0];
                if(!empty($_SESSION['url_retorno'])) 
                {
                    header('Location: ' . $_SESSION['url_retorno']);
                    $_SESSION['url_retorno'] = '';
                    exit;
                }
            }
        }
        break;


        //LOG OUT DO USUARIO
        case 'logout':
            session_destroy();
            break;


        //STATUS DO USUARIO
        case 'status':
            $id = (int)$id;
            $valor = (int)$valor;

            $dados = [
                'ativo'=> $valor
            ];

            $criterio = [
                ['id','=', $id]
            ];
            #funcao para ATIVAR o usuario
            atualiza ('usuario', $dados, $criterio);

            header('Location: ../usuarios.php');
            exit;
            break;


        //ADMINISTRADOR
        case 'adm':
            $id = (int)$id;
            $valor = (int)$valor;
            
            $dados = [
                'adm'=> $valor
            ];

            $criterio = [
                ['id', '=', $id] 
            ];
            #funcao para dar permissao ADM para o usuario
            atualiza(
                'usuario',
                $dados,
                $criterio
            );

            header('Location: ../usuarios.php');
            exit;
            break;


    }
    header ('Location: ../index.php');
?>