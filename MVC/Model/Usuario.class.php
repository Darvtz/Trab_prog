<?php
include_once 'Conexao.php';

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
    private $banido = false;

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

    public function getBanido(){
        return $this->banido;
    }

    public function setBanido($banido){
        $this->banido = $banido;
    }
    
    /// Salvar, se conecta e faz um PS para a tabela, faz um catch com erros

    public function save()
    {
        $pdo = conexao();

        try{
        
            $stmt = $pdo->prepare('INSERT INTO usuario (cpf, nome, senha, email, data_nascimento, celular, data_cadastro, foto, banido) 
            VALUES(:cpf, :nome, :senha, :email, :datanasc, :celular, :datacad, :foto, :banido)');
            $stmt->execute([':cpf' => $this->cpf,
                            ':nome' => $this->nome,
                            ':senha' => $this->senha,
                            ':email' => $this->email,
                            ':datanasc' => $this->datanasc,
                            ':celular' => $this->celular,
                            ':datacad' => $this->datacad,
                            ':foto' => $this->foto,
                            ':banido' => $this->banido]);
            

            $id = $pdo->lastInsertID();
            /// Selecionar ID do papel
            
            $stmtx = $pdo->prepare('INSERT INTO cargo_usuario (id_usuario, id_cargo) VALUES(:id_usuario, 3)');
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

            $stmt = $pdo->prepare('DELETE FROM usuario  WHERE id_usuario = :id');
            $stmt->execute([':id => $id']);

        } catch(Exception $e) {
            //Log
            return false;
    }

    }


    /// Atualiza

    public function update ( $id) {

        $pdo = conexao();
        
        try{

        //$stmt = $pdo->prepare('UPDATE Usuario SET nome=''  WHERE id_usuario = :id');

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
            foreach($pdo->query('SELECT * FROM usuario') as $linha ){

                $usuario = new Usuario();
                //echo '<pre>';
                //var_dump($usuario);
                
                $usuario->setId($linha['id']);
                $usuario->setCpf($linha['cpf']);
                $usuario->setNome($linha['nome']);
                $usuario->setSenha($linha['senha']);
                $usuario->setEmail($linha['email']);
                $usuario->setDatanasc($linha['data_nascimento']);
                $usuario->setCelular($linha['celular']);
                $usuario->setDatacad($linha['data_cadastro']);
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
            foreach($pdo->query('SELECT * FROM usuario WHERE id = ' . $this.id) as $linha ){

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
        
            foreach($pdo->query('SELECT * FROM usuario WHERE id = ' . $this->id) as $linha){
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

    public  function loadByEmail(){
        $pdo = conexao();

        #TODO ver que esse código cheira mal...
        try{
        
            foreach($pdo->query("SELECT * FROM usuario WHERE email = '$this->email'") as $linha){
                $this->setId($linha['id']);
                $this->setNome($linha['nome']);
                $this->setSenha($linha['senha']);
                $this->setEmail($linha['email']);
                $this->setDatanasc($linha['data_nascimento']);
                $this->setCelular($linha['celular']);
                $this->setDatacad($linha['data_cadastro']);
                $this->setFoto($linha['foto']);
            }
        
        } catch (Exception $e) {
            //Log
            echo '<pre>';
            var_dump($e);
            return false;
        }


        return $this;
    }

    ///Fim

}
