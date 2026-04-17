<?php

namespace App\Mail;

use App\Models\PeminjamanDetail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StrukPeminjamanMail extends Mailable
{
    use Queueable, SerializesModels;

    public $detail;
    protected $pdfContent;

    /**
     * Create a new message instance.
     */
    public function __construct(PeminjamanDetail $detail, $pdfContent)
    {
        $this->detail = $detail;
        $this->pdfContent = $pdfContent;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Struk Peminjaman Alat - #' . $this->detail->peminjaman->kode_peminjaman)
                    ->view('emails.struk_peminjaman')
                    ->attachData($this->pdfContent, 'Struk-' . $this->detail->peminjaman->kode_peminjaman . '.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}
