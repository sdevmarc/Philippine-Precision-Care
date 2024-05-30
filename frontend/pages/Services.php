<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPC | Services</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./css/Home.css">
    <link rel="stylesheet" href="../index.css">
</head>

<body>
    <div class="w-full h-5 bg-[#a30000] flex justify-center items-center">
        <h1 class='text-white font-extrabold text-xs tracking-widest'>
           customercare@philippineprecisioncare.com
        </h1>
    </div>
    <header class="sticky top-0 w-full h-[5rem] px-[10rem] flex justify-between items-center z-[2] bg-white">
        <div class="overflow-hidden w-[30%] h-full ">
            <img src='../assets/logo-no-background.png' alt="Logo" class="object-contain w-full h-full">
        </div>
        <div class="navs w-[70%] h-full flex justify-end items-center gap-[.5rem]">
            <a href="./index.php" class="text-[1rem] font-[400] text-black px-[1.5rem] py-[.4rem] rounded-[1rem] duration-300 ease hover:bg-[#111] hover:bg-opacity-[.6] hover:text-white">
                Home
            </a>
            <a href="./Services.php" class="active text-[1rem] font-[400] text-black px-[1.5rem] py-[.4rem] rounded-[1rem] duration-300 ease hover:bg-[#111] hover:bg-opacity-[.6] hover:text-white">
                Services
            </a>
            <a href="./TeamAndCulture.php" class="text-[1rem] font-[400] text-black px-[1.5rem] py-[.4rem] rounded-[1rem] duration-300 ease hover:bg-[#111] hover:bg-opacity-[.6] hover:text-white">
                Team & Culture
            </a>
            <a href="./Appointment.php" class="text-[1rem] font-[400] text-black px-[1.5rem] py-[.4rem] rounded-[1rem] duration-300 ease hover:bg-[#111] hover:bg-opacity-[.6] hover:text-white">
                Appointment
            </a>
            <a href="./ContactUs.php" class="text-[1rem] text-white font-[400] text-black bg-[#a30000] px-[1rem] py-[.3rem] duration-300 ease hover:scale-[.98] hover:opacity-[.7]">
                Contact Us
            </a>
        </div>
    </header>
    <div class="w-full py-[5rem] bg-[#ffffff] px-[2rem] sm:px-[5rem] md:px-[10rem] lg:px-[20rem] flex flex-col items-center gap-[5rem]">
        <h1 class="text-[#c10000] font-bold text-[2rem] sm:text-[3rem] md:text-[4rem]">Our Services</h1>
        <div class="w-full flex flex-col items-start gap-[2rem]">
            <h2 class="text-[1.3rem] sm:text-[1.5rem] md:text-[1.8rem] text-black font-bold">Appointments</h2>
            <p class="text-[.8rem] sm:text-[1rem] md:text-[1.3rem] text-justify">
                Our facility offers comprehensive appointment services for various medical tests and consultations. Schedule your appointment online or via phone, and receive prompt, professional care at your convenience.
            </p>
            <ul class="list-disc pl-[1.5rem]">
                <li class="text-[.8rem] sm:text-[1rem] md:text-[1.2rem]">Blood Tests</li>
                <li class="text-[.8rem] sm:text-[1rem] md:text-[1.2rem]">Diagnostic Imaging</li>
                <li class="text-[.8rem] sm:text-[1rem] md:text-[1.2rem]">General Health Check-ups</li>
                <li class="text-[.8rem] sm:text-[1rem] md:text-[1.2rem]">Specialist Consultations</li>
            </ul>
        </div>
    </div>
    <footer class="w-full h-[30dvh] bg-[#a30000] py-[2rem] px-[1rem] sm:px-[2rem] md-px-[3rem] flex flex-col justify-center items-center gap-[1rem]">
        <h1 class='font-[500] text-[.5rem] sm:text-[.8rem] md:text-[1rem] text-[#fff] tracking-[.5rem] sm:tracking-[.7rem] md:tracking-[1rem]'>
            CONNECT WITH US
        </h1>
        <div class="flex gap-[2rem]">
            <a href="https://www.facebook.com/kantokusina" class="text-[#fff] text-[2rem]" target='_blank'>
                <FacebookIcon />
            </a>
            <a href="mailto:jactubaran07@gmail.com" class="text-[#fff] text-[2rem]">
                <EmailIcon />
            </a>

        </div>
        <div class="text-[#fff] text-[.5rem] sm:text-[.6rem] md:text-[.8rem] text-center">
            <p> Copyright &copy; 2024 Philippine Precision Care, All Rights Reserved.</p>
        </div>
    </footer>
</body>

</html>
