<?php
namespace App\Services;

use App\Repository\ClubRepository;

class AdminService
{

    private function getCountClub(ClubRepository $clubrep)
    {
        return $clubrep->getCountClubs();
    }

    public function createClub($coachInfo)
    {
        $clubRep = new ClubRepository();
        $countClub = $this->getCountClub($clubRep);

        if ($countClub >= 8) {
            return false;
        }

        $return = $this->moveprofilephoto($coachInfo['image_url']);

        if (!$return) {
            return false;
        }

        $coachInfo['image_url'] = $return;

        $clubRep->create($coachInfo);

    }

    public function moveprofilephoto($file)
    {
        if ($file['error'] === 0) {
            $filename = uniqid() . '_' . $file['name'];
            $pathfile = SRC_PATH . '/public/assets/img' . $filename;
            if (move_uploaded_file($file['tmp_name'], $pathfile)) {
                return $filename;
            }
        }
        return false;
    }



}