<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use App\Models\User;
use Cmgmyr\Messenger\Models\Thread;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;

class MessagesController extends Controller
{
    /**
     * Show all of the message threads to the user.
     *
     * @return mixed
     */
    public function index()
    {
        $threads = Thread::getAllLatest()->get();

        return view('messenger.index', compact('threads'));
    }

    /**
     * Shows a message thread.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $thread = Thread::findOrFail($id);

        $userID = Auth::user()->id;
        $users = User::whereNotIn('id', $thread->participantsUserIds($userID))->get();
        $thread->markAsRead($userID);

        return view('messenger.show', compact('thread', 'users'));
    }

    /**
     * Creates a new message thread.
     *
     * @return mixed
     */
    public function create()
    {
        $recipients = User::where('id', '!=', auth()->id())->orderBy('name', 'asc')->pluck('name', 'id');

        return view('messenger.create', compact('recipients'));
    }

    /**
     * Stores a new message thread.
     *
     * @return mixed
     */
    public function store()
    {
        $this->validate(request(), [
            'recipients.0' => 'required',
            'recipients.*' => 'nullable|exists:users,id',
            'subject'      => 'required',
            'message'      => 'required',
        ], [
            'recipients.0.required' => 'Atleast 1 Recipient is Required',
            'recipients.*.exists'   => 'The Selected Recipients are Invalid',
        ]);

        $thread = Thread::create([
            'subject' => request()->subject
        ]);

        Message::create([
            'thread_id' => $thread->id,
            'user_id'   => auth()->user()->id,
            'body'      => request()->message
        ]);

        Participant::create([
            'thread_id' => $thread->id,
            'user_id'   => auth()->user()->id,
            'last_read' => new Carbon,
        ]);

        foreach (request()->recipients as $recipient) {
            $thread->addParticipant($recipient);
        }

        notify()->flash('Message has been sent!', 'success');
        return redirect()->action('MessagesController@index');
    }

    /**
     * Adds a new message to a current thread.
     *
     * @param $id
     * @return mixed
     */
    public function update($id)
    {
        $this->validate(request(), [
            'message'      => 'required',
        ]);

        $thread = Thread::findOrFail($id);
        $thread->activateAllParticipants();

        // Message
        Message::create([
            'thread_id' => $thread->id,
            'user_id'   => auth()->user()->id,
            'body'      => request()->message
        ]);

        // Add replier as a participant
        $participant = Participant::firstOrCreate([
            'thread_id' => $thread->id,
            'user_id'   => auth()->user()->id,
        ]);
        
        $participant->last_read = new Carbon;
        $participant->save();

        notify()->flash('Message has been sent!', 'success');
        return redirect()->action('MessagesController@show', $thread->id);
    }
}
