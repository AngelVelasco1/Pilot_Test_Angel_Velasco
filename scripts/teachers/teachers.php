<?php
namespace App\teachers;
use App\db\connect;
use App\Singleton;
class teachers extends connect
{
    private $queryPost = 'INSERT INTO teachers(id, id_staff, id_route, id_academic_area, id_position, id_team_educator) VALUES (:identification, :id_staff, :id_route, :id_academic_area, :id_position, :id_team_educator)';
    private $queryGet = 'SELECT id AS "identification", SELECT id_staff AS "id_staff", SELECT id_route AS "id_route", SELECT id_academic_area AS "id_academic_area", SELECT id_position AS "id_position", SELECT id_team_educator AS "id_team_educator" FROM teachers';
    private $queryUpdate = 'UPDATE teachers SET id_staff = :id_staff, id_route AS :id_route, id_academic_area AS :id_academic_area, id_position AS :id_position, id_team_educator AS :id_team_educator WHERE id = :identification';
    private $queryDelete = 'DELETE FROM teachers WHERE id = :identification';
    private $msg;

    use Singleton;

    //? Constructor */
    function __construct(private $id = 1, private $id_staff= 1,  private $id_route= 1, private $id_academic_area= 1, private $id_position= 1, private $id_team_educator= 1)
    {
        parent::__construct();
    }

    //? POST Function */
    public function teachersPost()
    {
        try {
            $sentence = $this->conx->prepare($this->queryPost);

            $sentence->bindValue("identification", $this->id);
            $sentence->bindValue("id_staff", $this->id_staff);
            $sentence->bindValue("id_route", $this->id_route);
            $sentence->bindValue("id_academic_area", $this->id_academic_area);
            $sentence->bindValue("id_position", $this->id_position);
            $sentence->bindValue("id_team_educator", $this->id_team_educator);

            $sentence->execute();

            $this->msg = ["Code" => 200 + $sentence->rowCount(), "Message" => "Inserted Data"];
        } catch (\PDOException $e) {
            $this->msg = ["Code" => $e->getCode(), "Message" => $sentence->errorInfo()[2]];
        } finally {
            print_r($this->msg);
        }
    }
    //? GET Function */
    public function teachersGet()
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
    function teachersUpdate()
    {
        try {
            $sentence = $this->conx->prepare($this->queryUpdate);

           
            $sentence->bindValue("identification", $this->id);
            $sentence->bindValue("id_staff", $this->id_staff);
            $sentence->bindValue("id_route", $this->id_route);
            $sentence->bindValue("id_academic_area", $this->id_academic_area);
            $sentence->bindValue("id_position", $this->id_position);
            $sentence->bindValue("id_team_educator", $this->id_team_educator);
            $sentence->execute();

            ($sentence->rowCount() > 0) ? $this->msg = ["Code" => 200, "Message" => "Updated Data"] : "none";
        } catch (\PDOException $e) {
            $this->msg = ["Code" => $e->getCode(), "Message" => $sentence->errorInfo()[2]];
        } finally {
            print_r($this->msg);
        }
    }
    //? DELETE Function */
    function teachersDelete()
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