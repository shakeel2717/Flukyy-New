<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
class crud extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:crud {user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $first = $this->argument('user');
        Artisan::call('make:model '.$first.' -mcr ');
        $filename = $first;
        if (!file_exists('resources/views/'.$filename)) {
            mkdir('resources/views/'.$filename, 0777, true);
        }
        fopen("resources/views/$filename/index.blade.php", "w") or die("Unable to Create file!");
        fopen("resources/views/$filename/create.blade.php", "w") or die("Unable to Create file!");
        fopen("resources/views/$filename/edit.blade.php", "w") or die("Unable to Create file!");
        fopen("resources/views/$filename/show.blade.php", "w") or die("Unable to Create file!");
        $routeFile = file_get_contents('routes/web.php');
        $txt = "Route::resource('$filename', ".ucfirst($filename)."Controller::class);";
        $replaced = Str::replace('route:', $txt, $routeFile);
        $capitalize = ucfirst($filename);
        $char = "\ ".$capitalize."Controller;";
        $charReplace = Str::replace(' ', '', $char);
        $use = "use App\Http\Controllers".$charReplace;
        $replaced = Str::replace('controller:', $use, $replaced);
        $routeFile = fopen("routes/web.php", "w") or die("Unable to Open file!");
        fwrite($routeFile, $replaced);
        fclose($routeFile);
        return Command::SUCCESS;
    }
}
