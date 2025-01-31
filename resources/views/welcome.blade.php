<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('coin.png') }}" type="image/png">
    <title>Sinking Fund System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-nmkRI2k3l2GKtWo8ZxLpW2VfZHRlXYWnPbm2LFl9hAL5ZtntF7D1h6jcNcdEHOo5AC5f5E3i6fq4+Qkv3DdOdw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- Ensure Tailwind is loaded -->
    
</head>
<body class="bg-white font-sans antialiased">
    <!-- Navbar -->
    <nav class="p-4 bg-white shadow md:flex md:justify-between md:items-center border-b-2">
        <!-- Logo Section -->
        <div class="flex justify-between items-center">
            <a href="{{ url('/') }}" class="hover:text-blue-800 text-blue-400 text-3xl" style="font-family: 'Fredoka', sans-serif;">Sinking</a>
            <!-- Hamburger Icon for Mobile -->
            <div class="md:hidden">
                <button class="text-gray-700 focus:outline-none" id="menu-btn">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Navigation Links -->
        <div class="hidden md:flex md:flex-grow justify-center space-y-4 md:space-y-0 md:space-x-10 mt-4 md:mt-0" id="menu">
            <a href="#top" class="text-m text-gray-600 hover:text-indigo-500  block md:inline-block font-bold">Home</a>
            <a href="#about-us" class="text-m text-gray-600 hover:text-indigo-500  block md:inline-block font-bold">About</a>
            <a href="#contacts" class="text-m text-gray-600 hover:text-indigo-500 md:inline-block font-bold">Contact</a>

            <!-- Mobile Login and Get Started Buttons -->
            <div class="block md:hidden space-y-4">
                @if (Route::has('login') && Auth::check())
                    <a href="{{ url('/login') }}" class="text-blue-600 hover:text-gray-800 block">Dashboard</a>
                @elseif (Route::has('login') && !Auth::check())
                    <a href="{{ url('/login') }}" class="text-blue-600 text-center border-2 block rounded-lg py-2 px-4 hover:text-blue-800">Login</a>
                    <a href="{{ url('/register') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md block text-center">Get Started</a>
                @endif
            </div>
        </div>

        <!-- Desktop Login and Get Started Buttons -->
        <div class="hidden md:flex items-center space-x-4 mt-4 md:mt-0">
            @if (Route::has('login') && Auth::check())
                <a href="{{ url('/dashboard') }}" class="text-blue-600  hover:text-gray-800 ">Dashboard</a>
            @elseif (Route::has('login') && !Auth::check())
                <a href="{{ url('/login') }}" class="font-semibold bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-md">Login</a>
                <a href="{{ url('/register') }}" class="font-semibold bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded-md">Get Started</a>
            @endif
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative bg-gray-100 py-16 px-6 lg:px-8">
        <div class="container mx-auto flex flex-col-reverse lg:flex-row items-center -mt-9">
            <!-- Left Content -->
            <div class="lg:w-1/2 text-center lg:text-left mt-8 lg:mt-0">
                <!--h1 class="text-9xl md:text-9xl font-bold text-orange-600 leading-tight mb-4" style="font-family: 'Fredoka', sans-serif;">PlaceIt</h1-->
                <h1 class="text-2xl md:text-6xl font-bold text-blue-600 mb-4" style="font-family: 'Fredoka', sans-serif;">Save Smart, <br>Plan Ahead,</br> Secure Your Future</h1>
                <h3 class="text-gray-600 text-base md:text-lg mb-6 ml-3">A Sinking Fund System is a smart financial tool designed to help individuals and businesses set aside money systematically for future expenses. Whether saving for a major purchase, an emergency fund, or debt repayment, this system ensures financial preparedness by allocating small, consistent contributions over time. With real-time tracking, budgeting insights, and automated reminders, our Sinking Fund System empowers users to achieve financial stability without stress.</h3>
                <a href="{{url(path: '/register') }}" class="bg-blue-700 hover:bg-blue-600 text-white py-3 px-6 rounded-md text-lg">Learn More</a>
            </div>

            <!-- Carousel Section -->
            <div class="lg:w-1/2 relative">
                <div id="carousel" class="relative w-full overflow-hidden rounded-md shadow-lg">
                    <div id="carousel-images" class="relative w-full h-full flex transition-all duration-500">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTU3mnGTwSu9yvmFkL4mg0_yazvY-6eUEb0aQ&s" alt="Image 2" class="w-full h-67 hidden">
                        <img src="https://i0.wp.com/businesselitesafrica.com/wp-content/uploads/2023/03/The-Psychology-of-Money-How-Your-Mindset-Affects-Your-Financial-Success.jpg?fit=1920%2C1080&ssl=1" alt="Image 3" class="w-full h-67 hidden">
                        <img src="https://www.thesun.ie/wp-content/uploads/sites/3/2021/12/MT-SHOPPING-OFF-PLATT.jpg?strip=all&quality=100&w=1200&h=800&crop=1" class="w-full h-67 hidden">
                    </div>

                    <!-- Previous/Next Buttons -->
                    <button id="prev" class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white p-2 opacity-50 hover:opacity-100">
                        &#10094;
                    </button>
                    <button id="next" class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white p-2 opacity-50 hover:opacity-100">
                        &#10095;
                    </button>
                </div>
            </div>

        </div>
    </section>

    <!-- Footer Section -->
    <section class="bg-white">
    <div class="max-w-screen-xl px-2 py-2 mx-auto space-y-8 overflow-hidden sm:px-6 lg:px-8">
        <div class="flex justify-center mt-8 space-x-6">
            <a href="www.facebook.com/jahisgood" class="text-gray-700 hover:text-gray-500">
                <span class="sr-only">Facebook</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"></path>
                </svg>
            </a>
            <a href="https://www.instagram.com/jahsspear/" class="text-gray-700 hover:text-gray-500">
                <span class="sr-only">Instagram</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"></path>
                </svg>
            </a>
            <a href="https://github.com/Perod122" class="text-gray-700 hover:text-gray-500">
                <span class="sr-only">GitHub</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"></path>
                </svg>
            </a>
        </div>
        <p class="mt-8 text-base leading-6 text-center text-gray-500">
            © 2025 Perod Project.
        </p>
    </div>
</section>

    <!-- Scroll to Top Button -->
    <button id="scrollToTopBtn" class="fixed bottom-5 right-5 bg-red-500 text-white rounded-full p-4 shadow-lg hover:bg-red-600">
        <img src="https://ps.w.org/back-to-the-top-button/assets/icon-256x256.png?rev=2283756" alt="Scroll Up" style="width: 18px; height: auto;" />
    </button>
</body>
<script>
        const menuBtn = document.getElementById('menu-btn');
        const menu = document.getElementById('menu');

        menuBtn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });

        // Smooth scrolling when clicking on nav links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Smooth scroll to top for "PlaceIt" in the footer
        const scrollToTop = document.querySelector('a[href="#top"]');
        scrollToTop.addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        //carousel-images
        const images = document.querySelectorAll('#carousel-images img');
        let currentIndex = 0;

        function showImage(index) {
            images.forEach((img, i) => {
                img.classList.add('hidden');
                if (i === index) {
                    img.classList.remove('hidden');
                }
            });
        }

        document.getElementById('prev').addEventListener('click', () => {
            currentIndex = (currentIndex - 1 + images.length) % images.length;
            showImage(currentIndex);
        });

        document.getElementById('next').addEventListener('click', () => {
            currentIndex = (currentIndex + 1) % images.length;
            showImage(currentIndex);
        });

        // Auto-rotate images every 3 seconds
        setInterval(() => {
            currentIndex = (currentIndex + 1) % images.length;
            showImage(currentIndex);
        }, 3000);

        // Show the first image initially
        showImage(currentIndex);
        const scrollToTopBtn = document.getElementById('scrollToTopBtn');

    // Show the button when scrolling down
        window.onscroll = function() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                scrollToTopBtn.style.display = "block";
            } else {
                scrollToTopBtn.style.display = "none";
            }
        };

        // When the button is clicked, scroll to the top
        scrollToTopBtn.onclick = function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        };
    </script>
</html>