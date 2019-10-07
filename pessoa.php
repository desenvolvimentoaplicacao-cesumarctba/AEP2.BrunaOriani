<?php

class Pessoa{

    public $nome;
    public $nascimento;
    public $peso;
    public $altura;
    public $cpf;

    public function __construct($nome, $nascimento, $peso, $altura, $cpf)
    {
        $this->nome = $nome;
        $this->nascimento = $nascimento;
        $this->peso = $peso;
        $this->altura = $altura;
        $this->cpf = $cpf;
    }

    public function calculoImc()
    {
 
            $imc = $this->peso / pow($this->altura, '2');
            $imc = number_format($imc,2, '.', '');

            if($imc < 18.5)
            {
                $faixa = 'Abaixo do peso';
            }
            else if(($imc > 18.5) && ($imc < 24.9))
            {
                $faixa = 'Seu peso está dentro do esperado';
            }
            else if(($imc > 25.0) && ($imc < 29.9))
            {
                $faixa = 'Você está um pouco acima do peso';
            }
            else if(($imc > 30) && ($imc < 39.9))
            {
                $faixa = 'Você está com obesidade nivel 1';
            }
            else if(($imc > 40))
            {
                $faixa = 'Você está com obesidade morbida. Cuidado!';
            }

            return "
            Olá, {$this->nome} <br>
            Seu peso é: {$this->peso} Kg <br>
            Sua altura é: {$this->altura} <br>
            O valor do seu IMC é: {$imc} <br>
            E o resultado do calculo de IMC: {$faixa}  <br>          
            ";
    }

    public function calculoIdade()
    {
        $data = explode('/', $this->nascimento);

        if(count($data) == 3)
        {
        $dia = $data[0];
        $mes = $data[1];
        $ano = $data[2];

        $validaData = checkdate($dia, $mes, $ano);
            if($validaData == 1)
            {

            $hoje = mktime(0, 0, 0, date('m'), date('d'), date('y'));

            $diaNascimento = mktime(0, 0, 0, $dia, $mes, $ano);

            $idade = floor((((($hoje - $diaNascimento) / 60) / 60) / 24) / 365.25);

                return "
                Data de nascimento: {$this->nascimento} <br>
                Idade: {$idade} Anos
                ";

            }
            else
            {
                return 'Data inválida';
            }
        }
        else
        {
            return 'Formato da data é inválido';
        }

    }
    public function consultaCpf()
    {
        $this->cpf = preg_replace('/[^0-9]/is', '', $this->cpf);

        if(strlen($this->cpf) != 11)
        {
            return 'Cpf inválido! Possui menos de 11 digitos';
        }

        if (preg_match('/(\d)\1{10}/', $this->cpf)) 
        {
            return 'Seuqencia igual, CPF invalido!';
        }

        for ($t = 9; $t < 11; $t++) 
        {
            for ($d = 0, $c = 0; $c < $t; $c++) 
            {
                $d += $this->cpf{$c} * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($this->cpf{$c} != $d) 
            {
                return 'CPF invalido! <br>';
            }
        }

        $parte_um = substr($this->cpf, 0, 3);
        $parte_dois = substr($this->cpf, 3, 3);
        $parte_tres = substr($this->cpf, 6, 3);
        $parte_quatro = substr($this->cpf, 9, 2);

        $formatarCpf = "$parte_um.$parte_dois.$parte_tres-$parte_quatro";

        return "CPF: $formatarCpf <br>";
    }


}
