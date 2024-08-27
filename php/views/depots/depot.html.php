<div class="p-2 border-1 border-gray-200  rounded-lg dark:border-gray-700 ">
    <h1 class="text-gray-900 text-2xl text-bold ">Faire un depot</h1>
    <div class="shadow-xl p-2 ">
        <!-- Partie recherche client -->
        <form class="mb-3 mt-3" action="" method="post">
            <div>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
                    <input type="text" name="tel" placeholder="Chercher un client" class="p-2 border rounded" value="<?= $filtre["tel"] ?? "" ?>">
                    
                    <input type="hidden" name="controller" value="depots">
                    <input type="hidden" name="verif" value="findbytel">
                    <button type="submit" name="action" value="depot" class="bg-blue-500 w-1/2 text-white px-4 py-2 rounded hover:bg-blue-600">Rechercher</button>
                </div>
                <p class="text-sm text-red-600 dark:text-red-400"> <?= $errors["telsearch"] ?? "" ?> </p>
            </div>

        </form>
        <!-- <form class="max-w-md " method="post">
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <span class="material-symbols-outlined dark:text-white"> search </span>
                </div>
                <input type="search" id="default-search" name="telsearch" value="<?= $depot->tel ?? "" ?>" class="block w-full p-2.5 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Entrer le telephone du depot " />
                <input type="hidden" name="controller" value="depots">
                <input type="hidden" name="verif" value="findbytel">
                <button type="submit" name="action" value="depots" class="text-white absolute end-0 bottom-0.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Rechercher</button>
            </div>
            <p class="text-sm text-red-600 dark:text-red-400"> <?= $errors["telsearch"] ?? "" ?> </p>

        </form> -->

        <!-- Partie info depot -->

        <h4>Info du depot</h4>
        <div class="flex justify-around mt-2 w-full	">
            <div class="mb-5 w-1/5 ">
                <label for="prenom" class="block mb-1 text-xs font-medium text-dark-900 dark:text-blue">
                    Prenom</label>
                <input type="text" id="prenom" value="<?= $depot->prenomc ?? "" ?>" class="bg-gray-50  w-full border border-gray-300 text-gray-900 read-only:bg-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder=" " readonly />
            </div>
            <div class="mb-5 w-1/5">
                <label for="nom" class="block mb-1 text-xs font-medium text-gray-900 dark:text-blue">
                    Nom</label>
                <input type="text" id="nom" value="<?= $depot->nomc ?? "" ?>" class="bg-gray-50 border border-gray-300 text-gray-900 read-only:bg-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder=" " readonly />
            </div>
            <div class="mb-5 w-1/5">
                <label for="tel" class="block mb-1 text-xs font-medium text-gray-900 dark:text-blue">Telephone</label>
                <input type="nom" id="tel" value="<?= $depot->tel ?? "" ?>" class="bg-gray-50 border border-gray-300 text-gray-900 read-only:bg-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder=" " readonly />
            </div>
            <div class="mb-5 w-1/5">
                <label for="tel" class="block mb-1 text-xs font-medium text-gray-900 dark:text-blue">Solde</label>
                <input type="nom" id="tel" value="<?= $depot->solde ?? "" ?>" class="bg-gray-50 border border-gray-300 text-gray-900 read-only:bg-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder=" " readonly />
            </div>
        </div>

        <h4>Faire un depot</h4>
        <form class="mb-3 mt-3" action="" method="post">
            <div>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
                    <input type="text" name="tel" placeholder="Entrer le montant du depot" class="p-2 border rounded" value="<?= $filtre["tel"] ?? "" ?>">
                    
                    <input type="hidden" name="controller" value="depots">
                    <input type="hidden" name="idcl" value="<?= $client["idcl"]??""?>">
                    <input type="hidden" name="verif" value="new">
                    <button type="submit" name="action" value="depot" class="bg-blue-500 w-1/2 text-white px-4 py-2 rounded hover:bg-blue-600">Nouv depot</button>
                </div>

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
                    <input type="date" name="datedep"  class="p-2 border rounded" value="<?= $filtre["datedep"] ?? "" ?>">
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
                                <?= $depot->client ?>
                            </td>
                            <td class="border-b p-4">
                                <?= $depot->telephone ?>
                            </td>

                        </tr>
                <?php endforeach;
                endif; ?>
                <tr
                    class="odd:bg-white  even:bg-gray-50  border-b ">
                    <td class="border-b p-4">
                        qqqq
                    </td>
                    <td class="border-b p-4">
                        qqqq
                    </td>
                    <td class="border-b p-4">
                        qqqq
                    </td>
                    <td class="border-b p-4">
                        qqqq
                    </td>
                    <td class="border-b p-4">
                        qqqq
                    </td>

                </tr>
            </tbody>
        </table>
    </div>
    <!--Partie pagination  -->
    <div class="w-full flex justify-end items-center mt-3">
        <nav aria-label="Page navigation example">
            <ul class="inline-flex -space-x-px text-base h-10" id="pagination">
                <?php $page = 1;
                $nbrPage = 3;
                if ($page > 1): ?>
                    <li>
                        <a href="<?= $this->path("depots", "liste", ["page" => intval($page) - 1, "tel" => $_REQUEST["tel"] ?? "", "categorie" => $_REQUEST["categorie"] ?? "", "verif" => $_REQUEST["verif"] ?? ""]) ?>" class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
                    </li>
                <?php endif ?>
                <?php for ($i = 1; $i <= $nbrPage; $i++): ?>
                    <li>
                        <a href="<?= $this->path("depots", "liste", ["page" => $i, "tel" => $_REQUEST["tel"] ?? "", "categorie" => $_REQUEST["categorie"] ?? "", "verif" => $_REQUEST["verif"] ?? ""]) ?>" aria-current="page" class="flex items-center justify-center px-4 h-10 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-<?= $page == $i ? "700" : "900" ?> dark:text-white"><?= $i ?></a>
                    </li>
                <?php endfor ?>
                <?php if ($page < $nbrPage): ?>
                    <li>
                        <a href="<?= $this->path("depots", "liste", ["page" => intval($page) + 1, "tel" => $_REQUEST["tel"] ?? "", "categorie" => $_REQUEST["categorie"] ?? "", "verif" => $_REQUEST["verif"] ?? ""]) ?>" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>
                    </li>
                <?php endif ?>
            </ul>
        </nav>
    </div>