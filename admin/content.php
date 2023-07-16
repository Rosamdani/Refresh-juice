<?php
$page = $_GET['page'];

if ($page === 'dashboard') {
  include 'dash.php';
  // Tambahkan konten dashboard di sini
} elseif ($page === 'order') {
  echo '<h2>Order</h2>';
  // Tambahkan konten order di sini
} elseif ($page === 'settings') {
  echo '<h2>Settings</h2>';
  // Tambahkan konten settings di sini
} else {
  echo '<h2>Page Not Found</h2>';
}
