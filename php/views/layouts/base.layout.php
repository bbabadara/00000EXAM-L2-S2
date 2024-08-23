<?php
$Uconnect=[];
if ($this->session->isset("userConnect")) {
  $Uconnect = $this->session->get("userConnect");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All dettes</title>
    <link rel="stylesheet" href="css/styles.css">
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" /> -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body>

    <!-- Partie Navbar  -->
    <nav class="fixed top-0 z-50 w-full bg-gray-800  border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start rtl:justify-end">
                    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                        aria-controls="logo-sidebar" type="button"
                        class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                            </path>
                        </svg>

                    </button>
                    <a href="#" class="flex ms-2 md:me-24">
                        <img src="../../image/logo.jpg" class="h-8 me-3 rounded-full" alt="#" />
                        <div><span
                                class="self-center text-xl font-semibold text-white sm:text-2xl whitespace-nowrap dark:text-white">BoutiqueBi</span>
                        </div>
                    </a>
                </div>
                <!-- Partie utilisateur -->
                <div class="flex items-center">
                    <div class="flex items-center ms-3">
                        <div>
                            <button type="button"
                                class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                                aria-expanded="false" data-dropdown-toggle="dropdown-user">
                                <span class="sr-only">Open user menu</span>
                                <img class="w-8 h-8 rounded-full"
                                    src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"
                                    alt="user pic">
                            </button>
                        </div>
                        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                            id="dropdown-user">
                            <div class="px-4 py-3" >
                                <p class="text-sm text-gray-900 dark:text-white" >
                                   <?=empty($Uconnect)?"":$Uconnect->prenom." ".$Uconnect->nom?>
                                </p>
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" >
                                <?=$Uconnect->login??""?>
                                </p>
                            </div>
                            <ul class="py-1" >
                                <li>
                                    <a href="<?=$this->path("user","dashboard")?>"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Dashboard</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Paramettre</a>
                                </li>
                               
                                <li>
                                    <a href="<?=$this->path("security","logout")?>"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                        role="menuitem">Se deconnecter</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Partie SideBar -->

    <aside id="logo-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-gray-800  border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
        aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-gray-800 text dark:bg-gray-800">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="<?=$this->path("user","dashboard")?>"
                        class="flex items-center p-2 text-gray-50 rounded-lg dark:text-white hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-gray-400 dark:<?=$_REQUEST['controller']=='user'?'bg-gray-400':''?> group">
                        <span class="material-symbols-outlined"> dashboard </span>
                        <span class="ms-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="<?=$this->path("clients","liste")?>"
                        class="flex items-center p-2 text-gray-50 rounded-lg dark:text-white hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-gray-400 dark:<?=$_REQUEST['controller']=='clients'?'bg-gray-400':''?> group">
                        <span class="material-symbols-outlined"> person </span>
                        <span class="flex-1 ms-3 whitespace-nowrap">Clients</span>
                    </a>
                </li>
                <li>
                    <a href="<?=$this->path("articles","liste")?>"
                        class="flex items-center p-2 text-gray-50 rounded-lg dark:text-white hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-gray-400 dark:<?=$_REQUEST['controller']=='articles'?'bg-gray-400':''?> group">
                        <span class="material-symbols-outlined"> person </span>
                        <span class="flex-1 ms-3 whitespace-nowrap">Articles</span>
                    </a>
                </li>
                <li>
                    <a href="<?=$this->path("dettes","liste")?>"
                        class="flex items-center p-2 text-gray-50 rounded-lg dark:text-white hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-gray-400 dark:<?=$_REQUEST['controller']=='dettes'?'bg-gray-400':''?> group">
                        <span class="material-symbols-outlined"> inbox </span>
                        <span class="flex-1 ms-3 whitespace-nowrap">Dettes</span>
                        
                    </a>
                </li>


            </ul>
        </div>
    </aside>
    <!-- Partie container -->
    <div class="p-4 sm:ml-64 mt-14 ">
        <?= $cFV ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
</body>

</html>
   
