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

class OpenNewTicket
{
    /**
     * Should NOT reference the ticket entity directly: only serializable data allowed!
     * Entities change over time
     * Command never changes (it has happened, period)
     *
     * @var Ticket
     */
    //protected $ticketEntity;

    private $subject;
    private $description;
    private $importance;
    private $openedBy;
    private $projectId;

    public function __construct($subject, $description, $importance, $projectId, $openedBy)
    {
        // maybe throw exceptions on invalid types?
        $this->subject = (string) $subject;
        $this->description = $description;
        $this->importance = $importance;
        $this->projectId = $projectId; // project may not exist, but this must be a valid UUID format! (validate and throw exception)
        $this->openedBy = $openedBy;
    }

    /**
     * @return Ticket
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getImportance()
    {
        return $this->importance;
    }

    /**
     * @return mixed
     */
    public function getOpenedBy()
    {
        return $this->openedBy;
    }

    /**
     * @return mixed
     */
    public function getProjectId()
    {
        return $this->projectId;
    }
}
