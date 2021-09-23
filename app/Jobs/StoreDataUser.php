<?php

namespace App\Jobs;

use App\Http\Repositories\LoginRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class StoreDataUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

     protected $name, $email;
    //  private $email;
    public function __construct($name, $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // $LoginRepo = new LoginRepository();
        // $arr = ['name' => $this->name, 'email' => $this->email];
        // $LoginRepo->loginstore($arr);
        // $LoginRepo->loginstore($arr);
        // return $LoginRepo;
        return (new LoginRepository())->loginstore(['name' => $this->name, 'email' => $this->email]);
    }
}
