<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

// @author: Juanjo Ruiz (Github: jjruizdeveloper | youtube: @gogodev | discord: juanjo.ruiz)

class DDDStructure extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:ddd {context : The bounded context, such as admin, lms or job_request} {entity : The entity to create the DDD structure, books for example}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates DDD folder structure for the given entity';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $uri = base_path('src/'. $this->argument('context') .'/'. $this->argument('entity'));
        $this->info('Creating structure...');

        File::makeDirectory($uri . '/domain', 0755, true, true);
        $this->info($uri . '/domain');

        File::makeDirectory($uri . '/domain/entities', 0755, true, true);
        $this->info($uri . '/domain/entities');

        File::makeDirectory($uri . '/domain/value_objects', 0755, true, true);
        $this->info($uri . '/domain/value_objects');

        File::makeDirectory($uri . '/domain/contracts', 0755, true, true);
        $this->info($uri . '/domain/contracts');

        File::makeDirectory($uri . '/application', 0755, true, true);
        $this->info($uri . '/application');

        File::makeDirectory($uri . '/infrastructure', 0755, true, true);
        $this->info($uri . '/infrastructure');

        File::makeDirectory($uri . '/infrastructure/controllers', 0755, true, true);
        $this->info($uri . '/infrastructure/controllers');

        File::makeDirectory($uri . '/infrastructure/routes', 0755, true, true);
        $this->info($uri . '/infrastructure/routes');

        File::makeDirectory($uri . '/infrastructure/validators', 0755, true, true);
        $this->info($uri . '/infrastructure/validators');

        File::makeDirectory($uri . '/infrastructure/repositories', 0755, true, true);
        $this->info($uri . '/infrastructure/repositories');

        File::makeDirectory($uri . '/infrastructure/listeners', 0755, true, true);
        $this->info($uri . '/infrastructure/listeners');

        File::makeDirectory($uri . '/infrastructure/events', 0755, true, true);
        $this->info($uri . '/infrastructure/events');

        // api.php
        $content = "<?php\n\n//use Src\\".$this->argument('context')."\\".$this->argument('entity')."\\infrastructure\controllers\ExampleGETController;\n\n// Simpele route example\n// Route::get('/', [ExampleGETController::class, 'index']);\n\n//Authenticathed route example\n// Route::middleware(['auth:sanctum','activitylog'])->get('/', [ExampleGETController::class, 'index']);";
        File::put($uri . '/infrastructure/routes/api.php', $content);
        $this->info('Routes entry point added in ' . $uri . 'infrastructure/routes/api.php' );

        // local api.php added to main api.php
        $content = "\nRoute::prefix('" . $this->argument('context') . "_" .$this->argument('entity') . "')->group(base_path('src/". $this->argument('context') . "/" .$this->argument('entity') ."/infrastructure/routes/api.php'));\n";
        File::append(base_path('routes/api.php'), $content);
        $this->info('Module routes linked in main routes directory.');

        // ExampleGETController.php
        $content = "<?php\n\nnamespace Src\\" . $this->argument('context')."\\".$this->argument('entity')."\\infrastructure\\controllers;\n\nuse App\\Http\\Controllers\\Controller;\n\nfinal class ExampleGETController extends Controller { \n\n public function index() { \n // TODO: DDD Controller content here \n }\n}";
        File::put($uri.'/infrastructure/controllers/ExampleGETController.php', $content);
        $this->info('Example controller added');

        // ExampleValidatorRequest.php
        $content = "<?php\n\nnamespace Src\\".$this->argument('context')."\\".$this->argument('entity')."\\infrastructure\\validators;\n\nuse Illuminate\Foundation\Http\FormRequest;\n\nclass ExampleValidatorRequest extends FormRequest\n{\npublic function authorize()\n{\nreturn true;\n}\n\npublic function rules()\n{\nreturn [\n'field' => 'nullable|max:255'\n];\n}\n\n}";
        File::put($uri.'/infrastructure/validators/ExampleValidatorRequest.php', $content);
        $this->info('Example validation request added');

        $this->info('Structure ' . $this->argument('entity') . ' DDD successfully created.');

        return Command::SUCCESS;
    }
}