<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro-Kamillah</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="container-main">
    <form class="container-form" method="POST" action="../controllers/controllerRegistro.php">
        <label for="#" class="label-form">CNPJ:</label>
        <input type="text" placeholder="Adicione o seu cnpj" name="cnpj" class="input-form" required>
        <label for="#" class="label-form">Razão Social:</label>
        <input type="text" placeholder="Adicione a Razão social" name="razaoSocial" class="input-form" required>
        <label for="#" class="label-form">Nome Fantasia:</label>
        <input type="text" placeholder="Adicione o Nome Fantasia" name="nomeFantasia" class="input-form" required>
        <label for="#" class="label-form">Senha:</label>
        <input type="text" placeholder="Adicione a Senha" name="senha" class="input-form" required>
        <button id="btnRegistrar">Registrar</button>
    </form>
</body>

</html>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        function adicionarMascaraCnpj(event) {
            const cnpj = event.target.value.replace(/\D/g, "").slice(0, 14);
            event.target.value = cnpj
                .replace(/^(\d{2})(\d)/, "$1.$2")
                .replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3")
                .replace(/\.(\d{3})(\d)/, ".$1/$2")
                .replace(/(\d{4})(\d)/, "$1-$2");
        }

        function adicionarMascaraCpf(event) {
            const cpf = event.target.value.replace(/\D/g, "").slice(0, 11);
            event.target.value = cpf
                .replace(/^(\d{3})(\d)/, "$1.$2")
                .replace(/^(\d{3})\.(\d{3})(\d)/, "$1.$2.$3")
                .replace(/^(\d{3})\.(\d{3})\.(\d{3})(\d{1,2})$/, "$1.$2.$3-$4");
        }

        const campoCnpj = document.querySelector('input[name="cnpj"]');
        const campoCpf = document.querySelector('input[name="cpf"]');

        if (campoCnpj) {
            campoCnpj.addEventListener("input", adicionarMascaraCnpj);
        }

        if (campoCpf) {
            campoCpf.addEventListener("input", adicionarMascaraCpf);
        }
    });
</script>