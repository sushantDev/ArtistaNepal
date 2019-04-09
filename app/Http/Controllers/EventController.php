<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEvent;
use App\Http\Requests\UpdateEvent;
use Calendar;
use App\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function index()
    {
        $events = [];

        $data = Event::where('user_id', Auth::id())->get();

        if ($data->count()) {

            foreach ($data as $key => $value) {

                $events[] = Calendar::event(

                    $value->title,

                    true,

                    new \DateTime($value->start_date),

                    new \DateTime($value->end_date . ' +1 day')

                );

            }

        }

        $calendar = Calendar::addEvents($events);

        $allEvents = Event::where('user_id', Auth::id())->get();

        return view('backend.schedule.index', compact('calendar', 'allEvents'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('backend.schedule.create');
    }

    /**
     * @param StoreEvent $request
     * @return mixed
     */
    public function store(StoreEvent $request)
    {
        DB::transaction(function () use ($request) {
            Event::create($request->data());
        });

        return redirect()->route('event.index')->withSuccess(trans('messages.create_success', [ 'entity' => 'Event' ]));
    }

    public function edit(Event $event)
    {
        return view('backend.schedule.edit', compact('event'));
    }

    public function update(UpdateEvent $request, Event $event)
    {
        DB::transaction(function () use ($request, $event) {
            $data = $request->data();

            $event->update($data);
        });

        return redirect()->route('event.index')->with('success', trans('messages.update_success', [ 'entity' => 'Event' ]));
    }

    /**
     * @param Event $event
     * @return mixed
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return back()->withSuccess(trans('message.delete_success', [ 'entity' => 'Event' ]));
    }
}
