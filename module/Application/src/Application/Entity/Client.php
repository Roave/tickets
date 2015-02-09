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
 * @Table(name="client")
 */
class Client
{
    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer", length="20")
     */
    private $id;
    /**
     * @Column(type="varchar", length="255")
     */
    private $name;
    /**
     * @Column(type="boolean")
     */
    private $active;
    /**
     * @Column(type="datetime")
     */
    private $birthday;
    /**
     * @Column(type="varchar", length="50", nullable="true")
     */
    private $phone;
    /**
     * @Column(name="mobile_phone", type="varchar", length="50", nullable="true")
     */
    private $mobilePhone;
    /**
     * @Column(type="varchar", length="255")
     */
    private $address;
    /**
     * @Column(type="varchar", length="50")
     */
    private $country;
    /**
     * @Column(type="varchar")
     */
    private $mail;
    /**
     * @Column(type="varchar")
     */
    private $vatId;
    /**
     * @Column(type="text")
     */
    private $observation;
    /**
     * @Column(name="registered_at", type="datetime")
     */
    private $dateRegister;
}
