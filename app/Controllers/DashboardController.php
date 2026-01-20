<?php

namespace App\Controllers;

use Core\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // Student Dashboard Data
        return $this->render('dashboards.student', [
            'my_club' => [
                'id' => 1,
                'name' => 'Robotics Club',
                'joined_at' => '2025-09-12',
                'image' => 'https://images.unsplash.com/photo-1581092160562-40aa08e78837',
                'members_count' => 5,
                'max_members' => 8
            ],
            'registered_events' => [
                ['id' => 1, 'title' => 'Advanced Arduino', 'date' => '2026-02-15', 'location' => 'Room 402', 'status' => 'upcoming'],
                ['id' => 2, 'title' => 'Annual Tech Summit', 'date' => '2026-01-10', 'location' => 'Main Hall', 'status' => 'completed', 'reviewed' => false],
            ],
            'past_articles' => [
                ['id' => 101, 'title' => 'Exploring AI in 2026', 'club' => 'Robotics Club', 'date' => 'Yesterday'],
            ]
        ]);
    }

    public function president()
    {
        // President Dashboard Data (Manages Robotics Club)
        return $this->render('dashboards.president', [
            'club' => [
                'name' => 'Robotics Club',
                'members_count' => 5,
                'max_members' => 8
            ],
            'members' => [
                ['id' => 1, 'name' => 'Anas Errak', 'email' => 'anas@univ.ma', 'role' => 'President', 'online' => true],
                ['id' => 2, 'name' => 'John Doe', 'email' => 'john@univ.ma', 'role' => 'Member', 'online' => false],
                ['id' => 3, 'name' => 'Sara Smith', 'email' => 'sara@univ.ma', 'role' => 'Member', 'online' => true],
                ['id' => 4, 'name' => 'Ahmed Ali', 'email' => 'ahmed@univ.ma', 'role' => 'Member', 'online' => false],
                ['id' => 5, 'name' => 'Yassine Kan', 'email' => 'yassine@univ.ma', 'role' => 'Member', 'online' => true],
            ],
            'events' => [
                ['id' => 1, 'title' => 'Cyber Security Talk', 'date' => '2026-03-12', 'participants' => 24, 'image' => 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b'],
                ['id' => 2, 'title' => 'IoT Workshop', 'date' => '2026-04-05', 'participants' => 12, 'image' => 'https://images.unsplash.com/photo-1518770660439-4636190af475'],
            ],
            'participants' => [
                ['event_id' => 1, 'name' => 'Amine Reda', 'status' => 'confirmed'],
                ['event_id' => 1, 'name' => 'Laila Ben', 'status' => 'confirmed'],
            ]
        ]);
    }

    public function admin()
    {
        // Admin Dashboard Data
        return $this->render('dashboards.admin', [
            'stats' => [
                'total_clubs' => 6,
                'total_students' => 428,
                'pending_reviews' => 14,
                'active_events' => 8
            ],
            'clubs' => [
                ['id' => 1, 'name' => 'Robotics Club', 'president' => 'Anas Errak', 'members' => 5, 'capacity' => 8, 'status' => 'active'],
                ['id' => 2, 'name' => 'Music Club', 'president' => 'Mehdi Ray', 'members' => 8, 'capacity' => 8, 'status' => 'full'],
                ['id' => 3, 'name' => 'Sport Club', 'president' => 'Youssef Zen', 'members' => 4, 'capacity' => 8, 'status' => 'active'],
                ['id' => 4, 'name' => 'Chess Club', 'president' => 'Sarah Smith', 'members' => 6, 'capacity' => 8, 'status' => 'active'],
                ['id' => 5, 'name' => 'Art Club', 'president' => 'Ines Ber', 'members' => 3, 'capacity' => 8, 'status' => 'low'],
                ['id' => 6, 'name' => 'Coding Club', 'president' => 'Omar Far', 'members' => 7, 'capacity' => 8, 'status' => 'active'],
            ],
            'students' => [
                ['id' => 101, 'name' => 'Ayoub Errak', 'email' => 'ayoub@univ.ma', 'club' => 'Coding Club'],
                ['id' => 102, 'name' => 'Fatima Zahra', 'email' => 'fatima@univ.ma', 'club' => 'Robotics Club'],
                ['id' => 103, 'name' => 'Karim Ben', 'email' => 'karim@univ.ma', 'club' => 'None'],
            ]
        ]);
    }
}
