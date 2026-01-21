<?php

namespace App\Controllers;

use Core\Controller;

class ClubController extends Controller
{
    public function show($id)
    {
        if(session_status() === PHP_SESSION_NONE) session_start();

        

        return $this->render('clubs.show', [
            'club' => [
                'id' => $id,
                'name' => 'Robotics Club',
                'description' => 'Detailed description of the Robotics club. We focus on building autonomous robots and competing in national challenges. Our missions include training students on Arduino, Raspberry Pi, and advanced AI navigation.',
                'president' => 'Anas Errak',
                'established_at' => '2024',
                'members_count' => 5,
                'max_members' => 8,
                'image' => 'https://images.unsplash.com/photo-1581092160562-40aa08e78837',
                'rating' => 4.8,
                'reviews_count' => 12
            ],
            'events' => [
                ['id' => 1, 'title' => 'Arduino Workshop', 'date' => '2026-02-15', 'location' => 'Lab 101', 'day' => '15', 'month' => 'FEB'],
                ['id' => 2, 'title' => 'Robot Race 2K26', 'date' => '2026-03-10', 'location' => 'Main Hall', 'day' => '10', 'month' => 'MAR'],
            ],
            'articles' => [
                ['id' => 1, 'title' => 'Our first robot wins Gold!', 'summary' => 'Last weekend, our team competed in the regional robotics competition and secured a first-place finish with our custom drone.', 'image' => 'https://images.unsplash.com/photo-1485827404703-89b55fcc595e'],
            ]
        ]);
    }
}
