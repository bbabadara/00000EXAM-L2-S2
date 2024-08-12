<?php
$errors = [];
$userLog = [];
$alert=[];
if ($this->session->isset("errors")) {
  $errors = $this->session->get("errors");
  $this->session->unset("errors");
}
if ($this->session->isset("userLog")) {
  $userLog = $this->session->get("userLog");
}

?>
<div class="bg-gray-50 font-[sans-serif]">
  <div class="min-h-screen flex flex-col items-center justify-center py-6 px-4">

    <div class="max-w-md w-full">
      <div class="p-8 rounded-2xl bg-white shadow">
        <h2 class="text-gray-800 text-center text-2xl font-bold">CONNEXION</h2>
        <?php if (!empty($errors["alert"])):?>
        <div class="flex items-center p-4 mt-5 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50  dark:text-red-500 dark:border-red-800" role="alert">
          <span class="material-symbols-outlined flex-shrink-0 inline w-4 h-6 me-3"> info </span>
          <span class="sr-only">Info</span>
          <div> <span class="font-medium">Attention!</span> Login ou mot de passe incorecte!</div>
        </div>
        <?php endif?>
        <form class="mt-8 space-y-4" action="" method="post">
          <div>
            <label class="text-gray-800 text-sm mb-2 block">Login</label>
            <div class="relative flex items-center">
              <input name="login" type="text" class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md outline-blue-600" placeholder="Saisir login" value="<?= $userLog["login"] ?? "" ?>" />
              <span class="material-symbols-outlined w-4 h-4 absolute right-4"> person </span>
            </div>
            <p class="mt-2 text-sm text-red-600 dark:text-red-400"> <?= $errors["login"] ?? "" ?> </p>
          </div>

          <div>
            <label class="text-gray-800 text-sm mb-2 block">Mot de passe</label>
            <div class="relative flex items-center">
              <input name="mdp" id="mdp" type="password" class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md outline-blue-600" placeholder="Saisir mot de passe" />
              <span class="material-symbols-outlined w-4 h-4 absolute right-4 cursor-pointer" id="affichepwd"> visibility_off </span>
            </div>
            <p class=" mt-2 text-sm text-red-600 dark:text-red-500"> <?= $errors["mdp"] ?? "" ?> </p>
          </div>

          <!-- <div class="flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center">
                  <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 shrink-0 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" />
                  <label for="remember-me" class="ml-3 block text-sm text-gray-800">
                    Remember me
                  </label>
                </div>
                <div class="text-sm">
                  <a href="#" class="text-blue-600 hover:underline font-semibold">
                    Mot de passe oublié?
                  </a>
                </div>
              </div> -->
          <input type="hidden" name="controller" value="security">
          <div class="!mt-8">
            <button type="submite" name="action" value="login" class="w-full py-3 px-4 text-sm tracking-wide rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">
              Se connecter
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  const mdp = document.querySelector("#mdp")
  const affichepwd = document.querySelector("#affichepwd")
  let verif = true;
  affichepwd.addEventListener("click", function() {
    if (verif == true) {
      mdp.type = "text";
      verif = false;
      affichepwd.textContent = " visibility"
    } else {
      mdp.type = "password";
      affichepwd.textContent = " visibility_off"
      verif = true;
    }
  })
</script>