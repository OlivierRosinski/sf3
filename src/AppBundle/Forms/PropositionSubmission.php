<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace AppBundle\Forms;

use Symfony\Component\Validator\Constraints as Assert;

class PropositionSubmission
{
    /** @Assert\NotBlank */
    public $price;

    /** @Assert\NotBlank */
    public $comment;

}
