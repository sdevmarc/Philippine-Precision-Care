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
    <title>PPC | Manage Finance</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./css/Dashboard.css">
    <link rel="stylesheet" href="../index.css">
</head>

<body>
    <header class="w-full h-[7vh] px-[10rem] flex justify-between items-center z-[2] bg-white">
        <div class="overflow-hidden w-[30%] h-full">
            <img src="../assets/logo-no-background.png" alt="Logo" class="object-contain w-full h-full">
        </div>
        <div class="w-[70%] h-full flex justify-end items-center gap-[2rem]">
            <?php if (isHR($user_role)): ?>
                <div class="hr relative">
                    <button class="text-[1rem] font-[400] text-black">Human Resource</button>
                    <div
                        class="hr-content absolute top-[1.5rem] w-[13rem] left-[-2rem] hidden bg-[#a30000] rounded-xl py-[.5rem] px-[.5rem]">
                        <a href="./ManageEmployees.php"
                            class="text-[.9rem] font-[400] text-white font-[600] duration-300 ease hover:bg-black w-full px-[.5rem] py-[.5rem] rounded-xl text-center">Manage
                            Employees</a>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (isFinance($user_role)): ?>
                <div class="hr relative">
                    <button class="text-[1rem] font-[400] text-black">Finance</button>
                    <div
                        class="hr-content absolute top-[1.5rem] w-[13rem] left-[-4rem] hidden bg-[#a30000] rounded-xl py-[.5rem] px-[.5rem]">
                        <a href="./ManageFinance.php"
                            class="text-[.9rem] font-[400] text-white font-[600] duration-300 ease hover:bg-black w-full px-[.5rem] py-[.5rem] rounded-xl text-center">Manage
                            Finance</a>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (isFrontdesk($user_role)): ?>
                <div class="hr relative">
                    <button class="text-[1rem] font-[400] text-black">Appointment</button>
                    <div
                        class="hr-content absolute top-[1.5rem] w-[13rem] left-[-3rem] hidden bg-[#a30000] rounded-xl py-[.5rem] px-[.5rem]">
                        <a href="./ManageAppointments.php"
                            class="text-[.9rem] font-[400] text-white font-[600] duration-300 ease hover:bg-black w-full px-[.5rem] py-[.5rem] rounded-xl text-center">Manage
                            Appointments</a>
                    </div>
                </div>
            <?php endif; ?>

            <form action="../../backend/logout.php" method="post">
                <button
                    class="text-[1rem] text-white font-[400] text-black bg-[#a30000] px-[1rem] py-[.3rem] duration-300 ease hover:scale-[.98] hover:opacity-[.7]">Logout</button>
            </form>
        </div>
    </header>
    <div class="w-full h-[93vh] flex flex-col justify-start items-center px-[5rem]">
        <div class="w-full h-[10%] flex justify-between items-center">
            <h1 class="my-[1rem] text-black text-[2rem] font-[700]">MANAGE FINANCE</h1>
            <div class="w-[60%] h-[70%] flex justify-between items-center">
                <select name="sort" id="sort"
                    class="w-[15%] h-full border border-black text-[.8rem] text-center rounded-xl">
                    <option value="last_name">Last Name</option>
                    <option value="first_name">First Name</option>
                    <option value="middle_name">Middle Name</option>
                </select>
                <input type="text" placeholder="Search here..."
                    class="w-[73%] h-full px-[1rem] rounded-[1rem] border border-black outline-none">
                <button onclick="openAddForm()"
                    class="w-[10%] h-[90%] bg-[#3076f0] text-[.9rem] text-white font-[600] rounded-xl duration-300 ease hover:scale-[.98] hover:opacity-[.6]">Add</button>
            </div>
        </div>
        <div class="overflow-auto w-full h-[88%] flex flex-col justify-start items-center">
            <table class="w-full table-fixed">
                <thead class="sticky top-0 h-[3rem] bg-[#a30000]">
                    <tr class="border border-black text-black">
                        <th class="border border-black text-white">ID</th>
                        <th class="border border-black text-white">First Name</th>
                        <th class="border border-black text-white">Middle Name</th>
                        <th class="border border-black text-white">Last Name</th>
                        <th class="border border-black text-white">Contact Number</th>
                        <th class="border border-black text-white">Email</th>
                        <th class="border border-black text-white">Appointment Date</th>

                        <th class="border border-black text-white">Billing</th>
                        <th class="border border-black text-white">Actions</th>
                    </tr>
                </thead>
                <tbody id="financeTableBody">
                    <?php
                    include 'db_connection.php';
                    $conn = OpenCon();

                    $sql = "SELECT * FROM finance_approved_appointments";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td class='border border-black text-black px-[1rem] text-center truncate'>{$row['id']}</td>
                                <td class='border border-black text-black px-[1rem] text-center truncate'>{$row['first_name']}</td>
                                <td class='border border-black text-black px-[1rem] text-center truncate'>{$row['middle_name']}</td>
                                <td class='border border-black text-black px-[1rem] text-center truncate'>{$row['last_name']}</td>
                                <td class='border border-black text-black px-[1rem] text-center truncate'>{$row['contact_number']}</td>
                                <td class='border border-black text-black px-[1rem] text-center truncate'>{$row['email']}</td>
                                <td class='border border-black text-black px-[1rem] text-center truncate'>{$row['appointment_date']}</td>
                              
                                <td class='border border-black text-black px-[1rem] text-center truncate'>{$row['billing']}</td>
                                <td class='border border-black text-black px-[1rem] text-center truncate'>
                                    <button onclick='openEditForm({$row['id']})' class='edit-button px-[1.5rem] py-[.3rem] mx-[.2rem] my-[.4rem] bg-[#3076f0] text-[.9rem] text-white font-[600] rounded-xl duration-300 ease hover:scale-[.98] hover:opacity-[.6]'>Edit</button>
                                    <button onclick='deleteAppointment({$row['id']})' class='delete-button px-[1.5rem] py-[.3rem] mx-[.2rem] my-[.4rem] bg-[#de5021] text-[.9rem] text-white font-[600] rounded-xl duration-300 ease hover:scale-[.98] hover:opacity-[.6]'>Delete</button>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='10' class='border border-black text-black px-[1rem] text-center'>No records found</td></tr>";
                    }

                    CloseCon($conn);
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div id="AddFormOverlay"
        class="hidden absolute top-0 left-0 w-full h-screen bg-[#000] bg-opacity-[.3] flex justify-center items-center z-[1]">
        <form id="AddForm" action=""
            class="relative w-[70rem] h-[35rem] bg-white rounded-xl shadow-[0_10px_15px_-3px_rgba(0,0,0,0.1)] flex flex-col justify-start items-center">
            <div onclick="closeAddForm()"
                class="absolute right-[1rem] top-[1rem] cursor-pointer text-[1.5rem] font-[500]">&times;</div>
            <h1 class="my-[1rem] text-black text-[1.5rem] font-[700]">ADD FINANCE</h1>
            <div class="w-full h-[90%] flex justify-center items-start flex-wrap overflow-auto">
                <input type="text" id="first_name" name="first_name" placeholder="First Name" class="input-field">
                <input type="text" id="middle_name" name="middle_name" placeholder="Middle Name" class="input-field">
                <input type="text" id="last_name" name="last_name" placeholder="Last Name" class="input-field">
                <input type="text" id="contact_number" name="contact_number" placeholder="Contact Number"
                    class="input-field">
                <input type="email" id="email" name="email" placeholder="Email" class="input-field">
                <input type="date" id="appointment_date" name="appointment_date" class="input-field">

                <input type="number" id="billing" name="billing" placeholder="Billing Amount" class="input-field">
            </div>
            <button type="submit" class="submit-button">SUBMIT</button>
        </form>
    </div>

    <div id="EditFormOverlay"
        class="hidden absolute top-0 left-0 w-full h-screen bg-[#000] bg-opacity-[.3] flex justify-center items-center z-[1]">
        <form id="EditForm" action=""
            class="relative w-[70rem] h-[35rem] bg-white rounded-xl shadow-[0_10px_15px_-3px_rgba(0,0,0,0.1)] flex flex-col justify-start items-center">
            <div onclick="closeEditForm()"
                class="absolute right-[1rem] top-[1rem] cursor-pointer text-[1.5rem] font-[500]">&times;</div>
            <h1 class="my-[1rem] text-black text-[1.5rem] font-[700]">EDIT FINANCE</h1>
            <div class="w-full h-[90%] flex justify-center items-start flex-wrap overflow-auto">
                <input type="hidden" id="edit_id" name="id">
                <input type="text" id="edit_first_name" name="first_name" placeholder="First Name" class="input-field">
                <input type="text" id="edit_middle_name" name="middle_name" placeholder="Middle Name"
                    class="input-field">
                <input type="text" id="edit_last_name" name="last_name" placeholder="Last Name" class="input-field">
                <input type="text" id="edit_contact_number" name="contact_number" placeholder="Contact Number"
                    class="input-field">
                <input type="email" id="edit_email" name="email" placeholder="Email" class="input-field">
                <input type="date" id="edit_appointment_date" name="appointment_date" class="input-field">

                <input type="number" id="edit_billing" name="billing" placeholder="Billing Amount" class="input-field">
            </div>
            <button type="submit" class="submit-button">SUBMIT</button>
        </form>
    </div>

    <script>
        const addFormOverlay = document.getElementById("AddFormOverlay");
        const editFormOverlay = document.getElementById("EditFormOverlay");

        function openAddForm() {
            addFormOverlay.classList.remove("hidden");
        }

        function closeAddForm() {
            addFormOverlay.classList.add("hidden");
        }

        function openEditForm(id) {
            fetch(`fetch_appointment.php?id=${id}`)
                .then(response => response.text())
                .then(text => {
                    console.log('Raw response:', text); // Log the raw response for debugging
                    const data = JSON.parse(text); // Parse the response as JSON
                    if (data.success) {
                        document.getElementById("edit_id").value = data.data.id;
                        document.getElementById("edit_first_name").value = data.data.first_name;
                        document.getElementById("edit_middle_name").value = data.data.middle_name;
                        document.getElementById("edit_last_name").value = data.data.last_name;
                        document.getElementById("edit_contact_number").value = data.data.contact_number;
                        document.getElementById("edit_email").value = data.data.email;
                        document.getElementById("edit_appointment_date").value = data.data.appointment_date;
                        document.getElementById("edit_billing").value = data.data.billing;
                        editFormOverlay.classList.remove("hidden");
                    } else {
                        alert('Failed to fetch appointment: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error fetching appointment:', error);
                    alert('Failed to fetch appointment due to a network error.');
                });
        }

        function closeEditForm() {
            editFormOverlay.classList.add("hidden");
        }

        function deleteAppointment(id) {
            if (confirm('Are you sure you want to delete this appointment?')) {
                fetch(`delete_appointment.php?id=${id}`, { method: 'DELETE' })
                    .then(response => response.json())
                    .then(result => {
                        if (result.success) {
                            window.location.reload();
                        } else {
                            alert('Failed to delete the appointment.');
                        }
                    });
            }
        }
    </script>
</body>

</html>