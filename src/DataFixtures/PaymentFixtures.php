<?php

namespace App\DataFixtures;

use App\Entity\Payment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PaymentFixtures extends Fixture
{
    const PAYMENTS = ['chèque', 'chèque vacances', 'virement', 'espèce'];
    const INSURANCE = ['loisir 1', 'loisir 2', 'loisir 3', 'loisir 4'];

    public function load(ObjectManager $manager)
    {
        foreach (self::PAYMENTS as $payment) {
            $typePayment = new Payment();
            $typePayment->setTypePayment($payment);
            $manager->persist($typePayment);
        }

        foreach (self::INSURANCE as $insurance) {
            $typeInsurance = new Payment();
            $typeInsurance->setInsurance($insurance);
            $manager->persist($typeInsurance);
        }
        $manager->flush();
    }
}
