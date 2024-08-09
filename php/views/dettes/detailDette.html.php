<?php
$errors=[];
if ($this->session->isset("errors")) {
    $errors=$this->session->get("errors");
    $this->session->unset("errors");
}
?>
<div class="p-4 border-1 border-gray-200  rounded-lg dark:border-gray-700 ">
            <h1 class="text-gray-900 text-2xl font-bold ">Details</h1>
            <div class="grid grid-cols-2 gap-4 mt-2 mb-4">
                <!-- partie info dette -->
                   <div class="relative overflow-x-auto w-full shadow-xl sm:rounded-lg">
                        <div class="p-2">
                            <div class="grid grid-cols-2 mt-5 gap-4 leading-loose ">
                                <div>
                                    <p><span class="font-semibold">Date :</span> <?=$dette->datedet ?></p>
                                    <p><span class="font-semibold">Numero :</span> <?=$dette->numerodet ?></p>
                                    <p><span class="font-semibold">Montant :</span> <?=$dette->montantdet ?> fcfa</p>
                                    <p><span class="font-semibold">Versé :</span> <?=$dette->verse ?> fcfa</p>
                                    <p><span class="font-semibold">Restant :</span> <?=$dette->restant?> fcfa</p>
                                </div>
                                <div>
                                    <p><span class="font-semibold">Client :</span>  <?=$dette->prenomc." ".$dette->nomc ?></p>
                                    <p><span class="font-semibold">Téléphone :</span> <?=$dette->tel ?> </p>
                                    <p><span class="font-semibold">Email :</span> <?=$dette->email ?> </p>
                                    <p><span class="font-semibold">Adresse :</span> <?=$dette->adresse ?> </p>
                                    <p><span class="font-semibold">Catégorie :</span> <?=$dette->categorie ?> </p>
                                </div>
                            </div>
                        </div>
    
                </div>
                <!-- Partie tableau -->
                <div class="flex items-center justify-center rounded    ">
                    <div class="relative overflow-x-auto w-full shadow-md sm:rounded-lg">
                       <h2 class="text-xl mb-2">Liste des articles</h2>
                    <table class="w-full text-sm text-center text-left rtl:text-right text-gray-500 dark:text-gray-400">
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
                                
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($articles as $article): ?>
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                              
                                <td class="px-6 py-2">
                                <?=$article->refart ?>
                                </td>
                                <td class="px-6 py-2">
                                <?=$article->libart ?>
                                </td>
                                <td class="px-6 py-2">
                                <?=$article->prixAchat ?>
                                </td>
                                <td class="px-6 py-2">
                                <?=$article->qte ?>
                                </td>
                                <td class="px-6 py-2">
                                <?=$article->sousTotal ?>
                                </td>
                              
                            </tr>
                            <?php endforeach ?>
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td class="px-6 py-2 text-xl text-gray-900 dark:text-white"  colspan="5" >Total: <?=$article->prixTotal ?></td>
                        </tr>
                         </tbody>
                    </table>
                   </div>
    
                </div>
             </div>

             <!-- Partie paiement -->
             <h1 class="text-gray-900 text-2xl text-bold ">Liste des paiement(<?=count($paiements)?>)</h1>
             <div class="w-10/12 mt-2">
                <form class=" "  method="post">
                    <div class=" w-full flex items-center ">
                        <input type="text"  id="art" aria-label="art" name="montantpay"  aria-describedby="helper-text-explanation" class="bg-gray-50  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-1/3 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
                       <input type="hidden" name="controller" value="dettes">
                       <input type="hidden" name="idDette" value="<?=$dette->iddet?>">
                       <input type="hidden" name="verif" value="addpay">
                       <input type="hidden" name="restant" value="<?=$dette->restant?> ">
                        <button type="submit" name="action" value="detail" class="text-white  ml-1  bg-blue-700 hover:bg-blue-800  font-medium rounded-lg text-sm  sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 " <?=$disable?> >Enregistrer paiement</button>
                    </div>
                       <p class="mt-2 text-sm text-red-600 dark:text-red-400"> <?=$errors["montantpay"]??""?></p>

                </form>

                <div class="relative mt-3 overflow-x-auto w-full shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-center text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Date
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Numero
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Montant
                                </th>
                                
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($paiements as $paiement): ?>

                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                              
                                <td class="px-6 py-2">
                                <?=$paiement->datepay ?>
                                </td>
                                <td class="px-6 py-2">
                                <?=$paiement->numeropay ?>
                                </td>
                                <td class="px-6 py-2">
                                <?=$paiement->montantpay ?>
                                </td>
                              
                            </tr>
                            <?php endforeach?>

                                                
                        </tbody>
                    </table>
                   </div>


            </div>


        </div>