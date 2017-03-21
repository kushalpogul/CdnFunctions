<?php
namespace CdnFunctions\Controller\Component;

use Cake\Controller\Component;

class CdnComponent extends Component
{

    var $SFTP_HOST = 'host-name';
    var $SFTP_PORT = 'port_no';
    var $SFTP_USER = 'user';
    var $SFTP_PASS = 'password';

    /*
         Function Name : sendFile
         Desc : function used for Sending the file to CDN
    */

    function sendFile($src, $dst){

        if(!($con = ssh2_connect($this->SFTP_HOST, $this->SFTP_PORT))){
            echo "Not Able to Establish Connection\n";
        }
        else
        {
            if(!ssh2_auth_password($con, $this->SFTP_USER, $this->SFTP_PASS))
            {
                echo "fail: unable to authenticate\n";
            }
            else
            {
                $sftp = ssh2_sftp($con);
                if(!ssh2_scp_send($con, $src, $dst, 0644)) {
                    echo "error\n";
                } else {
                    echo "FILE Successfully sent\n";
                }
            }
        }
    } 

    /*
         Function Name : deleteFile
         Desc : function used for deleting the file from CDN
    */
    
    function deleteFile($file) { 

        if(!($con = ssh2_connect($this->SFTP_HOST, $this->SFTP_PORT))){
            echo "Not Able to Establish Connection\n";          
        } 
        else {
             
            if(!ssh2_auth_password($con, $this->SFTP_USER, $this->SFTP_PASS)) {
                echo "fail: unable to authenticate\n";              
            } 
            else {
                $sftp = ssh2_sftp($con);
                if(!ssh2_sftp_unlink($sftp, $file)) {                    
                    echo "error\n";
                } 
                else {
                    echo "FILE $file deleted Successfully \n";
                }
            }
        }
    } 


    /*
         Function Name : downloadAllFiles
         Desc : function used for Downloading all files from CDN
    */
    
    function downloadAllFiles($localDir, $remoteDir){ 

        if(!($con = ssh2_connect($this->SFTP_HOST, $this->SFTP_PORT))) {     
            echo "Not Able to Establish Connection\n";          
        } 
        else {
             
                if(!ssh2_auth_password($con, $this->SFTP_USER, $this->SFTP_PASS)) {
                    echo "fail: unable to authenticate\n";              
                } 
                else {
                        // Create our SFTP resource
                        if (!$sftp = ssh2_sftp($con)) throw new Exception('Unable to create SFTP connection.');


                        // download all the files
                        $files    = scandir('ssh2.sftp://' . $sftp . $remoteDir);

                        if (!empty($files)) {
                          foreach ($files as $file) {
                            if ($file != '.' && $file != '..') {
                              ssh2_scp_recv($con, "$remoteDir/$file", "$localDir/$file");
                            }
                          }
                          echo "<br>Files Copied Successfully \n";
                        }                                   
                }
            }
    }

    function testCall(){

            $src = 'D:\codebase\htdocs\new_cake\webroot\img\cake\test.png';
            $dst = '/published/freegalmusic/test/EN/artistimg/test.jpg';
            echo "<br>Executing code to send file to CDN...........<br>";
            phpinfo();
            $this->sendFile($src, $dst);            
            die;
        
    }   

}
