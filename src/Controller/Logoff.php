<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;  // Required for annotations

/**
 * Class ListenerList
 * @package App\Controller
 */
class Logoff extends BaseController {

    /**
     * @Route(
     *     "/{system}/logoff",
     *     requirements={
     *        "system": "reu|rna|rww"
     *     },
     *     name="logoff"
     * )
     */
    public function logoffController($system)
    {
        $this->session->set('isAdmin', 0);
        return $this->redirectToRoute('logon', ['system' => $system]);
    }

}