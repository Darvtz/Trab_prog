<?php
include_once 'Conexao.php';

class Cargo{

    private $id;
    private $cargo;

    /// Getters e Setters

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getCargo(){
        return $this->cargo;
    }

    public function setCargo($cargo){
        $this->cargo = $cargo;
    }

    
    /// Salvar, se conecta e faz um PS para a tabela, faz um catch com erros

    public function save()
    {
        $pdo = conexao();

        try{
        
            $stmt = $pdo->prepare('INSERT INTO Cargo (id, cargo) VALUES(3, :cargo)');
            $stmt->execute([':cargo' => $this->cargo]);
      
        } catch(Exception $e) {
            //Log
            return false;
        }
    }

    
    /// Deleta, pega o ID

    public static function deletar ($id) {
        
        $pdo = conexao();

        try{

            $stmt = $pdo->prepare('DELETE FROM Cargo WHERE id = :id');
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

        $stmt = $pdo->prepare('UPDATE Cargo SET cargo = :cargo WHERE id = :id');
        $stmt->execute([':cargo' => $this->cargo, ':id' => $this->id]);

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
            foreach($pdo->query('SELECT * FROM cargo') as $linha ){

                $cargo = new Cargo();
                
                $cargo->setId($linha['id']);
                $cargo->setCargo($linha['cargo']);

                $lista[] = $cargo;
    
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
            foreach($pdo->query('SELECT * FROM Cargo WHERE id = ' . $this.id) as $linha ){

                $cargo = new Cargo();

                $cargo->setCargo($linha['cargo']);

                $lista[] = $cargo;
    
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
        
            foreach($pdo->query('SELECT * FROM Cargo WHERE id = ' . $this->id) as $linha){

                $this->setCargo($linha['cargo']);

            }
        
        } catch (Exception $e) {
            //Log
            return false;
        }


        return $this;
    }

    ///Fim

}
