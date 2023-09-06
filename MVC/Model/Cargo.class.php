<?php
include_once 'Conexao.php';

class Papel{

    private $id
    private $papel;

    /// Getters e Setters

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getPapel(){
        return $this->papel;
    }

    public function setPapel($papel){
        $this->papel = $papel;
    }

    
    /// Salvar, se conecta e faz um PS para a tabela, faz um catch com erros

    public function save()
    {
        $pdo = conexao();

        try{
        
            $stmt = $pdo->prepare('INSERT INTO papel (papel) VALUES(:papel)');
            $stmt->execute([':papel' => $this->papel]);
      
        } catch(Exception $e) {
            //Log
            return false;
        }
    }

    
    /// Deleta, pega o ID

    public static function deletar ($id) {
        
        $pdo = conexao();

        try{

            $stmt = $pdo->prepare('DELETE FROM papel WHERE id = :id');
            $stmt->execute([':id => $id']);

        } catch(Exception $e) {
            //Log
            return false;
    }

    }


    /// Cria um novo papel, pega o n e Salva no lugar com a ID do papel velho

    public function update() {

        $pdo = conexao();
        
        try{

        $stmt = $pdo->prepare('UPDATE papel SET papel = :papel WHERE id = :id');
        $stmt->execute([':papel' => $this->papel, ':id' => $this->id]);

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
            foreach($pdo->query('SELECT * FROM papel') as $linha ){

                $papel = new Papel();
                
                $papel->setId($linha['id']);
                $papel->setPapel($linha['papel']);

                $lista[] = $papel;
    
            }
        } catch(Exception $e) {
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
            foreach($pdo->query('SELECT * FROM papel WHERE id = ' . $this.id) as $linha ){

                $papel = new papel();

                $papel->setPapel($linha['papel']);

                $lista[] = $papel;
    
            }
        } catch(Exception $e) {
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
        
            foreach($pdo->query('SELECT * FROM papel WHERE id = ' . $this->id) as $linha){

                $this->setPapel($linha['papel']);

            }
        
        } catch (Exception $e) {
            //Log
            return false;
        }


        return $this;
    }

    ///Fim

}
