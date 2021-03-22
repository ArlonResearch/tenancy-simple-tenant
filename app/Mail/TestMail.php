<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Tenancy\Facades\Tenancy;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    public function build()
    {
        dump(Tenancy::getTenant()->toArray());

        return $this->view('view.name');
    }
}
