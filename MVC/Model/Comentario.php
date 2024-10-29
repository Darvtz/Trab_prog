<?php
include_once 'Conexao.php';

class Animal{

    private $id;
    private $comentario;

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getComentario()){
        return $this->comentario;
    }

    public function setId($comentario){
        $this->comentario = $comentario;
    }

    public function save()
    {
        $pdo = conexao();

        try{
        
            $stmt = $pdo->prepare('INSERT INTO cometario (id, comentario) VALUES(:comentario)');
            $stmt->execute([':comentario' => $this->comentario]);
      
        } catch(Exception $e) {
            //Log
            return false;
        }
    }

    public static function deletar ($id) {
        
        $pdo = conexao();

        try{

            $stmt = $pdo->prepare('DELETE FROM comentario WHERE id = :id');
            $stmt->execute([':id => $id']);

        } catch(Exception $e) {
            //Log
            return false;
    }

    public function update() {

        $pdo = conexao();
        
        try{

        $stmt = $pdo->prepare('UPDATE cometario SET cometario = :cometario WHERE id = :id');
        $stmt->execute([':comentario' => $this->comentario, ':id' => $this->id]);

        } catch(Exception $e) {
            //Log
            return false;
        }

    }

    public static function getAll() {
        $pdo = conexao();
        
        try{
            $lista = [];
            foreach($pdo->query('SELECT * FROM comentario') as $linha ){

                $comentario = new Comentario();
                
                $comentario->setId($linha['id']);
                $comentario->setComentario($linha['cargo']);

                $lista[] = $cargo;
    
            }
        } catch(Exception $e) {
            //Log
            return false;
        }   

        return $lista;

    }

    public static function getOne() {
        $pdo = conexao();
        #TODO id não deveria ser string, consertar
        try{
            $lista = [];
            foreach($pdo->query('SELECT * FROM cometario WHERE id = ' . $this->id) as $linha ){

                $comentario = new Comentario();

                $comentario->setComentario($linha['comentario']);

                $lista[] = $cometario;
    
            }
        } catch(Exception $e) {
            //Log
            return false;
        }   

        return $lista;

    }

    public  function load(){
        $pdo = conexao();

        #TODO ver que esse código cheira mal...
        try{
        
            foreach($pdo->query('SELECT * FROM cometario WHERE id = ' . $this->id) as $linha){

                $this->setCometario($linha['cometario']);

            }
        
        } catch (Exception $e) {
            //Log
            return false;
        }


        return $this;
    }

}

?>