<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/85550cfb5f.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
</head>

<body>
    <div class="w-full h-full py-5 px-10">
        <div class="informationMenus w-full h-[100px] flex space-x-5">
            <div class="w-full h-full p-5 border-2 cursor-pointer rounded-md bg-white shadow-sm hover:shadow-lg flex justify-between items-center">
                <div class="kiri">
                    <p class="font-bold text-3xl text-slate-600">120</p>
                    <p class="font-medium text-slate-300 text-lg">Total Menu</p>
                </div>
                <div class="bg-slate-100 flex justify-center items-center w-[60px] h-[60px] rounded-md">

                </div>
            </div>
            <div class="w-full h-full p-5 border-2 cursor-pointer rounded-md bg-white shadow-sm hover:shadow-lg flex justify-between items-center">
                <div class="kiri">
                    <p class="font-bold text-3xl text-slate-600">120</p>
                    <p class="font-medium text-slate-300 text-lg">Total Menu</p>
                </div>
                <div class="bg-slate-100 flex justify-center items-center w-[60px] h-[60px] rounded-md">

                </div>
            </div>
            <div class="w-full h-full p-5 border-2 cursor-pointer rounded-md bg-white shadow-sm hover:shadow-lg flex justify-between items-center">
                <div class="kiri">
                    <p class="font-bold text-3xl text-slate-600">120</p>
                    <p class="font-medium text-slate-300 text-lg">Total Menu</p>
                </div>
                <div class="bg-slate-100 flex justify-center items-center w-[60px] h-[60px] rounded-md">

                </div>
            </div>
            <div class="w-full h-full p-5 border-2 cursor-pointer rounded-md bg-white shadow-sm hover:shadow-lg flex justify-between items-center">
                <div class="kiri">
                    <p class="font-bold text-3xl text-slate-600">120</p>
                    <p class="font-medium text-slate-300 text-lg">Total Menu</p>
                </div>
                <div class="bg-slate-100 flex justify-center items-center w-[60px] h-[60px] rounded-md">

                </div>
            </div>
        </div>
        <div class="konten w-full h-[80%] my-5">
            <div class="w-full h-full rounded-md border-2 shadow-sm bg-white">
                <div class="relative h-full overflow-hidden flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="p-6 pb-0 mb-0 bg-white space-x-4 flex rounded-t-2xl">
                        <p class="text-xl text-slate-600 font-bold">Tabel Pesanan</p>
                        <p class="text-xl text-gray-400">|</p>
                        <p class="text-xl text-gray-400">Selesai 30%</p>
                    </div>
                    <div class="flex-auto w-full h-full px-0 pt-0 pb-2">
                        <div class="p-0 overflow-x-auto w-full h-full">
                            <table class=" w-full max-h-full mb-0 align-top border-gray-200 overflow-y-auto table-stri text-slate-500">
                                <thead class="bg-white border-b sticky top-0">
                                    <tr>
                                        <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Pemesan</th>
                                        <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Lokasi</th>
                                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Status</th>
                                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tanggal Pesan</th>
                                        <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70"></th>
                                    </tr>
                                </thead>
                                <tbody class="overflow-y-auto max-h-full">
                                    <tr class="hover:bg-slate-100 max-h-[70px]">
                                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <div class="flex px-2 py-1">
                                                <div class="flex flex-col justify-center">
                                                    <h6 class="mb-0 leading-normal text-sm">John Michael</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <p class="mb-0 font-semibold leading-tight text-xs">Jl. Wijoyo Mulyo No.21, Tamanan</p>
                                        </td>
                                        <td class="p-2 leading-normal text-center align-middle bg-transparent border-b text-sm whitespace-nowrap shadow-transparent">
                                            <div class="flex space-x-3 items-center justify-center">
                                                <span class="w-[10px] h-[10px] justify-center flex rounded-full bg-green-500"></span>
                                                <p>Sudah Diterima</p>
                                            </div>
                                        </td>
                                        <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <span class="font-semibold leading-tight text-xs text-slate-400">23/04/18</span>
                                        </td>
                                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <a href="javascript:;" class="font-semibold leading-tight text-xs text-slate-400"> Edit </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>