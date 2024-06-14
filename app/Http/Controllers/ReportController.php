<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use GuzzleHttp\Client;
use App\Models\User;

class ReportController extends Controller
{
    public function createReport($id_user)
    {
        $client = new Client();

        $response = $client->get('https://mathgasing.cloud/api/scores/' . $id_user);
        $scorePenggunaData = json_decode($response->getBody()->getContents(), true);

        if (isset($scorePenggunaData['message']) && $scorePenggunaData['message'] == 'Data not found') {
            return response()->json(['message' => 'Data not found'], 404);
        }

        $scorePengguna = $scorePenggunaData['data'];

        $userResponse = $client->get('https://mathgasing.cloud/api/getUserById/' . $id_user);
        $userData = json_decode($userResponse->getBody()->getContents(), true);

        if (isset($userData['message']) && $userData['message'] == 'Data not found') {
            return response()->json(['message' => 'Data not found'], 404);
        }

        $user = $userData['user']; 

        $data = [
            'user' => $user,
            'scorePengguna' => $scorePengguna,
        ];

        $pdf = PDF::loadView('akun-siswa.report_template', $data);

        return $pdf->download('laporan-user-' . $id_user . '.pdf');
    }

    public function kirimLaporan($id_user)
    {
        // Panggil API untuk mendapatkan data user berdasarkan ID
        $response = Http::get('https://mathgasing.cloud/api/getUserById/'.$id_user);
        
        // Periksa apakah respons sukses
        if ($response->successful()) {
            // Ambil data user dari respons
            $user = $response->json();

            try {
                // Generate PDF dengan data user yang diterima
                $pdf = app('dompdf.wrapper')->loadView('emails.laporan', $user);
                // Simpan PDF secara lokal di folder penyimpanan
                $pdf->save(storage_path('app/public/report.pdf'));

                // Create instance of PHPMailer
                $mail = new PHPMailer(true);

                // Server settings
                $mail->isSMTP();
                $mail->Host = 'smtp.example.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'your-email@example.com';
                $mail->Password = 'your-password';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                // Recipients
                $mail->setFrom('from@example.com', 'Mailer');
                
                // Add a recipient
                if (isset($user['email'])) {
                    $mail->addAddress($user['email'], $user['name']);
                } else {
                    // Tangani kasus di mana kunci 'email' tidak tersedia
                    echo 'Error: Email address not found for the user.';
                    return;
                }

                // Attachments
                $mail->addAttachment(storage_path('app/public/report.pdf')); // Add attachments

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Here is your PDF';
                $mail->Body = 'Hi, please find attached the PDF.';
                $mail->AltBody = 'Hi, please find attached the PDF.';

                // Kirim email
                $mail->send();
                
                // Pesan sukses
                echo 'Message has been sent';
            } catch (Exception $e) {
                // Tangani kesalahan jika pengiriman email gagal
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            // Tangani kesalahan jika gagal memanggil API
            echo 'Failed to fetch user data from the API';
        }
    }

}