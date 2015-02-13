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

namespace Application\Command\Ticket;

use Application\Entity\Ticket;
use Application\Event\Ticket\TicketWasCreated;
use Doctrine\ORM\EntityManager;
use Zend\Di\ServiceLocator;

class TicketCommandHandler
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function handleOpenNewTicket(OpenNewTicket $command)
    {
        $ticket = new Ticket();

        $user    = $this->entityManager->find('User', $command->getOpenedBy());
        $project = $this->entityManager->find('Project', $command->getProjectId());

        if (! $user) {
            throw new \DomainException(sprintf('No user found for ID %s', $command->getOpenedBy()));
        }

        $ticket->fromOpenCommand(
            $command->getSubject(),
            $command->getDescription(),
            $command->getImportance(),
            $user,
            $project
        );

        $this->entityManager->persist($command->getEntity());
        $this->entityManager->flush();

        return new TicketWasCreated($ticket->getId());
    }

    public function handleRemoveTicket(RemoveTicket $command)
    {
        $entity = $this->entityManager
            ->getRepository(Ticket::class)
            ->findOneBy(['id' => $command->getIdentifier()]);

        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }
}
