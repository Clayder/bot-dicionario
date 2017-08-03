<?php
/**
 * @author Peter Clayder
 */
namespace app\banco;
use \PDO;

/**
 * Class Bd
 * @package app\banco
 */
class Bd extends Driver
{
    /**
     * @var string
     */
    private static $erro;

    /**
     * Bd constructor.
     */
    public function __construct()
    {
        self::$erro = " ";
        $this->connect();
    }

    /**
     * @param array $arrayDados
     * @return void
     */
    public function insert($arrayDados)
    {
        try {
            $sql = 'INSERT INTO vocabulario (palavra, palavraTraducao, frase, fraseTraducao, qtd, dateTimeExibir, dateTime) VALUES (:palavra, :palavraTraducao, :frase, :fraseTraducao, :qtd, :dateTimeExibir, :dateTime);';
            $sth = $this->pdo->prepare($sql);
            $sth->bindValue(':palavra', $arrayDados['palavra']);
            $sth->bindValue(':palavraTraducao', $arrayDados['palavraTraducao']);
            $sth->bindValue(':frase', $arrayDados['frase']);
            $sth->bindValue(':fraseTraducao', $arrayDados['fraseTraducao']);
            $sth->bindValue(':qtd', $arrayDados['qtd']);
            $sth->bindValue(':dateTimeExibir', $arrayDados['dateTimeExibir']);
            $sth->bindValue(':dateTime', $arrayDados['dateTime']);
            $sth->execute();
            if ($sth->rowCount() > 0) {
                flashData("msgInserir", mensagemAlerta("success", 'Vocabulário inserido com sucesso.'));
            } else {
                flashData("msgInserir", mensagemAlerta("danger", 'Erro ao inserir vocabulário.'));
            }
        } catch (\PDOException $e) {
            sellf::setErro("Erro ao inserir " . $e->getMessage());
        }

    }

    /**
     * @param int $id
     * @return object
     */
    public function get($id)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM vocabulario WHERE id = ?");
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            return $this->sql($stmt);
        } catch (PDOException $erro) {
            sellf::setErro("Erro método get: " . $erro->getMessage());
        }
    }

    /**
     * @param string $campo Campo da tabela, ex: id
     * @param string $busca ex: busca pelo id >= 1, ou seja $busca = 1
     * @param string $condicao ex: >=
     * @return object
     */
    public function getWhere($campo, $busca, $condicao){
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM vocabulario WHERE ".$campo." ".$condicao." ?");
            $stmt->bindParam(1, $busca, PDO::PARAM_INT);
            return $this->sql($stmt);
        } catch (PDOException $erro) {
            sellf::setErro("Erro método getWhere: " . $erro->getMessage());
        }
    }

    private function sql($stmt){
        $dados = (Object) array();
        if ($stmt->execute()) {
            $rs = $stmt->fetchAll(PDO::FETCH_OBJ);
            $dados = $rs;
        } else {
            sellf::setErro("Erro: Não foi possível executar a declaração sql");
        }
        return $dados;
    }

    /**
     * @return int
     */
    public function countAll()
    {
        $find = $this->pdo->prepare('SELECT count(*) from vocabulario');
        $find->execute();
        return $find->fetchColumn();
    }

    public static function setErro($msg)
    {
        self::$erro = self::$erro ."\n".$msg;
    }

    /**
     * @return string
     */
    public static function getErro()
    {
        return self::$erro;
    }



}