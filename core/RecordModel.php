<?php

abstract class RecordModel extends Model 
{
    private static $models;
    private $classname;
    private static $_pdo;
    protected $pdo;
    private $ATTRIBUTES = "SHOW FIELDS FROM {tableName};";
    private $UPDATE = "UPDATE {tableName} SET ";
    private $INSERT = 'INSERT INTO `{tableName}` ({names}) VALUES({values});';
    private $ALL = "SELECT * FROM {tableName} WHERE id!={yoursId};";
    
    private function __construct($classname = '')
    {
        if(!isset(self::$_pdo))
        {
            self::$_pdo = new PDO(Application::create()->db['connection'], Application::create()->db['username'], Application::create()->db['password']);
        }
        $this->pdo = self::$_pdo;

        $this->classname = $classname;
        $this->prepareAttributes();
    }

    public static function model($classname =__CLASS__)
    {
        if(!isset(self::$models[$classname]) || empty(self::$models[$classname]))
        {
            self::$models[$classname] = new $classname($classname);
        }
        return self::$models[$classname];
    }

    public function save()
    {
        if (!empty($this->id))
        {
            return $this->update();
        }
        return $this->insert();
    }

    protected function validate()
    {
        
    }

    public function getAll()
    {
        $this->ALL = preg_replace("/{tableName}/", $this->getTableName(), $this->ALL);
        $this->ALL = preg_replace("/{yoursId}/", $_SESSION['id'], $this->ALL);
        $sttm = $this->pdo->prepare($this->ALL);
        try 
        {
            $sttm->execute();
            $resultArray = $sttm->fetchAll(PDO::FETCH_ASSOC);
            foreach ($resultArray as $key => $value)
            {
                $model = new $this->classname();
                foreach ($resultArray[$key] as $k => $v)
                {
                    $model->$k = $v;
                }
                $result[$key] = $model;
            }
        }
        catch (Exception $e)
        {
            return $e->getMessage('Query error!');
        }
        return $result;
    }

    public function getByAttributes()
    {

        $SELECT = QB::table($this->getTableName())->select()->where(func_get_args())->end();
        $get = $this->pdo->prepare($SELECT);
        try
        {
            $get->execute();
            $result = $get->fetch(PDO::FETCH_ASSOC);
            if ($result)
            {
                $model = new $this->classname();
                foreach ($result as $k => $v)
                {
                    $model->$k = $v;
                }
                return $model;
            }
        }
        catch (Exception $e)
        {
            return $e->getMessage('Query error!');
        }
        return false;
    }

    //Set as many arrays as you want to this function params
    //Delimiter is ','
    
    public function getAllByAttributes()
    {
        $result = array();
      
        $SELECT = QB::table($this->getTableName())->select()->where(func_get_args())->end();

        $sttm = $this->pdo->prepare($SELECT);
        try
        {
            $sttm->execute();
            $resultArray = $sttm->fetchAll(PDO::FETCH_ASSOC);
            foreach ($resultArray as $key => $value)
            {
                $model = new $this->classname();
                foreach ($resultArray[$key] as $k => $v)
                {
                    $model->$k = $v;
                }
                $result[$key] = $model;
            }
        }
        catch (Exception $e) 
        {
            return $e->getMessage('Query error!');
        }
        return $result;
    }

    public function getTableName()
    {
        return $this->tableName;
    }

    protected function relations()
    {
        return array(
            
        );
    }
    
    public function deleteByAttributes()
    {
        $DELETE = QB::table($this->getTableName())->delete()->where(func_get_args())->end();
        $rm = $this->pdo->prepare($DELETE);
        try
        {
            $rm->execute();
            return true;
        }
        catch (Exception $e)
        {
            return $e->getMessage('Query error!');
        }
        return false;
    }
    //Private methods

    protected function insert()
    {
        $attributes = $this->getAttributeNames();
        $this->INSERT = preg_replace("/{tableName}/", $this->getTableName(), $this->INSERT);
        $names = '';
        $values = '';
        $withid = false;
        for ($i = 0; $i < count($attributes); $i++)
        {
            if($attributes[$i] === 'id'){
                $withid = true;
                continue;
            }
            $names .= $attributes[$i];

            if(!is_string($this->$attributes[$i]))
            {
                $values .= $this->$attributes[$i];
            }
            else
            {
                $val = $this->$attributes[$i];
                $values .= "'$val'";
            }
            if ($i < count($attributes) - 1)
            {
                $names .=',';
                $values .= ',';
            }
        }
        $this->INSERT = preg_replace("/{names}/", $names, $this->INSERT);
        $this->INSERT = preg_replace("/{values}/", $values, $this->INSERT);
        $sttm = $this->pdo->prepare($this->INSERT);
        try 
        {
            $sttm->execute();
            if($withid){
                $sttm = $this->pdo->prepare('SELECT MAX(id) as id FROM `event`;');
                $sttm->execute();
                $id = $sttm->fetch(PDO::FETCH_ASSOC);
                $this->id = $id['id'];
            }
            return true;
        }
        catch (Exception $ex)
        {
            return false;
        }
    }

    protected function update()
    {
        $attributes = $this->getAttributeNames();
        $count = 0;
        foreach ($attributes as $value)
        {
            $count++;
            $val = isset($this->$value) ? $this->$value : '';
            $this->UPDATE .= "$value='$val'";
            if (count($attributes) > $count)
                $this->UPDATE .= ", ";
        }
        $this->UPDATE .= " WHERE id = $this->id;";
        $this->UPDATE = preg_replace("/{tableName}/", $this->getTableName(), $this->UPDATE);
        $sttm = $this->pdo->prepare($this->UPDATE);
        try 
        {
            $sttm->execute();
            return true;
        }
        catch (Exception $ex)
        {
            return false;
        }
    }

    private function getAttributeNames()
    {
        $this->ATTRIBUTES = preg_replace("/{tableName}/", $this->getTableName(), $this->ATTRIBUTES);
        $sttm = $this->pdo->prepare($this->ATTRIBUTES);

        try
        {
            $sttm->execute();
            return $sttm->fetchAll(PDO::FETCH_COLUMN, 0);
        }
        catch (Exception $ex)
        {
            return $ex->getMessage('Query error!');
        }
    }

    private function prepareAttributes()
    {
        $fields = $this->getAttributeNames();
        foreach ($fields as $field)
        {
            $this->$field = 0;
        }
    }
}
