<?php

namespace SRC;

class Funcoes
{

    private $primeNumbersList = [2, 3, 5, 7, 11, 13, 17, 19, 23, 29, 31, 37, 41, 43, 47, 53, 59, 61, 67, 71, 73, 79, 83, 89, 97];
    /*

    Desenvolva uma função que receba como parâmetro o ano e retorne o século ao qual este ano faz parte. O primeiro século começa no ano 1 e termina no ano 100, o segundo século começa no ano 101 e termina no 200.

	Exemplos para teste:

	Ano 1905 = século 20
	Ano 1700 = século 17

     * */
    public function SeculoAno(int $ano): int
    {
        if ($ano % 100 === 0) {
            return $ano / 100;
        }
        return floor($ano / 100) + 1;
    }











    /*

    Desenvolva uma função que receba como parâmetro um número inteiro e retorne o numero primo imediatamente anterior ao número recebido

    Exemplo para teste:

    Numero = 10 resposta = 7
    Número = 29 resposta = 23

     * */
    public function PrimoAnterior(int $numero): int
    {
        /**
         * Optimizações:
         * 1 - remover número da checagem
         * 2 - remover números par da checagem
         * 3 - remover números múltiplos de 3 da checagem
         * 4 - remover números múltiplos de 5 da checagem
         * 5 - remover números múltiplos de 7 da checagem
         * 6 - remover números múltiplos de 11 da checagem
         * 7 - implementação de atributo de números primos, contendo os números primos de 1 a 100
         * 
         * 
         */
        for ($i = $numero - 1; $i > 0; $i--) {
            // echo $i;
            for ($j = 2; $j  <= $i; $j = $j + 1) {
                if ($i === $j) return $i;

                foreach ($this->primeNumbersList as $number) {
                    if ($i % $number === 0 && $i !== $number) break;
                }

                if ($i % $j === 0) break; // caso caia em um número primo não mapeado anteriormente
            }
        }
    }




    /*

    Desenvolva uma função que receba como parâmetro um array multidimensional de números inteiros e retorne como resposta o segundo maior número.

    Exemplo para teste:

	Array multidimensional = array (
	array(25,22,18),
	array(10,15,13),
	array(24,5,2),
	array(80,17,15)
	);

	resposta = 25

     * */
    public function SegundoMaior(array $array_list): int
    {
        /**
         * Optimizações:
         * 1 - Pegar sempre os 2 primeiros maiores itens do array (de maneira que, caso os 2 maiores números estejam em array só, o segundo maior não é perdido)
         */
        $array_com_valores_espalhados = array();

        foreach ($array_list as $array) {
            sort($array);
            $array_com_valores_espalhados = array_merge($array_com_valores_espalhados, array_slice($array, -2));
        }
        // $array_com_valores_espalhados = array(...$arr);
        sort($array_com_valores_espalhados);

        return array_slice($array_com_valores_espalhados, -2, 1)[0];
    }








    /*
   Desenvolva uma função que receba como parâmetro um array de números inteiros e responda com TRUE or FALSE se é possível obter uma sequencia crescente removendo apenas um elemento do array.

	Exemplos para teste 

	Obs.:-  É Importante  realizar todos os testes abaixo para garantir o funcionamento correto.
         -  Sequencias com apenas um elemento são consideradas crescentes

    [1, 3, 2, 1]  false
    [1, 3, 2]  true
    [1, 2, 1, 2]  false
    [3, 6, 5, 8, 10, 20, 15] false
    [1, 1, 2, 3, 4, 4] false
    [1, 4, 10, 4, 2] false
    [10, 1, 2, 3, 4, 5] true
    [1, 1, 1, 2, 3] false
    [0, -2, 5, 6] true
    [1, 2, 3, 4, 5, 3, 5, 6] false
    [40, 50, 60, 10, 20, 30] false
    [1, 1] true
    [1, 2, 5, 3, 5] true
    [1, 2, 5, 5, 5] false
    [10, 1, 2, 3, 4, 5, 6, 1] false
    [1, 2, 3, 4, 3, 6] true
    [1, 2, 3, 4, 99, 5, 6] true
    [123, -17, -5, 1, 2, 3, 12, 43, 45] true
    [3, 5, 67, 98, 3] true

     * */

    public function SequenciaCrescente(array $arr): bool
    {
        /**
         * Optimizações
         * 1- Array de 2 ou 1 posições sempre serão true
         * 2 - arrays que possuem elemento repetido mais que 2x sempre serão falsas
         * 3 - arrays que possuem elementos distintos repetidos sempre serão falsos 
         * 4 - arrays que já estejam ordenados permanecem ordenados
         */

        if (count($arr) === 2 && count($arr) === 1) return true;

        foreach (array_count_values($arr) as $key => $value) {
            if ($value > 2) return false;
        }

        if (isset(array_count_values(array_count_values($arr))[2]) && array_count_values(array_count_values($arr))[2] >= 2) return false;

        if ($this->isSorted($arr)) return $this->isSorted($arr);

        for ($i = 0; $i < count($arr); $i++) {

            $temp_arr = $arr;
            unset($temp_arr[$i]);


            if ($this->isSorted($temp_arr)) return true;
        }

        return false;
    }

    private function isSorted(array $array): bool
    {
        $last = reset($array);
        $isSorted = true;
        foreach ($array as $value) {
            if ($last > $value) {
                $isSorted = false;
                break;
            }
            $last = $value;
        }
        return $isSorted;
    }
}

$funcoes = new Funcoes();

var_dump($funcoes->SeculoAno(1905));
var_dump($funcoes->SeculoAno(1700));

var_dump($funcoes->PrimoAnterior(10));
var_dump($funcoes->PrimoAnterior(29));

var_dump($funcoes->SegundoMaior(array(
    array(21, 22, 18),
    array(10, 15, 13),
    array(24, 5, 2),
    array(80, 17, 15)
)));


var_dump($funcoes->SequenciaCrescente([1, 3, 2, 1]));
var_dump($funcoes->SequenciaCrescente([1, 3, 2]));
var_dump($funcoes->SequenciaCrescente([1, 2, 1, 2]));
var_dump($funcoes->SequenciaCrescente([3, 6, 5, 8, 10, 20, 15]));
var_dump($funcoes->SequenciaCrescente([1, 1, 2, 3, 4, 4]));
var_dump($funcoes->SequenciaCrescente([1, 4, 10, 4, 2]));
var_dump($funcoes->SequenciaCrescente([10, 1, 2, 3, 4, 5]));
var_dump($funcoes->SequenciaCrescente([1, 1, 1, 2, 3] ));
var_dump($funcoes->SequenciaCrescente([0, -2, 5, 6]));
var_dump($funcoes->SequenciaCrescente([1, 2, 3, 4, 5, 3, 5, 6]));
var_dump($funcoes->SequenciaCrescente([40, 50, 60, 10, 20, 30]));
var_dump($funcoes->SequenciaCrescente([1, 1]));
var_dump($funcoes->SequenciaCrescente([1, 2, 5, 3, 5]));
var_dump($funcoes->SequenciaCrescente([1, 2, 5, 5, 5] ));
var_dump($funcoes->SequenciaCrescente([10, 1, 2, 3, 4, 5, 6, 1]));
var_dump($funcoes->SequenciaCrescente([1, 2, 3, 4, 3, 6]));
var_dump($funcoes->SequenciaCrescente([1, 2, 3, 4, 99, 5, 6]));
var_dump($funcoes->SequenciaCrescente([123, -17, -5, 1, 2, 3, 12, 43, 45] ));
var_dump($funcoes->SequenciaCrescente([3, 5, 67, 98, 3]));
