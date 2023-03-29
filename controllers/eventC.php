<?php
require_once "../models/config.php";
// require_once "../models/Event.php";
class EventC{
    public function addEvent($event){
        try {
            $sql = "INSERT INTO event (nom, type, lieu, dateEvent, description, nbPlaces) VALUES (:nom, :type, :lieu, :dateEvent, :description, :nbPlaces)";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->bindValue('nom', $event->getnomEvent());
            $query->bindValue('type', $event->gettypeEvent());
            $query->bindValue('lieu', $event->getlieuEvent());
            $query->bindValue('dateEvent', $event->getdateEvent()->format('Y-m-d'));
            $query->bindValue('description', $event->getdescriptionEvent());
            $query->bindValue('nbPlaces', $event->getnbPlacesEvent());
            $query->execute();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function displayEvents(){
        try {
            $sql = "SELECT * from event";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function deleteEvent(int $idEvent){
        try {
            $sql = "DELETE from event where idEvent = ?";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->bindParam(1, $idEvent);
            $query->execute();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function getEventById($idEvent){
        try {
            $sql = "SELECT * from event where idEvent=?";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->bindParam(1, $idEvent);
            $query->execute();
            return $query->fetch();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function updateEvent($idEvent, $event){
        try {
            $sql = "UPDATE event SET nom = :nom, type = :type, lieu = :lieu, dateEvent = :dateEvent, description = :description, nbPlaces = :nbPlaces WHERE idEvent = :idEvent";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->bindValue('nom', $event->getnomEvent());
            $query->bindValue('type', $event->gettypeEvent());
            $query->bindValue('lieu', $event->getlieuEvent());
            $query->bindValue('dateEvent', $event->getdateEvent()->format('Y-m-d'));
            $query->bindValue('description', $event->getdescriptionEvent());
            $query->bindValue('nbPlaces', $event->getnbPlacesEvent());
            $query->bindValue(':idEvent', $idEvent);
            $query->execute();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function sortEvent(){}
}
