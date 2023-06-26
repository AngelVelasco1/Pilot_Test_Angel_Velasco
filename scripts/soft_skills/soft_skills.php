<?php
namespace App\soft_skills;
use App\db\connect;
use App\Singleton;
class soft_skills extends connect
{
    private $queryPost = 'INSERT INTO soft_skills(id, id_team_schedule, id_psychologist, id_location, id_subject, id_journey) VALUES (:identification, :id_team_schedule, :id_psychologist, :id_location, :id_subject, :id_journey)';
    private $queryGet = 'SELECT id AS "identification", SELECT id_team_schedule AS "id_team_schedule", SELECT id_psychologist AS "id_psychologist", SELECT id_location AS "id_location", SELECT id_subject AS "id_subject", SELECT id_journey AS "id_journey" FROM soft_skills';
    private $queryUpdate = 'UPDATE soft_skills SET id_team_schedule = :id_team_schedule =, id_psychologist = :id_psychologist =, id_location = :id_location, id_subject = :id_subject, id_journey = :id_journey WHERE id = :identification';
    private $queryDelete = 'DELETE FROM soft_skills WHERE id = :identification';
    private $msg;

    use Singleton;

    //? Constructor */
    function __construct(private $id = 1, private $id_team_schedule= 1, public $id_psychologist = 1, private $id_location = 1, private $id_subject = 1, private $id_journey = 1)
    {
        parent::__construct();
    }

    //? POST Function */
    public function softSkillsPost()
    {
        try {
            $sentence = $this->conx->prepare($this->queryPost);

            $sentence->bindValue("identification", $this->id);
            $sentence->bindValue("id_team_schedule", $this->id_team_schedule);
            $sentence->bindValue("id_psychologist", $this->id_psychologist);
            $sentence->bindValue("id_location", $this->id_location);
            $sentence->bindValue("id_subject", $this->id_subject);
            $sentence->bindValue("id_journey", $this->id_journey);

            $sentence->execute();

            $this->msg = ["Code" => 200 + $sentence->rowCount(), "Message" => "Inserted Data"];
        } catch (\PDOException $e) {
            $this->msg = ["Code" => $e->getCode(), "Message" => $sentence->errorInfo()[2]];
        } finally {
            print_r($this->msg);
        }
    }
    //? GET Function */
    public function softSkillsGet()
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
    function softSkillsUpdate()
    {
        try {
            $sentence = $this->conx->prepare($this->queryUpdate);

           
            $sentence->bindValue("identification", $this->id);
            $sentence->bindValue("id_team_schedule", $this->id_team_schedule);
            $sentence->bindValue("id_psychologist", $this->id_psychologist);
            $sentence->bindValue("id_location", $this->id_location);
            $sentence->bindValue("id_subject", $this->id_subject);
            $sentence->bindValue("id_journey", $this->id_journey);

            $sentence->execute();

            ($sentence->rowCount() > 0) ? $this->msg = ["Code" => 200, "Message" => "Updated Data"] : "none";
        } catch (\PDOException $e) {
            $this->msg = ["Code" => $e->getCode(), "Message" => $sentence->errorInfo()[2]];
        } finally {
            print_r($this->msg);
        }
    }
    //? DELETE Function */
    function softSkillsDelete()
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