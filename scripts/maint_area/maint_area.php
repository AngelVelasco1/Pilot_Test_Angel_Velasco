<?php
namespace App;

class maint_area extends connect
{
    private $queryPost = 'INSERT INTO maint_area(id, id_area, id_staff, id_position, id_journey) VALUES (:identification, :areaId, :staffId, :positionId, journeyId)';
    private $queryGet = 'SELECT id AS "identification", SELECT id_area AS "areaId", SELECT id_staff AS "staffId", SELECT id_position AS "positionId", SELECT id_journey AS "journerysId FROM maint_area
        INNER JOIN areas on maint_area.id_area = areas.id,
        INNER JOIN staff on maint_area.id_staff = staff.id,
        INNER JOIN position on maint_area.id_position = position.id
    ';
    private $queryUpdate = 'UPDATE maint_area SET id_area = :areaId, id_staff = :staffId, id_position = :positionId, id_journey = :journeyId WHERE id = :identification';
    private $queryDelete = 'DELETE FROM maint_area WHERE id = :identification';
    private $msg;
    use Singleton;

    //? Constructor */
    function __construct(private $id = 1, private $id_area = 1, private $id_staff = 1, private $id_position, private $id_journey = 1)
    {
        parent::__construct();
    }

    //? POST Function */
    public function maintAreaPost()
    {
        try {
            $sentence = $this->conx->prepare($this->queryPost);

            $sentence->bindValue("identification", $this->id);
            $sentence->bindValue("areaId", $this->id_area);
            $sentence->bindValue("staffId", $this->id_staff);
            $sentence->bindValue("positionId", $this->id_position);
            $sentence->bindValue("journeyId", $this->id_journey);

            $sentence->execute();

            $this->msg = ["Code" => 200 + $sentence->rowCount(), "Message" => "Inserted Data"];
        } catch (\PDOException $e) {
            $this->msg = ["Code" => $e->getCode(), "Message" => $sentence->errorInfo()[2]];
        } finally {
            print_r($this->msg);
        }
    }
    //? GET Function */
    public function maintAreaGet()
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
    function maintAreaUpdate()
    {
        try {
            $sentence = $this->conx->prepare($this->queryUpdate);

            $sentence->bindValue("identification", $this->id);
            $sentence->bindValue("areaId", $this->id_area);
            $sentence->bindValue("staffId", $this->id_staff);
            $sentence->bindValue("positionId", $this->id_position);
            $sentence->bindValue("journeyId", $this->id_journey);
            $sentence->execute();

            ($sentence->rowCount() > 0) ? $this->msg = ["Code" => 200, "Message" => "Updated Data"] : "none";
        } catch (\PDOException $e) {
            $this->msg = ["Code" => $e->getCode(), "Message" => $sentence->errorInfo()[2]];
        } finally {
            print_r($this->msg);
        }
    }
    //? DELETE Function */
    function maintAreaDelete()
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