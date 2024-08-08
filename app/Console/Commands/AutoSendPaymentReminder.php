<?php

namespace App\Console\Commands;

use App\Http\Controllers\NotificationController;
use App\Models\Payment;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;

class AutoSendPaymentReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sms:auto-send-payment-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $notification;

    public function __construct(NotificationController $notification)
    {
        parent::__construct();
        $this->notification = $notification;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $payments = Payment::where('status', 1)->whereIn('paid_status', ['full_due', 'partial_paid'])
            //     // three days before the due date
            //     // ->where('updated_at', '>=', Carbon::mont()->subDays(3))
            ->get();
        // // // ->where('updated_at', '>=', Carbon::now() - Carbon::da)->get();
        foreach ($payments as $payment) {

            if (Carbon::parse($payment->update_at)->diffInDays(Carbon::now()) >= 26) {
                try {
                    $this->notification->sendSms('payment_reminder', $payment->invoice);
                } catch (Exception $e) {
                    info('This is and test' . $e->getMessage());
                }
                // $this->notification->sendSms('payment_reminder', $payment->invoice);
            }
            // $this->notification->sendSms('payment_reminder', $payment->invoice);
        }
        // if (Carbon::parse('2024-07-01')->diffInDays(Carbon::now()) >= 26) {
        //     info('This is and test' . Carbon::parse('2024-08-01')->addDays(26));
        // }
        // info('This is and test' . Carbon::parse('2024-08-01')->addDays(26));
        return 0;
    }
}
