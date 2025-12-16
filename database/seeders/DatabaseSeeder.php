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
                'name' => 'Demo User',
                'password' => Hash::make('password'),
            ]
        );

        //Sample clients
        $clients = [
            [
                'name' => 'John Smith',
                'email' => 'john@example.com',
                'phone' => '+1 234 567 8900',
                'company' => 'TechCorp Inc.',
                'address' => '123 Business St, Suite 100, New York, NY 10001',
                'status' => 'active',
                'next_follow_up' => now()->addDays(2),
            ],
            [
                'name' => 'Sarah Johnson',
                'email' => 'sarah@designstudio.com',
                'phone' => '+1 345 678 9012',
                'company' => 'Design Studio LLC',
                'address' => '456 Creative Ave, Los Angeles, CA 90001',
                'status' => 'lead',
                'next_follow_up' => now()->addDays(1),
            ],
            [
                'name' => 'Michael Chen',
                'email' => 'michael@consulting.com',
                'phone' => '+1 456 789 0123',
                'company' => 'Consulting Partners',
                'address' => '789 Strategy Blvd, Chicago, IL 60007',
                'status' => 'active',
                'next_follow_up' => now()->addDays(3),
            ],
            [
                'name' => 'Emma Wilson',
                'email' => 'emma@startup.io',
                'phone' => '+1 567 890 1234',
                'company' => 'Startup Innovations',
                'address' => '321 Tech Park, Austin, TX 73301',
                'status' => 'lead',
                'next_follow_up' => now()->addDays(5),
            ],
            [
                'name' => 'Robert Brown',
                'email' => 'robert@enterprise.com',
                'phone' => '+1 678 901 2345',
                'company' => 'Enterprise Solutions',
                'address' => '654 Corporate Way, Boston, MA 02101',
                'status' => 'inactive',
                'next_follow_up' => null,
            ],
        ];

        foreach ($clients as $clientData) {
            $client = $user->clients()->create($clientData);

            //Add sample notes for each client
            $notes = [
                [
                    'content' => 'Initial consultation call. Discussed project requirements and timeline.',
                    'type' => 'call',
                ],
                [
                    'content' => 'Sent proposal document via email. Waiting for feedback.',
                    'type' => 'email',
                ],
                [
                    'content' => 'Follow up meeting scheduled for next week to discuss budget.',
                    'type' => 'meeting',
                ],
            ];

            foreach ($notes as $noteData) {
                $client->notes()->create([
                    'user_id' => $user->id,
                    'content' => $noteData['content'],
                    'type' => $noteData['type'],
                    'created_at' => now()->subDays(rand(1, 7)),
                ]);
            }
        }

        //Create today's follow-up client
        $todayClient = $user->clients()->create([
            'name' => 'Alex Turner',
            'email' => 'alex@digitalagency.com',
            'phone' => '+1 789 012 3456',
            'company' => 'Digital Agency Pro',
            'address' => '987 Digital Lane, Miami, FL 33101',
            'status' => 'active',
            'next_follow_up' => now(),
        ]);

        $todayClient->notes()->create([
            'user_id' => $user->id,
            'content' => 'Important follow-up call today at 2 PM. Need to discuss contract renewal.',
            'type' => 'call',
            'created_at' => now()->subDays(2),
        ]);
    }
}