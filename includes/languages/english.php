<?php

function lang($phrase)
{
    static $lang = array(

        //Index Page Words
        'ADMINLOGIN'    => 'Admin Login',


        //NavBar Phrases
        "HOME"          => "Home",
        "CATEGORIES"    => "Categories",
        'ITEMS'         => 'Items',
        'MEMBERS'       => 'Members',
        'STATISTICS'    => 'Statistics',
        'LOGS'          => 'Logs',
        "EDITPROFILE"   => "Edit Profile",
        'SETTINGS'      => 'Settings',
        'LOGOUT'        => 'Logout',
        'LOGIN'         => 'Login',
        'DASHBOARD'     => 'Dashboard',
        'DEFAULT'       => 'Default',
        'EDITMEMBER'    => 'Edit Member',
        'COMMENTS'      => 'Comments',

    );
    return $lang[$phrase];
}
