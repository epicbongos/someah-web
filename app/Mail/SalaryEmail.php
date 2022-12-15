<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SalaryEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    protected $details;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('admin.pages.salary.try1-email', $this->details); // this works
        return $this->from('no-reply@someah.id', 'PT. SOMEAH KREATIF NUSANTARA')
            ->subject($this->details['salary_detail']->salary->keterangan)
            ->view('admin.pages.salary.email-new', $this->details);
    }
}