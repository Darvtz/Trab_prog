<?php
include_once 'conexao.php';

class Usuario{

    private $id;
    private $cpf;
    private $nome;
    private $senha;
    private $email;
    private $foto;
    private $datanasc;
    private $celular;
    private $datacad;

    /// Getters e Setters

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getCpf(){
        return $this->cpf;
    }

    public function setCpf($cpf){
        $this->cpf = $cpf;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function getSenha(){
        return $this->senha;
    }

    public function setSenha($senha){
        $this->senha = $senha;
    }
    
    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getDatanasc(){
        return $this->datanasc;
    }

    public function setDatanasc($datanasc){
        $this->datanasc = $datanasc;
    }

    public function getCelular(){
        return $this->celular;
    }

    public function setCelular($celular){
        $this->celular = $celular;
    }

    public function getDatacad(){
        return $this->datacad;
    }

    public function setDatacad($datacad){
        $this->datacad = $datacad;
    }

    public function getFoto(){
        return $this->Foto;
    }

    public function setFoto($foto){
        $this->foto= $foto;
    }
    
    /// Salvar, se conecta e faz um PS para a tabela, faz um catch com erros

    public function save()
    {
        $pdo = conexao();

        try{
        
            $stmt = $pdo->prepare('INSERT INTO usuario (cpf, nome, senha, email, data_nascimento, celular, datacad, foto) 
            VALUES(:cpf, :nome, :senha, :email, :datanasc, :celular, :datacad, :foto)');
            $stmt->execute([':cpf' => $this->cpf,
                            ':nome' => $this->nome,
                            ':senha' => $this->senha,
                            ':email' => $this->email,
                            ':datanasc' => $this->datanasc,
                            ':celular' => $this->celular,
                            ':datacad' => $this->datacad,
                            ':foto' => $this->foto]);
            

            $id = $pdo->lastInsertID();
            /// Selecionar ID do papel
            
            $stmtx = $pdo->prepare('INSERT INTO cargo_usuario (id_usuario, id_cargo) VALUES(:id_usuario, :id_cargo)');
            $stmtx->execute([':id_usuario'=> $id]);

            

        } catch(Exception $e) {
            //Log
            echo '<pre>';
            var_dump($e);
            return false;
        }
    }


    /// Deleta, pega o ID

    public static function deletar ($id) {
        
        $pdo = conexao();

        try{

            $stmt = $pdo->prepare('DELETE FROM usuario, papel_usuario WHERE id_usuario = :id');
            $stmt->execute([':id => $id']);

        } catch(Exception $e) {
            //Log
            return false;
    }

    }


    /// Atualiza

    public function update ($papel, $id) {

        $pdo = conexao();
        
        try{

        /// Corrigir $stmt = $pdo->prepare('UPDATE papel_usuario SET id_papel =  WHERE id_usuario = :id');
        /// Corrigir $stmt->execute([':papel => $papel', ':id => $id']);
        
        /// ? $stmt->execute([':papel' => $this->papel, ':id' => $this->id]);

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
            foreach($pdo->query('SELECT * FROM Usuario') as $linha ){

                $usuario = new Usuario();
                
                $usuario->setNome($linha['nome']);
                $usuario->setSenha($linha['senha']);
                $usuario->setEmail($linha['email']);
                $usuario->setDatanasc($linha['datanasc']);
                $usuario->setCelular($linha['celular']);
                $usuario->setDatacad($linha['datacad']);
                $usuario->setFoto($linha['foto']);

                $lista[] = $usuario;
    
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
            foreach($pdo->query('SELECT * FROM Usuario WHERE id = ' . $this.id) as $linha ){

                $usuario = new Usuario();

                $usuario->setNome($linha['nome']);
                $usuario->setSenha($linha['senha']);
                $usuario->setEmail($linha['email']);
                $usuario->setDatanasc($linha['datanasc']);
                $usuario->setCelular($linha['celular']);
                $usuario->setDatacad($linha['datacad']);
                $usuario->setFoto($linha['foto']);

                $lista[] = $usuario;
    
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
        
            foreach($pdo->query('SELECT * FROM Usuario WHERE id = ' . $this->id) as $linha){
                $this->setNome($linha['nome']);
                $this->setSenha($linha['senha']);
                $this->setEmail($linha['email']);
                $this->setDatanasc($linha['datanasc']);
                $this->setCelular($linha['celular']);
                $this->setDatacad($linha['datacad']);
                $this->setFoto($linha['foto']);
            }
        
        } catch (Exception $e) {
            //Log
            return false;
        }


        return $this;
    }

    ///Fim

}
