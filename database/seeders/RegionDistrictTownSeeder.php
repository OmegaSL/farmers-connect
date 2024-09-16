<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Store;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RegionDistrictTownSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regions = [
            // [
            //     'name' => 'Ashanti',
            //     'name' => 'Ashanti',
            //     'districts' => [
            //         [
            //             'name' => 'Afigya Kwabre',
            //             'towns' => ['Kodie', 'Boamang', 'Tetrem']
            //         ],
            //         [
            //             'name' => 'Ahafo Ano North',
            //             'towns' => ['Tepa', 'Manfo', 'Anyinasuso']
            //         ],
            //         [
            //             'name' => 'Ahafo Ano South',
            //             'towns' => ['Mankranso', 'Sabronum', 'Mpasaaso']
            //         ],
            //         [
            //             'name' => 'Amansie Central',
            //             'towns' => ['Jacobu', 'Tweapease', 'Fiankoma']
            //         ],
            //         [
            //             'name' => 'Amansie West',
            //             'towns' => ['Manso Nkwanta', 'Esienkyem', 'Agroyesum']
            //         ],
            //         [
            //             'name' => 'Asante Akim Central',
            //             'towns' => ['Konongo', 'Odumase', 'Praaso']
            //         ],
            //         [
            //             'name' => 'Asante Akim North',
            //             'towns' => ['Agogo', 'Juansa', 'Hwidiem']
            //         ],
            //         [
            //             'name' => 'Asante Akim South',
            //             'towns' => ['Juaso', 'Obogu', 'Bompata']
            //         ],
            //         [
            //             'name' => 'Atwima Kwanwoma',
            //             'towns' => ['Foase', 'Trabuom', 'Twedie']
            //         ],
            //         [
            //             'name' => 'Atwima Mponua',
            //             'towns' => ['Nyinahin', 'Mpasatia', 'Tanodumase']
            //         ],
            //         [
            //             'name' => 'Atwima Nwabiagya',
            //             'towns' => ['Nkawie', 'Abuakwa', 'Toase']
            //         ],
            //         [
            //             'name' => 'Bekwai',
            //             'towns' => ['Bekwai', 'Asiwa', 'Bogyawe']
            //         ],
            //         [
            //             'name' => 'Bosome Freho',
            //             'towns' => ['Asiwa', 'Yapesa', 'Nsuta']
            //         ],
            //         [
            //             'name' => 'Botsomtwe',
            //             'towns' => ['Kuntenase', 'Jachie', 'Esreso']
            //         ],
            //         [
            //             'name' => 'Ejisu',
            //             'towns' => ['Ejisu', 'Juaben', 'Besease']
            //         ],
            //         [
            //             'name' => 'Ejura Sekyedumase',
            //             'towns' => ['Ejura', 'Sekyedumase', 'Anyinasu']
            //         ],
            //         [
            //             'name' => 'Kumasi',
            //             'towns' => ['Kumasi', 'Asokwa', 'Bantama', 'Nhyiaeso']
            //         ],
            //         [
            //             'name' => 'Kwabre East',
            //             'towns' => ['Mamponteng', 'Antoa', 'Kasaam']
            //         ],
            //         [
            //             'name' => 'Mampong',
            //             'towns' => ['Mampong', 'Nsuta', 'Beposo']
            //         ],
            //         [
            //             'name' => 'Obuasi',
            //             'towns' => ['Obuasi', 'Akrokerri', 'Adaase']
            //         ],
            //         [
            //             'name' => 'Offinso North',
            //             'towns' => ['Akomadan', 'Nkenkaasu', 'Afrancho']
            //         ],
            //         [
            //             'name' => 'Offinso South',
            //             'towns' => ['Offinso', 'Abofour', 'Kokote']
            //         ],
            //         [
            //             'name' => 'Sekyere Afram Plains',
            //             'towns' => ['Drobonso', 'Kumawu', 'Dagomba']
            //         ],
            //         [
            //             'name' => 'Sekyere Central',
            //             'towns' => ['Nsuta', 'Kwamang', 'Beposo']
            //         ],
            //         [
            //             'name' => 'Sekyere East',
            //             'towns' => ['Effiduase', 'Asokore', 'Oyoko']
            //         ],
            //         [
            //             'name' => 'Sekyere Kumawu',
            //             'towns' => ['Kumawu', 'Besoro', 'Woraso']
            //         ],
            //         [
            //             'name' => 'Sekyere South',
            //             'towns' => ['Agona', 'Wiamoase', 'Atonsu']
            //         ],
            //     ],
            // ],
            // [
            //     'name' => 'Brong Ahafo',
            //     'districts' => [
            //         [
            //             'name' => 'Asunafo North',
            //             'towns' => ['Goaso', 'Mim', 'Ayomso']
            //         ],
            //         [
            //             'name' => 'Asunafo South',
            //             'towns' => ['Kukuom', 'Kwapong', 'Noberkaw']
            //         ],
            //         [
            //             'name' => 'Asutifi North',
            //             'towns' => ['Kenyasi', 'Ntotroso', 'Acherensua']
            //         ],
            //         [
            //             'name' => 'Asutifi South',
            //             'towns' => ['Hwidiem', 'Nkaseim', 'Dadiesoaba']
            //         ],
            //         [
            //             'name' => 'Atebubu-Amantin',
            //             'towns' => ['Atebubu', 'Amantin', 'New Konkrompe']
            //         ],
            //         [
            //             'name' => 'Banda',
            //             'towns' => ['Banda Ahenkro', 'Bui', 'Sabiye']
            //         ],
            //         [
            //             'name' => 'Berekum',
            //             'towns' => ['Berekum', 'Senase', 'Kato']
            //         ],
            //         [
            //             'name' => 'Dormaa East',
            //             'towns' => ['Wamfie', 'Wamanafo', 'Nkrankwanta']
            //         ],
            //         [
            //             'name' => 'Dormaa West',
            //             'towns' => ['Nkrankwanta', 'Diabaa', 'Kwakuanya']
            //         ],
            //         [
            //             'name' => 'Jaman North',
            //             'towns' => ['Sampa', 'Suma Ahenkro', 'Jamera']
            //         ],
            //         [
            //             'name' => 'Jaman South',
            //             'towns' => ['Drobo', 'Japekrom', 'Babianiha']
            //         ],
            //         [
            //             'name' => 'Kintampo North',
            //             'towns' => ['Kintampo', 'New Longoro', 'Babatokuma']
            //         ],
            //         [
            //             'name' => 'Kintampo South',
            //             'towns' => ['Jema', 'Amoma', 'Anyima']
            //         ],
            //         [
            //             'name' => 'Nkoranza North',
            //             'towns' => ['Busunya', 'Kranka', 'Dromankese']
            //         ],
            //         [
            //             'name' => 'Nkoranza South',
            //             'towns' => ['Nkoranza', 'Akumsa Domase', 'Donkro Nkwanta']
            //         ],
            //         [
            //             'name' => 'Pru',
            //             'towns' => ['Yeji', 'Prang', 'Parambo']
            //         ],
            //         [
            //             'name' => 'Sene',
            //             'towns' => ['Kwame Danso', 'Kajaji', 'Wiase']
            //         ],
            //         [
            //             'name' => 'Sunyani',
            //             'towns' => ['Sunyani', 'Abesim', 'Yawhima']
            //         ],
            //         [
            //             'name' => 'Sunyani West',
            //             'towns' => ['Odumase', 'Chiraa', 'Fiapre']
            //         ],
            //         [
            //             'name' => 'Tain',
            //             'towns' => ['Nsawkaw', 'Badu', 'Seikwa']
            //         ],
            //         [
            //             'name' => 'Techiman',
            //             'towns' => ['Techiman', 'Tuobodom', 'Aworowa']
            //         ],
            //         [
            //             'name' => 'Wenchi',
            //             'towns' => ['Wenchi', 'Subinso', 'Awisa']
            //         ],
            //     ]
            // ],
            // [
            //     'name' => 'Central',
            //     'districts' => [
            //         [
            //             'name' => 'Abura-Asebu-Kwamankese',
            //             'towns' => ['Abura Dunkwa', 'Asebu', 'Moree']
            //         ],
            //         [
            //             'name' => 'Agona East',
            //             'towns' => ['Nsaba', 'Duakwa', 'Kwanyako']
            //         ],
            //         [
            //             'name' => 'Agona West Municipal',
            //             'towns' => ['Swedru', 'Abodom', 'Nyakrom']
            //         ],
            //         [
            //             'name' => 'Ajumako-Enyan-Essiam',
            //             'towns' => ['Ajumako', 'Enyan Denkyira', 'Essiam']
            //         ],
            //         [
            //             'name' => 'Asikuma-Odoben-Brakwa',
            //             'towns' => ['Breman Asikuma', 'Odoben', 'Brakwa']
            //         ],
            //         [
            //             'name' => 'Assin North Municipal',
            //             'towns' => ['Assin Fosu', 'Assin Bereku', 'Assin Praso']
            //         ],
            //         [
            //             'name' => 'Assin South',
            //             'towns' => ['Nsuaem Kyekyewere', 'Assin Manso', 'Assin Andoe']
            //         ],
            //         [
            //             'name' => 'Awutu-Senya',
            //             'towns' => ['Awutu Breku', 'Bawjiase', 'Senya Beraku']
            //         ],
            //         [
            //             'name' => 'Awutu-Senya-East',
            //             'towns' => ['Kasoa', 'Oduponkpehe', 'Ofaakor']
            //         ],
            //         [
            //             'name' => 'Cape Coast',
            //             'towns' => ['Cape Coast', 'Elmina', 'Abura']
            //         ],
            //         [
            //             'name' => 'Effutu Municipal',
            //             'towns' => ['Winneba', 'Gyahadze', 'Ansaful']
            //         ],
            //         [
            //             'name' => 'Ekumfi',
            //             'towns' => ['Essuehyia', 'Otuam', 'Eyisam']
            //         ],
            //         [
            //             'name' => 'Gomoa East',
            //             'towns' => ['Potsin', 'Gomoa Afransi', 'Gomoa Dominase']
            //         ],
            //         [
            //             'name' => 'Gomoa West',
            //             'towns' => ['Apam', 'Mumford', 'Dago']
            //         ],
            //         [
            //             'name' => 'Komenda-Edina-Eguafo-Abirem',
            //             'towns' => ['Elmina', 'Komenda', 'Abrem Agona']
            //         ],
            //         [
            //             'name' => 'Mfantsiman Municipal',
            //             'towns' => ['Saltpond', 'Anomabo', 'Mankessim']
            //         ],
            //         [
            //             'name' => 'Twifo-Atti-Morkwa',
            //             'towns' => ['Twifo Praso', 'Morkwa', 'Nyinase']
            //         ],
            //         [
            //             'name' => 'Twifo-Heman-Lower-Denkyira',
            //             'towns' => ['Twifo Heman', 'Jukwa', 'Wawase']
            //         ],
            //         [
            //             'name' => 'Upper-Denkyira-East',
            //             'towns' => ['Dunkwa-On-Offin', 'Ayanfuri', 'Kyekyewere']
            //         ],
            //         [
            //             'name' => 'Upper-Denkyira-West',
            //             'towns' => ['Diaso', 'Dominase', 'Ntotroso']
            //         ],
            //     ]
            // ],
            [
                'name' => 'Eastern',
                'districts' => [
                    // [
                    //     'name' => 'Abuakwa North',
                    //     'towns' => ['Kukurantumi', 'Akyem Tafo', 'Osiem']
                    // ],
                    // [
                    //     'name' => 'Abuakwa South',
                    //     'towns' => ['Kyebi', 'Apedwa', 'Asafo']
                    // ],
                    // [
                    //     'name' => 'Achiase',
                    //     'towns' => ['Achiase', 'Asuboa', 'Anyinase']
                    // ],
                    // [
                    //     'name' => 'Afram Plains North',
                    //     'towns' => ['Donkorkrom', 'Forifori', 'Tease']
                    // ],
                    // [
                    //     'name' => 'Afram Plains South',
                    //     'towns' => ['Tease', 'Maame Krobo', 'Ekye Amanfrom']
                    // ],
                    // [
                    //     'name' => 'Akropong',
                    //     'towns' => ['Akropong', 'Abiriw', 'Larteh']
                    // ],
                    // [
                    //     'name' => 'Akuapim North',
                    //     'towns' => ['Akropong', 'Mamfe', 'Larteh']
                    // ],
                    // [
                    //     'name' => 'Akuapim South',
                    //     'towns' => ['Nsawam', 'Aburi', 'Adoagyiri']
                    // ],
                    // [
                    //     'name' => 'Asene Manso Akroso',
                    //     'towns' => ['Manso', 'Asene', 'Akroso']
                    // ],
                    // [
                    //     'name' => 'Atiwa East',
                    //     'towns' => ['Anyinam', 'Sekyere', 'Kwabeng']
                    // ],
                    // [
                    //     'name' => 'Atiwa West',
                    //     'towns' => ['Kwabeng', 'Abomosu', 'Tumfa']
                    // ],
                    // [
                    //     'name' => 'Ayensuano',
                    //     'towns' => ['Coaltar', 'Dokrochiwa', 'Asuboi']
                    // ],
                    // [
                    //     'name' => 'Birim Central',
                    //     'towns' => ['Oda', 'Akyem Oda', 'Gyadam']
                    // ],
                    // [
                    //     'name' => 'Birim North',
                    //     'towns' => ['New Abirem', 'Nkwateng', 'Afosu']
                    // ],
                    // [
                    //     'name' => 'Birim South',
                    //     'towns' => ['Akim Swedru', 'Achiase', 'Aperade']
                    // ],
                    // [
                    //     'name' => 'Denkyembour',
                    //     'towns' => ['Akwatia', 'Kade', 'Boadua']
                    // ],
                    // [
                    //     'name' => 'East Akim Municipal',
                    //     'towns' => ['Kibi', 'Apedwa', 'Asiakwa']
                    // ],
                    // [
                    //     'name' => 'Fanteakwa North',
                    //     'towns' => ['Begoro', 'Ehiamankyene', 'Bosuso']
                    // ],
                    // [
                    //     'name' => 'Fanteakwa South',
                    //     'towns' => ['Osino', 'Hemang', 'Saaman']
                    // ],
                    // [
                    //     'name' => 'Kade',
                    //     'towns' => ['Kade', 'Asuom', 'Boadua']
                    // ],
                    // [
                    //     'name' => 'Kwaebibirem',
                    //     'towns' => ['Kade', 'Asuom', 'Otumi']
                    // ],
                    // [
                    //     'name' => 'Kwahu Afram Plains North',
                    //     'towns' => ['Donkorkrom', 'Amankwakrom', 'Bruben']
                    // ],
                    // [
                    //     'name' => 'Kwahu Afram Plains South',
                    //     'towns' => ['Tease', 'Ekye Amanfrom', 'Maame Krobo']
                    // ],
                    // [
                    //     'name' => 'Kwahu East',
                    //     'towns' => ['Abetifi', 'Pepease', 'Nkwatia']
                    // ],
                    // [
                    //     'name' => 'Kwahu South',
                    //     'towns' => ['Mpraeso', 'Kwahu Tafo', 'Obo']
                    // ],
                    // [
                    //     'name' => 'Kwahu West Municipal',
                    //     'towns' => ['Nkawkaw', 'Obomeng', 'Atibie']
                    // ],
                    // [
                    //     'name' => 'Lower Manya Krobo',
                    //     'towns' => ['Odumase', 'Atua', 'Kpong']
                    // ],
                    [
                        'name' => 'New-Juaben Municipal',
                        'towns' => ['Koforidua', 'Effiduase', 'Oyoko']
                    ],
                    // [
                    //     'name' => 'Nkawkaw',
                    //     'towns' => ['Nkawkaw', 'Atibie', 'Mpraeso']
                    // ],
                    // [
                    //     'name' => 'Nsawam Adoagyire Municipal',
                    //     'towns' => ['Nsawam', 'Adoagyiri', 'Pakro']
                    // ],
                    // [
                    //     'name' => 'Suhum Municipal',
                    //     'towns' => ['Suhum', 'Nankese', 'Akorabo']
                    // ],
                    // [
                    //     'name' => 'Upper Manya Krobo',
                    //     'towns' => ['Asesewa', 'Sekesua', 'Akateng']
                    // ],
                    // [
                    //     'name' => 'Upper West Akim',
                    //     'towns' => ['Adeiso', 'Awenare', 'Okurase']
                    // ],
                    // [
                    //     'name' => 'West Akim Municipal',
                    //     'towns' => ['Asamankese', 'Osenase', 'Brekumanso']
                    // ],
                    // [
                    //     'name' => 'Yilo Krobo Municipal',
                    //     'towns' => ['Somanya', 'Nkurakan', 'Oterkpolu']
                    // ],
                ]
            ],
            // [
            //     'name' => 'Greater Accra',
            //     'districts' => [
            //         [
            //             'name' => 'Accra Metropolitan',
            //             'towns' => ['Accra', 'Jamestown', 'Usshertown']
            //         ],
            //         [
            //             'name' => 'Ada East',
            //             'towns' => ['Ada Foah', 'Big Ada', 'Kasseh']
            //         ],
            //         [
            //             'name' => 'Ada West',
            //             'towns' => ['Sege', 'Toflokpo', 'Anyamam']
            //         ],
            //         [
            //             'name' => 'Adenta',
            //             'towns' => ['Adenta', 'Frafraha', 'Ogbojo']
            //         ],
            //         [
            //             'name' => 'Ashaiman Municipal',
            //             'towns' => ['Ashaiman', 'Tulaku', 'Lebanon']
            //         ],
            //         [
            //             'name' => 'Ayawaso East',
            //             'towns' => ['Nima', 'Maamobi', 'Kanda']
            //         ],
            //         [
            //             'name' => 'Ayawaso North',
            //             'towns' => ['Accra New Town', 'Kokomlemle', 'New Fadama']
            //         ],
            //         [
            //             'name' => 'Ayawaso West',
            //             'towns' => ['Dzorwulu', 'Roman Ridge', 'Airport Residential Area']
            //         ],
            //         [
            //             'name' => 'Ayawaso Central',
            //             'towns' => ['Alajo', 'Kotobabi', 'Pig Farm']
            //         ],
            //         [
            //             'name' => 'Dade Kotopon',
            //             'towns' => ['La', 'Labone', 'Burma Camp']
            //         ],
            //         [
            //             'name' => 'Dangme East',
            //             'towns' => ['Ada Foah', 'Big Ada', 'Kasseh']
            //         ],
            //         [
            //             'name' => 'Dangme West',
            //             'towns' => ['Dodowa', 'Prampram', 'Afienya']
            //         ],
            //         [
            //             'name' => 'Ga Central',
            //             'towns' => ['Anyaa', 'Sowutuom', 'Awoshie']
            //         ],
            //         [
            //             'name' => 'Ga East',
            //             'towns' => ['Abokobi', 'Dome', 'Haatso']
            //         ],
            //         [
            //             'name' => 'Ga South',
            //             'towns' => ['Weija', 'Gbawe', 'Bortianor']
            //         ],
            //         [
            //             'name' => 'Ga West',
            //             'towns' => ['Amasaman', 'Pokuase', 'Ofankor']
            //         ],
            //         [
            //             'name' => 'Kpone Katamanso',
            //             'towns' => ['Kpone', 'Oyibi', 'Appolonia']
            //         ],
            //         [
            //             'name' => 'Krowor',
            //             'towns' => ['Nungua', 'Teshie', 'Baatsona']
            //         ],
            //         [
            //             'name' => 'La Dade Kotopon',
            //             'towns' => ['La', 'Labone', 'Burma Camp']
            //         ],
            //         [
            //             'name' => 'La Nkwantanang Madina',
            //             'towns' => ['Madina', 'Adenta West', 'Oyarifa']
            //         ],
            //         [
            //             'name' => 'Ledzokuku',
            //             'towns' => ['Teshie', 'Nungua', 'Manet']
            //         ],
            //         [
            //             'name' => 'Ningo Prampram',
            //             'towns' => ['Prampram', 'Dawhenya', 'Afienya']
            //         ],
            //         [
            //             'name' => 'Okaikwei North',
            //             'towns' => ['Achimota', 'Lapaz', 'Akweteman']
            //         ],
            //         [
            //             'name' => 'Okaikwei South',
            //             'towns' => ['Kaneshie', 'Bubuashie', 'Darkuman']
            //         ],
            //         [
            //             'name' => 'Shai Osudoku',
            //             'towns' => ['Dodowa', 'Ayikuma', 'Agomeda']
            //         ],
            //         [
            //             'name' => 'Tema Metropolitan',
            //             'towns' => ['Tema', 'Community 1', 'Community 25']
            //         ],
            //         [
            //             'name' => 'Tema West',
            //             'towns' => ['Sakumono', 'Lashibi', 'Adjei Kojo']
            //         ],
            //     ]
            // ],
            // [
            //     'name' => 'Northern',
            //     'districts' => [
            //         [
            //             'name' => 'Bole',
            //             'towns' => ['Bole', 'Bamboi', 'Maluwe']
            //         ],
            //         [
            //             'name' => 'Bunkpurugu-Yunyoo',
            //             'towns' => ['Bunkpurugu', 'Yunyoo', 'Nakpanduri']
            //         ],
            //         [
            //             'name' => 'Central Gonja',
            //             'towns' => ['Buipe', 'Mpaha', 'Kusawgu']
            //         ],
            //         [
            //             'name' => 'Chereponi',
            //             'towns' => ['Chereponi', 'Wenchiki', 'Saboba']
            //         ],
            //         [
            //             'name' => 'East Gonja',
            //             'towns' => ['Salaga', 'Kpandai', 'Makango']
            //         ],
            //         [
            //             'name' => 'Gushiegu',
            //             'towns' => ['Gushiegu', 'Kpatinga', 'Nabuli']
            //         ],
            //         [
            //             'name' => 'Karaga',
            //             'towns' => ['Karaga', 'Pishigu', 'Nyong']
            //         ],
            //         [
            //             'name' => 'Kpandai',
            //             'towns' => ['Kpandai', 'Katiejeli', 'Jambuai']
            //         ],
            //         [
            //             'name' => 'Mamprugu-Moagduri',
            //             'towns' => ['Yagaba', 'Kubori', 'Loagri']
            //         ],
            //         [
            //             'name' => 'Nanumba North',
            //             'towns' => ['Bimbilla', 'Juo', 'Dakpam']
            //         ],
            //         [
            //             'name' => 'Nanumba South',
            //             'towns' => ['Wulensi', 'Lungni', 'Nakpayili']
            //         ],
            //         [
            //             'name' => 'Saboba',
            //             'towns' => ['Saboba', 'Demon', 'Wapuli']
            //         ],
            //         [
            //             'name' => 'Sagnarigu',
            //             'towns' => ['Sagnarigu', 'Kanvilli', 'Choggu']
            //         ],
            //         [
            //             'name' => 'Savelugu-Nanton',
            //             'towns' => ['Savelugu', 'Nanton', 'Diare']
            //         ],
            //         [
            //             'name' => 'Sawla-Tuna-Kalba',
            //             'towns' => ['Sawla', 'Tuna', 'Kalba']
            //         ],
            //         [
            //             'name' => 'Tamale Metropolitan',
            //             'towns' => ['Tamale', 'Vittin', 'Lamashegu']
            //         ],
            //         [
            //             'name' => 'Tatale-Sanguli',
            //             'towns' => ['Tatale', 'Sanguli', 'Nahuyili']
            //         ],
            //         [
            //             'name' => 'Tolon',
            //             'towns' => ['Tolon', 'Nyankpala', 'Wantugu']
            //         ],
            //         [
            //             'name' => 'West Gonja',
            //             'towns' => ['Damongo', 'Busunu', 'Larabanga']
            //         ],
            //         [
            //             'name' => 'Yendi',
            //             'towns' => ['Yendi', 'Gnani', 'Zagbang']
            //         ],
            //         [
            //             'name' => 'Zabzugu',
            //             'towns' => ['Zabzugu', 'Gor', 'Kpalbutabu']
            //         ],
            //     ]
            // ],
            // [
            //     'name' => 'Upper East',
            //     'districts' => [
            //         [
            //             'name' => 'Bawku Municipal',
            //             'towns' => ['Bawku', 'Zabzugu', 'Mognori']
            //         ],
            //         [
            //             'name' => 'Bawku West',
            //             'towns' => ['Zebilla', 'Tilli', 'Sapelliga']
            //         ],
            //         [
            //             'name' => 'Binduri',
            //             'towns' => ['Binduri', 'Bazua', 'Yarugu']
            //         ],
            //         [
            //             'name' => 'Bolgatanga Municipal',
            //             'towns' => ['Bolgatanga', 'Sumbrungu', 'Zuarungu']
            //         ],
            //         [
            //             'name' => 'Bongo',
            //             'towns' => ['Bongo', 'Zorko', 'Soe']
            //         ],
            //         [
            //             'name' => 'Builsa North',
            //             'towns' => ['Sandema', 'Wiaga', 'Chuchuliga']
            //         ],
            //         [
            //             'name' => 'Builsa South',
            //             'towns' => ['Fumbisi', 'Gbedembilisi', 'Kanjaga']
            //         ],
            //         [
            //             'name' => 'Garu-Tempane',
            //             'towns' => ['Garu', 'Tempane', 'Bugri']
            //         ],
            //         [
            //             'name' => 'Kassena-Nankana West',
            //             'towns' => ['Paga', 'Sirigu', 'Chiana']
            //         ],
            //         [
            //             'name' => 'Kassena-Nankana Municipal',
            //             'towns' => ['Navrongo', 'Kologo', 'Pungu']
            //         ],
            //         [
            //             'name' => 'Nabdam',
            //             'towns' => ['Nangodi', 'Pelungu', 'Zanlerigu']
            //         ],
            //         [
            //             'name' => 'Pusiga',
            //             'towns' => ['Pusiga', 'Kulungugu', 'Widana']
            //         ],
            //         [
            //             'name' => 'Talensi',
            //             'towns' => ['Tongo', 'Winkogo', 'Pwalugu']
            //         ],
            //         [
            //             'name' => 'Tempane',
            //             'towns' => ['Tempane', 'Woriyanga', 'Kpikpira']
            //         ]
            //     ]
            // ],
            // [
            //     'name' => 'Upper West',
            //     'districts' => [
            //         [
            //             'name' => 'Jirapa',
            //             'towns' => ['Jirapa', 'Han', 'Tizza']
            //         ],
            //         [
            //             'name' => 'Lambussie Karni',
            //             'towns' => ['Lambussie', 'Karni', 'Billaw']
            //         ],
            //         [
            //             'name' => 'Lawra',
            //             'towns' => ['Lawra', 'Babile', 'Eremon']
            //         ],
            //         [
            //             'name' => 'Nadowli',
            //             'towns' => ['Nadowli', 'Kaleo', 'Daffiama']
            //         ],
            //         [
            //             'name' => 'Nandom',
            //             'towns' => ['Nandom', 'Puffien', 'Goziir']
            //         ],
            //         [
            //             'name' => 'Sissala East',
            //             'towns' => ['Tumu', 'Wellembelle', 'Nabulo']
            //         ],
            //         [
            //             'name' => 'Sissala West',
            //             'towns' => ['Gwollu', 'Zini', 'Fielmuo']
            //         ],
            //         [
            //             'name' => 'Wa East',
            //             'towns' => ['Funsi', 'Bulenga', 'Kundungu']
            //         ],
            //         [
            //             'name' => 'Wa Municipal',
            //             'towns' => ['Wa', 'Busa', 'Kperisi']
            //         ],
            //         [
            //             'name' => 'Wa West',
            //             'towns' => ['Wechiau', 'Dorimon', 'Vieri']
            //         ]
            //     ]
            // ],
            // [
            //     'name' => 'Volta',
            //     'districts' => [
            //         [
            //             'name' => 'Adaklu',
            //             'towns' => ['Adaklu Waya', 'Adaklu Kodzobi', 'Adaklu Ahunda']
            //         ],
            //         [
            //             'name' => 'Afadjato South',
            //             'towns' => ['Likpe Mate', 'Liati Wote', 'Gbledi']
            //         ],
            //         [
            //             'name' => 'Agotime Ziope',
            //             'towns' => ['Kpetoe', 'Ziope', 'Akpokofe']
            //         ],
            //         [
            //             'name' => 'Akatsi North',
            //             'towns' => ['Ave Dakpa', 'Tagligbo', 'Dzalele']
            //         ],
            //         [
            //             'name' => 'Akatsi South',
            //             'towns' => ['Akatsi', 'Wute', 'Gefia']
            //         ],
            //         [
            //             'name' => 'Biakoye',
            //             'towns' => ['Nkonya Ahenkro', 'Worawora', 'Apesokubi']
            //         ],
            //         [
            //             'name' => 'Central Tongu',
            //             'towns' => ['Adidome', 'Mafi Kumase', 'Mafi Avedo']
            //         ],
            //         [
            //             'name' => 'Ho Municipal',
            //             'towns' => ['Ho', 'Akoefe', 'Kpenoe']
            //         ],
            //         [
            //             'name' => 'Ho West',
            //             'towns' => ['Dzolokpuita', 'Tsito', 'Abutia Teti']
            //         ],
            //         [
            //             'name' => 'Hohoe Municipal',
            //             'towns' => ['Hohoe', 'Gbi-Wegbe', 'Alavanyo']
            //         ],
            //         [
            //             'name' => 'Jasikan',
            //             'towns' => ['Jasikan', 'Okadjakrom', 'Bodada']
            //         ],
            //         [
            //             'name' => 'Kadjebi',
            //             'towns' => ['Kadjebi', 'Dodi Papase', 'Asato']
            //         ],
            //         [
            //             'name' => 'Keta Municipal',
            //             'towns' => ['Keta', 'Anloga', 'Dzelukope']
            //         ],
            //         [
            //             'name' => 'Ketu North',
            //             'towns' => ['Dzodze', 'Penyi', 'Afife']
            //         ],
            //         [
            //             'name' => 'Ketu South',
            //             'towns' => ['Denu', 'Aflao', 'Agbozume']
            //         ],
            //         [
            //             'name' => 'Kpando Municipal',
            //             'towns' => ['Kpando', 'Gbefi', 'Torkor']
            //         ],
            //         [
            //             'name' => 'Krachi East',
            //             'towns' => ['Dambai', 'Asukawkaw', 'Ayeremu']
            //         ],
            //         [
            //             'name' => 'Krachi Nchumuru',
            //             'towns' => ['Chinderi', 'Borae', 'Zongo Macheri']
            //         ],
            //         [
            //             'name' => 'Krachi West',
            //             'towns' => ['Kete Krachi', 'Osramani', 'Gyeasayo']
            //         ],
            //         [
            //             'name' => 'Nkwanta North',
            //             'towns' => ['Kpassa', 'Sibi Central', 'Konjour']
            //         ],
            //         [
            //             'name' => 'Nkwanta South',
            //             'towns' => ['Nkwanta', 'Brewaniase', 'Tutukpene']
            //         ],
            //         [
            //             'name' => 'North Dayi',
            //             'towns' => ['Anfoega', 'Aveme', 'Vakpo']
            //         ],
            //         [
            //             'name' => 'North Tongu',
            //             'towns' => ['Battor', 'Mepe', 'Juapong']
            //         ],
            //         [
            //             'name' => 'South Dayi',
            //             'towns' => ['Kpeve', 'Peki', 'Tongor']
            //         ],
            //         [
            //             'name' => 'South Tongu',
            //             'towns' => ['Sogakope', 'Dabala', 'Tefle']
            //         ],
            //     ]
            // ],
            // [
            //     'name' => 'Western',
            //     'districts' => [
            //         [
            //             'name' => 'Ahanta West',
            //             'towns' => ['Agona Nkwanta', 'Dixcove', 'Busua']
            //         ],
            //         [
            //             'name' => 'Ellembelle',
            //             'towns' => ['Nkroful', 'Aiyinasi', 'Esiama']
            //         ],
            //         [
            //             'name' => 'Jomoro',
            //             'towns' => ['Half Assini', 'Tikobo No.1', 'Elubo']
            //         ],
            //         [
            //             'name' => 'Mpohor',
            //             'towns' => ['Mpohor', 'Adum Banso', 'Ayiem']
            //         ],
            //         [
            //             'name' => 'Nzema East',
            //             'towns' => ['Axim', 'Nsein', 'Bamiankor']
            //         ],
            //         [
            //             'name' => 'Prestea-Huni Valley',
            //             'towns' => ['Bogoso', 'Prestea', 'Huni Valley']
            //         ],
            //         [
            //             'name' => 'Sefwi Akontombra',
            //             'towns' => ['Akontombra', 'Nsawora', 'Tanoso']
            //         ],
            //         [
            //             'name' => 'Sefwi Wiawso',
            //             'towns' => ['Sefwi Wiawso', 'Asawinso', 'Dwenase']
            //         ],
            //         [
            //             'name' => 'Shama',
            //             'towns' => ['Shama', 'Aboadze', 'Inchaban']
            //         ],
            //         [
            //             'name' => 'Tarkwa-Nsuaem',
            //             'towns' => ['Tarkwa', 'Nsuaem', 'Benso']
            //         ],
            //         [
            //             'name' => 'Wassa Amenfi Central',
            //             'towns' => ['Manso Amenfi', 'Asankrangwa', 'Wassa Dunkwa']
            //         ],
            //         [
            //             'name' => 'Wassa Amenfi East',
            //             'towns' => ['Wassa Akropong', 'Akyempim', 'Gyaman']
            //         ],
            //         [
            //             'name' => 'Wassa Amenfi West',
            //             'towns' => ['Asankrangwa', 'Samreboi', 'Amanfi']
            //         ],
            //         [
            //             'name' => 'Wassa East',
            //             'towns' => ['Daboase', 'Atobiase', 'Ateiku']
            //         ],
            //         [
            //             'name' => 'Wassa West',
            //             'towns' => ['Tarkwa', 'Aboso', 'Huni Valley']
            //         ]
            //     ]
            // ],
            // [
            //     'name' => 'Western North',
            //     'districts' => [
            //         [
            //             'name' => 'Aowin',
            //             'towns' => ['Enchi', 'Dadieso', 'Yakasi']
            //         ],
            //         [
            //             'name' => 'Bia East',
            //             'towns' => ['Adabokrom', 'Kaase', 'Kwamebikrom']
            //         ],
            //         [
            //             'name' => 'Bia West',
            //             'towns' => ['Essam', 'Debiso', 'Osei Kojokrom']
            //         ],
            //         [
            //             'name' => 'Bibiani-Anhwiaso-Bekwai',
            //             'towns' => ['Bibiani', 'Anhwiaso', 'Bekwai']
            //         ],
            //         [
            //             'name' => 'Juabeso',
            //             'towns' => ['Juabeso', 'Bonsu Nkwanta', 'Proso']
            //         ],
            //         [
            //             'name' => 'Sefwi Akontombra',
            //             'towns' => ['Akontombra', 'Nsawora', 'Tanoso']
            //         ],
            //         [
            //             'name' => 'Sefwi Wiawso',
            //             'towns' => ['Sefwi Wiawso', 'Asawinso', 'Dwenase']
            //         ],
            //         [
            //             'name' => 'Suaman',
            //             'towns' => ['Dadieso', 'Karlo', 'Suiano']
            //         ],
            //         [
            //             'name' => 'Wasa Amenfi East',
            //             'towns' => ['Wassa Akropong', 'Akyempim', 'Gyaman']
            //         ],
            //         [
            //             'name' => 'Wasa Amenfi West',
            //             'towns' => ['Asankrangwa', 'Samreboi', 'Amanfi']
            //         ]
            //     ]
            // ],
            // [
            //     'name' => 'Oti',
            //     'districts' => [
            //         [
            //             'name' => 'Biakoye',
            //             'towns' => ['Nkonya Ahenkro', 'Worawora', 'Apesokubi']
            //         ],
            //         [
            //             'name' => 'Jasikan',
            //             'towns' => ['Jasikan', 'Okadjakrom', 'Bodada']
            //         ],
            //         [
            //             'name' => 'Kadjebi',
            //             'towns' => ['Kadjebi', 'Dodi Papase', 'Asato']
            //         ],
            //         [
            //             'name' => 'Krachi East',
            //             'towns' => ['Dambai', 'Asukawkaw', 'Ayeremu']
            //         ],
            //         [
            //             'name' => 'Krachi Nchumuru',
            //             'towns' => ['Chinderi', 'Borae', 'Zongo Macheri']
            //         ],
            //         [
            //             'name' => 'Krachi West',
            //             'towns' => ['Kete Krachi', 'Osramani', 'Gyeasayo']
            //         ],
            //         [
            //             'name' => 'Nkwanta North',
            //             'towns' => ['Kpassa', 'Sibi Central', 'Konjour']
            //         ],
            //         [
            //             'name' => 'Nkwanta South',
            //             'towns' => ['Nkwanta', 'Brewaniase', 'Tutukpene']
            //         ]
            //     ]
            // ],
        ];

        foreach ($regions as $region) {
            $regionId = DB::table('regions')->insertGetId([
                'name' => $region['name']
            ]);

            foreach ($region['districts'] as $district) {
                $districtId = DB::table('districts')->insertGetId([
                    'name' => $district['name'],
                    'region_id' => $regionId
                ]);

                foreach ($district['towns'] as $town) {
                    DB::table('towns')->insert([
                        'name' => $town,
                        'district_id' => $districtId
                    ]);
                }
            }
        }

        // create a role called farmer
        // $role1 = new Role();
        // $role1->name = 'super_admin';
        // $role1->guard_name = 'web';
        // $role1->save();
        // $role1->givePermissionTo(Permission::all());

        // // create a role called farmer
        // $role2 = new Role();
        // $role2->name = 'normal_user';
        // $role2->guard_name = 'web';
        // $role2->save();

        // // create a role called farmer
        // $role3 = new Role();
        // $role3->name = 'farmer';
        // $role3->guard_name = 'web';
        // $role3->save();

        // create user and store factory here
        $user = User::factory()->create([
            'name' => 'Super Admin',
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'admin@farm-connect.com',
        ]);
        // $user->assignRole($role1);

        $farmers_user = User::factory(5)->create();
        // $farmers_user->where('user_type', 'farmer')->each(function ($user) use ($role3) {
        //     $user->assignRole($role3);
        // });

        Store::factory()->create([
            'user_id' => $user->id,
            'town_id' => null,
        ]);
        Store::factory(5)->create();

        $this->command->info('Region, district and town table seeded!');
    }
}
