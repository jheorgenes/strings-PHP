<?php

spl_autoload_register(function ($classe) { //Esse spl_autoload_register é uma função que aceita uma função como argumento do autoload

    $prefixo = "App\\";

    $diretorio = __DIR__ . '/src/'; //Constante __DIR__ pega o diretório raiz do projeto

    $tamanhoPrefixo = strlen($prefixo); //Pega o tamanho da variável prefixo

    if (strncmp($prefixo, $classe, $tamanhoPrefixo) !== 0) { //Comparação de string segura para binário para os primeiros n caracteres
        return;
    } 

    $namespace = substr($classe, $tamanhoPrefixo); //substr retorna uma parte de uma string ($variavel, posição onde será lido a string [Se for um numero negativo lê de trás pra frente])

    /* Comentário da linha: $namespace_arquivo = str_replace('\\', DIRECTORY_SEPARATOR, $namespace);
     * str_replace('recebe o que vai alterar', 'recebe o que será alterado', 'aonde será alterado') é uma função de substituição de strings
     * '\\' É utilizado para pegar o texto da 'barra' corretamente
     * DIRECTORY_SEPARATOR pegará o separador (a barra) do sistema operacional que está sendo utilizado. '\' ou '/'
     * $namespace será o valor que será substituído */
    $namespace_arquivo = str_replace('\\', DIRECTORY_SEPARATOR, $namespace);

    $arquivo = $diretorio . $namespace_arquivo . '.php'; //Concatenando e montando o diretório completo do require

    if(file_exists($arquivo)){ //Verifica se um arquivo ou diretório existe
        require $arquivo;
    }
    
}); 