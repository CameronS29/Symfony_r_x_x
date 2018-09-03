<?php
namespace App\Controller\Web;

use App\Form\ListenerSignals as ListenerSignalsForm;
use App\Repository\ListenerRepository;
use App\Repository\TypeRepository;
use Symfony\Component\Routing\Annotation\Route;  // Required for annotations
use Symfony\Component\HttpFoundation\Request;

/**
 * Class Listeners
 * @package App\Controller\Web
 */
class ListenerSignals extends Base
{

    /**
     * @Route(
     *     "/{system}/listeners/{id}/signals",
     *     requirements={
     *        "system": "reu|rna|rww"
     *     },
     *     name="listener_signals"
     * )
     */
    public function listenerSignalsController(
        $system,
        $id,
        Request $request,
        ListenerSignalsForm $form,
        ListenerRepository $listenerRepository,
        TypeRepository $typeRepository
    ) {
        if ((int) $id) {
            $listener = $listenerRepository->find((int)$id);
            if (!$listener) {
                return $this->redirectToRoute('listeners', ['system' => $system]);
            }
        }
        $options = [];
        $form = $form->buildForm($this->createFormBuilder(), $options);
        $form->handleRequest($request);
        $args = [
            'sort' =>       'khz',
            'order' =>      'a'
        ];
        if ($form->isSubmitted() && $form->isValid()) {
            $args = $form->getData();
        }

        $parameters = [
            'args' =>               $args,
            'id' =>                 $id,
            'columns' =>            $listenerRepository->getSignalsColumns(),
            'form' =>               $form->createView(),
            'menuOptions' =>        $listenerRepository->getMenuOptions($listener),
            'mode' =>               $listener->getName().' &gt; Signals Received',
            'signals' =>            $listenerRepository->getSignalsForListener($id, $args),
            'signalPopup' =>        'width=590,height=640,status=1,scrollbars=1,resizable=1',
            'system' =>             $system,
            'typeRepository' =>     $typeRepository
        ];
        $parameters = array_merge($parameters, $this->parameters);
        return $this->render('listener/signals.html.twig', $parameters);
    }
}
