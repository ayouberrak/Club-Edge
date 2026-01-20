<?php

namespace App\Controllers;

use Core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        if(session_status() === PHP_SESSION_NONE ) session_start();
        return $this->render('home', [
            'clubs' => [
                [
                    'id' => 1, 
                    'name' => 'Robotics Club', 
                    'category' => 'tech',
                    'description' => 'Where engineering meets imagination. We build the future, one robot at a time.', 
                    'image' => 'https://images.unsplash.com/photo-1581092160562-40aa08e78837',
                    'president' => 'Anas Errak',
                    'rating' => 4.9,
                    'members_count' => 5,
                    'established_at' => '2024'
                ],
                [
                    'id' => 2, 
                    'name' => 'Music Club', 
                    'category' => 'art',
                    'description' => 'Unleash your rhythm and find your sound in the university\'s most vibrant musical community.', 
                    'image' => 'https://images.unsplash.com/photo-1511379938547-c1f69419868d',
                    'president' => 'Mehdi Ray',
                    'rating' => 4.8,
                    'members_count' => 12,
                    'established_at' => '2022'
                ],
                [
                    'id' => 3, 
                    'name' => 'Chess Club', 
                    'category' => 'tech', // Strategy/Logic fits Tech or special
                    'description' => 'Strategy, patience, and victory. Master the game of kings with our elite grandmasters.', 
                    'image' => 'https://images.unsplash.com/photo-1529699211952-734e80c4d42b',
                    'president' => 'Sarah Smith',
                    'rating' => 4.7,
                    'members_count' => 8,
                    'established_at' => '2023'
                ],
                [
                    'id' => 4, 
                    'name' => 'Coding Club', 
                    'category' => 'tech',
                    'description' => 'Scale your skills from zero to hero. Building the next generation of software architects.', 
                    'image' => 'https://images.unsplash.com/photo-1515879218367-8466d910aaa4',
                    'president' => 'Ayoub Errak',
                    'rating' => 5.0,
                    'members_count' => 24,
                    'established_at' => '2025'
                ],
                [
                    'id' => 5, 
                    'name' => 'Art Club', 
                    'category' => 'art',
                    'description' => 'Express the unseen. A sanctuary for creative minds to explore traditional and digital art.', 
                    'image' => 'https://images.unsplash.com/photo-1460661419201-fd4cecdf8a8b',
                    'president' => 'Ines Ber',
                    'rating' => 4.6,
                    'members_count' => 15,
                    'established_at' => '2022'
                ],
                [
                    'id' => 6, 
                    'name' => 'Gaming Hub', 
                    'category' => 'sports', // E-sports
                    'description' => 'Competitive play and social bonding. From e-sports to board games, we have it all.', 
                    'image' => 'https://images.unsplash.com/photo-1542751371-adc38448a05e',
                    'president' => 'Omar Far',
                    'rating' => 4.9,
                    'members_count' => 42,
                    'established_at' => '2024'
                ]
            ]
        ]);
    }
}
