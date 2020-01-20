<?php

namespace App\DataFixtures;

use App\Entity\Payment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PaymentFixtures extends Fixture
{
    const PAYMENTS = ['Chèque', 'Chèque vacances', 'Virement', 'Espèces'];

    public function load(ObjectManager $manager)
    {
        foreach (self::PAYMENTS as $payment) {
            $typePayment = new Payment();
            $typePayment->setTypePayment($payment);
            $manager->persist($typePayment);
        }

        $manager->flush();
    }
}
