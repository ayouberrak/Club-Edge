<?php

namespace App\Services;


use App\Models\Event;
use App\Repository\EventRepository;

class EventService
{
    private EventRepository $eventRepository;

    public function __construct()
    {
        $this->eventRepository = new EventRepository();
    }


    public function organizeEvent(Event $event, string $userRole): bool
    {
        if ($userRole !== 'president' && $userRole !== 'admin') {
            throw new \Exception("Seul un président ou un admin peut créer un événement.");
        }

    
        if (strtotime($event->getDateEvent()) < time()) {
            throw new \Exception("La date de l'événement ne peut pas être dans le passé.");
        }

        return $this->eventRepository->create($event);
    }

    public function getAllEvents(): array
    {
        return $this->eventRepository->findAll();
    }

    public function getEventsByClub(int $clubId): array
    {
        return $this->eventRepository->findByClub($clubId);
    }

    public function cancelEvent(int $id_event): bool
    {
        return $this->eventRepository->delete($id_event);
    }

    public function registerStudentToEvent(int $eventId, int $userId): bool
    {
        if ($this->isStudentRegistered($eventId, $userId)) {
            return false;
        }

        return $this->eventRepository->registerParticipation($eventId, $userId);
    }

    public function isStudentRegistered(int $eventId, int $userId): bool
    {
        return $this->eventRepository->isUserRegistered($eventId, $userId);
    }

    public function cancelStudentParticipation(int $eventId, int $userId): bool
    {
        return $this->eventRepository->deleteParticipation($eventId, $userId);
    }
}