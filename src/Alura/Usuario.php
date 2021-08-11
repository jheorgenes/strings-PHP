<?php

namespace App\Alura;

class Usuario
{
    private $nome;
    private $sobrenome;
    private $senha;
    private $tratamento;

    public function __construct(string $nome, string $senha, string $genero)
    {
        $this->setNomeSobrenome($nome); //Função prograamda para tratamento do nome (Sobrecarga de método)
        $this->validaSenha($senha); //Função programada apra tratamento da senha (Sobrecarga de método)
        $this->adicionaTratamentoAoSobrenome($nome, $genero);
    }

    private function setNomeSobrenome(string $nome)
    {
        $nomeSobrenome = explode(" ", $nome, 2); //Explode identifica o delimitador do espaço do nome e separa o nome em várias partes no array ( A posição 2 significa que será dividido em 2 partes)

        if($nomeSobrenome[0] === ""){ //Se a posição 0 do array for vazia
            $this->nome = "Nome inválido";
        } else {
            $this->nome = $nomeSobrenome[0]; //Pega o primeiro valor array
        }

        if($nomeSobrenome[1] === null){ //Se a posição 1 do array for nula
            $this->sobrenome = "Sobrenome inválido";
        } else {
            $this->sobrenome = $nomeSobrenome[1]; //Pega o segundo valor array
        }  
    }

    private function validaSenha(string $senha): void
    {
        $tamanhoSenha = strlen(trim($senha));
        //função trim remove os eapaços no início e no final de uma string (também remove tabs, quebra de linha, etc)

        if($tamanhoSenha >= 6){
            $this->setSenha($senha);
        } else {
            $this->setSenha("Senha inválida");
        }
    }

    private function adicionaTratamentoAoSobrenome(string $nome, string $genero): void
    {
        if($genero === 'M'){
            $this->tratamento = preg_replace('/^(\w+)\b/', 'Sr.', $nome, 1); //preg_replace incrementa na string, uma outra informação que é posicionado de acordo com o regex criado
        }

        if($genero === 'F'){
            $this->tratamento = preg_replace('/^(\w+)\b/', 'Srª.', $nome, 1); // O numero '1' desse código determina o espaço entre a informação inserida e a continuação da string
        }
    }

    /* Getters and Setters */

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getSobrenome(): string
    {
        return $this->sobrenome;
    }

    public function getTratamento(): string
    {
        return $this->tratamento;
    }

    public function getSenha(): string
    {
        return $this->senha;
    }

    private function setSenha(string $senha)
    {
        $this->senha = $senha;
    }

}