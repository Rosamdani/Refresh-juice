<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/85550cfb5f.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
</head>

<body>
    <div class="flex h-screen overflow-hidden">
        <nav id="sidebar" class="bg-gray-800 w-16">
            <!-- Logo -->
            <div class="flex items-center justify-center h-16">
                <img src="../assets/logo/logo.png" alt="Logo" class="w-8 h-8">
            </div>

            <!-- Links -->
            <ul class="py-4  text-white">
                <li>
                    <div class="flex items-center w-full px-5 py-4  cursor-pointer hover:bg-blue-500 hover:bg-opacity-50"
                        data-page="dashboard">
                        <div class="flex items-center">
                            <i class="fas fa-home"></i>
                            <span id="dashboardText" class="textLink ml-2 hidden linkText">Dashboard</span>
                        </div>
                    </div>

                </li>
                <li>
                    <div class="flex items-center w-full px-5 py-4 cursor-pointer hover:bg-blue-500 hover:bg-opacity-50"
                        data-page="order">
                        <i class="fas fa-clipboard-list"></i>
                        <span id="orderText" class="textLink ml-2 hidden linkText">Order</span>
                    </div>
                </li>
                <li>
                    <div class="flex items-center w-full px-5 py-4 cursor-pointer hover:bg-blue-500 hover:bg-opacity-50"
                        data-page="settings">
                        <i class="fas fa-cog"></i>
                        <span class="textLink ml-2 hidden linkText">Settings</span>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="kanan" class="w-full bg-gray-100">
            <navbar class="w-full bg-white h-16 flex justify-between items-center px-10">
                <div class="flex space-x-3 items-center">
                    <button id="sidebarToggle" class="text-slate-600 p-2 rounded">
                        <i class="fas fa-bars"></i>
                    </button>
                    <p id="textPaging" class="text-2xl font-bold text-slate-600">Dashboard</p>
                </div>
                <div class="infoProfile flex space-x-5 text-gray-500">
                    <p>Tanggal</p>
                    <p>Notification</p>
                    <p>|</p>
                    <p>Profile</p>
                </div>
            </navbar>
            <div id="content" class="w-full h-full">
                <!-- Content -->
            </div>
        </div>
    </div>

</body>

<script src="../js/admin/navbar.js"></script>

</html>