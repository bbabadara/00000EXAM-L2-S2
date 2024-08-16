<div class="bg-gray-100 p-4 h-max ">
    <div class="max-w-md mx-auto bg-white p-4 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-4 text-center">Reçu de Paiement</h1>
        
        <div class="mb-4">
            <h2 class="text-lg font-semibold">Boutique Bi</h2>
            <p class="text-gray-700">Dieupeul Dakar</p>
            <p class="text-gray-700">Téléphone : 338000000</p>
            <p class="text-gray-700">Email : boutiquebi@boutiquebi.sn</p>
        </div>

        <div class="mb-4 border-t border-gray-300 pt-4">
            <h2 class="text-lg font-semibold">Informations du Client</h2>
            <p class="text-gray-700">Nom: <?=$info->nomc?></p>
            <p class="text-gray-700">Prenom: <?=$info->prenomc?></p>
            <p class="text-gray-700">Telephone: <?=$info->tel?></p>
            <p class="text-gray-700">Email: <?=$info->email?></p>
            <p class="text-gray-700">Adresse: <?=$info->adresse?></p>
        </div>
        <div class="mb-4 border-t border-gray-300 pt-4">
            <h2 class="text-lg font-semibold">Détails de la Transaction</h2>
            <p class="text-gray-700">Numero Dette: <?=$info->numerodet?> </p>
            <p class="text-gray-700">Montant Dette: <?=$info->montantdet?> </p>
            <p class="text-gray-700">Numero Paiement: <?=$info->numeropay?></p>
            <p class="text-gray-700">Montant Paiement: <?=$info->montantpay?> Fcfa</p>
            <p class="text-gray-700">Restant à payer: <?=$info->restant?> Fcfa</p>
        </div>

        <div class="mt-5 text-center">
            <a href="<?=$this->path("paiement","recu",["key"=>$_REQUEST["key"],"verif"=>"download"])?>">
            <button class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600">
                Imprimer
            </button>
            </a>
           
        </div>
    </div>
    </div>