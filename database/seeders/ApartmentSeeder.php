<?php

namespace Database\Seeders;

use App\Models\Apartment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

use Illuminate\Support\Str;


class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $apartments = [
            [
                "user_id" => "1",
                "name" => "Appartamento Bologna - Loreto",
                // "slug" => Str::slug("Appartamento-Bologna-" . Str::random(10)),
                // "description"=> "Un appartamento completamente nuovo a Tua disposizione nel centro di Bologna per un soggiorno di lavoro o per una vacanza. ",
                "cover_image" => "images/01.jpg",
                "rooms_number" => "1",
                "bed_number" => "2",
                "bathroom_number" => "1",
                "square_meters" => "39",
                "address" => "Piazza Maggiore, 40124 Bologna",
                "latitude" => "44.493671",
                "longitude" => "11.342515",
                "visible" => "true",
            ],
            [
                "user_id" => "1",
                "name" => "Casa Lario - Isola District",
                // "slug" => Str::slug("Casa-Lario-Isola District-" . Str::random(10)),
                // "description"=> "Appartamento di circa 50 square_meters situato al secondo piano con ascensore. L'appartamento si compone di un ingresso, un soggiorno/cucina, una zona notte, un bagno finestrato e due balconcini. L’appartamento è interamente esposto sul cortile interno piantumato e per questo è particolarmente silenzioso.",
                "cover_image" => "images/02.jpg",
                "rooms_number" => "2",
                "bed_number" => "3",
                "bathroom_number" => "1",
                "square_meters" => "47",
                "address" => "Via Zamboni, 40126 Bologna",
                "latitude" => "44.497171",
                "longitude" => "11.351270",
                "visible" => "true",
            ],
            [
                "user_id" => "1",
                "name" => "Maisonette a Porta Genova",
                // "slug" => Str::slug("Maisonette-a-Porta-Genova-" . Str::random(10)),
                // "description"=> "Vicinissimo alla movida dei Navigli ma in posizione tranquilla. Appartamento in tipica casa di ringhiera a pochi passi dalla metro di Porta Genova. I bar e la vita dei locali di Ripa di Porta Ticinese e Alzaia Naviglio Grande a 5 minuti a piedi.",
                "cover_image" => "images/03.jpg",
                "rooms_number" => "2",
                "bed_number" => "3",
                "bathroom_number" => "1",
                "square_meters" => "65",
                "address" => "Via Santo Stefano, 40125 Bologna",
                "latitude" => "44.490314",
                "longitude" => "11.352590",
                "visible" => "true",
            ],
            [
                "user_id" => "1",
                "name" => "Bologna Centro Storico",
                // "slug" => Str::slug("Bologna-Centro-Storico-" . Str::random(10)),
                // "description"=> "Appartamento nel cuore di Bologna, in un palazzo signorile, a pochi passi dal Duomo. Si trova al secondo piano, servito da ascensore; è presente un piccolo balcone che si affaccia sul cortile con un tavolino. Grande living con divano letto e TV; cucina open space completamente attrezzata, due camere da letto di cui una matrimoniale e una con letto una piazza e mezza. Bagno completo con doccia e vasca da bagno.",
                "cover_image" => "images/04.jpg",
                "rooms_number" => "3",
                "bed_number" => "4",
                "bathroom_number" => "2",
                "square_meters" => "90",
                "address" => "Via dell'Indipendenza, 40121 Bologna",
                "latitude" => "45.46321",
                "longitude" => "9.18772",
                "visible" => "true",
            ],
            [
                "user_id" => "1",
                "name" => "Attrattivo monolocale",
                // "slug" => Str::slug("Attrattivo-monolocale-" . Str::random(10)),
                // "description"=> "Monolocale ubicato in Porta Romana, quartiere storico di Bologna con molteplici servizi a disposizione e un piacevole contesto architettonico da ammirare che renderà indimenticabile il vostro soggiorno in questa splendida città: uscendo dal cortile del palazzo il vostro sguardo incrocerà l'imponente sagoma della torre Velasca che vi accompagnerà nella vostra passeggiata per raggiungere comodamente Piazza Duomo (15 min).",
                "cover_image" => "images/05.jpg",
                "rooms_number" => "1",
                "bed_number" => "1",
                "bathroom_number" => "1",
                "square_meters" => "39",
                "address" => "Via Rizzoli, 40125 Bologna",
                "latitude" => "44.499982",
                "longitude" => "11.343020",
                "visible" => "true",
            ],
            [
                "user_id" => "1",
                "name" => "Bologna Via Marghera",
                // "slug" => Str::slug("Bologna-Via-Marghera-" . Str::random(10)),
                // "description"=> "Questo meraviglioso appartamento/monolocale è stato completamente ristrutturato e pensato per offrire ai suoi ospiti il massimo della serenità. Studiato per persone che amano vivere nel centro città in una delle zone più vivaci e affascinati di Bologna. La zona Marghera offre numerosi ristoranti e locali dove trascorrere giornate e serate in allegria. L'appartamento è progettato per due persone ed è fornito con tutto l'occorrente per un piacevole soggiorno.",
                "cover_image" => "images/06.jpg",
                "rooms_number" => "1",
                "bed_number" => "2",
                "bathroom_number" => "1",
                "square_meters" => "42",
                "address" => "Via Saragozza, 40123 Bologna",
                "latitude" => "44.491413",
                "longitude" => "11.331981",
                "visible" => "true",
            ],

            [
                "user_id" => "1",
                "name" => "Appartamento Elegante in Centro",
                // "slug" => Str::slug("Appartamento-Elegante-in-centro-" . Str::random(10)),
                // "description"=> "Un appartamento recentemente ristrutturato con un design elegante nel cuore di Bologna. Perfetto per chi desidera vivere il fascino della città con comfort e stile.",
                "cover_image" => "images/07.jpg",
                "rooms_number" => "2",
                "bed_number" => "2",
                "bathroom_number" => "1",
                "square_meters" => "55",
                "address" => "Via Indipendenza, 40123 Bologna",
                "latitude" => "44.496738",
                "longitude" => "11.342998",
                "visible" => "true",
            ],
            [
                "user_id" => "1",
                "name" => "Loft Moderno in Zona Universitaria",
                // "slug" => Str::slug("Loft-Moderno-in-zona-universitaria-" . Str::random(10)),
                // "description"=> "Un loft spazioso e moderno situato nelle vicinanze dell'Università di Bologna. Ideale per studenti o professionisti che desiderano un ambiente contemporaneo e ben collegato.",
                "cover_image" => "images/08.jpg",
                "rooms_number" => "1",
                "bed_number" => "1",
                "bathroom_number" => "1",
                "square_meters" => "40",
                "address" => "Via Zamboni, 40121 Bologna",
                "latitude" => "44.494416",
                "longitude" => "11.347602",
                "visible" => "true",
            ],
            [
                "user_id" => "1",
                "name" => "Casa Vacanze Panoramica",
                // "slug" => Str::slug("Casa-vacanze-panoramica-" . Str::random(10)),
                // "description"=> "Un'accogliente casa vacanze con una vista panoramica sulla città. Perfetta per coppie o piccoli gruppi che desiderano godersi una vista mozzafiato di Bologna.",
                "cover_image" => "images/09.jpg",
                "rooms_number" => "3",
                "bed_number" => "3",
                "bathroom_number" => "2",
                "square_meters" => "70",
                "address" => "Via Riva Reno, 40122 Bologna",
                "latitude" => "44.503785",
                "longitude" => "11.345697",
                "visible" => "true",
            ],
            [
                "user_id" => "1",
                "name" => "Monolocale Accogliente Vicino ai Giardini",
                // "slug" => Str::slug("monolocale-accogliente-vicino-ai-giardini-" . Str::random(10)),
                // "description"=> "Un monolocale accogliente e luminoso situato nelle vicinanze dei famosi Giardini Margherita. Perfetto per chi ama passeggiare nel verde e godersi la tranquillità della natura in città.",
                "cover_image" => "images/10.jpg",
                "rooms_number" => "1",
                "bed_number" => "1",
                "bathroom_number" => "1",
                "square_meters" => "35",
                "address" => "Via Irnerio, 40126 Bologna",
                "latitude" => "44.498922",
                "longitude" => "11.330693",
                "visible" => "true",
            ],
            [
                "user_id" => "1",
                "name" => "Attico con Terrazza Panoramica",
                // "slug" => Str::slug("attico-con-terrazza-panoramica-" . Str::random(10)),
                // "description"=> "Un lussuoso attico con una spettacolare terrazza panoramica sul centro storico di Bologna. Ideale per chi cerca un'esperienza di soggiorno indimenticabile con vista mozzafiato.",
                "cover_image" => "images/11.jpg",
                "rooms_number" => "4",
                "bed_number" => "5",
                "bathroom_number" => "3",
                "square_meters" => "120",
                "address" => "Via de' Musei, 40124 Bologna",
                "latitude" => "44.492878",
                "longitude" => "11.349369",
                "visible" => "true",
            ],
            [
                "user_id" => "1",
                "name" => "Appartamento Storico nel Quadrilatero",
                // "slug" => Str::slug("appartamento-storico-nel-quadrilatero-" . Str::random(10)),
                // "description"=> "Un appartamento dal fascino storico nel vivace Quadrilatero di Bologna. Circondato da negozi, ristoranti e bar, è perfetto per immergersi nell'atmosfera autentica della città.",
                "cover_image" => "images/12.jpg",
                "rooms_number" => "2",
                "bed_number" => "3",
                "bathroom_number" => "1",
                "square_meters" => "60",
                "address" => "Via Clavature, 40124 Bologna",
                "latitude" => "44.495429",
                "longitude" => "11.344739",
                "visible" => "true",
            ],
            [
                "user_id" => "1",
                "name" => "Loft Panoramico in Centro",
                // "slug" => Str::slug("Loft-Panoramico-in-Centro-" . Str::random(10)), // Genera lo slug direttamente dal nome dell'appartamento
                // "description" => "Un loft moderno con una vista panoramica sul centro storico di Bologna. Ideale per chi cerca un'esperienza di soggiorno indimenticabile con vista mozzafiato.",
                "cover_image" => "images/13.jpg",
                "rooms_number" => "1",
                "bed_number" => "1",
                "bathroom_number" => "1",
                "square_meters" => "45",
                "address" => "Via Oberdan, 40123 Bologna",
                "latitude" => "44.498225",
                "longitude" => "11.340868",
                "visible" => "true",
            ],
            [
                "user_id" => "1",
                "name" => "Casa Vacanze Romantica",
                // "description" => "Una casa vacanze romantica situata a due passi dalla Torre degli Asinelli. Perfetta per coppie che desiderano vivere il fascino romantico del centro storico di Bologna.",
                "cover_image" => "images/14.jpg",
                "rooms_number" => "1",
                "bed_number" => "1",
                "bathroom_number" => "1",
                "square_meters" => "40",
                "address" => "Via Rizzoli, 40125 Bologna",
                "latitude" => "44.493872",
                "longitude" => "11.343410",
                "visible" => "true",
            ],
            [
                "user_id" => "1",
                "name" => "Attico Moderno",
                // "description" => "Un lussuoso attico con una spettacolare vista sulle Due Torri di Bologna. Ideale per chi cerca un'esperienza di soggiorno indimenticabile con comfort e stile.",
                "cover_image" => "images/15.jpg",
                "rooms_number" => "3",
                "bed_number" => "4",
                "bathroom_number" => "2",
                "square_meters" => "100",
                "address" => "Via Ugo Bassi, 40123 Bologna",
                "latitude" => "44.492131",
                "longitude" => "11.342782",
                "visible" => "true",
            ],
            [
                "user_id" => "1",
                "name" => "Monolocale Accogliente nel Cuore di Bologna",
                // "description" => "Un monolocale accogliente situato nel cuore di Bologna. Perfetto per chi desidera vivere la città con comfort e praticità.",
                "cover_image" => "images/16.jpg",
                "rooms_number" => "1",
                "bed_number" => "1",
                "bathroom_number" => "1",
                "square_meters" => "35",
                "address" => "Via dell'Indipendenza, 40126 Bologna",
                "latitude" => "44.493789",
                "longitude" => "11.339563",
                "visible" => "true",
            ],
            [
                "user_id" => "1",
                "name" => "Villetta con Giardino nelle Colline Bolognesi",
                // "description" => "Una villetta con un ampio giardino situata nelle colline bolognesi. Ideale per chi cerca relax e tranquillità a breve distanza dal centro città.",
                "cover_image" => "images/17.jpg",
                "rooms_number" => "3",
                "bed_number" => "4",
                "bathroom_number" => "2",
                "square_meters" => "120",
                "address" => "Via delle Fonti, 40139 Bologna",
                "latitude" => "44.493550",
                "longitude" => "11.386601",
                "visible" => "true",
            ],

            [
                "user_id" => "1",
                "name" => "Casa Vacanze con Vista sulla Basilica di San Petronio",
                // "description" => "Una casa vacanze con una vista spettacolare sulla Basilica di San Petronio. Perfetta per chi desidera godere dell'arte e della cultura di Bologna.",
                "cover_image" => "images/18.jpg",
                "rooms_number" => "2",
                "bed_number" => "3",
                "bathroom_number" => "1",
                "square_meters" => "70",
                "address" => "Piazza Maggiore, 40124 Bologna",
                "latitude" => "44.493671",
                "longitude" => "11.342515",
                "visible" => "true",
            ],
            [
                "user_id" => "1",
                "name" => "Appartamento Design con Terrazza Panoramica",
                // "description" => "Un appartamento dal design moderno con una terrazza panoramica mozzafiato. Ideale per chi cerca comfort e stile nel cuore di Bologna.",
                "cover_image" => "images/19.jpg",
                "rooms_number" => "3",
                "bed_number" => "4",
                "bathroom_number" => "2",
                "square_meters" => "90",
                "address" => "Via dell'Indipendenza, 40121 Bologna",
                "latitude" => "44.493871",
                "longitude" => "11.344929",
                "visible" => "true",
            ],
            [
                "user_id" => "1",
                "name" => "Monolocale Chic a Due Passi dal Mercato di Mezzo",
                // "description" => "Un monolocale chic situato nelle immediate vicinanze del Mercato di Mezzo. Perfetto per gli amanti del cibo e della cultura bolognese.",
                "cover_image" => "images/20.jpg",
                "rooms_number" => "1",
                "bed_number" => "1",
                "bathroom_number" => "1",
                "square_meters" => "40",
                "address" => "Via Pescherie Vecchie, 40124 Bologna",
                "latitude" => "44.494029",
                "longitude" => "11.343225",
                "visible" => "true",
            ],
        ];

        foreach ($apartments as $apartment) {
            Apartment::create([
                'user_id' => $apartment['user_id'],
                'name' => $apartment['name'],
                'slug' => Str::slug($apartment['name']),
                // 'description' => $apartment['description'],
                'cover_image' => $apartment['cover_image'],
                'rooms_number' => $apartment['rooms_number'],
                'bed_number' => $apartment['bed_number'],
                'bathroom_number' => $apartment['bathroom_number'],
                'square_meters' => $apartment['square_meters'],
                'address' => $apartment['address'],
                'latitude' => $apartment['latitude'],
                'longitude' => $apartment['longitude'],
                'visible' => $apartment['visible'],
            ]);
        }
    }
}

// //
// $numberOfApartments = 10;
// $location = "Bologna";

// $response = Http::withOptions(['verify' => false])->get('https://api.tomtom.com/search/2/geocode/' . urlencode($location) . '.json', [
//     'key' => 'RrNofIXHXhCLSto2sM1SEfvmA1AamCSs',
// ]);

// $latitude = $response['results'][0]['position']['lat'];
// $longitude = $response['results'][0]['position']['lon'];

// for ($i = 0; $i < $numberOfApartments; $i++) {

//     $apartmentLatitude = $latitude + mt_rand(-100, 100) * 0.00001;
//     $apartmentLongitude = $longitude + mt_rand(-100, 100) * 0.00001;

//     $apartment = new Apartment();
//     $apartment->user_id = rand(1, 4);
//     $apartment->name = "Appartamento " . ($i + 1);
//     $apartment->slug = Str::slug($apartment->name . Str::random(10));       
//     // $apartment->image = "https://a0.muscache.com/im/pictures/miso/Hosting-881808599061267756/original/b16970cf-1d55-4edd-bb1f-e1735d0a228e.jpeg?im_w=2560&im_q=highq";
//     $apartment->room_number = rand(1, 5);
//     $apartment->bed_number = rand(1, 10);
//     $apartment->bathroom_number = rand(1, 3);
//     $apartment->square_meters = rand(50, 200);
//     $apartment->address = "Indirizzo " . ($i + 1) . ", " . $location;
//     $apartment->latitude = $apartmentLatitude;
//     $apartment->longitude = $apartmentLongitude;
//     $apartment->visible = true;
//     $apartment->save();
// }