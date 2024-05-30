<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'ppc_portal');

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$sql = "SELECT * FROM appointments";
$result = mysqli_query($link, $sql);

// Check if there are any appointments
if (mysqli_num_rows($result) > 0) {
    $appointments = array();
    // Fetch each row of data
    while ($row = mysqli_fetch_assoc($result)) {
        $appointments[] = $row;
    }
}

mysqli_close($link);

session_start();
$user_role = $_SESSION['user_role'] ?? '';

function isAdmin($role)
{
    return in_array($role, ['admin']);
}

function isHR($role)
{
    return in_array($role, ['admin', 'hr']);
}

function isFinance($role)
{
    return in_array($role, ['admin', 'finance']);
}

function isFrontdesk($role)
{
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
                    <div
                        class="hr-content absolute top-[1.5rem] w-[13rem] left-[-2rem] hidden bg-[#a30000] rounded-xl py-[.5rem] px-[.5rem]">
                        <a href="./ManageEmployees.php"
                            class="text-[.9rem] font-[400] text-white font-[600] duration-300 ease hover:bg-black w-full px-[.5rem] py-[.5rem] rounded-xl text-center">
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
                    <div
                        class="hr-content absolute top-[1.5rem] w-[13rem] left-[-4rem] hidden bg-[#a30000] rounded-xl py-[.5rem] px-[.5rem]">
                        <a href="./ManageFinance.php"
                            class="text-[.9rem] font-[400] text-white font-[600] duration-300 ease hover:bg-black w-full px-[.5rem] py-[.5rem] rounded-xl text-center">
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
                    <div
                        class="hr-content absolute top-[1.5rem] w-[13rem] left-[-3rem] hidden bg-[#a30000] rounded-xl py-[.5rem] px-[.5rem]">
                        <a href="./ManageAppointments.php"
                            class="text-[.9rem] font-[400] text-white font-[600] duration-300 ease hover:bg-black w-full px-[.5rem] py-[.5rem] rounded-xl text-center">
                            Manage Appointments
                        </a>
                    </div>
                </div>
            <?php endif; ?>

            <form action="../../backend/logout.php">
                <button
                    class="text-[1rem] text-white font-[400] text-black bg-[#a30000] px-[1rem] py-[.3rem] duration-300 ease hover:scale-[.98] hover:opacity-[.7]">
                    Logout
                </button>
            </form>
        </div>
    </header>
    <div class="w-full h-[93vh] flex flex-col justify-start items-center px-[5rem]">
        <div class="w-full h-[10%] flex justify-between items-center">
            <h1 class="my-[1rem] text-black text-[2rem] font-[700]">MANAGE APPOINTMENTS</h1>
            <div class="w-[60%] h-[70%] flex justify-between items-center">
                <select name="" id="filterSelect"
                    class="w-[15%] h-full border border-black text-[.8rem] text-center rounded-xl">
                    <option value="0">Select a filter</option>
                    <option value="1">First Name</option>
                    <option value="2">Middle Name</option>
                    <option value="3">Last Name</option>
                </select>
                <input type="text" id="searchInput" placeholder="Search here..."
                    class="w-[83%] h-full px-[1rem] rounded-[1rem] border border-black outline-none">
            </div>
        </div>
        <div class="overflow-auto w-full h-[88%] flex flex-col justify-start items-center">
            <table id="appointmentsTable" class="w-full table-fixed">
                <thead class="sticky top-0 h-[3rem] bg-[#a30000]">
                    <tr class="border border-black text-black">
                        <th class="border border-black text-white">ID</th>
                        <th class="border border-black text-white">First Name</th>
                        <th class="border border-black text-white">Middle Name</th>
                        <th class="border border-black text-white">Last Name</th>
                        <th class="border border-black text-white">Contact Number</th>
                        <th class="border border-black text-white">Email</th>
                        <th class="border border-black text-white">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($appointments)) {
                        foreach ($appointments as $appointment) {
                            echo "<tr class='border border text-black'>";
                            echo "<td class='border border-black text-black px-[1rem] text-center truncate'>" . $appointment['id'] . "</td>";
                            echo "<td class='border border-black text-black px-[1rem] text-center truncate'>" . $appointment['first_name'] . "</td>";
                            echo "<td class='border border-black text-black px-[1rem] text-center truncate'>" . $appointment['middle_name'] . "</td>";
                            echo "<td class='border border-black text-black px-[1rem] text-center truncate'>" . $appointment['last_name'] . "</td>";
                            echo "<td class='border border-black text-black px-[1rem] text-center truncate'>" . $appointment['contact_number'] . "</td>";
                            echo "<td class='border border-black text-black px-[1rem] text-center truncate'>" . $appointment['email'] . "</td>";
                            echo "<td class='border border-black text-black px-[1rem] text-center truncate'>";
                            echo "<button class='accept-button px-[1.5rem] py-[.3rem] mx-[.2rem] my-[.4rem] bg-[#3076f0] text-[.9rem] text-white font-[600] rounded-xl duration-300 ease hover:scale-[.98] hover:opacity-[.6]' onclick='showAcceptModal(" . $appointment['id'] . ")'>Accept</button>";
                            echo "<button class='decline-button px-[1.5rem] py-[.3rem] mx-[.2rem] my-[.4rem] bg-[#de5021] text-[.9rem] text-white font-[600] rounded-xl duration-300 ease hover:scale-[.98] hover:opacity-[.6]' onclick='showDeclineModal(" . $appointment['id'] . ")'>Decline</button>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7' class='text-center'>No appointments found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Accept Modal -->
    <div id="acceptModal"
        class="hidden absolute top-0 left-0 w-full h-screen bg-gray-900 bg-opacity-50 flex justify-center items-center z-[10]">
        <div class="bg-white p-8 rounded-md">
            <p>Are you sure you want to accept this appointment?</p>
            <div class="flex justify-center mt-4">
                <button id="acceptYesButton"
                    class="bg-[#3076f0] duration-300 ease hover:scale-[.98] hover:opacity-[.6] text-white font-bold py-2 px-4 rounded mr-2">Yes</button>
                <button onclick="hideAcceptModal()"
                    class="bg-[#de5021] duration-300 ease hover:scale-[.98] hover:opacity-[.6] text-white font-bold py-2 px-4 rounded">No</button>

            </div>
        </div>
    </div>

    <!-- Decline Modal -->
    <div id="declineModal"
        class="hidden absolute top-0 left-0 w-full h-screen bg-gray-900 bg-opacity-50 flex justify-center items-center z-[10]">
        <div class="bg-white p-8 rounded-md">
            <p>Are you sure you want to decline this appointment?</p>
            <div class="flex justify-center mt-4">
                <button onclick="declineAppointment()"
                    class="bg-[#3076f0] duration-300 ease hover:scale-[.98] hover:opacity-[.6] text-white font-bold py-2 px-4 rounded mr-2">Yes</button>
                <button onclick="hideDeclineModal()"
                    class="bg-[#de5021] duration-300 ease hover:scale-[.98] hover:opacity-[.6] text-white font-bold py-2 px-4 rounded">No</button>
            </div>
        </div>
    </div>

    <script>
        function showAcceptModal(id) {
            const modal = document.getElementById('acceptModal');
            modal.classList.remove('hidden');
            const acceptButton = document.getElementById('acceptYesButton');
            acceptButton.dataset.appointmentId = id;
        }

        function hideAcceptModal() {
            const modal = document.getElementById('acceptModal');
            modal.classList.add('hidden');
        }

        function showDeclineModal(id) {
            const modal = document.getElementById('declineModal');
            modal.classList.remove('hidden');
        }

        function hideDeclineModal() {
            const modal = document.getElementById('declineModal');
            modal.classList.add('hidden');
        }

        document.getElementById('acceptYesButton').addEventListener('click', function () {
            const appointmentId = this.dataset.appointmentId;
            console.log("Clicked Yes on accept modal for appointment ID:", appointmentId);

            fetch('accept_appointment.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id: appointmentId })
            })
                .then(response => response.text())
                .then(text => {
                    console.log("Response text:", text);
                    try {
                        const data = JSON.parse(text);
                        console.log("Parsed JSON response:", data);
                        if (data.success) {
                            alert('Appointment accepted successfully!');
                            location.reload(); // Reload the page to update the list
                        } else {
                            alert('Failed to accept appointment: ' + data.message);
                        }
                        hideAcceptModal();
                    } catch (error) {
                        console.error("Error parsing JSON:", error);
                        alert('Failed to accept appointment due to an invalid response.');
                    }
                })
                .catch(error => {
                    console.error('Error during fetch:', error);
                    alert('Failed to accept appointment due to a network error.');
                });
        });



        const searchInput = document.getElementById('searchInput');
        const filterSelect = document.getElementById('filterSelect');

        searchInput.addEventListener('input', function () {
            const filter = searchInput.value.toLowerCase();
            const filterBy = parseInt(filterSelect.value);
            const table = document.getElementById('appointmentsTable');
            const rows = table.getElementsByTagName('tr');

            for (let i = 1; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName('td');
                let match = false;

                if (filterBy > 0 && cells[filterBy]) {
                    const cellText = cells[filterBy].textContent || cells[filterBy].innerText;
                    if (cellText.toLowerCase().indexOf(filter) > -1) {
                        match = true;
                    }
                } else {
                    for (let j = 0; j < cells.length; j++) {
                        if (cells[j]) {
                            const cellText = cells[j].textContent || cells[j].innerText;
                            if (cellText.toLowerCase().indexOf(filter) > -1) {
                                match = true;
                                break;
                            }
                        }
                    }
                }

                if (match) {
                    rows[i].style.display = '';
                } else {
                    rows[i].style.display = 'none';
                }
            }
        });
    </script>
</body>

</html>