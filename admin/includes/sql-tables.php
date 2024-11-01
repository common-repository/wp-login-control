<?php

// Prevent direct file access
	if( ! defined( 'ABSPATH' ) ) die();

// CREATE TABLE {$wpdb->prefix}
     $WPfs_sql = array("fs_ObjDesign (
                    Id_ObjectName varchar(255) COLLATE utf8_bin NOT NULL,
                    Id_Media varchar(255) COLLATE utf8_bin NOT NULL,
                    Id_Group varchar(255) COLLATE utf8_bin NOT NULL,
                    Html LONGTEXT COLLATE utf8_bin NOT NULL,
                    Css LONGTEXT COLLATE utf8_bin NOT NULL,
                    CssHover LONGTEXT COLLATE utf8_bin,
                    
                    PRIMARY KEY (Id_ObjectName)
                    )  DEFAULT CHARSET=utf8;
                    ",      
            
                    "fs_ObjMedia (
                    Id_Media varchar(255) COLLATE utf8_bin NOT NULL,
                    MediaWidth INT NOT NULL,
                    MediaHeight INT NOT NULL,
                    
                    PRIMARY KEY (Id_Media)
                    )  DEFAULT CHARSET=utf8;
                    ",

                    "fs_ObjGroup (
                    Id_Group varchar(255) COLLATE utf8_bin NOT NULL,

                    PRIMARY KEY (Id_Group)
                    )  DEFAULT CHARSET=utf8;     
            
                    ",         
         
                    "fs_forms (
                    Id_Form varchar(255) COLLATE utf8_bin NOT NULL,
                    State varchar(255) COLLATE utf8_bin NOT NULL,
                    Type varchar(255) COLLATE utf8_bin,
                    Html LONGTEXT COLLATE utf8_bin NOT NULL,
                    WithoutCss LONGTEXT COLLATE utf8_bin NOT NULL,
                    Css LONGTEXT COLLATE utf8_bin NOT NULL,
                    CssHover LONGTEXT COLLATE utf8_bin,
                    Options LONGTEXT COLLATE utf8_bin,
                    New LONGTEXT COLLATE utf8_bin,
                    Custom LONGTEXT COLLATE utf8_bin,
                    
                    PRIMARY KEY (Id_Form)
                    )  DEFAULT CHARSET=utf8;
                    ",      

                    "fs_cron (
                    Id_Form varchar(255) COLLATE utf8_bin NOT NULL,
                    Enabled TINYINT(1) DEFAULT 0 NOT NULL,
                    DateTimeFrom DATETIME NOT NULL,
                    DateTimeTo DATETIME NOT NULL,
                     
                    PRIMARY KEY (Id_Form)
                    )  DEFAULT CHARSET=utf8;
                    "

     );

?>