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

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Rhumsaa\Uuid\Uuid;

/**
 * @ORM\Entity
 * @ORM\Table(name="ticket")
 */
class Ticket
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(name="id", type="string")
     */
    private $id;
    /**
     * @ORM\Column(name="project_id", type="integer")
     */
    //private $projectId;
    /**
     * @ORM\Column(name="subject", type="text", length=255)
     */
    private $subject;
    /**
     * @ORM\Column(name="description", type="text")
     */
    private $description;
    /**
     * @ORM\Column(name="importance", type="integer")
     */
    private $importance;
    /**
     * @ORM\Column(name="opened_by", type="integer")
     */
    private $openedBy;
    /**
     * @ORM\Column(name="active", type="boolean", nullable=true, options={"default"=1})
     */
    private $active;
    /**
     * @ORM\Column(name="responsible", type="integer", length=20, nullable=true)
     */
    private $responsible;

    public function __construct()
    {
        // example for UUIDs:
        $this->id = Uuid::uuid4();
    }

    /**
     * @return mixed
     */
    public function getResponsible()
    {
        return $this->responsible;
    }

    /**
     * @param mixed $responsible
     */
//    public function setResponsible($responsible)
//    {
//        $this->responsible = $responsible;
//    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Remove ALL setters for IDs (ID _NEVER EVER_ changes)
     *
     * @param mixed $id
     */
//    public function setId($id)
//    {
//        $this->id = $id;
//    }

    /**
     * Project will probably not be needed
     *
     * Also, the methods should set/get a Project entity, not a Project ID
     *
     * @return Project
     */
//    public function getProject()
//    {
//        return $this->project;
//    }

    /**
     * @param mixed $projectId
     */
//    public function setProject(Project $project)
//    {
//        $this->project = $project;
//    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Avoid setters: instead, write methods such as `updateFromTicketUpdateRequest(...)`
     *
     * Getting information: ok
     * Setting information: it's an action, therefore it should be worded accordingly
     *
     * @param mixed $subject
     */
//    public function setSubject($subject)
//    {
//        $this->subject = $subject;
//    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
//    public function setDescription($description)
//    {
//        $this->description = $description;
//    }

    /**
     * @return mixed
     */
    public function getImportance()
    {
        return $this->importance;
    }

    /**
     * @param mixed $importance
     */
//    public function setImportance($importance)
//    {
//        $this->importance = $importance;
//    }

    /**
     * @return mixed
     */
    public function getOpenedBy()
    {
        return $this->openedBy;
    }

    /**
     * @param mixed $openedBy
     */
//    public function setOpenedBy($openedBy)
//    {
//        $this->openedBy = $openedBy;
//    }

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param mixed $active
     */
//    public function setActive($active)
//    {
//        $this->active = $active;
//    }
}
