<?php

include_once 'Conexao.php';
include_once 'Usuario.class.php';

class Animal{

    private $id;
    private $nome;
    private $especie;
    private $raca;
    private $genero;
    private $cor;
    private $ultimoEndereco;
    private $descricao;
    private $oculto = false;
    private $imagem;
    private $user = null;

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }
    
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
        $this->especie = $especie;
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

    public function setGenero($genero){
        $this->genero =  $genero;
    }

    public function getCor(){
        return $this->cor;
    }

    public function setCor($cor){
        $this->cor = $cor;
    }

    public function getUltimoEndereco(){
        return $this->ultimoEndereco;
    }

    public function setUltimoEndereco($ultimoEndereco){
        $this->ultimoEndereco = $ultimoEndereco;
    }

    public function getDescricao(){
        return $this->descricao;
    }

    public function setDescricao($descricao){
        $this->descricao = $descricao;
    }

    public function getImagem(){
        return $this->imagem;
    }

    public function setImagem($imagem){
        $this->imagem = $imagem;
    }

    public function save()
    {
        $pdo = conexao();

        try{
        
            $stmt = $pdo->prepare('INSERT INTO postagem_animal (nome, especie, raca, genero, cor, ultimo_Endereco, descricao, imagem) 
                                    VALUES( :nome, :especie, :raca, :genero, :cor, :ultimoEndereco, :descricao, :imagem)');

            $stmt->execute([ 
                        ':nome' => $this->nome, 
                        ':especie' => $this->especie, 
                        ':raca' => $this->raca, 
                        ':genero' => $this->genero, 
                        ':cor' => $this->cor, 
                        ':ultimoEndereco' => $this->ultimoEndereco, 
                        ':descricao' => $this->descricao,
                        ':imagem' => $this->imagem]);
            

            $id = $pdo->lastInsertID();     
                

        } catch(Exception $e) {
            echo '<pre>';
            var_dump($e);
            //Log
            return false;
        }
    }


    /// Deleta, pega o ID

    public static function deletar ($id) {
        
        $pdo = conexao();
        
        try{

        $stmt = $pdo->prepare('UPDATE postagem_animal SET oculto = true  WHERE id_animal = :id');
        $stmt->execute([':id' => $this->id]);
        

        } catch(Exception $e) {
            echo '<pre>';
            var_dump($e);
            return false;
        }

    }


    /// Atualiza

    public function update ($id) {

        $pdo = conexao();
        
        try{

        $stmt = $pdo->prepare('UPDATE postagem_animal SET nome = :nome,  
                                                    especie = :especie,
                                                    raca = :raca, 
                                                    genero = :genero, 
                                                    cor = :cor,  
                                                    ultimo_endereco = :ultimoEndereco, 
                                                    descricao = :descricao, 
                                                    imagem = :imagem  
                                                    WHERE id_animal = :id');

        $stmt->execute([':id' => $this->id,

            ':nome' => $this->nome, 
            ':especie' => $this->especie, 
            ':raca' => $this->raca, 
            ':genero' => $this->genero, 
            ':cor' => $this->cor, 
            ':ultimoEndereco' => $this->ultimoEndereco,
            ':descricao' => $this->descricao,
            ':imagem' => $this->imagem]);

        } catch(Exception $e) {
            echo '<pre>';
            var_dump($e);
            return false;
        }

    }


    /// getAll

    public static function getAll() {
        $pdo = conexao();
        
        try{
            $lista = [];
            foreach($pdo->query('SELECT * FROM postagem_animal') as $linha ){

                $animal = new Animal();
                
                $animal->setId($linha['id']);
                $animal->setNome($linha['nome']);
                $animal->setEspecie($linha['especie']);
                $animal->setRaca($linha['raca']);
                $animal->setGenero($linha['genero']);
                $animal->setCor($linha['cor']);
                $animal->setUltimoEndereco($linha['ultimo_endereco']);
                $animal->setImagem($linha['imagem']);

                $lista[] = $animal;
    
            }
        } catch(Exception $e) {
            var_dump($e);
            //Log
            return false;
        }   

        return $lista;

    }
    

    /// getOne

    public static function getOne($id) {
        $pdo = conexao();
        $animal = new Animal();
        try{
            foreach($pdo->query('SELECT * FROM postagem_animal WHERE id = ' . $id) as $linha ){

                $animal->setId($linha['id']);
                $animal->setNome($linha['nome']);
                $animal->setEspecie($linha['especie']);
                $animal->setRaca($linha['raca']);
                $animal->setGenero($linha['genero']);
                $animal->setCor($linha['cor']);
                $animal->setUltimoEndereco($linha['ultimo_endereco']);
                $animal->setImagem($linha['imagem']);    
            }
        } catch(Exception $e) {
            //Log
            var_dump($e);
            return false;
        }   

        return $animal;
    }
    

    /// Load

    public  function load(){
        $pdo = conexao();

        #TODO ver que esse código cheira mal...
        try{
        
            foreach($pdo->query('SELECT * FROM postagem_animal WHERE id = ' . $this->id) as $linha){
                $animal = new Animal;
                $animal->setNome($linha['nome']);
                $animal->setEspecie($linha['especie']);
                $animal->setRaca($linha['raca']);
                $animal->setGenero($linha['genero']);
                $animal->setCor($linha['cor']);
                $animal->setUltimoEndereco($linha['ultimoEndereco']);
            }
        
        } catch (Exception $e) {
            var_dump($e);
            //Log
            return false;
        }


        return $this;
    }

}