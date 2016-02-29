<?php

namespace App\Jobs;

use App\iMailer;
use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmail extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(iMailer $mailer)
    {
        if(isset($this->data['sendRaw']) && $this->data['sendRaw'] == true)
        {
            $mailer->sendMailRaw($this->data['to'], $this->data['from'], $this->data['subject'], $this->data['body']);
        }
        else
        {
            $mailer->sendMail($this->data['to'], $this->data['from'],
                $this->data['subject'], $this->data['view'], $this->data['viewData']);
        }

    }
}
