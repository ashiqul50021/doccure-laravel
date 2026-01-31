<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Doctor;
use Illuminate\Support\Facades\Hash;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Doctor data with different districts, areas, and specialities
        $doctors = [
            // Dhaka - Dhanmondi
            ['name' => 'Dr. Rafiqul Islam', 'email' => 'dr.rafiq@example.com', 'speciality_id' => 2, 'district_id' => 1, 'area_id' => 1, 'qualification' => 'MBBS, FCPS (Cardiology)', 'experience_years' => 15, 'consultation_fee' => 1500, 'clinic_name' => 'Dhanmondi Heart Care', 'clinic_address' => 'Road 27, Dhanmondi, Dhaka'],

            // Dhaka - Gulshan
            ['name' => 'Dr. Fatema Akter', 'email' => 'dr.fatema@example.com', 'speciality_id' => 9, 'district_id' => 1, 'area_id' => 2, 'qualification' => 'MBBS, FCPS (Gynecology)', 'experience_years' => 12, 'consultation_fee' => 1200, 'clinic_name' => 'Women Care Clinic', 'clinic_address' => 'Gulshan-1, Dhaka'],

            // Dhaka - Banani
            ['name' => 'Dr. Kamal Hossain', 'email' => 'dr.kamal@example.com', 'speciality_id' => 3, 'district_id' => 1, 'area_id' => 3, 'qualification' => 'MBBS, MD (Neurology)', 'experience_years' => 18, 'consultation_fee' => 2000, 'clinic_name' => 'Brain & Spine Center', 'clinic_address' => 'Banani, Dhaka'],

            // Dhaka - Uttara
            ['name' => 'Dr. Nasreen Begum', 'email' => 'dr.nasreen@example.com', 'speciality_id' => 8, 'district_id' => 1, 'area_id' => 4, 'qualification' => 'MBBS, DCH (Pediatrics)', 'experience_years' => 10, 'consultation_fee' => 800, 'clinic_name' => 'Child Care Center', 'clinic_address' => 'Uttara Sector 7, Dhaka'],

            // Dhaka - Mirpur
            ['name' => 'Dr. Abdul Hamid', 'email' => 'dr.hamid@example.com', 'speciality_id' => 4, 'district_id' => 1, 'area_id' => 5, 'qualification' => 'MBBS, MS (Orthopedics)', 'experience_years' => 14, 'consultation_fee' => 1000, 'clinic_name' => 'Bone & Joint Clinic', 'clinic_address' => 'Mirpur-10, Dhaka'],

            // Dhaka - Mohammadpur
            ['name' => 'Dr. Shirin Akhtar', 'email' => 'dr.shirin@example.com', 'speciality_id' => 5, 'district_id' => 1, 'area_id' => 6, 'qualification' => 'BDS, MS (Dental Surgery)', 'experience_years' => 8, 'consultation_fee' => 600, 'clinic_name' => 'Smile Dental Care', 'clinic_address' => 'Mohammadpur, Dhaka'],

            // Dhaka - Motijheel
            ['name' => 'Dr. Jahangir Alam', 'email' => 'dr.jahangir@example.com', 'speciality_id' => 6, 'district_id' => 1, 'area_id' => 7, 'qualification' => 'MBBS, MS (Urology)', 'experience_years' => 16, 'consultation_fee' => 1500, 'clinic_name' => 'Kidney & Urology Center', 'clinic_address' => 'Motijheel, Dhaka'],

            // Gazipur - Gazipur Sadar
            ['name' => 'Dr. Mijanur Rahman', 'email' => 'dr.mijanur@example.com', 'speciality_id' => 2, 'district_id' => 2, 'area_id' => 15, 'qualification' => 'MBBS, MD (Cardiology)', 'experience_years' => 11, 'consultation_fee' => 1000, 'clinic_name' => 'Gazipur Heart Center', 'clinic_address' => 'Gazipur Sadar'],

            // Gazipur
            ['name' => 'Dr. Salma Khatun', 'email' => 'dr.salma@example.com', 'speciality_id' => 9, 'district_id' => 2, 'area_id' => 15, 'qualification' => 'MBBS, DGO', 'experience_years' => 9, 'consultation_fee' => 800, 'clinic_name' => 'Mother & Child Hospital', 'clinic_address' => 'Tongi, Gazipur'],

            // Narayanganj
            ['name' => 'Dr. Mostafizur Rahman', 'email' => 'dr.mostafiz@example.com', 'speciality_id' => 3, 'district_id' => 3, 'area_id' => null, 'qualification' => 'MBBS, FCPS (Neurology)', 'experience_years' => 13, 'consultation_fee' => 1200, 'clinic_name' => 'Neuro Care Hospital', 'clinic_address' => 'Narayanganj Sadar'],

            // Tangail
            ['name' => 'Dr. Habibur Rahman', 'email' => 'dr.habib@example.com', 'speciality_id' => 4, 'district_id' => 4, 'area_id' => null, 'qualification' => 'MBBS, MS (Orthopedics)', 'experience_years' => 17, 'consultation_fee' => 900, 'clinic_name' => 'Tangail Bone Hospital', 'clinic_address' => 'Tangail Town'],

            // Kishoreganj
            ['name' => 'Dr. Rezaul Karim', 'email' => 'dr.rezaul@example.com', 'speciality_id' => 8, 'district_id' => 5, 'area_id' => null, 'qualification' => 'MBBS, MD (Pediatrics)', 'experience_years' => 7, 'consultation_fee' => 500, 'clinic_name' => 'Kids Care Center', 'clinic_address' => 'Kishoreganj Town'],

            // Manikganj
            ['name' => 'Dr. Anwarul Haque', 'email' => 'dr.anwar@example.com', 'speciality_id' => 2, 'district_id' => 6, 'area_id' => null, 'qualification' => 'MBBS, FCPS (Cardiology)', 'experience_years' => 20, 'consultation_fee' => 1100, 'clinic_name' => 'Heart Care Manikganj', 'clinic_address' => 'Manikganj Sadar'],

            // Munshiganj
            ['name' => 'Dr. Tahmina Islam', 'email' => 'dr.tahmina@example.com', 'speciality_id' => 9, 'district_id' => 7, 'area_id' => null, 'qualification' => 'MBBS, FCPS (Gynecology)', 'experience_years' => 6, 'consultation_fee' => 700, 'clinic_name' => 'Womens Health Center', 'clinic_address' => 'Munshiganj Town'],

            // Narsingdi
            ['name' => 'Dr. Mizanur Rahman', 'email' => 'dr.mizan@example.com', 'speciality_id' => 5, 'district_id' => 8, 'area_id' => null, 'qualification' => 'BDS', 'experience_years' => 5, 'consultation_fee' => 400, 'clinic_name' => 'Dental Care Narsingdi', 'clinic_address' => 'Narsingdi Sadar'],

            // Faridpur
            ['name' => 'Dr. Shahidul Islam', 'email' => 'dr.shahid@example.com', 'speciality_id' => 6, 'district_id' => 9, 'area_id' => null, 'qualification' => 'MBBS, MS (Urology)', 'experience_years' => 12, 'consultation_fee' => 900, 'clinic_name' => 'Urology Center Faridpur', 'clinic_address' => 'Faridpur Sadar'],

            // Gopalganj
            ['name' => 'Dr. Khaleda Begum', 'email' => 'dr.khaleda@example.com', 'speciality_id' => 8, 'district_id' => 10, 'area_id' => null, 'qualification' => 'MBBS, DCH', 'experience_years' => 8, 'consultation_fee' => 500, 'clinic_name' => 'Child Specialist Gopalganj', 'clinic_address' => 'Gopalganj Sadar'],

            // Dhaka - Badda
            ['name' => 'Dr. Nurul Huda', 'email' => 'dr.nurul@example.com', 'speciality_id' => 7, 'district_id' => 1, 'area_id' => 8, 'qualification' => 'MBBS, MD (Radiology)', 'experience_years' => 10, 'consultation_fee' => 2500, 'clinic_name' => 'MRI Diagnostic Center', 'clinic_address' => 'Badda, Dhaka'],

            // Dhaka - Tejgaon
            ['name' => 'Dr. Shamima Nasrin', 'email' => 'dr.shamima@example.com', 'speciality_id' => 3, 'district_id' => 1, 'area_id' => 9, 'qualification' => 'MBBS, FCPS (Neurology)', 'experience_years' => 14, 'consultation_fee' => 1800, 'clinic_name' => 'Neuro Specialist Center', 'clinic_address' => 'Tejgaon, Dhaka'],

            // Dhaka - Savar
            ['name' => 'Dr. Iqbal Hossain', 'email' => 'dr.iqbal@example.com', 'speciality_id' => 4, 'district_id' => 1, 'area_id' => 10, 'qualification' => 'MBBS, MS (Orthopedics)', 'experience_years' => 11, 'consultation_fee' => 800, 'clinic_name' => 'Savar Orthopedic Hospital', 'clinic_address' => 'Savar, Dhaka'],
        ];

        // Online placeholder images for doctors (can be replaced later)
        $profileImages = [
            'https://randomuser.me/api/portraits/men/1.jpg',
            'https://randomuser.me/api/portraits/women/1.jpg',
            'https://randomuser.me/api/portraits/men/2.jpg',
            'https://randomuser.me/api/portraits/women/2.jpg',
            'https://randomuser.me/api/portraits/men/3.jpg',
            'https://randomuser.me/api/portraits/women/3.jpg',
            'https://randomuser.me/api/portraits/men/4.jpg',
            'https://randomuser.me/api/portraits/men/5.jpg',
            'https://randomuser.me/api/portraits/women/4.jpg',
            'https://randomuser.me/api/portraits/men/6.jpg',
            'https://randomuser.me/api/portraits/men/7.jpg',
            'https://randomuser.me/api/portraits/men/8.jpg',
            'https://randomuser.me/api/portraits/men/9.jpg',
            'https://randomuser.me/api/portraits/women/5.jpg',
            'https://randomuser.me/api/portraits/men/10.jpg',
            'https://randomuser.me/api/portraits/men/11.jpg',
            'https://randomuser.me/api/portraits/women/6.jpg',
            'https://randomuser.me/api/portraits/men/12.jpg',
            'https://randomuser.me/api/portraits/women/7.jpg',
            'https://randomuser.me/api/portraits/men/13.jpg',
        ];

        foreach ($doctors as $index => $doctorData) {
            // Create user for doctor
            $user = User::create([
                'name' => $doctorData['name'],
                'email' => $doctorData['email'],
                'password' => Hash::make('password123'),
            ]);

            // Create doctor profile
            Doctor::create([
                'user_id' => $user->id,
                'speciality_id' => $doctorData['speciality_id'],
                'district_id' => $doctorData['district_id'],
                'area_id' => $doctorData['area_id'],
                'qualification' => $doctorData['qualification'],
                'bio' => 'Experienced ' . $doctorData['qualification'] . ' specialist with ' . $doctorData['experience_years'] . ' years of practice.',
                'clinic_name' => $doctorData['clinic_name'],
                'clinic_address' => $doctorData['clinic_address'],
                'consultation_fee' => $doctorData['consultation_fee'],
                'experience_years' => $doctorData['experience_years'],
                'profile_image' => $profileImages[$index], // Online image URL
                'status' => 'approved',
                'is_featured' => $index < 5, // First 5 are featured
            ]);
        }

        $this->command->info('20 doctors seeded successfully!');
    }
}
