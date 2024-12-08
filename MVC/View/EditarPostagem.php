<?php

include_once('../Model/Animal.class.php');

if(!isset($_SESSION)){
    session_start();
}

$animal = Animal::getOne($_REQUEST['id']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <title>Editar Postagem</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">GPetS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="../View/TelaInicial.php">Tela Inicial</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="../View/TelaUsuario.php?id=<?=$_SESSION['id'];?>">Tela do Usuário</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto"> <!-- Aqui foi adicionado ms-auto para alinhar à direita -->
                <li class="nav-item">
                    <a class="nav-link active" href="../View/logout.php">Sair do sistema</a>
                </li>
            </ul>
            <?php if(isset($_SESSION['ADMIN'])){?>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="../View/PostagensOcultas.php?id=<?=$_SESSION['id'];?>">Postagens Ocultas</a>
                </li>
            </ul>
            <?php } ?>               
        </div>
    </div>
</nav>

    <h1>Edite sua postagem</h1>

    <div>
        <form action="../Controller/Postagem.php?acao=editar&id=<?= $animal->getId()?>" method = "POST"  enctype="multipart/form-data">
            <div>
                    <label for="exampleInputNome">
                        Nome
                        <input type="text" class="form-control" id="exampleImputNome" name = "nome" value="<?php echo $animal->getNome(); ?>">
                    </label>
            </div>
            <div>
            <label for="exampleInputEspecie">Tipo de animal
                    <select name="especie" id="exampleImputEspecie">
                        <option value="Selecionar">Selecionar</option>
                        <option value="Ave">Ave</option>
                        <option value="Cachorro Domestico">Cachorro Doméstico</option>
                        <option value="Gato Domestico">Gato Doméstico</option>
                        <option value="Reptil">Reptil</option>
                        <option value="Peixe">Peixe</option>
                        <option value="Roedor">Roedor</option>
                        <option value="">Outro/a</option>
                    </select>
                </label>
            </div>
            <div>
                <label for="exampleInputNome">Raça
                    <input type="text" class="form-control" id="exampleImputRaca" name = "raca" value="<?php echo $animal->getRaca();?>">
                </label>
            </div>
            <div>
                <label>Sexo</label>
                <input type="radio"  id="exampleImputGenero1" name = "genero" required> 
                <label for='exampleImputGenero1'>Macho</label>
                <input type="radio" id="exampleImputGenero2" name = "genero" required>
                <label for='exampleImputGenero2'>Fêmea</label>
                </label>
            </div>
            <div>
                <label for="exampleInputNome">Cor
                    <input type="text" class="form-control" id="exampleImputCor" name = "cor" value="<?php echo $animal->getCor();?>">
                </label>
            </div>
            <div>
                <label for="exampleInputNome">Ultimo endereço visto:</label></br></br>
                <label>Estado
                    <select class="form-control" id="exampleImputEstado" name="estado" required>
                        <option value="">Selecionar</option>
                        <?php
                        // Lista de estados
                        $estados = [
                            'AC' => 'Acre',
                            'AL' => 'Alagoas',
                            'AP' => 'Amapá',
                            'AM' => 'Amazonas',
                            'BA' => 'Bahia',
                            'CE' => 'Ceará',
                            'DF' => 'Distrito Federal',
                            'ES' => 'Espírito Santo',
                            'GO' => 'Goiás',
                            'MA' => 'Maranhão',
                            'MT' => 'Mato Grosso',
                            'MS' => 'Mato Grosso do Sul',
                            'MG' => 'Minas Gerais',
                            'PA' => 'Pará',
                            'PB' => 'Paraíba',
                            'PR' => 'Paraná',
                            'PE' => 'Pernambuco',
                            'PI' => 'Piauí',
                            'RJ' => 'Rio de Janeiro',
                            'RN' => 'Rio Grande do Norte',
                            'RS' => 'Rio Grande do Sul',
                            'RO' => 'Rondônia',
                            'RR' => 'Roraima',
                            'SC' => 'Santa Catarina',
                            'SP' => 'São Paulo',
                            'SE' => 'Sergipe',
                            'TO' => 'Tocantins'
                        ];

                        // Obter o estado atual do animal
                        $estadoSelecionado = $animal->getEstado();

                        // Gerar as opções do select
                        foreach ($estados as $sigla => $nome) {
                            // Verificar se o estado do animal corresponde à opção atual
                            $selected = ($sigla == $estadoSelecionado) ? 'selected' : '';
                            echo "<option value=\"$sigla\" $selected>$nome</option>";
                        }
                        ?>
                    </select>
                    </label><br>
                    
                    <label>Cidade<input type="name" class="form-control" id="exampleImputCidade" name="cidade" value="<?php echo $animal->getCidade();?>"></label></br>
                    <label>Rua<input type="name" class="form-control" id="exampleImputRua" name="rua" value="<?php echo $animal->getRua();?>"></label></br>
                    <label>Número<input type="number" class="form-control" id="exampleImputNumero" name="numero" value="<?php echo $animal->getNumero();?>"></label></br>
            </div>
            <div>
            <label for="exampleInputCelular" class="form-label">
                Meio de contato com o dono do animal:
                <input type="text" class="form-control" id="exampleInputCelular" name="contato" value="<?php echo $animal->getContato();?>">
            </label>
            <div>
                <label for="exampleInputNome">Descrição adicional
                    <input type="name" class="form-control" id="exampleImputDescricao" name="descricao" value="<?php echo $animal->getDescricao();?>">
                </label>
            </div>
                <p><label>Insira a imagem do animal</label></p> </br>
              
                <p>
                  <input name="arquivo" type="file">x
                  <button name="upload" type="submit" >Editar Postagem</button>
                </p>
</form>
    </div>

</body>
</html>