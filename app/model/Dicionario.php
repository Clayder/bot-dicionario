<?php
/**
 * @author Peter Clayder
 */

namespace app\model;

use app\banco\Bd;

/**
 * Class Dicionario
 * @package app\model
 */
class Dicionario extends Model
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $palavra;
    /**
     * @var sting
     */
    private $palavraTraducao;
    /**
     * @var sting
     */
    private $frase;
    /**
     * @var string
     */
    private $fraseTraducao;
    /**
     * @var int
     */
    private $qtd;

    /**
     * @var string
     */
    private $dateTimeExibir;

    public function __constructor()
    {
        parent::__construct();
        $this->getPalavra();
    }

    /**
     * @return void
     */
    public function exibirPalavra()
    {
        $dados = $this->dateTimeExibirMenor();
        /**
         * Se não tiver nenhuma palavra com dateTimeExibir menor que o dia e hora atual,
         * sorteia uma palavra.
         */
        if (!$dados) {
            while (!$dados) {
                $dados = $this->gerarPalavraAleatoria(false);
            }
        }
        $this->id = $dados[0]->id;
        $this->palavra = $dados[0]->palavra;
        $this->palavraTraducao = $dados[0]->palavraTraducao;
        $this->fraseTraducao = $dados[0]->fraseTraducao;
        $this->frase = $dados[0]->frase;
        $this->qtd = $dados[0]->qtd;
        $this->dateTimeExibir = $dados[0]->dateTimeExibir;
        $this->atualizarDateTimeExibir();
    }

    /**
     * @return bool
     */
    private function atualizarDateTimeExibir()
    {
        $qtd = $this->qtd + 1;
        $adicionar = "P" . $qtd . "D";
        $inserirDias = new \DateTime();
        $inserirDias->add(new \DateInterval($adicionar));
        $novaData = $inserirDias->format("Y-m-d H:i:s");
        try {
            $sql = "UPDATE vocabulario SET qtd=?, dateTimeExibir=? WHERE id=?";
            $stm = $this->db->getPdo()->prepare($sql);
            $stm->bindValue(1, $qtd);
            $stm->bindValue(2, $novaData);
            $stm->bindValue(3, $this->id);
            $stm->execute();
        } catch (PDOException $erro) {
            Bd::setErro("Ocorreu um erro no banco ao atualizar dateTimeExibir --> " . dateTime());
        }
    }

    /**
     * @return mixed
     */
    public function getPalavra()
    {
        return $this->palavra;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getPalavraTraducao()
    {
        return $this->palavraTraducao;
    }

    /**
     * @return mixed
     */
    public function getFrase()
    {
        return $this->frase;
    }

    /**
     * @return mixed
     */
    public function getFraseTraducao()
    {
        return $this->fraseTraducao;
    }

    /**
     * @return mixed
     */
    public function getQtd()
    {
        return $this->qtd;
    }

    /**
     * @return mixed
     */
    public function getDateTimeExibir()
    {
        return $this->dateTimeExibir;
    }


    private function gerarPalavraAleatoria()
    {
        $qtdRegistros = $this->db->countAll();
        // Gera um número aleatório entre, 1 e o último Id
        $idRegistro = mt_rand(1, $qtdRegistros);
        $dados = $this->db->get($idRegistro);
        return $dados;
    }


    /**
     * Retorna os registros que possuem dateTimeExibir menor que a data e hora atual
     * @return void
     */
    private function dateTimeExibirMenor()
    {
        $dateTimeAtual = dateTime();
        $dados = $this->db->getWhere('dateTimeExibir', $dateTimeAtual, '<=');
        return $dados;
    }

    public function cadastrar($dados)
    {
        return $this->db->insert($dados);
    }


}