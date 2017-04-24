<?php

Route::get('/', function () {
  return redirect()->route('login');
});

Auth::routes();

Route::get('/dashboard', function() {
  return view('dashboard');
});
