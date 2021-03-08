<?php
namespace Awin\Tools\CoffeeBreak\Services;

use Awin\Tools\CoffeeBreak\Entity\StaffMember;
use Awin\Tools\CoffeeBreak\Entity\CoffeeBreakPreference;
use PHPUnit\Framework\MockObject\RuntimeException;

class EmailNotifier
{
    /**
     * @param StaffMember $staffMember
     * @param CoffeeBreakPreference $preference
     * @return bool
     */
    public function emailStaffMember(StaffMember $staffMember, CoffeeBreakPreference $preference)
    {
        /**
         * Sends the user a notification by email of their coffee break preference.
         * returns true or false status of notification sent
         */

        if (empty($staffMember->getEmail())) {
            throw new RuntimeException("Cannot send notification email - no email");
        }


        $message = "Dear, 
                Your coffee break today is at 11AM and you would like to have some bacon today.";


        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <notifications@awin.com>' . "\r\n";

        if(mail($staffMember->getEmail(),"Notification : Coffee Break",$message, $headers)){
            return true;
        }
        else{
            return false;
        }
    }
}