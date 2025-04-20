<link rel="stylesheet" href="public/style.css">
<?php
session_start();


if (isset($_SESSION['msg_success'])) {
    echo '<div class="alert alert-success error-messages">'.$_SESSION['msg_success'].'</div>';
    unset($_SESSION['msg_success']);
}
if (isset($_SESSION['msg_error'])) {
    echo '<div class="alert alert-danger error-messages">'.$_SESSION['msg_error'].'</div>';
    unset($_SESSION['msg_error']);
}

class TiennVo
{
    private $servername = "localhost"; 
    private $username = "root";
    private $password = ""; 
    private $dbname = "giuakiphp"; 
    private $ketnoi;

    function connect()
    {
        if (!$this->ketnoi)
        {
            $this->ketnoi = mysqli_connect('localhost', 'root', '', 'giuakiphp') or die ('tiennvo dz !');
            mysqli_query($this->ketnoi, "set names 'utf8'");
        }
    }

    function check_username($data)
    {
        if (preg_match('/^[a-zA-Z0-9_-]{3,16}$/', $data, $matches))
        {
            return True;
        }
        else
        {
            return False;
        }
    }

    function check_email($data)
    {
        if (preg_match('/^.+@.+$/', $data, $matches))
        {
            return True;
        }
        else
        {
            return False;
        }
    }

    function insert($table, $data)
    {
        $this->connect();
        $field_list = '';
        $value_list = '';
        foreach ($data as $key => $value)
        {
            $field_list .= ",$key";
            $value_list .= ",'".mysqli_real_escape_string($this->ketnoi, $value)."'";
        }
        $sql = 'INSERT INTO '.$table. '('.trim($field_list, ',').') VALUES ('.trim($value_list, ',').')';
 
        return mysqli_query($this->ketnoi, $sql);
    }
    function update($table, $data, $where)
    {
        $this->connect();
        $sql = '';
        foreach ($data as $key => $value)
        {
            $sql .= "$key = '".mysqli_real_escape_string($this->ketnoi, $value)."',";
        }
        $sql = 'UPDATE '.$table. ' SET '.trim($sql, ',').' WHERE '.$where;
        return mysqli_query($this->ketnoi, $sql);
    }

    function BASE_URL($url)
    {
        return $url;
    }
    // function msg_success2($text)
    // {
    //     return die('<div class="alert alert-success alert-dismissible error-messages">
    //     <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>'.$text.'</div>');
    // }
    // function msg_success($text, $url, $time)
    // {
    //     return die('<div class="alert alert-success alert-dismissible error-messages">
    //     <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>'.$text.'</div><script type="text/javascript">setTimeout(function(){ location.href = "'.$url.'" },'.$time.');</script>');
    // }
    // function msg_error2($text)
    // {
    //     return die('<div class="alert alert-danger alert-dismissible error-messages">
    //     <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>'.$text.'</div>');
    // }

    function getUser($username)
    {
        $this->connect();
        $row = $this->ketnoi->query("SELECT * FROM `users` WHERE `username` = '$username' ")->fetch_array();
        return $row;
    }

    function get_row($sql)
    {
        $this->connect();
        $result = mysqli_query($this->ketnoi, $sql);
        if (!$result)
        {
            die ('Câu truy vấn bị sai');
        }
        $row = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        if ($row)
        {
            return $row;
        }
        return false;
    }
}
?>