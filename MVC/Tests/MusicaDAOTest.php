<?php

require_once './aula16/src/model/Musica.class.php';
require_once './aula16/src/model/MusicaDAO.class.php';

use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertGreaterThan;
use function PHPUnit\Framework\assertTrue;

class MusicaDAOTest extends TestCase{

    private function criaMusicaCompleta(){

        return new Musica("Boate Azul", "Fred Christ", "Metal", "00:02:38", 0);

    }

    public function testSalva(){

        $musica = $this->criaMusicaCompleta();

        $dao = new MusicaDAO();

        $res = $dao->salva($musica);

        assertTrue($res);
        assertGreaterThan(0, $musica->getId());
    }
}
?>