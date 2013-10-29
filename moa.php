<?php

/**
 * my own Admin : highly portable content management layer
 * @author : manujith pallewatte [manujith.nc@gmail.com]
 * @date   : 29/10/13 
 */

include './config.php';

/**
 * This class is a top layer on which handling for [m]any object -> db representations can be performed
 * User is required to define the table structure as stated in the user guide
 * 
 */


class moA{
    //variable holds the table name corresponding to the given class instance
    private $table;
    //defining the primary key of the table
    private $primary;
    //defining the keys
    private $keys;
    //defining the fields of the system
    private $fields;
    
    /**
     * moA constructor
     * @param $table
     * give the name of the table to which the actions are performed
     * @param $cfg     * 
     * $cfg accepts an array
     * format
     * array => (
     *             'field' => 'field name'
     *          )
     * @param $primary
     * define the primary key field of the table
     */           
    public function __construct($table,$cfg,$primary) {
        if(isset($cfg)){
            $keys = array_keys($cfg);             
            $this->table = $table;
            $this->fields = $cfg;
            $this->keys = $keys;
            $this->primary = $primary;                
        }        
    }
    
    /**
     * moA object initialization function
     * @return type moO object
     * @param $params array     *  
     * Send an array with the required values for each field
     * $cfg accepts an array
     * format
     * array => (
     *             'field' => 'field value',
     *             'title' => 'My AWESOME title'
     *          )
     * 
     */    
    public function init($params){
        return new moO($params);
    }
    
    /**
     * 
     * @param $moo moO Object
     * Add new record the the specified table according to the data specified
     * in the moO object
     */
    public function add($moo){
        $q = "INSERT INTO ".$this->table." SET ";
        foreach($this->keys as $key){
            if(isset($moo->$key)){
                $q = $q.$this->fields[$key]." = '".$moo->$key."', ";
            }
        }
        $q = substr($q, 0,strlen($q)-2);
        query($q);
    }
    
    /**
     * Retrieve all records from the specified table
     * 
     * @return array of moO objects
     */
    public function getAll(){
        $q = "SELECT * FROM ".$this->table;
        $result = query($q);
        
        $moos = array();
        
        while($row = fetch_array($result)){
            $params = array();
            foreach($this->keys as $key){
                $params[$key] = $row[$this->fields[$key]];
            }
            $moo = new moO($params);
            array_push($moos, $moo);
        }
        return $moos;
    }
    
    /**
     * Retrieve all record correspoding to the given key-value pair
     * 
     * @param string $field
     * Name of the table field
     * @param string $value
     * Value of the table field
     * @return array of moO objects
     */
    public function getByField($field,$value){
        $q = "SELECT * FROM ".$this->table." WHERE ".$field." = '".$value."'";
        $result = query($q);
        
        $moos = array();
        
        while($row = fetch_array($result)){
            $params = array();
            foreach($this->keys as $key){
                $params[$key] = $row[$this->fields[$key]];
            }
            $moo = new moO($params);
            array_push($moos, $moo);
        }
        if(count($moos) == 1){
            return $moos[0];
        }else{
            return $moos;
        }
    }
    
    /**
     * Delete record from specified table corresponding to the moO object given
     * @param moO-Object $moo
     */
    public function delete($moo){
        $primary = $this->primary;
        if(isset($moo->$this->primary)){
            $q = "DELETE FROM ".$this->table." WHERE ".$this->fields[$this->primary]." = '".$moo->$primary."'";
            query($q);
        }        
    }
    
    /**
     * Delete all record from the specified table correspoding to the given key-value pair
     * @param string $field
     * Name of the table field
     * @param string $value
     * Value of the table field
     */
    public function deleteByField($field,$value){
        $q = "DELETE FROM ".$this->table." WHERE ".$field." = '".$value."'";
        query($q);
    }
    
    /**
     * Update the specified table record correspoding to the given moO object
     * @param moO-Object $moo
     */
    public function update($moo){
        $q = "UPDATE ".$this->table." SET ";
        $primary = $this->primary;
        
        foreach($this->keys as $key){
            if(isset($moo->$key)){
                $q = $q.$this->fields[$key]." = '".$moo->$key."', ";
            }
        }
        $q = substr($q, 0,  strlen($q)-2);
        $q .= " WHERE ".$this->fields[$this->primary]." = '".$moo->$primary."'";
        query($q);
    }   
    
   
}

/**
 * Class representing any Object initialized with moA
 * This is the an abstract class that will be implemented properly by the values
 * given to the constructor of moA
 */
class moO{
    public function __construct($params) {
        $keys = array_keys($params);
        foreach($keys as $key){
            $this->$key = $params[$key];
        }
        $this->keys = $keys;
    }
}


?>
