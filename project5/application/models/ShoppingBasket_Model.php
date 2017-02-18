<?php 
class ShoppingBasket_Model extends CI_Model {

    /* Constructor which opens a connection to the database */
    public function __construct(){
        $this->load->database(); 
    }

    /* Get the stocks from multiple warehouses for the given item */
    public function getWarehouses($item){
        $warehouses = array();
        $sql = "select stocks.warehouseCode,name,number from stocks join warehouse WHERE isbn='".$item['isbn']."' and stocks.warehouseCode=warehouse.warehouseCode";
        $query = $this->db->query($sql);
        foreach($query->result_array() as $row){
            $warehouses[] = $row;
        }
        return $warehouses;
    }

    /* Calculates the price and subtotal (qty * price) for each item */
    public function calculateSubtotal($items){
        $isbns = array();
        foreach($items as $item){
            array_push($isbns,$item['isbn']);
        }
        $isbns = join("','",$isbns);   
        $sql = "SELECT price FROM book WHERE ISBN IN ('$isbns')";
        $query = $this->db->query($sql);
        $i = 0;
        foreach($query->result_array() as $row){
            $items[$i]['price'] = $row['price'];
            $items[$i]['subtotal'] = $row['price'] * $items[$i]['number']; 
            $i++;
        }
        return $items;
    }

    /* Returns the total price of the shopping cart (Sum of subtotal (qty * price) of all items) */
    public function calculateTotalPrice($items){
        $total = 0;
        foreach($items as $item){
            $total += $item['subtotal'];
        }
        return $total;
    }
    
    /* Implements the Buy functionality (Save the shopping basket in session to database)
        1. Create a new basket with current basketId and username in ShoppingBasket table
        2. Add all the items for this basket to the Contains table
        3. Make an entry with warehouse code (take the closest warehouse to the user location, in case of multiple warehouses available) in the ShippingOrder table
        4. Update the Stocks table, decrease the count from the corresponding warehouse for each item 
        5. w100 - ArlingtonWarehouse is the default from where all books are delivered till it go out of stock
    */
    public function buy($basket){
        $data = array();
        try{
        $this->db->trans_start();
        $this->db->query("insert into ShoppingBasket(basketID,username) values('".$basket['basketID']."','".$basket['username']."')");
        foreach($basket['items'] as $item){
            $this->db->query("insert into Contains(ISBN,basketID,number) values('".$item['isbn']."','".$basket['basketID']."','".$item['number']."')");
            $this->db->query("insert into ShippingOrder(ISBN,warehouseCode,username,number) values('".$item['isbn']."','w100','".$basket['username']."','".$item['number']."') on duplicate key update number=".$item['number']);
            if($item['isMultiWarehouseUpdate']){
                $counter = $item['number'];
                foreach($item['warehouseUpdate'] as $warehouseUpdate){
                    $warehouseCode = $warehouseUpdate['warehouseCode'];
                    $counter -= $warehouseUpdate['stock'];
                    if($counter>=0){
                        //echo "updating ".$warehouseCode." with counter = ".$counter;
                        $this->db->query("update stocks set number=0 where ISBN=".$item['isbn']." and warehouseCode='".$warehouseCode."'");
                    }else{
                        /*10 6 4
                        7  1 -3
                        8  2 -2
                        9  3 -1
                        10 4 0*/
                        $newstock = $warehouseUpdate['stock']+$counter; // counter is negative here
                        //echo "updating ".$warehouseCode." with new stock = ".$newstock;
                        $this->db->query("update stocks set number=".$newstock." where ISBN=".$item['isbn']." and warehouseCode='".$warehouseCode."'");
                    }
                        
                }
            }else{
                $warehouseCode = $item['warehouseUpdate']['warehouseCode'];
                //echo "updating ".$warehouseCode;
                $this->db->query("update stocks set number=number-".$item['number']." where ISBN=".$item['isbn']." and warehouseCode='".$warehouseCode."'");
            }
            
        }
        $this->db->trans_complete();
        $data['success']=true;
        }catch(PDOException $pe){
            $this->pdo->rollback();
            $data['success']=false;
            $data['errmsg']=$pe->getMessage();
        }
        return $data;
    }
    
}
?>