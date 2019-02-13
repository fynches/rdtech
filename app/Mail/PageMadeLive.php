<?php

namespace App\Mail;

use App\Domain\Page;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PageMadeLive extends Mailable
{
    use Queueable, SerializesModels;

    /*
     * @var Page
     */
    public $page;

    public function __construct(Page $page)
    {
        $this->page = $page;
    }

    public function build()
    {
        return $this
	        ->subject("Congratulation! Your Gift Page Is Now Live!")
	        ->view('emails.page-made-live');
    }
}
