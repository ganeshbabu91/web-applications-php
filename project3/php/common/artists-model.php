<?php
    require_once 'dbconnection.php';
    /*
        Representation of Artists table in Art DB. 
        @author Ganeshbabu Thavasimuthu
    */
    $dbconnection = new DBConnection;
    class ArtistsModel{
        private $pdo = null;
        /* Constructor */
        public function __construct(){
            global $dbconnection;
            $this->pdo = $dbconnection->open(); 
        }

        /* Gets all the artists and sort it by last name */
        public function getArtists(){
            $artists = array();
            $sql = "SELECT ArtistID,FirstName,LastName,YearOfBirth,YearOfDeath FROM artists ORDER BY LastName ASC";
            $ps = $this->pdo->prepare($sql);
            $ps->execute();
            $ps->setFetchMode(PDO::FETCH_ASSOC);
            while ($row = $ps->fetch()) {
                $artists[] = $row; 
            }
            return $artists;
        }

        /* Gets both artists and artworks by join query */
        public function getArtistAndWorks($id){
            $artist_works = array();
            $sql = "SELECT * FROM artworks join artists WHERE artworks.ArtistID=artists.ArtistID AND artists.ArtistID=:id";
            $ps = $this->pdo->prepare($sql);
            $ps->bindValue(':id',$id);
            $ps->execute();
            $ps->setFetchMode(PDO::FETCH_ASSOC);
            while ($row = $ps->fetch()) {
                $artist_works[] = $row; 
            }
            return $artist_works;
        }

    }
?>