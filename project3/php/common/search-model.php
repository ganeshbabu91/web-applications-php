<?php
    require_once 'dbconnection.php';
    /*
        Provides data for Search Page. 
        @author Ganeshbabu Thavasimuthu
    */
    $dbconnection = new DBConnection;
    class SearchModel{
        private $pdo = null;
        public function __construct(){
            global $dbconnection;
            $this->pdo = $dbconnection->open(); 
        }
        public function search($keyword='', $category=''){
            $artworks = array();
            if($category == "title"){
                $sql = "SELECT * FROM artworks where Title Like '%".$keyword."%'";
            } else if($category == "desc"){
                $sql = "SELECT * FROM artworks where Description Like '%".$keyword."%'";
            } else{
                $sql = "SELECT * FROM artworks";
            }
            $ps = $this->pdo->prepare($sql);
            $ps->execute();
            $ps->setFetchMode(PDO::FETCH_ASSOC);
            while ($row = $ps->fetch()) {
                if($category != "all" && $category != "title")
                    $row['Description'] = preg_replace("/($keyword)/i", "<mark>$1</mark>", $row['Description']);
                $artworks[] = $row; 
            }
            return $artworks;
        }

    }
?>