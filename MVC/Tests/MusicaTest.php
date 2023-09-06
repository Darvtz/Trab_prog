<?php

require_once './aula16/src/model/Musica.class.php';

use PHPUnit\Framework\TestCase;

class MusicaTest extends TestCase{

    private function criaMusicaTitulo(){

        return new Musica("Yellow");
    }

    private function criaMusicaCompleta(){

        return new Musica("Boate Azul", "Fred Christ", "Metal", "00:02:38", 1);

    }


    public function testConstrutor(){

        $musica1 = $this->criaMusicaTitulo();
        $musica2 = $this->criaMusicaCompleta();

        $this->assertNotNull($musica1);
        $this->assertNotNull($musica2);
        
        $this->assertInstanceOf(Musica::class, $musica1);
        $this->assertInstanceOf(Musica::class, $musica2);

        $this->assertEquals("Yellow", $musica1->getTitulo());
        $this->assertEquals(0, $musica1->getId());

        $this->assertEquals("Boate Azul", $musica2->getTitulo());
        $this->assertEquals("Fred Christ", $musica2->getArtista());
        $this->assertEquals("Metal", $musica2->getGenero());
        $this->assertEquals("00:02:38", $musica2->getDuracao());
        $this->assertEquals(1, $musica2->getId());


    }
}
?>