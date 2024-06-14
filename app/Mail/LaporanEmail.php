<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LaporanEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user; // Menyimpan data pengguna

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user; // Simpan data pengguna ke properti kelas
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Meneruskan data pengguna ke view blade
        return $this->view('emails.laporan', ['user' => $this->user]);
    }
}
