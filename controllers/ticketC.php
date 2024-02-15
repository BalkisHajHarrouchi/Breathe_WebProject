<?php
require_once "C:/xampp/htdocs/Projet/config2.php";

// require_once "../models/Event.php";
class TicketC{
    public function addTicket($ticket, $nbTicket) {
        try {  
            $sql = "INSERT INTO tickets (idEvent, dateTicketExp, codeTicket, detailTicket) VALUES (:idEvent, :dateTicketExp, :codeTicket, :detailTicket)";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->bindValue('idEvent', $ticket->getidEvent());
            $query->bindValue('dateTicketExp', $ticket->getdateTicketExp()->format('Y-m-d'));
            $query->bindValue('codeTicket', $ticket->getcodeTicket());
            $query->bindValue('detailTicket', $ticket->getdetailTicket());
            for($i=0; $i<$nbTicket; $i++){   
            $query->execute();
        }
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function availableTickets() {
        $sql = "SELECT idEvent, COUNT(*) AS num_available_tickets FROM ticket WHERE vendu = false GROUP BY idEvent";
        $db = config::getConnection();
        $query = $db->prepare($sql);

        $availableTickets = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $eventId = $row['idEvent'];
            $numAvailableTickets = $row['num_available_tickets'];

            $availableTickets[$eventId] = $numAvailableTickets;
        }

        return $availableTickets;
    }
    public function displayTickets(){
        try {
            $sql = "SELECT * from tickets";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function deleteTicket(int $idTicket){
        try {
            $sql = "DELETE from tickets where idEvent = ?";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $ticket = $this->getTicketById($idTicket);
            $query->bindParam(1, $ticket['idEvent']);
            $query->execute();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function getTicketById($idTicket){
        try {
            $sql = "SELECT * from tickets where idTicket=?";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            $query->bindParam(1, $idTicket);
            $query->execute();
            return $query->fetch();
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    public function updateTicket($ticket){
        try {

            $sql = "UPDATE tickets SET  dateTicketExp = :dateTicketExp, codeTicket = :codeTicket, detailTicket = :detailTicket WHERE idEvent = :idEvent";
            $db = config::getConnection();
            $query = $db->prepare($sql);
            // $query->bindValue('idEvent', $ticket->getidEvent());
            $query->bindValue('dateTicketExp', $ticket->getdateTicketExp()->format('Y-m-d'));
            $query->bindValue('codeTicket', $ticket->getcodeTicket());
            $query->bindValue('detailTicket', $ticket->getdetailTicket());
            $query->bindValue(':idEvent',$ticket->getidEvent());
            // for($i=0; $i<$nbTicket; $i++){   
                $query->execute();
            // }
        } catch (Exception $e) {
            die('Error: '.$e->getMessage());
        }
    }
    // public function venteTicket($idEvent){
    //     try {
    //         // vendu state = true
    //         $sql= "UPDATE tickets SET  vendu = true WHERE idEvent = :idEvent and vendu = false limit 1";
    //         $db = config::getConnection();
    //         $query = $db->prepare($sql);
    //         $query->bindValue('idEvent',$idEvent);
    //         $query->execute();
    //         // $ticket=$query->fetch()["idTicket"];
    //         // update the available number
    //         $eventC = new EventC();
    //         $event = $eventC->getEventById($idEvent);  
    //         $sql= 'UPDATE events SET nbPlaces =' . $event['nbPlaces'] - 1 . ' WHERE idEvent= :idEvent';
    //         $query->bindValue('idEvent',$idEvent);
    //         // return $ticket;
    //     } catch (Exception $e) {
    //         die('Error: '.$e->getMessage());
    //     }
    // }


    public function findFirstAvailableTicket($idEvent) {
        try {
            $db = config::getConnection();
            $sql = "SELECT idTicket FROM tickets WHERE idEvent = :idEvent AND vendu = false LIMIT 1";
            $query = $db->prepare($sql);
            $query->bindValue('idEvent', $idEvent);
            $query->execute();
    
            // return the id of the first available ticket, or null if no ticket is available
            return $query->fetchColumn() ?: null;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    
    public function venteTicket($idEvent) {
        try {
            // find the first available ticket
            $ticketId = $this->findFirstAvailableTicket($idEvent);
    
            // check if a ticket is available
            if ($ticketId) {
                // vendu state = true
                $db = config::getConnection();
                $sql = "UPDATE tickets SET vendu = true WHERE idTicket = :ticketId LIMIT 1";
                $query = $db->prepare($sql);
                $query->bindValue('ticketId', $ticketId);
                $query->execute();
    
                // update the available number
                $eventC = new EventC();
                $event = $eventC->getEventById($idEvent);
                // return the id of the sold ticket
                return $ticketId;
            } else {
                // return an error message if no ticket is available
                return -1;
            }
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    public function getEventNameFromTicket($idTicket) {
        try {
            $db = config::getConnection();
            $sql = "SELECT events.nom
                    FROM tickets
                    INNER JOIN events ON tickets.idEvent = events.idEvent
                    WHERE tickets.idTicket = :idTicket";
            $query = $db->prepare($sql);
            $query->bindValue('idTicket', $idTicket);
            $query->execute();
    
            // return the event name associated with the ticket
            $row = $query->fetch(PDO::FETCH_ASSOC);
            return $row ? $row['nom'] : null;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    public function getEventImageFromTicket($idTicket) {
        try {
            $db = config::getConnection();
            $sql = "SELECT events.image
                    FROM tickets
                    INNER JOIN events ON tickets.idEvent = events.idEvent
                    WHERE tickets.idTicket = :idTicket";
            $query = $db->prepare($sql);
            $query->bindValue('idTicket', $idTicket);
            $query->execute();
    
            // return the event name associated with the ticket
            $row = $query->fetch(PDO::FETCH_ASSOC);
            return $row ? $row['image'] : null;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    public function getEventDateFromTicket($idTicket) {
        try {
            $db = config::getConnection();
            $sql = "SELECT DATE_FORMAT(events.dateEventStart, '%Y-%m-%d') AS eventDate
                    FROM tickets
                    INNER JOIN events ON tickets.idEvent = events.idEvent
                    WHERE tickets.idTicket = :idTicket";
            $query = $db->prepare($sql);
            $query->bindValue('idTicket', $idTicket);
            $query->execute();
    
            // return the event date associated with the ticket in the 'Y-m-d' format
            $row = $query->fetch(PDO::FETCH_ASSOC);
            return $row ? $row['eventDate'] : null;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    public function getEventTimeFromTicket($idTicket) {
        try {
            $db = config::getConnection();
            $sql = "SELECT TIME_FORMAT(events.dateEventStart, '%H:%i') AS eventDate
                    FROM tickets
                    INNER JOIN events ON tickets.idEvent = events.idEvent
                    WHERE tickets.idTicket = :idTicket";
            $query = $db->prepare($sql);
            $query->bindValue('idTicket', $idTicket);
            $query->execute();
    
            // return the event time associated with the ticket in the 'H:i' format
            $row = $query->fetch(PDO::FETCH_ASSOC);
            return $row ? $row['eventDate'] : null;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    public function getEventLocationFromTicket($idTicket) {
        try {
            $db = config::getConnection();
            $sql = "SELECT events.lieu
                    FROM tickets
                    INNER JOIN events ON tickets.idEvent = events.idEvent
                    WHERE tickets.idTicket = :idTicket";
            $query = $db->prepare($sql);
            $query->bindValue('idTicket', $idTicket);
            $query->execute();
    
            // return the event name associated with the ticket
            $row = $query->fetch(PDO::FETCH_ASSOC);
            return $row ? $row['lieu'] : null;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    public function getEventPriceFromTicket($idTicket) {
        try {
            $db = config::getConnection();
            $sql = "SELECT events.prixEvent
                    FROM tickets
                    INNER JOIN events ON tickets.idEvent = events.idEvent
                    WHERE tickets.idTicket = :idTicket";
            $query = $db->prepare($sql);
            $query->bindValue('idTicket', $idTicket);
            $query->execute();
    
            // return the event name associated with the ticket
            $row = $query->fetch(PDO::FETCH_ASSOC);
            return $row ? $row['prixEvent'] : null;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }   

    public function displayTicket($idTicket) {
        try {
            $db = config::getConnection();
            $sql = "SELECT *
                    FROM tickets
                    WHERE idTicket = :idTicket";
            $query = $db->prepare($sql);
            $query->bindValue('idTicket', $idTicket);
            $query->execute();
            
    
            // check if the ticket exists
            if ($query->rowCount() == 0) {
                echo "Ticket not found";
                return;
            }
    
            // display the ticket information
            $ticket = $query->fetch();
            return $ticket;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    
    
    function searchTickets($input)
    {
        $sql = "SELECT * FROM tickets WHERE idEvent LIKE '%" . $input . "%' OR codeTicket LIKE '%" . $input . "%' OR detailTicket LIKE '%" . $input . "%' OR vendu LIKE '%" . $input . "%'";
        $db = config::getConnection();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $ticket = $query->fetchAll();
            return $ticket;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    function trisTicket($w){
        if($w==""){
            $sql = "SELECT * from tickets";
        }else{
            $sql = "SELECT * FROM tickets ORDER BY $w"; 
        }
        $db = config::getConnection();
        
            $query=$db->prepare($sql);
            $query->execute();

            $type=  $query->fetchAll(PDO::FETCH_ASSOC);
            return $type;
    
    }
}
