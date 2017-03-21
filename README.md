# CdnFunctions plugin

[![Build Status](https://api.travis-ci.org/cakephp/app.png)](https://travis-ci.org/cakephp/app)
[![License](https://poser.pugx.org/cakephp/app/license.svg)](https://packagist.org/packages/cakephp/app)

## About plugin

CdnFunctions plugin contains 3 important functions which allows a file to copy on CDN, Delete a file from CDN & Downloading all files from directory of CDN.


## Requirements

1) CakePHP 3
2) PHP 5.4
3) SSH2
4) CDN Server


## Including Plugin

　　In bootstrap.php file of application, add below line to include plugin into application
Plugin::load('CdnFunctions', ['autoload' => true]);

　　In Controller file, add below line in initialize() function to load plugin in controller.
$this->loadComponent('CdnFunctions.Cdn' );	


　　In Component file of plugin, specify details of CDN.

　　File: \plugins\CdnFunctions\src\Controller\Component\CdnComponent.php

	var $SFTP_HOST = ‘host-name';
	var $SFTP_PORT = ‘port_no’;
	var $SFTP_USER = ‘user-name’;
	var $SFTP_PASS = 'password';


## Functions in Plugin

1) sendFile($src, $dst) : 
　　This function sends file to CDN server.

　　Usage:
　　In controller file of your application,
       $src = 'file_name.jpg';  // file that is to be copied to CDN
       $dst = '/path/on/cdn/file_name.jpg';	// path on CDN where file is to be copied
       $this->Cdn->sendFile($src, $dst);  

2) deleteFile($file): 
　　This Function delete file from CDN Server.

　　Usage:
　　In controller file of your application,
       $this->Cdn->deleteFile('/path/on/cdn/file_name.jpg');	

3) downloadAllFiles($localDir, $remoteDir): 
　　This function downloads all files present in directory of CDN.

　　Usage:
　　In controller file of your application,
       $localDir  = '/path/on/local/'; // path on local where all files are to be copied
　　	   $remoteDir = '/path/on/cdn/';  // path on cdn from where we dowload all files
       $this->Cdn->downloadAllFiles($localDir, $remoteDir);
