<?php
namespace App\Controller;

use App\Form\ListenerList as ListenerListForm;
use App\Utils\Rxx;
use App\Repository\ListenerRepository;
use Symfony\Component\Routing\Annotation\Route;  // Required for annotations
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ListenerList
 * @package App\Controller
 */
class ListenerList extends Controller {

    /**
     * @Route(
     *     "/{system}/listener_list",
     *     requirements={
     *        "system": "reu|rna|rww"
     *     },
     *     name="listener_list"
     * )
     */
    public function listenerListController(
        $system, Request $request, ListenerListForm $form, ListenerRepository $listenerRepository
    ) {
        $options = [
            'system' =>     $system
        ];
        $form = $form->buildForm($this->createFormBuilder(), $options);
        $form->handleRequest($request);
        $args = [
            'filter' =>     '',
            'types' =>      [],
            'country' =>    '',
            'region' =>     '',
            'sort' =>       'name',
            'order' =>      'a'
        ];
        if ($form->isSubmitted() && $form->isValid()) {
            $args = $form->getData();
//            print Rxx::y($args);
        }
        $total = $listenerRepository->getTotalListeners($system);
        $showingAll = (
            empty($args['filter']) &&
            empty($args['country']) &&
            empty($args['region'])
        );
        if (empty($args['types'])) {
            $args['types'][] = 'type_NDB';
        }
        $filtered = $listenerRepository->getFilteredListeners($system, $args);
        $matched =
            ($showingAll ?
                "(Showing all $total listeners)"
             :
                "(Showing ".count($filtered)." of $total listeners)"
            );
        $parameters = [
            'system' =>     $system,
            'mode' =>       'Listeners List',
            'text' =>
                "<ul>\n"
                ."    <li>Log and station counts are updated each time new log data is added - "
                ."figures are for logs in the system at this time.</li>\n"
                ."    <li>To see stats for different types of signals, check the boxes shown for 'Types' below.</li>\n"
                ."    <li>This report prints best in Portrait.</li>\n"
                ."</ul>\n",
            'form' =>       $form->createView(),
            'columns' =>    $listenerRepository->getColumns(),
            'args' =>       $args,
            'listeners' =>  $filtered,
            'matched' =>    $matched
        ];

        return $this->render('listeners/index.html.twig', $parameters);
    }

}