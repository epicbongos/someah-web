<?php

namespace App\Jobs;

use App\Mail\SalaryEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class SendSalaryEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
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
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Mail::to('test@example.com')->send(new SalaryEmail($this->details));
        Mail::send('admin.pages.salary.email-new', $this->details, function ($message) {
            $message->to($this->details['salary_detail']->employee->email)
                ->subject($this->details['salary_detail']->salary->keterangan);
            $message->from('no-reply@someah.id', 'PT. SOMEAH KREATIF NUSANTARA');
        });
    }
}