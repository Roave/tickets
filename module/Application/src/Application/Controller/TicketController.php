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
    protected $commandTicket;
    /**
     * @var FormElementManager
     */
    protected $formManager;

    public function __construct(TicketCommandHandler $commandTicket, FormElementManager $formManager)
    {
        $this->commandTicket = $commandTicket;
        $this->formManager   = $formManager;
    }

    public function indexAction()
    {
        return new ViewModel();
    }

    public function openAction()
    {
        $form = $this
            ->formManager
            ->get(Ticket::class);

        return new ViewModel([
            'form' => $form
        ]);
    }

    public function registerAction()
    {
        $params = $this->params()->fromPost();

        $this->commandTicket->handleOpenNewTicket(
            new OpenNewTicket(
                $params['subject'],
                $params['description'],
                $params['importance'],
                1,
                1
            ),
            $this->getEntityManager()
        );

        $this->postRedirectGet('ticket-index');
    }

    public function removeTicketAction()
    {
        $id = $this->params('id');

        $this->commandTicket->handleRemoveTicket(
            new RemoveTicket(new TicketIdentifier($id)),
            $this->getEntityManager()
        );

        $this->postRedirectGet('ticket-index');
    }

    /**
     * @return EntityManager
     */
    protected function getEntityManager()
    {
        return $this
            ->getServiceLocator()
            ->get(EntityManager::class);
    }
}
