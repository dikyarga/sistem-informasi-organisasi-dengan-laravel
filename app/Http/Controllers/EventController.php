<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Event;
use App\Http\Requests;
use App\Http\Requests\EventFormRequest;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $events = Event::where('active', 1)->get();
      $count = $events->count();
      return view('events.index')->withAcara($events)->withCount($count);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      if($request->user())
      {
        if($request->user()->can_post())
        {
          return view('events.create');
        }
      }
      else
      {
        return redirect('/')->withErrors('Kamu belum bisa menulis postingan disini');
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventFormRequest $request)
    {
        //
        $event = new Event();
        $event->title = $request->get('title');
        $event->slug = str_slug($event->title);
        $event->description = $request->get('description');
        $event->fee = $request->get('fee');
        $event->fee_desc = $request->get('fee_desc');
        $event->datetime = Carbon::parse($request->get('datetime'));
        $event->location = $request->get('location');
        $event->latitude = $request->get('latitude');
        $event->longitude = $request->get('longitude');
        $event->active = $request->get('active');
        $event->user_id = $request->user()->id;
        $event->link = $request->get('link');
        $event->save();

        return redirect('/event')->withMessage("berhasil");
        // return $event->datetime. ' '. Carbon::parse($event->datetime);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $event = Event::where('slug', $slug)->first();
        return view('events.show')->withEvent($event);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
