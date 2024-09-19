<?php
    require_once 'funcoes.php';
    require_once 'conexao.php';
    require_once 'sqlteste.php';
    require_once 'mysqlTeste.php';

    insert_teste('Luiz', 'luizovc27@gmail.com', 'luizovc12');
    insert_teste('Luiz', 'luizovc27@gmail.com', 'luizovc12');
    insert_teste('Luiz', 'luizovc27@gmail.com', 'luizovc12');
    buscar_teste();
    update_teste(1, 'murilo', 'silva@gmail.com');
    buscar_teste();
    deleta_teste(3);

    function insert_teste($nome, $email, $senha) : void
    {
        $dados = [
            'nome' => $nome,
            'email' => $email,
            'senha' => $senha
        ];
        insert('usuario', $dados);
    }

    function buscar_teste() : void
    {
        $usuarios = buscar('usuario', ['id', 'nome', 'email'], [], '');
        
        if (!empty($usuarios)) {
            foreach ($usuarios as $usuario) {
                echo "ID: " . $usuario['id'] . "<br>";
                echo "Nome: " . $usuario['nome'] . "<br>";
                echo "Email: " . $usuario['email'] . "<br><br>";
            }
        } else {
            echo "Nenhum usuário encontrado.<br>";
        }
    }

    function update_teste($id, $nome, $email) : void
    {
        $dados = [
            'nome' => $nome,
            'email' => $email
        ];
        $criterio = [['id', '=', $id]];
        update('usuario', $dados, $criterio);
    }

    function deleta_teste($id) : void
    {
        $criterio = [['id', '=', $id]];
        delete('usuario', $criterio);
    }

    // Função buscar
    function buscar($tabela, $colunas = ['*'], $criterios = [], $ordem = '')
    {
        $conn = conexao();  // Função de conexão ao banco de dados
        $colunas_sql = implode(", ", $colunas);
        $sql = "SELECT $colunas_sql FROM $tabela";
        
        if (!empty($criterios)) {
            $sql .= " WHERE ";
            $criterio_sql = [];
            foreach ($criterios as $criterio) {
                $criterio_sql[] = "{$criterio[0]} {$criterio[1]} '{$criterio[2]}'";
            }
            $sql .= implode(" AND ", $criterio_sql);
        }

        if ($ordem) {
            $sql .= " ORDER BY $ordem";
        }

        $resultado = $conn->query($sql);

        if ($resultado->num_rows > 0) {
            $dados = [];
            while ($row = $resultado->fetch_assoc()) {
                $dados[] = $row;
            }
            return $dados;
        } else {
            return [];
        }
    }

    // Função de conexão ao banco de dados
    function conexao() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "seu_banco_de_dados";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Falha na conexão: " . $conn->connect_error);
        }

        return $conn;
    }
?>
