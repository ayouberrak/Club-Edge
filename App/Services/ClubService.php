<?php

namespace App\Services;

use App\Repository\ClubRepository;


class ClubService
{

    public function getallclub()
    {
        $clubRepository = new ClubRepository();
        return $clubRepository->allClubs();
    }

    public function createClub($clubInfo)
    {
        $clubRep = new ClubRepository();
        $countClub = $clubRep->getCountClubs();

        if ($countClub >= 8) {
            return false;
        }

        $return = $this->moveprofilephoto($clubInfo['image_url']);

        if (!$return) {
            return false;
        }

        if ($clubInfo['max_membres'] > 8 || $clubInfo['max_membres'] < 6) {
            return false;
        }

        $clubInfo['image_url'] = $return;

        $clubRep->create($clubInfo);

    }

    public function moveprofilephoto($file)
    {
        if ($file['error'] === 0) {
            $filename = uniqid() . '_' . $file['name'];
            $pathfile = SRC_PATH . '/public/assets/img/' . $filename;
            if (move_uploaded_file($file['tmp_name'], $pathfile)) {
                return $filename;
            }
        }
        return false;
    }


    public function deleteClub($id)
    {
        $clubrep = new ClubRepository();
        $countClub = $clubrep->getCountClubs();

        if ($countClub <= 6) {
            return false;
        }

        $idClub = ['id_club' => $id];


        $clubrep->delete($idClub);


    }

    public function clubaupdate($clubinfo, $condition)
    {
        $clubrep = new ClubRepository();

        if (isset($clubinfo['image_url']) && !empty($clubinfo['image_url'])) {
            $return = $this->moveprofilephoto($clubinfo['image_url']);
            
            if ($return) {
                $clubinfo['image_url'] = $return;
            } else {
                // If upload fails but image was attempted, maybe we should return false or skip image?
                // For now, let's return false to indicate failure.
                 return false;
            }
        }

        $clubrep->update($clubinfo, $condition);
    }

    public function getclubinfo($id)
    {

        $clubrep = new ClubRepository();

        $idClub = ['id_club' => $id];

        return $clubrep->findbyid($idClub);

    }

    public function getPotentialPresidents()
    {
        $clubRep = new ClubRepository();
        return $clubRep->getPotentialPresidents();
    }

}