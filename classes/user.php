<?php
    
    class User
    {
        private $uid, $uname, $email, $pass, $phone_number, $profilePic, $groupsJoined, $setterMessage;
        
        public function __construct($a, $b, $c, $d, $e, $f)
        {
            $this->uid = $a;
            $this->uname = $b;
            $this->email = $c;
            $this->pass = $d;
            $this->phone_number = $e;
            $this->profilePic = $f;
            $this->resetSetterMessage();
        }
        
        public function getId()
        {
            return $this->uid;
        }
        
        public function getName()
        {
            return $this->uname;
        }
        
        public function setName($in)
        {
            if(strlen($in) > 0)
            {
                $this->resetSetterMessage();
                $userid = $this->uid;
                $db = new DB();
                $query0 = $db->runQuery("SELECT * FROM users WHERE uname = '$in'");
                if($query0->rowCount() === 0)
                {
                    $query0 = $db->runQuery("UPDATE users SET uname = '$in' WHERE id = '$userid'");
                    $this->uname = $in;
                    $this->setterMessage = "Successfully changed username";
                }
                else
                {
                    $this->setterMessage = "Username already exists";
                }
                unset($db);
            }
            else
            {
                $this->setterMessage = "Empty Fields";
            }
        }
        
        public function getEmail()
        {
            return $this->email;
        }
        
        public function setEmail($in)
        {
            $this->resetSetterMessage();
            $userid = $this->uid;
            $db = new DB();
            if(filter_var($in, FILTER_VALIDATE_EMAIL))
            {
                $query0 = $db->runQuery("SELECT * FROM users WHERE email = '$in'");
                
                if($query0->rowCount() === 0)
                {
                    $query0 = $db->runQuery("UPDATE users SET email = '$in' WHERE id = '$userid'");
                    $this->email = $in;
                    $this->setterMessage = "Successfully changed email";
                }
                else
                {
                    $this->setterMessage = "Email already exists";
                }
            }
            else
            {
                $this->setterMessage = "Invalid Email";
            }
            unset($db);
        }
        
        public function getPass()
        {
            return $this->pass;
        }
        
        public function setPass($in)
        {
            if(strlen($in) > 0)
            {
                $this->resetSetterMessage();
                $userid = $this->uid;
                $db = new DB();
                $query0 = $db->runQuery("SELECT * FROM users WHERE password = '$in'");
                if($query0->rowCount() === 0)
                {
                    $query0 = $db->runQuery("UPDATE users SET password = '$in' WHERE id = '$userid'");
                    $this->pass = $in;
                    $this->setterMessage = "Successfully changed password";
                }
                else
                {
                    $this->setterMessage = "Password already exists";
                }
                unset($db);
            }
            else
            {
                $this->setterMessage = "Empty Fields";
            }
        }
        
        public function getPhoneNum()
        {
            return $this->phone_number;
        }
        
        public function setPhoneNum($in)
        {
            $this->resetSetterMessage();
            $userid = $this->uid;
            $db = new DB();
            $query0 = $db->runQuery("UPDATE users SET phone_number = '$in' WHERE id = '$userid'"); //I currently don't care if they enter the same phone number as anyone else; will probably change later
            $this->setterMessage = "Successfully changed phone number";
            $this->phone_number = $in;
            unset($db);
        }
        
        public function unjoin($in) //in, in this function, is the group id
        {
            $uid = $this->uid;
            $groupId = $in;
            $db = new DB();
            $db->runQuery("DELETE FROM user_group_bridge WHERE group_id = '$groupId' AND user_id = '$uid'");
            $db->runQuery("UPDATE groups SET num_members = num_members - 1 WHERE id = '$groupId'");
            unset($db);
        }
        
        public function getProfilePic()
        {
            return $this->profilePic;
        }
        
        public function setProfilePic($in)
        {
            $db = new DB();
            $userid = $this->uid;
            $fileName = $in['name'];
            $fileType = $in['type'];
            $fileSize = $in['size'];
            $temp_location = $in['tmp_name'];
            $error = $in['error'];
            $explodedFileName = explode(".", $fileName);
            $extension = strtolower(end($explodedFileName));
            
            $acceptedFileTypes = array("png", "jpg", "jpeg", "gif");
            
            
            if($error == 0)
            {
                if(in_array($extension, $acceptedFileTypes))
                {
                    if($fileSize <= 1000000)
                    {
                        $fileName = $userid . "_" . sha1($fileName);
                        $newLocation = "../profilePics/" . $fileName . "." . $extension;
                        
                        if(file_exists($newLocation))
                        {
                            echo "You already have custom username";
                        }
                        
                        move_uploaded_file($temp_location, $newLocation);
                        
                        $query0 = $db->runQuery("UPDATE users SET profile_pic = '$newLocation' WHERE id = '$userid'");
                        $this->profilePic = $newLocation;
                        $this->setterMessage = "Successfully Changed Profile Picture";
                    }
                    else
                    {
                        $this->setterMessage = "File too large";
                    }
                }
                else
                {
                    $this->setterMessage = "Extension not accepted (only png, jpg, and gif). Your extension is: " . $extension;
                }
            }
            else
            {
                $this->setterMessage = "Error occurred while uploading the file";
            }
            unset($db);
        }
        
        public function getSetterMessage()
        {
            return $this->setterMessage;
        }
        
        public function getGroupsJoined() //this should return json_encode of an associative array of groups joined
        {
            $db = new DB();
            $userid = $this->uid;
            $query0 = $db->runQuery("SELECT * FROM user_group_bridge WHERE user_id = '$userid'");
            $userGroupData = Array();
            while($rows = $query0->fetch(PDO::FETCH_ASSOC))
            {
                $userGroupData[] = $rows;
            }
            unset($db);
            return json_encode($userGroupData);
        }
        
        private function resetSetterMessage()
        {
            $this->setterMessage = "";
        }
    }