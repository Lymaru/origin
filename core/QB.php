<?php

//Query Builder

class QB
{
    private static $instanse;
    private $tablename;
    private $query = '';
    const SPACE = " ";

    private function __construct()
    {
        
    }

    public static function table($tablename)
    {
        if (empty(self::$instanse))
        {
            self::$instanse = new QB();
        }
        self::$instanse->tablename = $tablename;
        self::$instanse->query = '';
        return self::$instanse;
    }

    public function select($goal = '*')
    {
        $query = "SELECT $goal FROM `$this->tablename`";
        $this->query .= $query;
        return $this;
    }
    
    public function delete()
    {
        $query = "DELETE FROM `$this->tablename`";
        $this->query .= $query;
        return $this;
    }

    public function join($relations)
    {
        $JOIN = '';

        foreach ($relations as $key => $value)
        {
            $JOIN .= QB::SPACE . "JOIN `$value[0]` ON $this->tablename.$key=$value[0].$value[1]";
        }
        $this->query .= $JOIN;
        return $this;
    }

    public function where(array $arr)
    {
        $WHERE = QB::SPACE . 'WHERE' . QB::SPACE;
        $count = 0;
        foreach ($arr as $value)
        {
            $count++;
            $WHERE .= $value[0];
            $WHERE .= $value[1];
            $WHERE .= "'$value[2]'";
            if (count($arr) > $count)
                $WHERE .= QB::SPACE . "AND".QB::SPACE;
        }
        $this->query .= $WHERE;
        return $this;
    }

    public function end()
    {
        return $this->query . ';';
    }
}
