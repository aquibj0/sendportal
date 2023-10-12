<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Sendportal\Custom\Subscriber;
use App\Models\Sendportal\Custom\TagSubscriber;
use Str;



class ImportUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import all users to the platform';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {        
        $users = \json_decode(Http::get('http://127.0.0.1:8000/api/all-users'), true)['users'];

        foreach ($users as $user) {  

            $existing_user = Subscriber::where('email', $user['email'])->first();

            if(!isset($existing_user)){
                // Split name into two part
                $name  = $user['name'];        
                $splitName = explode(' ', $name, 2);
                $first_name = $splitName[0];
                $last_name = !empty($splitName[1]) ? $splitName[1] : ''; // If last name doesn't exist, make it empty

                // Create Subscriber
                $subscriber = Subscriber::create([
                    'workspace_id' => 1,
                    'hash' => Str::uuid(),
                    'email' => $user['email'],
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                ]);

                // Assign Tag to Each Subscriber
                TagSubscriber::create([
                    'tag_id' => 1,
                    'subscriber_id' => $subscriber['id'],
                ]);
            }
          
        }
    }
}
