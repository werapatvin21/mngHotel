<?php
return [
    ['url' => 'reservation', 'title' => 'Reservation', 'icon' => 'fas fa-home'],
    ['url' => 'guest', 'title' => 'Guest', 'icon' => 'fas fa-user-friends'],
    ['url' => 'stock', 'title' => 'Stock', 'icon' => 'fas fa-store'],
    ['url' => 'staff', 'title' => 'Staff', 'icon' => 'fas fa-user-alt'],
//    ['url' => 'booking', 'title' => 'Booking Report', 'icon' => 'fas fa-file'],
//    ['url' => 'setting', 'title' => 'Setting', 'icon' => 'fas fa-users-cog'],

     ['url' => '', 'title' => 'Setting', 'icon' => 'fas fa-edit', 'submenu' => [
         ['url' => 'room', 'title' => 'Room', 'icon' => 'fas fa-home'],
         ['url' => 'promotion', 'title' => 'Promotion', 'icon' => 'fas fa-bullhorn'],
         ['url' => 'services', 'title' => 'Services', 'icon' => 'fas fa-dollar'],
    ]],

          ['url' => 'report', 'title' => 'Report', 'icon' => 'fas fa-chart-bar',
              'submenu' => [
//        ['url' => 'report', 'title' => 'รายงานทุนกำไร', 'icon' => 'fas fa-file'],
          ['url' => 'report', 'title' => 'Report', 'icon' => 'fas fa-file'],
//        ['url' => 'report', 'title' => 'รายรับรายจ่าย', 'icon' => 'fas fa-file'],
//        ['url' => 'report', 'title' => 'รายงานแบบประเภทห้องพัก', 'icon' => 'fas fa-file'],
//        ['url' => 'report', 'title' => 'รายงานสถิติลูกค้า', 'icon' => 'fas fa-file'],
    ]],




];
