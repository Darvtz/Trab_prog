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
    private $cargos = [];

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
        return $this->foto;
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

            return true;

        } catch(Exception $e) {
            //Log
            echo '<pre>';
            var_dump($e);
            return false;
        }
    }


    /// Deleta, pega o ID

    public static function deletar($id) {
        
        $pdo = conexao();

        try{

            $stmt = $pdo->prepare('DELETE FROM usuario  WHERE id = :id');
            $stmt->execute([':id => $id']);

        } catch(Exception $e) {
            //Log
            return false;
    }

    }


    /// Atualiza

    public function update() {
        $pdo = conexao();
    
        try {
            $stmt = $pdo->prepare('UPDATE usuario SET 
                nome = :nome,
                email = :email,
                senha = :senha,
                foto = :foto,
                data_nascimento = :datanasc,
                celular = :celular,
                banido = :banido
                WHERE id = :id');
    
            // Corrigimos o nome do parâmetro ':datanasc'
            $stmt->execute([
                ':nome' => $this->nome,
                ':email' => $this->email,
                ':senha' => $this->senha,
                ':foto' => $this->foto,
                ':datanasc' => $this->datanasc,  // Corrigido o nome do parâmetro aqui
                ':celular' => $this->celular,
                ':banido' => $this->banido,
                ':id' => $this->id
            ]);
            
        } catch (Exception $e) {
            // Log de erro
            var_dump($e);  // Pode ser um log mais elaborado aqui
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
                $usuario->setBanido($linha['banido']);

                $lista[] = $usuario;
    
            }
        } catch(Exception $e) {
            //Log
            return false;
        }   

        return $lista;

    }
    

    /// getOne

    public static function getOne($id) {
        $pdo = conexao();

        try{
            $usuario = new Usuario();
            foreach($pdo->query('SELECT * FROM usuario WHERE id = ' . $id) as $linha){

                $usuario->setId($linha['id']);
                $usuario->setNome($linha['nome']);
                $usuario->setSenha($linha['senha']);
                $usuario->setEmail($linha['email']);
                $usuario->setDatanasc($linha['data_nascimento']);
                $usuario->setCelular($linha['celular']);
                $usuario->setDatacad($linha['data_cadastro']);
                $usuario->setFoto($linha['foto']);
                $usuario->setBanido($linha['banido']);
    
            }
            return $usuario;
        } catch(Exception $e) {
            //Log
            var_dump($e);
            return false;
        }   

        return $lista;

    }
    

    /// Load

    public  function load(){
        $pdo = conexao();
        try{
        
            foreach($pdo->query('SELECT * FROM usuario WHERE id = ' . $this->id) as $linha){
                $this->setNome($linha['nome']);
                $this->setSenha($linha['senha']);
                $this->setEmail($linha['email']);
                $this->setDatanasc($linha['datanasc']);
                $this->setCelular($linha['celular']);
                $this->setDatacad($linha['datacad']);
                $this->setFoto($linha['foto']);
                $this->setBanido($linha['banido']);
            }
        
        } catch (Exception $e) {
            //Log
            return false;
        }


        return $this;
    }

    public  function loadByEmail(){
        $pdo = conexao();

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
                $this->setBanido($linha['banido']);
            }
        
        } catch (Exception $e) {
            //Log
            echo '<pre>';
            var_dump($e);
            return false;
        }


        return $this;
    }

    public function getCargo(){
        $pdo = conexao();

        try{

            foreach($pdo->query("SELECT cu.id_cargo FROM cargo_usuario cu
                                 INNER JOIN usuario u WHERE cu.id_usuario = " . $this->id) as $linha){
                if($linha['id_cargo'] == 1){
                    $_SESSION['ADMIN'] = true;
                } else if($linha['id_cargo'] == 2){
                    $_SESSION['MODERADOR'] = true;
                }
                $this->cargos[] = $linha['id_cargo'];
            }
            
        } catch (Exception $e) {
            //Log
            echo '<pre>';
            var_dump($e);
            return false;
        }
    }

    ///Fim

}
