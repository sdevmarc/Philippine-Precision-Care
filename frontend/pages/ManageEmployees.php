<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'ppc_portal');

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$sql = "SELECT * FROM `employees`";
$result = mysqli_query($link, $sql);

// Check if there are any employees
if (mysqli_num_rows($result) > 0) {
    $employees = array();
    // Fetch each row of data
    while ($row = mysqli_fetch_assoc($result)) {
        $employees[] = $row;
    }
}

mysqli_close($link);


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
        <div class="overlow-hidden w-[30%] h-full">
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
    <div class="w-full h-[93vh] flex flex-col justify-start items-center px-[5rem]">
        <div class="w-full h-[10%] flex justify-between items-center">
            <h1 class="my-[1rem] text-black text-[2rem] font-[700]">MANAGE EMPLOYEES</h1>
            <div class="w-[60%] h-[70%] flex justify-between items-center">
                <select id="searchBy" class="w-[15%] h-full border border-black text-[.8rem] text-center rounded-xl">
                    <option value="0">Select a filter</option>
                    <option value="last_name">Lastname</option>
                    <option value="first_name">Firstname</option>
                    <option value="email">Email</option>
                </select>
                <input type="text" id="searchInput" placeholder="Search here..."
                    class="w-[73%] h-full px-[1rem] rounded-[1rem] border border-black outline-none"
                    onkeyup="filterTable()">
                <button onclick="openAddForm()"
                    class="w-[10%] h-[90%] bg-[#3076f0] text-[.9rem] text-white font-[600] rounded-xl duration-300 ease hover:scale-[.98] hover:opacity-[.6]">
                    Add
                </button>
            </div>
        </div>
        <div class="overflow-auto w-full h-[88%] flex flex-col justify-start items-center">
            <table id="employeesTable" class="w-full table-fixed">
                <thead class="sticky top-0 h-[3rem] bg-[#a30000]">
                    <tr class="border border-black text-black">
                        <th class="border border-black text-white">ID</th>
                        <th class="border border-black text-white">First Name</th>
                        <th class="border border-black text-white">Last Name</th>
                        <th class="border border-black text-white">Email</th>
                        <th class="border border-black text-white">Position</th>
                        <th class="border border-black text-white">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($employees)) {
                        foreach ($employees as $employee) {
                            echo "<tr class='border border text-black'>";
                            echo "<td class='border border-black text-black px-[1rem] text-center truncate'>" . $employee['id'] . "</td>";
                            echo "<td class='border border-black text-black px-[1rem] text-center truncate'>" . $employee['first_name'] . "</td>";
                            echo "<td class='border border-black text-black px-[1rem] text-center truncate'>" . $employee['last_name'] . "</td>";
                            echo "<td class='border border-black text-black px-[1rem] text-center truncate'>" . $employee['email'] . "</td>";
                            echo "<td class='border border-black text-black px-[1rem] text-center truncate'>" . $employee['position'] . "</td>";
                            echo "<td class='border border-black text-black px-[1rem] text-center truncate'>";
                            echo "<button class='accept-button px-[1.5rem] py-[.3rem] mx-[.2rem] my-[.4rem] bg-[#3076f0] text-[.9rem] text-white font-[600] rounded-xl duration-300 ease hover:scale-[.98] hover:opacity-[.6]' onclick='populateEditForm(" . $employee['id'] . ", \"" . $employee['first_name'] . "\", \"" . $employee['last_name'] . "\", \"" . $employee['email'] . "\", \"" . $employee['position'] . "\")'>Edit</button>";
                            echo "<button class='decline-button px-[1.5rem] py-[.3rem] mx-[.2rem] my-[.4rem] bg-[#de5021] text-[.9rem] text-white font-[600] rounded-xl duration-300 ease hover:scale-[.98] hover:opacity-[.6]' onclick='showDeclineModal(" . $employee['id'] . ")'>Delete</button>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' class='text-center'>No employees found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div id="AddFormOverlay"
        class="hidden absolute top-0 left-0 w-full h-screen bg-[#000] bg-opacity-[.3] flex justify-center items-center z-[1]">
        <form id="AddForm" action="../../backend/addEmployee.php" method="POST"
            class="relative w-[70rem] h-[35rem] bg-white rounded-xl shadow-[0_10px_15px_-3px_rgba(0,0,0,0.1)] flex flex-col justify-start items-center">
            <div onclick="closeAddForm()"
                class="absolute top-[-1rem] right-[-1rem] bg-[#9525f7] w-[3rem] h-[3rem] rounded-[50%] flex justify-center items-center text-white font-bold cursor-pointer duration-300 ease hover:scale-[.98] hover:opacity-[.6]">
                x
            </div>
            <div class="overflow-auto w-full flex flex-col gap-[1rem]  px-[1.5rem] py-[1.5rem]">
                <h1 class="text-[1.5rem] font-[700] text-black">Add Employee</h1>
                <div class="w-full flex flex-col justiy-start items-start gap-[.7rem]">
                    <h1 class="text-black text-[1rem] font-[600]">First Name</h1>
                    <input type="text" name="first_name" placeholder="Enter the first name..."
                        class="w-full h-[3rem] px-[1rem] border border-black rounded-xl outline-none" required>
                </div>
                <div class="w-full flex flex-col justiy-start items-start gap-[.7rem]">
                    <h1 class="text-black text-[1rem] font-[600]">Last Name</h1>
                    <input type="text" name="last_name" placeholder="Enter the last name..."
                        class="w-full h-[3rem] px-[1rem] border border-black rounded-xl outline-none" required>
                </div>
                <div class="w-full flex flex-col justiy-start items-start gap-[.7rem]">
                    <h1 class="text-black text-[1rem] font-[600]">Email</h1>
                    <input type="email" name="email" placeholder="Enter the email..."
                        class="w-full h-[3rem] px-[1rem] border border-black rounded-xl outline-none" required>
                </div>
                <div class="w-full flex flex-col justiy-start items-start gap-[.7rem]">
                    <h1 class="text-black text-[1rem] font-[600]">Position</h1>
                    <input type="text" name="position" placeholder="Enter the position..."
                        class="w-full h-[3rem] px-[1rem] border border-black rounded-xl outline-none" required>
                </div>
                <button type="submit"
                    class="w-full py-[.7rem] bg-[#a30000] text-white rounded-xl duration-300 ease hover:scale-[.98] hover:opacity-[.6]">
                    SUBMIT
                </button>
            </div>
        </form>
    </div>

    <div id="DeclineModal"
        class="hidden absolute top-0 left-0 w-full h-screen bg-[#000] bg-opacity-[.3] flex justify-center items-center z-[1]">
        <form id="DeclineForm" action="../../backend/deleteEmployee.php" method="POST"
            class="relative w-[40rem] h-[20rem] flex flex-col bg-white p-[2rem] rounded-xl shadow-xl z-[1]">
            <button type="button" onclick="hideDeclineModal()"
                class="absolute top-[1rem] right-[1rem] w-[2rem] h-[2rem] flex justify-center items-center rounded-full border border-black">
                X
            </button>
            <h2 class="text-[1.5rem] text-center text-black">Delete Employee</h2>
            <p class="text-[1rem] text-center text-black">Are you sure you want to delete this employee?</p>
            <input type="hidden" name="id" id="declineEmployeeId">
            <button type="submit"
                class="self-center w-[10rem] h-[3rem] bg-[#de5021] text-[1.2rem] text-white font-[600] rounded-xl duration-300 ease hover:scale-[.98] hover:opacity-[.6]">
                Delete
            </button>
        </form>
    </div>

    <div id="EditFormOverlay"
        class="hidden absolute top-0 left-0 w-full h-screen bg-[#000] bg-opacity-[.3] flex justify-center items-center z-[1]">
        <form id="EditForm" action="../../backend/editEmployee.php" method="POST"
            class="relative w-[70rem] h-[35rem] bg-white rounded-xl shadow-[0_10px_15px_-3px_rgba(0,0,0,0.1)] flex flex-col justify-start items-center">
            <div onclick="closeEditForm()"
                class="absolute top-[-1rem] right-[-1rem] bg-[#9525f7] w-[3rem] h-[3rem] rounded-[50%] flex justify-center items-center text-white font-bold cursor-pointer duration-300 ease hover:scale-[.98] hover:opacity-[.6]">
                x
            </div>
            <div class="overflow-auto w-full flex flex-col gap-[1rem]  px-[1.5rem] py-[1.5rem]">
                <h1 class="text-[1.5rem] font-[700] text-black">Edit Employee</h1>
                <input type="hidden" name="id" id="editEmployeeId">
                <div class="w-full flex flex-col justiy-start items-start gap-[.7rem]">
                    <h1 class="text-black text-[1rem] font-[600]">First Name</h1>
                    <input type="text" name="first_name" id="editFirstName" placeholder="Enter the first name..."
                        class="w-full h-[3rem] px-[1rem] border border-black rounded-xl outline-none" required>
                </div>
                <div class="w-full flex flex-col justiy-start items-start gap-[.7rem]">
                    <h1 class="text-black text-[1rem] font-[600]">Last Name</h1>
                    <input type="text" name="last_name" id="editLastName" placeholder="Enter the last name..."
                        class="w-full h-[3rem] px-[1rem] border border-black rounded-xl outline-none" required>
                </div>
                <div class="w-full flex flex-col justiy-start items-start gap-[.7rem]">
                    <h1 class="text-black text-[1rem] font-[600]">Email</h1>
                    <input type="email" name="email" id="editEmail" placeholder="Enter the email..."
                        class="w-full h-[3rem] px-[1rem] border border-black rounded-xl outline-none" required>
                </div>
                <div class="w-full flex flex-col justiy-start items-start gap-[.7rem]">
                    <h1 class="text-black text-[1rem] font-[600]">Position</h1>
                    <input type="text" name="position" id="editPosition" placeholder="Enter the position..."
                        class="w-full h-[3rem] px-[1rem] border border-black rounded-xl outline-none" required>
                </div>
                <button type="submit"
                    class="w-full py-[.7rem] bg-[#a30000] text-white rounded-xl duration-300 ease hover:scale-[.98] hover:opacity-[.6]">
                    SUBMIT
                </button>
            </div>
        </form>
    </div>

    <script>
        function filterTable() {
            const searchInput = document.getElementById('searchInput').value.toLowerCase();
            const searchBy = document.getElementById('searchBy').value;
            const table = document.getElementById('employeesTable');
            const tr = table.getElementsByTagName('tr');

            for (let i = 1; i < tr.length; i++) {
                const td = tr[i].getElementsByTagName('td');
                let found = false;

                if (searchBy === 'first_name' && td[1].textContent.toLowerCase().indexOf(searchInput) > -1) {
                    found = true;
                } else if (searchBy === 'last_name' && td[2].textContent.toLowerCase().indexOf(searchInput) > -1) {
                    found = true;
                } else if (searchBy === 'email' && td[3].textContent.toLowerCase().indexOf(searchInput) > -1) {
                    found = true;
                } else if (searchBy === '0') {  // Search across all columns
                    for (let j = 0; j < td.length; j++) {
                        if (td[j].textContent.toLowerCase().indexOf(searchInput) > -1) {
                            found = true;
                            break;
                        }
                    }
                }

                tr[i].style.display = found ? '' : 'none';
            }
        }

        function openEditForm() {
            document.getElementById('EditFormOverlay').style.display = 'flex';
        }

        function closeEditForm() {
            document.getElementById('EditFormOverlay').style.display = 'none';
        }

        function openAddForm() {
            document.getElementById('AddFormOverlay').classList.remove('hidden');
        }

        function closeAddForm() {
            document.getElementById('AddFormOverlay').classList.add('hidden');
        }

        function showDeclineModal(employeeId) {
            document.getElementById('declineEmployeeId').value = employeeId;
            document.getElementById('DeclineModal').classList.remove('hidden');
        }

        function hideDeclineModal() {
            document.getElementById('DeclineModal').classList.add('hidden');
        }

        function populateEditForm(id, firstName, lastName, email, position) {
            document.getElementById('editEmployeeId').value = id;
            document.getElementById('editFirstName').value = firstName;
            document.getElementById('editLastName').value = lastName;
            document.getElementById('editEmail').value = email;
            document.getElementById('editPosition').value = position;
            openEditForm();
        }

    </script>
</body>

</html>