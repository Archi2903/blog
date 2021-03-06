<?php

namespace App\Jobs;

use App\BlogPost;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

/**
 * Очереди
 * Class BlogPostAfterCreateJob
 * @package App\Jobs
 */
class BlogPostAfterCreateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var
     */
    private $blogPost;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(BlogPost $blogPost)
    {
        $this->blogPost=$blogPost;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        logs()->info("Создана новая запись в блоге [{$this->blogPost->id}]");
    }
}
