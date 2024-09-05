<?php
$errors = [];
$client = [];
$success = [];
if ($this->session->isset("errors")) {
    $errors = $this->session->get("errors");
    $this->session->unset("errors");
}
if ($this->session->isset("clientDepot")) {
    $client = $this->session->get("clientDepot");
}

if ($this->session->isset("success")) {
    $success = $this->session->get("success");
    $this->session->unset("success");
}
?>
<div class="p-2 border-1 border-gray-200  rounded-lg dark:border-gray-700 ">
    <h1 class="text-gray-900 text-2xl text-bold ">Faire un depot</h1>
    <div class="shadow-xl p-2 ">
        <!-- Partie recherche client -->
        <form class="mb-3 mt-3" action="" method="post">
            <div>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
                    <input type="text" name="telsearch" placeholder="Chercher un client" class="p-2 border rounded" value="<?= $client->tel ?? "" ?>">

                    <input type="hidden" name="controller" value="depots">
                    <input type="hidden" name="verif" value="findbytel">
                    <button type="submit" name="action" value="depot" class="bg-blue-500 w-1/2 text-white px-4 py-2 rounded hover:bg-blue-600">Rechercher</button>
                </div>
                <p class="text-sm text-red-600 dark:text-red-400"> <?= $errors["telsearch"] ?? "" ?> </p>

            </div>

        </form>


        <!-- Partie info depot -->

        <h4>Info du client</h4>
        <div class="flex justify-around mt-2 w-full	">
            <div class=" w-1/6 ">
                <label for="prenom" class="block mb-1 text-xs font-medium text-dark-900 dark:text-blue">
                    Prenom</label>
                <input type="text" id="prenom" value="<?= $client->prenomc ?? "" ?>" class="bg-gray-50  w-full border border-gray-300 text-gray-900 read-only:bg-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder=" " readonly />
            </div>
            <div class=" w-1/6">
                <label for="nom" class="block mb-1 text-xs font-medium text-gray-900 dark:text-blue">
                    Nom</label>
                <input type="text" id="nom" value="<?= $client->nomc ?? "" ?>" class="bg-gray-50 border border-gray-300 text-gray-900 read-only:bg-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder=" " readonly />
            </div>
            <div class=" w-1/6">
                <label for="tel" class="block mb-1 text-xs font-medium text-gray-900 dark:text-blue">Telephone</label>
                <input type="nom" id="tel" value="<?= $client->tel ?? "" ?>" class="bg-gray-50 border border-gray-300 text-gray-900 read-only:bg-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder=" " readonly />
            </div>
            <div class="m w-1/6">
                <label for="tel" class="block mb-1 text-xs font-medium text-gray-900 dark:text-blue">Categorie</label>
                <input type="nom" id="tel" value="<?= $client->categorie ?? "" ?>" class="bg-gray-50 border border-gray-300 text-gray-900 read-only:bg-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder=" " readonly />
            </div>
            <div class=" w-1/6">
                <label for="tel" class="block mb-1 text-xs font-medium text-gray-900 dark:text-blue">Solde</label>
                <input type="nom" id="tel" value="<?= $client->solde ?? "" ?>" class="bg-gray-50 border border-gray-300 text-gray-900 read-only:bg-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder=" " readonly />
            </div>

        </div>
        <p class="text-sm mt-1 mb-1 text-red-600 dark:text-red-400"> <?= $errors["categorie"] ?? "" ?> </p>


        <!-- formulaire nouveau depot -->
        <form class="mb-3 mt-5" action="" method="post">
            <div>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
                    <input type="text" name="montantdep" placeholder="Entrer le montant du depot" class="p-2 border rounded" value="<?= $filtre["tel"] ?? "" ?>">
                    <input type="hidden" name="controller" value="depots">
                    <input type="hidden" name="idClient" value="<?= $client->idcl ?? "" ?>">
                    <input type="hidden" name="verif" value="new">
                    <!-- <button type="submit" name="action" value="depot" class="bg-blue-500 w-1/2 text-white px-4 py-2 rounded hover:bg-blue-600">Nouv depot</button> -->
                    <button type="submit" name="action" value="depot" class="text-white w-1/2 px-4 py-2  <?= empty($client) || $client->categorie != "solvable" ? "bg-blue-200" : "bg-blue-500" ?> hover:<?= empty($client) || $client->categorie != "solvable" ? "bg-blue-300" : "bg-blue-600" ?>  rounded text-sm  text-center dark:<?= empty($client) || $client->categorie != "solvable" ? "bg-blue-200" : "bg-blue-500" ?> dark:hover:<?= empty($client) || $client->categorie != "solvable" ? "bg-blue-300" : "bg-blue-600" ?> dark:focus:ring-blue-800" <?= empty($client) || $client->categorie != "solvable" ? "disabled" : "" ?>>Nouv depot</button>
                </div>
                <p class="text-sm mt-1 mb-1 text-red-600 dark:text-red-400"> <?= $errors["montantdep"] ?? "" ?> </p>
                <p class="text-sm mt-1 mb-1 text-green-600 dark:text-green500"> <?= $sucess["montantdep"] ?? "" ?> </p>


            </div>

        </form>

    </div>
</div>


<!-- formulaire de filtre -->
<div class="w-full bg-white p-4 rounded shadow-md ">
    <form class="mb-3 mt-3" action="" method="get">
        <div>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
                <input type="text" name="tel" placeholder="Filtrer par Téléphone" class="p-2 border rounded" value="<?= $filtre["tel"] ?? "" ?>">
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
                <th scope="col" class="border-b p-4 text-gray-700">
                    Client
                </th>
                <th scope="col" class="border-b p-4 text-gray-700">
                    Telephone
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
                        <td class="border-b p-4">
                            <?= $depot->prenomc . " " . $depot->nomc ?>
                        </td>
                        <td class="border-b p-4">
                            <?= $depot->tel ?>
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