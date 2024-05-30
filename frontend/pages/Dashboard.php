<?php
session_start();
$user_role = $_SESSION['user_role'] ?? '';

function isAdmin($role) {
    return in_array($role, ['admin']);
}

function isHR($role) {
    return in_array($role, ['admin', 'hr']);
}

function isFinance($role) {
    return in_array($role, ['admin', 'finance']);
}

function isFrontdesk($role) {
    return in_array($role, ['admin', 'frontdesk']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPC | Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./css/Dashboard.css">
    <link rel="stylesheet" href="../index.css">
   
</head>

<body>
    <header class="w-full h-[7vh] px-[10rem] flex justify-between items-center z-[2] bg-white">
        <div class="overflow-hidden w-[30%] h-full">
            <img src='../assets/logo-no-background.png' alt="Logo" class="object-contain w-full h-full">
        </div>
        <div class="w-[70%] h-full flex justify-end items-center gap-[2rem]">
            <?php if (isHR($user_role)): ?>
                <div class="hr relative">
                    <button class="text-[1rem] font-[400] text-black">
                        Human Resource
                    </button>
                    <div class="hr-content absolute top-[1.5rem] w-[13rem] left-[-2rem] hidden bg-[#a30000] rounded-xl py-[.5rem] px-[.5rem]">
                        <a href="./ManageEmployees.php" class="text-[.9rem] font-[400] text-white font-[600] duration-300 ease hover:bg-black w-full px-[.5rem] py-[.5rem] rounded-xl text-center">
                            Manage Employees
                        </a>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php if (isFinance($user_role)): ?>
                <div class="hr relative">
                    <button class="text-[1rem] font-[400] text-black">
                        Finance
                    </button>
                    <div class="hr-content absolute top-[1.5rem] w-[13rem] left-[-4rem] hidden bg-[#a30000] rounded-xl py-[.5rem] px-[.5rem]">
                        <a href="./ManageFinance.php" class="text-[.9rem] font-[400] text-white font-[600] duration-300 ease hover:bg-black w-full px-[.5rem] py-[.5rem] rounded-xl text-center">
                            Manage Finance
                        </a>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (isFrontdesk($user_role)): ?>
                <div class="hr relative">
                    <button class="text-[1rem] font-[400] text-black">
                        Appointment
                    </button>
                    <div class="hr-content absolute top-[1.5rem] w-[13rem] left-[-3rem] hidden bg-[#a30000] rounded-xl py-[.5rem] px-[.5rem]">
                        <a href="./ManageAppointments.php" class="text-[.9rem] font-[400] text-white font-[600] duration-300 ease hover:bg-black w-full px-[.5rem] py-[.5rem] rounded-xl text-center">
                            Manage Appointments
                        </a>
                    </div>
                </div>
            <?php endif; ?>

            <form action="../../backend/logout.php">
                <button class="text-[1rem] text-white font-[400] text-black bg-[#a30000] px-[1rem] py-[.3rem] duration-300 ease hover:scale-[.98] hover:opacity-[.7]">
                    Logout
                </button>
            </form>
        </div>
    </header>

    <div class="w-full h-[93vh] flex flex-col justify-center items-center gap-[1rem]">
        <h1 class="text-black font-[700] text-[5rem]">Philippine Precision Care</h1>
        <h1 class="text-black font-[700] text-[2rem]">Welcome to Dashboard!</h1>
    </div>

    
    

  
</body>

</html>
