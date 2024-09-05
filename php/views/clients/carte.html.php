
    <style>
        .barcode-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg rounded-lg w-full max-w-md p-6">
        <div class="flex items-center justify-center mb-4">
            <img src="<?= $client->photo ? $client->photo : './avatar.jpeg'; ?>" alt=" Client" class="w-24 h-24 rounded-full object-cover">
        </div>
        <h1 class="text-2xl font-bold text-center mb-4"><?= $client->nomc; ?> <?= $client->prenomc; ?></h1>
        <div class="mb-4">
            <p class="text-lg font-semibold">Téléphone:</p>
            <p class="text-lg"><?= $client->tel; ?></p>
            <p class="text-lg font-semibold">Adresse:</p>
            <p class="text-lg"><?= $client->adresse; ?></p>
            <p class="text-lg font-semibold">Catégorie:</p>
            <p class="text-lg"><?= $client->categorie; ?></p>
            <p class="text-lg font-semibold">Montant Seuil:</p>
            <p class="text-lg"><?= $client->montantseuil; ?> FCFA</p>
        </div>
        <div class="barcode-container">
            <svg id="barcode"></svg>
            <p class="text-xl font-bold mt-2"><?= $client->idcl; ?></p>
        </div>
    </div>

    <script>
        // Générer le code-barres avec le numéro du client
        JsBarcode("#barcode", "<?= $client->idcl; ?>", {
            format: "CODE128",
            width: 2,
            height: 50,
            displayValue: false
        });
    </script>

