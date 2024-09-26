<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Experience;
use Carbon\Carbon;

class ExperienceSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            $experiencesCount = rand(1, 5);

            for ($i = 0; $i < $experiencesCount; $i++) {
                $startDate = Carbon::now()->subYears(rand(1, 10))->subMonths(rand(0, 11));
                $endDate = $i === 0 ? null : Carbon::parse($startDate)->addYears(rand(1, 3))->addMonths(rand(0, 11));

                Experience::create([
                    'user_id' => $user->id,
                    'position' => $this->getRandomPosition(),
                    'company' => $this->getRandomCompany(),
                    'duration' => $this->calculateDuration($startDate, $endDate),
                    'description' => "Responsibilities and achievements for this role.",
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'is_current' => $i === 0,
                ]);
            }
        }
    }

    private function getRandomPosition(): string
    {
        $positions = [
            'Software Engineer', 'Product Manager', 'Data Scientist',
            'UX Designer', 'Marketing Specialist', 'Sales Representative',
            'Customer Support Specialist', 'HR Manager', 'Financial Analyst'
        ];
        return $positions[array_rand($positions)];
    }

    private function getRandomCompany(): string
    {
        $companies = [
            'Tech Innovations Inc.', 'Global Solutions Ltd.', 'Data Dynamics Corp.',
            'Creative Designs Co.', 'Marketing Wizards LLC', 'Sales Boosters Inc.',
            'Customer First Services', 'HR Excellence Group', 'Finance Pros Consulting'
        ];
        return $companies[array_rand($companies)];
    }

    private function calculateDuration($startDate, $endDate): string
    {
        $end = $endDate ?? Carbon::now();
        $diff = $startDate->diff($end);
        $years = $diff->y;
        $months = $diff->m;

        if ($years > 0 && $months > 0) {
            return "{$years} year" . ($years > 1 ? 's' : '') . " {$months} month" . ($months > 1 ? 's' : '');
        } elseif ($years > 0) {
            return "{$years} year" . ($years > 1 ? 's' : '');
        } else {
            return "{$months} month" . ($months > 1 ? 's' : '');
        }
    }
}
