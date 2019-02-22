<?php
/**
 * Created by PhpStorm.
 * User: prios
 * Date: 1/26/19
 * Time: 1:30 AM
 */
$base = realpath( dirname( __FILE__ ) );
require_once( $base.'/../_Conn.php' );
require_once( $base.'/../_App.php' );

abstract class Model
{
    protected function getTableName($table) {
//        $table = strtolower($table);
//        $last_letter = strtolower($table[strlen($table)-1]);
//        switch($last_letter) {
//            case 'y':
//                return substr($table,0,-1).'ies';
//            case 's':
//                return $table.'es';
//            default:
//                return $table.'s';
//        }
        return $table;
    }

    private function collect($data) {
        $class = get_called_class();
        if(is_object($data)) {
            $obj = new $class;
            foreach (get_object_vars($data) as $key => $value) {
                $obj->$key = $value;
            }
            return $obj;
        } else if(is_array($data)) {
            foreach ($data as $index=>$object) {
                $obj = "obj$index";
                $$obj = new $class;
                foreach (get_object_vars($object) as $key => $value) {
                    $$obj->$key = $value;
                }
                $data[$index] = $$obj;
            }
        }
        return $data;
    }

    public static function find($id) {
        $data = self::getJSON();
        $data = array_filter($data, function($obj) use($id) {
            return $obj->id == $id;
        });
        if(sizeof($data)>0) {
            return self::collect($data[0]);
        } else {
            return null;
        }
    }

    public static function get($attributes = ['*']) {
        /*
         * Attributes Filter Not applied;
         */
        $data = self::getJSON();
        return self::collect($data);
    }

    public static function where($key,$value,$operator='=') {
        $data = self::getJSON();
        $data = array_filter($data, function($obj) use($value,$operator,$key) {
            switch ($operator) {
                case '>':
                    return $obj->$key > $value;
                    break;
                case '<':
                    return $obj->$key > $value;
                    break;
                case '>=':
                    return $obj->$key >= $value;
                    break;
                case '<=':
                    return $obj->$key <= $value;
                    break;
                case '<>':
                    return $obj->$key != $value;
                    break;
                case '!=':
                    return $obj->$key != $value;
                    break;
                default:
                    return $obj->$key == $value;
            }
        });
        $data = array_values($data);
        return self::collect($data);

    }

    public static function store($data) {
        $DATA = self::getJSON();
        if(!is_array($DATA)) {
            $DATA = [];
        }
        $data->id = sizeof($DATA)+1;
        array_push($DATA, $data);
        return self::saveJSON($DATA);
    }

    public static function update($data) {
        $DATA = self::getJSON();
        $found = false;
        foreach($DATA as $index=>$obj) {
            if($obj->id==$data->id) {
                $found = true;
                $DATA[$index] = $data;
                break;
            }
        }
        return $found && self::saveJSON($DATA);
    }

    public static function delete($id) {
        if(is_object($id)) {
            $id = $id->id;
        }
        $DATA = self::getJSON();
        $found = false;
        foreach($DATA as $index=>$obj) {
            if($obj->id==$id) {
                $found = true;
                unset($DATA[$index]);
                $DATA = array_values($DATA);
                break;
            }
        }
        return $found && self::saveJSON($DATA);
    }

    public function getJSON($class = null) {
        if($class==null) {
            $class = get_called_class();
        }
        $file = storage('Storage/'.$class.'.json');
        if(!file_exists($file)) {
            file_put_contents($file,'');
        }
        $json = file_get_contents($file);
        $json = json_decode($json);
        if($json==null) {
            trigger_error('Invalid JSON data!', E_USER_WARNING);;
            return [];
        } else {
            return $json;
        }
    }

    private function saveJSON($data,$class=null) {
        if($class==null) {
            $class = get_called_class();
        }
        $file = storage('Storage/'.$class.'.json');
        if(!file_exists($file)) {
            file_put_contents($file,'');
        }
        $data = self::is_json($data)?$data:json($data);
        if(!file_put_contents($file,$data)) {
            return false;
        } else {
            return true;
        }
    }

    protected function is_json( $raw_json ){
        $raw_json = json_encode($raw_json);
        return ( json_decode( $raw_json , true ) == NULL ) ? true : false ; // Yes! thats it.
    }

}

