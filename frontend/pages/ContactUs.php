<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPC | Contact Us</title>
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
        <div class="w-[70%] h-full flex justify-end items-center gap-[2rem]">
            <a href="./index.php" class="text-[1rem] font-[400] text-black">
                Home
            </a>
            <a href="./Services.php" class="text-[1rem] font-[400] text-black">
                Services
            </a>
            <a href="./TeamAndCulture.php" class="text-[1rem] font-[400] text-black">
                Team & Culture
            </a>
            <a href="./Appointment.php" class="text-[1rem] font-[400] text-black">
                Appointment
            </a>
            <a href="./ContactUs.php" class="text-[1rem] text-white font-[400] text-black bg-[#a30000] px-[1rem] py-[.3rem] duration-300 ease hover:scale-[.98] hover:opacity-[.7]">
                Contact Us
            </a>
        </div>
    </header>
    <div class="w-full py-[5rem] bg-[#ffffff] px-[2rem] sm:px-[5rem] md:px-[10rem] lg:px-[20rem] flex flex-col items-center">
        <h1 class="text-[#c10000] font-bold text-[2rem] sm:text-[3rem] md:text-[4rem]">Contact Us</h1>
        <p class="text-[1rem] sm:text-[1.2rem] md:text-[1.5rem] text-justify mb-[2rem]">We'd love to hear from you. Please fill out the form below to get in touch with us.</p>
        <form action="contact_form.php" method="post" class="w-full max-w-[600px] flex flex-col gap-[1rem]">
            <input type="text" name="name" placeholder="Your Name" class="p-[1rem] border border-gray-300 rounded" required>
            <input type="email" name="email" placeholder="Your Email" class="p-[1rem] border border-gray-300 rounded" required>
            <input type="text" name="subject" placeholder="Subject" class="p-[1rem] border border-gray-300 rounded" required>
            <textarea name="message" placeholder="Your Message" class="p-[1rem] border border-gray-300 rounded h-[150px]" required></textarea>
            <button type="submit" class="p-[1rem] bg-[#a30000] text-white font-bold rounded hover:bg-[#870000]">Send Message</button>
        </form>
    </div>
    <footer class="w-full h-[20vh] bg-[#a30000] py-[2rem] px-[
