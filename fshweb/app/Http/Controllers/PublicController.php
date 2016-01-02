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

    public function productDetail($id)
    {
        $userProduct = $this->dataAccess->getUserProduct($id);

        return view('productdetail')->with('userproduct', $userProduct);
    }

    public function fullTextSearch(Request $request)
    {

        $productSearcher = new ProductSearcher();
        $hits = $productSearcher->fullTextSearch('productindex', $request->input('searchquery'));

        $results = array();
        foreach($hits as $h)
        {
            $data = array('score' => $h->score, 'document' => $h->getDocument());
            array_push($results, $data);
        }

        return view('search')->with('searchresults', $results)->with('query', $request->input('searchquery'));
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
                                config('app.contact_subject_to'),
                                config('app.contact_email_view_admin'),
                                $formData);

        // Send receipt of mail to user
        $this->mailer->sendMail($request->input('contact_email'),
                                config('app.contact_email_to'),
                                config('app.contact_subject_from'),
                                config('app.contact_email_view'),
                                $formData);

        $successMessage = config('app.contact_subject_from');

        return view('contact')->with('successMessage', $successMessage);


    }
}
