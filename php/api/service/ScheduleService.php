 <?php

class ScheduleService {
    private $connection;
    public function __construct($db)
    {
        $this->connection = $db;
    }

    function findAll()
    {
        $query="SELECT * FROM tb_od_programschedule";
        $response=array();
        $result=mysqli_query( $this->connection, $query);
        if($result){ 
            while($row=mysqli_fetch_array($result))
            {
                $response[]=$row;
            }
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }


    function find($reqData)
    {
        $query="SELECT * FROM tb_od_programschedule  WHERE  ";
        $response=array();
        if(array_key_exists('programid', $reqData) )
        {
            $query.="programid=".$reqData['programid'];
        }else{
            $query.="programid like '%%'";
        }
        if(array_key_exists('venuId', $reqData))
        {
            $query.="dhyankendraid=".$reqData['venuId'];
        }
        $result=mysqli_query($this->connection, $query);
        if($result){            
            while($row=mysqli_fetch_array($result))
            {
                $response[]=$row;
            }
        }else{
            
            $response =[];
        }
        /*header('Content-Type: application/json');
        echo json_encode($response);*/
        return $response;
    }
    
}