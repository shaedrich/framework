<?php

namespace Illuminate\Queue\Middleware;

class SkipIfBatchCancelled
{
    /**
     * Process the job.
     *
     * @template TJob
     * @template TReturn
     * 
     * @param  TJob  $job
     * @param  callable(TJob): TReturn  $next
     * @param-immediately-invoked-callable  $next
     * @return TReturn
     */
    public function handle($job, $next)
    {
        if (method_exists($job, 'batch') && $job->batch()?->cancelled()) {
            return;
        }

        $next($job);
    }
}
