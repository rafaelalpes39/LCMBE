<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Announcement;
use App\Models\User;

class AnnouncementSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        if (!$user) {
            $this->command->warn('No users found. Please seed users first.');
            return;
        }

        $announcements = [
            [
                'title'       => 'Mass Schedule for Holy Week',
                'body'        => 'Please be informed that our Holy Week masses will follow a special schedule. Palm Sunday mass will be at 6AM, 8AM, and 10AM. Please arrive early.',
                'recipient'   => 'All Members',
                'accomplished' => false,
            ],
            [
                'title'       => 'Lectors Formation Seminar',
                'body'        => 'All lectors and commentators are required to attend the formation seminar on March 15. Attendance is mandatory.',
                'recipient'   => 'Officers',
                'accomplished' => false,
            ],
            [
                'title'       => 'Availability Submission Reminder',
                'body'        => 'Please submit your April availability before March 10. Late submissions will not be accommodated.',
                'recipient'   => 'New Testament',
                'accomplished' => true,
            ],
            [
                'title'       => 'New Member Orientation',
                'body'        => 'Orientation for new members will be held on March 8 at 3PM in the parish hall.',
                'recipient'   => 'Old Testament',
                'accomplished' => true,
            ],
            [
                'title'       => 'Coordinator Monthly Meeting',
                'body'        => 'All coordinators are required to attend the monthly meeting this Saturday at 9AM.',
                'recipient'   => 'Officers',
                'accomplished' => false,
            ],
        ];

        foreach ($announcements as $ann) {
            Announcement::create([
                'title'       => $ann['title'],
                'body'        => $ann['body'],
                'recipient'   => $ann['recipient'],
                'accomplished' => $ann['accomplished'],
                'user_id'     => 1,
                // 'user_id'     => $user->id,
            ]);
        }

        $this->command->info('Announcements seeded successfully.');
    }
}