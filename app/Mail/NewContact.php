<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewContact extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    // to manage email data we set a instance variable
    // being public it will be available from all laravel files
    public $lead;

    public function __construct($lead)
    {
        // parameter of the new contact = instance variable
        $this->lead = $lead;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            replyTo: $this->lead->address,
            subject: 'New Contact Request',
        );
    }

   /*  public function build(Request $request)
    {
        $data = [
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
            'address' => $request->input('address'),
            'message' => $request->input('messaggio'),
        ];

        return $this->from($data['address'], $data['name'])
            ->subject($data['message'])
            ->view('admin.messages.mail.messages');

    } */

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'admin.messages.mail.messages',
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
