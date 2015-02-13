<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license.
 */

namespace Application\Controller;

use Application\Command\Ticket\OpenNewTicket;
use Application\Command\Ticket\RemoveTicket;
use Application\Command\Ticket\TicketCommandHandler;
use Application\Command\Ticket\TicketIdentifier;
use Application\Entity\Ticket as TicketEntity;
use Application\Form\Ticket;
use Doctrine\ORM\EntityManager;
use Zend\Form\FormElementManager;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class TicketController extends AbstractActionController
{
    /**
     * @var TicketCommandHandler
     */
    protected $commandHandler;
    /**
     * @var FormElementManager
     */
    protected $formManager;

    //@TODO inject the form directly, not the FormElementManager.
    public function __construct(
        CommandBus $commandHandler,
        FormElementManager $formManager
    ) {
        $this->commandHandler = $commandHandler;
        $this->formManager    = $formManager;
    }

    public function indexAction()
    {
        // inject the repository directly instead (constructor)?
        $tickets = $this
            ->getEntityManager()
            ->getRepository(TicketEntity::class)
            ->findAll();

        return new ViewModel(['tickets' => $tickets]);
    }

    public function openAction()
    {
        // as said before, inject the form directly
        $form = $this
            ->formManager
            ->get(Ticket::class);

        return new ViewModel([
            'form' => $form
        ]);
    }

    public function registerAction()
    {
        // no form validation?
        $params = $this->params()->fromPost();

//        $this->form->setData($this->params()->fromPost());
//
//        if (! $this->form->isValid()) {
//            return $this->openAction();
//        }
//
//        $validData = $form->getValues();
        $result = $this->commandHandler->handle(
            new OpenNewTicket(
                $validData['subject'], // to be fetched from validated data!
                $validData['description'], // to be fetched from validated data!
                $validData['importance'], // to be fetched from validated data!
                1, // @todo probably not needed
                1 // @todo $this->authService->getIdentity()->getId()
            )
        );

        if ($result) {
            return $this->redirect(
                'ticket/view',
                ['ticketId' => $result->getTicketId()]
            );
        }

        $this->postRedirectGet('ticket-index');
    }

    public function removeTicketAction()
    {
        $id = $this->params('id');

        $this->commandHandler->handleRemoveTicket(
            // not sure if `TicketIdentifier` is really needed for now (too complex)
            // just $id is ok
            new RemoveTicket(new TicketIdentifier($id))
        );

        $this->redirect('ticket-index');
    }

    /**
     * @return EntityManager
     *
     * Don't inject the EntityManager in Controllers - only repositories allowed!
     */
    protected function getEntityManager()
    {
        return $this
            ->getServiceLocator()
            ->get(EntityManager::class);
    }
}
