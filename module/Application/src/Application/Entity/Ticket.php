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

/**
 * @Entity
 * @Table(name="ticket")
 */
class Ticket
{
    /**
     * @Id
     * @GeneratedValue
     * @Column(name="id", type="integer")
     */
    private $id;
    /**
     * @Column(name="project_id", type="integer")
     */
    private $projectId;
    /**
     * @Column(name="subject", type="varchar", length="255")
     */
    private $subject;
    /**
     * @Column(name="description", type="text")
     */
    private $description;
    /**
     * @Column(name="importance", type="integer")
     */
    private $importance;
    /**
     * @Column(name="opened_by", type="integer")
     */
    private $openedBy;
    /**
     * @Column(name="created_at", type="datetime")
     */
    private $createdAt;
    /**
     * @Column(name="status", type="boolean")
     */
    private $status;
    /**
     * @Column(name="responsible", type="integer", length="20")
     */
    private $responsible;
}
