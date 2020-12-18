<?php 

class Database 
{
    private $host = 'localhost'; //*90% of the time can keep but some webhostings may need to be different
    private $db_name = 'db_movies';
    private $username = 'root';
    private $pasword = '';

    public $conn;

    public function getConnection() 
    {
        $this->conn = null;

        $db_dsn = array(
            'host'=>$this->host,
            'dbname'=>$this->db_name,
            'charset'=>'utf8'
        );

        //* only docker
        if(getenv('IDP_ENVIRONMENT')==='docker') {
            $db_dsn['host'] = 'mysql';
            $this->username = 'docker_u';
            $this->password = 'docker_p';
        }

        try{//*put the code in that might have errors
            $dsn = 'mysql:'.http_build_query($db_dsn, '', ';');
            $this->conn = new PDO($dsn, $this->username, $this->password);
        } catch(PDOException $exception) {//* Tell php what you want to do with those errors
            echo json_encode(
                array(
                    'error'=>'Database connection failed ',
                    'message'=>$exception->getMessage()
                )
            );
            exit;
        }
        return $this->conn;
    }
}