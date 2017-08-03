<?php

/**
 * @param string $url
 * @return string
 */
function baseUrl($url = "")
{
    if ($url != "") {
        return BASE_URL . $url;
    } else {
        return BASE_URL;
    }
}

/**
 * @param null $array
 */
function pre($array = null)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

/**
 * @param string $tipo exemplo: Y-m-d H:i:s
 * @return date
 */
function dateTime($tipo = "")
{
    $fuso = new DateTimeZone('America/Sao_paulo');
    $data = new DateTime();
    $data->setTimezone($fuso);
    if ($tipo === "") {
        return $data->format('Y-m-d H:i:s');
    } else {
        return $data->format($tipo);
    }

}

/**
 * Converte a data para o formato brasileiro.
 * @param date $data
 * @return string
 */
function dataBrasil($data)
{
    $data = new DateTime($data);
    return $data->format('d/m/Y');
}

/**
 * Converte a data e hora para o formato brasileiro.
 * @param dateTime $data
 * @return string
 */
function dateTimeBrasil($data)
{
    $data = new DateTime($data);
    return $data->format('d/m/Y H:i:s');
}

/**
 * Converte a data do formato brasileiro para o americano.
 * @param date $data
 * @param string $tipo
 * @return string
 */
function dateTimeSql($data, $tipo)
{
    $DT = DateTime::createFromFormat('d/m/Y', $data);
    return $DT->format($tipo);
}

/**
 * @return void
 */
function iniciaSession()
{
    if (!isset($_SESSION)) {
        session_start();
    }
}

/**
 * Exibe uma mensagem que vai aparecer, só por alguns segundos.
 * @param string $nomeSession
 * @param string $mensagem
 */
function flashData($nomeSession, $mensagem)
{
    iniciaSession();
    $_SESSION['flash'][$nomeSession] = $mensagem;
    $_SESSION['ultima_atividade'] = time();
}

/**
 * Verifica o tempo que a mensagem foi exibida e a deleta.
 * @return void
 */
function flashDataVerifica()
{
    iniciaSession();
    if (isset($_SESSION['ultima_atividade']) && (time() - $_SESSION['ultima_atividade'] > 1)) {
        unset($_SESSION['flash']);
    }
    $_SESSION['ultima_atividade'] = time(); // update da ultima atividade
}

/**
 * Imprime a mensagem.
 * @param string $nomeSession
 */
function flashDataMs($nomeSession)
{
    iniciaSession();
    if (isset($_SESSION['flash'][$nomeSession])) {
        echo $_SESSION['flash'][$nomeSession];
    }
}

/**
 * Imprime uma mensagem, com o layout de alerta.
 * @param string $tipo
 * @param string $mensagem
 * @return string
 */
function mensagemAlerta($tipo, $mensagem)
{

    $alerta = "<div class='alert alert-" . $tipo . " alert-dismissible' role='alert'>";
    $alerta = $alerta . " <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button> ";
    $alerta = $alerta . $mensagem;
    $alerta = $alerta . " </div>";
    return $alerta;
}
