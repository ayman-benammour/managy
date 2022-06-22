<?php

require_once './includes/config.php';
require_once './includes/handleForm.php';

if(!empty($_GET['delete']))
{
    $prepare = $pdo->prepare('DELETE FROM expenses WHERE id = :id');
    $prepare->bindValue('id', (int)$_GET['delete']);
    $prepare->execute();
}

// Fetch all expenses
$query = $pdo->query('SELECT * FROM expenses');
$expenses = $query->fetchAll();
// echo '<pre>';
// print_r($expenses);
// echo '</pre>';

?>



<!-- Header -->
<?php include './chunks/header.php' ?>

<body class="bg-gray-100 font-family-karla flex">

    <aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
        <div class="p-6">
            <a href="./index.php" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Managy</a>
        </div>
        <nav class="text-white text-base font-semibold pt-3">
            <a href="./index.php" class="flex items-center active-nav-link text-white py-4 pl-6 nav-item">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Dashboard
            </a>
        </nav>
    </aside>

    <div class="w-full flex flex-col h-screen overflow-y-hidden">
        <!-- Desktop Header -->
        <header class="w-full items-center bg-white py-2 px-6 hidden sm:flex">
            <div class="w-1/2"></div>
            <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
                <button @click="isOpen = !isOpen" class="realtive z-10 w-12 h-12 rounded-full overflow-hidden border-4 border-gray-400 hover:border-gray-300 focus:border-gray-300 focus:outline-none">
                    <img src="https://avatars.dicebear.com/api/micah/<?= rand() ?>.svg">
                </button>
                <button x-show="isOpen" @click="isOpen = false" class="h-full w-full fixed inset-0 cursor-default"></button>
                <div x-show="isOpen" class="absolute w-32 bg-white rounded-lg shadow-lg py-2 mt-16">
                    <a href="#" class="block px-4 py-2 account-link hover:text-white">Account</a>
                    <a href="#" class="block px-4 py-2 account-link hover:text-white">Sign Out</a>
                </div>
            </div>
        </header>

        <!-- Mobile Header & Nav -->
        <header x-data="{ isOpen: false }" class="w-full bg-sidebar py-5 px-6 sm:hidden">
            <div class="flex items-center justify-between">
                <a href="index.html" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Managy</a>
                <button @click="isOpen = !isOpen" class="text-white text-3xl focus:outline-none">
                    <i x-show="!isOpen" class="fas fa-bars"></i>
                    <i x-show="isOpen" class="fas fa-times"></i>
                </button>
            </div>

            <!-- Dropdown Nav -->
            <nav :class="isOpen ? 'flex': 'hidden'" class="flex flex-col pt-4">
                <a href="index.html" class="flex items-center active-nav-link text-white py-2 pl-4 nav-item">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Dashboard
                </a>
            </nav>
        </header>
    
        <div class="w-full overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                <h1 class="text-3xl text-black pb-6">Dashboard</h1>
    
                <!-- Add expense -->
                <div class="w-full mt-12">
                    <p class="text-xl pb-3 flex items-center">
                        <i class="fas fa-list mr-3"></i> Add expense
                    </p>
                    <div class="bg-white overflow-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-800 text-white">
                                <tr>
                                    <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Name</th>
                                    <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Price (in €)</th>
                                    <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Date</th>
                                    <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Category</th>
                                    <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Send</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700">
                                    <tr>
                                        <form action="" method="POST">

                                            <td class="w-1/3 text-left py-3 px-4">
                                                <!-- Name -->
                                                <fieldset>
                                                    <input type="text" id="name" name="name" value="<?= $name ?>" placeholder="Name">
                                                </fieldset>
                                            </td>

                                            <td class="w-1/3 text-left py-3 px-4">
                                                <!-- Price -->
                                                <fieldset>
                                                    <input type="number" id="price" name="price" value="<?= $price ?>" placeholder="Price">
                                                </fieldset>
                                            </td>

                                            <td class="w-1/3 text-left py-3 px-4">
                                                <!-- Date -->
                                                <fieldset>
                                                    <input type="date" id="dateText" name="dateText" value="<?= $dateText ?>" placeholder="Date">
                                                </fieldset>
                                            </td>

                                            <td class="w-1/3 text-left py-3 px-4">
                                                <!-- Category -->
                                                <fieldset>
                                                    <select name="category">
                                                        <?php foreach($categories as $key => $value) { ?>
                                                            <option value="<?= $key ?>"><?= $value ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </fieldset>
                                            </td>

                                            <td class="w-1/3 text-left py-3 px-4">
                                                <fieldset>
                                                    <input class="hover:text-blue-500 cursor-pointer" type="submit">
                                                </fieldset>
                                            </td>

                                        </form>
                                    </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Errors messages -->
                    <?php if(!empty($errorMessages)): ?>
                        <div class="errors">
                            <?php foreach($errorMessages as $message): ?>
                                <p><?= $message ?></p>
                            <?php endforeach ?>
                        </div>
                    <?php endif ?>

                </div>

                <!-- Latest expenses -->
                <div class="w-full mt-12">
                    <p class="text-xl pb-3 flex items-center">
                        <i class="fas fa-list mr-3"></i> Latest expenses
                    </p>
                    <div class="bg-white overflow-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-800 text-white">
                                <tr>
                                    <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Name</th>
                                    <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Price (in €)</th>
                                    <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Date</th>
                                    <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Category</th>
                                    <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Delete</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700">
                                <?php foreach ($expenses as $key => $expense) { ?>
                                    <tr>
                                        <td class="w-1/3 text-left py-3 px-4"><?= $expense->name ?></td>
                                        <td class="w-1/3 text-left py-3 px-4"><?= $expense->price ?> €</td>
                                        <td class="w-1/3 text-left py-3 px-4"><?= $expense->date ?></td>
                                        <td class="w-1/3 text-left py-3 px-4">Hobbies</td>
                                        <td class="text-left py-3 px-4"><a class="hover:text-red-500" href="?delete=<?= $expense->id ?>">Delete</a></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>

        </div>
    </div>

    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
    <!-- ChartJS -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script> -->

</body>
</html>