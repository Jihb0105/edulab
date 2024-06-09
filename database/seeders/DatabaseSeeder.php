<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Language;
use App\Models\LectureType;
use App\Models\Category;
use App\Models\Course;
use App\Models\Chapter;
use App\Models\User;
use App\Models\JobTitle;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User
        User::create([
            'name' => 'Admin',
            'email' => 'edulab.0105@outlook.com',
            'password' => Hash::make('password'),
            'birth_date' => '2001-05-01',
            'type' => '1',
        ]);

        User::create([
            'name' => 'Tissa Chandesa',
            'email' => 'Tissa.Chandesa@nottingham.edu.my',
            'password' => Hash::make('12345'),
            'birth_date' => '1981-05-01',
            'type' => '2',
        ]);

        User::create([
            'name' => 'Iman Yi Liao',
            'email' => 'Iman.Liao@nottingham.edu.my',
            'password' => Hash::make('12345'),
            'birth_date' => '1965-05-01',
            'type' => '2',
        ]);

        User::create([
            'name' => 'Yasir Hafeez',
            'email' => 'yasir.hafeez@nottingham.edu.my',
            'password' => Hash::make('12345'),
            'birth_date' => '1971-05-01',
            'type' => '2',
        ]);

        JobTitle::create([
            'instructor_id' => '2',
            'job_title' => 'Web Developer',
        ]);
        
        JobTitle::create([
            'instructor_id' => '2',
            'job_title' => 'Full Stack Developer',
        ]);
        
        //Lecture Type
        LectureType::create([
            'lecture_type' => 'Video'
        ]);
        LectureType::create([
            'lecture_type' => 'Audio'
        ]);
        LectureType::create([
            'lecture_type' => 'Text'
        ]);

        //Category
        Category::create([
            'title' => 'Information Technology',
            'description' => 'Information technology (IT) is the use of computers to create, process, store, retrieve, and exchange all kinds of data and information. IT forms part of information and communications technology (ICT). An information technology system (IT system) is generally an information system, a communications system, or, more specifically speaking, a computer system — including all hardware, software, and peripheral equipment — operated by a limited group of IT users.'
        ]);
        Category::create([
            'title' => 'Math',
            'description' => 'Mathematics is the science and study of quality, structure, space, and change. Mathematicians seek out patterns, formulate new conjectures, and establish truth by rigorous deduction from appropriately chosen axioms and definitions.'
        ]);
        Category::create([
            'title' => 'Biology',
            'description' => 'Biology is a branch of science that deals with living organisms and their vital processes. Biology encompasses diverse fields, including botany, conservation, ecology, evolution, genetics, marine biology, medicine, microbiology, molecular biology, physiology, and zoology.'
        ]);
        Category::create([
            'title' => 'Physic',
            'description' => 'A science that deals with matter and energy and their interactions. : the physical processes and phenomena of a particular system. : the physical properties and composition of something.'
        ]);
        Category::create([
            'title' => 'Chemistry',
            'description' => 'Chemistry is the branch of science that deals with the properties, composition, and structure of elements and compounds, how they can change, and the energy that is released or absorbed when they change.'
        ]);
        Category::create([
            'title' => 'Finance',
            'description' => 'Finance, of financing, is the process of raising funds or capital for any kind of expenditure. It is the process of channeling various funds in the form of credit, loans, or invested capital to those economic entities that most need them or can put them to the most productive use.'
        ]);
        Category::create([
            'title' => 'Business',
            'description' => 'Business studies, often simply called business, is a field of study that deals with the principles of business, management, and economics. It combines elements of accountancy, finance, marketing, organizational studies, human resource management, and operations.'
        ]);
        Category::create([
            'title' => 'Accounting',
            'description' => 'Accounting is a science that is used to analyze and manipulate financial data for businesses and the public.'
        ]);
        Category::create([
            'title' => 'Geography',
            'description' => "Geography is the study of places and the relationships between people and their environments. Geographers explore both the physical properties of Earth's surface and the human societies spread across it."
        ]);
        Category::create([
            'title' => 'Economic',
            'description' => 'Economics is the study of scarcity and its implications for the use of resources, production of goods and services, growth of production and welfare over time, and a great variety of other complex issues of vital concern to society.'
        ]);
        Category::create([
            'title' => 'Psychology',
            'description' => 'Psychology is the scientific study of mind and behavior. Psychology includes the study of conscious and unconscious phenomena, including feelings and thoughts. It is an academic discipline of immense scope, crossing the boundaries between the natural and social sciences.'
        ]);
    }
}
