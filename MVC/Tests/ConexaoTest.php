<?php

require_once './aula16/src/model/Conexao.class.php';

use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertNotNull;
use function PHPUnit\Framework\assertNull;

class ConexaoTest extends TestCase{


    public function testConexaoFalha(){

        //captura lancamento de excecao nao tratada
        //$this->expectException(PDOException::class);

        $con = new Conexao('playlist');

        assertNotNull($con);
        assertNull($con->getPDO());
    }

    public function testConexaoSucesso(){

        $con = new Conexao('playlist_ds4');

        assertNotNull($con);
        assertNotNull($con->getPDO());
    }
}
?>