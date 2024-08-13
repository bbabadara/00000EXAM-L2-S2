<div class="flex-1 p-6">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Carte des statistiques -->
        <div class="bg-white p-4 rounded shadow-md">
            <h2 class="text-gray-700 text-lg font-bold mb-2">Total Paiement Restant</h2>
            <p class="text-2xl font-bold"> <?= $totalRestant??"" ?>Fcfa</p>
        </div>

        <div class="bg-white p-4 rounded shadow-md">
            <h2 class="text-gray-700 text-lg font-bold mb-2">Nombre de Clients</h2>
            <p class="text-2xl font-bold"><?= $nbrClient??"" ?></p>
        </div>

        <div class="bg-white p-4 rounded shadow-md">
            <h2 class="text-gray-700 text-lg font-bold mb-2"> Dettes Aujourd'hui</h2>
            <p class="text-2xl font-bold"><?= $nbrDette??"0" ?></p>
        </div>

        <div class="bg-white p-4 rounded shadow-md">
            <h2 class="text-gray-700 text-lg font-bold mb-2"> Paiements Aujourd'hui</h2>
            <p class="text-2xl font-bold"><?=$nbrPaiement??"0"?> </p>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 mt-5">
        <!-- Carte des statistiques -->
        <div class="bg-white p-4 rounded shadow-md">
            <h2 class="text-gray-700 text-lg font-bold mb-2">Liste des dettes d'Aujourd'hui</h2>
            <p class="text-2xl font-bold"> soon</p>
        </div>

        <div class="bg-white p-4 rounded shadow-md">
            <h2 class="text-gray-700 text-lg font-bold mb-2">Liste des paiement d'Aujourd'hui</h2>
            <p class="text-2xl font-bold">soon</p>
        </div>

      
    </div>

    <!-- Table des clients et filtres -->
    <div class="mt-6 bg-white p-4 rounded shadow-md">
        <h2 class="text-gray-700 text-lg font-bold mb-4">Liste des Clients</h2>

        <!-- filtres -->
        <form class="mb-3 mt-3" action="" method="get">
            <div>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
                    <input type="text" name="nomc" placeholder="Filtrer par Nom" class="p-2 border rounded" value="<?= $filtre["nomc"]??""?>">
                    <input type="text" name="tel" placeholder="Filtrer par Téléphone" class="p-2 border rounded" value="<?= $filtre["tel"]??""?>">
                    <select name="categorie" class="p-2 border rounded">
                        <option value="">Filtrer par Catégorie</option>
                        <option value="" <?=isset($_REQUEST["categorie"])?$_REQUEST["categorie"]==""?"selected":"":""?>>Tous</option>
                        <option value="solvable" <?=isset($_REQUEST["categorie"])?$_REQUEST["categorie"]=="solvable"?"selected":"":""?>>Solvable</option>
                        <option value="non solvable" <?=isset($_REQUEST["categorie"])?$_REQUEST["categorie"]=="non solvable"?"selected":"":""?>>Non Solvable</option>
                        <option value="fidele" <?=isset($_REQUEST["categorie"])?$_REQUEST["categorie"]=="fidele"?"selected":"":""?>>Fidèle</option>
                        <option value="nouveau" <?=isset($_REQUEST["categorie"])?$_REQUEST["categorie"]=="nouveau"?"selected":"":""?>>Nouveau</option>
                    </select>
                    <input type="hidden" name="controller" value="user">
                    <button type="submit" name="verif" value="filter" class="bg-blue-500 w-1/2 text-white px-4 py-2 rounded hover:bg-blue-600">Appliquer</button>
                </div>

            </div>

        </form>

        <!-- Tableau  clients -->
        <table class="w-full text-left border-collapse">
            <thead>
                <tr>
                    <th class="border-b p-4 text-gray-700">Prenom</th>
                    <th class="border-b p-4 text-gray-700">Nom</th>
                    <th class="border-b p-4 text-gray-700">Téléphone</th>
                    <th class="border-b p-4 text-gray-700">Email</th>
                    <th class="border-b p-4 text-gray-700">Adresse</th>
                    <th class="border-b p-4 text-gray-700">Catégorie</th>
                    <th class="border-b p-4 text-gray-700">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($clients)): foreach ($clients as $client): ?>
                        <tr>
                            <td class="border-b p-4"><?= $client->prenomc ?></td>
                            <td class="border-b p-4"><?= $client->nomc ?></td>
                            <td class="border-b p-4"><?= $client->tel ?></td>
                            <td class="border-b p-4"><?= $client->email ?></td>
                            <td class="border-b p-4"><?= $client->adresse ?></td>
                            <td class="border-b p-4"><?= $client->categorie ?></td>
                            <td class="border-b p-4"><a href="<?=$this->path("client","fiche",["idcl"=>$client->idcl])?>"><span class="material-symbols-outlined"> read_more </span></a></td>

                        </tr>
                <?php endforeach;
                endif; ?>
            </tbody>
        </table>
        <div class="w-full flex justify-end items-center mt-3">
            <nav aria-label="Page navigation example">
                <ul class="inline-flex -space-x-px text-base h-10">
                <?php if ($page>1): ?>
                    <li>
                        <a href="<?=$this->path("user","dashboard",["page"=>intval($page)-1])?>" class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
                    </li>
                    <?php endif ?>
                    <?php for ($i=1; $i <=$nbrPage ; $i++): ?>
                    <li>
                        <a href="<?=$this->path("user","dashboard",["page"=>$i])?>" aria-current="page" class="flex items-center justify-center px-4 h-10 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-<?=$page==$i?"700":"900"?> dark:text-white"><?=$i?></a>
                    </li>
                    <?php endfor ?>
                    <?php if ($page<$nbrPage): ?>
                    <li>
                        <a href="<?=$this->path("user","dashboard",["page"=>intval($page)+1])?>" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>
                    </li>
                    <?php endif ?>
                </ul>
            </nav>
        </div>
    </div>

</div>