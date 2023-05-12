<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubmissionConfirmation;

class XmformController extends Controller
{

    public function index()
    {
        $url = 'https://pkgstore.datahub.io/core/nasdaq-listings/nasdaq-listed_json/data/a5bc7580d6176d60ac0b2142ca8d7df6/nasdaq-listed_json.json';

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        $response = curl_exec($ch);

        if ($response === false) {
            // Handle the error, e.g., log or display an error message
            $error = curl_error($ch);
            curl_close($ch);
            // Return a response or redirect to an error page
            return redirect()->route('error')->with('message', 'Error occurred: ' . $error);
        }

        curl_close($ch);

        $symbols = json_decode($response, true);
        // echo "<pre>"; print_r($symbols);

        return view('homepage')->with('symbols', $symbols);
    }

    /**
     * this function call as a form submit action where validate form data and based on form data send email and call another
     * api for retrive historical data and show
     *
     * @param Request $request
     * @return void
     */
    public function submitForm(Request $request)
    {
        // Validation rules
        $rules = [
            'symbol' => 'required',
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'email' => 'required|email',
        ];

        // Custom error messages
        $messages = [
            'symbol.required' => 'The Company Symbol field is required.',
            'start_date.required' => 'The Start Date field is required.',
            'start_date.date' => 'The Start Date must be a valid date.',
            'start_date.before_or_equal' => 'The Start Date must be less than or equal to the End Date.',
            'end_date.required' => 'The End Date field is required.',
            'end_date.date' => 'The End Date must be a valid date.',
            'end_date.after_or_equal' => 'The End Date must be greater than or equal to the Start Date.',
            'email.required' => 'The Email field is required.',
            'email.email' => 'The Email must be a valid email address.',
        ];

        // Perform validation
        $validatedData = $request->validate($rules, $messages);

        // Process the form data
        // Send the email
        $emailData = [
            'symbol' => $request->symbol,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'email' => $request->email,
        ];

        Mail::to($request->email)->send(new SubmissionConfirmation($emailData));

        $request->session()->start();
        $request->session()->flash('message', 'Your Company Symbol Process successfully');

        // Redirect to a success page or perform other actions
        $url = 'https://yh-finance.p.rapidapi.com/stock/v3/get-historical-data?symbol=' . $emailData['symbol'];
        $apiKey = '90e2d4c1f6msh67534c913def95ep1b7ad7jsn65af7f19a6a0';

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'X-RapidAPI-Key: ' . $apiKey,
                'Accept: application/json',
            ],
        ]);

        $response = curl_exec($ch);

        if ($response === false) {
            // Handle the error, e.g., log or display an error message
            $error = curl_error($ch);
            curl_close($ch);
            // Return a response or redirect to an error page
            return redirect()->route('error')->with('message', 'Error occurred: ' . $error);
        }

        curl_close($ch);

        $historical_data_list = json_decode($response, true);
        // echo "<pre>";
        // print_r($historical_data);
        return view('historical_data')->with('historical_data_list', $historical_data_list['prices'])->with('symbol_data', $emailData);
    }

}