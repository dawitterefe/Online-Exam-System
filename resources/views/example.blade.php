<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>University Online Examination System</title>
    <!-- TailwindCSS CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-200 font-sans">
    <header class="bg-white shadow">
        <div class="container mx-auto flex">
            <div class="flex justify-between w-full items-center py-4">
                <a class="text-gray-800 text-xl font-semibold" href="#">University</a>
                <div class="flex">
                    <a class="hidden md:block text-gray-800 hover:text-gray-600 px-4" href="#">Home</a>
                    <a class="hidden md:block text-gray-800 hover:text-gray-600 px-4" href="#">About</a>
                    <a class="hidden md:block text-gray-800 hover:text-gray-600 px-4" href="#">Contact</a>
                </div>
            </div>
        </div>
    </header>
    <main class="container mx-auto mt-10">
        <div class="flex flex-wrap justify-between items-center">
            <div class="w-full lg:w-1/2 px-6 mb-6 lg:mb-0">
                <h1 class="text-5xl font-bold text-gray-800 mb-2">Online Examination System</h1>
                <p class="text-gray-700 text-xl mb-4">Revolutionize the way examinations are conducted at your
                    university with our state-of-the-art online examination system.</p>
                <a class="bg-indigo-500 text-white px-4 py-2 font-semibold tracking-widest rounded hover:bg-indigo-700"
                    href="#">Get Started</a>
            </div>
            <div class="w-full lg:w-1/2 px-6">
                <img class="w-full" src="images/exam.jpg" alt="Examination System">
            </div>
        </div>
    </main>
    <footer class="bg-gray-800 text-white py-4">
        <div class="container mx-auto">
            <p class="text-center">©2021 University Online Examination System. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>
```