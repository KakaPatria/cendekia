<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class SendKonfirmasiTryoutMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pendaftaran;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pendaftaran)
    {
        $this->pendaftaran = $pendaftaran;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            //from: new Address('lms@lbbcendekia.com', 'Admin (No Replay)'),
            subject: 'Konfrimasi Pendaftaran Tryout',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {

        //dd($this->pendaftaran);
        return new Content(
            view: 'mail.send_konfirmasi_tryout',
            with: [
                'pendaftaran' => $this->pendaftaran,
            ],

        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
