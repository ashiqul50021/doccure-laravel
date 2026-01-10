<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing menus
        Menu::truncate();

        // Main Navigation Menus
        $menus = [
            [
                'title' => 'Home',
                'route_name' => 'home',
                'order' => 1,
                'location' => 'main',
            ],
            [
                'title' => 'Doctors',
                'route_name' => null,
                'order' => 2,
                'location' => 'main',
                'children' => [
                    ['title' => 'Doctor Dashboard', 'route_name' => 'doctor.dashboard', 'order' => 1],
                    ['title' => 'Appointments', 'route_name' => 'appointments', 'order' => 2],
                    ['title' => 'Schedule Timing', 'route_name' => 'schedule.timings', 'order' => 3],
                    ['title' => 'Patients List', 'route_name' => 'my.patients', 'order' => 4],
                    ['title' => 'Chat', 'route_name' => 'chat.doctor', 'order' => 5],
                    ['title' => 'Invoices', 'route_name' => 'invoices', 'order' => 6],
                    ['title' => 'Profile Settings', 'route_name' => 'doctor.profile.settings', 'order' => 7],
                    ['title' => 'Reviews', 'route_name' => 'reviews', 'order' => 8],
                    ['title' => 'Doctor Register', 'route_name' => 'doctor.register', 'order' => 9],
                ],
            ],
            [
                'title' => 'Patients',
                'route_name' => null,
                'order' => 3,
                'location' => 'main',
                'children' => [
                    ['title' => 'Search Doctor', 'route_name' => 'search', 'order' => 1],
                    ['title' => 'Patient Dashboard', 'route_name' => 'patient.dashboard', 'order' => 2],
                    ['title' => 'Favourites', 'route_name' => 'favourites', 'order' => 3],
                    ['title' => 'Chat', 'route_name' => 'chat', 'order' => 4],
                    ['title' => 'Profile Settings', 'route_name' => 'profile.settings', 'order' => 5],
                    ['title' => 'Change Password', 'route_name' => 'change.password', 'order' => 6],
                ],
            ],
            [
                'title' => 'Pages',
                'route_name' => null,
                'order' => 4,
                'location' => 'main',
                'children' => [
                    ['title' => 'Voice Call', 'route_name' => 'voice.call', 'order' => 1],
                    ['title' => 'Video Call', 'route_name' => 'video.call', 'order' => 2],
                    ['title' => 'Calendar', 'route_name' => 'calendar', 'order' => 3],
                    ['title' => 'Components', 'route_name' => 'components', 'order' => 4],
                    ['title' => 'Invoices', 'route_name' => 'invoices', 'order' => 5],
                    ['title' => 'Login', 'route_name' => 'login', 'order' => 6],
                    ['title' => 'Register', 'route_name' => 'register', 'order' => 7],
                ],
            ],
            [
                'title' => 'Blog',
                'url' => '#',
                'order' => 5,
                'location' => 'main',
            ],
            [
                'title' => 'Admin',
                'route_name' => 'admin.dashboard',
                'order' => 6,
                'location' => 'main',
                'open_in_new_tab' => true,
            ],
        ];

        foreach ($menus as $menuData) {
            $children = $menuData['children'] ?? [];
            unset($menuData['children']);

            $menu = Menu::create($menuData);

            foreach ($children as $childData) {
                $childData['parent_id'] = $menu->id;
                $childData['location'] = 'main';
                Menu::create($childData);
            }
        }
    }
}
