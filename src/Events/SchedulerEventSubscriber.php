<?php

namespace Vista\Events\Listeners;

use Illuminate\Console\Events\ScheduledTaskStarting;
use Illuminate\Console\Events\ScheduledTaskFinished;
use Illuminate\Console\Events\ScheduledTaskFailed;
use Illuminate\Support\Facades\Redis;

/**
 * Class SchedulerListeners
 *
 * This subscriber listens to Laravel's scheduler lifecycle events and
 * records task state into Redis for monitoring by the Vista dashboard.
 *
 * Events handled:
 *  - ScheduledTaskStarting
 *  - ScheduledTaskFinished
 *  - ScheduledTaskFailed
 */
class SchedulerListeners
{
    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     * @return void
     */
    public function subscribe($events)
    {
        $prefix = config('vista.prefix');

        // Task starting
        $events->listen(ScheduledTaskStarting::class, function ($event) use ($prefix) {
            $taskId = md5($event->task->command);

            Redis::hset("{$prefix}tasks:status", $taskId, json_encode([
                'status' => 'running',
                'started_at' => now(),
                'pod' => gethostname(),
            ]));
        });

        // Task finished successfully
        $events->listen(ScheduledTaskFinished::class, function ($event) use ($prefix) {
            $taskId = md5($event->task->command);

            Redis::hset("{$prefix}tasks:status", $taskId, json_encode([
                'status' => 'success',
                'finished_at' => now(),
                'duration' => $event->task->duration,
                'pod' => gethostname(),
            ]));
        });

        // Task failed
        $events->listen(ScheduledTaskFailed::class, function ($event) use ($prefix) {
            $taskId = md5($event->task->command);

            Redis::hset("{$prefix}tasks:status", $taskId, json_encode([
                'status' => 'failed',
                'error' => $event->exception->getMessage(),
                'pod' => gethostname(),
            ]));
        });
    }
}
