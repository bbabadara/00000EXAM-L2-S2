<?php
$errors = [];
$client = [];
$article=[];
$tabArticle=[];
if ($this->session->isset("errors")) {
    $errors = $this->session->get("errors");
    $this->session->unset("errors");
}
if ($this->session->isset("client")) {
    $client = $this->session->get("client");
}
if ($this->session->isset("article")) {
    $article = $this->session->get("article");
}
if ($this->session->isset("tabArticle")) {
    $tabArticle = $this->session->get("tabArticle");
}
?>
<div class="p-4 border-1 border-gray-200  rounded-lg dark:border-gray-700 ">
    <h1 class="text-gray-900 text-2xl text-bold ">Enregistrer une dettes</h1>
    <!-- Partie recherche client -->
    <form class="max-w-md mt-3" method="post">
        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">search</label>
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <span class="material-symbols-outlined dark:text-white"> search </span>
            </div>
            <input type="search" id="default-search" name="telsearch" value="<?= $client->tel ?? "" ?>" class="block w-full p-2.5 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Entrer le telephone du client " />
            <input type="hidden" name="controller" value="dettes">
            <input type="hidden" name="verif" value="findbytel">
            <button type="submit" name="action" value="add" class="text-white absolute end-0 bottom-0.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Rechercher</button>
        </div>
        <p class="text-sm text-red-600 dark:text-red-400"> <?= $errors["telsearch"] ?? "" ?> </p>

    </form>
    <div class="flex justify-around shadow-xl p-2 mt-5">
        <!-- Partie info client -->
        <div class=" w-1/3 shadow-inner p-1 ">
            <h4>Info du client</h4>
            <div class="mb-5 ">
                <label for="prenom" class="block mb-1 text-xs font-medium text-dark-900 dark:text-blue">
                    Prenom</label>
                <input type="text" id="prenom" value="<?= $client->prenomc ?? "" ?>" class="bg-gray-50 border border-gray-300 text-gray-900 read-only:bg-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder=" " readonly />
            </div>
            <div class="mb-5 ">
                <label for="nom" class="block mb-1 text-xs font-medium text-gray-900 dark:text-blue">
                    Nom</label>
                <input type="text" id="nom" value="<?= $client->nomc ?? "" ?>" class="bg-gray-50 border border-gray-300 text-gray-900 read-only:bg-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder=" " readonly />
            </div>
            <div class="mb-5 ">
                <label for="tel" class="block mb-1 text-xs font-medium text-gray-900 dark:text-blue">Telephone</label>
                <input type="nom" id="tel" value="<?= $client->tel ?? "" ?>" class="bg-gray-50 border border-gray-300 text-gray-900 read-only:bg-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder=" " readonly />
            </div>
        </div>

        <!-- Partie ajout article  -->
         <div class="w-3/5 shadow-inner p-1">
         <h4>Choix articles</h4>

        <div class=" w-full    flex items-center justify-between">
            <!-- Partie recherche article -->
            <div class=" w-1/2">
                <div class="w-10/12 mt-2">
                    <form class="max-w-sm mx-auto row" action="" method="post">
                        <div class=" flex items-center justify-between">
                            <div class="mb-3 flex items-center ">
                                <label for="art" class="block w-18  text-sm font-medium text-gray-900 dark:text-black">Reference: </label>
                                <input type="text" name="ref" id="art" value="<?= $article->refart ?? ""?>" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Article 1">
                            </div>
                            <input type="hidden" name="controller" value="dettes">
                            <input type="hidden" name="verif" value="findart">
                            <button type="submit" class="text-white  mb-4 <?=empty($client)?"bg-blue-400":"bg-blue-700"?> hover:<?=empty($client)?"bg-blue-500":"bg-blue-800"?> focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 mx-1 py-2 text-center dark:<?=empty($client)?"bg-blue-300":"bg-blue-600"?> dark:hover:<?=empty($client)?"bg-blue-500":"bg-blue-700"?> dark:focus:ring-blue-800" <?=empty($client)?"disabled":""?> >OK</button>
                        </div>
                        <p class="text-sm text-red-600 dark:text-red-400"> <?= $errors["ref"] ?? ""?> </p>
                    </form>

                </div>

                 <!-- Partie definir quantite -->
                <div class="w-10/12 mt-5">
                    <form class="max-w-sm mx-auto row" action="" method="post">
                        <div class=" flex items-center justify-between">
                            <div class="mb-3 flex items-center ">
                                <label for="qte" class="block w-18  text-sm font-medium text-gray-900 dark:text-black">Quantite: </label>
                                <input type="text" name="qte" id="qte" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full mx-1 px-5 py-2  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="">
                            </div>
                            <input type="hidden" name="controller" value="dettes">
                            <input type="hidden" name="verif" value="sltqte">
                            <button type="submit" class="text-white  mb-4 <?=empty($article)?"bg-blue-400":"bg-blue-700"?> hover:<?=empty($article)?"bg-blue-500":"bg-blue-800"?> focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 mx-1 py-2 text-center dark:<?=empty($article)?"bg-blue-300":"bg-blue-600"?> dark:hover:<?=empty($article)?"bg-blue-500":"bg-blue-700"?> dark:focus:ring-blue-800" <?=empty($article)?"disabled":""?> >OK</button>
                        </div>
                        <p class="text-sm text-red-600 dark:text-red-400"> <?= $errors["qte"] ?? ""?> </p>
                    </form>

                </div>
            </div>
            <!-- Partie info article -->
            <div class="infoArt w-1/2">
                <div class="mb-2 mt-2 flex items-center ">
                    <label for="lib" class="block w-28  text-sm font-medium text-gray-900 dark:text-black">Reference: </label>
                    <input type="text" value="<?= $article->refart ?? ""?>"  id="lib" aria-describedby="helper-text-explanation" class="bg-gray-50 border  read-only:bg-gray-300 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" readonly>
                </div>
                <div class="mb-2 mt-2 flex items-center ">
                    <label for="lib" class="block w-28  text-sm font-medium text-gray-900 dark:text-black">Libelle: </label>
                    <input type="text" value="<?= $article->libart ?? ""?>"   id="lib" aria-describedby="helper-text-explanation" class="bg-gray-50 border  read-only:bg-gray-300 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" readonly>
                </div>
                <div class="mb-2 mt-2 flex items-center ">
                    <label for="prix" class="block w-28  text-sm font-medium text-gray-900 dark:text-black">Prix U.: </label>
                    <input type="text" value="<?= $article->prixu ?? ""?>"   id="prix" aria-describedby="helper-text-explanation" class="bg-gray-50 read-only:bg-gray-300 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" readonly>
                </div>
                <div class="mb-2 mt-2 flex items-center ">
                    <label for="qtestock" class="block w-28  text-sm font-medium text-gray-900 dark:text-black"> Stock: </label>
                    <input type="text" value="<?= $article->qteStock ?? ""?>"   id="qtestock" aria-describedby="helper-text-explanation" class="bg-gray-50 border read-only:bg-gray-300  border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-black dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" readonly>
                </div>
            </div>

        </div>
        </div>
    </div>

    <!-- Partie tableau d'article -->
    <div class="w-full mt-3 flex justify-center items-center">
        <table class="w-1/2 text-sm text-center text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Reference
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Libelle
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Prix U.
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Quantite
                    </th>
                    <th scope="col" class="px-6 py-3">
                        S. Total
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php $som=0; foreach ($tabArticle as $key=> $article): $som+=$article["total"];?>
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">

                    <td class="px-6 py-2">
                    <?= $article["refart"]?>
                    </td>
                    <td class="px-6 py-2">
                    <?= $article["libart"]?>
                    </td>
                    <td class="px-6 py-2">
                    <?= $article["prixu"]?>
                    </td>
                    <td class="px-6 py-2">
                    <?= $article["qte"]?>
                    </td>
                    <td class="px-6 py-2">
                    <?= $article["total"]?>
                    </td>
                    <td class="px-6 py-2">
                        <a href="<?=$this->path("dettes","add",["verif"=>"remove","key"=>$key])?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                            <span class="material-symbols-outlined" data-popover-target="popover-image<?= $article["idart"]?>"> delete </span>
                            <div data-popover id="popover-image<?= $article["idart"]?>" role="tooltip" class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-24 dark:text-gray-400 dark:bg-gray-800 dark:border-gray-600">
                                <p>Enlever</p>
                            </div>
                        </a>
                    </td>
                </tr>
                <?php endforeach ?>


                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <td class="px-6 py-2 text-xl text-gray-900 dark:text-white" colspan="6">Total: <?= $som?></td>
                </tr>

            </tbody>
        </table>
    </div>

    <div class="w-full flex justify-center mt-3">
        <form action="" method="post">
            <input type="hidden" name="verif" value="saveDette">
            <input type="hidden" name="controller" value="dettes">
            <input type="hidden" name="montant" value="<?= $som?>">
            <button type="submit" name="action" value="add"  class="text-white <?=empty($tabArticle)?"bg-blue-400":"bg-blue-700"?>  hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded text-sm px-5 py-2.5 text-center me-2 mb-2 dark:<?=empty($tabArticle)?"bg-blue-300":"bg-blue-600"?>  dark:hover:<?=empty($tabArticle)?"bg-blue-400":"bg-blue-700"?> dark:focus:ring-blue-800" <?=empty($tabArticle)?"disabled":""?> >Enregister</button>
        </form>
    </div>

</div>