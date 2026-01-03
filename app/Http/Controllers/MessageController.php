<?php
namespace App\Http\Controllers;

use App\Models\Message;
use App\Http\Resources\MessageResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
class MessageController extends Controller
{
    // GET /api/messages
    public function index()
    {
        // Return latest messages first
        $messages = Message::latest()->get();
        return MessageResource::collection($messages);
    }

    // POST /api/messages
    public function store(Request $request)
    {
        // 1. Validate only the form inputs
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // 2. Auto-set the system fields
        $validated['date'] = now()->format('Y-m-d');
        $validated['is_read'] = false;
        $validated['status'] = 'pending';

        // 3. Create
        $message = Message::create($validated);

        return new MessageResource($message);
    }

    // GET /api/messages/{id}
    public function show(Message $message)
    {
        return new MessageResource($message);
    }

    // PUT/PATCH /api/messages/{id}
    public function update(Request $request, Message $message)
    {
        // Use this to mark as read or change status
        $validated = $request->validate([
            'isRead' => 'boolean', // Front-end sends 'isRead'
            'status' => 'in:pending,replied,archived',
        ]);

        // Map front-end 'isRead' to DB 'is_read' if present
        if ($request->has('isRead')) {
            $message->is_read = $request->isRead;
        }

        if ($request->has('status')) {
            $message->status = $request->status;
        }

        $message->save();

        return new MessageResource($message);
    }

    // DELETE /api/messages/{id}
    public function destroy(Message $message)
    {
        $message->delete();
        return response()->json(['message' => 'Message deleted successfully']);
    }

    public function reply(Request $request, Message $message)
    {
        $request->validate([
            'reply_message' => 'required|string',
        ]);

        try {
            // 1. Send the Email
            // This uses the Dynamic SMTP settings we configured earlier
            Mail::raw($request->reply_message, function ($mail) use ($message) {
                $mail->to($message->email)
                    ->subject('Re: ' . $message->subject);
            });

            // 2. Update Database Status
            $message->update([
                'status' => 'replied',
                'is_read' => true
            ]);

            return response()->json(['message' => 'Reply sent successfully!']);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to send email. Check your SMTP settings.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
