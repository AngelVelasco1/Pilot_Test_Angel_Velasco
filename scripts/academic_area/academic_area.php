<?php
namespace App;

class academic_area extends connect
{
    private $queryPost = 'INSERT INTO academic_area(id, id_area, id_staff, id_position, id_journeys) VALUES (:identification, :areaId, :staffId, :positionId, journeysId)';
    private $queryGet = 'SELECT id AS "identification", SELECT id_area AS "areaId", SELECT id_staff AS "staffId", SELECT id_position AS "positionId", SELECT id_journeys AS "journerysId FROM academic_area';
    private $queryUpdate = 'UPDATE academic_area SET id_area = :areaId, id_staff = :staffId, id_position = :positionId, id_journeys = :journeysId WHERE id = :identification';
    private $queryDelete = 'DELETE FROM academic_area WHERE id = :identification';
    private $msg;
    use Singleton;

    //? Constructor */
    function __construct(private $id = 1, private $id_area = 1, private $id_staff = 1, private $id_position, private $id_journeys = 1)
    {
        parent::__construct();
    }

    //? POST Function */
    public function academicAreaPost()
    {
        try {
            $sentence = $this->conx->prepare($this->queryPost);

            $sentence->bindValue("identification", $this->id);
            $sentence->bindValue("areaId", $this->id_area);
            $sentence->bindValue("staffId", $this->id_staff);
            $sentence->bindValue("positionId", $this->id_position);
            $sentence->bindValue("journeysId", $this->id_journeys);

            $sentence->execute();

            $this->msg = ["Code" => 200 + $sentence->rowCount(), "Message" => "Inserted Data"];
        } catch (\PDOException $e) {
            $this->msg = ["Code" => $e->getCode(), "Message" => $sentence->errorInfo()[2]];
        } finally {
            print_r($this->msg);
        }
    }
    //? GET Function */
    public function academicAreaGet()
    {
        try {
            $sentence = $this->conx->prepare($this->queryGet);
            $sentence->execute();

            $this->msg = ["Code" => 200, "Message" => $sentence->fetchAll(\PDO::FETCH_ASSOC)];

        } catch (\PDOException $e) {
            $this->msg = ["Code" => $e->getCode(), "Message" => $sentence->errorInfo()[2]];
        } finally {
            print_r($this->msg);
        }
    }

    //? UPDATE Function */
    function academicAreaUpdate()
    {
        try {
            $sentence = $this->conx->prepare($this->queryUpdate);

            $sentence->bindValue("identification", $this->id);
            $sentence->bindValue("areaId", $this->id_area);
            $sentence->bindValue("staffId", $this->id_staff);
            $sentence->bindValue("positionId", $this->id_position);
            $sentence->bindValue("journeysId", $this->id_journeys);
            $sentence->execute();

            ($sentence->rowCount() > 0) ? $this->msg = ["Code" => 200, "Message" => "Updated Data"] : "none";
        } catch (\PDOException $e) {
            $this->msg = ["Code" => $e->getCode(), "Message" => $sentence->errorInfo()[2]];
        } finally {
            print_r($this->msg);
        }
    }
    //? DELETE Function */
    function academicAreaDelete()
    {
        try {
            $sentence = $this->conx->prepare($this->queryDelete);
            $sentence->bindValue("identification", $this->id);
            $sentence->execute();

            $this->msg = ["Code" => 200, "Message" => "Deleted Data"];
        } catch (\PDOException $e) {
            $this->msg = ["Code" => $e->getCode(), "Message" => $sentence->errorInfo()[2]];
        } finally {
            print_r($this->msg);
        }
    }



}
?>