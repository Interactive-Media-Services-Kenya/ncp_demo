<?php

namespace App\Console\Commands;

use App\Mail\SendEscalationMail;
use Illuminate\Console\Command;
use App\Models\Complaint;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class EscalateComplaintCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'escalate:complaint';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email Sent Successfully';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        // ? Testing Cron:
        // \Log::info("Cron is working fine!");

        // ? Fetch All Complaints not resolved in 48hrs
        $complaints = Complaint::where('status', 0)->get();

        foreach ($complaints as $complaint) {
            // Send Escalation Mail to Admin.
            if ((Carbon::parse($complaint->created_at)->diffInDays(Carbon::parse($complaint->updated_at))) == 2) {

                $receiver_email = User::with([
                    'roles' => function ($query) {
                        $query->where('id', '=', '1');
                    }
                ])->value('email');

                $message = "Hello, Complaint : $complaint->title created on $complaint->created_at has not been resolved";
                $details = [
                    'title' => 'Complaint Not Resolved',
                    'body' => $message,
                ];

                $mail = Mail::to($receiver_email)->send(new SendEscalationMail($details));
               if($mail){
                    \Log::info("Mail Sent");
                } else {
                    \Log::info("Mail Not Sent");
                }
            }
        }
    }
}
