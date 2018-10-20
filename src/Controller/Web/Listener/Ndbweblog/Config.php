<?php
namespace App\Controller\Web\Listener\Ndbweblog;

use App\Controller\Web\Listener\Base;
use App\Repository\ListenerRepository;
use Symfony\Component\Routing\Annotation\Route;  // Required for annotations

/**
 * Class Listeners
 * @package App\Controller\Web\Listener\Ndbweblog
 */
class Config extends Base
{
    /**
     * @Route(
     *     "/{system}/listener/{id}/ndbweblog/config.js",
     *     requirements={
     *        "system": "reu|rna|rww"
     *     },
     *     defaults={"id"=""},
     *     name="listener_ndbweblog_config"
     * )
     */
    public function configController(
        $system,
        $id,
        ListenerRepository $listenerRepository
    ) {
        if (!$listener = $this->getValidListener($id, $listenerRepository)) {
            return $this->redirectToRoute('listeners', ['system' => $system]);
        }
        $parameters = [
            'title' => 'NDB Weblog config for ' . $listener->getName(),
            'system' => $system,
            'listener' => $listener
        ];
        $parameters = array_merge($parameters, $this->parameters);
        $response = $this->render('listener/ndbweblog/config.js.twig', $parameters);
        $response->headers->set('Content-Type', 'application/javascript');
        $response->headers->set('Content-Disposition','attachment;filename=config.js');
        return $response;
    }
}
