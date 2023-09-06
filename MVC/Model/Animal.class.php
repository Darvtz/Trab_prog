<?php

include_once 'Conexao.php'

class Animal{

    private $id;
    private $nome;
    private $especie;
    private $raca;
    private $genero
    private $cor;
    private $ultimoEndereco;

    public function getNome(){
        return $this->nome;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function getEspecie(){
        return $this->especie;
    }

    public function setEspecie($especie){
        $this->especie = $especie
    }

    public function getRaca(){
        return $this->raca;
    }

    public function setRaca($raca){
        $this->raca = $raca;
    }

    public function getGenero(){
        return $this->genero;
    }

    public function getCor(){
        return $this->cor;
    }

    public function setCor($cor){
        $this->cor = $cor
    }

    public function getUltimoEndereco(){
        return $this->getUltimoEndereco;
    }

    public function setUltimoEndereco($ultimoEndereco){
        $this->getUltimoEndereco = $ultimoEndereco;
    }

    public function save($id)
    {
        $pdo = conexao();

        try{
        
            $stmt = $pdo->prepare('INSERT INTO animal (id, nome, especie, raca, genero, cor, ultimoEndereco) VALUES(:id, :nome, )');
            $stmt->execute([':id' => $this->id], [':nome' => $this->nome], [':senha' => $this->senha], [':especie' => $this->especie], [':raca' => $this->raca], [':genero' => $this->genero], [':cor' => $this->cor], [':ultimoEndereco' => $this->ultimoEndereco]);
            

            $id = $pdo->lastInsertID();         

        } catch(Exception $e) {
            //Log
            return false;
        }
    }


    /// Deleta, pega o ID

    public static function deletar ($id) {
        
        $pdo = conexao();

        try{

            $stmt = $pdo->prepare('DELETE FROM animal WHERE id_animal = :id')
            $stmt->execute([':id' => $this->id]);

        } catch(Exception $e) {
            //Log
            return false;
    }

    }


    /// Atualiza

    public function update ($id) {

        $pdo = conexao();
        
        try{

        $stmt = $pdo->prepare('UPDATE animal SET id_animal  WHERE id_animal = :id');
        $stmt->execute([':id' => $this->id]);
        
        $stmt->execute([':id' => $this->id]);

        } catch(Exception $e) {
            //Log
            return false;
        }

    }


    /// getAll

    public static function getAll() {
        $pdo = conexao();
        
        try{
            $lista = [];
            foreach($pdo->query('SELECT * FROM Animal') as $linha ){

                $animal = new Animal();
                
                $animal->setNome($linha['nome']);
                $animal->setEspecie($linha['especie']);
                $animal->setRaca($linha['raca']);
                $animal->setGenero($linha['genero']);
                $animal->setCor($linha['cor']);
                $animal->setUlimoEndereco($linha['ultimoEndereco']);

                $lista[] = $animal;
    
            }
        } catch(Exception e) {
            //Log
            return false;
        }   

        return $lista;

    }
    

    /// getOne

    public static function getOne() {
        $pdo = conexao();
        #TODO id não deveria ser string, consertar
        try{
            $lista = [];
            foreach($pdo->query('SELECT * FROM Animal WHERE id = ' . $this->id) as $linha ){

                $animal = new Animal();

                $animal->setNome($linha['nome']);
                $animal->setEspecie($linha['especie']);
                $animal->setRaca($linha['raca']);
                $animal->setGenero($linha['genero']);
                $animal->setCor($linha['cor']);
                $animal->setUlimoEndereco($linha['ultimoEndereco']);

                $lista[] = $animal;
    
            }
        } catch(Exception e) {
            //Log
            return false;
        }   

        return $this;

    }
    

    /// Load

    public  function load(){
        $pdo = conexao();

        #TODO ver que esse código cheira mal...
        try{
        
            foreach($pdo->query('SELECT * FROM Animal WHERE id = ' . $this->id) as $linha){
                $animal->setNome($linha['nome']);
                $animal->setEspecie($linha['especie']);
                $animal->setRaca($linha['raca']);
                $animal->setGenero($linha['genero']);
                $animal->setCor($linha['cor']);
                $animal->setUlimoEndereco($linha['ultimoEndereco']);
            }
        
        } catch (Exception $e) {
            //Log
            return false;
        }


        return $this;
    }

}

?>