<?php

namespace App\Http\Controllers;

use App\DataAccessLayer;
use App\Jobs\SendEmail;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class PublicController extends Controller
{
    protected $dataAccess;
    protected $mailer;

    /**
     * PublicController constructor.
     * @param $dataAccess
     */
    public function __construct(DataAccessLayer $dataAccess)
    {
        $this->dataAccess = $dataAccess;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function contactUs()
    {
        return view('contact');
    }

    public function contactUsSubmit(Request $request)
    {
        $validator = Validator::make($request->all(), ['contact_name' => 'required|max:100',
            'contact_email' => 'required|email|max:100',
            'contact_message' => 'required|max:500']);

        if($validator->fails())
        {
            $this->throwValidationException($request, $validator);
        }

        $formData = [
                    'contact_name' => $request->input('contact_name'),
                    'contact_email' => $request->input('contact_email'),
                    'contact_message' => $request->input('contact_message'),
                    ];

        $mailData = [
            'to' => config('app.contact_email_to'),
            'from' => $request->input('contact_email'),
            'subject' => trans('messages.contact_subject_to'),
            'view' => config('app.contact_email_view_admin'),
            'viewData' => $formData
            ];

        // Send email to us
        $this->dispatch(new SendEmail($mailData));

        // Send receipt of mail to user
        $mailData['to'] = $request->input('contact_email');
        $mailData['from'] = config('app.contact_email_to');
        $mailData['subject'] = trans('messages.contact_subject_from');
        $mailData['view'] = config('app.contact_email_view');
        $this->dispatch(new SendEmail($mailData));

        $successMessage = trans('messages.contact_received_success');

        return view('contact')->with('successMessage', $successMessage);
    }

}
