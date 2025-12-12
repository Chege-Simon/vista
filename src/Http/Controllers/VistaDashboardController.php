<?php

namespace Vista\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Artisan;

/**
 * Class VistaDashboardController
 *
 * Provides endpoints for the Vista dashboard and API. These endpoints
 * allow users to view task registry and status, and perform actions
 * such as running, enabling, disabling, or retrying tasks.
 */
class VistaDashboardController extends Controller
{
    /**
     * Render the dashboard view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Return the Blade view that mounts the Vue SPA
        return view('vista.index');
    }

    /**
     * Return all tasks with registry and status information.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function tasks()
    {
        $registry = Redis::hgetall(config('vista.prefix').'tasks:registry');
        $status   = Redis::hgetall(config('vista.prefix').'tasks:status');

        return response()->json([
            'registry' => $registry,
            'status'   => $status,
        ]);
    }

    /**
     * Run a task immediately by its ID.
     *
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function run($id)
    {
        $task = json_decode(Redis::hget(config('vista.prefix').'tasks:registry', $id), true);

        if ($task && isset($task['command'])) {
            Artisan::call($task['command']);
            return response()->json(['message' => "Task [{$task['command']}] executed"]);
        }

        return response()->json(['error' => 'Task not found'], 404);
    }

    /**
     * Enable a task by its ID.
     *
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function enable($id)
    {
        $task = json_decode(Redis::hget(config('vista.prefix').'tasks:registry', $id), true);

        if ($task) {
            $task['enabled'] = true;
            Redis::hset(config('vista.prefix').'tasks:registry', $id, json_encode($task));
            return response()->json(['message' => "Task [{$task['command']}] enabled"]);
        }

        return response()->json(['error' => 'Task not found'], 404);
    }

    /**
     * Disable a task by its ID.
     *
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function disable($id)
    {
        $task = json_decode(Redis::hget(config('vista.prefix').'tasks:registry', $id), true);

        if ($task) {
            $task['enabled'] = false;
            Redis::hset(config('vista.prefix').'tasks:registry', $id, json_encode($task));
            return response()->json(['message' => "Task [{$task['command']}] disabled"]);
        }

        return response()->json(['error' => 'Task not found'], 404);
    }

    /**
     * Retry a failed task by its ID.
     *
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function retry($id)
    {
        $task = json_decode(Redis::hget(config('vista.prefix').'tasks:registry', $id), true);

        if ($task && isset($task['command'])) {
            Artisan::call($task['command']);
            return response()->json(['message' => "Task [{$task['command']}] retried"]);
        }

        return response()->json(['error' => 'Task not found'], 404);
    }
}
