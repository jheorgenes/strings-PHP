<?php 

namespace App\Alura;

class Contato
{
    private $email;
    private $endereco;
    private $cep;
    private $telefone;

    public function __construct(string $email, string $endereco, string $cep, string $telefone)
    {   
        $this->email = $email; //Garante a atribuição, mas depois sofre alteração

        /* VALIDANDO E-MAIL */
        if($this->validaEmail($email) !== false){ //Se a validação do email retornar true
            $this->setEmail($email);
        } else {
            $this->setEmail("E-mail inválido!"); 
        }

        /* VALIDANDO TELEFONE */
        if($this->validaTelefone($telefone)){ 
            $this->setTelefone($telefone);
        } else {
            $this->setTelefone("Telefone inválido");
        };

        $this->endereco = $endereco;
        $this->cep = $cep;
        
    }

    private function validaEmail(string $email)
    {
        /* filter_var() retorna true ou false quando o filtro a seguir, atende o requisito  */
        return filter_var($email, FILTER_VALIDATE_EMAIL); //Constante FILTER_VALIDATE_EMAIL é global e valida se um email é valido.
    }

    private function validaTelefone(string $telefone): int
    {   
        /** função preg_match() permite usar uma expressão regurar no php, onde recebe como argumento: o regex, a variável que será validada, o resultado em outra variável (que no caso atribuí a outro nome só pra identificar mesmo) */
        return preg_match('/^[0-9]{5}-[0-9]{4}/', $telefone, $encontrados);
        /* Pesquisa expressões regulares sempre que tiver dúvida de como formar uma */
    }

    /** Getters and Setters */

    public function getUsuario(): string
    {
        $posicaoArroba = strpos($this->email, "@"); //retorna a posição da substring "@" para informar aonde ela está localizada
        /* Se eu quisesse buscar a segunda parte do e-mail
           substr($email,strpos($email,"@")); */

        if($posicaoArroba === FALSE){
            return "Usuário inválido";
        }

        return substr($this->email, 0, $posicaoArroba); //substr [substring] pega a variável que será validada, de onde ela vai iniciar até onde vai finalizar a copia da informação
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    private function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getEnderecoCep(): string
    {
        $enderecoCep = [ $this->endereco, $this->cep ]; //Pega o endereço e o Cep e coloca em uma variável como array
        return implode(" - ", $enderecoCep); //Função implode pega os argumentos do array e junta em uma string só, mas inclui um separador entre eles ( " - ")
    }

    public function getTelefone(): string
    {
        return $this->telefone;
    }

    private function setTelefone(string $telefone): void
    {
        $this->telefone = $telefone;
    }

}