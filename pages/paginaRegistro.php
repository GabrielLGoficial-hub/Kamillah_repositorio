<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro-Kamillah</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Clarity+City:ital,wght@0,100..900;1,100..900&family=Oswald:wght@200..700&family=Quantico:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
</head>

<body class="container-main" style="flex-direction: column; gap:1rem;">
    <div class="container-form fade-in" style="height: 5rem !important;">
        <label for="#" class="label-form">Tipo de cadastro:</label>
        <div style="display:flex; flex-direction:row; gap:1rem;">
            <label for="pFisica" class="label-form" style="font-size:small;"><input type="radio" name="tipoCadastro" id="pFisica" value="fisica" required>Pessoa Fisica</label>
            <label for="pJuridica" class="label-form" style="font-size: small;"><input type="radio" name="tipoCadastro" id="pJuridica" value="juridica" required>Pessoa Juridica</label>
        </div>
    </div>
    <form class="container-form fade-in" method="POST" action="/api/cadastro">
        <label for="cnpj" class="label-form">CNPJ:</label>
        <input type="text" id="cnpj" placeholder="Adicione o seu cnpj" name="cnpj" class="input-form" required>
        <label for="cpf" class="label-form">CPF:</label>
        <input type="text" id="cpf" placeholder="Adicione o seu cpf" name="cpf" class="input-form" required>
        <label for="razaoSocial" class="label-form">Razão Social:</label>
        <input type="text" id="razaoSocial" placeholder="Adicione a Razão social" name="razaoSocial" class="input-form" required>
        <label for="nomeFantasia" class="label-form">Nome Fantasia:</label>
        <input type="text" id="nomeFantasia" placeholder="Adicione o Nome Fantasia" name="nomeFantasia" class="input-form" required>
        <label for="email" class="label-form">Email:</label>
        <input type="text" id="email" placeholder="Insira o seu email" name="email" class="input-form" required>
        <label for="senha" class="label-form">Senha:</label>
        <input type="password" id="senha" placeholder="Adicione a Senha" name="senha" class="input-form" required>
        <button id="btnRegistrar" class="button-form">Registrar</button>
    </form>
</body>

</html>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        function desabilitarCamposFisica() {
            campoCpf.style.display = "none";
            labelCpf.style.display = "none";
            razaoSocial.style.display = "block";
            nomeFantasia.style.display = "block";
            labelRazao.style.display = "block";
            labelFantasia.style.display = "block";
            campoCnpj.style.display = "block";
            labelCnpj.style.display = "block";
        }

        function desabilitarCamposJuridica() {
            labelCpf.style.display = "block";
            campoCpf.style.display = "block";
            razaoSocial.style.display = "none";
            nomeFantasia.style.display = "none";
            labelRazao.style.display = "none";
            labelFantasia.style.display = "none";
            campoCnpj.style.display = "none";
            labelCnpj.style.display = "none";
        }

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

        const rbFisica = document.getElementById("pFisica");
        const rbJuridica = document.getElementById("pJuridica");
        const razaoSocial = document.querySelector('input[name="razaoSocial"]');
        const nomeFantasia = document.querySelector('input[name="nomeFantasia"]');
        const labelRazao = document.querySelector('label[for="razaoSocial"]');
        const labelFantasia = document.querySelector('label[for="nomeFantasia"]');
        const labelCpf = document.querySelector('label[for="cpf"]');
        const labelCnpj = document.querySelector('label[for="cnpj"]');


        rbJuridica.checked = true;
        desabilitarCamposFisica();

        rbFisica.addEventListener("change", function() {
            desabilitarCamposJuridica();
        })

        rbJuridica.addEventListener("change", function() {
            desabilitarCamposFisica();
        })

    });
</script>