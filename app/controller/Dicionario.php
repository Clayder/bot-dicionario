<?php
/**
 * @author Peter Clayder
 */
namespace app\controller;

use app\model\telegram\Bot;
use app\model\Dicionario as DicionarioModel;
use app\banco\Bd;

/**
 * Class Dicionario
 * @package app\controller
 */
class Dicionario extends Controller
{
    /**
     * @param array $dados
     * @return void
     */
    public function cadastrar($dados)
    {
        $dicionario = new DicionarioModel();
        $inserirDias = new \DateTime();
        $dados['dateTime'] = $inserirDias->format("Y-m-d H:i:s");
        $inserirDias->add(new \DateInterval("P1D"));
        $dados['dateTimeExibir'] = $inserirDias->format("Y-m-d H:i:s");
        $dados['qtd'] = 0;
        $dicionario->cadastrar($dados);
        header("Location: ".baseUrl());
    }

    /**
     * @return void
     */
    public function formCadastro()
    {
        $this->view("form-cadastro");
    }

    /**
     * @return void
     */
    public function getPalavra()
    {
        $dicionario = new DicionarioModel();
        $dicionario->exibirPalavra();
        $mensagem = "";
        if(Bd::getErro() !== " "){
            $mensagem = Bd::getErro()."\n\n";
            $mensagem = $mensagem . " ---------------------------------------- \n\n";
        }
        $mensagem = $mensagem . " PALAVRA: ".$dicionario->getPalavra(). " ==> ". $dicionario->getPalavraTraducao()."\n\n";
        $mensagem = $mensagem . " FRASE: ".$dicionario->getFrase(). " ==> ". $dicionario->getFraseTraducao()."\n\n";
        $mensagem = $mensagem . " ---------------------------------------- \n\n";
        $mensagem = $mensagem . "Quantidade de exibições:  ".($dicionario->getQtd() + 1)."\n\n";
        $bot = new Bot();
        // envia a mensagem
        $bot->pacoteMensagem($mensagem);
    }

     /**
     * @return void
     */
    public function getMensagens(){
        $bot = new Bot();
        $bot->processMessage();
    }
}
