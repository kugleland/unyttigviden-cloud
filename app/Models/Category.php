<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Fact;
use Sushi\Sushi;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasFactory, Sushi;

    protected $guarded = [];

    protected $schema = [
        'id' => 'integer',
        'title' => 'string',
        'description' => 'string',
        'slug' => 'string',
        'emoji' => 'string',
        'color' => 'string',
        'color_light' => 'string',
        'color_dark' => 'string',
        'icon' => 'string',
        'image_url' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];





    public function getRows()
    {
        return [
            [
                'id' => 1,
                'title' => 'Videnskab & Opdagelser',
                'slug' => 'videnskab-opdagelser',
                'emoji' => '🧪',
                'description' => 'Interessante videnskabelige fakta og opdagelser.',
                'color' => '#2F80ED',
                'color_light' => '#51a2ff',
                'color_dark' => '#2b7fff',
                'icon' => 'test-tube',
                'image_url' => asset('images/categories/science.svg')
            ],
            [
                'id' => 2,
                'title' => 'Historie & Gamle Dage',
                'slug' => 'historie-gamle-dage',
                'emoji' => '🏛',
                'description' => 'Historiske begivenheder, konger, krige og civilisationer.',
                'color' => '#8D6E63',
                'color_light' => '#a6a09b',
                'color_dark' => '#79716b',
                'icon' => 'pillar',
                'image_url' => asset('images/categories/011-history.svg')
            ],
            [
                'id' => 3,
                'title' => 'Rummet & Astronomi',
                'slug' => 'rummet-astronomi',
                'emoji' => '🌌',
                'description' => 'Fakta om planeter, stjerner og universets mysterier.',
                'color' => '#512DA8',
                'color_light' => '#8E44AD',
                'color_dark' => '#311B92',
                'icon' => 'rocket',
                'image_url' => asset('images/categories/011-history.svg')
            ],
            [
                'id' => 4,
                'title' => 'Menneskekroppen',
                'slug' => 'menneskekroppen',
                'emoji' => '🏃‍♂️',
                'description' => 'Utrolige fakta om kroppen og dens funktioner.',
                'color' => '#E91E63',
                'color_light' => '#ff637e',
                'color_dark' => '#ff2056',
                'icon' => 'human',
                'image_url' => asset('images/categories/011-history.svg')
            ],
            [
                'id' => 5,
                'title' => 'Dyreriget',
                'slug' => 'dyreriget',
                'emoji' => '🦁',
                'description' => 'Mærkelige og sjove fakta om dyr og deres adfærd.',
                'color' => '#FF9800',
                'color_light' => '#FFB74D',
                'color_dark' => '#E65100',
                'icon' => 'panda',
                'image_url' => asset('images/categories/panda.svg')
            ],
            [
                'id' => 6,
                'title' => 'Mad & Drikke',
                'slug' => 'mad-drikke',
                'emoji' => '🍕',
                'description' => 'Overraskende fakta om fødevarer, madkultur og ingredienser.',
                'color' => '#F57C00',
                'color_light' => '#FFA726',
                'color_dark' => '#E65100',
                'icon' => 'food',
                'image_url' => asset('images/categories/food.svg')
            ],
            [
                'id' => 7,
                'title' => 'Penge & Økonomi',
                'slug' => 'penge-oekonomi',
                'emoji' => '💰',
                'description' => 'Fakta om penge, forbrug og økonomi.',
                'color' => '#4CAF50',
                'color_light' => '#81C784',
                'color_dark' => '#388E3C',
                'icon' => 'cash',
                'image_url' => asset('images/categories/011-history.svg')
            ],
            [
                'id' => 8,
                'title' => 'Menneskelig Psykologi',
                'slug' => 'menneskelig-psykologi',
                'emoji' => '🧠',
                'description' => 'Forbløffende fakta om hjernen og adfærd.',
                'color' => '#9C27B0',
                'color_light' => '#CE93D8',
                'color_dark' => '#7B1FA2',
                'icon' => 'head-cog',
                'image_url' => asset('images/categories/psychology.svg')
            ],
            [
                'id' => 9,
                'title' => 'Geografi & Verden',
                'slug' => 'geografi-verden',
                'emoji' => '🌍',
                'description' => 'Fantastiske fakta om lande, byer og steder.',
                'color' => '#4CAF50',
                'color_light' => '#81C784',
                'color_dark' => '#388E3C',
                'icon' => 'map',
                'image_url' => asset('images/categories/011-history.svg')
            ],
            [
                'id' => 10,
                'title' => 'Sprog & Ord',
                'slug' => 'sprog-ord',
                'emoji' => '📖',
                'description' => 'Sjove sprogfakta, oversættelser og uventede betydninger.',
                'color' => '#607D8B',
                'color_light' => '#90A4AE',
                'color_dark' => '#455A64',
                'icon' => 'translate',
                'image_url' => asset('images/categories/007-translation.svg')
            ],
            [
                'id' => 11,
                'title' => 'Teknologi & Innovation',
                'slug' => 'teknologi-innovation',
                'emoji' => '📱',
                'description' => 'Spændende fakta om gadgets, opfindelser og IT.',
                'color' => '#03A9F4',
                'color_light' => '#63C6F1',
                'color_dark' => '#0077C9',
                'icon' => 'memory',
                'image_url' => asset('images/categories/011-history.svg')
            ],
            [
                'id' => 12,
                'title' => 'Mytologi & Folketro',
                'slug' => 'mytologi-folketro',
                'emoji' => '🏹',
                'description' => 'Overnaturlige historier, mytiske væsener og gamle guder.',
                'color' => '#795548',
                'color_light' => '#A67B6E',
                'color_dark' => '#4D3327',
                'icon' => 'pillar',
                'image_url' => asset('images/categories/church.svg')
            ],
            [
                'id' => 13,
                'title' => 'Rekorder & Ekstremer',
                'slug' => 'rekorder-ekstremer',
                'emoji' => '🏆',
                'description' => 'Guinness-rekorder og vilde præstationer.',
                'color' => '#FFEB3B',
                'color_light' => '#fcc800',
                'color_dark' => '#efb100',
                'icon' => 'trophy',
                'image_url' => asset('images/categories/011-history.svg')
            ],
            [
                'id' => 14,
                'title' => 'Sport & Spil',
                'slug' => 'sport-spil',
                'emoji' => '⚽',
                'description' => 'Sjove sportsrekorder og overraskende fakta.',
                'color' => '#4CAF50',
                'color_light' => '#ffb86a',
                'color_dark' => '#ff8904',
                'icon' => 'basketball',
                'image_url' => asset('images/categories/011-history.svg')
            ]
        ];
    }

    public function facts()
    {
        return $this->hasMany(Fact::class);
    }
}
