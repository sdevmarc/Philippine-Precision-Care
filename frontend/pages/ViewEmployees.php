<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPC | Employees</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./css/Dashboard.css">
    <link rel="stylesheet" href="../index.css">
</head>

<body>
    <header class="w-full h-[7vh] px-[10rem] flex justify-between items-center z-[2] bg-white">
        <div class="overlow-hidden w-[30%] h-full ">
            <img src='../assets/logo-no-background.png' alt="Logo" class="object-contain w-full h-full">
        </div>
        <div class="w-[70%] h-full flex justify-end items-center gap-[2rem]">
            <div class="hr relative">
                <button class="text-[1rem] font-[400] text-black">
                    Human Resource
                </button>
                <div class="hr-content absolute top-[1.5rem] w-[13rem] left-[-2rem] hidden bg-[#a30000] rounded-xl py-[1rem] px-[1rem]">
                    <a href="./ViewEmployees.php" class="text-[.9rem] font-[400] text-white font-[600] duration-300 ease hover:bg-black w-full px-[.5rem] py-[.5rem] rounded-xl text-center">
                        View Employees
                    </a>
                    <a href="./ManageEmployees.php" class="text-[.9rem] font-[400] text-white font-[600] duration-300 ease hover:bg-black w-full px-[.5rem] py-[.5rem] rounded-xl text-center">
                        Manage Employees
                    </a>
                </div>
            </div>

            <div class="hr relative">
                <button class="text-[1rem] font-[400] text-black">
                    Finance
                </button>
                <div class="hr-content absolute top-[1.5rem] w-[13rem] left-[-4rem] hidden bg-[#a30000] rounded-xl py-[1rem] px-[1rem]">
                    <a href="./ManageFinance.php" class="text-[.9rem] font-[400] text-white font-[600] duration-300 ease hover:bg-black w-full px-[.5rem] py-[.5rem] rounded-xl text-center">
                        Manage Finance
                    </a>
                </div>
            </div>

            <div class="hr relative">
                <button class="text-[1rem] font-[400] text-black">
                    Appointment
                </button>
                <div class="hr-content absolute top-[1.5rem] w-[13rem] left-[-3rem] hidden bg-[#a30000] rounded-xl py-[1rem] px-[1rem]">
                    <a href="./ManageAppointments.php" class="text-[.9rem] font-[400] text-white font-[600] duration-300 ease hover:bg-black w-full px-[.5rem] py-[.5rem] rounded-xl text-center">
                        Manage Appointments
                    </a>
                </div>
            </div>

            <button class="text-[1rem] text-white font-[400] text-black bg-[#a30000] px-[1rem] py-[.3rem] duration-300 ease hover:scale-[.98] hover:opacity-[.7]">
                Logout
            </button>
        </div>
    </header>
    <div class="w-full h-[93vh] flex flex-col justify-start items-center px-[5rem]">
        <div class="w-full h-[10%] flex items-center">
            <h1 class="text-black text-[2rem] font-[700]">MANAGE EMPLOYEES</h1>
        </div>
        <div class="overflow-auto w-full h-[88%] flex flex-col justify-start items-center">
            <table class="w-full table-fixed">
                <thead class="sticky top-0 h-[3rem] bg-[#a30000]">
                    <tr class="border border-black text-black">
                        <th class="border border-black text-white">ID</th>
                        <th class="border border-black text-white">SAMPLE NAME</th>
                        <th class="border border-black text-white">SAMPLE NAME</th>
                        <th class="border border-black text-white">SAMPLE NAME</th>
                        <th class="border border-black text-white">SAMPLE NAME</th>
                        <th class="border border-black text-white">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border border text-black">
                        <td class="border border-black text-black px-[1rem] text-center truncate">TTESTssssssssss ssssssssssssss ssssssssssss IDssssssssssssss</td>
                        <td class="border border-black text-black px-[1rem] text-center truncate">TEST NAMEs</td>
                        <td class="border border-black text-black px-[1rem] text-center truncate">TEST NAME</td>
                        <td class="border border-black text-black px-[1rem] text-center truncate">TEST NAME</td>
                        <td class="border border-black text-black px-[1rem] text-center truncate">TEST NAME</td>
                        <td class="border border-black text-black px-[1rem] text-center truncate">
                            <button 
                            onclick="openEditForm()"
                            class="px-[1.5rem] py-[.3rem] mx-[.2rem] my-[.4rem] bg-[#3076f0] text-[.9rem] text-white font-[600] rounded-xl duration-300 ease hover:scale-[.98] hover:opacity-[.6]">
                                Edit
                            </button>
                            <button class="px-[1.5rem] py-[.3rem] mx-[.2rem] my-[.4rem] bg-[#de5021] text-[.9rem] text-white font-[600] rounded-xl duration-300 ease hover:scale-[.98] hover:opacity-[.6]">
                                Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div id="editFormOverlay" class="hidden absolute top-0 left-0 w-full h-screen bg-[#000] bg-opacity-[.3] flex justify-center items-center z-[1]">
        <form id="editForm" action="" class="relative w-[70rem] h-[35rem] bg-white rounded-xl shadow-[0_10px_15px_-3px_rgba(0,0,0,0.1)]">
            <div onclick="closeEditForm()" class="absolute top-[-1rem] right-[-1rem] bg-[#9525f7] w-[3rem] h-[3rem] rounded-[50%] flex justify-center items-center text-white font-bold cursor-pointer duration-300 ease hover:scale-[.98] hover:opacity-[.6]">
                x
            </div>
        </form>
    </div>

    <script>
        const editFormOverlay = document.getElementById('editFormOverlay');
        const editForm = document.getElementById('editForm');

        function openEditForm() {
            editFormOverlay.style.display = 'flex';
        }

        function closeEditForm() {
            editFormOverlay.style.display = 'none';
        }

        const editButtons = document.querySelectorAll('.edit-button');

        editButtons.forEach(button => {
            button.addEventListener('click', openEditForm);
        });
    </script>
</body>

</html>