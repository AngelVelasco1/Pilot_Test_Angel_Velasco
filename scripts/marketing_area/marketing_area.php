<?php
namespace App;
use App\connect;
use App\Singleton;
class marketing_area extends connect
{
    private $msg;
    private $table = 'marketing_area';
    private $columns = [
        'id' => 'identification',
        'id_area' => 'areaId',
        'id_staff' => 'staffId',
        'id_position' => 'positionId',
        'id_journey' => 'journeyId'
    ];

    use Singleton;
    //? Constructor */
    function __construct()
    {
        parent::__construct();
    }

    //? POST Function */
    public function marketingAreaPost()
    {
        try {
            $data = $this->extractData();

            $query = $this->insertQuery($data);
            $sentence = $this->conx->prepare($query);
            $sentence->execute($data);

            $this->msg = json_encode(["Code" => 200 + $sentence->rowCount(), "Message" => "Inserted Data"]);
        } catch (\PDOException $e) {
            $this->msg = json_encode(["Code" => $e->getCode(), "Message" => $sentence->errorInfo()[2]]);
        } finally {
            print_r($this->msg);
        }
    }
    //? GET Function */
    public function marketingAreaGet()
    {
        try {
            $query = "SELECT * FROM $this->table 
                INNER JOIN areas ON $this->table.id_area = areas.id
                INNER JOIN staff ON $this->table.id_staff = staff.id
                INNER JOIN position ON $this->table.id_position = position.id
                ";
    
            $sentence = $this->conx->prepare($query);
            $sentence->execute();
    
            $result = $sentence->fetchAll(\PDO::FETCH_ASSOC);
            $this->msg = json_encode(["Code" => 200, "Message" => $result]);
        } catch (\PDOException $e) {
            $this->msg = json_encode(["Code" => $e->getCode(), "Message" => $e->getMessage()]);
        } finally {
            echo $this->msg;
        }
    }
    

    //? UPDATE Function */
    function marketingAreaUpdate()
    {
        try {
            $data = $this->extractData();
            $data["identification"] = $this->id;
            $query = $this->updateQuery($data);

            $sentence = $this->conx->prepare($query);
            $sentence->execute($data);

            ($sentence->rowCount() > 0) ? $this->msg = json_encode(["Code" => 200, "Message" => "Updated Data"]) : "none";
        } catch (\PDOException $e) {
            $this->msg = json_encode(["Code" => $e->getCode(), "Message" => $sentence->errorInfo()[2]]);
        } finally {
            print_r($this->msg);
        }
    }
    //? DELETE Function */
    function marketingAreaDelete()
    {
        try {
            $query = "DELETE FROM $this->table WHERE id = :identification";
            $sentence = $this->conx->prepare($query);
            $sentence->bindValue(["identification" => $this->id]);
            $sentence->execute();

            $this->msg = json_encode(["Code" => 200, "Message" => "Deleted Data"]);
        } catch (\PDOException $e) {
            $this->msg = json_encode(["Code" => $e->getCode(), "Message" => $sentence->errorInfo()[2]]);
        } finally {
            print_r($this->msg);
        }
    }

    private function extractData()
    {
        $data = [];
        foreach ($this->columns as $param => $column) {
            $data[$column] = $this->$param;
        }
        return $data;
    }

    private function insertQuery($data)
    {
        $columns = implode(', ', array_keys($data));
        $params = ':' . implode(', :', array_keys($data));
        return "INSERT INTO $this->table ($columns) VALUES ($params)";
    }
    private function updateQuery($data)
    {
        $statements = [];
        foreach ($data as $column => $param) {
            $statements[] = "$column = :$param";
        }
        $statements = implode(', ', $statements);
        return "UPDATE $this->table SET $statements WHERE id = :identification";
    }
}



?>