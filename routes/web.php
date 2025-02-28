<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('developer.dashboard');
})->name('developer.dashboard');

Route::get('/client', function () {
    return view('client.dashboard');
})->name('client.dashboard');

Route::get('/admin', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

// Route::get('/', function () {
//     // if (auth()->check()) {
//         switch (auth()->user()->role) {
//             case 'admin':
//                 return redirect()->route('admin.dashboard');
//             case 'developer':
//                 return redirect()->route('developer.dashboard');
//             case 'client':
//                 return redirect()->route('client.dashboard');
//         }
//     }
//     // return view('index'); // Home page for guests
// // });
