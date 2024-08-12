

        <div class="flex-1 p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Carte des statistiques -->
                <div class="bg-white p-4 rounded shadow-md">
                    <h2 class="text-gray-700 text-lg font-bold mb-2">Total des Ventes</h2>
                    <p class="text-2xl font-bold">$12,345</p>
                </div>

                <div class="bg-white p-4 rounded shadow-md">
                    <h2 class="text-gray-700 text-lg font-bold mb-2">Nouveaux Clients</h2>
                    <p class="text-2xl font-bold">56</p>
                </div>

                <div class="bg-white p-4 rounded shadow-md">
                    <h2 class="text-gray-700 text-lg font-bold mb-2">Commandes Récentes</h2>
                    <p class="text-2xl font-bold">23</p>
                </div>

                <div class="bg-white p-4 rounded shadow-md">
                    <h2 class="text-gray-700 text-lg font-bold mb-2">Produits en Rupture</h2>
                    <p class="text-2xl font-bold">8</p>
                </div>
            </div>

            <!-- Table des clients et filtres -->
            <div class="mt-6 bg-white p-4 rounded shadow-md">
                <h2 class="text-gray-700 text-lg font-bold mb-4">Liste des Clients</h2>

                <!-- filtres -->
                <form >
                    <div >
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
                        <input type="text" placeholder="Filtrer par Nom" class="p-2 border rounded">
                        <input type="text" placeholder="Filtrer par Téléphone" class="p-2 border rounded">
                        <select name="categorie" class="p-2 border rounded">
                            <option value="">Filtrer par Catégorie</option>
                            <option value="solvable">Solvable</option>
                            <option value="non-solvable">Non Solvable</option>
                            <option value="fidele">Fidèle</option>
                            <option value="nouveau">Nouveau</option>
                        </select>
                        <button type="submit" class="bg-blue-500 w-1/2 text-white px-4 py-2 rounded hover:bg-blue-600">Appliquer</button>
                    </div>
                    
                    </div>
                    
                </form>

                <!-- Tableau  clients -->
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr>
                            <th class="border-b p-4 text-gray-700">Nom</th>
                            <th class="border-b p-4 text-gray-700">Téléphone</th>
                            <th class="border-b p-4 text-gray-700">Email</th>
                            <th class="border-b p-4 text-gray-700">Catégorie</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border-b p-4">Jean Dupont</td>
                            <td class="border-b p-4">+33 6 12 34 56 78</td>
                            <td class="border-b p-4">jean.dupont@example.com</td>
                            <td class="border-b p-4 text-green-500">Fidèle</td>
                        </tr>
                        <tr>
                            <td class="border-b p-4">Marie Durant</td>
                            <td class="border-b p-4">+33 6 87 65 43 21</td>
                            <td class="border-b p-4">marie.durant@example.com</td>
                            <td class="border-b p-4 text-yellow-500">Nouveau</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
        </div>