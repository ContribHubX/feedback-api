<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
  use Queueable, SerializesModels;

  private string $name;
  private string $resetLink;

  public function __construct(string $name, string $resetLink)
  {
      $this->name = $name;
      $this->resetLink = $resetLink;
  }

  public function envelope(): Envelope
  {
      return new Envelope(
          subject: 'Reset Your Password',
      );
  }

  public function content(): Content
  {
      return new Content(
          view: 'emails.reset-password',
          with: [
              "name" => $this->name,
              "resetLink" => $this->resetLink
          ]
      );
  }

  public function attachments(): array
  {
      return [];
  }
}
