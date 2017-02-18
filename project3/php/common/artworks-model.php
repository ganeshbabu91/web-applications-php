<?php
    require_once 'dbconnection.php';
    /*
        This model supplies data for Single Work page from Art DB. 
        @author Ganeshbabu Thavasimuthu
    */
    $dbconnection = new DBConnection;
    class ArtWorksModel{
        private $pdo = null;
        private $id = null;
        /* Constructor */
        public function __construct($id){
            global $dbconnection;
            $this->id = $id;
            $this->pdo = $dbconnection->open(); 
        }

        /* Gets Artworks for the given artwork id */
        public function getArtwork(){
            $sql = "SELECT * FROM artists JOIN artworks WHERE artists.ArtistID=artworks.ArtistID AND ArtWorkID=:id";
            $ps = $this->pdo->prepare($sql);
            $ps->bindValue(':id',$this->id);
            $ps->execute();
            $row = $ps->fetch();
            return $row;
        }

        /* Gets the subjects for the given artwork id */
        public function getSubjects(){
            $subjects = array();
            $sql = "SELECT * FROM artworksubjects join subjects WHERE artworksubjects.SubjectID = subjects.SubjectId AND ArtWorkID=:id";
            $ps = $this->pdo->prepare($sql);
            $ps->bindValue(':id',$this->id);
            $ps->execute();
            $ps->setFetchMode(PDO::FETCH_ASSOC);
            while ($row = $ps->fetch()) {
                $subjects[] = $row; 
            }
            return $subjects;
        }

        /* Gets the genres for the given artwork id */
        public function getGenres(){
            $genres = array();
            $sql = "SELECT * FROM artworkgenres join genres WHERE artworkgenres.GenreID = genres.GenreID AND ArtWorkID=:id";
            $ps = $this->pdo->prepare($sql);
            $ps->bindValue(':id',$this->id);
            $ps->execute();
            $ps->setFetchMode(PDO::FETCH_ASSOC);
            while ($row = $ps->fetch()) {
                $genres[] = $row; 
            }
            return $genres;
        }

        /* Gets the order details for the given artwork id */
        public function getOrders(){
            $orders = array();
            $sql = "SELECT * FROM orderdetails JOIN orders WHERE orderdetails.OrderID=orders.OrderID AND ArtWorkID=:id";
            $ps = $this->pdo->prepare($sql);
            $ps->bindValue(':id',$this->id);
            $ps->execute();
            $ps->setFetchMode(PDO::FETCH_ASSOC);
            while ($row = $ps->fetch()) {
                $orders[] = $row; 
            }
            return $orders;
        }
        
    }
?>