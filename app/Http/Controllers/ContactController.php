<?php namespace GoodlerJudge\Http\Controllers;

use GoodlerJudge\Http\Requests;
use GoodlerJudge\Http\Controllers\Controller;

use GoodlerJudge\Http\Requests\ContactFormRequest;
use Illuminate\Http\Request;
use Mail;
use Redirect;

class ContactController extends Controller {

	/**
	 * Show Goodler Judge contact page.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		return view('contact');
	}

	public function store(ContactFormRequest $request)
	{

		Mail::send('emails.contact',
			array(
				'name' => $request->get('name'),
				'email' => $request->get('email'),
				'url' => $request->get('web'),
				'user_message' => $request->get('message')
			), function($message)
			{
				$message->from('goodler.judge@gmail.com');
				$message->to('goodler.judge@gmail.com', 'Admin')->
				          subject('GoodlerJudge Contact');
			});

		return Redirect::route('contact')->with('message',
			                                    'Thanks for contacting us!');

	}

}
