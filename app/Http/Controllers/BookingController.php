<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Field;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class BookingController extends Controller
{


    // Menampilkan riwayat booking pengguna
    public function index()
    {
       $bookings = Booking::where('user_id', Auth::id())
    ->with('field')
    ->latest()
    ->paginate(10);

        return view('bookings.index', compact('bookings'));
    }

    public function store(Request $request, Field $field)
    {
        // Validasi input booking
        $validated = $request->validate([
            'booking_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|date_format:H:i',
            'duration' => 'required|integer|min:1|max:3',
        ]);

        // Hitung waktu selesai
        $start = Carbon::createFromFormat(
            'H:i',
            $validated['start_time']
        );

        $end = $start->copy()->addHours(
    (int) $validated['duration']
);

        // Cek jam operasional (08.00 - 22.00)
        if ($start->hour < 8 || $end->format('H:i') > '22:00') {
            throw ValidationException::withMessages([
                'start_time' => 'Booking hanya tersedia pukul 08.00 sampai 22.00.',
            ]);
        }

        // Cek jadwal yang bentrok
        $isBooked = Booking::where('field_id', $field->id)
            ->where('booking_date', $validated['booking_date'])
            ->whereIn('status', ['pending', 'confirmed'])
            ->where('start_time', '<', $end->format('H:i:s'))
            ->where('end_time', '>', $start->format('H:i:s'))
            ->exists();

        if ($isBooked) {
            throw ValidationException::withMessages([
                'start_time' => 'Jadwal tersebut sudah dipesan. Silakan pilih jam lain.',
            ]);
        }

        // Hitung total harga dari database
        $totalPrice = (float) $field->price_per_hour * (int) $validated['duration'];

        // Simpan booking
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'field_id' => $field->id,
            'booking_date' => $validated['booking_date'],
            'start_time' => $start->format('H:i:s'),
            'duration' => $validated['duration'],
            'end_time' => $end->format('H:i:s'),
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        return redirect()
            ->route('fields.show', $field->id)
            ->with('success', 'Booking berhasil dibuat! Silakan lanjutkan proses pembayaran.');
    }
}
