<?php
$page=1;
$nbrPage=1;
$errors = [];
if ($this->session->isset("errors")) {
    $errors = $this->session->get("errors");
    $this->session->unset("errors");
}
?>

<div class="p-4 border-1 border-gray-200  rounded-lg dark:border-gray-700 ">
    <div class="w-11/12 ">
        <h1 class="text-gray-900 text-2xl text-bold ">Tous les clients</h1>
    </div>
    <div class=" w-11/12 mb-3 mt-3 text-center flex justify-end ">
        <a href="<?= $this->path("clients", "add") ?>">
            <button
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                type="button">
                Ajouter </button></a>
    </div>




        <!-- formulaire de filtre -->
    <div class="w-full bg-white p-4 rounded shadow-md ">
        <form class="mb-3 mt-3" action="" method="get">
            <div>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
                    <input type="text" name="tel" placeholder="Filtrer par Téléphone" class="p-2 border rounded" value="<?= $filtre["tel"] ?? "" ?>">
                    <select name="etatdet" class="p-2 border rounded">
                        <option value="">Filtrer par Categorie</option>
                        <option value="" <?=isset($_REQUEST["categorie"])?$_REQUEST["categorie"]==""?"selected":"":""?>>Tous</option>
                        <option value="solvable" <?=isset($_REQUEST["categorie"])?$_REQUEST["categorie"]=="Solvable"?"selected":"":""?>>Solvable</option>
                        <option value="non solvable" <?=isset($_REQUEST["categorie"])?$_REQUEST["categorie"]=="Non Solvable"?"selected":"":""?>>Non Solvable</option>
                        <option value="nouveau" <?=isset($_REQUEST["categorie"])?$_REQUEST["categorie"]=="nouveau"?"selected":"":""?>> Nouveau</option>
                    </select>
                    <input type="hidden" name="controller" value="clients">
                    <input type="hidden" name="verif" value="filter">
                    <button type="submit" name="action" value="liste" class="bg-blue-500 w-1/2 text-white px-4 py-2 rounded hover:bg-blue-600">Appliquer</button>
                </div>

            </div>

        </form>
        <table class="w-full text-left border-collapse">
            <thead>
                <tr>
                    <th scope="col" class="border-b p-4 text-gray-700">
                        Nom
                    </th>
                    <th scope="col" class="border-b p-4 text-gray-700">
                        Prenom
                    </th>
                    <th scope="col" class="border-b p-4 text-gray-700">
                        Telephone
                    </th>
                    <th scope="col" class="border-b p-4 text-gray-700">
                        Email
                    </th>
                    <th scope="col" class="border-b p-4 text-gray-700">
                        Adresse
                    </th>
                    <th scope="col" class="border-b p-4 text-gray-700">
                        Categorie
                    </th>
                    <th scope="col" class="border-b p-4 text-gray-700">
                        Solde
                    </th>
                    <th scope="col" class="border-b p-4 text-gray-700">
                        Montant Seuil
                    </th>
                    <th scope="col" class="border-b p-4 text-gray-700">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody id="tBody">
                <?php if (isset($clients)): foreach ($clients as $client): ?>
                        <tr
                            class="odd:bg-white  even:bg-gray-50  border-b ">
                            <td class="border-b p-4">
                                <?= $client->nomc?>
                            </td>
                            <td class="border-b p-4">
                                <?= $client->prenomc ?>
                            </td>
                            <td class="border-b p-4">
                                <?= $client->tel ?>
                            </td>
                            <td class="border-b p-4">
                                <?= $client->email ?>
                            </td>
                            <td class="border-b p-4">
                                <?= $client->adresse ?>
                            </td>
                            <td class="border-b p-4">
                                <?= $client->categorie ?>
                            </td>
                            <td class="border-b p-4">
                                <?= $client->solde ?>
                            </td>
                            <td class="border-b p-4">
                                <?= $client->montantseuil ?>
                            </td>
                            <td class="border-b p-4">
                                <a href="<?= $this->path("clients", "fiche", ["idcl" => $client->idcl]) ?>"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline"><span class="material-symbols-outlined"> read_more </span></a>
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
                <ul class="inline-flex -space-x-px text-base h-10" id="pagination">
                <?php if ($page>1): ?>
                    <li>
                        <a href="<?=$this->path("clients","liste",["page"=>intval($page)-1,"tel"=>$_REQUEST["tel"]??"","categorie"=>$_REQUEST["categorie"]??"","verif"=>$_REQUEST["verif"]??""])?>" class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
                    </li>
                    <?php endif ?>
                    <?php for ($i=1; $i <=$nbrPage ; $i++): ?>
                    <li>
                        <a href="<?=$this->path("clients","liste",["page"=>$i,"tel"=>$_REQUEST["tel"]??"","categorie"=>$_REQUEST["categorie"]??"","verif"=>$_REQUEST["verif"]??""])?>" aria-current="page" class="flex items-center justify-center px-4 h-10 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-<?=$page==$i?"700":"900"?> dark:text-white"><?=$i?></a>
                    </li>
                    <?php endfor ?>
                    <?php if ($page<$nbrPage): ?>
                    <li>
                        <a href="<?=$this->path("clients","liste",["page"=>intval($page)+1,"tel"=>$_REQUEST["tel"]??"","categorie"=>$_REQUEST["categorie"]??"","verif"=>$_REQUEST["verif"]??""])?>" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>
                    </li>
                    <?php endif ?>
                </ul>
            </nav>
        </div>
</div>
<script src="js/src/client.js" type="module"></script>