<?php

namespace App\Http\Controllers;

use App\Models\KitchenTicket;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KitchenController extends Controller
{
    public function screen()
    {
        $statuses = KitchenTicket::getWorkflowStatuses();
        return view('kitchen.screen', compact('statuses'));
    }

    public function apiTickets()
    {
        $statuses = KitchenTicket::getWorkflowStatuses();
        $keys = array_column($statuses, 'key');

        $tickets = KitchenTicket::with(['order.items.product'])
            ->whereIn('status', $keys)
            ->orderBy('dispatched_at', 'asc')
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($tickets);
    }

    public function apiStatuses()
    {
        $statuses = KitchenTicket::getWorkflowStatuses();
        return response()->json($statuses);
    }

    public function updateStatus(Request $request, KitchenTicket $ticket)
    {
        $statuses = KitchenTicket::getWorkflowStatuses();
        $keys = array_column($statuses, 'key');

        $data = $request->validate([
            'status' => ['required', 'string', Rule::in($keys)]
        ]);

        $updates = ['status' => $data['status']];

        if ($data['status'] === 'received' && !$ticket->dispatched_at) {
            $updates['dispatched_at'] = now();
        } elseif ($data['status'] === 'preparing' && !$ticket->started_at) {
            $updates['started_at'] = now();
        } elseif ($data['status'] === 'ready' && !$ticket->ready_at) {
            $updates['ready_at'] = now();
        } elseif ($data['status'] === 'served' && !$ticket->served_at) {
            $updates['served_at'] = now();
        }

        $ticket->update($updates);

        return response()->json([
            'status' => 'success',
            'ticket' => $ticket->fresh(['order.items.product'])
        ]);
    }
}
