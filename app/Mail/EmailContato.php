<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailContato extends Mailable
{
    use Queueable, SerializesModels;

    public $mail, $telefone, $nome, $mensagem;

    /**
     * Create a new message instance.
     */
    public function __construct($mail, $nome, $telefone,  $mensagem )
    {
        $this->mail = $mail;
        $this->telefone = $telefone;
        $this->nome = $nome;
        $this->mensagem = $mensagem;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Email Contato',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.emai-contato',
            with: [
                'mail'=> $this->mail,
                'telefone'=> $this->telefone,
                'nome'=> $this->nome,  
                'mensagem' => $this->mensagem,  
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
