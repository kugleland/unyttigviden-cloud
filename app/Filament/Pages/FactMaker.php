<?php

namespace App\Filament\Pages;

use App\Models\Fact;
use Filament\Pages\Page;
use Prism\Prism\Prism;
use Livewire\Attributes\Session;
use Prism\Prism\Enums\Provider;
use Prism\Prism\Schema\ObjectSchema;
use Prism\Prism\Schema\StringSchema;
use Prism\Prism\Schema\ArraySchema;
use Prism\Prism\Schema\NumberSchema;
use App\Models\Category;

class FactMaker extends Page
{

    protected static ?string $navigationGroup = 'Generators';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.fact-maker';


    ##[Session(key: 'fact_maker.response')]
    public $response;

    ##[Session(key: 'fact_maker.prompt')]
    public $prompt;

    public $categories;

    public $category;

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function generateResponse()
    {

        $schema = new ObjectSchema(
            name: 'fact_category',
            description: 'A structured fact category with facts.',
            properties: [
                new StringSchema('title', 'The title of the category'),
                new ArraySchema(
                    name: 'facts',
                    description: 'The categories facts',
                    items: new ObjectSchema(
                        name: 'fact',
                        description: 'A detailed fact entry',
                        properties: [
                            new StringSchema('title', 'The title of the fact', nullable: true),
                            new StringSchema('source', 'The source of the fact', nullable: true),
                            new StringSchema('content', 'Fact content'),
                        ],
                        requiredFields: ['title', 'source', 'content'],
                    )
                ),

            ],
            requiredFields: ['title']
        );

        #dd($schema);

        $category = Category::find($this->category);

        #dd($category);

        try {
            $response = Prism::structured()
                //->using(Provider::Ollama, 'qwen2.5:14b') // qwen2.5:14b
                ->using(Provider::OpenAI, 'gpt-4o-mini')
                ->withSchema($schema)
                #->withMaxSteps(4)
                ->withClientOptions(['timeout' => 3000])
                ->withPrompt('Generer på dansk, 5 facts omkring emnet "' . $category->title . '"')
                ->generate();

            #dd($response);
        } catch (\Throwable $th) {
            throw $th;
        }

        #$this->response = $response->text;
        $factCategory = $response->structured;

        #dd($factCategory);

        foreach ($factCategory['facts'] as $key => $value) {
            Fact::create([
                'title' => $value['title'],
                'source' => $value['source'],
                'content' => $value['content'],
                'fact_checked_at' => now(),
                'category_id' => $this->category,
                'status' => 'published',
            ]);
        }

        $this->response = $factCategory;
    }
}
