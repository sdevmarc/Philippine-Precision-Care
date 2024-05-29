<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPC | Appointment</title>
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
        <div class="overlow-hidden w-[30%] h-full ">
            <img src='../assets/logo-no-background.png' alt="Logo" class="object-contain w-full h-full">
        </div>
        <div class="navs w-[70%] h-full flex justify-end items-center gap-[.5rem]">
            <a href="./index.php" class="text-[1rem] font-[400] text-black px-[1.5rem] py-[.4rem] rounded-[1rem] duration-300 ease hover:bg-[#111] hover:bg-opacity-[.6] hover:text-white">
                Home
            </a>
            <a href="./Services.php" class="text-[1rem] font-[400] text-black px-[1.5rem] py-[.4rem] rounded-[1rem] duration-300 ease hover:bg-[#111] hover:bg-opacity-[.6] hover:text-white">
                Services
            </a>
            <a href="./TeamAndCulture.php" class="text-[1rem] font-[400] text-black px-[1.5rem] py-[.4rem] rounded-[1rem] duration-300 ease hover:bg-[#111] hover:bg-opacity-[.6] hover:text-white">
                Team & Culture
            </a>
            <a href="./Appointment.php" class="active text-[1rem] font-[400] text-black px-[1.5rem] py-[.4rem] rounded-[1rem] duration-300 ease hover:bg-[#111] hover:bg-opacity-[.6] hover:text-white">
                Appointment
            </a>
            <a href="./ContactUs.php"
                class="text-[1rem] text-white font-[400] text-black bg-[#a30000] px-[1rem] py-[.3rem] duration-300 ease hover:scale-[.98] hover:opacity-[.7]">
                Contact Us
            </a>
        </div>
    </header>
    <div class="w-full h-screen flex justify-center items-center">
        <form action="../../backend/appointment_process.php" method="POST"
            class="w-[30rem] h-auto bg-white p-[3rem] rounded-[1rem] shadow-md flex flex-col gap-[1rem]">
            <h1 class="text-black font-[700] text-[2rem] mb-[1rem]">Request Appointment</h1>
            <?php
                session_start();
                if(isset($_SESSION['success_message'])){
                    echo "<p class='text-green-500 mt-4'>{$_SESSION['success_message']}</p>";
                    unset($_SESSION['success_message']); // Clear the success message from session
                }
            ?>
            <div class="flex flex-col gap-[.5rem]">
                <label for="first_name" class="text-black font-[600] text-[1.1rem]">First Name</label>
                <input type="text" id="first_name" name="first_name" placeholder="Enter your first name..."
                    class="w-full h-[3rem] px-[1rem] outline-none border border-black rounded-xl shadow-sm" required>
            </div>
            <div class="flex flex-col gap-[.5rem]">
                <label for="middle_name" class="text-black font-[600] text-[1.1rem]">Middle Name</label>
                <input type="text" id="middle_name" name="middle_name" placeholder="Enter your middle name..."
                    class="w-full h-[3rem] px-[1rem] outline-none border border-black rounded-xl shadow-sm">
            </div>
            <div class="flex flex-col gap-[.5rem]">
                <label for="last_name" class="text-black font-[600] text-[1.1rem]">Last Name</label>
                <input type="text" id="last_name" name="last_name" placeholder="Enter your last name..."
                    class="w-full h-[3rem] px-[1rem] outline-none border border-black rounded-xl shadow-sm" required>
            </div>
            <div class="flex flex-col gap-[.5rem]">
                <label for="contact_number" class="text-black font-[600] text-[1.1rem]">Contact Number</label>
                <input type="text" id="contact_number" name="contact_number" placeholder="Enter your contact number..."
                    class="w-full h-[3rem] px-[1rem] outline-none border border-black rounded-xl shadow-sm" required>
            </div>
            <div class="flex flex-col gap-[.5rem]">
                <label for="email" class="text-black font-[600] text-[1.1rem]">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Enter your email address..."
                    class="w-full h-[3rem] px-[1rem] outline-none border border-black rounded-xl shadow-sm" required>
            </div>
            <button type="submit"
                class="w-full h-[2.5rem] rounded-xl bg-[#a30000] text-white font-[600] hover:opacity-75 transition-opacity duration-300 mt-[1rem]">Submit</button>
        </form>
    </div>
</body>

</html>
