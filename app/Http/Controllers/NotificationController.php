<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Notification;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    //
    public function index()
    {
        $notifications = Notification::all();
        return view('backend.notification.index', compact('notifications'));
    }

    public function create()
    {
        // $invoice = Invoice::find(3);
        // $this->sendSms('new_sale', $invoice);
        return view('backend.notification.add');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'message' => 'required',
            'status' => 'required',
        ]);

        Notification::create($request->all());
        return redirect()->route('all.notification')->with('success', 'Notification created successfully');
    }

    public function edit($id)
    {
        $notification = Notification::find($id);
        return view('backend.notification.edit', compact('notification'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'message' => 'required',
            'status' => 'required',
        ]);
        // unset($request['id']);
        $notification = Notification::find($request->id);
        $notification->update($request->all());
        return redirect()->route('all.notification')->with('success', 'Notification updated successfully');
    }

    public function delete($id)
    {
        Notification::find($id)->delete();
        return redirect()->route('all.notification')->with('success', 'Notification deleted successfully');
    }

    public function sendSms($template_name, $invoice)
    {
        $notification = Notification::where('name', $template_name)->first();
        $message = $notification->message;

        // replace placeholders with actual values
        if (strpos($message, '{invoice_no}') !== false) {
            $message = str_replace('{invoice_no}', $invoice->invoice_no, $message);
        }

        if (strpos($message, '{invoice_date}') !== false) {
            $message = str_replace('{invoice_date}', $invoice->date, $message);
        }

        if (strpos($message, '{customer_name}') !== false) {
            $message = str_replace('{customer_name}', $invoice->customer->name, $message);
        }

        if (strpos($message, '{total_amount}') !== false) {
            $message = str_replace('{total_amount}', number_format($invoice->total_amount, 2), $message);
        }

        if (strpos($message, '{total_paid}') !== false) {
            $message = str_replace('{total_paid}', number_format($invoice->payment->paid_amount, 2), $message);
        }

        if (strpos($message, '{due_amount}') !== false) {
            if ($invoice->payment->due_amount == 0) {
                $message = str_replace('{due_amount}', ' ', $message);
            } else {
                $message = str_replace('{due_amount}', 'Remaining with ' . number_format($invoice->payment->due_amount, 2) . ' to pay back', $message);
            }
        }

        if (strpos($message, '{paid_date}') !== false) {
            $message = str_replace('{paid_date}', $invoice->paymentDetail[0]->date, $message);
        }

        if (strpos($message, '{paid_amount}') !== false) {
            $message = str_replace('{paid_amount}', number_format($invoice->paymentDetail[0]->current_paid_amount, 2), $message);
        }

        if (strpos($message, '{plot_no}') !== false) {
            $plots = '';
            foreach ($invoice->invoiceDetail as $detail) {
                $plots .=  $detail->plot->name . ', ';
            }
            $message = str_replace('{plot_no}', $plots, $message);
        }


        // recipients
        if ($template_name == 'new_sale') {
            $recipients = [array('recipient_id' => '1', 'dest_addr' => '255' . substr($invoice->customer->mobile_no, 1))];
        }

        // dd($message);



        $postData = array(
            'source_addr' => 'INFO',
            'encoding' => 0,
            'schedule_time' => '',
            'message' => $message,
            'recipients' => $recipients
        );

        // dd($postData);
        $this->send($postData);
    }

    public function send($postData)
    {

        $api_key = '43f7855783446a15';
        $secret_key = 'ZTk1MjVhNWIxZjJhM2JiZDEzYWQwMjYyMmE3YzllMTNjNGIxMzQxMjYwNmUzM2QwZGFmYTYzYmVkNDczY2ZlYg==';
        $Url = 'https://apisms.beem.africa/v1/send';

        $client = new Client();

        $options = [
            'json' => $postData,
            'headers' => [
                'Authorization' => 'Basic ' . base64_encode("$api_key:$secret_key"),
                'Content-Type' => 'application/json'
            ]
        ];

        try {
            $response = $client->post($Url, $options);
            // dd($response->getBody());
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            // dd($e->getMessage());
        }
    }
}
