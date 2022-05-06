<?php

    require_once (ROOT . '/Components/Database.php');

    abstract class ORM
    {
        abstract public function GetTableName() : string;
        abstract public function GetFields() : array;

        public function CheckId(int $id) : bool{
            $nameId = array_search('id',$this->GetFields());

            $sql = 'SELECT id FROM ' . $this->GetTableName() . ' WHERE ' . $nameId . ' = :id';

            $statement = Database::connection()->prepare($sql);
            $statement->bindValue(":id", $id);
            $statement->execute();

            if ($statement->rowCount() == 1)
                return true;
            else
                return false;
        }

        public function DeleteRecord(int $id) : bool{

            if (!$this->CheckId($id))
                return false;

            $nameId = array_search('id',$this->GetFields());

            $sql = 'DELETE FROM ' . $this->GetTableName() . ' WHERE ' . $nameId . ' = :id';

            $statement = Database::connection()->prepare($sql);
            $statement->bindValue(":id", $id);
            return $statement->execute();
        }

        public function GetRecords() : ?array{

            $sql = 'SELECT * FROM ' .  $this->GetTableName();
            $result = Database::connection()->query($sql);

            $data = array();
            $keys = array_keys($this->GetFields());

            for($i = 0; $value = $result->fetch(PDO::FETCH_ASSOC); $i++)
                for($j = 0; $j < count($keys) ; $j++)
                    if ($this->GetFields()[$keys[$j]] != 'list')
                        $data[$i][$keys[$j]] = $value[$keys[$j]];

            return $data;
        }

        public function GetRecord(int $id) : ?array{
            $nameId = array_search('id',$this->GetFields());
            $sql = 'SELECT * FROM ' .  $this->GetTableName() . ' WHERE ' . $nameId . ' = :id';

            $statement = Database::connection()->prepare($sql);
            $statement->execute(array('id'=>$id));

            return $statement->fetch(PDO::FETCH_ASSOC);
        }

        public function AddRecord(array $params) :bool{
            $fields = $this->GetFields();

            unset($fields[array_search('id',$fields)]);
            while(array_search('list',$fields)){
                unset($fields[array_search('list',$fields)]);
            }
            while(array_search('file',$fields)){
                unset($fields[array_search('file',$fields)]);
            }

            $into = implode(',', array_keys($fields));
            $values = implode(',:', array_keys($fields));

            $sql = 'INSERT INTO ' . $this->GetTableName() . '( '. $into .') VALUES (:'. $values .')';

            $statement = Database::connection()->prepare($sql);
            return $statement->execute($params);
        }

        public function EditRecord(array $params) : bool{

            $keys = array_keys($this->GetFields());
            $nameId = array_search('id',$this->GetFields());

            $count = count($keys);
            for($i = 0; $i < $count ; $i++){
                if (array_key_exists($keys[$i], $params))
                    $keys[$i] = $keys[$i] . ' = :' . $keys[$i];
                else unset($keys[$i]);
            }

            $str = implode(', ',$keys);
            $sql = 'UPDATE ' . $this->GetTableName() . ' SET ' . $str . ' WHERE ' . $nameId . ' = :id';

            $statement = Database::connection()->prepare($sql);
            return $statement->execute($params);
        }
    }