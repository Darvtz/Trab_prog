<?php

include_once 'Conexao.php';
include_once 'Usuario.class.php';
include_once 'Animal.class.php';

class Comentario{

    private $id;
    private $comentario;
    private $usuario;
    private $postagem;

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getComentario(){
        return $this->comentario;
    }

    public function setComentario($comentario){
        $this->comentario = $comentario;
    }

    public function getUsuario(){
        return Usuario::getOne($this->usuario);

    }

    public function setUsuario($usuario){
        $this->usuario = $usuario;
    }

    public function getPostagem(){
        return Animal::getOne($this->postagem);
    }

    public function setPostagem($postagem){
        $this->postagem = $postagem;
    }

    public function save()
    {
        $pdo = conexao();

        try{
        
            $stmt = $pdo->prepare('INSERT INTO comentario (comentario, id_postagem, id_usuario) VALUES(:comentario, :id_postagem, :id_usuario)');
            $stmt->execute([':comentario' => $this->comentario, ':id_postagem'=>$this->postagem,':id_usuario'=> $this->usuario]);
      
        } catch(Exception $e){
            var_dump($e);
            return false;
        }
    }

    public function deletar(){
        
        $pdo = conexao();

        try{

            $stmt = $pdo->prepare('DELETE FROM comentario WHERE id = :id');
            $stmt->execute([':id' => $this->id]);

        } catch(Exception $e) {
            //Log
            return false;
        }
    }

    public function update() {

        $pdo = conexao();
        
        try{

        $stmt = $pdo->prepare('UPDATE comentario SET comentario = :comentario WHERE id = :id');
        $stmt->execute([':comentario' => $this->comentario, ':id' => $this->id]);
        return true;

        } catch(Exception $e) {
            //Log
            return false;
        }

    }

     public static function getComentarios(int $postagem){
         $pdo = conexao();
        
         try{
             $lista = [];
             foreach($pdo->query('SELECT * FROM comentario c WHERE id_postagem = '. $postagem ) as $linha ){

                 $comentario = new Comentario();
                
                 $comentario->setId($linha['id']);
                 $comentario->setUsuario($linha['id_usuario']);
                 $comentario->setComentario($linha['comentario']);

                 $lista[] = $comentario;
    
             }
         } catch(Exception $e) {
             //Log
             return false;
         }   

         return $lista;
     }

    // public function getUsuario(){
    //     $pdo = conexao();
        
    //     try{
    //         $lista = [];
    //         foreach($pdo->query('SELECT nome FROM Usuario u 
            
    //         INNER JOIN comentario postagem cp
    //         on u.id = cp.id_usuario
            
    //         INNER JOIN comentario c
    //         on cp.id_comentario = c.id') as $linha){

    //             $usuario = new Usuario();

    //             $usuario->setId($linha['id']);
    //             $usuario->setNome($linha['nome']);

    //         }
            
    //     }catch(Exception $e) {
    //         //Log
    //         return false;
    //     }
    // }

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

    public static function getOne($id) {
        $pdo = conexao(); // Supondo que essa função de conexão exista
        
        try {
            $comentario = null;
            
            // Use o parâmetro $id diretamente na consulta
            $query = 'SELECT * FROM comentario WHERE id = :id';
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
    
            // Agora, percorre os resultados da consulta
            foreach ($stmt as $linha) {
                $comentario = new Comentario();
                $comentario->setId($linha['id']);
                $comentario->setComentario($linha['comentario']);
            }
    
        } catch (Exception $e) {
            // Log de erro, se necessário
            return false;
        }
    
        return $comentario;
    }

    public  function load(){
        $pdo = conexao();

        #TODO ver que esse código cheira mal...
        try{
        
            foreach($pdo->query('SELECT * FROM comentario WHERE id = ' . $this->id) as $linha){
                var_dump($linha);
                $this->setComentario($linha['comentario']);
                $this->setPostagem($linha['id_postagem']);

            }
        
        } catch (Exception $e) {
            var_dump($e);
            return false;
        }


        return $this;
    }

}