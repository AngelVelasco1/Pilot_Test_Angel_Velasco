<?php
namespace App\routes;
use App\db\connect;
use App\Singleton;
class routes extends connect
{
    private $queryPost = 'INSERT INTO routes(id, name_route, start_date, end_date, description, duration_month) VALUES (:identification, :route, :start, :end, :description, :duration_month);';
    private $queryGet = 'SELECT id AS "identification", SELECT name_route AS "route", SELECT start_date AS "start",  SELECT end_date AS "end",  SELECT description AS "description",  SELECT durarion_month AS "duration_month" FROM routes';
    private $queryUpdate = 'UPDATE routes SET name_route = :route, start_date = :start, end_date = :end, description = :description, durarion_month = :durarion_month WHERE id = :identification';
    private $queryDelete = 'DELETE FROM routes WHERE id = :identification';
    private $msg;

    use Singleton;

    //? Constructor */
    function __construct(private $id = 1, private $name_route= 1, private $start_date = 1, private $end_date = 1, private $description = 1, private $duration_month = 1)
    {
        parent::__construct();
    }

    //? POST Function */
    public function routesPost()
    {
        try {
            $sentence = $this->conx->prepare($this->queryPost);

            $sentence->bindValue("identification", $this->id);
            $sentence->bindValue("route", $this->name_route);
            $sentence->bindValue("start", $this->start_date);
            $sentence->bindValue("end", $this->end_date);
            $sentence->bindValue("description", $this->description);
            $sentence->bindValue("duration_month", $this->duration_month);

            $sentence->execute();

            $this->msg = ["Code" => 200 + $sentence->rowCount(), "Message" => "Inserted Data"];
        } catch (\PDOException $e) {
            $this->msg = ["Code" => $e->getCode(), "Message" => $sentence->errorInfo()[2]];
        } finally {
            print_r($this->msg);
        }
    }
    //? GET Function */
    public function routesGet()
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
    function routesUpdate()
    {
        try {
            $sentence = $this->conx->prepare($this->queryUpdate);

            $sentence->bindValue("identification", $this->id);
            $sentence->bindValue("route", $this->name_route);
            $sentence->bindValue("start", $this->start_date);
            $sentence->bindValue("end", $this->end_date);
            $sentence->bindValue("description", $this->description);
            $sentence->bindValue("duration_month", $this->duration_month);

            $sentence->execute();

            ($sentence->rowCount() > 0) ? $this->msg = ["Code" => 200, "Message" => "Updated Data"] : "none";
        } catch (\PDOException $e) {
            $this->msg = ["Code" => $e->getCode(), "Message" => $sentence->errorInfo()[2]];
        } finally {
            print_r($this->msg);
        }
    }
    //? DELETE Function */
    function routesDelete()
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