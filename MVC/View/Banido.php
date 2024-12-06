<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuário Banido</title>
    <style>
        /* Estilos gerais */
        body {
            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            margin: auto;
            color: aliceblue;
            border-style: hidden;
            border-radius: 5px;
            background-color: dodgerblue;
            padding: 10px;
        }

        .alerta {
            background-color: rgb(255, 99, 71); /* Vermelho claro */
            color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            text-align: center;
            margin-top: 20px;
            font-size: 18px;
            width: 50%;
            margin: 0 auto;
        }

        /* Estilos adicionais para centralização e transições */
        .card {
            display: flex;
            justify-content: center;
            margin: 0 auto;
            text-align: center;
        }

        .mb-1 {
            background-color: rgb(61, 170, 234);
            color: white;
        }

        .md-3 {
            margin: auto;
            text-align: center;
        }

        .foto-usuario {
            width: 150px !important;
            height: 150px !important;
            object-fit: cover !important;
            border-radius: 50% !important;
            border: 3px solid #fff !important;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1) !important;
            transition: transform 0.3s ease, box-shadow 0.3s ease !important;
        }

        .foto-usuario:hover {
            transform: scale(1.1); /* Aumenta ligeiramente a imagem ao passar o mouse */
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2); /* Aumenta a sombra ao passar o mouse */
        }

        /* Botões de compartilhamento (não necessários para o alerta, mas incluídos conforme o CSS fornecido) */
        .share-btn-container a {
            display: flex;
            align-items: center;
            padding: 8px 16px;
            text-decoration: none;
            color: white;
            font-size: 16px;
            margin: 8px 0;
            transition: transform 0.3s ease, background-color 0.3s ease;
            border-radius: 8px;
        }

        .share-btn-container a i {
            margin-right: 8px;
            font-size: 20px;
        }
    </style>
</head>
<body>

    <!-- Cabeçalho -->
    <h1>Alerta de Banimento</h1>

    <!-- Mensagem de alerta -->
    <div class="alerta">
        <strong>Você foi banido!</strong><br>
        Seu acesso foi revogado. Você Não possui mais permissão para adentrar neste site.
    </div>
</body>
</html>