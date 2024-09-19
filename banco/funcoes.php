
<?php


    function limparDados (string $dado) : string
    {
        $tags = '<p><strong><i><ul><ol><li><h1><h2><h3>';
        $retorno = htmlentities (strip_tags ($dado, $tags));
        return $retorno;
    }


    function buscar($tabela, $colunas = ['usuario'], $criterios = [], $ordem = '')
{
    // Conecte-se ao banco de dados (use a função de conexão que você criou)
    $conn = conexao();  // Função de conexão que você deve ter em 'conexao.php'

    // Seleção das colunas
    $colunas_sql = implode(", ", $colunas);
    
    // Criação da query básica
    $sql = "SELECT $colunas_sql FROM $tabela";
    
    // Adiciona critérios de busca, se existirem
    if (!empty($criterios)) {
        $sql .= " WHERE ";
        $criterio_sql = [];
        foreach ($criterios as $criterio) {
            $criterio_sql[] = "{$criterio[0]} {$criterio[1]} '{$criterio[2]}'";
        }
        $sql .= implode(" AND ", $criterio_sql);
    }
    
    // Adiciona a ordem, se fornecida
    if ($ordem) {
        $sql .= " ORDER BY $ordem";
    }
    
    // Executa a query
    $resultado = $conn->query($sql);
    
    // Verifica se há resultados e os retorna
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

    
?>
