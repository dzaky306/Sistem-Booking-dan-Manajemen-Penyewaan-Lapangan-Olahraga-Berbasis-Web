
<?php

use App\Models\Field;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// HOME
Route::get('/', function () {
    $fields = Field::where('is_active', true)
        ->latest()
        ->take(3)
        ->get();

    return view('home', compact('fields'));
})->name('home');

// DAFTAR LAPANGAN
Route::get('/lapangan', function (Request $request) {
    $query = Field::where('is_active', true);

    if ($request->filled('q')) {
        $query->where('name', 'like', '%' . $request->q . '%');
    }

    if ($request->filled('kategori')) {
        $query->where('category', $request->kategori);
    }

    if ($request->filled('lokasi')) {
        $query->where('location', $request->lokasi);
    }

    $fields = $query->latest()->paginate(9)->withQueryString();

    return view('fields.index', compact('fields'));
})->name('fields.index');

// DETAIL LAPANGAN
Route::get('/lapangan/{field}', function (Field $field) {
    abort_unless($field->is_active, 404);

    return view('fields.show', compact('field'));
})->whereNumber('field')->name('fields.show');

// LOGIN
Route::get('/login', function () {
    return view('auth.login');
})->middleware('guest')->name('login');

// REGISTER
Route::get('/register', function () {
    return view('auth.register');
})->middleware('guest')->name('register');
