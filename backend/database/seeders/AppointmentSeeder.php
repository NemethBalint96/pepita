<?php

namespace Database\Seeders;

use App\Enums\Day;
use App\Enums\Repetition;
use Illuminate\Database\Seeder;
use App\Models\Appointment;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $appointments = [
            [
                'start_time' => '2023-09-08 08:00:00',
                'end_time' => '2023-09-08 10:00:00',
                'repetition' => Repetition::NoRepetition,
            ],
            [
                'start_time' => '2023-01-01 10:00:00',
                'repetition' => Repetition::EvenWeek,
                'day_of_week' => Day::Monday,
                'time_within_day' => '02:00:00',
            ],
            [
                'start_time' => '2023-01-01 12:00:00',
                'repetition' => Repetition::OddWeek,
                'day_of_week' => Day::Wednesday,
                'time_within_day' => '04:00:00',
            ],
            [
                'start_time' => '2023-01-01 10:00:00',
                'repetition' => Repetition::Weekly,
                'day_of_week' => Day::Friday,
                'time_within_day' => '06:00:00',
            ],
            [
                'start_time' => '2023-06-01 16:00:00',
                'end_time' => '2023-11-30 00:00:00',
                'repetition' => Repetition::Weekly,
                'day_of_week' => Day::Thursday,
                'time_within_day' => '04:00:00',
            ],
        ];

        foreach ($appointments as $appointment) {
            Appointment::create($appointment);
        }
    }
}
