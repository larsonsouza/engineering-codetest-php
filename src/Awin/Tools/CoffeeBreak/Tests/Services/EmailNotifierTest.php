<?php

use Awin\Tools\CoffeeBreak\Entity\CoffeeBreakPreference;
use Awin\Tools\CoffeeBreak\Entity\StaffMember;
use PHPUnit\Framework\TestCase;

class EmailNotifierTest extends TestCase
{
    public function testStatusOfNotificationIsTrue()
    {
        $staff = new StaffMember();
        $staff->setEmail("angus.desouza@gmail.com");
        $preference = new CoffeeBreakPreference("drink", "coffee", $staff);

        $notificationService = new \Awin\Tools\CoffeeBreak\Services\SlackNotifier();
        $status = $notificationService->notifyStaffMember($staff, $preference);
        $this->assertTrue($status);
    }

    public function testThrowsExceptionWhenCannotNotify()
    {
        $staff = new StaffMember();
        $preference = new CoffeeBreakPreference("drink", "tea", $staff);
//        $notificationService = new \Awin\Tools\CoffeeBreak\Services\SlackNotifier();
        $notificationService = new \Awin\Tools\CoffeeBreak\Services\EmailNotifier();

        $this->expectException(\RuntimeException::class);
        $status = $notificationService->emailStaffMember($staff, $preference);
    }
}
