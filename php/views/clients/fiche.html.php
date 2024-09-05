<?php
$page = 1;
$nbrPage = 3;
?>

<!-- Affichage des Informations du Client -->
<div class="container mx-auto p-4">
    <div class="flex items-center justify-around">
        <div class="w-1/3">
            <!-- Afficher la photo du client, s'il y en a une -->
            <img src="<?= $client->photo ? $client->photo : "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSzDR9UU9sQWlWTDm1JbBvjy2lCQbNM9z29Dw&usqp=CAU" ?>" class="iminfo rounded-full" alt="">
        </div>
        <div class="w-1/3">
            <!-- Afficher les informations du client -->
            <p class="text-left text-lg">Nom: <strong><?= $client->nomc; ?></strong></p>
            <p class="text-left text-lg">Prénom: <strong><?= $client->prenomc; ?></strong></p>
            <p class="text-left text-lg">Téléphone: <strong><?= $client->tel; ?></strong></p>
            <p class="text-left text-lg">Adresse: <strong><?= $client->adresse; ?></strong></p>
            <p class="text-left text-lg">Catégorie: <strong><?= $client->categorie; ?></strong></p>
        </div>
        <div class="w-1/3">
            <!-- Afficher les montants et le solde avec le montant seuil -->
            <p class="text-left text-lg">Total Dette: <strong><?= $client->solde; ?> FCFA</strong></p>
            <p class="text-left text-lg">Montant Versé: <strong><?= $client->verse; ?> FCFA</strong></p>
            <p class="text-left text-lg">Montant du: <strong><?= $client->restant; ?> FCFA</strong></p>
            <p class="text-left text-lg">Solde: <strong><?= $client->solde; ?> FCFA</strong></p>
            <p class="text-left text-lg">Montant Seuil: <strong><?= $client->montantseuil; ?> FCFA</strong></p>
        </div>
    </div>
  <!-- Boutons pour afficher les popups -->
<div class="mt-4 flex space-x-4">
<?php if($this->session->getRole()!="Client"):?>
    <!-- Bouton pour Modifier Montant Seuil -->
    <button id="btnEditMontantSeuil" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition">
        Modifier Montant Seuil
    </button>
    
    <!-- Bouton pour Modifier Catégorie -->
    <button id="btnEditCategorie" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50 transition">
        Modifier Catégorie
    </button>
    <?php endif?>
    
    <!-- Bouton pour Afficher Carte de Fidélité -->
    <button id="btnEditCarte" onclick="genrateQrCode('<?= $client->tel; ?>')" class="bg-purple-500 text-white px-4 py-2 rounded hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50 transition">
        Carte de Fidélité
    </button>
</div>
</div>


<!-- Modals for Editing -->
<!-- Modal for Editing Montant Seuil -->
<div id="modalEditMontantSeuil" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-4 rounded-lg">
        <h2 class="text-lg font-bold mb-4">Modifier Montant Seuil</h2>
        <form action="update_seuil.php" method="post">
            <input type="hidden" name="idClient" value="<?= $client->idcl; ?>">
            <label for="montantSeuil" class="block text-sm mb-2">Montant Seuil:</label>
            <input type="text" name="montantSeuil" id="montantSeuil" class="p-2 border rounded" value="<?= $client->montantseuil; ?>">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-4">Enregistrer</button>
            <button type="button" id="closeModalEditMontantSeuil" class="bg-gray-500 text-white px-4 py-2 rounded mt-4">Annuler</button>
        </form>
    </div>
</div>

<!-- Modal for Editing Catégorie -->
<div id="modalEditCategorie" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-4 rounded-lg">
        <h2 class="text-lg font-bold mb-4">Modifier Catégorie</h2>
        <form action="update_categorie.php" method="post">
            <input type="hidden" name="idClient" value="<?= $client->idcl; ?>">
            <label for="categorie" class="block text-sm mb-2">Catégorie:</label>
            <select name="categorie" id="categorie" class="p-2 border rounded">
                <option value="solvable" <?= $client->categorie === "solvable" ? "selected" : "" ?>>Solvable</option>
                <option value="insolvable" <?= $client->categorie === "insolvable" ? "selected" : "" ?>>Insolvable</option>
                <!-- Add other categories as needed -->
            </select>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-4">Enregistrer</button>
            <button type="button" id="closeModalEditCategorie" class="bg-gray-500 text-white px-4 py-2 rounded mt-4">Annuler</button>
        </form>
    </div>
</div>

<!-- Modal for carte de fidelite -->
<div id="modalCarte" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-4 rounded-lg">
        <h2 class="text-lg font-bold mb-4">Carte de Fidelite</h2>
        <div class="bg-white shadow-lg rounded-lg w-full  p-6">
            <div class="flex items-center justify-center mb-4">
                <img src="<?= $client->photo ? $client->photo : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSzDR9UU9sQWlWTDm1JbBvjy2lCQbNM9z29Dw&usqp=CAU' ?>" alt="Client" class="w-24 h-24 rounded-full object-cover">
            </div>
            <h1 class="text-2xl font-bold text-center mb-4"><?= $client->nomc; ?> <?= $client->prenomc; ?></h1>
            <div class="flex justify-around align-items-center">
                <div class="mt-4 p-2">
                    <p class="text-lg font-semibold">Téléphone: <?= $client->tel; ?></p>
                    <p class="text-lg font-semibold">Email: <?= $client->email; ?></p>
                    <p class="text-lg font-semibold">Adresse: <?= $client->adresse; ?></p>
                </div>
                <div class="qr-code p-2" >
                    <img src="" alt="qr-code">
                </div>

            </div>

        </div>
        <button type="button" id="closeModalCarte" class="bg-gray-500 text-white px-4 py-2 rounded mt-4">Fermer</button>

    </div>
</div>














<div class=" mx-auto">

    <div class="border-b border-gray-200 dark:border-gray-700 mb-4">
        <ul class="flex flex-wrap -mb-px" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">

            <!-- Partie INFORMATION -->
            <li class="mr-2" role="presentation">
                <button class="inline-block text-gray-500 hover:text-gray-600 hover:border-gray-300 rounded-t-lg py-4 px-4 text-sm font-medium text-center border-transparent border-b-2 dark:text-gray-400 dark:hover:text-gray-300 active" id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="true">INFORMATION</button>
            </li>
            <!-- Partie DETTE -->
            <li class="mr-2" role="presentation">
                <button class="inline-block text-gray-500 hover:text-gray-600 hover:border-gray-300 rounded-t-lg py-4 px-4 text-sm font-medium text-center border-transparent border-b-2 dark:text-gray-400 dark:hover:text-gray-300" id="settings-tab" data-tabs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">DETTE</button>
            </li>
            <!-- Partie DEPOT -->
            <li role="presentation">
                <button class="inline-block text-gray-500 hover:text-gray-600 hover:border-gray-300 rounded-t-lg py-4 px-4 text-sm font-medium text-center border-transparent border-b-2 dark:text-gray-400 dark:hover:text-gray-300" id="contacts-tab" data-tabs-target="#contacts" type="button" role="tab" aria-controls="contacts" aria-selected="false">DEPOT</button>
            </li>
        </ul>
    </div>
    <div id="myTabContent">
        <!-- Partie INFORMATION -->
        <div class="p-1 rounded-lg shadow-xl" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
            <div class="tab-pane fade show active" id="nav-info" role="tabpanel" aria-labelledby="nav-info-tab">
                <div class="container mx-auto flex items-center justify-around mt-2">
                    <div class="w-1/2">
                        <!-- Afficher la photo du client, s'il y en a une -->
                        <img src="<?= $client->photo ? $client->photo : './avatar.jpeg'; ?>" class="iminfo rounded-full" alt="">
                    </div>
                    <div class="w-1/2">
                        <!-- Afficher les informations du client -->
                        <p class="text-left text-lg">Nom: <?= $client->nomc; ?></p>
                        <p class="text-left text-lg">Prenom: <?= $client->prenomc; ?></p>
                        <p class="text-left text-lg">Telephone: <?= $client->tel; ?></p>
                        <p class="text-left text-lg">Adresse: <?= $client->adresse; ?></p>
                    </div>
                </div>
                <div class="container mx-auto mt-3">
                    <!-- Afficher les montants et le solde avec le montant seuil -->
                    <p class="text-left text-lg">Total Dette: <?= $client->solde; ?> FCFA</p>
                    <p class="text-left text-lg">Montant Versé: <?= $client->verse; ?> FCFA</p>
                    <p class="text-left text-lg">Montant du: <?= $client->restant; ?> FCFA</p>
                    <p class="text-left text-lg">Solde: <?= $client->solde; ?> FCFA</p>
                    <p class="text-left text-lg">Montant Seuil: <?= $client->montantseuil; ?> FCFA</p>
                </div>
            </div>
        </div>


        <!-- Partie Dette -->
        <div class=" p-1 rounded-lg shadow-xl hidden" id="settings" role="tabpanel" aria-labelledby="settings-tab">
            <div class="p-4 border-1 border-gray-200  rounded-lg dark:border-gray-700 ">
                <div class="w-11/12 ">
                    <h1 class="text-gray-900 text-2xl text-bold ">Tous les dettes</h1>
                </div>
                <?php if($this->session->getRole()!="Client"):?>
                <div class=" w-11/12 mb-3 mt-3 text-center flex justify-end ">
                    <a href="<?= $this->path("dettes", "add", ["verif" => "findbytel", "telsearch" => $client->tel ?? ""]) ?>">
                        <button
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                            type="button">
                            Ajouter </button></a>
                </div>
                <?php endif ?>

                <!-- formulaire de filtre -->
                <div class="w-full bg-white p-4 rounded shadow-md ">
                    <form class="mb-3 mt-3" action="" method="get">
                        <div>
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
                                <input type="date" name="datedet" placeholder="Filtrer par Date" class="p-2 border rounded" value="<?= $filtre["datedet"] ?? "" ?>">
                                <select name="etatdet" class="p-2 border rounded">
                                    <option value="">Filtrer par Etat</option>
                                    <option value="" <?= isset($_REQUEST["etatdet"]) ? $_REQUEST["etatdet"] == "" ? "selected" : "" : "" ?>>Tous</option>
                                    <option value="Soldée" <?= isset($_REQUEST["etatdet"]) ? $_REQUEST["etatdet"] == "Soldée" ? "selected" : "" : "" ?>>Soldée</option>
                                    <option value="Non Soldée" <?= isset($_REQUEST["etatdet"]) ? $_REQUEST["etatdet"] == "Non Soldée" ? "selected" : "" : "" ?>>Non Soldée</option>
                                </select>
                                <input type="hidden" name="controller" value="dettes">
                                <input type="hidden" name="verif" value="filter">
                                <button type="submit" name="action" value="liste" class="bg-blue-500 w-1/2 text-white px-4 py-2 rounded hover:bg-blue-600">Appliquer</button>
                            </div>

                        </div>

                    </form>
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr>
                                <th scope="col" class="border-b p-4 text-gray-700">
                                    Date
                                </th>

                                <th scope="col" class="border-b p-4 text-gray-700">
                                    Montant
                                </th>
                                <th scope="col" class="border-b p-4 text-gray-700">
                                    Versé
                                </th>
                                <th scope="col" class="border-b p-4 text-gray-700">
                                    Etat
                                </th>
                                <th scope="col" class="border-b p-4 text-gray-700">
                                    Restant
                                </th>
                                <th scope="col" class="border-b p-4 text-gray-700">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($dettes)): foreach ($dettes as $dette): ?>
                                    <tr
                                        class="odd:bg-white  even:bg-gray-50  border-b ">
                                        <td class="border-b p-4">
                                            <?= $dette->datedet ?>
                                        </td>

                                        <td class="border-b p-4">
                                            <?= intval($dette->montantdet) ?>
                                        </td>
                                        <td class="border-b p-4">
                                            <?= intval($dette->verse) ?>
                                        </td>
                                        <td class="border-b p-4">
                                            <?= $dette->etatdet ?>
                                        </td>
                                        <td class="border-b p-4">
                                            <?= $dette->restant ?>
                                        </td>
                                        <td class="border-b p-4">
                                            <a href="<?= $this->path("dettes", "detail", ["idDette" => $dette->iddet]) ?>"
                                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Detais</a>
                                        </td>
                                    </tr>
                            <?php endforeach;
                            endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- pagination -->
                <div class="w-full flex justify-end items-center mt-3">
                    <nav aria-label="Page navigation example">
                        <ul class="inline-flex -space-x-px text-base h-10">
                            <?php if ($page > 1): ?>
                                <li>
                                    <a href="<?= $this->path("dettes", "liste", ["page" => intval($page) - 1, "tel" => $_REQUEST["tel"] ?? "", "datedet" => $_REQUEST["datedet"] ?? "", "etatdet" => $_REQUEST["etatdet"] ?? "", "verif" => $_REQUEST["verif"] ?? ""]) ?>" class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
                                </li>
                            <?php endif ?>
                            <?php for ($i = 1; $i <= $nbrPage; $i++): ?>
                                <li>
                                    <a href="<?= $this->path("dettes", "liste", ["page" => $i, "tel" => $_REQUEST["tel"] ?? "", "datedet" => $_REQUEST["datedet"] ?? "", "etatdet" => $_REQUEST["etatdet"] ?? "", "verif" => $_REQUEST["verif"] ?? ""]) ?>" aria-current="page" class="flex items-center justify-center px-4 h-10 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-<?= $page == $i ? "700" : "900" ?> dark:text-white"><?= $i ?></a>
                                </li>
                            <?php endfor ?>
                            <?php if ($page < $nbrPage): ?>
                                <li>
                                    <a href="<?= $this->path("dettes", "liste", ["page" => intval($page) + 1, "tel" => $_REQUEST["tel"] ?? "", "datedet" => $_REQUEST["datedet"] ?? "", "etatdet" => $_REQUEST["etatdet"] ?? "", "verif" => $_REQUEST["verif"] ?? ""]) ?>" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>
                                </li>
                            <?php endif ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Partie Depot -->
        <div class=" p-1 rounded-lg shadow-xl hidden" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
        <?php if($this->session->getRole()!="Client"):?>
            <!-- formulaire nouveau depot -->
            <form class="mb-3 mt-5" action="" method="post">
                <div>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
                        <input type="text" name="montantdep" placeholder="Entrer le montant du depot" class="p-2 border rounded" value="<?= $filtre["tel"] ?? "" ?>">
                        <input type="hidden" name="controller" value="depots">
                        <input type="hidden" name="idClient" value="<?= $client->idcl ?? "" ?>">
                        <input type="hidden" name="verif" value="new">
                        <input type="hidden" name="origine" value="ficheClient">
                        <button type="submit" name="action" value="depot" class="text-white w-1/2 px-4 py-2  <?= empty($client) || $client->categorie != "solvable" ? "bg-blue-200" : "bg-blue-500" ?> hover:<?= empty($client) || $client->categorie != "solvable" ? "bg-blue-300" : "bg-blue-600" ?>  rounded text-sm  text-center dark:<?= empty($client) || $client->categorie != "solvable" ? "bg-blue-200" : "bg-blue-500" ?> dark:hover:<?= empty($client) || $client->categorie != "solvable" ? "bg-blue-300" : "bg-blue-600" ?> dark:focus:ring-blue-800" <?= empty($client) || $client->categorie != "solvable" ? "disabled" : "" ?>>Nouv depot</button>
                    </div>
                    <p class="text-sm mt-1 mb-1 text-red-600 dark:text-red-400"> <?= $errors["montantdep"] ?? "" ?> </p>
                    <p class="text-sm mt-1 mb-1 text-green-600 dark:text-green500"> <?= $sucess["montantdep"] ?? "" ?> </p>
                </div>

            </form>
            <?php endif?>
            <!-- formulaire de filtre -->
            <div class="w-full bg-white p-4 rounded shadow-md ">
                <form class="mb-3 mt-3" action="" method="get">
                    <div>
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
                            <input type="date" name="datedep" class="p-2 border rounded" value="<?= $filtre["datedep"] ?? "" ?>">
                            <input type="hidden" name="controller" value="depots">
                            <input type="hidden" name="verif" value="filter">
                            <button type="submit" name="action" value="liste" class="bg-blue-500 w-1/2 text-white px-4 py-2 rounded hover:bg-blue-600">Appliquer</button>
                        </div>

                    </div>

                </form>
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr>
                            <th scope="col" class="border-b p-4 text-gray-700">
                                Date
                            </th>
                            <th scope="col" class="border-b p-4 text-gray-700">
                                Numero
                            </th>
                            <th scope="col" class="border-b p-4 text-gray-700">
                                Montant
                            </th>


                        </tr>
                    </thead>
                    <tbody id="tBody">
                        <?php if (isset($depots)): foreach ($depots as $depot): ?>
                                <tr
                                    class="odd:bg-white  even:bg-gray-50  border-b ">
                                    <td class="border-b p-4">
                                        <?= $depot->datedep ?>
                                    </td>
                                    <td class="border-b p-4">
                                        <?= $depot->numerodep ?>
                                    </td>
                                    <td class="border-b p-4">
                                        <?= $depot->montantdep ?>
                                    </td>


                                </tr>
                        <?php endforeach;
                        endif; ?>

                    </tbody>
                </table>
            </div>
            <!--Partie pagination  -->
            <div class="w-full flex justify-end items-center mt-3">
                <nav aria-label="Page navigation example">
                    <ul class="inline-flex -space-x-px text-base h-10" id="pagination">
                        <?php if ($page > 1): ?>
                            <li>
                                <a href="<?= $this->path("depots", "liste", ["page" => intval($page) - 1, "tel" => $_REQUEST["tel"] ?? "", "datedep" => $_REQUEST["datedep"] ?? "", "verif" => $_REQUEST["verif"] ?? ""]) ?>" class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
                            </li>
                        <?php endif ?>
                        <?php for ($i = 1; $i <= $nbrPage; $i++): ?>
                            <li>
                                <a href="<?= $this->path("depots", "liste", ["page" => $i, "tel" => $_REQUEST["tel"] ?? "", "datedep" => $_REQUEST["datedep"] ?? "", "verif" => $_REQUEST["verif"] ?? ""]) ?>" aria-current="page" class="flex items-center justify-center px-4 h-10 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-<?= $page == $i ? "700" : "900" ?> dark:text-white"><?= $i ?></a>
                            </li>
                        <?php endfor ?>
                        <?php if ($page < $nbrPage): ?>
                            <li>
                                <a href="<?= $this->path("depots", "liste", ["page" => intval($page) + 1, "tel" => $_REQUEST["tel"] ?? "", "datedep" => $_REQUEST["datedep"] ?? "", "verif" => $_REQUEST["verif"] ?? ""]) ?>" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>
                            </li>
                        <?php endif ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

</div>



<script src="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.bundle.js"></script>
<!-- JavaScript to handle modals -->
<script>
    document.getElementById('btnEditMontantSeuil').addEventListener('click', function() {
        document.getElementById('modalEditMontantSeuil').classList.remove('hidden');
    });

    document.getElementById('btnEditCategorie').addEventListener('click', function() {
        document.getElementById('modalEditCategorie').classList.remove('hidden');
    });
    document.getElementById('btnEditCarte').addEventListener('click', function() {
        document.getElementById('modalCarte').classList.remove('hidden');
    });

    document.getElementById('closeModalEditMontantSeuil').addEventListener('click', function() {
        document.getElementById('modalEditMontantSeuil').classList.add('hidden');
    });

    document.getElementById('closeModalEditCategorie').addEventListener('click', function() {
        document.getElementById('modalEditCategorie').classList.add('hidden');
    });
    document.getElementById('closeModalCarte').addEventListener('click', function() {
        document.getElementById('modalCarte').classList.add('hidden');
    });

    function genrateQrCode(qrValue) {
        qrImg = document.querySelector(".qr-code img");
        qrImg.src = `https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=${qrValue}`;

    }
</script>