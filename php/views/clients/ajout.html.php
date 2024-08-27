<div class="bg-gray-100 flex items-center justify-center min-h-screen p-2">
<div class="w-full max-w-3xl bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-semibold mb-4">Ajouter un Client</h2>
        <form action="/ajouter-client" method="POST" enctype="multipart/form-data">
            <!-- Première ligne -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                <div>
                    <label for="nomc" class="block text-sm font-medium text-gray-700">Nom</label>
                    <input type="text" id="nomc" name="nomc" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                </div>
                <div>
                    <label for="prenomc" class="block text-sm font-medium text-gray-700">Prénom</label>
                    <input type="text" id="prenomc" name="prenomc" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                </div>
            </div>

            <!-- Deuxième ligne -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                <div>
                    <label for="tel" class="block text-sm font-medium text-gray-700">Téléphone</label>
                    <input type="tel" id="tel" name="tel" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                </div>
            </div>

            <!-- Troisième ligne -->
            <div class="mb-4">
                <label for="adresse" class="block text-sm font-medium text-gray-700">Adresse</label>
                <textarea id="adresse" name="adresse" rows="3" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required></textarea>
            </div>

            <!-- Quatrième ligne avec Flexbox pour Sexe et Catégorie -->
            <div class="flex flex-col md:flex-row gap-6 mb-4">
                <!-- Catégorie -->
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700">Catégorie</label>
                    <div class="flex items-center space-x-6 mt-1">
                        <label class="flex items-center">
                            <input type="radio" id="solvable" name="categorie" value="solvable" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" required>
                            <span class="ml-2 text-sm text-gray-600">Solvable</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" id="nouveau" name="categorie" value="nouveau" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" required>
                            <span class="ml-2 text-sm text-gray-600">Nouveau</span>
                        </label>
                    </div>
                </div>
                
                <!-- Sexe -->
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700">Sexe</label>
                    <div class="flex items-center space-x-6 mt-1">
                        <label class="flex items-center">
                            <input type="radio" id="sexeM" name="sexe" value="M" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" required>
                            <span class="ml-2 text-sm text-gray-600">Homme</span>
                        </label>
                        <label class="flex items-center">
                            <input type="radio" id="sexeF" name="sexe" value="F" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" required>
                            <span class="ml-2 text-sm text-gray-600">Femme</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Cinquième ligne -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                <div>
                    <label for="solde" class="block text-sm font-medium text-gray-700">Solde</label>
                    <input type="text" id="solde" name="solde" step="0.01" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="0.00" required>
                </div>
                <div>
                    <label for="montantseuil" class="block text-sm font-medium text-gray-700">Montant Seuil</label>
                    <input type="text" id="montantseuil" name="montantseuil" step="0.01" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" value="0.00" required>
                </div>
            </div>

            <!-- Photo -->
            <div class="mb-4">
                <label for="photo" class="block text-sm font-medium text-gray-700">Photo</label>
                <input type="file" id="photo" name="photo" accept="image/*" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Ajouter Client</button>
        </form>
    </div>
    </div>