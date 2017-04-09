<?php

namespace Sitec\Siravel\Controllers;

use URL;
use Siravel;
use Sitec\Siravel\Models\Event;
use Illuminate\Http\Request;
use Sitec\Siravel\Requests\EventRequest;
use Sitec\Siravel\Services\ValidationService;
use Sitec\Siravel\Repositories\EventRepository;

class EventController extends SiravelController
{
    /** @var EventRepository */
    private $eventRepository;

    public function __construct(EventRepository $eventRepo)
    {
        $this->eventRepository = $eventRepo;
    }

    /**
     * Display a listing of the Event.
     *
     * @return Response
     */
    public function index()
    {
        $result = $this->eventRepository->paginated();

        return view('siravel::modules.events.index')
            ->with('events', $result)
            ->with('pagination', $result->render());
    }

    /**
     * Search.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function search(Request $request)
    {
        $input = $request->all();

        $result = $this->eventRepository->search($input);

        return view('siravel::modules.events.index')
            ->with('events', $result[0]->get())
            ->with('pagination', $result[2])
            ->with('term', $result[1]);
    }

    /**
     * Show the form for creating a new Event.
     *
     * @return Response
     */
    public function create()
    {
        return view('siravel::modules.events.create');
    }

    /**
     * Store a newly created Event in storage.
     *
     * @param EventRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $validation = ValidationService::check(Event::$rules);

        if (!$validation['errors']) {
            $event = $this->eventRepository->store($request->all());
            Siravel::notification('Event saved successfully.', 'success');
        } else {
            return $validation['redirect'];
        }

        if (!$event) {
            Siravel::notification('Event could not be saved.', 'warning');
        }

        return redirect(route('siravel.events.edit', [$event->id]));
    }

    /**
     * Show the form for editing the specified Event.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $event = $this->eventRepository->findEventById($id);

        if (empty($event)) {
            Siravel::notification('Event not found', 'warning');

            return redirect(route('siravel.events.index'));
        }

        return view('siravel::modules.events.edit')->with('event', $event);
    }

    /**
     * Update the specified Event in storage.
     *
     * @param int          $id
     * @param EventRequest $request
     *
     * @return Response
     */
    public function update($id, EventRequest $request)
    {
        $event = $this->eventRepository->findEventById($id);

        if (empty($event)) {
            Siravel::notification('Event not found', 'warning');

            return redirect(route('siravel.events.index'));
        }

        $event = $this->eventRepository->update($event, $request->all());
        Siravel::notification('Event updated successfully.', 'success');

        if (!$event) {
            Siravel::notification('Event could not be saved.', 'warning');
        }

        return redirect(URL::previous());
    }

    /**
     * Remove the specified Event from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $event = $this->eventRepository->findEventById($id);

        if (empty($event)) {
            Siravel::notification('Event not found', 'warning');

            return redirect(route('siravel.events.index'));
        }

        $event->delete();

        Siravel::notification('Event deleted successfully.', 'success');

        return redirect(route('siravel.events.index'));
    }

    /**
     * Page history.
     *
     * @param int $id
     *
     * @return Response
     */
    public function history($id)
    {
        $event = $this->eventRepository->findEventById($id);

        return view('siravel::modules.events.history')
            ->with('event', $event);
    }
}
