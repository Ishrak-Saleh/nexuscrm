<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Client;
use App\Models\Note;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        //Create demo user
        $user = User::firstOrCreate(
            ['email' => 'demo@nexuscrm.com'],
            [
                'name' => 'Ishrak Saleh Chowdhury',
                'password' => Hash::make('password'),
            ]
        );

        $clients = [

            [
                'name' => 'John Smith',
                'email' => 'john@techcorp.com',
                'phone' => '+1 (212) 555-0123',
                'company' => 'TechCorp Inc.',
                'address' => '123 Business St, New York, NY 10001',
                'status' => 'active',
                'next_follow_up' => now()->addDays(2),
            ],
            [
                'name' => 'Sarah Johnson',
                'email' => 'sarah@designstudio.com',
                'phone' => '+1 (310) 555-4567',
                'company' => 'Design Studio LLC',
                'address' => '456 Creative Ave, Los Angeles, CA 90001',
                'status' => 'lead',
                'next_follow_up' => now()->addDays(1),
            ],
            [
                'name' => 'Michael Chen',
                'email' => 'michael@consulting.com',
                'phone' => '+1 (312) 555-7890',
                'company' => 'Consulting Partners',
                'address' => '789 Strategy Blvd, Chicago, IL 60607',
                'status' => 'active',
                'next_follow_up' => now()->addDays(3),
            ],
            [
                'name' => 'Emma Wilson',
                'email' => 'emma@startup.io',
                'phone' => '+1 (512) 555-1122',
                'company' => 'Startup Innovations',
                'address' => '321 Tech Park, Austin, TX 73301',
                'status' => 'lead',
                'next_follow_up' => now()->addDays(5),
            ],
            [
                'name' => 'Robert Brown',
                'email' => 'robert@enterprise.com',
                'phone' => '+1 (617) 555-3344',
                'company' => 'Enterprise Solutions',
                'address' => '654 Corporate Way, Boston, MA 02101',
                'status' => 'inactive',
                'next_follow_up' => null,
            ],

            [
                'name' => 'Sophie Martin',
                'email' => 'sophie@parisdesign.fr',
                'phone' => '+33 1 23 45 67 89',
                'company' => 'Paris Design Collective',
                'address' => '88 Rue de Rivoli, Paris 75001',
                'status' => 'active',
                'next_follow_up' => now()->addDays(4),
            ],
            [
                'name' => 'Giuseppe Rossi',
                'email' => 'giuseppe@milanofashion.it',
                'phone' => '+39 02 1234 5678',
                'company' => 'Milano Fashion House',
                'address' => 'Via Montenapoleone 15, Milano 20121',
                'status' => 'lead',
                'next_follow_up' => now()->addDays(6),
            ],
            [
                'name' => 'Anja Schmidt',
                'email' => 'anja@berlintech.de',
                'phone' => '+49 30 12345678',
                'company' => 'Berlin Tech GmbH',
                'address' => 'Mitte District, Berlin 10117',
                'status' => 'active',
                'next_follow_up' => now()->addDays(2),
            ],
            [
                'name' => 'Lars Andersen',
                'email' => 'lars@copenhagendesign.dk',
                'phone' => '+45 32 12 34 56',
                'company' => 'Copenhagen Design Studio',
                'address' => 'Nyhavn 17, Copenhagen 1051',
                'status' => 'lead',
                'next_follow_up' => now()->addDays(7),
            ],

            [
                'name' => 'Wei Zhang',
                'email' => 'wei@shanghaitech.cn',
                'phone' => '+86 21 1234 5678',
                'company' => 'Shanghai Tech Solutions',
                'address' => 'Pudong District, Shanghai 200120',
                'status' => 'active',
                'next_follow_up' => now()->addDays(3),
            ],
            [
                'name' => 'Priya Patel',
                'email' => 'priya@bangaloreit.in',
                'phone' => '+91 80 2345 6789',
                'company' => 'Bangalore IT Services',
                'address' => 'Electronic City, Bangalore 560100',
                'status' => 'lead',
                'next_follow_up' => now()->addDays(1),
            ],
            [
                'name' => 'Kenji Tanaka',
                'email' => 'kenji@tokyoautomation.jp',
                'phone' => '+81 3 1234 5678',
                'company' => 'Tokyo Automation Co.',
                'address' => 'Shibuya Ward, Tokyo 150-0043',
                'status' => 'active',
                'next_follow_up' => now()->addDays(5),
            ],
            [
                'name' => 'Minh Nguyen',
                'email' => 'minh@hochiminhdigital.vn',
                'phone' => '+84 28 1234 5678',
                'company' => 'Ho Chi Minh Digital Agency',
                'address' => 'District 1, Ho Chi Minh City',
                'status' => 'lead',
                'next_follow_up' => now()->addDays(4),
            ],


            [
                'name' => 'Kwame Asante',
                'email' => 'kwame@accraconsulting.gh',
                'phone' => '+233 30 123 4567',
                'company' => 'Accra Consulting Group',
                'address' => 'Airport Residential Area, Accra',
                'status' => 'active',
                'next_follow_up' => now()->addDays(2),
            ],
            [
                'name' => 'Naledi Bhengu',
                'email' => 'naledi@joburgfinance.co.za',
                'phone' => '+27 11 123 4567',
                'company' => 'Johannesburg Financial Services',
                'address' => 'Sandton, Johannesburg 2196',
                'status' => 'lead',
                'next_follow_up' => now()->addDays(6),
            ],


            [
                'name' => 'Ahmed Al-Mansoori',
                'email' => 'ahmed@dubaienterprises.ae',
                'phone' => '+971 4 123 4567',
                'company' => 'Dubai Enterprises',
                'address' => 'Downtown Dubai, UAE',
                'status' => 'active',
                'next_follow_up' => now()->addDays(3),
            ],
            [
                'name' => 'Layla Hassan',
                'email' => 'layla@riyadheducation.sa',
                'phone' => '+966 11 234 5678',
                'company' => 'Riyadh Education Institute',
                'address' => 'King Abdullah Road, Riyadh',
                'status' => 'lead',
                'next_follow_up' => now()->addDays(7),
            ],

            [
                'name' => 'Jackson Taylor',
                'email' => 'jackson@sydneydev.au',
                'phone' => '+61 2 1234 5678',
                'company' => 'Sydney Development Co.',
                'address' => 'Circular Quay, Sydney NSW 2000',
                'status' => 'active',
                'next_follow_up' => now()->addDays(1),
            ],
            [
                'name' => 'Māori Williams',
                'email' => 'maori@aucklandtourism.nz',
                'phone' => '+64 9 123 4567',
                'company' => 'Auckland Tourism Bureau',
                'address' => 'Queen Street, Auckland 1010',
                'status' => 'lead',
                'next_follow_up' => now()->addDays(5),
            ],

            [
                'name' => 'Carlos Silva',
                'email' => 'carlos@saopaulotech.br',
                'phone' => '+55 11 1234-5678',
                'company' => 'São Paulo Technology',
                'address' => 'Paulista Avenue, São Paulo 01311',
                'status' => 'active',
                'next_follow_up' => now()->addDays(4),
            ],
            [
                'name' => 'Isabella González',
                'email' => 'isabella@mexicocitydesign.mx',
                'phone' => '+52 55 1234 5678',
                'company' => 'Mexico City Design Studio',
                'address' => 'Polanco, Mexico City 11560',
                'status' => 'lead',
                'next_follow_up' => now()->addDays(2),
            ],
            [
                'name' => 'Diego Ramirez',
                'email' => 'diego@bogotastartups.co',
                'phone' => '+57 1 123 4567',
                'company' => 'Bogotá Startups Inc.',
                'address' => 'Chapinero, Bogotá',
                'status' => 'active',
                'next_follow_up' => now()->addDays(6),
            ],

            [
                'name' => 'Anya Petrova',
                'email' => 'anya@moscowit.ru',
                'phone' => '+7 495 123-45-67',
                'company' => 'Moscow IT Solutions',
                'address' => 'Tverskaya Street, Moscow 125009',
                'status' => 'lead',
                'next_follow_up' => now()->addDays(3),
            ],
            [
                'name' => 'Rashid Abdullah',
                'email' => 'rashid@istanbulconsult.tr',
                'phone' => '+90 212 123 4567',
                'company' => 'Istanbul Consulting',
                'address' => 'Beyoğlu, Istanbul 34433',
                'status' => 'active',
                'next_follow_up' => now()->addDays(7),
            ],
            [
                'name' => 'Olivia O\'Brien',
                'email' => 'olivia@dublinfintech.ie',
                'phone' => '+353 1 123 4567',
                'company' => 'Dublin FinTech',
                'address' => 'Silicon Docks, Dublin 2',
                'status' => 'lead',
                'next_follow_up' => now()->addDays(4),
            ],
        ];

        $noteTemplates = [
            ['content' => 'Initial consultation call. Discussed project requirements and timeline.', 'type' => 'call'],
            ['content' => 'Sent proposal document via email. Waiting for feedback.', 'type' => 'email'],
            ['content' => 'Follow up meeting scheduled to discuss budget and next steps.', 'type' => 'meeting'],
            ['content' => 'Client expressed strong interest. Need to send contract.', 'type' => 'call'],
            ['content' => 'Requires additional features. Preparing revised proposal.', 'type' => 'email'],
            ['content' => 'On-site visit scheduled to understand workflow better.', 'type' => 'meeting'],
            ['content' => 'Client happy with progress. Discussed expansion possibilities.', 'type' => 'call'],
            ['content' => 'Training session completed successfully. Follow-up in 2 weeks.', 'type' => 'meeting'],
            ['content' => 'Payment received. Project officially started.', 'type' => 'general'],
            ['content' => 'Annual review meeting. Discussed renewal options.', 'type' => 'meeting'],
        ];

        foreach ($clients as $clientData) {
            $client = $user->clients()->create($clientData);

            $noteCount = rand(2, 4);
            for ($i = 0; $i < $noteCount; $i++) {
                $randomNote = $noteTemplates[array_rand($noteTemplates)];
                $client->notes()->create([
                    'user_id' => $user->id,
                    'content' => $randomNote['content'],
                    'type' => $randomNote['type'],
                    'created_at' => now()->subDays(rand(1, 30)),
                ]);
            }
        }

        $todayClients = [
            [
                'name' => 'Alex Turner',
                'email' => 'alex@digitalagency.com',
                'phone' => '+1 (305) 555-7890',
                'company' => 'Digital Agency Pro',
                'address' => '987 Digital Lane, Miami, FL 33101',
                'status' => 'active',
                'next_follow_up' => now(),
            ],
            [
                'name' => 'Maria Garcia',
                'email' => 'maria@urgentproject.es',
                'phone' => '+34 91 234 5678',
                'company' => 'Urgent Project Madrid',
                'address' => 'Gran Via 32, Madrid 28013',
                'status' => 'lead',
                'next_follow_up' => now(),
            ],
            [
                'name' => 'David Kim',
                'email' => 'david@seoulstartup.kr',
                'phone' => '+82 2 1234 5678',
                'company' => 'Seoul Startup Hub',
                'address' => 'Gangnam District, Seoul',
                'status' => 'active',
                'next_follow_up' => now(),
            ]
        ];

        foreach ($todayClients as $clientData) {
            $client = $user->clients()->create($clientData);
            
            $client->notes()->create([
                'user_id' => $user->id,
                'content' => 'URGENT: Follow-up call scheduled for today. Important contract discussion.',
                'type' => 'call',
                'created_at' => now()->subDays(1),
            ]);
            
            $additionalNotes = rand(1, 2);
            for ($i = 0; $i < $additionalNotes; $i++) {
                $randomNote = $noteTemplates[array_rand($noteTemplates)];
                $client->notes()->create([
                    'user_id' => $user->id,
                    'content' => $randomNote['content'],
                    'type' => $randomNote['type'],
                    'created_at' => now()->subDays(rand(2, 10)),
                ]);
            }
        }
    }
}