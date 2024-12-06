<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <title>Postagem</title>
</head>
<body>
    <h1>Insira as informações do post abaixo</h1>

    <div>
        <form action="../Controller/Postagem.php?acao=postar" method = "POST"  enctype="multipart/form-data">
            <div>
                    <label for="exampleInputNome">
                        Nome
                        <input type="text" class="form-control" id="exampleImputNome" name = "nome" required>
                    </label>
            </div>
            <div>
                <label for="exampleInputEspecie">Tipo de animal
                    <select name="especie" id="exampleImputEspecie">
                        <option value="Selecionar">Selecionar</option>
                        <option value="Ave">Ave</option>
                        <option value="Cachorro Doméstico">Cachorro Doméstico</option>
                        <option value="Gato Doméstico">Gato Doméstico</option>
                        <option value="Reptil">Reptil</option>
                        <option value="Peixe">Peixe</option>
                        <option value="Roedor">Roedor</option>
                        <option value="">Outro/a</option>
                    </select>
                </label>
            </div>
            <div>
                <label for="exampleInputRaca">Raça Específica
                    <input type="text" class="form-control" id="exampleImputRaca" name = "raca" required>
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
                <label for="exampleInputCor">Cor
                    <input type="text" class="form-control" id="exampleImputCor" name = "cor" required>
                </label>
            </div>
            <div>
                <label">Ultimo endereço visto:</label></br></br>
                    <label>Estado<select type="name" class="form-control" id="exampleImputEstado" name="estado" required>
                                    <option value="">Selecionar</option>
                                    <option value="AC">Acre</option>
                                    <option value="AL">Alagoas</option>
                                    <option value="AP">Amapá</option>
                                    <option value="AM">Amazonas</option>
                                    <option value="BA">Bahia</option>
                                    <option value="CE">Ceará</option>
                                    <option value="DF">Distrito Federal</option>
                                    <option value="ES">Espírito Santo</option>
                                    <option value="GO">Goiás</option>
                                    <option value="MA">Maranhão</option>
                                    <option value="MT">Mato Grosso</option>
                                    <option value="MS">Mato Grosso do Sul</option>
                                    <option value="MG">Minas Gerais</option>
                                    <option value="PA">Pará</option>
                                    <option value="PB">Paraíba</option>
                                    <option value="PR">Paraná</option>
                                    <option value="PE">Pernambuco</option>
                                    <option value="PI">Piauí</option>
                                    <option value="RJ">Rio de Janeiro</option>
                                    <option value="RN">Rio Grande do Norte</option>
                                    <option value="RS">Rio Grande do Sul</option>
                                    <option value="RO">Rondônia</option>
                                    <option value="RR">Roraima</option>
                                    <option value="SC">Santa Catarina</option>
                                    <option value="SP">São Paulo</option>
                                    <option value="SE">Sergipe</option>
                                    <option value="TO">Tocantins</option>
                                </select></label></br>
                    <label>Cidade<input type="name" class="form-control" id="exampleImputCidade" name="cidade" required></label></br>
                    <label>Rua<input type="name" class="form-control" id="exampleImputRua" name="rua"></label></br>
                    <label>Número<input type="number" class="form-control" id="exampleImputNumero" name="numero"></label></br>
            </div>            
            <div class="mb-3">
            <label for="exampleInputCelular" class="form-label">
                Meio de contato com o dono do animal:
                <input type="text" class="form-control" id="exampleInputCelular" name="contato">
            </label>
            </div>
            <div>
                <label for="exampleInputDescricao">Descrição adicional
                    <input type="name" class="form-control" id="exampleImputDescricao" name="descricao">
                </label>
            </div>
                <p><label>Insira a imagem do animal</label></p> </br>
              
                <p><input name="arquivo" type="file"></br></br>
                  <button name="upload" type="submit" >Fazer Postagem</button></br>
                  <?php if(isset($_REQUEST['error'])){ echo 'erro no postagem, verifique os dados'; }?>
                </p>
</form>
    </div>

</body>
</html>