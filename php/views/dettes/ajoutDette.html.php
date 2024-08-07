<?php
$errors=[];
if ($this->session->isset("errors")) {
    $errors=$this->session->get("errors");
    $this->session->unset("errors");
}
?>
<div class="p-4 border-1 border-gray-200  rounded-lg dark:border-gray-700 ">
            <h1 class="text-gray-900 text-2xl text-bold ">Enregistrer une dettes</h1>
            <!-- Partie recherche client -->
            <form class="max-w-md mt-3 ">
                <label for="default-search"
                    class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <span class="material-symbols-outlined dark:text-white"> search </span>
                    </div>
                    <input type="search" id="default-search"
                        class="block w-full p-2.5 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Entrer le telephone du client " />
                    <button type="submit"
                        class="text-white absolute end-0 bottom-0.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                </div>
            </form>

            <!-- Partie info client -->
            <div class="shadow-xl p-2 mt-4">
                <div class="flex justify-around	">
                    <div class="mb-5 w-1/4">
                        <label for="prenom" class="block mb-1 text-xs font-medium text-dark-900 dark:text-blue">
                            Prenom</label>
                        <input type="text" id="prenom"
                            class="bg-gray-50 border border-gray-300 text-gray-900 read-only:bg-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder=" " readonly />
                    </div>
                    <div class="mb-5 w-1/4">
                        <label for="nom" class="block mb-1 text-xs font-medium text-gray-900 dark:text-blue">
                            Nom</label>
                        <input type="text" id="nom"
                            class="bg-gray-50 border border-gray-300 text-gray-900 read-only:bg-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder=" " readonly />
                    </div>
                    <div class="mb-5 w-1/4">
                        <label for="tel"
                            class="block mb-1 text-xs font-medium text-gray-900 dark:text-blue">Telephone</label>
                        <input type="nom" id="tel"
                            class="bg-gray-50 border border-gray-300 text-gray-900 read-only:bg-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder=" " readonly />
                    </div>
                </div>
            </div>

            <!-- Partie ajout article  -->
            <div class="shadow-xl p-2.5 mt-4 flex items-center justify-between">
                <!-- Partie recherche article -->
                <div class="artQte w-1/2">
                    <div class="w-10/12 mt-2">
                        <form class="max-w-sm mx-auto row">
                             <div class=" flex items-center justify-between">
                            <div class="mb-3 flex items-center ">
                              <label for="art" class="block w-32  text-sm font-medium text-gray-900 dark:text-black">Libelle: </label>
                              <input type="text" id="art" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Article 1">
                            </div>
                            <button type="submit" class="text-white  mb-4 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" disabled>OK</button>
                        </div>
                        </form>

                    </div>

                    <div class="w-10/12">
                        <form class="max-w-sm mx-auto row">
                             <div class=" flex items-center justify-between">
                            <div class="mb-3 flex items-center ">
                              <label for="qte" class="block w-32  text-sm font-medium text-gray-900 dark:text-black">Quantite: </label>
                              <input type="number" id="qte" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="">
                            </div>
                            <button type="submit" class="text-white  mb-4 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" disabled>OK</button>
                        </div>
                        </form>

                    </div>
                </div>
                 <!-- Partie info article -->
                <div class="infoArt w-1/2">
                    <div class="mb-2 flex items-center ">
                        <label for="lib" class="block w-28  text-sm font-medium text-gray-900 dark:text-black">Libelle: </label>
                        <input type="text" id="lib" aria-describedby="helper-text-explanation" class="bg-gray-50 border  read-only:bg-gray-300 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" readonly>
                      </div>
                      <div class="mb-2 flex items-center ">
                        <label for="prix" class="block w-28  text-sm font-medium text-gray-900 dark:text-black">Prix U.: </label>
                        <input type="text" id="prix" aria-describedby="helper-text-explanation" class="bg-gray-50 read-only:bg-gray-300 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" readonly>
                      </div>
                      <div class="mb-2 flex items-center ">
                        <label for="qtestock" class="block w-28  text-sm font-medium text-gray-900 dark:text-black"> Stock: </label>
                        <input type="text" id="qtestock" aria-describedby="helper-text-explanation" class="bg-gray-50 border read-only:bg-gray-300  border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" readonly>
                      </div>
                </div>
                
            </div>

            <!-- Partie tableau d'article -->
            <div class="w-full mt-3 flex justify-center items-center">
                <table class="w-1/2 text-sm text-center text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
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
                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                          
                            <td class="px-6 py-2">
                               Article 1
                            </td>
                            <td class="px-6 py-2">
                                2000
                            </td>
                            <td class="px-6 py-2">
                                2
                            </td>
                            <td class="px-6 py-2">
                                4000
                            </td>
                            <td class="px-6 py-2">
                                <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                    <span class="material-symbols-outlined" data-popover-target="popover-image"> delete </span>
                                    <div data-popover id="popover-image" role="tooltip" class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-24 dark:text-gray-400 dark:bg-gray-800 dark:border-gray-600">
                                       <p>Enlever</p>
                                    </div>
                                </a>
                            </td>
                        </tr>
                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                          
                            <td class="px-6 py-2">
                               Article 3
                            </td>
                            <td class="px-6 py-2">
                                1000
                            </td>
                            <td class="px-6 py-2">
                                1
                            </td>
                            <td class="px-6 py-2">
                                1000
                            </td>
                            <td class="px-6 py-2">
                                <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                    <span class="material-symbols-outlined" data-popover-target="popover-image"> delete </span>
                                    <div data-popover id="popover-image" role="tooltip" class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-24 dark:text-gray-400 dark:bg-gray-800 dark:border-gray-600">
                                       <p>Enlever</p>
                                    </div>
                                </a>
                            </td>
                        </tr>

                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td class="px-6 py-2 text-xl text-gray-900 dark:text-white"  colspan="5" >Total: 5000</td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <div class="w-full flex justify-center mt-3">
                <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" disabled>Enregister</button>

            </div>

        </div>