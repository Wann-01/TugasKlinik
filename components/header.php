<header class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center">
                <div class="flex-shrink-0 flex items-center">
                    <div class="bg-gradient-to-r from-blue-600 to-green-600 p-2 rounded-xl">
                        <i data-lucide="stethoscope" class="h-6 w-6 text-white"></i>
                    </div>
                    <h1 class="ml-3 text-xl font-bold bg-gradient-to-r from-blue-600 to-green-600 bg-clip-text text-transparent">
                        Klinik Sehat
                    </h1>
                </div>
            </div>
            <div class="flex items-center">
                <span class="text-gray-700 mr-4"><?= htmlspecialchars($user['username']) ?></span>
                <form method="POST" action="">
                    <button type="submit" name="logout" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
