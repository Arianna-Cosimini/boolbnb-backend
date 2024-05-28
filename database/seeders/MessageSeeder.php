<?php

namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run() : void
   {
       $messages = [
        [
            "id" => '1',
            "name" => "Giovanni",
            "surname" => "Rossi",
            "message" => "Vorrei prenotare l'appartamento per una settimana a partire dal 10 giugno.",
            "address" => "giovanni.rossi@example.com",
            "apartment_id" => 1,
            "created_at" => "2023/02/18"
        ],
        [
            "id" => 2,
            "name" => "Maria",
            "surname" => "Bianchi",
            "message" => "Salve, è disponibile l'appartamento dal 15 al 20 luglio?",
            "address" => "maria.bianchi@example.com",
            "apartment_id" => 2,
            "created_at" => "2023/02/19"
        ],
        [
            "id" => 3,
            "name" => "Luca",
            "surname" => "Verdi",
            "message" => "Vorrei sapere se l'appartamento è libero per due settimane a partire dal 1 agosto.",
            "address" => "luca.verdi@example.com",
            "apartment_id" => 3,
            "created_at" => "2023/02/20"
        ],
        [
            "id" => 4,
            "name" => "Chiara",
            "surname" => "Gialli",
            "message" => "Buongiorno, è possibile prenotare l'appartamento per il weekend del 5 settembre?",
            "address" => "chiara.gialli@example.com",
            "apartment_id" => 4,
            "created_at" => "2023/02/21"
        ],
        [
            "id" => 5,
            "name" => "Marco",
            "surname" => "Neri",
            "message" => "Salve, vorrei prenotare l'appartamento dal 10 al 15 giugno.",
            "address" => "marco.neri@example.com",
            "apartment_id" => 5,
            "created_at" => "2023/02/22"
        ],
        [
            "id" => 6,
            "name" => "Francesca",
            "surname" => "Rosa",
            "message" => "Buongiorno, l'appartamento è disponibile per la prima settimana di luglio?",
            "address" => "francesca.rosa@example.com",
            "apartment_id" => 6,
            "created_at" => "2023/02/23"
        ],
        [
            "id" => 7,
            "name" => "Andrea",
            "surname" => "Marrone",
            "message" => "Vorrei sapere se è possibile prenotare l'appartamento dal 1 al 7 agosto.",
            "address" => "andrea.marrone@example.com",
            "apartment_id" => 7,
            "created_at" => "2023/02/24"
        ],
        [
            "id" => 8,
            "name" => "Elena",
            "surname" => "Viola",
            "message" => "Salve, è disponibile l'appartamento per una settimana a partire dal 15 settembre?",
            "address" => "elena.viola@example.com",
            "apartment_id" => 8,
            "created_at" => "2023/12/26"
        ],
        [
            "id" => 9,
            "name" => "Fabio",
            "surname" => "Celeste",
            "message" => "Vorrei prenotare l'appartamento per due settimane a partire dal 20 giugno.",
            "address" => "fabio.celeste@example.com",
            "apartment_id" => 9,
            "created_at" => "2023/12/25"
        ],
        [
            "id" => 10,
            "name" => "Sara",
            "surname" => "Lilla",
            "message" => "Buongiorno, è disponibile l'appartamento per il weekend del 1 luglio?",
            "address" => "sara.lilla@example.com",
            "apartment_id" => 10,
            "created_at" => "2023/12/27"
        ],
        [
            "id" => 11,
            "name" => "Giulia",
            "surname" => "Marino",
            "message" => "Vorrei sapere se l'appartamento è libero dal 5 al 12 agosto.",
            "address" => "giulia.marino@example.com",
            "apartment_id" => 11,
            "created_at" => "2023/12/28"
        ],
        [
            "id" => 12,
            "name" => "Paolo",
            "surname" => "Blu",
            "message" => "Salve, è possibile prenotare l'appartamento per una settimana a partire dal 20 settembre?",
            "address" => "paolo.blu@example.com",
            "apartment_id" => 12,
            "created_at" => "2023/12/29"
        ],
        [
            "id" => 13,
            "name" => "Lorenzo",
            "surname" => "Arancio",
            "message" => "Vorrei prenotare l'appartamento dal 1 al 7 luglio.",
            "address" => "lorenzo.arancio@example.com",
            "apartment_id" => 13,
            "created_at" => "2023/12/01"
        ],
        [
            "id" => 14,
            "name" => "Martina",
            "surname" => "Bianco",
            "message" => "Buongiorno, l'appartamento è disponibile per due settimane a partire dal 15 agosto?",
            "address" => "martina.bianco@example.com",
            "apartment_id" => 14,
            "created_at" => "2023/12/02"
        ],
        [
            "id" => 15,
            "name" => "Davide",
            "surname" => "Rosso",
            "message" => "Salve, vorrei prenotare l'appartamento dal 5 al 12 settembre.",
            "address" => "davide.rosso@example.com",
            "apartment_id" => 15,
            "created_at" => "2023/12/04"
        ],
        [
            "id" => 16,
            "name" => "Alessia",
            "surname" => "Giallo",
            "message" => "Vorrei sapere se è disponibile l'appartamento per una settimana a partire dal 10 luglio.",
            "address" => "alessia.giallo@example.com",
            "apartment_id" => 16,
            "created_at" => "2023/12/03"
        ],
        [
            "id" => 17,
            "name" => "Matteo",
            "surname" => "Nero",
            "message" => "Buongiorno, posso prenotare l'appartamento dal 20 al 27 agosto?",
            "address" => "matteo.nero@example.com",
            "apartment_id" => 17,
            "created_at" => "2023/12/05"
        ],
        [
            "id" => 18,
            "name" => "Sofia",
            "surname" => "Rossi",
            "message" => "Salve, l'appartamento è libero per una settimana a partire dal 1 settembre?",
            "address" => "sofia.rossi@example.com",
            "apartment_id" => 18,
            "created_at" => "2023/12/06"
        ],
        [
            "id" => 19,
            "name" => "Giuseppe",
            "surname" => "Verdi",
            "message" => "Vorrei prenotare l'appartamento per due settimane a partire dal 10 agosto.",
            "address" => "giuseppe.verdi@example.com",
            "apartment_id" => 19,
            "created_at" => "2023/12/07"
        ],
        [
            "id" => 20,
            "name" => "Ilaria",
            "surname" => "Blu",
            "message" => "Buongiorno, è disponibile l'appartamento dal 15 al 22 luglio?",
            "address" => "ilaria.blu@example.com",
            "apartment_id" => 20,
            "created_at" => "2023/12/08"
        ],
        [
            "id" => 21,
            "name" => "Federico",
            "surname" => "Marrone",
            "message" => "Salve, vorrei prenotare l'appartamento per una settimana a partire dal 20 giugno.",
            "address" => "federico.marrone@example.com",
            "apartment_id" => 21,
            "created_at" => "2023/03/09"
        ],
        [
            "id" => 22,
            "name" => "Alessandro",
            "surname" => "Viola",
            "message" => "Vorrei sapere se l'appartamento è libero per due settimane a partire dal 5 luglio.",
            "address" => "alessandro.viola@example.com",
            "apartment_id" => 22,
            "created_at" => "2023/09/10"
        ],
        [
            "id" => 23,
            "name" => "Valentina",
            "surname" => "Celeste",
            "message" => "Buongiorno, posso prenotare l'appartamento dal 1 al 7 agosto?",
            "address" => "valentina.celeste@example.com",
            "apartment_id" => 23,
            "created_at" => "2023/09/11"
        ],
        [
            "id" => 24,
            "name" => "Antonio",
            "surname" => "Lilla",
            "message" => "Salve, vorrei prenotare l'appartamento per una settimana a partire dal 10 settembre.",
            "address" => "antonio.lilla@example.com",
            "apartment_id" => 22,
            "created_at" => "2023/09/12"
        ],
        [
            "id" => 25,
            "name" => "Giovanna",
            "surname" => "Rossi",
            "message" => "Vorrei sapere se l'appartamento è disponibile dal 15 al 22 giugno.",
            "address" => "giovanna.rossi@example.com",
            "apartment_id" => 1,
            "created_at" => "2023/09/13"
        ],
        [
            "id" => 26,
            "name" => "Paola",
            "surname" => "Bianchi",
            "message" => "Buongiorno, l'appartamento è libero per due settimane a partire dal 5 luglio?",
            "address" => "paola.bianchi@example.com",
            "apartment_id" => 2,
            "created_at" => "2023/12/14"
        ],
        [
            "id" => 27,
            "name" => "Tommaso",
            "surname" => "Verdi",
            "message" => "Salve, posso prenotare l'appartamento dal 10 al 17 agosto?",
            "address" => "tommaso.verdi@example.com",
            "apartment_id" => 3,
            "created_at" => "2023/09/14"
        ],
        [
            "id" => 28,
            "name" => "Simona",
            "surname" => "Gialli",
            "message" => "Vorrei sapere se è disponibile l'appartamento per una settimana a partire dal 1 settembre.",
            "address" => "simona.gialli@example.com",
            "apartment_id" => 4,
            "created_at" => "2023/09/15"
        ],
        [
            "id" => 29,
            "name" => "Carlo",
            "surname" => "Neri",
            "message" => "Buongiorno, posso prenotare l'appartamento dal 20 al 27 luglio?",
            "address" => "carlo.neri@example.com",
            "apartment_id" => 5,
            "created_at" => "2023/09/16"
        ],
        [
            "id" => 30,
            "name" => "Marta",
            "surname" => "Rosa",
            "message" => "Salve, vorrei prenotare l'appartamento per una settimana a partire dal 10 agosto.",
            "address" => "marta.rosa@example.com",
            "apartment_id" => 6,
            "created_at" => "2023/09/17"
        ],
        [
            "id" => 31,
            "name" => "Nicola",
            "surname" => "Marrone",
            "message" => "Vorrei sapere se l'appartamento è libero dal 15 al 22 settembre.",
            "address" => "nicola.marrone@example.com",
            "apartment_id" => 7,
            "created_at" => "2023/03/18"
        ],
        [
            "id" => 32,
            "name" => "Roberta",
            "surname" => "Viola",
            "message" => "Buongiorno, l'appartamento è disponibile per due settimane a partire dal 1 luglio?",
            "address" => "roberta.viola@example.com",
            "apartment_id" => 8,
            "created_at" => "2023/03/19"
        ],
        [
            "id" => 33,
            "name" => "Angelo",
            "surname" => "Celeste",
            "message" => "Salve, posso prenotare l'appartamento dal 5 al 12 agosto?",
            "address" => "angelo.celeste@example.com",
            "apartment_id" => 9,
            "created_at" => "2023/03/20"
        ],
        [
            "id" => 34,
            "name" => "Veronica",
            "surname" => "Lilla",
            "message" => "Vorrei sapere se l'appartamento è disponibile per una settimana a partire dal 20 settembre.",
            "address" => "veronica.lilla@example.com",
            "apartment_id" => 10,
            "created_at" => "2023/03/21"
        ],
        [
            "id" => 35,
            "name" => "Giorgio",
            "surname" => "Marino",
            "message" => "Buongiorno, posso prenotare l'appartamento dal 1 al 7 luglio?",
            "address" => "giorgio.marino@example.com",
            "apartment_id" => 11,
            "created_at" => "2023/03/22"
        ],
        [
            "id" => 36,
            "name" => "Giada",
            "surname" => "Blu",
            "message" => "Salve, vorrei prenotare l'appartamento per due settimane a partire dal 10 agosto.",
            "address" => "giada.blu@example.com",
            "apartment_id" => 12,
            "created_at" => "2023/03/23"
        ],
        [
            "id" => 37,
            "name" => "Emanuele",
            "surname" => "Arancio",
            "message" => "Vorrei sapere se l'appartamento è libero dal 15 al 22 luglio.",
            "address" => "emanuele.arancio@example.com",
            "apartment_id" => 13,
            "created_at" => "2023/03/24"
        ],
        [
            "id" => 38,
            "name" => "Silvia",
            "surname" => "Bianco",
            "message" => "Buongiorno, posso prenotare l'appartamento dal 1 al 7 agosto?",
            "address" => "silvia.bianco@example.com",
            "apartment_id" => 14,
            "created_at" => "2023/03/25"
        ],
        [
            "id" => 39,
            "name" => "Massimo",
            "surname" => "Rosso",
            "message" => "Salve, vorrei prenotare l'appartamento per una settimana a partire dal 10 settembre.",
            "address" => "massimo.rosso@example.com",
            "apartment_id" => 15,
            "created_at" => "2023/03/26"
        ],
        [
            "id" => 40,
            "name" => "Elisa",
            "surname" => "Giallo",
            "message" => "Vorrei sapere se l'appartamento è disponibile per due settimane a partire dal 1 luglio.",
            "address" => "elisa.giallo@example.com",
            "apartment_id" => 16,
            "created_at" => "2023/03/27"
        ],
        [
            "id" => 41,
            "name" => "Vittorio",
            "surname" => "Nero",
            "message" => "Buongiorno, posso prenotare l'appartamento dal 20 al 27 agosto?",
            "address" => "vittorio.nero@example.com",
            "apartment_id" => 17,
            "created_at" => "2023/11/28"
        ],
        [
            "id" => 42,
            "name" => "Federica",
            "surname" => "Rossi",
            "message" => "Salve, vorrei prenotare l'appartamento per una settimana a partire dal 1 settembre.",
            "address" => "federica.rossi@example.com",
            "apartment_id" => 18,
            "created_at" => "2023/11/29"
        ],
        [
            "id" => 43,
            "name" => "Raffaele",
            "surname" => "Verdi",
            "message" => "Vorrei sapere se l'appartamento è disponibile dal 10 al 17 agosto.",
            "address" => "raffaele.verdi@example.com",
            "apartment_id" => 19,
            "created_at" => "2023/11/30"
        ],
        [
            "id" => 44,
            "name" => "Claudia",
            "surname" => "Blu",
            "message" => "Buongiorno, posso prenotare l'appartamento per due settimane a partire dal 15 settembre?",
            "address" => "claudia.blu@example.com",
            "apartment_id" => 20,
            "created_at" => "2023/11/31"
        ],
        [
            "id" => 45,
            "name" => "Stefano",
            "surname" => "Marrone",
            "message" => "Salve, vorrei prenotare l'appartamento per una settimana a partire dal 5 luglio.",
            "address" => "stefano.marrone@example.com",
            "apartment_id" => 21,
            "created_at" => "2023/11/01"
        ],
        [
            "id" => 46,
            "name" => "Arianna",
            "surname" => "Viola",
            "message" => "Vorrei sapere se l'appartamento è disponibile dal 1 al 7 agosto.",
            "address" => "arianna.viola@example.com",
            "apartment_id" => 22,
            "created_at" => "2023/11/02"
        ],
        [
            "id" => 47,
            "name" => "Vincenzo",
            "surname" => "Celeste",
            "message" => "Buongiorno, posso prenotare l'appartamento dal 10 al 17 settembre?",
            "address" => "vincenzo.celeste@example.com",
            "apartment_id" => 23,
            "created_at" => "2023/11/03"
        ],
        [
            "id" => 48,
            "name" => "Serena",
            "surname" => "Lilla",
            "message" => "Salve, vorrei prenotare l'appartamento per una settimana a partire dal 20 giugno.",
            "address" => "serena.lilla@example.com",
            "apartment_id" => 22,
            "created_at" => "2023/11/04"
        ],
        [
            "id" => 49,
            "name" => "Filippo",
            "surname" => "Rossi",
            "message" => "Vorrei sapere se l'appartamento è disponibile per due settimane a partire dal 5 luglio.",
            "address" => "filippo.rossi@example.com",
            "apartment_id" => 1,
            "created_at" => "2023/11/05"
        ],
        [
            "id" => 50,
            "name" => "Gabriella",
            "surname" => "Bianchi",
            "message" => "Buongiorno, posso prenotare l'appartamento dal 1 al 7 agosto?",
            "address" => "gabriella.bianchi@example.com",
            "apartment_id" => 2,
            "created_at" => "2023/10/06"
        ],
        [
            "id" => 51,
            "name" => "Dario",
            "surname" => "Verdi",
            "message" => "Salve, vorrei prenotare l'appartamento per una settimana a partire dal 10 settembre.",
            "address" => "dario.verdi@example.com",
            "apartment_id" => 3,
            "created_at" => "2023/10/07"
        ],
        [
            "id" => 52,
            "name" => "Beatrice",
            "surname" => "Gialli",
            "message" => "Vorrei sapere se l'appartamento è disponibile dal 15 al 22 luglio.",
            "address" => "beatrice.gialli@example.com",
            "apartment_id" => 4,
            "created_at" => "2023/10/08"
        ],
        [
            "id" => 53,
            "name" => "Alberto",
            "surname" => "Neri",
            "message" => "Buongiorno, posso prenotare l'appartamento per due settimane a partire dal 1 agosto?",
            "address" => "alberto.neri@example.com",
            "apartment_id" => 5,
            "created_at" => "2023/10/09"
        ],
        [
            "id" => 54,
            "name" => "Camilla",
            "surname" => "Rosa",
            "message" => "Salve, vorrei prenotare l'appartamento per una settimana a partire dal 10 giugno.",
            "address" => "camilla.rosa@example.com",
            "apartment_id" => 6,
            "created_at" => "2023/10/10"
        ],
        [
            "id" => 55,
            "name" => "Christian",
            "surname" => "Marrone",
            "message" => "Vorrei sapere se l'appartamento è disponibile dal 5 al 12 luglio.",
            "address" => "christian.marrone@example.com",
            "apartment_id" => 7,
            "created_at" => "2023/10/11"
        ],
        [
            "id" => 56,
            "name" => "Irene",
            "surname" => "Viola",
            "message" => "Buongiorno, posso prenotare l'appartamento per due settimane a partire dal 1 settembre?",
            "address" => "irene.viola@example.com",
            "apartment_id" => 8,
            "created_at" => "2023/10/12"
        ],
        [
            "id" => 57,
            "name" => "Riccardo",
            "surname" => "Celeste",
            "message" => "Salve, vorrei prenotare l'appartamento per una settimana a partire dal 15 agosto.",
            "address" => "riccardo.celeste@example.com",
            "apartment_id" => 9,
            "created_at" => "2023/10/13"
        ],
        [
            "id" => 58,
            "name" => "Angela",
            "surname" => "Lilla",
            "message" => "Vorrei sapere se l'appartamento è disponibile dal 20 al 27 luglio.",
            "address" => "angela.lilla@example.com",
            "apartment_id" => 10,
            "created_at" => "2023/10/14"
        ],
        [
            "id" => 59,
            "name" => "Daniele",
            "surname" => "Marino",
            "message" => "Buongiorno, posso prenotare l'appartamento per due settimane a partire dal 5 settembre?",
            "address" => "daniele.marino@example.com",
            "apartment_id" => 11,
            "created_at" => "2023/10/15"
        ],
        [
            "id" => 60,
            "name" => "Giada",
            "surname" => "Blu",
            "message" => "Salve, vorrei prenotare l'appartamento per una settimana a partire dal 10 luglio.",
            "address" => "giada.blu@example.com",
            "apartment_id" => 12,
            "created_at" => "2023/10/16"
        ],
        [
            "id" => 61,
            "name" => "Enrico",
            "surname" => "Arancio",
            "message" => "Vorrei sapere se l'appartamento è disponibile dal 15 al 22 agosto.",
            "address" => "enrico.arancio@example.com",
            "apartment_id" => 13,
            "created_at" => "2023/06/17"
        ],
        [
            "id" => 62,
            "name" => "Silvana",
            "surname" => "Bianco",
            "message" => "Buongiorno, posso prenotare l'appartamento per una settimana a partire dal 20 settembre?",
            "address" => "silvana.bianco@example.com",
            "apartment_id" => 14,
            "created_at" => "2023/06/18"
        ],
        [
            "id" => 63,
            "name" => "Marco",
            "surname" => "Rosso",
            "message" => "Salve, vorrei prenotare l'appartamento per due settimane a partire dal 1 giugno.",
            "address" => "marco.rosso@example.com",
            "apartment_id" => 15,
            "created_at" => "2023/06/19"
        ],
        [
            "id" => 64,
            "name" => "Simone",
            "surname" => "Giallo",
            "message" => "Vorrei sapere se l'appartamento è disponibile dal 5 al 12 luglio.",
            "address" => "simone.giallo@example.com",
            "apartment_id" => 16,
            "created_at" => "2023/06/20"
        ],
        [
            "id" => 65,
            "name" => "Carla",
            "surname" => "Nero",
            "message" => "Buongiorno, posso prenotare l'appartamento per due settimane a partire dal 1 agosto?",
            "address" => "carla.nero@example.com",
            "apartment_id" => 17,
            "created_at" => "2023/06/21"
        ],
        [
            "id" => 66,
            "name" => "Luca",
            "surname" => "Rossi",
            "message" => "Salve, vorrei prenotare l'appartamento per una settimana a partire dal 10 settembre.",
            "address" => "luca.rossi@example.com",
            "apartment_id" => 18,
            "created_at" => "2023/04/22"
        ],
        [
            "id" => 67,
            "name" => "Monica",
            "surname" => "Verdi",
            "message" => "Vorrei sapere se l'appartamento è disponibile dal 15 al 22 giugno.",
            "address" => "monica.verdi@example.com",
            "apartment_id" => 19,
            "created_at" => "2023/04/23"
        ],
        [
            "id" => 68,
            "name" => "Sergio",
            "surname" => "Blu",
            "message" => "Buongiorno, posso prenotare l'appartamento per due settimane a partire dal 5 agosto?",
            "address" => "sergio.blu@example.com",
            "apartment_id" => 20,
            "created_at" => "2023/04/24"
        ],
        [
            "id" => 69,
            "name" => "Michele",
            "surname" => "Marrone",
            "message" => "Salve, vorrei prenotare l'appartamento per una settimana a partire dal 1 settembre.",
            "address" => "michele.marrone@example.com",
            "apartment_id" => 21,
            "created_at" => "2023/04/25"
        ],
        [
            "id" => 70,
            "name" => "Luisa",
            "surname" => "Viola",
            "message" => "Vorrei sapere se l'appartamento è disponibile dal 10 al 17 luglio.",
            "address" => "luisa.viola@example.com",
            "apartment_id" => 22,
            "created_at" => "2023/04/26"
        ],
        [
            "id" => 71,
            "name" => "Franco",
            "surname" => "Celeste",
            "message" => "Buongiorno, posso prenotare l'appartamento per due settimane a partire dal 1 agosto?",
            "address" => "franco.celeste@example.com",
            "apartment_id" => 23,
            "created_at" => "2023/04/27"
        ],
        [
            "id" => 72,
            "name" => "Stefania",
            "surname" => "Lilla",
            "message" => "Salve, vorrei prenotare l'appartamento per una settimana a partire dal 10 giugno.",
            "address" => "stefania.lilla@example.com",
            "apartment_id" => 22,
            "created_at" => "2023/04/28"
        ],
        [
            "id" => 73,
            "name" => "Matilde",
            "surname" => "Rossi",
            "message" => "Vorrei sapere se l'appartamento è disponibile dal 15 al 22 luglio.",
            "address" => "matilde.rossi@example.com",
            "apartment_id" => 1,
            "created_at" => "2023/04/29"
        ],
        [
            "id" => 74,
            "name" => "Roberto",
            "surname" => "Bianchi",
            "message" => "Buongiorno, posso prenotare l'appartamento per due settimane a partire dal 1 agosto?",
            "address" => "roberto.bianchi@example.com",
            "apartment_id" => 2,
            "created_at" => "2023/04/30"
        ],
        [
            "id" => 75,
            "name" => "Clara",
            "surname" => "Verdi",
            "message" => "Salve, vorrei prenotare l'appartamento per una settimana a partire dal 10 settembre.",
            "address" => "clara.verdi@example.com",
            "apartment_id" => 3,
            "created_at" => "2023/05/01"
        ],
        [
            "id" => 76,
            "name" => "Giorgia",
            "surname" => "Gialli",
            "message" => "Vorrei sapere se l'appartamento è disponibile dal 5 al 12 agosto.",
            "address" => "giorgia.gialli@example.com",
            "apartment_id" => 4,
            "created_at" => "2023/05/02"
        ],
        [
            "id" => 77,
            "name" => "Sandro",
            "surname" => "Neri",
            "message" => "Buongiorno, posso prenotare l'appartamento per due settimane a partire dal 1 luglio?",
            "address" => "sandro.neri@example.com",
            "apartment_id" => 5,
            "created_at" => "2023/07/03"
        ],
        [
            "id" => 78,
            "name" => "Federica",
            "surname" => "Rosa",
            "message" => "Salve, vorrei prenotare l'appartamento per una settimana a partire dal 10 giugno.",
            "address" => "federica.rosa@example.com",
            "apartment_id" => 6,
            "created_at" => "2023/05/04"
        ],
        [
            "id" => 79,
            "name" => "Gabriele",
            "surname" => "Marrone",
            "message" => "Vorrei sapere se l'appartamento è disponibile dal 15 al 22 luglio.",
            "address" => "gabriele.marrone@example.com",
            "apartment_id" => 7,
            "created_at" => "2023/07/05"
        ],
        [
            "id" => 80,
            "name" => "Annalisa",
            "surname" => "Viola",
            "message" => "Buongiorno, posso prenotare l'appartamento per due settimane a partire dal 1 agosto?",
            "address" => "annalisa.viola@example.com",
            "apartment_id" => 8,
            "created_at" => "2023/05/06"
        ],
        [
            "id" => 81,
            "name" => "Edoardo",
            "surname" => "Celeste",
            "message" => "Salve, vorrei prenotare l'appartamento per una settimana a partire dal 10 settembre.",
            "address" => "edoardo.celeste@example.com",
            "apartment_id" => 9,
            "created_at" => "2023/07/07"
        ],
        [
            "id" => 82,
            "name" => "Agnese",
            "surname" => "Lilla",
            "message" => "Vorrei sapere se l'appartamento è disponibile dal 5 al 12 luglio.",
            "address" => "agnese.lilla@example.com",
            "apartment_id" => 10,
            "created_at" => "2023/05/08"
        ],
        [
            "id" => 83,
            "name" => "Lorenzo",
            "surname" => "Marino",
            "message" => "Buongiorno, posso prenotare l'appartamento per due settimane a partire dal 1 settembre?",
            "address" => "lorenzo.marino@example.com",
            "apartment_id" => 11,
            "created_at" => "2023/07/09"
        ],
        [
            "id" => 84,
            "name" => "Marianna",
            "surname" => "Blu",
            "message" => "Salve, vorrei prenotare l'appartamento per una settimana a partire dal 10 agosto.",
            "address" => "marianna.blu@example.com",
            "apartment_id" => 12,
            "created_at" => "2023/07/10"
        ],
        [
            "id" => 85,
            "name" => "Salvatore",
            "surname" => "Arancio",
            "message" => "Vorrei sapere se l'appartamento è disponibile dal 15 al 22 settembre.",
            "address" => "salvatore.arancio@example.com",
            "apartment_id" => 13,
            "created_at" => "2023/07/11"
        ],
        [
            "id" => 86,
            "name" => "Emma",
            "surname" => "Bianco",
            "message" => "Buongiorno, posso prenotare l'appartamento per due settimane a partire dal 1 luglio?",
            "address" => "emma.bianco@example.com",
            "apartment_id" => 14,
            "created_at" => "2023/07/12"
        ],
        [
            "id" => 87,
            "name" => "Giuseppe",
            "surname" => "Rosso",
            "message" => "Salve, vorrei prenotare l'appartamento per una settimana a partire dal 10 giugno.",
            "address" => "giuseppe.rosso@example.com",
            "apartment_id" => 15,
            "created_at" => "2023/05/13"
        ],
        [
            "id" => 88,
            "name" => "Andrea",
            "surname" => "Giallo",
            "message" => "Vorrei sapere se l'appartamento è disponibile dal 5 al 12 luglio.",
            "address" => "andrea.giallo@example.com",
            "apartment_id" => 16,
            "created_at" => "2023/05/14"
        ],
        [
            "id" => 89,
            "name" => "Martina",
            "surname" => "Nero",
            "message" => "Buongiorno, posso prenotare l'appartamento per due settimane a partire dal 1 settembre?",
            "address" => "martina.nero@example.com",
            "apartment_id" => 17,
            "created_at" => "2023/01/15"
        ],
        [
            "id" => 90,
            "name" => "Lucia",
            "surname" => "Rossi",
            "message" => "Salve, vorrei prenotare l'appartamento per una settimana a partire dal 10 luglio.",
            "address" => "lucia.rossi@example.com",
            "apartment_id" => 18,
            "created_at" => "2023/05/16"
        ],
        [
            "id" => 91,
            "name" => "Fabio",
            "surname" => "Verdi",
            "message" => "Vorrei sapere se l'appartamento è disponibile dal 15 al 22 settembre.",
            "address" => "fabio.verdi@example.com",
            "apartment_id" => 19,
            "created_at" => "2023/05/17"
        ],
        [
            "id" => 92,
            "name" => "Cristina",
            "surname" => "Blu",
            "message" => "Buongiorno, posso prenotare l'appartamento per due settimane a partire dal 1 agosto?",
            "address" => "cristina.blu@example.com",
            "apartment_id" => 20,
            "created_at" => "2023/01/18"
        ],
        [
            "id" => 93,
            "name" => "Davide",
            "surname" => "Marrone",
            "message" => "Salve, vorrei prenotare l'appartamento per una settimana a partire dal 10 settembre.",
            "address" => "davide.marrone@example.com",
            "apartment_id" => 21,
            "created_at" => "2023/05/19"
        ],
        [
            "id" => 94,
            "name" => "Serena",
            "surname" => "Viola",
            "message" => "Vorrei sapere se l'appartamento è disponibile dal 5 al 12 luglio.",
            "address" => "serena.viola@example.com",
            "apartment_id" => 22,
            "created_at" => "2023/05/20"
        ],
        [
            "id" => 95,
            "name" => "Pietro",
            "surname" => "Celeste",
            "message" => "Buongiorno, posso prenotare l'appartamento per due settimane a partire dal 1 luglio?",
            "address" => "pietro.celeste@example.com",
            "apartment_id" => 23,
            "created_at" => "2023/01/21"
        ],
        [
            "id" => 96,
            "name" => "Elisa",
            "surname" => "Lilla",
            "message" => "Salve, vorrei prenotare l'appartamento per una settimana a partire dal 10 agosto.",
            "address" => "elisa.lilla@example.com",
            "apartment_id" => 22,
            "created_at" => "2023/05/22"
        ],
        [
            "id" => 97,
            "name" => "Maria Teresa",
            "surname" => "Pinasco",
            "message" => "Buongiorno, posso prenotare l'appartamento per due settimane?",
            "address" => "elisa.lilla@example.com",
            "apartment_id" => 22,
            "created_at" => "2023/01/23"
        ],[
            "id" => 98,
            "name" => "Sofia",
            "surname" => "Guidice",
            "message" => "Salve, vorrei prenotare l'appartamento per una settimana a partire dal 15 settembre.",
            "address" => "elisa.lilla@example.com",
            "apartment_id" => 22,
            "created_at" => "2023/05/24"
        ],[
            "id" => 99,
            "name" => "Matteo",
            "surname" => "Brando",
            "message" => "Salve, vorrei prenotare l'appartamento per una settimana .",
            "address" => "elisa.lilla@example.com",
            "apartment_id" => 22,
            "created_at" => "2023/01/25"
        ],[
            "id" => 100,
            "name" => "Chiara",
            "surname" => "Brambilla",
            "message" => "Salve, vorrei maggiori informazioni sull'appartamento.",
            "address" => "elisa.lilla@example.com",
            "apartment_id" => 22,
            "created_at" => "2023/05/26"
        ],
        

        ];

        foreach ($messages as $message) {
            $newMessage = new Message();
            $newMessage->id = $message['id'];
            $newMessage->name = $message['name'];
            $newMessage->surname = $message['surname'];
            $newMessage->message = $message['message'];
            $newMessage->address = $message['address'];
            $newMessage->apartment_id = $message['apartment_id'];
            $newMessage->created_at = $message['created_at'];

            $newMessage->save();
        }
    }
    
}



