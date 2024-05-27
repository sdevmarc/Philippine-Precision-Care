<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPC | Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./css//Login.css">
</head>

<body>
    <div class="w-full h-screen flex bg-white">
        <div class="hero-login relative w-[60%] h-full flex justify-start items-center px-[1rem]">
            <h1 class="text-white text-[5rem] font-[700] z-[1]">Philippine Precision Care Portal.</h1>
        </div>
        <div class="w-[40%] h-full flex justify-center items-center">
            <form action="" method="POST" class="w-[30rem] h-[35rem] rounded-[1rem] shadow-[inset_0_10px_15px_-3px_rgba(0,0,0,0.1)] px-[3rem] py-[3rem] flex flex-col justify-evenly items-center">
                <h1 class="text-black font-[700] text-[2rem]">Login</h1>
                <div class="w-full py-[1rem] flex flex-col gap-[.5rem]">
                    <h1 class="text-black font-[600] text-[1.1rem]">Username</h1>
                    <input type="text" placeholder="Enter your username..." class="w-full h-[3rem] px-[1rem] outline-none border border-black rounded-xl shadow-[0_10px_15px_-3px_rgba(0,0,0,0.1)]">
                </div>
                <div class="w-full py-[1rem] flex flex-col gap-[.5rem]">
                    <h1 class="text-black font-[600] text-[1.1rem]">Password</h1>
                    <input type="text" placeholder="Enter your password..." class="w-full h-[3rem] px-[1rem] outline-none border border-black rounded-xl shadow-[0_10px_15px_-3px_rgba(0,0,0,0.1)]">
                </div>
                <button name="login" type="submit" class="w-full h-[2.5rem] rounded-xl duration-300 ease hover:scale-[.98] hover:opacity-[.6] bg-[#a30000] text-white">
                    Login
                </button>
            </form>
        </div>
    </div>
</body>

</html>

<?php
    if (isset($_POST['login'])) {

        header('Location: /philippine-precision-care/frontend/pages/Dashboard.php');
        exit();
    }
?>