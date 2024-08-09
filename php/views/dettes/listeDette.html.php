<?php
$errors=[];
if ($this->session->isset("errors")) {
    $errors=$this->session->get("errors");
    $this->session->unset("errors");
}
?>

<div class="p-4 border-1 border-gray-200  rounded-lg dark:border-gray-700 ">
            <div class="w-11/12 ">
                <h1 class="text-gray-900 text-2xl text-bold ">Tous les dettes</h1>
            </div>
            <div class=" w-11/12 mb-3 mt-3 text-center flex justify-end ">
                <a href="<?=$this->path("dettes","add")?>">
                <button
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                    type="button">
                    Ajouter </button></a>
            </div>

                <div class="w-11/12 flex justify-between px-8 items-center">
                    <!-- formulaire recherche tel -->
                    <div class="w-2/5">
                        <form action="" class="max-w-sm mx-auto row" method="get">
                             <div class=" flex items-center justify-between">
                                <div class="mb-5">
                            <div class=" flex items-center ">
                              <label for="tel" class="block w-32  text-xl font-medium text-gray-900 dark:text-black">Telephone: </label>
                              <input type="text" id="tel" name="telclient" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ex: 771234567">
                              </div>
                              <p class="text-sm text-red-600 dark:text-red-400"> <?=$errors["telclient"]??""?> </p>
                            </div>
                            <input type="hidden" name="controller" value="dettes">
                            <input type="hidden" name="verif" value="findbytel">
                            <button type="submit" name="action" value="liste" class="text-white  mb-10 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">OK</button>
                        </div>
                        

                        </form>

                    </div>
                    <!-- LES TAGS -->
                    <!-- <div class="w-2/5">
                        <div class="flex items-center justify-center py-2 md:py-2 flex-wrap">
                            <button type="button"
                                class="text-blue-700 hover:text-white border border-blue-600 bg-white hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-full text-base font-medium px-3 py-2.5 text-center me-3 mb-3 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:bg-gray-800 dark:focus:ring-blue-800">Tous</button>
                            <button type="button"
                                class="text-gray-900 border border-white hover:border-gray-200 dark:border-gray-900 dark:bg-green-500 dark:hover:border-gray-700 bg-white focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-full text-base font-medium px-3 py-2.5 text-center me-3 mb-3 dark:text-white dark:focus:ring-gray-800">Soldées</button>
                            <button type="button"
                                class="text-gray-900 border border-white hover:border-gray-200 dark:border-gray-900 dark:bg-red-700 dark:hover:border-gray-700 bg-white focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-full text-base font-medium px-3 py-2.5 text-center me-3 mb-3 dark:text-white dark:focus:ring-gray-800">Non
                                soldées</button>
                        </div>
                    </div> -->

                </div>
                <div class="w-full ">
                    <table class="w-11/12 text-sm text-center text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Date
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Client
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Telephone
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Montant
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Versé
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Restant
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($dettes as $dette): ?>
                            <tr
                                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <?=$dette->datedet ?>
                                </td>
                                <td class="px-6 py-4">
                                <?=$dette->prenomc." ".$dette->nomc ?>
                                </td>
                                <td class="px-6 py-4">
                                <?=$dette->tel ?>
                                </td>
                                <td class="px-6 py-4">
                                <?= intval($dette->montantdet) ?>
                                </td>
                                <td class="px-6 py-4">
                                <?=intval($dette->verse)?>
                                </td>
                                <td class="px-6 py-4">
                                <?=$dette->restant?>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="<?=$this->path("dettes","detail",["idDette"=>$dette->iddet])?>"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Detais</a>
                                </td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            
            <!-- pagination -->
            <div class=" w-11/12 flex justify-center mt-3">
                <nav aria-label="Page navigation example">
                    <ul class="inline-flex -space-x-px text-base h-10">
                        <li>
                            <a href="#" 
                                class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">1</a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">2</a>
                        </li>
                        <li>
                            <a href="#" aria-current="page"
                                class="flex items-center justify-center px-4 h-10 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">3</a>
                        </li>
                      
                        <li>
                            <a href="#"
                                class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>