<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Vacancies;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PanelUserAppointmentMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    use Queueable, SerializesModels;

    public $user;
    public $vacancy;
    public $password;

    // Constructor expects App\Models\User, not App\Mail\User
    public function __construct(User $user, Vacancies $vacancy, $password)
    {
        $this->user = $user;
        $this->vacancy = $vacancy;
        $this->password = $password;
    }

    public function build()
    {
        return $this->subject('Appointment as Panelist')
            ->view('emails.panel_appointment')
            ->with([
                'userName' => $this->user->first_name,
                'vacancyTitle' => $this->vacancy->jobTitle,
                'password' => $this->password,
            ]);
    }

    /**
     * Get the message envelope.
     */


    /**
     * Get the message content definition.
     */


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
