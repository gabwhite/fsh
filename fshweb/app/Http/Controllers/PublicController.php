<?php

namespace App\Http\Controllers;

use App\DataAccessLayer;
use App\iMailer;
use App\ProductSearcher;
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
    public function __construct(DataAccessLayer $dataAccess, iMailer $mailer)
    {
        $this->dataAccess = $dataAccess;
        $this->mailer = $mailer;
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

        // Send email to us
        $this->mailer->sendMail(config('app.contact_email_to'),
                                $request->input('contact_email'),
                                trans('messages.contact_subject_to'),
                                config('app.contact_email_view_admin'),
                                $formData);

        // Send receipt of mail to user
        $this->mailer->sendMail($request->input('contact_email'),
                                config('app.contact_email_to'),
                                trans('messages.contact_subject_from'),
                                config('app.contact_email_view'),
                                $formData);

        $successMessage = trans('messages.contact_received_success');

        return view('contact')->with('successMessage', $successMessage);

    }

}
